<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Consultant</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'editconsultant_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/consultant/insertEditConsultant',$attributes) 
					?>
	 						<ul>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title" for="consultant_name">Client Initital<span class="req">*</span></label>
									<div class="form_input">
										<input name="client_initial" id="client_initial" type="text" tabindex="1" class="required large tipTop" title="Please enter the Cleint Initial" value="<?php echo $consultant_details->row()->client_initial;?>"/>
                                       <div id="client_initial_warn"  style="float:right; color:#FF0000;"></div>
									</div>
                                     
								</div>
                                
								</li>
								
								<li>
									<div class="form_grid_12">
										<label class="field_title" for="consultant_name">Initital Color</label>
										<div class="form_input">
											<select class="chzn-select large tipTop" name="color" id="color" tabindex="12" style="width: 150px; float:left;" data-placeholder="Select initial color" >
												<option value=""></option>
												<option value="#736F6E" <?php if($consultant_details->row()->color == '#736F6E'){ echo 'selected="selected"';} ?>>
													Gray
												</option>
												<option value="#008080" <?php if($consultant_details->row()->color == '#008080'){ echo 'selected="selected"';} ?>>
													Teal
												</option>
												<option value="#B87333" <?php if($consultant_details->row()->ini_color == '#B87333'){ echo 'selected="selected"';} ?>>
													Copper
												</option>
												<option value="#FF00FF" <?php if($consultant_details->row()->color == '#FF00FF'){ echo 'selected="selected"';} ?>>
													Magenta
												</option>
												<option value="#7D0552" <?php if($consultant_details->row()->color == '#7D0552'){ echo 'selected="selected"';} ?>>
													Plum Velvet
												</option>
												<option value="#B2C248" <?php if($consultant_details->row()->color == '#B2C248'){ echo 'selected="selected"';} ?>>
													Avocado Green
												</option>
												<option value="#FFFF00" <?php if($consultant_details->row()->color == '#FFFF00'){ echo 'selected="selected"';} ?>>
													Yellow
												</option>
												<option value="#FF0000" <?php if($consultant_details->row()->color == '#FF0000'){ echo 'selected="selected"';} ?>>
													Red
												</option>
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
											<input type="checkbox" name="status" <?php if ($consultant_details->row()->status == 'Active'){echo 'checked="checked"';}?> id="active_inactive_active" class="active_inactive"/>
										</div>
									</div>
								</div>
								<input type="hidden" name="consultant_id" value="<?php echo $consultant_details->row()->id;?>"/>
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
			$("#editconsultant_form").submit(function(){
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
					      	$("#editconsultant_form").submit();
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