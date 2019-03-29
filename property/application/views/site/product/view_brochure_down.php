<?php
ini_set('display_errors','off');

//==============================================================
//==============================================================
//==============================================================


require_once("mpdf/mpdf.php");

$html = $ViewList;

$mpdf=new mPDF('c','LETTER','','',12,12,12,12,9,9); 
#$mpdf->debug = true;
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

$mpdf->WriteHTML($html);
$invoice = 'return_on_rentals_'.$propertyAddres.'.pdf';
$mpdf->Output($invoice,'D');
exit;

//==============================================================
//==============================================================
//==============================================================
  
  /* require_once("pdfdownload/dompdf_config.inc.php");
   $html = $ViewList;
   $orientation = 'portrait';
   $paper = 'letter';
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper($paper,$orientation);
  $dompdf->render();
  $invoice = 'return_on_rentals_'.$propertyAddres.'.pdf';
  $dompdf->stream($invoice); */
?>

