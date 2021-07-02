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

/**
* Description
*
* @param type $var description
* @return type description
* @link
*/
class Xmlrss {

	public $xml_version;
	public $rss_version;
	public $xml_encoding;

	public $channel_title;
	public $channel_link;
	public $channel_desc;
	public $channel_lastbuild;
	public $channel_webmaster;
	public $channel_editor;
	public $channel_category;
	public $channel_generator;
	public $channel_language;

	public $image_title;
	public $image_url;
	public $image_link;
	public $image_description;
	public $image_height;
	public $image_width;

	public $max_items;
	public $max_item_description;
	public $items = array();

	function __construct()
	{
		$this->xml_version = '1.0';
		$this->xml_encoding = empty(icms::$module->config['rss_utf8'])?_CHARSET:
		'UTF-8';
		$this->rss_version = '2.0';
		$this->image_height = 31;
		$this->image_width = 88;
		$this->max_items = 10;
		$this->max_item_description = 0;
		$this->items = array();
	}

	function setVarRss($var, $val)
	{
		$this->$var = $this->cleanup($val);
	}

	function addItem($title, $link, $description = '', $label = '', $pubdate = 0)
	{
		if (count($this->items) < $this->max_items)
		{
			if (!empty($label))
			{
				$label = '[' . $this->cleanup($label) . ']';
			}
			if (!empty($description))
			{
				$description = $this->cleanup($description, $this->max_item_description);
				//$description .= ' ' . $label;
			}
			else
			{
				//$description = $label;
			}

			$title = $this->cleanup($title).' ' . $label;
			$pubdate = $this->cleanup($pubdate);
			$this->items[] = array('title' => $title, 'link' => $link, 'guid' => $link, 'description' => $description, 'pubdate' => $pubdate);
		}
		 else return false;
		return true;
	}

	function cleanup($text, $trim = 0)
	{
		if (strtolower($this->xml_encoding) == "utf-8" && strncasecmp(_CHARSET, $this->xml_encoding, 5))
		{
			$text = XoopsLocal::convert_encoding($text, "utf-8");
		}
		if (!empty($trim))
		$text = icms_core_DataFilter::icms_substr($text, 0, intval($trim));
		$text = htmlspecialchars($text, ENT_QUOTES);

		return $text;
	}
}

class IforumXmlrssHandler {
	function &create()
	{
		$xmlrss = new Xmlrss();
		return $xmlrss;
	}

	function &get(&$rss)
	{
		$rss_array = array();
		$rss_array['xml_version'] = $rss->xml_version;
		$rss_array['xml_encoding'] = $rss->xml_encoding;
		$rss_array['rss_version'] = $rss->rss_version;
		$rss_array['channel_title'] = $rss->channel_title;
		$rss_array['channel_link'] = $rss->channel_link;
		$rss_array['channel_desc'] = $rss->channel_desc;
		$rss_array['channel_lastbuild'] = $rss->channel_lastbuild;
		$rss_array['channel_webmaster'] = $rss->channel_webmaster;
		$rss_array['channel_editor'] = $rss->channel_editor;
		$rss_array['channel_category'] = $rss->channel_category;
		$rss_array['channel_generator'] = $rss->channel_generator;
		$rss_array['channel_language'] = $rss->channel_language;
		$rss_array['image_title'] = $rss->channel_title;
		$rss_array['image_url'] = $rss->image_url;
		$rss_array['image_link'] = $rss->channel_link;
		$rss_array['image_width'] = $rss->image_width;
		$rss_array['image_height'] = $rss->image_height;
		$rss_array['items'] = $rss->items;

		return $rss_array;
	}

}