<?php
// $Id: functions.php,v 1.3 2005/10/19 17:20:33 phppp Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')){ exit(); }

if(defined("NEWBB_FUNCTIONS_INI")) return; define("NEWBB_FUNCTIONS_INI",1);

//@include_once(XOOPS_ROOT_PATH."/Frameworks/art/functions.php");

function newbb_load_object()
{
	if(class_exists("ArtObject")) return;
	if(!defined("XOOPS_PATH") || !@include_once(XOOPS_PATH."/Frameworks/art/object.php")){
		@include_once(XOOPS_ROOT_PATH."/Frameworks/art/object.php");
	}
}

function newbb_message( $message )
{
	global $xoopsModuleConfig;
	if(!empty($xoopsModuleConfig["do_debug"])){
		if(is_array($message) || is_object($message)){
			echo "<div><pre>";print_r($message);echo "</pre></div>";
		}else{
			echo "<div>$message</div>";
		}
	}
	return;
}

function getConfigForBlock()
{
	static $newbbConfig;
	if(isset($newbbConfig)){
		return $newbbConfig;
	}
	
    if(is_object($GLOBALS["xoopsModule"]) && $GLOBALS["xoopsModule"]->getVar("dirname") == "newbb"){
	    $newbbConfig =& $GLOBALS["xoopsModuleConfig"];
    }else{
		$module_handler = &xoops_gethandler('module');
		$newbb = $module_handler->getByDirname('newbb');
	
	    $config_handler = &xoops_gethandler('config');
	    $criteria = new CriteriaCompo(new Criteria('conf_modid', $newbb->getVar('mid')));
	    $criteria->add(new Criteria('conf_name', "('show_realname', 'subject_prefix', 'allow_require_reply')", "IN"));
	    $configs =& $config_handler->getConfigs($criteria);
	    foreach(array_keys($configs) as $i){
		    $newbbConfig[$configs[$i]->getVar('conf_name')] = $configs[$i]->getConfValueForOutput();
	    }
	    unset($configs);
    }
    return $newbbConfig;
}


// Backword compatible
function newbb_load_lang_file( $filename, $module = '', $default = 'english' )
{
	if(function_exists("xoops_load_lang_file")){
		return xoops_load_lang_file($filename, $module, $default);
	}
	
	$lang = $GLOBALS['xoopsConfig']['language'];
	$path = XOOPS_ROOT_PATH . ( empty($module) ? '/' : "/modules/$module/" ) . 'language';
	if ( !( $ret = @include_once( "$path/$lang/$filename.php" ) ) ) {
		$ret = @include_once( "$path/$default/$filename.php" );
	}
	return $ret;
}

// Adapted from PMA_getIp() [phpmyadmin project]
function newbb_getIP($asString = false)
{
    // Gets the proxy ip sent by the user
    $proxy_ip     = '';
    if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $proxy_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (!empty($_SERVER["HTTP_X_FORWARDED"])) {
        $proxy_ip = $_SERVER["HTTP_X_FORWARDED"];
    } else if (!empty($_SERVER["HTTP_FORWARDED_FOR"])) {
        $proxy_ip = $_SERVER["HTTP_FORWARDED_FOR"];
    } else if (!empty($_SERVER["HTTP_FORWARDED"])) {
        $proxy_ip = $_SERVER["HTTP_FORWARDED"];
    } else if (!empty($_SERVER["HTTP_VIA"])) {
        $proxy_ip = $_SERVER["HTTP_VIA"];
    } else if (!empty($_SERVER["HTTP_X_COMING_FROM"])) {
        $proxy_ip = $_SERVER["HTTP_X_COMING_FROM"];
    } else if (!empty($_SERVER["HTTP_COMING_FROM"])) {
        $proxy_ip = $_SERVER["HTTP_COMING_FROM"];
    }

    if (!empty($proxy_ip) &&
        $is_ip = ereg('^([0-9]{1,3}\.){3,3}[0-9]{1,3}', $proxy_ip, $regs) &&
        count($regs) > 0
  	) {
      	$the_IP = $regs[0];
  	}else{
      	$the_IP = $_SERVER['REMOTE_ADDR'];	      	
  	}
    
  	$the_IP = ($asString)?$the_IP:ip2long($the_IP);
  	
  	return $the_IP;
}

function newbb_formatTimestamp($time, $format="c", $timeoffset="")
{
	$format = strtolower($format);
	if($format=="reg"||$format=="") {
		$format = "c";
	}
	if(class_exists("XoopsLocal") && is_callable(array("XoopsLocal", "formatTimestamp")) && defined("_TODAY")){
		return XoopsLocal::formatTimestamp($time, $format, $timeoffset);
	}
	
    global $xoopsConfig, $xoopsUser;
    if(strtolower($format) == "rss" ||strtolower($format) == "r"){
    	$TIME_ZONE = "";
    	if(!empty($GLOBALS['xoopsConfig']['server_TZ'])){
			$server_TZ = abs(intval($GLOBALS['xoopsConfig']['server_TZ']*3600.0));
			$prefix = ($GLOBALS['xoopsConfig']['server_TZ']<0)?" -":" +";
			$TIME_ZONE = $prefix.date("Hi",$server_TZ);
		}
		$date = gmdate("D, d M Y H:i:s", intval($time)).$TIME_ZONE;
		return $date;
	}
	
    $usertimestamp = xoops_getUserTimestamp($time, $timeoffset);
    switch (strtolower($format)) {
    case 's':
        $datestring = _SHORTDATESTRING;
        break;
    case 'm':
        $datestring = _MEDIUMDATESTRING;
        break;
    case 'mysql':
        $datestring = "Y-m-d H:i:s";
        break;
    case 'rss':
    	$datestring = "r";
        break;
    case 'l':
        $datestring = _DATESTRING;
        break;
    case 'c':
    case 'custom':
    default:
    	newbb_load_lang_file("main", "newbb");
        $current_timestamp = xoops_getUserTimestamp(time(), $timeoffset);
        if(date("Ymd", $usertimestamp) == date("Ymd", $current_timestamp)){
			$datestring = _MD_TODAY;
		}elseif(date("Ymd", $usertimestamp+24*60*60) == date("Ymd", $current_timestamp)){
			$datestring = _MD_YESTERDAY;
		}elseif(date("Y", $usertimestamp) == date("Y", $current_timestamp)){
			$datestring = _MD_MONTHDAY;
		}else{
			$datestring = _MD_YEARMONTHDAY;
		}
        break;
    }

    return date($datestring, $usertimestamp);
}
?>