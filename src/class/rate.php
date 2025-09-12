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
 * Rate object class for iForum
 */
class Nrate extends icms_ipf_Object {

	/**
	 * Constructor
	 *
	 * @param object $handler IforumRateHandler object
	 * @param array $data array of rate data
	 */
	function __construct(&$handler, $data = array())
	{
		$this->initVar('ratingid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('topic_id', XOBJ_DTYPE_INT, null, true);
		$this->initVar('ratinguser', XOBJ_DTYPE_INT, null, true);
		$this->initVar('rating', XOBJ_DTYPE_INT, null, true);
		$this->initVar('ratingtimestamp', XOBJ_DTYPE_INT, null, true);
		$this->initVar('ratinghostname', XOBJ_DTYPE_TXTBOX, null, false, 255);

		parent::__construct($handler, $data);
	}
}

/**
 * Rate handler class for iForum
 */
class IforumRateHandler extends icms_ipf_Handler {

	/**
	 * Constructor
	 *
	 * @param object $db database connection object
	 */
	function __construct(&$db)
	{
		parent::__construct($db, 'rate', 'ratingid', 'Nrate');
	}

	/**
	 * Create a new rate object
	 *
	 * @param bool $isNew whether the object is new
	 * @return Nrate new rate object
	 */
	function &create($isNew = true)
	{
		$rate = new Nrate($this);
		if ($isNew) {
			$rate->setNew();
		}
		return $rate;
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
		return parent::cleanOrphan($this->db->prefix("bb_topics"), "topic_id");
	}
}
