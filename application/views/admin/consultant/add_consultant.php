<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Add New Initial</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'addconsultant_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/consultant/insertEditConsultant',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="consultant_name">Client Initital<span class="req">*</span></label>
									<div class="form_input">
										<input name="client_initial" id="client_initial" type="text" tabindex="1" class="required large tipTop" title="Please enter the Cleint Initial"/>
                                       <div id="client_initial_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
                                
								</li>
								
	 							<li>
									<div class="form_grid_12">
										<label class="field_title" for="consultant_name">Initital Color</label>
										<div class="form_input">
											<select class="chzn-select large tipTop" name="color" id="color" tabindex="12" style="width: 150px; float:left;" data-placeholder="Select initial color">
												<option value=""></option>
												<option value="#736F6E">Gray</option>
												<option value="#008080">Teal</option>
												<option value="#B87333">Copper</option>
												<option value="#FF00FF">Magenta</option>
												<option value="#7D0552">Plum Velvet</option>
												<option value="#B2C248">Avocado Green</option>
												<option value="#FFFF00">Yellow</option>
												<option value="#FF0000">Red</option>
											</select>
										   <div id="initial_color_warn"  style="color:#FF0000;"></div>
										</div>
									</div>
								</li>
								
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="admin_name">Status </label>
									<div class="form_input">
										<div class="active_inactive">
											<input type="checkbox" tabindex="8" name="status" checked="checked" id="status" class="active_inactive"/>
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

<script type="text/javascript">
$(function() {
			$("#addconsultant_form").submit(function(){
				// var email = $('#vendor_email').val();
				//alert('');
					if(jQuery.trim($("#client_initial").val()) == '')
					{
						$("#client_initial_warn").html('');
						$("#client_initial_warn").html('Client Initial is required');
						$("#client_initial").focus();
						return false;
						
					}else
					{	
					      	$("#addconsultant_form").submit();
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