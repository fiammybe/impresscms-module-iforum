<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumPostFormBuilder
{
    public static function create(array $context)
    {
        $forumObj = $context['forum_obj'];
        $topicId = (int)$context['topic_id'];
        $postId = (int)$context['post_id'];
        $pid = (int)$context['pid'];
        $start = (int)$context['start'];
        $order = (int)$context['order'];
        $viewmode = (string)$context['viewmode'];
        $subject = (string)$context['subject'];
        $message = (string)$context['message'];
        $hidden = (string)$context['hidden'];
        $subjectPre = $context['subject_pre'];
        $dohtml = (int)$context['dohtml'];
        $dosmiley = (int)$context['dosmiley'];
        $doxcode = (int)$context['doxcode'];
        $dobr = (int)$context['dobr'];
        $icon = (string)$context['icon'];
        $postKarma = (int)$context['post_karma'];
        $requireReply = (int)$context['require_reply'];
        $attachsig = (int)$context['attachsig'];
        $isedit = (int)$context['isedit'];
        $isreply = (int)$context['isreply'];
        $op = (string)$context['op'];
        $attachments = !empty($context['attachments']) ? $context['attachments'] : array();
        $attachmentsTmp = !empty($context['attachments_tmp']) ? $context['attachments_tmp'] : array();
        $posterName = (string)$context['poster_name'];
        $notify = isset($context['notify']) ? (int)$context['notify'] : 0;
        $topicTags = isset($context['topic_tags']) ? (string)$context['topic_tags'] : '';
        $forumpost = isset($context['forumpost']) ? $context['forumpost'] : null;
        $topicHandler = icms_getmodulehandler('topic', basename(dirname(__FILE__, 4)), 'iforum');
        $topicStatus = $topicHandler->get(@$topicId, 'topic_status');
        $forumFormAction = empty($context['admin_form_action']) ? 'post.php' : $context['admin_form_action'];

        $form = new icms_form_Theme('', 'forumform', $forumFormAction, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        if (iforum_checkSubjectPrefixPermission($forumObj) && $forumObj->getVar('allow_subject_prefix')) {
            $subjectAdd = new icms_form_elements_Tray(_MD_TOPIC_SUBJECTC, '');
            $subjectpres = array_map('trim', explode(',', icms::$module->config['subject_prefix']));
            if (count($subjectpres) > 1) {
                $subjectArray = array();
                foreach ($subjectpres as $subjectpre) {
                    $subjectArray[] = trim($subjectpre);
                }
                $subjectSelect = new icms_form_elements_Select('', 'subject_pre', $subjectPre);
                $subjectSelect->addOptionArray($subjectArray);
                $subjectAdd->addElement(new icms_form_elements_Label($subjectSelect->render()));
            }
            $form->addElement($subjectAdd);
        }

        $subjectForm = new icms_form_elements_Text(_MD_SUBJECTC, 'subject', 60, 100, $subject);
        $subjectForm->setExtra("tabindex='1'");
        $form->addElement($subjectForm, true);

        if (!is_object(icms::$user) && empty($context['admin_form_action'])) {
            $required = !empty(icms::$module->config['require_name']);
            $form->addElement(new icms_form_elements_Text(_MD_NAMEMAIL, 'poster_name', 60, 255, $posterName), $required);
        }

        $iconsRadio = new icms_form_elements_Radio(_MD_MESSAGEICON, 'icon', $icon);
        $subjectIcons = icms_core_Filesystem::getFileList(ICMS_ROOT_PATH . '/images/subject/', '', array('gif', 'jpg', 'png'));
        foreach ($subjectIcons as $iconfile) {
            $iconsRadio->addOption($iconfile, '<img style="vertical-align:middle;" src="' . ICMS_URL . '/images/subject/' . $iconfile . '" alt="" />');
        }
        $form->addElement($iconsRadio);

        $nohtml = ($forumObj->getVar('allow_html')) ? false : true;
        $editor = self::resolveEditor($context);
        $editorConfigs = array(
            'name' => 'message',
            'value' => $message,
            'rows' => empty(icms::$module->config['editor_rows']) ? 35 : icms::$module->config['editor_rows'],
            'cols' => empty(icms::$module->config['editor_cols']) ? 60 : icms::$module->config['editor_cols'],
            'width' => empty(icms::$module->config['editor_width']) ? '100%' : icms::$module->config['editor_width'],
            'height' => empty(icms::$module->config['editor_height']) ? '400px' : icms::$module->config['editor_height'],
        );
        include_once ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 4)) . '/class/compat/class/xoopsform/formeditor.php';
        $form->addElement(new IforumFormEditor(_MD_MESSAGEC, $editor, $editorConfigs, $nohtml, $onfailure = null));

        if (iforum_tag_module_included() && !empty(icms::$module->config['allow_tagging']) && (empty($topicId) || (is_object($forumpost) && $forumpost->isTopic()))) {
            if (@include_once ICMS_ROOT_PATH . '/modules/tag/include/formtag.php') {
                $form->addElement(new XoopsFormTag('topic_tags', 60, 255, $topicTags));
            }
        }

        $optionsTray = new icms_form_elements_Tray(_MD_OPTIONS, '<br />');
        if (is_object(icms::$user) && icms::$module->config['allow_user_anonymous'] == 1) {
            $noname = (!empty($isedit) && is_object($forumpost) && $forumpost->getVar('uid') == 0) ? 1 : 0;
            $nonameCheckbox = new icms_form_elements_Checkbox('', 'noname', $noname);
            $nonameCheckbox->addOption(1, _MD_POSTANONLY);
            $optionsTray->addElement($nonameCheckbox);
        }
        if ($editor != 'dhtmltextarea' && $forumObj->getVar('allow_html')) {
            $htmlCheckbox = new icms_form_elements_Checkbox('', 'dohtml', 1);
            $htmlCheckbox->addOption(1, _MD_DOHTML);
            $optionsTray->addElement($htmlCheckbox);
            $form->addElement(new icms_form_elements_Hidden('dobr', 0));
        } else {
            $form->addElement(new icms_form_elements_Hidden('dohtml', 0));
            $brCheckbox = new icms_form_elements_Checkbox('', 'dobr', $dobr);
            $brCheckbox->addOption(1, _MD_DOBR);
            $optionsTray->addElement($brCheckbox);
        }

        $smileyCheckbox = new icms_form_elements_Checkbox('', 'dosmiley', $dosmiley);
        $smileyCheckbox->addOption(1, _MD_DOSMILEY);
        $optionsTray->addElement($smileyCheckbox);
        $xcodeCheckbox = new icms_form_elements_Checkbox('', 'doxcode', $doxcode);
        $xcodeCheckbox->addOption(1, _MD_DOXCODE);
        $optionsTray->addElement($xcodeCheckbox);

        if ($forumObj->getVar('allow_sig') && is_object(icms::$user)) {
            $attachsigCheckbox = new icms_form_elements_Checkbox('', 'attachsig', $attachsig);
            $attachsigCheckbox->addOption(1, _MD_ATTACHSIG);
            $optionsTray->addElement($attachsigCheckbox);
        }

        if (empty($context['admin_form_action']) && is_object(icms::$user) && icms::$module->config['notification_enabled']) {
            if (empty($notify)) {
                $notificationHandler = icms::handler('icms_data_notification');
                if (!empty($topicId) && $notificationHandler->isSubscribed('thread', $topicId, 'new_post', icms::$module->getVar('mid'), icms::$user->getVar('uid'))) {
                    $notify = 1;
                }
            }
            $notifyCheckbox = new icms_form_elements_Checkbox('', 'notify', $notify);
            $notifyCheckbox->addOption(1, _MD_NEWPOSTNOTIFY);
            $optionsTray->addElement($notifyCheckbox);
        }
        $form->addElement($optionsTray);

        $permissionService = iforum_get_service('forumPermission');
        if ($permissionService && $permissionService->canAttachToForum($forumObj, (int)$topicStatus)) {
            $uploadTray = new icms_form_elements_Tray(_MD_ATTACHMENT);
            $uploadTray->addElement(new icms_form_elements_File('', 'userfile', ''));
            $uploadTray->addElement(new icms_form_elements_Button('', 'contents_upload', _MD_UPLOAD, 'submit'));
            $uploadTray->addElement(new icms_form_elements_Label('<BR /><BR />' . _MD_MAX_FILESIZE . ':', $forumObj->getVar('attach_maxkb') . 'K; '));
            $extensions = trim(str_replace('|', ' ', $forumObj->getVar('attach_ext')));
            $extensions = (empty($extensions) || $extensions == '*') ? _ALL : $extensions;
            $uploadTray->addElement(new icms_form_elements_Label(_MD_ALLOWED_EXTENSIONS . ':', $extensions));
            $form->addElement($uploadTray);
        }

        if (!empty($attachments) && is_array($attachments) && count($attachments)) {
            $deleteAttachCheckbox = new icms_form_elements_Checkbox(_MD_THIS_FILE_WAS_ATTACHED_TO_THIS_POST, 'delete_attach[]');
            foreach ($attachments as $key => $attachment) {
                $attach = _DELETE . ' <a href=' . ICMS_URL . '/' . icms::$module->config['dir_attachments'] . '/' . $attachment['name_saved'] . ' targe="_blank" >' . $attachment['name_display'] . '</a>';
                $deleteAttachCheckbox->addOption($key, $attach);
            }
            $form->addElement($deleteAttachCheckbox);
        }

        if (!empty($attachmentsTmp) && is_array($attachmentsTmp) && count($attachmentsTmp)) {
            $deleteAttachCheckbox = new icms_form_elements_Checkbox(_MD_REMOVE, 'delete_tmp[]');
            $urlPrefix = str_replace(ICMS_ROOT_PATH, ICMS_URL, XOOPS_CACHE_PATH);
            foreach ($attachmentsTmp as $key => $attachment) {
                $attach = ' <a href="' . $urlPrefix . '/' . $attachment[0] . '" target="_blank" >' . $attachment[1] . '</a>';
                $deleteAttachCheckbox->addOption($key, $attach);
            }
            $form->addElement($deleteAttachCheckbox);
            $form->addElement(new icms_form_elements_Hidden('attachments_tmp', base64_encode(serialize($attachmentsTmp))));
        }

        if (icms::$module->config['enable_karma'] || icms::$module->config['allow_require_reply']) {
            $viewRequire = ($requireReply) ? 'require_reply' : (($postKarma) ? 'require_karma' : 'require_null');
            $radiobox = new icms_form_elements_Radio(_MD_VIEW_REQUIRE, 'view_require', $viewRequire);
            if (icms::$module->config['allow_require_reply']) {
                $radiobox->addOption('require_reply', _MD_REQUIRE_REPLY);
            }
            if (icms::$module->config['enable_karma']) {
                $karmas = array_map('trim', explode(',', icms::$module->config['karma_options']));
                if (count($karmas) > 1) {
                    $karmaArray = array();
                    foreach ($karmas as $karma) {
                        $karmaArray[strval($karma)] = (int)$karma;
                    }
                    $karmaSelect = new icms_form_elements_Select('', 'post_karma', $postKarma);
                    $karmaSelect->addOptionArray($karmaArray);
                    $radiobox->addOption('require_karma', _MD_REQUIRE_KARMA . ($karmaSelect->render()));
                }
            }
            $radiobox->addOption('require_null', _MD_REQUIRE_NULL);
            $form->addElement($radiobox);
        }

        if (!empty(icms::$module->config['captcha_enabled'])) {
            $form->addElement(new icms_form_elements_Captcha());
        }

        if (!empty($context['admin_form_action'])) {
            $approvedRadio = new icms_form_elements_Radioyn(_AM_IFORUM_APPROVE, 'approved', 1, '' . _YES . '', ' ' . _NO . '');
            $form->addElement($approvedRadio);
        }

        if (!class_exists('XoopsSecurity')) {
            $postValid = 1;
            $_SESSION['submit_token'] = $postValid;
            $form->addElement(new icms_form_elements_Hidden('post_valid', $postValid));
        }

        $form->addElement(new icms_form_elements_Hidden('pid', $pid));
        $form->addElement(new icms_form_elements_Hidden('post_id', $postId));
        $form->addElement(new icms_form_elements_Hidden('topic_id', $topicId));
        $form->addElement(new icms_form_elements_Hidden('forum', $forumObj->getVar('forum_id')));
        $form->addElement(new icms_form_elements_Hidden('viewmode', $viewmode));
        $form->addElement(new icms_form_elements_Hidden('order', $order));
        $form->addElement(new icms_form_elements_Hidden('start', $start));
        $form->addElement(new icms_form_elements_Hidden('isreply', $isreply));
        $form->addElement(new icms_form_elements_Hidden('isedit', $isedit));
        $form->addElement(new icms_form_elements_Hidden('op', $op));

        $buttonTray = new icms_form_elements_Tray('');
        $submitButton = new icms_form_elements_Button('', 'contents_submit', _SUBMIT, 'submit');
        $submitButton->setExtra("tabindex='3'");
        $cancelButton = new icms_form_elements_Button('', 'cancel', _CANCEL, 'button');
        $extra = ($topicId > 0) ? 'viewtopic.php?topic_id=' . (int)$topicId : 'viewforum.php?forum=' . $forumObj->getVar('forum_id');
        $cancelButton->setExtra("onclick='location=\"" . $extra . "\"'");
        $cancelButton->setExtra("tabindex='6'");
        if (!empty($isreply) && !empty($hidden)) {
            $form->addElement(new icms_form_elements_Hidden('hidden', $hidden));
            $quoteButton = new icms_form_elements_Button('', 'quote', _MD_QUOTE, 'button');
            $quoteButton->setExtra("onclick='xoopsGetElementById(\"message_tarea\").value=xoopsGetElementById(\"message_tarea\").value+ xoopsGetElementById(\"hidden\").value;xoopsGetElementById(\"hidden\").value=\"\";'");
            $quoteButton->setExtra("tabindex='4'");
            $buttonTray->addElement($quoteButton);
        }
        $previewButton = new icms_form_elements_Button('', 'btn_preview', _PREVIEW, 'button');
        $previewButton->setExtra("tabindex='5'");
        $previewButton->setExtra('onclick="window.document.forms.forumform.contents_preview.value=1; window.document.forms.forumform.submit();"');
        $form->addElement(new icms_form_elements_Hidden('contents_preview', 0));
        $buttonTray->addElement($previewButton);
        $buttonTray->addElement($submitButton);
        $buttonTray->addElement($cancelButton);
        $form->addElement($buttonTray);

        return $form;
    }

    private static function resolveEditor(array $context): string
    {
        $editor = !empty($context['editor']) ? (string)$context['editor'] : '';
        if (!empty($editor)) {
            iforum_setcookie('editor', $editor);
            return $editor;
        }
        $editor = (string)iforum_getcookie('editor');
        if ($editor === '' && is_object(icms::$user)) {
            $editor = (string)icms::$user->getVar('editor');
        }
        if ($editor === '') {
            $editor = (string)icms::$module->config['editor_default'];
        }
        return $editor;
    }
}
