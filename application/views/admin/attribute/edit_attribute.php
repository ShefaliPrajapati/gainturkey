<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Edit Code</h6>
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label', 'id' => 'edituser_form', 'enctype' => 'multipart/form-data');
						echo form_open_multipart('admin/attribute/EditAttribute',$attributes) 
					?>
	 			
                <ul>
	 							
							<li>
							<div class="form_grid_12">
							<label class="field_title" for="attribute_name">Code <span class="req">*</span></label>
							<div class="form_input">
								<input name="attribute_name" id="attribute_name" type="text" tabindex="1" class="required large tipTop FrmTextBox" title="Please enter the Code" value="<?php echo $attribute_details->row()->attribute_name;?>" maxlength="3"/>
							</div>
							</div>
							</li>

								<li>
								<div class="form_grid_12">
									<div class="form_input">
								<input type="hidden" name="attribute_id" value="<?php echo $attribute_details->row()->id;?>"/>                                    
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
<script>
$(document).ready(function(){
    $(".FrmTextBox").keyup(function(key){
        $("#attribute_name").text($(this).val($(this).val().toUpperCase()));
    });
});
</script>
<?php 
$this->load->view('admin/templates/footer.php');
?>