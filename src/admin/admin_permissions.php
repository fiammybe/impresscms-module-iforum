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

include 'admin_header.php';
include_once ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 2)) . '/include/functions.ipf.php';
include_once ICMS_ROOT_PATH . '/modules/' . basename(dirname(__FILE__, 2)) . '/class/form/AdminPermissionForms.php';

/**
* Add category navigation to forum casscade structure
* <ol>Special points:
* <li> Use negative values for category IDs to avoid conflict between category and forum
* <li> Disabled checkbox for categories to avoid unnecessary permission items for categories in forum permission table
* </ol>
*
* Note: this is a __patchy__ solution. We should have a more extensible and flexible group permission management: not only for data architecture but also for management interface
*/

icms_cp_header();

loadModuleAdminMenu(3, _AM_IFORUM_PERM_PERMISSIONS );

$action = isset($_REQUEST['action']) ? strtolower($_REQUEST['action']) : "";
$module_id = icms::$module->getVar('mid');
$permission_service = iforum_get_service('adminPermission');
$perms = $permission_service->getPermissionKeys();
$action_options = $permission_service->getActionOptions();

switch($action)
{
	case "template":
	$opform = IforumAdminPermissionForms::createActionForm($action_options, 'template');
	$opform->display();

	$member_handler = icms::handler('icms_member');
	$glist = $member_handler->getGroupList();
	$iforumperm_handler =icms_getmodulehandler('permission', basename(dirname(__FILE__, 2)), 'iforum' );
	$perm_template = $iforumperm_handler->getTemplate($groupid = 0);
	$tray = new icms_form_elements_Tray('');
	$tray->addElement(new icms_form_elements_Hidden('action', 'template_save'));
	$tray->addElement(new icms_form_elements_Button('', 'submit', _SUBMIT, 'submit'));
	$tray->addElement(new icms_form_elements_Button('', 'reset', _CANCEL, 'reset'));
	$ret = '<h4>' . _AM_IFORUM_PERM_TEMPLATE . '</h4>' . _AM_IFORUM_PERM_TEMPLATE_DESC . '<br /><br /><br />';
	$ret .= "<form name='template' id='template' method='post'>\n<table width='100%' class='outer' cellspacing='1'>\n";
	$ret .= $permission_service->renderTemplateRows($glist, $perms, is_array($perm_template) ? $perm_template : array());
	$ret .= '<tr align="left" valign="top"><td class="head"></td><td class="even">';
	$ret .= $tray->render();
	$ret .= '</td></tr>';
	$ret .= '</table></form>';
	echo $ret;
	break;

	case "template_save":
	$iforumperm_handler =icms_getmodulehandler('permission', basename(dirname(__FILE__, 2)), 'iforum' );
	$res = $iforumperm_handler->setTemplate($_POST['perms'], $groupid = 0);
	if ($res)
	{
		redirect_header("admin_permissions.php?action=template", 2, _AM_IFORUM_PERM_TEMPLATE_CREATED);
	}
	else
	{
		redirect_header("admin_permissions.php?action=template", 2, _AM_IFORUM_PERM_TEMPLATE_ERROR);
	}
	break;

	case "apply":
	$iforumperm_handler =icms_getmodulehandler('permission', basename(dirname(__FILE__, 2)), 'iforum' );
	$perm_template = $iforumperm_handler->getTemplate();
	if ($perm_template === null)
	{
		redirect_header("admin_permissions.php?action=template", 2, _AM_IFORUM_PERM_TEMPLATE);
	}

	$opform = IforumAdminPermissionForms::createActionForm(array("no" => _SELECT, "template" => _AM_IFORUM_PERM_TEMPLATE, "apply" => _AM_IFORUM_PERM_TEMPLATEAPP), 'apply');
	$opform->display();
	$fmform = IforumAdminPermissionForms::createApplyTemplateForm($permission_service->getForumCategoryOptions());
	$fmform->display();
	break;

	case "apply_save":
	if (empty($_POST["forums"])) break;
	$iforumperm_handler = icms_getmodulehandler('permission', basename(dirname(__FILE__, 2)), 'iforum' );
	foreach($_POST["forums"] as $forum)
	{
		if ($forum < 1) continue;
		$iforumperm_handler->applyTemplate($forum, $module_id);
	}
	redirect_header("admin_permissions.php", 2, _AM_IFORUM_PERM_TEMPLATE_APPLIED);
	break;

	default:

	$opform = IforumAdminPermissionForms::createActionForm($action_options, $action);
	$opform->display();

	$forum_handler = icms_getmodulehandler('forum', basename(dirname(__FILE__, 2)), 'iforum' );
	$forums = $forum_handler->getForumsByCategory(0, '', false);
	list($op_options, $fm_options) = $permission_service->getPermissionFormOptions($perms);

	$op_keys = array_keys($op_options);
	$op = isset($_GET['op']) ? strtolower($_GET['op']) :
	 (isset($_COOKIE['op']) ? strtolower($_COOKIE['op']):"");
	if (empty($op))
	{
		$op = $op_keys[0];
		setCookie("op", isset($op_keys[1])?$op_keys[1]:"");
	}
	else
	{
		for($i = 0; $i < count($op_keys); $i++)
		{
			if ($op_keys[$i] == $op) break;
		}
		setCookie("op", isset($op_keys[$i+1])?$op_keys[$i+1]:"");
	}

	$opform = IforumAdminPermissionForms::createPermissionOpForm($op_options, $op);
	$opform->display();

	$perm_desc = "";

	$form = new icms_form_Groupperm($fm_options[$op]["title"], $module_id, $fm_options[$op]["item"], $fm_options[$op]["desc"], 'admin/admin_permissions.php', $fm_options[$op]["anonymous"]);

	$category_handler = icms_getmodulehandler('category', basename(dirname(__FILE__, 2)), 'iforum' );
	$categories = $category_handler->getAllCats("", true);
	if ($op == "category")
	{
		foreach (array_keys($categories) as $c)
		{
			$form->addItem($c, $categories[$c]->getVar('cat_title'));
		}
		unset($categories);
	}
	else
	{
		foreach (array_keys($categories) as $c)
		{
			$key_c = -1 * $c;
			$form->addItem($key_c, "<strong>[".$categories[$c]->getVar('cat_title')."]</strong>");
			if($forums[$c]) {
                foreach(array_keys($forums[$c]) as $f)
                {
                    $form->addItem($f, $forums[$c][$f]["title"], $key_c);
                    if (!isset($forums[$c][$f]["sub"])) continue;
                    foreach(array_keys($forums[$c][$f]["sub"]) as $s)
                    {
                        $form->addItem($s, "&rarr;".$forums[$c][$f]["sub"][$s]["title"], $f);
                    }
                }
            }
		}
		unset($forums, $categories);
	}
	$form->display();

	break;
}

icms_cp_footer();
?>
