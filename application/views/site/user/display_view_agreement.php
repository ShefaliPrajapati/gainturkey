<?php $this->load->view('site/templates/header');  ?>

<?php $uploadName = $signDetails->row()->property_id.'-'.$signDetails->row()->reserve_id.'-'.$signDetails->row()->user_id;?>
<div class="listing_content" style="margin-top:20px;">
   
	<!--<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_PATH; ?>bootstrap/css/bootstrap.css" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_PATH; ?>css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Gorditas' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_PATH; ?>css/plugins.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_PATH; ?>css/jquery.fancyProductDesigner.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_PATH; ?>css/jquery.fancyProductDesigner-fonts.css" />


	<script src="<?php echo PLUGIN_PATH; ?>js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo PLUGIN_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo PLUGIN_PATH; ?>js/fabric.js" type="text/javascript"></script>
	<script src="<?php echo PLUGIN_PATH; ?>js/plugins.min.js" type="text/javascript"></script>
    <script src="<?php echo PLUGIN_PATH; ?>js/jquery.fancyProductDesigner.min.js" type="text/javascript"></script>
    <script src="<?php echo PLUGIN_PATH; ?>jspdf/jspdf.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
	    jQuery(document).ready(function(){

	    	var yourDesigner = $('#clothing-designer').fancyProductDesigner({
	    		editorMode: false,
	    		fonts: ['Arial', 'Fearless', 'Helvetica', 'Times New Roman', 'Verdana', 'Geneva', 'Gorditas'],
	    		customTextParamters: {colors: '#000', removable: true, resizable: true, draggable: true, rotatable: true, autoCenter: true, boundingBox: "Base"},
	    		uploadedDesignsParameters: {draggable: true, removable: true, colors: '#000', autoCenter: true, boundingBox: "Base"}
	    	}).data('fancy-product-designer');

	    	//print button
			$('#print-button').click(function(){
				yourDesigner.print();
				return false;
			});

			//create an image
			$('#image-button').click(function(){
				var image = yourDesigner.createImage();
				return false;
			});

			//create a pdf with jsPDF
			$('#pdf-button').click(function(){
				var image = new Image();
				image.src = yourDesigner.getProductDataURL('jpeg');
				image.onload = function() {
					var doc = new jsPDF();
					doc.addImage(this.src, 'JPEG', 0, 0, this.width * 0.2, this.height * 0.2);
					doc.save('<?php echo $uploadName;?>-Product.pdf');
				}
				return false;
			});
			
			

			//checkout button with getProduct()
			$('#checkout-button').click(function(){
				var product = yourDesigner.getProduct();
				console.log(product);
				return false;
			});

			//event handler when the price is changing
			$('#clothing-designer')
			.bind('priceChange', function(evt, price, currentPrice) {

				$('#thsirt-price').text(currentPrice);
			});
			
			//event handler when the description is changing
			$('#clothing-designer')
			.bind('proddescChange', function(evt, prodId, currentprodId) {
			$('#ajaxLoader_desc').css('display','block');
				$.ajax({
					type:'post',
					url:'<?php echo BASE_PATH; ?>ajaxcontroller.php',
					data:{'productID':prodId},
					success: function(data) 
					{ 
						$('.plugin_content').html(data);
						$('#ProductId').val(prodId);
						$('#ajaxLoader_desc').css('display','none');
					}
				});
				
			});

			//recreate button
			$('#recreation-button').click(function(){
				var fabricJSON = JSON.stringify(yourDesigner.getFabricJSON());
				$('#recreation-form input:first').val(fabricJSON).parent().submit();
				return false;
			});

			//click handler for input upload
			$('#upload-button').click(function(){
				$('#design-upload').click();
				return false;
			});

			//save image on webserver
			$('#save-image-php').click(function() {
				$.post( "<?php echo PLUGIN_PATH; ?>php/save_image.php", { base64_image: yourDesigner.getProductDataURL()} );
			});

			//send image via mail
			$('#send-image-mail-php').click(function() {
				$.post( "<?php echo PLUGIN_PATH; ?>php/send_image_via_mail.php", { base64_image: yourDesigner.getProductDataURL()} );
			});
			
			
			//create image for checkout
			$('#continue-button').click(function(){
				
				$('#ajaxLoader').css('display','block');
				$('#continue-button').css('display','none');
				$('#pricevalue').val(yourDesigner.getProductDataURL());
				$("#pluginsubmit").submit();
				
				/*$.ajax({
					type:'post',
					url:'<?php echo PLUGIN_PATH; ?>php/save_image.php',
					data:{'base64_image':yourDesigner.getProductDataURL()},
					success: function(data) 
					{ 
				
						$('#pricevalue').val(data);
						$("#pluginsubmit").submit();
					}
				});*/
				return false;
			});

			
	    });
		
		
		
    </script>
  
  
  	<?php if($signDetails->row()->upload_images !=''){
				$newImages = @explode(',',$signDetails->row()->upload_images);
		
		 }  ?>

    	<div id="main-container" class="container">
          	<div id="clothing-designer">
              	<?php for($i=0;$i<sizeof($newImages);$i++){ ?>
	          		<div class="fpd-product" title="<?php echo $newImages[$i]; ?>" data-thumbnail="<?php echo base_url().'images/pdf-images/'.$newImages[$i]; ?>">
   			<img src="<?php echo base_url().'images/pdf-images/'.$newImages[$i]; ?>" title="Base" data-parameters='{"x": 450, "y": 600,"colors": "#FFFFFF","price": 10}' />
					<?php if($i!=0){ echo '</div>';} } ?>
			</div>
                
            <div class="fpd-design">
	  			<img src="Signature/<?php echo $signDetails->row()->user_id.'_signature.png'; ?>" title="Signature" data-parameters='{"zChangeable": true, "x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "boundingBox": "Base", "scale": 1}' />
		  		<img src="Signature/<?php echo $signDetails->row()->user_id.'_initial.png'; ?>" title="Initial" data-parameters='{"x": 215, "y": 200, "colors": "#000000", "removable": true, "draggable": true, "boundingBox": "Base"}' />
	  		</div>
	  	</div>
	  	<br />
  	<div class="row">
			  	<?php /*?><div class="col-md-2">
			  		<a href="#" id="upload-button" class="btn btn-warning">Upload own design</a>
				  	<label class="checkbox inline"><input type="checkbox" id="colorizable" /> Colorizable?</label>
			  	</div><?php */?>
			  
              
                <div class="api-buttons col-md-7">
                	
				  	<a href="javascript:void(0);" id="continue-button" class="btn btn-primary" style="float:right;">Save</a>
                    <!--<a href="javascript:void(0);" id="fpd-save-pdf" class="btn btn-primary">PDF</a>-->
                   <!-- <a href="#" id="pdf-button" class="btn btn-primary">PDF Generation</a>-->
                    
                    <span id="ajaxLoader" style="display:none; float:left; margin:0 30px 0 0;"><img src="plugin/images/fpd/ajax-loader.gif" alt="Loding" title="Loding"></span>
				  	<?php /*?><a href="#" id="image-button" class="btn btn-primary">Create Image</a>
				  	<a href="#" id="pdf-button" class="btn btn-primary">Create PDF</a>
                    <a href="#" id="print-button" class="btn btn-primary">Print</a>
				  	<a href="#" id="checkout-button" class="btn btn-success">Checkout</a>
				  	<a href="#" id="recreation-button" class="btn btn-success">Recreate product</a><?php */?>
                    <br>
                    <p style="color:#FF0000; float:right;">*Note: Please be sure to sign and initial EVERY PAGE before clicking SAVE</p>
			  	</div>
                  
               
               <div class="clear">&nbsp;</div>
                
		  	</div>
            
            <form name="pluginsubmit" id="pluginsubmit" method="post" enctype="multipart/form-data" action="site/user/previewagreementview">
            
            <input type="hidden" name="pricevalue" id="pricevalue" value="0" >
            <input type="hidden" name="templateID" id="templateID" value="<?php echo $signDetails->row()->id; ?>" >
            <input type="hidden" name="sign_id" id="sign_id" value="<?php echo $this->uri->segment(2); ?>"  />
            <input type="hidden" name="url_val" id="url_val" value="<?php echo $this->uri->segment(3); ?>"  />
            </form>

		  	<?php /*?><h4>Only working on a webserver:</h4>
		  	<button class="btn btn-info" id="save-image-php">Save image with php</button>
		  	<button class="btn btn-info" id="send-image-mail-php">Send image to mail</button>

		  	<!-- The form recreation -->
		  	<input type="file" id="design-upload" style="display: none;" />
			<form action="php/recreation.php" id="recreation-form" method="post">
				<input type="hidden" name="recreation_product" value="" />
			</form>
<?php */?>
    	</div>
    
</div>
<?php $this->load->view('site/templates/footer'); ?>