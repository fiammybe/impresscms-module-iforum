<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumForumForm
{
    public static function create($forum, int $parentForum = 0, $forumHandler = null)
    {
        include_once ICMS_ROOT_PATH . '/class/xoopstree.php';

        $isNew = !$forum || $forum->isNew();
        $currentParentForum = (int)($forum ? $forum->getVar('parent_forum') : 0);

        if ($isNew) {
            $forumHandler = $forumHandler ?: icms_getmodulehandler('forum', basename(dirname(__FILE__, 3)), 'iforum');
            $forum = $forumHandler->create();
            $currentParentForum = $parentForum;
            $forum->setVar('parent_forum', $currentParentForum);
            $forum->setVar('forum_order', 0);
            $forum->setVar('forum_name', '');
            $forum->setVar('forum_desc', '');
            $forum->setVar('forum_moderator', array(1));
            $forum->setVar('forum_type', 0);
            $forum->setVar('allow_html', 1);
            $forum->setVar('allow_sig', 1);
            $forum->setVar('allow_polls', 0);
            $forum->setVar('allow_subject_prefix', 0);
            $forum->setVar('hot_threshold', 10);
            $forum->setVar('attach_maxkb', 1000);
            $forum->setVar('attach_ext', 'zip|gif|jpg');
        }

        if ($forum->getVar('forum_id')) {
            $form = new icms_form_Theme(_AM_IFORUM_EDITTHISFORUM . ' ' . $forum->getVar('forum_name'), 'op', xoops_getenv('PHP_SELF'));
        } else {
            $form = new icms_form_Theme(_AM_IFORUM_CREATENEWFORUM, 'op', xoops_getenv('PHP_SELF'));
        }

        $mytree = new XoopsTree(icms::$xoopsDB->prefix('bb_categories'), 'cat_id', '0');
        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_FORUMNAME, 'forum_name', 50, 80, $forum->getVar('forum_name', 'E')), true);
        $form->addElement(new icms_form_elements_Dhtmltextarea(_AM_IFORUM_FORUMDESCRIPTION, 'forum_desc', $forum->getVar('forum_desc', 'E'), 10, 60), false);
        $form->addElement(new icms_form_elements_Hidden('parent_forum', $forum->getVar('parent_forum')));

        if ($currentParentForum === 0) {
            $selectedCategory = (int)$forum->getVar('cat_id');
            if ($isNew && isset($_GET['cat_id'])) {
                $selectedCategory = (int)$_GET['cat_id'];
            }
            ob_start();
            $mytree->makeMySelBox('cat_title', 'cat_id', $selectedCategory);
            $form->addElement(new icms_form_elements_Label(_AM_IFORUM_CATEGORY, ob_get_clean()));
        } else {
            $forumHandler = $forumHandler ?: icms_getmodulehandler('forum', basename(dirname(__FILE__, 3)), 'iforum');
            $pf = $forumHandler->get($currentParentForum);
            $form->addElement(new icms_form_elements_Hidden('cat_id', $pf->getVar('cat_id')));
        }

        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_SET_FORUMORDER, 'forum_order', 5, 10, $forum->getVar('forum_order')), false);
        $status_select = new icms_form_elements_Select(_AM_IFORUM_STATE, 'forum_type', $forum->getVar('forum_type'));
        $status_select->addOptionArray(array('0' => _AM_IFORUM_ACTIVE, '1' => _AM_IFORUM_INACTIVE));
        $form->addElement($status_select);
        $form->addElement(new icms_form_elements_Radioyn(_AM_IFORUM_ALLOWHTML, 'allow_html', $forum->getVar('allow_html'), '' . _YES . '', ' ' . _NO . ''));
        $form->addElement(new icms_form_elements_Radioyn(_AM_IFORUM_ALLOWSIGNATURES, 'allow_sig', $forum->getVar('allow_sig'), '' . _YES . '', ' ' . _NO . ''));
        $form->addElement(new icms_form_elements_Radioyn(_AM_IFORUM_ALLOWPOLLS, 'allow_polls', $forum->getVar('allow_polls'), '' . _YES . '', ' ' . _NO . ''));
        $form->addElement(new icms_form_elements_Radioyn(_AM_IFORUM_ALLOW_SUBJECT_PREFIX, 'allow_subject_prefix', $forum->getVar('allow_subject_prefix'), '' . _YES . '', ' ' . _NO . ''));
        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_HOTTOPICTHRESHOLD, 'hot_threshold', 5, 10, $forum->getVar('hot_threshold')), true);
        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_ATTACHMENT_SIZE, 'attach_maxkb', 5, 10, $forum->getVar('attach_maxkb')), true);
        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_ALLOWED_EXTENSIONS, 'attach_ext', 50, 255, $forum->getVar('attach_ext')), true);
        $form->addElement(new icms_form_elements_select_User(_AM_IFORUM_MODERATOR, 'forum_moderator', false, $forum->getVar('forum_moderator'), 5, true));

        $perm_tray = new icms_form_elements_Tray(_AM_IFORUM_PERMISSIONS_TO_THIS_FORUM, '');
        $perm_checkbox = new icms_form_elements_Checkbox('', 'perm_template', $forum->isNew());
        $perm_checkbox->addOption(1, _AM_IFORUM_PERM_TEMPLATEAPP);
        $perm_tray->addElement($perm_checkbox);
        $perm_tray->addElement(new icms_form_elements_Label('', '<a href="admin_permissions.php?action=template" target="_blank">' . _AM_IFORUM_PERM_TEMPLATE . '</a>'));
        $form->addElement($perm_tray);

        $form->addElement(new icms_form_elements_Hidden('forum', $forum->getVar('forum_id')));
        $form->addElement(new icms_form_elements_Hidden('op', 'save'));
        $button_tray = new icms_form_elements_Tray('', '');
        $button_tray->addElement(new icms_form_elements_Button('', '', _SUBMIT, 'submit'));
        $button_tray->addElement(new icms_form_elements_Button('', '', _AM_IFORUM_CLEAR, 'reset'));
        $butt_cancel = new icms_form_elements_Button('', '', _CANCEL, 'button');
        $butt_cancel->setExtra('onclick="history.go(-1)"');
        $button_tray->addElement($butt_cancel);
        $form->addElement($button_tray);

        return $form;
    }
}
