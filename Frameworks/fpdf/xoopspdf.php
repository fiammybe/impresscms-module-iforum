<?php
/**
 * FPDF creator framework for XOOPS
 *
 * Supporting multi-byte languages as well as utf-8 charset
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		frameworks
 */

if (!defined('XOOPS_ROOT_PATH')){ exit(); }
if (!defined('FPDF_PATH')){ exit(); }

class xoopsPDF
{
	var $data;
	var $config;
	var $pdf_handler;
	
	function xoopsPDF($language)
	{
		$this->_load_locale(preg_replace("/[^a-z0-9_\-]/i", "", $language));
	}
	
	function initialize($orientation='P', $unit='mm', $format='A4')
	{
		require_once dirname(__FILE__)."/pdf.php";
	    $this->pdf_handler =& new PDF($orientation, $unit, $format);
	}
	
	function _encoding($charset)
	{
		$this->pdf_handler->encoding($this->data, $charset);
		$this->pdf_handler->encoding($this->config, $charset);
	}
	
	function output(&$pdf_data, $charset = _CHARSET)
	{
		$this->data =& $pdf_data;
		$this->_encoding($charset);
		
		$pdf_data =& $this->data;
		$pdf_config =& $this->config;
		
		$pdf =& $this->pdf_handler;
		
		$puff = "<br />";
		$puffer = "<br />";
		
		$pdf_data['title'] = $pdf_config["constant"]["title"].": ".$pdf_data['title'];
		if (!empty($pdf_data['subtitle'])){
			$pdf_data['subtitle'] = $pdf_config["constant"]["subtitle"].": ".$pdf_data['subtitle'];
		}
		if (!empty($pdf_data['subsubtitle'])){
			$pdf_data['subsubtitle'] = $pdf_config["constant"]["subsubtitle"].": ".$pdf_data['subsubtitle'];
		}
		$pdf_data['author'] = $pdf_config["constant"]["author"].': '.$pdf_data['author'];
		$pdf_data['date'] = $pdf_config["constant"]["date"]. ': '.$pdf_data['date'];
		$pdf_data['url'] = $pdf_config["constant"]["url"]. ': '.$pdf_data['url'];
		
		$pdf->SetCreator($pdf_config["creator"]);
		$pdf->SetTitle($pdf_data["title"]);
		$pdf->SetAuthor($pdf_config["slogan"]);
		$pdf->SetSubject($pdf_data["author"]);
		$keywords = array_filter(array($pdf_config["name"], $pdf_data["url"], $pdf_data["author"], $pdf_data["title"], $pdf_data["subtitle"], $pdf_data["subsubtitle"]));
		$pdf->SetKeywords(implode(", ", $keywords));
		$pdf->SetAutoPageBreak(true,25);
		$pdf->SetMargins($pdf_config["margin"]["left"],$pdf_config["margin"]["top"],$pdf_config["margin"]["right"]);
		
		$pdf->Open();
		
		//First page
		$pdf->AddPage();
		$pdf->SetXY(24,25);
		$pdf->SetTextColor(10,60,160);
		$pdf->SetFont($pdf_config["font"]["slogan"]["family"], $pdf_config["font"]["slogan"]["style"], $pdf_config["font"]["slogan"]["size"]);
		$pdf->WriteHTML($pdf_config["slogan"], $pdf_config["scale"]);
		$pdf->Image($pdf_config["logo"]["path"],$pdf_config["logo"]["left"],$pdf_config["logo"]["top"],$pdf_config["logo"]["width"],$pdf_config["logo"]["height"],"",$pdf_config["url"]);
		$pdf->Line(25,30,190,30);
		$pdf->SetXY(25,35);
		$pdf->SetFont($pdf_config["font"]["title"]["family"],$pdf_config["font"]["title"]["style"],$pdf_config["font"]["title"]["size"]);
		$pdf->WriteHTML($pdf_data["title"],$pdf_config["scale"]);
		
		if (!empty($pdf_data['subtitle'])){
			$pdf->WriteHTML($puff,$pdf_config["scale"]);
			$pdf->SetFont($pdf_config["font"]["subtitle"]["family"],$pdf_config["font"]["subtitle"]["style"],$pdf_config["font"]["subtitle"]["size"]);
			$pdf->WriteHTML($pdf_data["subtitle"],$pdf_config["scale"]);
		}
		if (!empty($pdf_data["subsubtitle"])) {
			$pdf->WriteHTML($puff,$pdf_config["scale"]);
			$pdf->SetFont($pdf_config["font"]["subsubtitle"]["family"],$pdf_config["font"]["subsubtitle"]["style"],$pdf_config["font"]["subsubtitle"]["size"]);
			$pdf->WriteHTML($pdf_data["subsubtitle"],$pdf_config["scale"]);
		}
		
		$pdf->WriteHTML($puff,$pdf_config["scale"]);
		$pdf->SetFont($pdf_config["font"]["author"]["family"],$pdf_config["font"]["author"]["style"],$pdf_config["font"]["author"]["size"]);
		$pdf->WriteHTML($pdf_data["author"],$pdf_config["scale"]);
		$pdf->WriteHTML($puff,$pdf_config["scale"]);
		$pdf->WriteHTML($pdf_data["date"],$pdf_config["scale"]);
		$pdf->WriteHTML($puff,$pdf_config["scale"]);
		$pdf->WriteHTML($pdf_data['url'],$pdf_config["scale"]);
		$pdf->WriteHTML($puff,$pdf_config["scale"]);
		
		$pdf->SetTextColor(0,0,0);
		$pdf->WriteHTML($puffer,$pdf_config["scale"]);
		
		$pdf->SetFont($pdf_config["font"]["content"]["family"],$pdf_config["font"]["content"]["style"],$pdf_config["font"]["content"]["size"]);
		$pdf->WriteHTML($pdf_data["content"],$pdf_config["scale"]);
		
		$pdf->Output();
	}

	function _load_locale($language)
	{
		if(include_once(FPDF_PATH.'/language/'.$language.'_'.str_replace('-', '_', _CHARSET).'.php')){
		}elseif(include_once(FPDF_PATH.'/language/'.$language.'.php')){
		}elseif(!include_once(FPDF_PATH.'/language/english.php')){
			die('No Language File!');
		}
		$this->config =& $GLOBALS["pdf_config"];
	}
}
?>
