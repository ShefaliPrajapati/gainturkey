<?php
ini_set('display_errors','off');
  
  require_once("pdfdownload/dompdf_config.inc.php");
   $html = $ViewList;
   $orientation = 'portrait';
   $paper = 'letter';
// return_on_rentals_101-Floss-Avenue-Buffalo-NY-14211_3223 
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper($paper,$orientation);
  $dompdf->render();
  $invoice = 'return_on_rentals_'.$propertyAddres.'.pdf';
  $dompdf->stream($invoice);
?>

