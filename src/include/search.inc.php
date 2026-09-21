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
 
if (!defined('ICMS_ROOT_PATH'))
{
	exit();
}
require_once(ICMS_ROOT_PATH.'/modules/'.basename(dirname(__FILE__, 2)).'/include/functions.php');
require_once(ICMS_ROOT_PATH.'/modules/'.basename(dirname(__FILE__, 2)).'/include/functions.ipf.php');

function &iforum_search($queryarray, $andor, $limit, $offset, $userid, $forums = 0, $sortby = 0, $searchin = "both", $subquery = "")
{
	$searchService = iforum_get_service('search');
	$results = $searchService->search($queryarray, $andor, $limit, $offset, $userid, $forums, $sortby, $searchin, $subquery);
	return $results;
}
