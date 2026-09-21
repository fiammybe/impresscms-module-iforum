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
	$filters = array();
	if (is_string($subquery) && preg_match('/^\s*AND\s+p\.post_time\s+>=\s+(\d+)\s*$/i', $subquery, $matches)) {
		$filters['min_post_time'] = (int)$matches[1];
	}
	if (is_string($subquery) && trim($subquery) !== '' && empty($filters)) {
		trigger_error('Unsupported iForum search subquery: ' . $subquery, E_USER_WARNING);
		$results = array();
		return $results;
	}
	$searchService = iforum_get_service('search');
	$results = $searchService->search($queryarray, $andor, $limit, $offset, $userid, $forums, $sortby, $searchin, $filters);
	return $results;
}
