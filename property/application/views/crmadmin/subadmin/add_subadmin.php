<?php $this->load->view('crmadmin/templates/header.php'); ?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add Subadmin</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addsubadmin_form');
						echo form_open('crmadmin/subadmin/insertEditSubadmin',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="email">Email Address <span class="req">*</span></label>
									<div class="form_input">
										<input name="email" id="email" type="text" tabindex="1" class="required large tipTop" title="Please enter the admin email address"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Sub Admin Name <span class="req">*</span></label>
									<div class="form_input">
										<input name="admin_name" id="admin_name" type="text" tabindex="2" class="required large tipTop" title="Please enter the admin username"/>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="site_contact_mail">Password <span class="req">*</span></label>
									<div class="form_input">
										<input name="admin_password" id="admin_password" type="password" tabindex="3" class="required large tipTop" title="Please enter the new password"/>
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
                                <?php  
								$newArrVal = array('all','completed','cancelled','swapped');
								foreach($newArrVal as $stateDets){
									$subAdminName = $stateDets; 	
									$subAdmin = $stateDets.' deals';	
							  	 ?>
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								<div class="form_grid_12">
									<label class="field_title">Report Mgmt</label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        	<span class="checkboxCon">
								        		<input class="caseSeeker" type="checkbox" name="reportmgmt[]" id="reportmgmt[]"  value="<?php echo $j;?>" />
								        	</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php  
								foreach($stateDetails->result_array() as $stateDets){
									$subAdmin = $stateDets['name']; 	
									$subAdminName = $stateDets['seourl']; ?>
								
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        		<span class="checkboxCon">
									        		<input class="caseSeeker" type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />
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
									$subAdmin = $codeDets['attribute_name']; 	
									$subAdminName = $codeDets['attribute_seourl']; ?>
								
								<div class="form_grid_12">
									<label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
									<table border="0" cellspacing="0" cellpadding="0" width="400">
								     	<tr>
								        	<?php for($j=0;$j<3; $j++) { ?>
								        	<td align="center" width="15%">
								        		<span class="checkboxCon">
									        		<input class="caseSeeker" type="checkbox" name="<?php echo $subAdminName.'[]';?>" id="<?php echo $subAdminName.'[]';?>"  value="<?php echo $j;?>" />
								        		</span>
								        	</td>
											<?php } ?>
								        </tr>
								    </table>
								</div>
								<?php } ?>
								<br /><br /><label class="field_title" style="margin-left:7px;">SOLD ADMIN NAME</label><br /><br />
                            <?php
                            foreach ($soldadminName->result_array() as $soldadmin) {
                                $subAdmin = $soldadmin['admin_name'];
                                $subAdminName = $soldadmin['admin_name'];
                                ?>
                                <div class="form_grid_12">
                                    <label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
                                    <table border="0" cellspacing="0" cellpadding="0" width="400">
                                        <tr>
                                            <?php for ($j = 0; $j < 3; $j++) { ?>
                                                <td align="center" width="15%">
                                                    <span class="checkboxCon">
                                                        <input class="caseSeeker" type="checkbox" name="arya[]" id="arya[]"  value="<?php echo $subAdmin; ?>" />
                                                    </span>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </div>
                            
                            <?php } ?>
                            <br /><br /><label class="field_title" style="margin-left:7px;">SOURCER NAME</label><br /><br />
                            <?php
                            foreach ($sourcerName->result_array() as $soldadmin) {
                                $subAdmin = $soldadmin['s_email'];
                                $subAdminName = $soldadmin['s_email'];
                                ?>
                                <div class="form_grid_12">
                                    <label class="field_title"><?php echo ucfirst($subAdmin) ?></label>
                                    <table border="0" cellspacing="0" cellpadding="0" width="400">
                                        <tr>
                                            <?php for ($j = 0; $j < 3; $j++) { ?>
                                                <td align="center" width="15%">
                                                    <span class="checkboxCon">
                                                        <input class="caseSeeker" type="checkbox" name="sourcer[]" id="sourcer[]"  value="<?php echo $subAdmin; ?>" />
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