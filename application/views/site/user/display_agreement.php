<?php $this->load->view('site/templates/header'); ?>

<div class="listing_content" style="margin:20px 0 15px 0px;">
	<div style="padding:30px;">
		<?php echo $contents; ?>
    </div>    
	<div style="text-align:center; vertical-align:middle; margin:20px;" >
    
    <a style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px; float:none !important;" class="detail_btn" href="<?php echo base_url().'displaysign/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>">Edit</a>
    <a style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px; float:none !important;" class="detail_btn" href="<?php echo base_url().'confirm-signature/'.$this->uri->segment(2).'/'.$this->uri->segment(3); ?>">Submit</a>
    </div>
</div> 
        
<?php 
  
  /*ini_set('display_errors','off');
  
  require_once("pdfdownload/dompdf_config.inc.php");
   $html = $contents;
   $orientation = 'portrait';
   $paper = 'letter';
// return_on_rentals_101-Floss-Avenue-Buffalo-NY-14211_3223 
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper($paper,$orientation);
  $dompdf->render();
  $invoice = 'return_on_rentals_agreement_'.$this->uri->segment(2).'_'.$this->uri->segment(3).'.pdf';
  $dompdf->stream($invoice); */  
        
?>        

<!----------listing end content-------------->

</div>
<div class="clear"></div>


	

 </div>
	 </div>
<?php $this->load->view('site/templates/footer'); ?>