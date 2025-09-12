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

if (!defined("ICMS_ROOT_PATH"))
{
	exit();
}

/**
 * Forum object class for iForum
 */
class Forum extends icms_ipf_Object {

	/**
	 * Constructor
	 *
	 * @param object $handler IforumForumHandler object
	 * @param array $data array of forum data
	 */
	function __construct(&$handler, $data = array())
	{
		$this->initVar('forum_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('forum_name', XOBJ_DTYPE_TXTBOX, null, true, 255);
		$this->initVar('forum_desc', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('forum_moderator', XOBJ_DTYPE_ARRAY, serialize(array()), false);
		$this->initVar('forum_topics', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('forum_posts', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('forum_last_post_id', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('cat_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('forum_type', XOBJ_DTYPE_INT, 0, false); // 0 - active; 1 - inactive
		$this->initVar('parent_forum', XOBJ_DTYPE_INT, 0, false);
		$this->initVar('allow_html', XOBJ_DTYPE_INT, 0, false); // To be added in 3.01: 0 - disabled; 1 - enabled; 2 - checked by default
		$this->initVar('allow_sig', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('allow_subject_prefix', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('hot_threshold', XOBJ_DTYPE_INT, 20, false);
		$this->initVar('allow_polls', XOBJ_DTYPE_INT, 0, false);
		//$this->initVar('allow_attachments', XOBJ_DTYPE_INT);
		$this->initVar('attach_maxkb', XOBJ_DTYPE_INT, 100, false);
		$this->initVar('attach_ext', XOBJ_DTYPE_TXTAREA, "zip|jpg|gif", false);
		$this->initVar('forum_order', XOBJ_DTYPE_INT, 99, false);
		/*
		* For desc
		*
		*/
		$this->initVar("dohtml", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("dosmiley", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("doxcode", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("doimage", XOBJ_DTYPE_INT, 1, false);
		$this->initVar("dobr", XOBJ_DTYPE_INT, 1, false);

		parent::__construct($handler, $data);
	}

	// Get moderators in uname or in uid
	function &getModerators($asUname = false)
	{
		static $_cachedModerators = array();

		$moderators = array_filter($this->getVar('forum_moderator'));
		if (!$asUname) return $moderators;

		$moderators_return = array();
		$moderators_new = array();
		foreach($moderators as $id)
		{
			if ($id == 0) continue;
			if (isset($_cachedModerators[$id])) $moderators_return[$id] = &$_cachedModerators[$id];
			else $moderators_new[] = $id;
		}
		if (count($moderators_new) > 0)
		{
			include_once ICMS_ROOT_PATH.'/modules/'.basename(dirname(dirname(__FILE__ ) ) ).'/include/functions.php';
			$moderators_new = iforum_getUnameFromIds($moderators_new);
			foreach($moderators_new as $id => $name)
			{
				$_cachedModerators[$id] = $name;
				$moderators_return[$id] = $name;
			}
		}
		return $moderators_return;
	}

	// deprecated
	function isSubForum()
	{
		return ($this->getVar('parent_forum') > 0);
	}

	function disp_forumModerators($valid_moderators = 0)
	{
		global $myts;

		$ret = "";
		if ($valid_moderators === 0)
		{
			$valid_moderators = $this->getModerators();
		}
		if (empty($valid_moderators) || !is_array($valid_moderators))
		{
			return $ret;
		}
		include_once ICMS_ROOT_PATH.'/modules/'.basename(dirname(dirname(__FILE__ ) ) ).'/include/functions.php';
		$moderators = iforum_getUnameFromIds($valid_moderators, !empty(icms::$module->config['show_realname']), true);
		$ret = implode(", ", $moderators);
		return $ret;
	}
}
