<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumNotificationService
{
    public function getItemInfo(string $category, $item_id): array
    {
        $module_handler = icms::handler('icms_module');
        $module = $module_handler->getByDirname(basename(dirname(__FILE__, 3)));

        if ($category === 'global') {
            return array('name' => '', 'url' => '');
        }

        $item_id = (int)$item_id;
        if ($category === 'forum') {
            $sql = 'SELECT forum_name FROM ' . icms::$xoopsDB->prefix('bb_forums') . ' WHERE forum_id = ' . $item_id;
            $result = icms::$xoopsDB->query($sql);
            if (!$result) {
                return array('name' => '', 'url' => '');
            }
            $result_array = icms::$xoopsDB->fetchArray($result);
            if (!$result_array) {
                return array('name' => '', 'url' => '');
            }
            return array(
                'name' => $result_array['forum_name'],
                'url' => ICMS_URL . '/modules/' . $module->getVar('dirname') . '/viewforum.php?forum=' . $item_id,
            );
        }

        if ($category === 'thread') {
            $sql = 'SELECT t.topic_title,f.forum_id FROM ' . icms::$xoopsDB->prefix('bb_topics') . ' t, ' . icms::$xoopsDB->prefix('bb_forums') . ' f WHERE t.forum_id = f.forum_id AND t.topic_id = ' . $item_id . ' limit 1';
            $result = icms::$xoopsDB->query($sql);
            if (!$result) {
                return array('name' => '', 'url' => '');
            }
            $result_array = icms::$xoopsDB->fetchArray($result);
            if (!$result_array) {
                return array('name' => '', 'url' => '');
            }
            return array(
                'name' => $result_array['topic_title'],
                'url' => ICMS_URL . '/modules/' . $module->getVar('dirname') . '/viewtopic.php?forum=' . $result_array['forum_id'] . '&topic_id=' . $item_id,
            );
        }

        if ($category === 'post') {
            $sql = 'SELECT subject,topic_id,forum_id FROM ' . icms::$xoopsDB->prefix('bb_posts') . ' WHERE post_id = ' . $item_id . ' LIMIT 1';
            $result = icms::$xoopsDB->query($sql);
            if (!$result) {
                return array('name' => '', 'url' => '');
            }
            $result_array = icms::$xoopsDB->fetchArray($result);
            if (!$result_array) {
                return array('name' => '', 'url' => '');
            }
            return array(
                'name' => $result_array['subject'],
                'url' => ICMS_URL . '/modules/' . $module->getVar('dirname') . '/viewtopic.php?forum=' . $result_array['forum_id'] . '&amp;topic_id=' . $result_array['topic_id'] . '#forumpost' . $item_id,
            );
        }

        return array('name' => '', 'url' => '');
    }
}
