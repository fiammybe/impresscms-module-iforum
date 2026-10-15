<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumAdminPermissionForms
{
    public static function createActionForm(array $options, string $action = '')
    {
        $form = new icms_form_Simple(_AM_IFORUM_PERM_ACTION, 'actionform', 'admin_permissions.php', 'get');
        $select = new icms_form_elements_Select('', 'action', $action);
        $select->setExtra('onchange="document.forms.actionform.submit()"');
        $select->addOptionArray($options);
        $form->addElement($select);
        return $form;
    }

    public static function createPermissionOpForm(array $options, string $op)
    {
        $form = new icms_form_Simple('', 'opform', 'admin_permissions.php', 'get');
        $select = new icms_form_elements_Select('', 'op', $op);
        $select->setExtra('onchange="document.forms.opform.submit()"');
        $select->addOptionArray($options);
        $form->addElement($select);
        return $form;
    }

    public static function createApplyTemplateForm(array $options)
    {
        $form = new icms_form_Theme(_AM_IFORUM_PERM_TEMPLATEAPP, 'fmform', 'admin_permissions.php', 'post');
        $select = new icms_form_elements_Select(_AM_IFORUM_PERM_FORUMS, 'forums', null, 10, true);
        $select->addOptionArray($options);
        $form->addElement($select);
        $tray = new icms_form_elements_Tray('');
        $tray->addElement(new icms_form_elements_Hidden('action', 'apply_save'));
        $tray->addElement(new icms_form_elements_Button('', 'submit', _SUBMIT, 'submit'));
        $tray->addElement(new icms_form_elements_Button('', 'reset', _CANCEL, 'reset'));
        $form->addElement($tray);
        return $form;
    }
}
