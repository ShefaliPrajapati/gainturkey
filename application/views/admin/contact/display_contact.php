<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/contact/change_contact_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<!--<?php if ($allPrev == '1' || in_array('2', $contact)){?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('InActive','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">InActive</span></a>
							</div>
						<?php 
						}?>-->
						<?php
						if ($allPrev == '1' || in_array('3', $contact)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
                   
					<div class="widget_content">
						<table class="display" id="newsletter_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th class="tip_top" title="Click to sort">
							First Name
							</th>
							<th class="center" title="Click to sort">
                            Last Name
							</th>
                            <th class="center" title="Click to sort">
                            Email
							</th>
                            <th>
								Date Added
							</th>
							<th>
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($contactList->num_rows() > 0){
							foreach ($contactList->result() as $row){
						?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center  tr_select">
								<?php echo stripslashes(ucfirst($row->firstname));?>
							</td>
							<td class="center tr_select ">
                                <?php echo stripslashes(ucfirst($row->lastname));?>
							</td>
                            <td class="center tr_select ">
                                <?php echo stripslashes($row->email);?>
							</td>
                             <td class="center tr_select ">
                                <?php echo stripslashes($row->dateAdded);?>
							</td>
                          <!-- <td class="center">
							<?php 
							if ($allPrev == '1' || in_array('2', $contact)){
								$mode = ($row->status == 'Active')?'0':'1';
								if ($mode == '0'){
							?>
								<a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/contact/change_contact_status/<?php echo $mode;?>/<?php echo $row->id;?>');"><span class="badge_style b_done"><?php echo $row->status;?></span></a>
							<?php
								}else {	
							?>
								<a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/contact/change_contact_status/<?php echo $mode;?>/<?php echo $row->id;?>')"><span class="badge_style"><?php echo $row->status;?></span></a>
							<?php 
								}
							}else {
							?>
							<span class="badge_style b_done"><?php echo $row->status;?></span>
							<?php }?>
							</td>-->
							<td class="center">
							<?php //if ($allPrev == '1' || in_array('2', $contact)){?>
								<!--<span><a class="action-icons c-edit" href="admin/contact/edit_contact_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>-->
							<?php //}?>
								<span><a class="action-icons c-suspend" href="admin/contact/view_contact/<?php echo $row->id;?>" title="View">View</a></span>
                                <?php if ($allPrev == '1' || in_array('3', $contact)){?>
							<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/contact/delete_contact/<?php echo $row->id;?>')" title="Delete">Delete</a></span><?php } ?>
							</td>
						</tr>
						<?php 
							}
						}
						?>
						</tbody>
						<tfoot>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
							<th>
								 First Name
						  </th>
							<th class="center">
                          		 Last Name
                            </th>
                            <th class="center">
                          		 Email
                            </th>
				            <th>
								 Date Added
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