<?php $this->load->view('crmadmin/templates/header.php'); ?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Subadmin</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addsubadmin_form');
						echo form_open('crmadmin/subadmin/insertEditSubadmin',$attributes) 
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
									<label class="field_title" for="admin_name">Sub Admin Name</label>
									<div class="form_input">
										<?php echo $admin_details->row()->admin_name;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="site_contact_mail"></label>
									<div id="uniform-undefined" class="form_input checker focus">
										<span class="" style="float:left;"><input type="checkbox" class="checkbox" id="selectallseeker" /></span><label style="float:left;margin:5px;">Select all</label>
									</div>
								</div>
								<div style="margin-top: 20px;"></div>
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
                                <input type="hidden" value="<?php echo $admin_details->row()->id;?>" name="subadminid"/>
                                <?php  
								$newArrVal = array('all','completed','cancelled','swapped');
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
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" <?php if (in_array($j,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								<?php $priv1 = array();
									
							  		 if (isset($privArr['reportmgmt'])){
									  	 $priv1 = $privArr['reportmgmt'];
							  	 	}
								  	 if (!is_array($priv1)){
								  	 	$priv1 = array();
								  	 }
									 ?>
                                <div class="form_grid_12">
									<label class="field_title">Report Mgmt</label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" <?php if (in_array($j,$priv1)){echo 'checked="checked"';}?> type="checkbox" name="reportmgmt[]" id="reportmgmt[]"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php  
								//echo '<pre>'; print_r($stateDetails->result_array());
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
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" <?php if (in_array($j,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
                                <br /><br /><label class="field_title" style="margin-left:7px;">CODE MANAGEMENT</label><br /><br />
                                <?php  
								foreach($codeDetails->result_array() as $codeDets){
									$codeAdmin = $codeDets['attribute_name']; 	
									$codeAdminName = $codeDets['attribute_seourl']; 
									$priv = array();
							  		 if (isset($privArr[$codeAdminName])){
									  	 $priv = $privArr[$codeAdminName];
							  	 	}
								  	 if (!is_array($priv)){
								  	 	$priv = array();
								  	 }
									
									?>
								
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($codeAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($k=0;$k<3; $k++) { ?>
								        	<td align="center" width="15%">
								        		<span class="checkboxCon">
									        		<input class="caseSeeker" <?php if (in_array($k,$priv)){echo 'checked="checked"';}?> type="checkbox" name="<?php echo $codeAdminName.'[]';?>" id="<?php echo $codeAdminName.'[]';?>"  value="<?php echo $k;?>" />
								        		</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								<br/><br/><label class="field_title" style="margin-left:7px;">SOLD ADMIN NAME</label><br /><br />
                            <?php
                            foreach ($soldadminName->result_array() as $soldadmin) {
                                $subAdmin = $soldadmin['admin_name'];
                                $subAdminName = $soldadmin['admin_name'];
                                //print_r($soldadmin['admin_name']);
                                 $priv = array();
                                if (isset($privArr[$subAdminName])) {
                                    $priv = $privArr[$subAdminName];
                                }
                                if (!is_array($priv)) {
                                    $priv = array();
                                }
                                //print_r($priv);
                                ?>                      
                            
                                <div class="form_grid_12">
                                    <label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
                                    <table border="0" cellspacing="0" cellpadding="0" width="400">
                                        <tr>
                                            <?php for ($j = 0; $j < 3; $j++) { ?>
                                                <td align="center" width="15%">
                                                    <span class="checkboxCon">
                                                        <input class="caseSeeker" <?php
                                                        if (in_array($subAdmin, $deals_pre)) {
                                                            echo 'checked="checked"';
                                                        }
                                                        ?> type="checkbox" name="arya[]" id="arya[]"  value="<?php echo $subAdmin; ?>" />
                                                    </span>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </div>

                            <?php } ?>
                            <br/><br/><label class="field_title" style="margin-left:7px;">SOURCER NAME</label><br /><br />
                            <?php
                            foreach ($sourcerName->result_array() as $soldadmin) {
                                $subAdmin = $soldadmin['s_email'];
                                $subAdminName = $soldadmin['s_email'];
                                //print_r($soldadmin['admin_name']);
                                 $priv = array();
                                if (isset($privArr[$subAdminName])) {
                                    $priv = $privArr[$subAdminName];
                                }
                                if (!is_array($priv)) {
                                    $priv = array();
                                }
                                //print_r($priv);
                                ?>                      
                            
                                <div class="form_grid_12">
                                    <label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
                                    <table border="0" cellspacing="0" cellpadding="0" width="400">
                                        <tr>
                                            <?php for ($j = 0; $j < 3; $j++) { ?>
                                                <td align="center" width="15%">
                                                    <span class="checkboxCon">
                                                        <input class="caseSeeker" <?php
                                                        if (in_array($subAdmin, $sourcer)) {
                                                            echo 'checked="checked"';
                                                        }
                                                        ?> type="checkbox" name="sourcer[]" id="sourcer[]"  value="<?php echo $subAdmin; ?>" />
                                                    </span>
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
										<button type="submit" class="btn_small btn_blue" tabindex="15"><span>Update</span></button>
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
checkboxInit();
</script>
<?php $this->load->view('crmadmin/templates/footer.php'); ?>