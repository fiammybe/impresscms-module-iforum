<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumQuickReplyForm
{
    public static function create(array $context)
    {
        global $icmsConfig;

        $forumForm = new icms_form_Theme(_MD_POSTREPLY, 'quick_reply', 'post.php', 'post', true);
        if (!is_object(icms::$user)) {
            $userTray = new icms_form_elements_Tray(_MD_ACCOUNT);
            $userTray->addElement(new icms_form_elements_Text(_MD_NAME, 'uname', 26, 255));
            $userTray->addElement(new icms_form_elements_Password(_MD_PASSWORD, 'pass', 10, 32));
            $loginCheckbox = new icms_form_elements_Checkbox('', 'login', 1);
            $loginCheckbox->addOption(1, _MD_LOGIN);
            $userTray->addElement($loginCheckbox);
            $forumForm->addElement($userTray, '');
        }

        $quickform = icms::$module->config['editor_default'];
        $editorConfigs = array(
            'caption' => _MD_MESSAGEC,
            'name' => 'message',
            'rows' => 10,
            'cols' => 60,
        );
        if (!$editorHandler = new icms_plugins_EditorHandler()) {
            if (!@include_once ICMS_ROOT_PATH . '/class/xoopseditor.php') {
                require_once ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 4)) . '/class/compat/xoopseditor/xoopseditor.php';
            }
            $editorHandler = new XoopsEditorHandler();
        }
        $editorObject = $editorHandler->get($quickform, $editorConfigs, '', 1);
        $forumForm->addElement($editorObject, true);
        $groups = (is_object(icms::$user)) ? icms::$user->getGroups() : ICMS_GROUP_ANONYMOUS;
        $gpermHandler = icms::handler('icms_member_groupperm');
        if ($icmsConfig['editor_default'] != 'dhtmltextarea' && $gpermHandler->checkRight('use_wysiwygeditor', 1, $groups, icms::$module->getVar('mid'), false) && $context['forum_obj']->getVar('allow_html')) {
            $forumForm->addElement(new icms_form_elements_Hidden('dohtml', 1));
            $forumForm->addElement(new icms_form_elements_Hidden('dobr', 0));
        } else {
            $forumForm->addElement(new icms_form_elements_Hidden('dohtml', 0));
            $forumForm->addElement(new icms_form_elements_Hidden('dobr', 1));
        }
        $forumForm->addElement(new icms_form_elements_Hidden('dosmiley', 1));
        $forumForm->addElement(new icms_form_elements_Hidden('doxcode', 1));
        $forumForm->addElement(new icms_form_elements_Hidden('attachsig', 1));
        $forumForm->addElement(new icms_form_elements_Hidden('isreply', 1));
        $forumForm->addElement(new icms_form_elements_Hidden('subject', _MD_RE . ': ' . $context['forumtopic']->getVar('topic_title', 'e')));
        $forumForm->addElement(new icms_form_elements_Hidden('pid', $context['post_id'] ? $context['post_id'] : $context['topic_handler']->getTopPostId($context['topic_id'])));
        $forumForm->addElement(new icms_form_elements_Hidden('topic_id', $context['topic_id']));
        $forumForm->addElement(new icms_form_elements_Hidden('forum', $context['forum_id']));
        $forumForm->addElement(new icms_form_elements_Hidden('viewmode', $context['viewmode']));
        $forumForm->addElement(new icms_form_elements_Hidden('order', $context['order']));
        $forumForm->addElement(new icms_form_elements_Hidden('start', $context['start']));
        if (!empty(icms::$module->config['captcha_enabled'])) {
            $forumForm->addElement(new icms_form_elements_Captcha('', 'topic_' . $context['topic_id'] . '_' . $context['start']));
        }
        if (!class_exists('XoopsSecurity')) {
            $postValid = 1;
            $_SESSION['submit_token'] = $postValid;
            $forumForm->addElement(new icms_form_elements_Hidden('post_valid', $postValid));
        }
        $forumForm->addElement(new icms_form_elements_Hidden('notify', -1));
        $forumForm->addElement(new icms_form_elements_Hidden('contents_submit', 1));
        $submitButton = new icms_form_elements_Button('', 'quick_submit', _SUBMIT, 'submit');
        $submitButton->setExtra('onclick="if(document.forms.quick_reply.message.value == \'RE\' || document.forms.quick_reply.message.value == \'\'){ alert(\'' . _MD_QUICKREPLY_EMPTY . '\'); return false;}else{ return true;}"');
        $buttonTray = new icms_form_elements_Tray('');
        $buttonTray->addElement($submitButton);
        $forumForm->addElement($buttonTray);
        return $forumForm;
    }
}
