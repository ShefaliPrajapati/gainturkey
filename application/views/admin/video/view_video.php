<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Video Details</h6>
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
	 							<!--<li>
								<div class="form_grid_12">
									<label class="field_title">Video Image</label>
									<div class="form_input">
									<?php if ( $video_details->row()->image == ''){?>
										<img src="<?php echo base_url();?>images/users/user-thumb1.png" width="100px"/>
									<?php }else {?>
										<img src="<?php echo base_url();?>images/video/<?php echo $video_details->row()->image;?>" width="100px"/>
									<?php }?>
									</div>
								</div>
								</li>-->
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Video Name</label>
									<div class="form_input">
										<?php echo $video_details->row()->video_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Video Title</label>
									<div class="form_input">
										<?php echo $video_details->row()->video_title;?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="video_desc">Video Description</label>
									<div class="form_input">
										<?php echo $video_details->row()->video_desc;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="video_link">Video Link</label>
									<div class="form_input">
										<?php echo $video_details->row()->video_link;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/video/display_video_list" class="tipLeft" title="Go to videos list"><span class="badge_style b_done">Back</span></a>
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