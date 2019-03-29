<?php
$this->load->view('admin/templates/header.php');
?>
<div id="content">
		<div class="grid_container">
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>View Initial Details</h6>
						
					</div>
					<div class="widget_content">
					<?php 
						$attributes = array('class' => 'form_container left_label');
						echo form_open('admin',$attributes) 
					?>
					
	 						<ul>
	 							
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Client Initial</label>
									<div class="form_input">
										<?php echo $consultant_details->row()->client_initial;?>
									</div>
								</div>
								</li>
								
								<?php 
								$inC=array('Gray'=>'#736F6E',
													'Teal'=>'#008080',
													'Copper'=>'#B87333',
													'Magenta'=>'#FF00FF',
													'Plum Velvet'=>'#7D0552',
													'Avocado Green'=>'#B2C248',
													'Yellow'=>'#FFFF00',
													'Red'=>'#FF0000');
								$key=array_search($consultant_details->row()->color,$inC);
								if($key===false){
									$ini_color='';
								}else{
									$ini_color=$key;
								}
								?>
	 							<li>
								<div class="form_grid_12">
									<label class="field_title">Initial Color</label>
									<div class="form_input">
										<?php echo $ini_color;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<label class="field_title" for="consultant_link">Status</label>
									<div class="form_input">
										<?php echo $consultant_details->row()->status;?>
									</div>
								</div>
								</li>
								<li>
								<div class="form_grid_12">
									<div class="form_input">
										<a href="admin/consultant/display_consultant_list" class="tipLeft" title="Go to consultant list"><span class="badge_style b_done">Back</span></a>
									</div>
								</div>
								</li>
								</ul>
							
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>