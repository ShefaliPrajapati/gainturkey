<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Rental Rate Package</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
                            	<li>
								<div class="form_grid_12">
									<label class="field_title" for="firstname">Package Name <span class="req">*</span></label>
									<div class="form_input">
                                    <?php echo ucfirst($package_details->row()->name);?>
									</div>
								</div>
								</li>
								
	 							
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/rate_package/display_package_list" class="tipLeft" title="Go to contact list"><span class="badge_style b_done">Back</span></a>
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