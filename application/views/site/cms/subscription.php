<?php
$this->load->view('site/templates/header');
?>
<link rel="stylesheet" type="text/css" media="all" href="css/site/cms.css">

        <div class="main">
    			    <div class="feature_list">
                   
    			<div class="page_title W99"><?php echo $subscription->row()->name; ?></div>
                <div class="cms_txt">
                	<?php echo $subscription->row()->description; ?> <br />
                    <?php echo "Price $ ".$subscription->row()->price; ?>
                </div>
               
		    </div>
    </div>

	
<?php
$this->load->view('site/templates/footer');
?>