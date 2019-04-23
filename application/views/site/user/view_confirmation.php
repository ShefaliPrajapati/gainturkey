<?php
unset($createdPdfFile);
$createdPdfFile = '';


$newTemp = @explode(',',$signDetails->row()->preview_images);
			
			
	$createdPdfFile.='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Gain Turnkey Property</title></head><body style="background:#FFFFFF; width:100%; margin:0; padding:0;">
<div style="width:50%; margin:0px; padding:0px;">
';

	for($i=0;$i<count($newTemp);$i++){
		
		$createdPdfFile .= '<table border="0" width="550" align="center" cellpadding="0" cellspacing="0" style="max-width: 550px;">
		<tr><img src="'.base_url().'preview-images/'.$newTemp[$i].'" alt="'.$newTemp[$i].'" width="750" /></tr></table>';
	}

$createdPdfFile.='</div></body></html>';

$newPDF = $createdPdfFile;
//echo $newPDF;

echo substr($newTemp[0],1);
//exec("convert ./preview-images/*-809gavbhjw3ptky6lu0h.jpg all.pdf");

$pdfDirectory = "./preview-images/0-809gavbhjw3ptky6lu0h.jpg";
$thumbDirectory = "./Signature/all.pdf";

//exec("convert $pdfDirectory $thumbDirectory");

	ini_set('display_errors','off');
	require_once("pdfdownload/dompdf_config.inc.php");
  	
	$dompdf = new DOMPDF();
	$dompdf->load_html($newPDF);
	//$dompdf->set_paper('letter','portrait');
	$dompdf->render();
	$finalOut = $dompdf->output();

	$file_to_save = './images/crm-popup-images/'.$invoicename;
	file_put_contents($file_to_save, $finalOut);
	
	$dompdf->stream($invoicename);
  
?>

