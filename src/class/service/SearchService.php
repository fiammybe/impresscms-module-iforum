<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumSearchService
{
    public function search($queryarray, $andor, $limit, $offset, $userid, $forums = 0, $sortby = 0, string $searchin = 'both', string $subquery = ''): array
    {
        global $icmsConfig, $myts;
        static $allowedForums = array(), $iforumConfig;

        $uid = (is_object(icms::$user) && icms::$user->isactive()) ? icms::$user->getVar('uid') : 0;

        if (is_array($forums) && count($forums) > 0) {
            $forumScope = 'list:' . implode(',', array_map('intval', $forums));
        } elseif (is_numeric($forums) && $forums > 0) {
            $forumScope = 'single:' . (int)$forums;
        } else {
            $forumScope = 'all';
        }

        if (!isset($allowedForums[$uid][$forumScope])) {
            $forum_handler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 3)), 'iforum');
            if (is_array($forums) && count($forums) > 0) {
                $forums = array_map('intval', $forums);
                foreach ($forums as $forumid) {
                    $_forum = $forum_handler->get($forumid);
                    if ($forum_handler->getPermission($_forum)) {
                        $allowedForums[$uid][$forumScope][$forumid] = $_forum;
                    }
                }
            } elseif (is_numeric($forums) && $forums > 0) {
                $forumid = (int)$forums;
                $_forum = $forum_handler->get($forumid);
                if ($forum_handler->getPermission($_forum)) {
                    $allowedForums[$uid][$forumScope][$forumid] = $_forum;
                }
            } else {
                $forums = $forum_handler->getForums();
                foreach ($forums as $forumid => $_forum) {
                    if ($forum_handler->getPermission($_forum)) {
                        $allowedForums[$uid][$forumScope][$forumid] = $_forum;
                    }
                }
            }
        }

        $forum = implode(',', array_keys($allowedForums[$uid][$forumScope]));
        $sql = 'SELECT p.uid,f.forum_id, p.topic_id, p.poster_name, p.post_time,'
            . ' f.forum_name, p.post_id, p.subject'
            . ' FROM ' . icms::$xoopsDB->prefix('bb_posts') . ' p,'
            . ' ' . icms::$xoopsDB->prefix('bb_posts_text') . ' pt,'
            . ' ' . icms::$xoopsDB->prefix('bb_forums') . ' f'
            . ' WHERE p.post_id = pt.post_id'
            . ' AND p.approved = 1'
            . ' AND p.forum_id = f.forum_id';

        if (!empty($forum)) {
            $sql .= ' AND f.forum_id IN (' . $forum . ')';
        }

        if (is_numeric($userid) && $userid != 0) {
            $sql .= ' AND p.uid=' . (int)$userid . ' ';
        } elseif (is_array($userid) && count($userid) > 0) {
            $userid = array_map('intval', $userid);
            $sql .= ' AND p.uid IN (' . implode(',', $userid) . ') ';
        }

        $count = is_array($queryarray) ? count($queryarray) : 0;
        if ($count > 0) {
            switch ($searchin) {
                case 'title':
                    $sql .= " AND ((p.subject LIKE '%$queryarray[0]%')";
                    break;
                case 'text':
                    $sql .= " AND ((pt.post_text LIKE '%$queryarray[0]%')";
                    break;
                case 'both':
                default:
                    $sql .= " AND ((p.subject LIKE '%$queryarray[0]%' OR pt.post_text LIKE '%$queryarray[0]%')";
                    break;
            }
            for ($i = 1; $i < $count; $i++) {
                $sql .= ' ' . $andor . ' ';
                switch ($searchin) {
                    case 'title':
                        $sql .= "(p.subject LIKE '%$queryarray[$i]%')";
                        break;
                    case 'text':
                        $sql .= "(pt.post_text LIKE '%$queryarray[$i]%')";
                        break;
                    case 'both':
                    default:
                        $sql .= "(p.subject LIKE '%$queryarray[$i]%' OR pt.post_text LIKE '%$queryarray[$i]%')";
                        break;
                }
            }
            $sql .= ') ';
        }

        if (!$sortby) {
            $sortby = 'p.post_time DESC';
        }
        $sql .= $subquery . ' ORDER BY ' . $sortby;

        $result = icms::$xoopsDB->query($sql, $limit, $offset);
        $ret = array();
        $users = array();
        $i = 0;
        while ($myrow = icms::$xoopsDB->fetchArray($result)) {
            $ret[$i]['image'] = 'images/imforum_iconsearch.png';
            $ret[$i]['link'] = 'viewtopic.php?topic_id=' . $myrow['topic_id'] . '&amp;forum=' . $myrow['forum_id'] . '&amp;post_id=' . $myrow['post_id'] . '#forumpost' . $myrow['post_id'];
            $ret[$i]['title'] = $myrow['subject'];
            $ret[$i]['time'] = $myrow['post_time'];
            $ret[$i]['uid'] = $myrow['uid'];
            $ret[$i]['forum_name'] = icms_core_DataFilter::htmlSpecialchars($myrow['forum_name']);
            $ret[$i]['forum_link'] = 'viewforum.php?forum=' . $myrow['forum_id'];
            $users[$myrow['uid']] = 1;
            $ret[$i]['poster_name'] = $myrow['poster_name'];
            $i++;
        }

        if (count($users) > 0) {
            $member_handler = icms::handler('icms_member');
            $userid_array = array_keys($users);
            $user_criteria = '(' . implode(',', $userid_array) . ')';
            $users = $member_handler->getUsers(new icms_db_criteria_Item('uid', $user_criteria, 'IN'), true);
        } else {
            $users = null;
        }

        $module_handler = icms::handler('icms_module');
        $iforum = $module_handler->getByDirname(basename(dirname(__FILE__, 3)));
        if (!isset($iforumConfig)) {
            $iforumConfig = icms::$config->getConfigsByCat(0, $iforum->getVar('mid'));
        }

        $count = count($ret);
        for ($i = 0; $i < $count; $i++) {
            if ($ret[$i]['uid'] > 0) {
                if (isset($users[$ret[$i]['uid']]) && is_object($users[$ret[$i]['uid']]) && $users[$ret[$i]['uid']]->isActive()) {
                    $poster = ($iforumConfig['show_realname'] && $users[$ret[$i]['uid']]->getVar('name')) ? $users[$ret[$i]['uid']]->getVar('name') : $users[$ret[$i]['uid']]->getVar('uname');
                    $poster = icms_core_DataFilter::htmlSpecialchars($poster);
                    $ret[$i]['poster'] = '<a href="' . ICMS_URL . '/userinfo.php?uid=' . $ret[$i]['uid'] . '">' . $poster . '</a>';
                } else {
                    $ret[$i]['poster'] = $icmsConfig['anonymous'];
                    $ret[$i]['uid'] = 0;
                }
            } else {
                $ret[$i]['poster'] = (empty($ret[$i]['poster_name'])) ? $icmsConfig['anonymous'] : icms_core_DataFilter::htmlSpecialchars($ret[$i]['poster_name']);
                $ret[$i]['uid'] = 0;
            }
        }

        return $ret;
    }
}
