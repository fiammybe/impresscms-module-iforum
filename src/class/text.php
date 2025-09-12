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
 * Text object class for iForum
 */
class Ntext extends icms_ipf_Object {

	/**
	 * Constructor
	 *
	 * @param object $handler IforumTextHandler object
	 * @param array $data array of text data
	 */
	function __construct(&$handler, $data = array())
	{
		$this->initVar('post_id', XOBJ_DTYPE_INT, null, false);
		$this->initVar('post_text', XOBJ_DTYPE_TXTAREA, null, false);
		$this->initVar('post_edit', XOBJ_DTYPE_TXTAREA, null, false);

		parent::__construct($handler, $data);
	}
}

/**
 * Text handler class for iForum
 */
class IforumTextHandler extends icms_ipf_Handler {

	/**
	 * Constructor
	 *
	 * @param object $db database connection object
	 */
	function __construct(&$db)
	{
		parent::__construct($db, 'text', 'post_id', 'Ntext');
	}

	/**
	 * Create a new text object
	 *
	 * @param bool $isNew whether the object is new
	 * @return Ntext new text object
	 */
	function &create($isNew = true)
	{
		$text = new Ntext($this);
		if ($isNew) {
			$text->setNew();
		}
		return $text;
	}

	/**
	* clean orphan items from database
	*
     * @param string $table_link
     * @param string $field_link
     * @param string $field_object
     * @return  bool true on success
	*/
	function cleanOrphan($table_link = "", $field_link = "", $field_object = "")
	{
		return parent::cleanOrphan($this->db->prefix("bb_posts"), "post_id");
	}
}
