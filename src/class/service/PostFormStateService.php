<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPostFormStateService
{
    public function buildNewTopicContext(int $forumId, int $order, string $viewmode, string $op = ''): array
    {
        $forumHandler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 4)), 'iforum');
        $forumObj = $forumHandler->get($forumId);

        return array(
            'forum_obj' => $forumObj,
            'forum' => $forumId,
            'topic_id' => 0,
            'post_id' => 0,
            'pid' => 0,
            'start' => 0,
            'order' => $order,
            'viewmode' => $viewmode,
            'subject' => '',
            'message' => '',
            'hidden' => '',
            'subject_pre' => '',
            'dohtml' => 1,
            'dosmiley' => 1,
            'doxcode' => 1,
            'dobr' => 1,
            'icon' => '',
            'post_karma' => 0,
            'require_reply' => 0,
            'attachsig' => (is_object(icms::$user) && icms::$user->getVar('attachsig')) ? 1 : 0,
            'isedit' => 0,
            'isreply' => 0,
            'op' => $op,
            'attachments' => array(),
            'attachments_tmp' => array(),
            'poster_name' => '',
            'notify' => 0,
            'topic_tags' => '',
            'forumpost' => null,
        );
    }

    public function buildReplyContext($forumpost, int $forumId, int $topicId, int $pid, int $order, int $start, string $viewmode, string $subject, string $message, string $hidden): array
    {
        return array(
            'forum_obj' => icms_getmodulehandler('forum', basename(dirname(__FILE__, 4)), 'iforum')->get($forumId),
            'forum' => $forumId,
            'topic_id' => $topicId,
            'post_id' => 0,
            'pid' => $pid,
            'start' => $start,
            'order' => $order,
            'viewmode' => $viewmode,
            'subject' => $subject,
            'message' => $message,
            'hidden' => $hidden,
            'subject_pre' => '',
            'dohtml' => 1,
            'dosmiley' => 1,
            'doxcode' => 1,
            'dobr' => 1,
            'icon' => '',
            'post_karma' => 0,
            'require_reply' => 0,
            'attachsig' => (is_object(icms::$user) && icms::$user->getVar('attachsig')) ? 1 : 0,
            'isedit' => 0,
            'isreply' => 1,
            'op' => '',
            'attachments' => array(),
            'attachments_tmp' => array(),
            'poster_name' => '',
            'notify' => 0,
            'topic_tags' => '',
            'forumpost' => $forumpost,
        );
    }

    public function buildEditContext($forumpost, array $attachments, int $forumId, int $topicId, int $postId, int $pid, int $order, string $viewmode): array
    {
        return array(
            'forum_obj' => icms_getmodulehandler('forum', basename(dirname(__FILE__, 4)), 'iforum')->get($forumId),
            'forum' => $forumId,
            'topic_id' => $topicId,
            'post_id' => $postId,
            'pid' => $pid,
            'start' => 0,
            'order' => $order,
            'viewmode' => $viewmode,
            'subject' => $forumpost->getVar('subject', 'E'),
            'message' => $forumpost->getVar('post_text', 'E'),
            'hidden' => '',
            'subject_pre' => '',
            'dohtml' => $forumpost->getVar('dohtml'),
            'dosmiley' => $forumpost->getVar('dosmiley'),
            'doxcode' => $forumpost->getVar('doxcode'),
            'dobr' => $forumpost->getVar('dobr'),
            'icon' => $forumpost->getVar('icon'),
            'post_karma' => $forumpost->getVar('post_karma'),
            'require_reply' => $forumpost->getVar('require_reply'),
            'attachsig' => $forumpost->getVar('attachsig'),
            'isedit' => 1,
            'isreply' => (int)!$forumpost->isTopic(),
            'op' => '',
            'attachments' => $attachments,
            'attachments_tmp' => array(),
            'poster_name' => $forumpost->getVar('poster_name', 'E'),
            'notify' => 0,
            'topic_tags' => '',
            'forumpost' => $forumpost,
        );
    }

    public function buildPostbackContext(array $request, $forumObj, $forumpost, array $attachmentsTmp = array()): array
    {
        return array(
            'forum_obj' => $forumObj,
            'forum' => (int)$forumObj->getVar('forum_id'),
            'topic_id' => isset($request['topic_id']) ? (int)$request['topic_id'] : 0,
            'post_id' => isset($request['post_id']) ? (int)$request['post_id'] : 0,
            'pid' => isset($request['pid']) ? (int)$request['pid'] : 0,
            'start' => isset($request['start']) ? (int)$request['start'] : 0,
            'order' => isset($request['order']) ? (int)$request['order'] : 0,
            'viewmode' => (isset($request['viewmode']) && $request['viewmode'] != 'flat') ? 'thread' : 'flat',
            'subject' => isset($request['subject']) ? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($request['subject'])) : '',
            'message' => isset($request['message']) ? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($request['message'])) : '',
            'hidden' => isset($request['hidden']) ? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($request['hidden'])) : '',
            'subject_pre' => isset($request['subject_pre']) ? $request['subject_pre'] : '',
            'dohtml' => empty($request['dohtml']) ? 0 : 1,
            'dosmiley' => empty($request['dosmiley']) ? 0 : 1,
            'doxcode' => empty($request['doxcode']) ? 0 : 1,
            'dobr' => empty($request['dobr']) ? 0 : 1,
            'icon' => (!empty($request['icon']) && is_file(ICMS_ROOT_PATH . '/images/subject/' . $request['icon'])) ? $request['icon'] : '',
            'post_karma' => ((isset($request['view_require']) && $request['view_require'] == 'require_karma') && isset($request['post_karma'])) ? (int)$request['post_karma'] : 0,
            'require_reply' => (isset($request['view_require']) && $request['view_require'] == 'require_reply') ? 1 : 0,
            'attachsig' => !empty($request['attachsig']) ? 1 : 0,
            'isedit' => !empty($request['isedit']) ? 1 : 0,
            'isreply' => !empty($request['isreply']) ? 1 : 0,
            'op' => isset($request['op']) ? $request['op'] : '',
            'attachments' => is_object($forumpost) ? $forumpost->getAttachment() : array(),
            'attachments_tmp' => $attachmentsTmp,
            'poster_name' => isset($request['poster_name']) ? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($request['poster_name'])) : '',
            'notify' => isset($request['notify']) ? (int)$request['notify'] : 0,
            'topic_tags' => isset($request['topic_tags']) ? icms_core_DataFilter::htmlSpecialchars(icms_core_DataFilter::stripSlashesGPC($request['topic_tags'])) : '',
            'forumpost' => $forumpost,
        );
    }
}
