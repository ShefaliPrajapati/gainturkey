<?php
$this->load->view('crmadmin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View State</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address</label>
									<div class="form_input">
										<?php echo $admin_details->row()->email;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">State Name</label>
									<div class="form_input">
										<?php echo ucfirst($admin_details->row()->admin_name);?>
									</div>
								</div>
								</li>
                                <li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">State Type</label>
									<div class="form_input">
										<?php echo ucfirst($admin_details->row()->login_type);?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title">Mangement Name</label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								            <td align="center" width="15%">View</td>
								            <!-- <td align="center" width="15%">Add</td>-->
								              <td align="center" width="15%">Edit</td>
								               <td align="center" width="15%">Delete</td>
								        </tr>
								    </table>
								</div>
								<input type="hidden" value="<?php echo $admin_details->row()->id;?>" name="stateid"/>
                                
                                 <?php  
								$newArrVal = array('all','completed');
								//echo '<pre>'; print_r($stateDetails->result_array());
								foreach($newArrVal as $stateDets){
									$subAdminName = $stateDets; 	
									$subAdmin = $stateDets.' deals';
									 	
									$priv = array();
							  		 if (isset($privArr[$subAdminName])){
									  	 $priv = $privArr[$subAdminName];
							  	 	}
								  	 if (!is_array($priv)){
								  	 	$priv = array();
								  	 }
									
								
							  	 ?>
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        	
								        		<input disabled="disabled" <?php if (in_array($j,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />

								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								<?php  
								foreach($stateDetails->result_array() as $stateDets){
									$subAdmin = $stateDets['name']; 	
									$subAdminName = $stateDets['seourl']; 	
									$priv = array();
							  		 if (isset($privArr[$subAdminName])){
									  	 $priv = $privArr[$subAdminName];
							  	 	}
								  	 if (!is_array($priv)){
								  	 	$priv = array();
								  	 }
									
								
								
							  	 ?>
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        		<input disabled="disabled" <?php if (in_array($j,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $subAdmin.'[]';?>" id="<?php echo $subAdmin.'[]';?>"  value="<?php echo $j;?>" />
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="crmadmin/state/display_state" class="tipLeft" title="Go to state list"><span class="badge_style b_done">Back</span></a>
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