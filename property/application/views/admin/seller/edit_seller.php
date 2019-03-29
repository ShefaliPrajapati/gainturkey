<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Renter</h6>
						
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form', 'enctype' => 'multipart/form-data');
						echo form_open('admin/seller/insertEditSeller',$attributes) 
					?>
	 						<div id="tab1">
	 						<ul>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Renter Name</label>
									<div class="form_input">
										<?php echo $seller_details->row()->first_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="brand_name">Email</label>
									<div class="form_input">
										<?php echo $seller_details->row()->email;?>
									</div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="brand_description">Full Name</label>
									<div class="form_input">
										<?php echo $seller_details->row()->full_name;?>
									</div>
								</div>
								</li> -->
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="brand_description">User Image</label>
									<div class="form_input">
										                                      
										<input name="thumbnail" id="thumbnail" type="file" tabindex="7" class="large tipTop" title="Please select user image"/>
									</div>
									<div class="form_input"><img src="<?php echo base_url();?>images/users/<?php echo $seller_details->row()->thumbnail;?>" width="100px"/></div>
									
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="web_url">Status</label>
									<div class="form_input">
										<div class="active_inactive">
                                        
                                        <input type="checkbox" name="status" <?php if ($seller_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
                                        </div>
									</div>
								</div>
								</li>
								<!--<li>
								<div class="form_grid_12">
									<label class="field_title" for="commision">Commision (%)</label>
									<div class="form_input">
										<input type="text" name="commision" value="<?php echo $seller_details->row()->commision;?>" class="tipTop large" title="Enter the commision percentage" />
									</div>
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
						</div>
						<div id="tab2">
							
						</div>
						<input type="hidden" name="seller_id" value="<?php echo $seller_details->row()->id;?>"/>
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