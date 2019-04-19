<?php
ini_set('display_errors','on');
  
  require_once("pdfdownload/dompdf_config.inc.php");
   $html = $ViewList;
   $orientation = 'portrait';
   $paper = 'letter';
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper($paper,$orientation);
  // $dompdf->render();
  $invoice = 'return_on_rentals_'.$propertyAddres.'.pdf';
  // $dompdf->stream($invoice);
  $dompdf->stream($invoice,array('Attachment'=>0));
?>

