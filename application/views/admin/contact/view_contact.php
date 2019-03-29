<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Contact</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
								<div class="form_grid_12">
									<label class="field_title" for="firstname">First Name </label>
									<div class="form_input">
                                    <?php echo ucfirst($contact_details->row()->firstname);?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="firstname">Last Name </label>
									<div class="form_input">
                                    <?php echo ucfirst($contact_details->row()->lastname);?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="email"> E-mail Address </label>
									<div class="form_input">
                                    <?php echo $contact_details->row()->email;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Comments </label>
									<div class="form_input">
                                   <?php echo $contact_details->row()->message;?>
									</div>
								</div>
								</li>
	 							 <!-- <li>
								<div class="form_grid_12">
									<label class="field_title" for="currency_type">Reply</label>
									<div class="form_input">
                                  		<textarea name="contact_reply" tabindex="3" style="width:370px;" class="large tipTop" title="Enter reply to send"></textarea>
									</div>
								</div>
								</li>-->
	 							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<!--<input type="submit" value="Reply" class="btn_small btn_blue" />-->
										<a href="admin/contact/display_contact_list" class="tipLeft" title="Go to contact list"><span class="badge_style b_done">Back</span></a>
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
<?php 
$this->load->view('admin/templates/footer.php');
?>