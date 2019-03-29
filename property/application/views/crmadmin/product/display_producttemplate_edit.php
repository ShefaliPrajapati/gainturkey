<?php $this->load->view('crmadmin/templates/header.php'); ?>

<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add Document Template</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('crmadmin/product/insertEditdocumentModule',$attributes) 
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
                                    <input name="property_address" style=" width:295px" id="property_address" type="text" tabindex="1" class="tipTop" title="Please enter the email templete subject" value="<?php echo $detailsSold->row()->prop_address; ?>"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="news_descrip">Template Description  </label>
									<div class="form_input">
                                    <textarea name="description" style=" width:295px" class="tipTop mceEditor" title="Please enter the email templete description"></textarea>
                                    <br />
                                    <span style="color:#FF0000;">*Note: Please Add the signature, which place copy and paste that word {$SIGNATURE} <br />*Note: Please Add the initial, which place copy and paste that word {$INITIAL}</span>
									</div>
								</div>
								</li>
								<input type="hidden" name="reserve_id" id="reserve_id" value="<?php echo $reserve_id; ?>"/>
                                <input type="hidden" name="property_id" id="property_id" value="<?php echo $property_id; ?>"/>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>"/>
                                <input type="hidden" name="agree_module" id="agree_module" value="<?php echo $agree_module; ?>"/>
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
