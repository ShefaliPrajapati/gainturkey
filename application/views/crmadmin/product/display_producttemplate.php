<?php $this->load->view('crmadmin/templates/header.php'); ?>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script src="js/lightbox.js"></script>

<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add / Edit Document Template</h6>
					</div>
					<div class="widget_content">
					<?php
                        $attributes = array('class' => 'form_container left_label', 'id' => 'commentForm', 'enctype' => 'multipart/form-data');
                        echo form_open('crmadmin/product/insertEditdocumentModule', $attributes)
                    ?>

	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_title">Property Id</label>
									<div class="form_input">
                                    <input name="rental_id" style=" width:295px" id="rental_id" value="<?php echo $detailsSold->row()->rental_id; ?>" type="text" tabindex="1" class="tipTop" title="Please enter the email templete name" readonly="readonly"/>
									</div>
								</div>
								</li>
								
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_subject">Property Address</label>
									<div class="form_input">
                                    <input name="prop_address" style=" width:295px" id="prop_address" type="text" tabindex="1" class="tipTop" title="Please enter the email templete subject" value="<?php echo $detailsSold->row()->prop_address; ?>"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_descrip">Upload Pdf  </label>
									<div class="form_input">
                                    <?php if ($detailsSold->row()->upload_images != '') {
                        $imgName = @explode(',', $detailsSold->row()->upload_images);
                        for ($i=0;$i<sizeof($imgName);$i++) {
                            ?>
                                    		<a href="images/pdf-images/<?php echo $imgName[$i]; ?>" rel="lightbox[]" title="<?php echo $imgName[$i]; ?>"><img src="images/pdf-images/<?php echo $imgName[$i]; ?>" alt="<?php echo $imgName[$i]; ?>" width="200"  /></a> 
                                    <?php
                        }
                    } else {
                        ?>
                                     <input type="file" name="upload_pdf" id="upload_pdf" accept="pdf" />
                                    <?php
                    } ?>
                                   
                                    
									</div>
								</div>
								</li>
								<input type="hidden" name="reserve_id" id="reserve_id" value="<?php echo $reserve_id; ?>"/>
                                <input type="hidden" name="property_id" id="property_id" value="<?php echo $property_id; ?>"/>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>"/>
                                <input type="hidden" name="agree_module" id="agree_module" value="<?php echo $agree_module; ?>"/>
                                <input type="hidden" name="uri_val" id="uri_val" value="<?php echo $uri_val; ?>"/>
                                <input type="hidden" name="sign_id" id="sign_id" value="<?php echo $sign_id; ?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                     <?php if ($detailsSold->row()->upload_images != '') {
                        ?>
	                                     <a href="crmadmin/product/display_product_list/<?php echo $uri_val; ?>" class="btn_small btn_blue" ><span>Back</span></a>
                                         <a href="crmadmin/product/edit_document/<?php echo $reserve_id.'/'.$property_id.'/'.$user_id.'/'.$agree_module.'/'.$uri_val.'/'.$sign_id; ?>" class="btn_small btn_blue" ><span>Edit</span></a>
                                         <a href="crmadmin/product/delete_document/<?php echo $reserve_id.'/'.$property_id.'/'.$user_id.'/'.$agree_module.'/'.$uri_val.'/'.$sign_id; ?>" class="btn_small btn_blue" ><span>Delete</span></a>
                                         
                                     <?php
                    } else {
                        ?>
	                                  <button type="submit" class="btn_small btn_blue" id="go" tabindex="4"><span>Preview</span></button>
     	                             <?php
                    } ?>

									</div>
								</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php $this->load->view('crmadmin/templates/footer.php'); ?>
