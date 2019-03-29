<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Slider Details</h6>
						<div id="widget_tab">
			              <ul>
			                <li><a href="#tab1" class="active_tab">Details</a></li>
			              </ul>
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
									<label class="field_title">Slider Image</label>
									<div class="form_input">
									<?php if ( $slider_details->row()->image == ''){?>
										<img src="<?php echo base_url();?>images/users/user-thumb1.png" width="100px"/>
									<?php }else {?>
										<img src="<?php echo base_url();?>images/slider/<?php echo $slider_details->row()->image;?>" width="100px"/>
									<?php }?>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Slider Name</label>
									<div class="form_input">
										<?php echo $slider_details->row()->slider_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Slider Title</label>
									<div class="form_input">
										<?php echo $slider_details->row()->slider_title;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_desc">Slider Description</label>
									<div class="form_input">
										<?php echo $slider_details->row()->slider_desc;?>
									</div>
								</div>
								</li>
                                 <li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_desc">Site</label>
									<div class="form_input">
										<?php if($slider_details->row()->site == 'main')
												{
													echo "Retutnonrentals";	
												}
												else if($slider_details->row()->site == 'sub')
												{
													echo "Preigrentals";	
												}
												?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="slider_link">Slider Link</label>
									<div class="form_input">
										<?php echo $slider_details->row()->slider_link;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/slider/display_slider_list" class="tipLeft" title="Go to sliders list"><span class="badge_style b_done">Back</span></a>
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