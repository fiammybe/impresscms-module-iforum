<?php
/**
* Tag info
*
* @copyright The XOOPS project http://www.xoops.org/
* @license  http://www.fsf.org/copyleft/gpl.html GNU public license
* @author  Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
* @since  1.00
* @version  $Id$
* @package  module::iForum
*/
if (!defined('ICMS_ROOT_PATH'))
	{
	exit();
}
include_once ICMS_ROOT_PATH.'/modules/'.basename(dirname(__FILE__, 2)).'/include/functions.ipf.php';
 
/**
* Get item fields:
* title
* content
* time
* link
* uid
* uname
* tags
*
* @var  array $items associative array of items: [modid][catid][itemid]
*
* @return boolean
*
*/
 
$MyDirName = basename(dirname(__FILE__, 2));
function iforum_tag_iteminfo(&$items)
{
	$service = iforum_get_service('topicTag');
	return $service->populateTagItemInfo($items);
}
 
/**
* Remove orphan tag-item links
*
* @return boolean
*
*/
function iforum_tag_synchronization($mid)
{
	$service = iforum_get_service('topicTag');
	return $service->synchronize((int)$mid);
}
// These will try to create functions for tag plugin, if the filder has been reneamed to something else
if (!function_exists($MyDirName.'_tag_iteminfo'))
	{
	$myfunc = 'function '.$MyDirName.'_tag_iteminfo (&$items) { return iforum_tag_iteminfo($items);}';
	eval($myfunc);
}
if (!function_exists($MyDirName.'_tag_synchronization'))
	{
	$myfunc = 'function '.$MyDirName.'_tag_synchronization ($mid) { return iforum_tag_synchronization($mid);}';
	eval($myfunc);
}
