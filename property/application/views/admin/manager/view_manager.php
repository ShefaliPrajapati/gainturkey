<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Manager Details</h6>
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
									<label class="field_title" for="m_email">Manager Email <span class="req">*</span></label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_email;?>
									</div>
                                     
								</div>
								</li>
                                
                               
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_first_name">Manager Name</label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_name;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_address">Manager Address </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_address;?>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_city">Manager City </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_city;?>
									</div>
                                     
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_state">Manager State </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_state;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_zipcode">Manager Zipcode </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_zipcode;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_contact_1">Manager Contact 1 </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_contact_1;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_contact_2">Manager Contact 2 </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_contact_2;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_phone_1">Manager Phone 1 </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_phone_1;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_phone_2">Manager Phone 2 </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_phone_2;?>
									</div>
                                     
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_fax">Manager Fax </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_fax;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_tenant_name">Tenant Name</label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_tenant_name;?>
									</div>
                                     
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_lease_term">Lease Term (#of Months)</label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_lease_term;?>
									</div>
                                     
								</div>
								</li>
                                
                                 
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_section">Section 8</label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_section;?>
									</div>
                                     
								</div>
								</li>
                                
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="m_fee">Manager Fees(%) </label>
									<div class="form_input">
										<?php echo $manager_details->row()->m_fee;?>
									</div>
                                     
								</div>
								</li>
								
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" disabled="disabled" name="status" <?php if ($manager_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="manager_id" value="<?php echo $manager_details->row()->id;?>"/>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/manager/display_manager_list" class="tipLeft" title="Go to managers list"><span class="badge_style b_done">Back</span></a>
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