<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/city/change_city_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<!--<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $city)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
							</div>
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $city)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>-->
					</div>
					<div class="widget_content">
						<table class="display" id="newsletter_tbl">
						<thead>
						<tr>
                        	<th class="tip_top" title="Click to sort">
								 State Name
							</th>
                            <th class="center" title="Click to sort">
                            City Name							
                            </th>
                            <th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($cityList->num_rows() > 0){
							foreach ($cityList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
                               <?php 
							if ($StateList->num_rows() > 0){	
								foreach ($StateList->result() as $Strow){
								
									if ($row->stateid==$Strow->id){
									echo ucfirst($Strow->name);
									}
								}
							}
								?>
							</td>
							<td class="center tr_select ">
                                <?php echo $row->name;?>
							</td>
							<td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $city)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/city/change_city_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/city/change_city_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $city)){?>
								<span><a class="action-icons c-edit" href="admin/city/edit_city_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
							<?php }?>
								<span><a class="action-icons c-suspend" href="admin/city/view_city/<?php echo $row->id;?>" title="View">View</a></span>
							<?php if ($allPrev == '1' || in_array('3', $city)){
							?>
                            	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/city/delete_city/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php  }?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
							<tr>
                            <th class="tip_top" title="Click to sort">
								 State Name
							</th>
							<th class="tip_top" title="Click to sort">
								 City Name
							</th>
                            <th>
								Status
							</th>
							<th>
								Action
							</th>
						</tr></tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>