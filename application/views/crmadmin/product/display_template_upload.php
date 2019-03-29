<?php $this->load->view('crmadmin/templates/header.php'); ?>

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
						echo form_open('crmadmin/product/uploaddocumentproduct',$attributes) 
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
									<label class="field_title" for="news_descrip">Upload Document  </label>
									<div class="form_input">
                                    <input type="file" name="uploadDocName" id="uploadDocName"  />
                                    <br />
                                    <span style="color:#FF0000;">*Note: Please Give the First line in document {STARTDOCUMENT} and  End of the document {ENDDOCUMENT}</span>
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
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Submit</span></button>
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
