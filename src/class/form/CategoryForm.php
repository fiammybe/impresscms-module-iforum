<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumCategoryForm
{
    public static function create($category, int $catId = 0)
    {
        if ($catId > 0) {
            $form = new icms_form_Theme(_AM_IFORUM_EDITCATEGORY . ' ' . $category->getVar('cat_title'), 'op', xoops_getenv('PHP_SELF'));
        } else {
            $form = new icms_form_Theme(_AM_IFORUM_CREATENEWCATEGORY, 'op', xoops_getenv('PHP_SELF'));
            $category->setVar('cat_title', '');
            $category->setVar('cat_image', 'blank.gif');
            $category->setVar('cat_description', '');
            $category->setVar('cat_order', 0);
            $category->setVar('cat_url', 'http://www.impresscms.org ImpressCMS');
        }

        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_SETCATEGORYORDER, 'cat_order', 5, 10, $category->getVar('cat_order')), false);
        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_CATEGORY, 'title', 50, 80, $category->getVar('cat_title', 'E')), true);
        $form->addElement(new icms_form_elements_Dhtmltextarea(_AM_IFORUM_CATEGORYDESC, 'catdescript', $category->getVar('cat_description', 'E'), 10, 60), false);

        $imgdir = '/modules/' . icms::$module->getVar('dirname') . '/images/category';
        if (!$category->getVar('cat_image')) {
            $category->setVar('cat_image', 'blank.gif');
        }
        $graph_array = icms_core_Filesystem::getFileList(ICMS_ROOT_PATH . $imgdir . '/', '', array('gif', 'jpg', 'png'));
        array_unshift($graph_array, _NONE);
        $indeximage_select = new icms_form_elements_Select('', 'indeximage', $category->getVar('cat_image'));
        $indeximage_select->addOptionArray($graph_array);
        $indeximage_select->setExtra("onchange=\"showImgSelected('img', 'indeximage', '/" . $imgdir . "/', '', '" . ICMS_URL . "')\"");
        $indeximage_tray = new icms_form_elements_Tray(_AM_IFORUM_IMAGE, '&nbsp;');
        $indeximage_tray->addElement($indeximage_select);
        $indeximage_tray->addElement(new icms_form_elements_Label('', "<br /><img src='" . ICMS_URL . $imgdir . "/" . $category->getVar('cat_image') . " 'name='img' id='img' alt='' />"));
        $form->addElement($indeximage_tray);

        $form->addElement(new icms_form_elements_Text(_AM_IFORUM_SPONSORLINK, 'sponurl', 50, 80, $category->getVar('cat_url', 'E')), false);
        $form->addElement(new icms_form_elements_Hidden('cat_id', $catId));

        $button_tray = new icms_form_elements_Tray('', '');
        $button_tray->addElement(new icms_form_elements_Hidden('op', 'save'));
        $butt_save = new icms_form_elements_Button('', '', _SUBMIT, 'submit');
        $butt_save->setExtra("onclick=\"this.form.elements.op.value='save'\"");
        $button_tray->addElement($butt_save);
        if ($catId) {
            $butt_cancel = new icms_form_elements_Button('', '', _CANCEL, 'submit');
            $butt_cancel->setExtra("onclick=\"this.form.elements.op.value='default'\"");
            $button_tray->addElement($butt_cancel);
        }
        $form->addElement($button_tray);

        return $form;
    }
}
