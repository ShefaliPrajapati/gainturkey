<?php $this->load->view('site/templates/new_header'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <div>
                <?php echo $contents; ?>
            </div>
            <div style="text-align:center; vertical-align:middle; margin:20px;">

                <a class="btn btn-sm"
                   href="<?php echo base_url() . 'displaysign/' . $this->uri->segment(2) . '/' . $this->uri->segment(3); ?>"
                   style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px; float:none !important; background: #de8940; border: none; border-radius: 0px; color: white;">Edit</a>
                <a class="btn btn-sm"
                   href="<?php echo base_url() . 'confirm-signature/' . $this->uri->segment(2) . '/' . $this->uri->segment(3); ?>"
                   style="text-decoration:none; margin-left:5px; padding:3px 11px 3px 11px; float:none !important; background: #de8940; border: none; border-radius: 0px; color: white;">Submit</a>
            </div>
        </div>
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
<?php $this->load->view('site/templates/new_footer'); ?>
