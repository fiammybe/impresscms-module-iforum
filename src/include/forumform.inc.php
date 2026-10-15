<?php
/**
 * iForum - a bulletin Board (Forum) for ImpressCMS
 *
 * Based upon CBB 3.08
 *
 * @copyright  http://www.xoops.org/ The XOOPS Project
 * @copyright  http://xoopsforge.com The XOOPS FORGE Project
 * @copyright  http://xoops.org.cn The XOOPS CHINESE Project
 * @copyright  XOOPS_copyrights.txt
 * @copyright  readme.txt
 * @copyright  http://www.impresscms.org/ The ImpressCMS Project
 * @license   GNU General Public License (GPL)
 *     a copy of the GNU license is enclosed.
 * ----------------------------------------------------------------------------------------------------------
 * @package  CBB - XOOPS Community Bulletin Board
 * @since   3.08
 * @author  phppp
 * ----------------------------------------------------------------------------------------------------------
 *     iForum - a bulletin Board (Forum) for ImpressCMS
 * @since   1.00
 * @author  modified by stranger
 * @version  $Id$
 */

if (!defined('ICMS_ROOT_PATH'))
{
	exit();
}

if (empty($forum_obj)) {
	$forum_handler = icms_getmodulehandler('forum', basename(dirname(__DIR__)), 'iforum');
	$forum = isset($_GET['forum']) ? (int)$_GET['forum'] : (isset($forum) ? (int)$forum : 0);
	$forum_obj = $forum_handler->get($forum);
}
if (empty($topic_handler)) {
	$topic_handler = icms_getmodulehandler('topic', basename(dirname(__DIR__)), 'iforum');
}
if (empty($myts)) {
	$myts = icms_core_Textsanitizer::getInstance();
}

$context = array(
	'forum_obj' => $forum_obj,
	'forum' => isset($forum) ? (int)$forum : (int)$forum_obj->getVar('forum_id'),
	'topic_id' => isset($topic_id) ? (int)$topic_id : 0,
	'post_id' => isset($post_id) ? (int)$post_id : 0,
	'pid' => isset($pid) ? (int)$pid : 0,
	'start' => isset($start) ? (int)$start : 0,
	'order' => isset($order) ? (int)$order : 0,
	'viewmode' => isset($viewmode) ? $viewmode : 'flat',
	'subject' => isset($subject) ? $subject : '',
	'message' => isset($message) ? $message : '',
	'hidden' => isset($hidden) ? $hidden : '',
	'subject_pre' => isset($subject_pre) ? $subject_pre : '',
	'dohtml' => isset($dohtml) ? (int)$dohtml : 0,
	'dosmiley' => isset($dosmiley) ? (int)$dosmiley : 0,
	'doxcode' => isset($doxcode) ? (int)$doxcode : 0,
	'dobr' => isset($dobr) ? (int)$dobr : 0,
	'icon' => isset($icon) ? $icon : '',
	'post_karma' => isset($post_karma) ? (int)$post_karma : 0,
	'require_reply' => isset($require_reply) ? (int)$require_reply : 0,
	'attachsig' => isset($attachsig) ? (int)$attachsig : 0,
	'isedit' => isset($isedit) ? (int)$isedit : 0,
	'isreply' => isset($isreply) ? (int)$isreply : 0,
	'op' => isset($op) ? $op : '',
	'attachments' => isset($attachments) ? $attachments : array(),
	'attachments_tmp' => isset($attachments_tmp) ? $attachments_tmp : array(),
	'poster_name' => isset($poster_name) ? $poster_name : '',
	'notify' => isset($notify) ? (int)$notify : 0,
	'topic_tags' => isset($topic_tags) ? $topic_tags : '',
	'editor' => isset($editor) ? $editor : '',
	'admin_form_action' => isset($admin_form_action) ? $admin_form_action : '',
	'forumpost' => isset($forumpost) ? $forumpost : null,
);

iforum_render_post_form($context);
