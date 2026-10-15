<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPostService
{
    public const ATTACHMENT_STORAGE_MODE = 'serialized_post_field';

    public function getAttachmentStorageMode(): string
    {
        return self::ATTACHMENT_STORAGE_MODE;
    }

    public function validateSubmissionAttempt($forumObj, array $request): array
    {
        global $icmsConfig;

        $tokenValid = false;
        if (class_exists('XoopsSecurity')) {
            $tokenValid = $GLOBALS['xoopsSecurity']->check();
        } else {
            if (!empty($_SESSION['submit_token']) && !empty($request['post_valid']) && $request['post_valid'] == $_SESSION['submit_token']) {
                $tokenValid = true;
            }
            $_SESSION['submit_token'] = null;
        }

        $errors = array();
        $captchaInvalid = false;
        if (!is_object(icms::$user)) {
            $uname = !isset($request['uname']) ? '' : trim((string)$request['uname']);
            $pass = !isset($request['pass']) ? '' : trim((string)$request['pass']);
            if ($uname !== '' || $pass !== '') {
                $memberHandler = icms::handler('icms_member');
                $user = $memberHandler->loginUser(addslashes(icms_core_DataFilter::stripSlashesGPC($uname)), addslashes(icms_core_DataFilter::stripSlashesGPC($pass)));
                if (is_object($user) && 0 < $user->getVar('level')) {
                    if (!empty($request['login'])) {
                        $user->setVar('last_login', time());
                        $memberHandler->insertUser($user);
                        $_SESSION = array();
                        $_SESSION['xoopsUserId'] = $user->getVar('uid');
                        $_SESSION['xoopsUserGroups'] = $user->getGroups();
                        if ($icmsConfig['use_mysession'] && $icmsConfig['session_name'] != '') {
                            setcookie($icmsConfig['session_name'], session_id(), time() + (60 * $icmsConfig['session_expire']), '/', '', 0);
                        }
                        $userTheme = $user->getVar('theme');
                        if (in_array($userTheme, $icmsConfig['theme_set_allowed'])) {
                            $_SESSION['xoopsUserTheme'] = $userTheme;
                        }
                    }
                    icms::$user = $user;
                }
            }
        }

        if (!empty(icms::$module->config['captcha_enabled']) && @include_once ICMS_ROOT_PATH . '/class/captcha/captcha.php') {
            $icmsCaptcha = IcmsCaptcha::instance();
            if (!$icmsCaptcha->verify()) {
                $captchaInvalid = true;
                $errors[] = $icmsCaptcha->getMessage();
            }
        }

        $isAdmin = iforum_isAdmin($forumObj);
        $timeValid = true;
        if (!$isAdmin && !empty(icms::$module->config['post_timelimit'])) {
            $lastPost = iforum_getsession('LP');
            if (time() - $lastPost < icms::$module->config['post_timelimit']) {
                $timeValid = false;
            }
        }

        if (!$tokenValid) {
            $errors[] = _MD_INVALID_SUBMIT;
        }
        if (!$timeValid) {
            $errors[] = sprintf(_MD_POSTING_LIMITED, icms::$module->config['post_timelimit']);
        }

        return array(
            'is_valid' => !$captchaInvalid && $tokenValid && $timeValid,
            'errors' => $errors,
            'captcha_invalid' => $captchaInvalid,
            'token_valid' => $tokenValid,
            'time_valid' => $timeValid,
            'is_admin' => $isAdmin,
        );
    }

    public function canPost($forumObj): bool
    {
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$topicHandler->getPermission($forumObj, 0, 'post');
    }

    public function canReply($forumObj, int $topicStatus): bool
    {
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$topicHandler->getPermission($forumObj, $topicStatus, 'reply');
    }

    public function canEdit($forumObj, int $topicStatus, $forumpost): bool
    {
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)($topicHandler->getPermission($forumObj, $topicStatus, 'edit')
            && (iforum_isAdmin($forumObj) || ($forumpost->checkTimelimit('edit_timelimit') && $forumpost->checkIdentity())));
    }

    public function canAttach($forumObj, int $topicStatus): bool
    {
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        return (bool)$topicHandler->getPermission($forumObj, $topicStatus, 'attach');
    }

    public function handleTemporaryUpload($forumObj, array $request, array $files, array $attachmentsTmp = array()): array
    {
        $attachmentsTmp = $this->filterTemporaryAttachments($request, $attachmentsTmp);

        $errorUpload = '';
        if (isset($files['userfile']['name']) && $files['userfile']['name'] != '') {
            $maxfilesize = $forumObj->getVar('attach_maxkb') * 1024;
            $uploaddir = XOOPS_CACHE_PATH;
            $allowedExtensions = $forumObj->getVar('attach_ext');
            $uploader = new iforum_uploader($uploaddir, $allowedExtensions, $maxfilesize);
            if ($uploader->fetchMedia($request['xoops_upload_file'][0])) {
                $prefix = is_object(icms::$user) ? strval(icms::$user->getVar('uid')) . '_' : 'iforum_';
                $uploader->setPrefix($prefix);
                if (!$uploader->upload()) {
                    $errorUpload = $uploader->getErrors();
                } elseif (is_file($uploader->getSavedDestination())) {
                    $attachmentsTmp[strval(time())] = array(
                        $uploader->getSavedFileName(),
                        $uploader->getMediaName(),
                        $uploader->getMediaType(),
                    );
                }
            } else {
                $errorUpload = $uploader->getErrors();
            }
        }

        return array(
            'attachments_tmp' => $attachmentsTmp,
            'error_upload' => $errorUpload,
        );
    }

    public function filterTemporaryAttachments(array $request, array $attachmentsTmp = array()): array
    {
        if (isset($request['delete_tmp']) && is_array($request['delete_tmp'])) {
            foreach ($request['delete_tmp'] as $key) {
                if (isset($attachmentsTmp[$key])) {
                    @unlink(XOOPS_CACHE_PATH . '/' . $attachmentsTmp[$key][0]);
                    unset($attachmentsTmp[$key]);
                }
            }
        }

        return $attachmentsTmp;
    }

    public function submit($forumObj, $forumpost, array $request, array $files, int $topicStatus, array $attachmentsTmp = array()): array
    {
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        $postHandler = icms_getmodulehandler('post', basename(dirname(__FILE__, 4)), 'iforum');
        $topic = $topicHandler->get((int)$request['topic_id']);
        $postId = (int)$request['post_id'];
        $topicId = (int)$request['topic_id'];
        $forumId = (int)$forumObj->getVar('forum_id');
        $order = (int)$request['order'];
        $pid = (int)$request['pid'];
        $viewmode = (!empty($request['viewmode']) && $request['viewmode'] != 'flat') ? 'thread' : 'flat';
        $isEdit = !empty($request['isedit']) && $postId > 0;
        $isReply = false;
        $isNew = 1;
        $errorUpload = '';

        if (trim((string)$request['message']) === '') {
            return array(
                'success' => false,
                'redirect' => 'javascript:history.go(-1);',
                'message' => '',
            );
        }

        if ($isEdit) {
            if (!$this->canEdit($forumObj, $topicStatus, $forumpost)) {
                return array(
                    'success' => false,
                    'redirect' => 'viewtopic.php?forum=' . $forumId . '&amp;topic_id=' . $topicId . '&amp;post_id=' . $postId . '&amp;order=' . $order . '&amp;viewmode=' . $viewmode . '&amp;pid=' . $pid,
                    'message' => _MD_NORIGHTTOEDIT,
                );
            }
            $deleteAttach = isset($request['delete_attach']) ? $request['delete_attach'] : array();
            if (is_array($deleteAttach) && count($deleteAttach) > 0) {
                $forumpost->deleteAttachment($deleteAttach);
            }
        } else {
            if ($topicId) {
                if (!$this->canReply($forumObj, $topicStatus)) {
                    return array(
                        'success' => false,
                        'redirect' => 'viewtopic.php?forum=' . $forumId . '&amp;topic_id=' . $topicId . '&amp;post_id=' . $postId . '&amp;order=' . $order . '&amp;viewmode=' . $viewmode . '&amp;pid=' . $pid,
                        'message' => _MD_NORIGHTTOREPLY,
                    );
                }
            } elseif (!$this->canPost($forumObj)) {
                return array(
                    'success' => false,
                    'redirect' => 'viewtopic.php?forum=' . $forumId,
                    'message' => _MD_NORIGHTTOPOST,
                );
            }

            $isNew = 1;
            $uid = (!is_object(icms::$user) || (!empty($request['noname']) && !empty(icms::$module->config['allow_user_anonymous']))) ? 0 : icms::$user->getVar('uid');
            if (!empty($pid)) {
                $forumpost->setVar('pid', $pid);
            }
            if (!empty($topicId)) {
                $forumpost->setVar('topic_id', $topicId);
                $isReply = true;
            }
            $forumpost->setVar('poster_ip', iforum_getIP());
            $forumpost->setVar('uid', $uid);
            $forumpost->setVar('post_time', time());
        }

        $approved = $topicHandler->getPermission($forumObj, $topicStatus, 'noapprove') ? 1 : 0;
        $forumpost->setVar('approved', $approved);
        $forumpost->setVar('forum_id', $forumId);

        $subject = xoops_trim((string)$request['subject']);
        $subject = ($subject === '') ? _NOTITLE : $subject;
        $posterName = !empty($request['poster_name']) ? xoops_trim((string)$request['poster_name']) : '';
        $dohtml = !empty($request['dohtml']) ? 1 : 0;
        $dosmiley = !empty($request['dosmiley']) ? 1 : 0;
        $doxcode = !empty($request['doxcode']) ? 1 : 0;
        $dobr = !empty($request['dobr']) ? 1 : 0;
        $icon = (!empty($request['icon']) && is_file(ICMS_ROOT_PATH . '/images/subject/' . $request['icon'])) ? $request['icon'] : '';
        $attachsig = !empty($request['attachsig']) ? 1 : 0;
        $viewRequire = !empty($request['view_require']) ? $request['view_require'] : '';
        $postKarma = (($viewRequire === 'require_karma') && isset($request['post_karma'])) ? (int)$request['post_karma'] : 0;
        $requireReply = ($viewRequire === 'require_reply') ? 1 : 0;

        $forumpost->setVar('subject', $subject);
        $forumpost->setVar('post_text', (string)$request['message']);
        $forumpost->setVar('post_karma', $postKarma);
        $forumpost->setVar('require_reply', $requireReply);
        $forumpost->setVar('poster_name', $posterName);
        $forumpost->setVar('dohtml', $dohtml);
        $forumpost->setVar('dosmiley', $dosmiley);
        $forumpost->setVar('doxcode', $doxcode);
        $forumpost->setVar('dobr', $dobr);
        $forumpost->setVar('icon', $icon);
        $forumpost->setVar('attachsig', $attachsig);
        $forumpost->setAttachment();
        if ($postId > 0) {
            $forumpost->setPostEdit($posterName);
        }

        if (count($attachmentsTmp)) {
            foreach ($attachmentsTmp as $attach) {
                if (@rename(XOOPS_CACHE_PATH . '/' . $attach[0], ICMS_ROOT_PATH . '/' . icms::$module->config['dir_attachments'] . '/' . $attach[0])) {
                    $forumpost->setAttachment($attach[0], $attach[1], $attach[2]);
                }
            }
        }

        if ($this->canAttach($forumObj, $topicStatus) && isset($files['userfile']['name']) && $files['userfile']['name'] != '') {
            $maxfilesize = $forumObj->getVar('attach_maxkb') * 1024;
            $uploaddir = ICMS_ROOT_PATH . '/' . icms::$module->config['dir_attachments'];
            $uploader = new iforum_uploader($uploaddir, $forumObj->getVar('attach_ext'), $maxfilesize);
            if ($uploader->fetchMedia($request['xoops_upload_file'][0])) {
                $prefix = is_object(icms::$user) ? strval(icms::$user->uid()) . '_' : 'iforum_';
                $uploader->setPrefix($prefix);
                if (!$uploader->upload()) {
                    $errorUpload = $uploader->getErrors();
                } elseif (is_file($uploader->getSavedDestination())) {
                    $forumpost->setAttachment($uploader->getSavedFileName(), $uploader->getMediaName(), $uploader->getMediaType());
                }
            } else {
                $errorUpload = $uploader->getErrors();
            }
        }

        $savedPostId = $postHandler->insert($forumpost);
        if (!$savedPostId) {
            return array(
                'success' => false,
                'insert_error' => true,
                'errors' => $forumpost->getErrors(),
            );
        }

        iforum_setsession('LP', time());

        if (iforum_checkSubjectPrefixPermission($forumObj) && !empty($request['subject_pre'])) {
            $postHandler->insertnewsubject($forumpost->getVar('topic_id'), (int)$request['subject_pre']);
        }

        if (iforum_tag_module_included() && !empty(icms::$module->config['allow_tagging']) && $forumpost->isTopic() && @include_once ICMS_ROOT_PATH . '/modules/tag/include/functions.php') {
            $topic = $topicHandler->get($forumpost->getVar('topic_id'));
            $topic->setVar('topic_tags', @$request['topic_tags']);
            if ($tagHandler = tag_getTagHandler()) {
                $tagHandler->updateByItem(@$request['topic_tags'], $forumpost->getVar('topic_id'), icms::$module->getVar('dirname'), 0);
            }
            $topicHandler->updateAll('topic_tags', @$request['topic_tags'], new icms_db_criteria_Item('topic_id', $forumpost->getVar('topic_id')));
            if ($tagHandler = @xoops_getmodulehandler('tag', 'tag', true)) {
                $tagHandler->updateByItem(@$request['topic_tags'], $forumpost->getVar('topic_id'));
            }
        }

        if ($approved && !empty(icms::$module->config['notification_enabled']) && !empty($isNew)) {
            $tags = array();
            $tags['THREAD_NAME'] = $request['subject'];
            $tags['THREAD_URL'] = ICMS_URL . '/modules/' . icms::$module->getVar('dirname') . '/viewtopic.php?post_id=' . $savedPostId . '&amp;topic_id=' . $forumpost->getVar('topic_id') . '&amp;forum=' . $forumpost->getVar('forum_id');
            $tags['POST_URL'] = $tags['THREAD_URL'] . '#forumpost' . $savedPostId;
            include_once ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 4)) . '/include/notification.inc.php';
            $forumInfo = iforum_notify_iteminfo('forum', $forumObj->getVar('forum_id'));
            $tags['FORUM_NAME'] = $forumInfo['name'];
            $tags['FORUM_URL'] = $forumInfo['url'];
            $notificationHandler = icms::handler('icms_data_notification');
            if (!$isReply) {
                $notificationHandler->triggerEvent('forum', $forumObj->getVar('forum_id'), 'new_thread', $tags);
            } else {
                $notificationHandler->triggerEvent('thread', $topicId, 'new_post', $tags);
            }
            $notificationHandler->triggerEvent('global', 0, 'new_post', $tags);
            $notificationHandler->triggerEvent('forum', $forumObj->getVar('forum_id'), 'new_post', $tags);
            $tags['POST_CONTENT'] = icms_core_DataFilter::stripSlashesGPC($request['message']);
            $tags['POST_NAME'] = icms_core_DataFilter::stripSlashesGPC($request['subject']);
            $notificationHandler->triggerEvent('global', 0, 'new_fullpost', $tags);
            $notificationHandler->triggerEvent('forum', $forumObj->getVar('forum_id'), 'new_fullpost', $tags);
        }

        if (!empty(icms::$user) && !empty(icms::$module->config['notification_enabled'])) {
            $notificationHandler = icms::handler('icms_data_notification');
            if (empty($request['notify'])) {
                $notificationHandler->unsubscribe('thread', $forumpost->getVar('topic_id'), 'new_post');
            } elseif ($request['notify'] > 0) {
                $notificationHandler->subscribe('thread', $forumpost->getVar('topic_id'), 'new_post');
            }
        }

        if ($approved) {
            if (!empty(icms::$module->config['cache_enabled'])) {
                iforum_setsession('t' . $forumpost->getVar('topic_id'), null);
            }
            $redirect = 'viewtopic.php?topic_id=' . $forumpost->getVar('topic_id') . '&amp;post_id=' . $savedPostId . '#forumpost' . $savedPostId;
            $message = _MD_THANKSSUBMIT . '<br />' . $errorUpload;
        } else {
            $redirect = 'viewforum.php?forum=' . $forumpost->getVar('forum_id');
            $message = _MD_THANKSSUBMIT . '<br />' . _MD_WAITFORAPPROVAL . '<br />' . $errorUpload;
        }

        if (!empty($request['op']) && $request['op'] === 'add') {
            $redirect = 'polls.php?op=add&amp;forum=' . $forumpost->getVar('forum_id') . '&amp;topic_id=' . $forumpost->getVar('topic_id');
            $message = _MD_ADDPOLL;
        }

        return array(
            'success' => true,
            'approved' => (bool)$approved,
            'redirect' => $redirect,
            'message' => $message,
            'post_id' => $savedPostId,
            'topic_id' => (int)$forumpost->getVar('topic_id'),
            'forum_id' => (int)$forumpost->getVar('forum_id'),
            'error_upload' => $errorUpload,
        );
    }
}
