<?php $this->load->view('site/templates/new_header'); ?>
<div class="listing_content" style="margin:20px 0 15px 0px;">
<?php
echo $ViewList;

/*ini_set('display_errors','off');
  
  require_once("pdfdownload/dompdf_config.inc.php");
   $html = $ViewList;
   $orientation = 'portrait';
   $paper = 'letter';
// return_on_rentals_101-Floss-Avenue-Buffalo-NY-14211_3223 
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper($paper,$orientation);
  $dompdf->render();
  $invoice = 'return_on_rentals_brochure'.$prdid.'.pdf';
  $dompdf->stream($invoice);*/
?>
<div style="width:100%; margin:0 auto; text-align:center; height:50px;">
<a href="<?php echo base_url().'site/product/downloadbrochure/'.$prdid; ?>" style="cursor:pointer;"><button>Download PDF</button></a>
</div>
</div>
<?php $this->load->view('site/templates/new_footer'); ?>
