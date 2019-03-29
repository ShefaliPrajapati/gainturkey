<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<div id="content">
    <div class="grid_container">
        <?php
        $attributes = array('id' => 'display_form');
        echo form_open('admin/users/change_user_status_global', $attributes)
        ?>
        <div class="grid_12">
            <div class="widget_wrap">
                <div class="widget_top">
                    <span class="h_icon blocks_images"></span>
                    <h6><?php echo $heading ?></h6>
                    <div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
                        <?php if ($allPrev == '1' || in_array('2', $user)) { ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="<?php echo base_url();?>admin/users/add_user_form" class="tipTop" title="Add new user "><span class="icon add_co"></span><span class="btn_link">Add</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin1('ResetPassword');" class="tipTop" title="Select any one checkbox and click here to reset password"><span class="icon key_co"></span><span class="btn_link">Reset Password</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Active', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to active records"><span class="icon accept_co"></span><span class="btn_link">Active</span></a>
                            </div>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Inactive', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to inactive records"><span class="icon delete_co"></span><span class="btn_link">Inactive</span></a>
                            </div>
                            <?php
                        }
                        if ($allPrev == '1' || in_array('3', $user)) {
                            ?>
                            <div class="btn_30_light" style="height: 29px;">
                                <a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete', '<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="widget_content">
                    <table class="display" id="userListTbl">
                        <thead>
                            <tr>
                                <th class="center">
                                    <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    First Name
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Last Name
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Email
                                </th>
                                <th>
                                    User Name
                                </th>
                                <th class="tip_top" title="Click to sort"> 
                                    Created On
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Last Login Date
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Last Login IP
                                </th>
                                <th class="tip_top" title="Click to sort">
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($usersList->num_rows() > 0) {
                                foreach ($usersList->result() as $row) {
                                    ?>
                                    <tr>
                                        <td class="center tr_select ">
                                            <input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id; ?>">
                                        </td>
                                        <td class="center">
                                            <?php echo $row->first_name; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->last_name; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->email; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->user_name; ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $row->created; ?>
                                        </td>
        <!-- 							<td class="center">
                                        <?php //if ($row->group == 'User'){?>
                                                <span class="badge_style b_high"><?php //echo $row->group;          ?></span>
                                        <?php //}else {?>
                                                <span class="badge_style b_away"><?php //echo 'User / '.$row->group;          ?></span>
                                        <?php //}?>
                                        </td>
                                        -->							<td class="center">
                                            <?php echo $row->last_login_date; ?>
                                        </td>
                                        <td class="center">
                                            <?php
                                            if ($row->last_login_ip != '')
                                                echo $row->last_login_ip;
                                            else
                                                echo "Not Available";
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php
                                            if ($allPrev == '1' || in_array('2', $user)) {
                                                $mode = ($row->status == 'Active') ? '0' : '1';
                                                if ($mode == '0') {
                                                    ?>
                                                    <a title="Click to inactive" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode; ?>/<?php echo $row->id; ?>');"><span class="badge_style b_done"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a title="Click to active" class="tip_top" href="javascript:confirm_status('admin/users/change_user_status/<?php echo $mode; ?>/<?php echo $row->id; ?>')"><span class="badge_style"><?php echo $row->status; ?></span></a>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge_style b_done"><?php echo $row->status; ?></span>
                                            <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($allPrev == '1' || in_array('2', $user)) { ?>
                                                <span><a class="action-icons c-edit" href="admin/users/edit_user_form/<?php echo $row->id; ?>" title="Edit">Edit</a></span>
                                                <?php if ($row->is_verified == 'No') { ?>
                                                    <span><a class="action-icons c-pdf" href="admin/users/account_active_mail/<?php echo $row->id; ?>" title="Activate Account">Verified</a></span>
                                                <?php } ?>
                                            <?php } ?>
                                            <span><a class="action-icons c-suspend" href="admin/users/view_user/<?php echo $row->id; ?>" title="View">View</a></span>
                                            <?php
                                            if ($allPrev == '1' || in_array('3', $user)) {
                                                if ($row->group != 'Admin') {
                                                    ?>	
                                                    <span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $row->id; ?>')" title="Delete">Delete</a></span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
<!--                        <tfoot>
                            <tr>
                                <th class="center">
                                    <input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    User Name
                                </th>
                                <th>
                                    Created On
                                </th>
                                <th>
                                    Last Login Date
                                </th>
                                <th>
                                    Last Login IP
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="statusMode" id="statusMode"/>
        <input type="hidden" name="password_value" id="password_value" />
        <input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
        </form>	

    </div>
    <span class="clear"></span>
</div>
</div>
<?php
$this->load->view('admin/templates/footer.php');
?>