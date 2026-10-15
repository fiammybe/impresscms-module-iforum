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
 
include 'header.php';
include_once ICMS_ROOT_PATH . '/modules/' . icms::$module->getVar("dirname") . '/class/uploader.php';
include_once ICMS_ROOT_PATH . '/modules/' . basename(__DIR__) . '/include/functions.ipf.php';
 
foreach (array(
'forum',
	'topic_id',
	'post_id',
	'order',
	'pid',
	'start',
	'isreply',
	'isedit' ) as $getint)
{
	$ {
		$getint }
	 = isset($_POST[$getint]) ? intval($_POST[$getint]) :
	 0 ;
}
$op = isset($_POST['op']) ? $_POST['op'] :
 '';
$viewmode = (isset($_POST['viewmode']) && $_POST['viewmode'] != 'flat') ? 'thread' :
 'flat';
if (empty($forum) )
{
	redirect_header("index.php", 2, _MD_ERRORFORUM);
	exit();
}
 
$forum_handler = icms_getmodulehandler('forum', basename(__DIR__), 'iforum' );
$topic_handler = icms_getmodulehandler('topic', basename(__DIR__), 'iforum' );
$post_handler = icms_getmodulehandler('post', basename(__DIR__), 'iforum' );
$post_service = iforum_get_service('post');
$post_form_state_service = iforum_get_service('postFormState');
 
if (!empty($isedit) && $post_id > 0 )
{
	$forumpost = $post_handler->get($post_id);
	$topic_id = $forumpost->getVar("topic_id");
}
else
{
	$forumpost = $post_handler->create();
}
$topic = $topic_handler->get($topic_id);
$forum_id = ($topic_id)?$topic->getVar("forum_id"):
$forum;
$forum_obj = $forum_handler->get($forum_id);
if (!$forum_handler->getPermission($forum_obj))
	{
	redirect_header("index.php", 2, _MD_NORIGHTTOACCESS);
	exit();
}
 
if (icms::$module->config['wol_enabled'])
	{
	$online_handler = icms_getmodulehandler('online', basename(__DIR__), 'iforum' );
	$online_handler->init($forum_obj);
}
 
include ICMS_ROOT_PATH."/header.php";
 
if (!empty($_POST['contents_submit']) )
{
	$validation = $post_service->validateSubmissionAttempt($forum_obj, $_POST);
	if (!$validation['is_valid'])
	{
		$_POST['contents_preview'] = 1;
		$_POST['contents_submit'] = null;
		$_POST['contents_upload'] = null;
		foreach ($validation['errors'] as $error_message)
		{
			echo "<div class=\"errorMsg\">".$error_message."</div>";
		}
		echo "<br clear=\"both\" />";
	}
}
 
if (!empty($_POST['contents_submit']) )
{
	$attachments_tmp = array();
	if (!empty($_POST["attachments_tmp"]))
		{
		$attachments_tmp = unserialize(base64_decode($_POST["attachments_tmp"]));
	}
	$attachments_tmp = $post_service->filterTemporaryAttachments($_POST, $attachments_tmp);
	$result = $post_service->submit($forum_obj, $forumpost, $_POST, $_FILES, (int)$topic_status, $attachments_tmp);
	if (!empty($result['insert_error']))
	{
		include_once(ICMS_ROOT_PATH.'/header.php');
		icms_core_Message::error('Could not insert forum post');
		icms_core_Message::error($result['errors']);
		include_once(ICMS_ROOT_PATH.'/footer.php');
		exit();
	}
	if (empty($result['success']))
	{
		if (!empty($result['redirect']))
		{
			redirect_header($result['redirect'], 2, $result['message']);
			exit();
		}
	}
	redirect_header($result['redirect'], !empty($_POST['op']) && $_POST['op'] == 'add' ? 1 : 2, $result['message']);
	exit();
}

if (!empty($_POST['contents_upload']) )
{
	$attachments_tmp = array();
	if (!empty($_POST["attachments_tmp"]))
		{
		$attachments_tmp = unserialize(base64_decode($_POST["attachments_tmp"]));
	}

	$upload_result = $post_service->handleTemporaryUpload($forum_obj, $_POST, $_FILES, $attachments_tmp);
	$attachments_tmp = $upload_result['attachments_tmp'];
	$error_upload = $upload_result['error_upload'];
}
 
if (!empty($_POST['contents_preview']) || !empty($_GET['contents_preview']) )
{
	if (!empty($_POST["attachments_tmp"]))
		{
		$attachments_tmp = unserialize(base64_decode($_POST["attachments_tmp"]));
	}
	 
	$p_subject = icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['subject']));
	$dosmiley = empty($_POST['dosmiley']) ? 0 : 1;
	$dohtml = empty($_POST['dohtml']) ? 0 : 1;
	$doxcode = empty($_POST['doxcode']) ? 0 : 1;
	$dobr = empty($_POST['dobr']) ? 0 : 1;
	$p_message = $_POST['message'];
	$p_message = $myts->previewTarea($p_message, $dohtml, $dosmiley, $doxcode, 1, $dobr);
	if ($dohtml && !iforum_isAdmin($forum_obj) )
	{
		//$p_message = iforum_textFilter($p_message);
	}
	 
	echo "<table cellpadding='4' cellspacing='1' width='98%' class='outer'>";
	echo "<tr><td class='head'>".$p_subject."</td></tr>";
	if (isset($_POST['poster_name']))
	{
		$p_poster_name = icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['poster_name']));
		echo "<tr><td>".$p_poster_name."</td></tr>";
	}
	echo "<tr><td><br />".$p_message."<br /></td></tr></table>";
}
 
if (!empty($_POST['contents_upload']) || !empty($_POST['contents_preview']) || !empty($_GET['contents_preview']) || !empty($_POST['editor']))
	{
	 
	echo "<br />";
	 
	$editor = empty($_POST['editor']) ? "" :
	 $_POST['editor'];
	$dosmiley = empty($_POST['dosmiley']) ? 0 :
	 1;
	$dohtml = empty($_POST['dohtml']) ? 0 :
	 1;
	$doxcode = empty($_POST['doxcode']) ? 0 :
	 1;
	$dobr = empty($_POST['dobr']) ? 0 :
	 1;
	$subject_pre = (isset($_POST['subject_pre']))?$_POST['subject_pre']:
	'';
	$subject = icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['subject']));
	$message = icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['message']));
	$poster_name = isset($_POST['poster_name'])?icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['poster_name'])):
	'';
	$hidden = isset($_POST['hidden'])? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($_POST['hidden'])):
	'';
	$notify = @intval($_POST['notify']);
	$attachsig = !empty($_POST['attachsig']) ? 1 :
	 0;
	$isreply = !empty($_POST['isreply']) ? 1 :
	 0;
	$isedit = !empty($_POST['isedit']) ? 1 :
	 0;
	$icon = (!empty($_POST['icon']) && is_file(ICMS_ROOT_PATH . "/images/subject/" . $_POST['icon']) ) ? $_POST['icon'] : '';
	$view_require = isset($_POST['view_require']) ? $_POST['view_require'] :
	 '';
	$post_karma = (($view_require == 'require_karma') && isset($_POST['post_karma']) )? intval($_POST['post_karma']) : 0 ;
	$require_reply = ($view_require == 'require_reply')?1:
	0;
	 
	if (empty($_POST['contents_upload'])) $contents_preview = 1;
	$context = $post_form_state_service->buildPostbackContext($_POST, $forum_obj, $forumpost, !empty($attachments_tmp) ? $attachments_tmp : array());
	iforum_render_post_form($context);
}
 
include ICMS_ROOT_PATH.'/footer.php';
