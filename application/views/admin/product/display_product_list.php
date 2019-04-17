<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<div id="content">
		<div class="grid_container">
			<?php 
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						<?php if ($allPrev == '1' || in_array('2', $rental)){?>
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
							</div>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
							</div>-->
						<?php 
						}
						if ($allPrev == '1' || in_array('3', $rental)){
						?>
							<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>
						<?php }?>
						</div>
					</div>
                    
					<div class="widget_content">
						<table class="display display_tbl" id="subadmin_tbl">
						<thead>
						<tr>
							<th class="center">
								<input name="checkbox_id[]" type="checkbox" value="on" class="checkall">
							</th>
                            <th class="tip_top" title="Click to sort">
								 ID
							</th>
                            <th class="tip_top" title="Click to sort">
								 Property ID
							</th>
							<th class="tip_top" title="Click to sort">
								 Property Address
							</th>
							<th class="tip_top" title="Click to sort">
								 PROPERTY TYPE
							</th>
							<th>
								Monthly Rent
							</th>
							<th class="tip_top" title="Click to sort">
								Event Price
							</th>
<!--							<th class="tip_top" title="Click to sort">-->
<!--								Display-->
<!--							</th>-->
                            <th class="tip_top" title="Click to sort">
								Property Status
							</th>
							<th class="tip_top" title="Click to sort">
								Created On
							</th>
                            <th class="tip_top" title="Click to sort">
								Sold By
							</th>
							<th>
								 Action
							</th>
							
 						</tr>
						</thead>
						<tbody>
						<?php
						if ($productList !== NULL && $productList->num_rows() > 0){
						//for ($x=0; $x<=100; $x++){
						/*if($this->session->userdata('fc_session_admin_mode') == 'fc_admin')
							{
								$details = $productList->result();
							}
						else
							{
								$details = $productList1->result();
							}*/
						foreach ($productList->result() as $row)
							{
								$img = 'dummyProductImage.jpg';
								$imgArr = explode(',', $row->image);
								if (count($imgArr)>0)
									{
										foreach ($imgArr as $imgRow)
											{
												if ($imgRow != '')
													{
														$img = $imgRow;
														break;
													}
											}
									}
										
								?>
						<tr>
							<td class="center tr_select ">
								<input name="checkbox_id[]" type="checkbox" value="<?php echo $row->id;?>">
							</td>
							<td class="center">
								<?php echo $row->id;?>
							</td><td class="center">
								<?php echo $row->property_id;?>
							</td>
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							<td class="center">
						 		<!--<div class="widget_thumb" style="margin-left: 25%;">
                                <?php
								foreach($product_image->result() as $productImag){
									
								 if($row->id==$productImag->property_id){  ?>
								 <img class="rollovereff" src="<?php echo base_url();?>images/product/<?php if($productImag->product_image != '') echo $productImag->product_image; else echo 'no_image.jpg';?>" />
                                 <?php }
								 
								 }
								  ?>
								</div>-->
                                <?php if($row->property_sub_type == 0)echo $row->attr_name; else echo $row->subattr_name; ?>
							</td>
							<td class="center">
								<?php echo number_format($row->monthly_rent);?>
							</td>
							<td class="center">
								<?php echo number_format($row->event_price);?>
							</td>
<!--							<td class="center">-->
<!--								--><?php //if($row->display_main == 'yes' && $row->display_sub == 'yes')
//											{
//												echo 'All';
//											}
//										else if($row->display_main == 'yes')
//											{
//												echo 'returnonrentals.com';
//											}
//										else if($row->display_sub == 'yes')
//											{
//												echo 'preigrentals.com';
//											}
//								?>
<!--							</td>-->
                            <td class="center">
							<?php 
							echo $row->property_status;
								
								//if ($row->property_status == 'Sold'){
							?>
								<!--<a title="Click to unsold" class="tip_top" onclick="return confirm_property_sold_status('<?php echo $code->booking_code; ?>','0','<?php echo $row->id;?>');" href="javascript:void(0);"><span class="badge_style b_done"><?php echo $row->property_status;?></span></a>-->
							<?php
								//}else {	
							?>
								<!--<a title="Click to sold" class="tip_top" onclick="return confirm_property_sold_status('<?php echo $code->booking_code; ?>','1','<?php echo $row->id;?>');" href="javascript:void(0)"><span class="badge_style"><?php echo $row->property_status;?></span></a>-->
							<?php 
								//}
							?>
							</td>
							<td class="center">
								<?php echo $row->created;?>
							</td>
                            <td class="center">
								<a class="iframe cboxElement c-search" href="<?php echo base_url()."admin/product/reserved_product_details/".$row->reserve_id; ?>" ><?php if($row->reserve_id != ''){ if($row->sold_admin_name != '')echo $row->sold_admin_name; else echo "View Details";}?></a>
							</td>
							<td class="center">
							<?php if ($allPrev == '1' || in_array('2', $rental)){?>
								<span><a class="action-icons c-edit" href="admin/product/edit_product_form/<?php echo $row->id;?>" title="Edit">Edit</a></span>
                                 
                              <?php }?>
								<span><a class="action-icons c-suspend" href="admin/product/view_product/<?php echo $row->id;?>" title="View">View</a></span>
                                
                                <span>
                                <!--<a class="iframe cboxElement action-icons c-search" href="https://maps.google.com/?q=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;ie=UTF8&amp;t=m&amp;z=14&amp;ll=<?php echo $row->latitude;?>,<?php echo $row->longitude;?>&amp;output=embed" title="Map">Map</a>-->
                                
                                 <a class="iframe cboxElement action-icons c-search" href="http://regiohelden.de/google-maps/map_en.php?width=1030&amp;height=460&amp;hl=en&amp;q=<?php echo $row->address.','.$row->city.','.$row->state;?>+(Gain Turnkey Property)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" title="Map">Map</a>
                                
                                </span>
                                
							<?php if ($allPrev == '1' || in_array('3', $rental)){?>	
								<span><a class="action-icons c-delete" href="javascript:confirm_delete('admin/product/delete_product/<?php echo $row->id;?>')" title="Delete">Delete</a></span>
							<?php }?>
                            <?php if ($allPrev == '1' || in_array('2', $rental)){?>
                            <?php if($row->featured=='No'){ ?>
                            <span id="feature_<?php echo $row->id;?>"><a class="c-unfeatured" href="javascript:ChangeFeatured('Yes','<?php echo $row->id;?>')" title="Click To Featured">Un-Featured</a></span>
                            <?php }else{ ?>
                            <span id="feature_<?php echo $row->id;?>"><a class="c-featured" href="javascript:ChangeFeatured('No','<?php echo $row->id;?>')" title="Click To Un-Featured" >Featured</a></span>
                            <?php }
							if($row->reserve_id != '') { ?>
                           <span><a class="action-icons c-pdf" href="<?php echo base_url().'admin/order/view_order/'.$row->reserve_id;?>" title="Download PDF">Download PDF</a></span>
                            <?php } }?>
                         
                            <?php if($row->property_status=='Sold'){ ?>
                                
<?php /*$atts = array(
              'width'      => '500',
              'height'     => '700',
              'scrollbars' => '1',
            );

echo  anchor_popup("admin/order/view_order/".$row->reserve_id."", '<span class="action-icons c-suspend tipTop" title="Download PDF" style="cursor:pointer;"></span>', $atts);*/ ?>
                                <?php } ?>
                                <?php if($row->property_status=='Sold'){ ?>
                                <!--<span><a class="iframe action-icons c-suspend" href="<?php echo base_url()."admin/product/reserved_product_details/".$row->reserve_id; ?>" title="View PDF">PDF</a></span>-->
                                <?php } ?>
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
								 ID
							</th><th>
								 Property ID
							</th>
                            <th>
								 Property Name
							</th>
							<th>
								 Image
							</th>
							<th>
								 Monthly Rent
							</th>
							<th>
								Event Price
							</th>
							<th>
								Display
							</th>
                            <th>
								Property Status
							</th>
							<th>
								Created On
							</th>
                            <th >
								Sold Details
							</th>
							<th>
								Action
							</th>
						</tr>
						</tfoot>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="statusMode" id="statusMode"/>
			<input type="hidden" name="SubAdminEmail" id="SubAdminEmail"/>
		</form>	
			
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>
