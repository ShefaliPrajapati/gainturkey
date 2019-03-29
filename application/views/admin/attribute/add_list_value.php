<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add List Value</h6>
                        
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addlistvalue_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/attribute/insertEditListValue',$attributes) 
					?>
                    
						<ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="list_name">Select List<span class="req">*</span></label>
							<div class="form_input">
		                      <select class="chzn-select required" name="list_name" tabindex="-1" style="width: 375px; display: none;" data-placeholder="Select List">
		                      		<option value=""></option>
		                      		<?php 
		                      		foreach ($list_details->result() as $row){
		                      			if ($row->attribute_name!='price'){
		                      		?>
		                      		<option value="<?php echo $row->id;?>"><?php echo $row->attribute_name;?></option>
		                      		<?php }}?>
		                      </select>
		                    </div>
							</div>
							</li>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="list_value">List Value<span class="req">*</span></label>
							<div class="form_input">
								<input name="list_value" id="list_value" type="text" tabindex="1" class="required large tipTop" title="Please enter the list value"/>
							</div>
							</div>
							</li>
						
                        	
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<button type="submit" class="btn_small btn_blue" tabindex="2"><span>Submit</span></button>
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
<script>
$('#addlistvalue_form').validate();
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>