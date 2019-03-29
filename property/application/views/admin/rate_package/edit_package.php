<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Rental Rate Package</h6>
                        <div id="widget_tab">
              				<ul>
               					 <li><a href="#tab1" class="active_tab">Rental Rate Package</a></li>
               					 
             				 </ul>
            			</div>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'commentForm');
						echo form_open('admin/rate_package/insertEditPackage',$attributes) 
					?>  		
                    	<div id="tab1">
	 						<ul>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="name">Package Name <span class="req">*</span></label>
									<div class="form_input">
                                    <input name="name" style=" width:295px" id="name" value="<?php echo $package_details->row()->name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the package name"/>
									</div>
								</div>
								</li>
                                
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="status">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" <?php if ($package_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
                               
								<input type="hidden" name="id" value="<?php echo $package_details->row()->id;?>"/>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
									</div>
								</div>
								</li>
							</ul>
                        </div>
                        
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