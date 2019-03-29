<?php $this->load->view('crmadmin/templates/header.php'); ?>

<!--<script type="text/javascript">

$(document).ready(function()
{
	$("#check_pwd_common").click(function()
	{		
	alert('hi');
	return false;
	});
});
</script>-->
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Reset Subadmin Password</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addsubadmin_form');
						echo form_open('crmadmin/subadmin/edit_save_pwd_subadmin_form',$attributes) 
					?>
	 						<ul>	 							
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">New Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="admin_password" id="admin_password" type="password" tabindex="2" class="required large tipTop" title="Please enter the subadmin new password"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="site_contact_mail">Confirm Password <span class="req">*</span></label>
									<div class="form_input">
										<input  id="admin_confirm_password" equalto="#admin_password" type="password" tabindex="3" class="required large tipTop" title="Please enter the subadmin confirm password"/>
									</div>
								</div>
								</li>
								<li>
								
								<div style="margin-top: 20px;"></div>
								
                               
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
                                    	<input type="hidden" name="subadmin_id" value="<?php echo $this->uri->segment(4); ?>" />
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Submit</span></button>
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
$this->load->view('crmadmin/templates/footer.php');
?>