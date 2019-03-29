<?php
$this->load->view('crmadmin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Property Type</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$productattributes = array('class' => 'form_container left_label', 'id' => 'addattribute_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('crmadmin/productattribute/insertSubAttribute',$productattributes) 
					?>
                    
						<ul>
	 						<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Property Type Name <span class="req">*</span></label>
							<div class="form_input">
                            
                            <select name="attr_id" >
                            <?php if($AttributeList->num_rows() > 0){
							foreach($AttributeList->result() as $AttrRow){
							echo '<option value="'.$AttrRow->id.'" >'.$AttrRow->attr_name.'</option>';
							}
							
							} ?>
                            
                            </select>
								
							</div>
							</div>
							</li>		
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Property Sub Type Name <span class="req">*</span></label>
							<div class="form_input">
								<input name="subattr_name" id="subattr_name" type="text" tabindex="1" class="required large tipTop" title="Please enter the property name"/>
							</div>
							</div>
							</li>
						
                        	
							<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status <span class="req">*</span></label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="11" name="status" checked="checked" id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="9"><span>Submit</span></button>
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