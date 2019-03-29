<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Sourcer Details</h6>
						<div id="widget_tab">
			             
			            </div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
					<div id="tab1">
	 						<ul>
	 							
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_email">Sourcer Email <span class="req">*</span></label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_email;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_first_name">Sourcer First Name</label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_first_name;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_last_name">Sourcer Last Name  </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_last_name;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_company_name">Sourcer Company Email </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_company_name;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_address">Sourcer Address </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_address;?>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_city">Sourcer City </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_city;?>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_state">Sourcer State </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_state;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_zipcode">Sourcer Zipcode </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_zipcode;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_contact_1">Sourcer Contact 1 </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_contact_1;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_contact_2">Sourcer Contact 2 </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_contact_2;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_phone_1">Sourcer Phone 1 </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_phone_1;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_phone_2">Sourcer Phone 2 </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_phone_2;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_fax">Sourcer Fax </label>
									<div class="form_input">
										<?php echo $sourcer_details->row()->s_fax;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="s_price">Sourcer Price </label>
									<div class="form_input">
										$<?php echo $sourcer_details->row()->s_price;?>
									</div>
                                     
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" disabled="disabled" name="status" <?php if ($sourcer_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="sourcer_id" value="<?php echo $sourcer_details->row()->id;?>"/>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/sourcer/display_sourcer_list" class="tipLeft" title="Go to sourcers list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
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