<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Video</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editvideo_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/video/insertEditVideo',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="user_name">Video Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="video_name" style=" width:295px" id="video_name" value="<?php echo $video_details->row()->video_name;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the video name"/>
                                        <div id="video_name_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="full_name">Video Title <span class="req">*</span></label>
									<div class="form_input">
										<input name="video_title" style=" width:295px" id="video_title" value="<?php echo $video_details->row()->video_title;?>" type="text" tabindex="1" class="required tipTop" title="Please enter the video title"/>
                                        <div id="video_title_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                               <!-- <li>
								<div class="form_grid_12">
									<label class="field_title" for="thumbnail">Video Image<span class="req">*</span></label>
									<div class="form_input">
										<input name="image" id="image" type="file" tabindex="7" class="large tipTop" title="Please select video image"/>
									</div>
									<div class="form_input"><img src="<?php echo base_url();?>images/video/<?php echo $video_details->row()->image;?>" width="100px"/><br /><br />
                                    Note: Please upload images of size 1349 * 644 only, For better viewing</div>
                                     
								</div>
								</li>-->
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="video_link">Video Link <span class="req">*</span></label>
									<div class="form_input">
										<input name="video_link" id="video_link" type="text" value="<?php echo $video_details->row()->video_link;?>" tabindex="2" class="large tipTop" title="Please enter the video link"/>
                                        <div id="video_link_warn"  style="float:right; color:#FF0000;"></div>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="video_desc">Video Description </label>
									<div class="form_input">
										<textarea name="video_desc" id="video_desc" class="large tipTop" title="Please enter the video description"><?php echo $video_details->row()->video_desc;?></textarea>
									</div>
								</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" name="status" <?php if ($video_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="video_id" value="<?php echo $video_details->row()->id;?>"/>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="4"><span>Update</span></button>
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
<script type="text/javascript">
$(function() {
			$("#editvideo_form").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
					if(jQuery.trim($("#video_name").val()) == '')
					{
						$("#video_name_warn").html('');
						$("#video_name_warn").html('Video name is required');
						$("#video_name").focus();
						return false;
						
					}else if(jQuery.trim($("#video_title").val()) == ''){
					   $("#video_title_warn").html('');
						$("#video_title_warn").html('Video title is required');
						$("#video_title").focus();
						return false;
						
					}else if(jQuery.trim($("#video_link").val()) == ''){
						$("#video_link_warn").html('');
						$("#video_link_warn").html('Please upload a image');
						$("#video_link").focus();
						return false;
										
					}else
					{	
					      	$("#editvideo_form").submit();
					}
					
					return false;	
				});
		});
		
	 
function removeError(idval){
	$("#"+idval+"_warn").html('');}
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>