<?php
$this->load->view('crmadmin/templates/header.php');
?>
<style>
.table_bottom{
	float:left;
	width:97.2%;
}
</style>
<script type="text/javascript">
function printDiv(){

    var divToPrint=document.getElementById('widget_content');
    var newWin=window.open('','Print-Window');
    // var newWin= window.open("");
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
	setTimeout(function(){newWin.close();},0);
}
</script>
<div id="content">
		<div class="grid_container">
			<?php 
				$CUrurl = @explode('?',$_SERVER['REQUEST_URI']);
				$attributes = array('id' => 'display_form');
				echo form_open('admin/product/change_product_status_global',$attributes) 
			?>
			<div class="grid_12">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon blocks_images"></span>
						<h6><?php echo $heading?></h6>
						<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
						
						<div class="btn_30_light" style="height: 29px;">
								<a href="crmadmin/report/printexcel?<?php echo $CUrurl[1]; ?>" onclick="" class="tipTop" title="Click here to Download records"><span class="icon accept_co"></span><span class="btn_link">Download</span></a>
								
								<a href="javascript:;"  onclick='printDiv();' class="tipTop" title="Click here to Print records"><span class="icon accept_co"></span><span class="btn_link">Print</span></a>
								<!-- <a href="crmadmin/report/printexcel?<?php echo $CUrurl[1]; ?>" onclick="" class="tipTop" title="Click here to Print records"><span class="icon accept_co"></span><span class="btn_link">Print</span></a> -->
								
						<?php 
						if ($allPrev == '1' || in_array('2', $rental)){?>
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
							<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>-->
						<?php }?>
						</div>
					</div>
                    
					<div class="widget_content" id="widget_content" style="height:100%;">
						<table class="display display_tbl" id="report_tbl" style="float:left;">
						<thead>
						<tr>							
                            <th class="tip_top" title="Click to sort">
								 S.No
							</th>
                            <th class="tip_top" title="Click to sort">
								 Code
							<th class="tip_top" title="Click to sort">
								Buyer Name
							</th>
							
							<th class="tip_top" title="Click to sort">
								 Property Address
							</th>
							
							<th class="tip_top" title="Click to sort">
								 Purchase Price
							</th>
							
							<th class="tip_top" title="Click to sort">
								Sale Date
							</th>
							
							<th class="tip_top" title="Click to sort">
								Source
							</th>
							<th class="tip_top" title="Click to sort">
								Consultant
							</th>
							<th class="tip_top" title="Click to sort">
								<?php if($deals==1){
										echo 'Status';
									}elseif($deals==2){
										echo 'Status';
									}elseif($deals==3){
										echo 'Close Date';
									}elseif($deals==4){
										echo 'Cancel Date';
									}elseif($deals==5){
										echo 'Swap Date';
									}elseif($deals==6){
										echo 'Status & Date';
									}
								 ?>
							</th>
                            							
 						</tr>
						</thead>
						<tbody>
						<?php $newTotl = 0; $s=1; $g=0;
						if ($productList->num_rows() > 0){
						
						foreach ($productList->result() as $row){ ?>
						<tr>
							<td class="center">
								<?php echo $s;?>
							</td>
							<td class="center">
								<?php echo $row->res_code;?>
							</td>
							<td class="center">
								<?php echo $row->first_name.' '.$row->last_name; ?>
							</td>
							
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							
							<?php /*<td class="center">
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
							</td> */?>
							
							<td class="center">
								<?php echo '$'.number_format($row->net_purchase_price);
									$newTotl+=$row->net_purchase_price;
								?>
							</td>
							
							<td class="center">
								<?php /* if($deals=='1'){
										echo $row->dateAdded;
									}elseif($deals=='2'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
									}elseif($deals=='3'){
										echo $row->completed_date;
									}elseif($deals=='4'){
										echo $row->change_time;
									}elseif($deals=='5'){
										echo $row->change_time;
									}elseif($deals=='6'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
										
									} */
									echo $row->dateAdded;
								 ?>
								
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
							<td class="center">
								<?php echo $row->sold_admin_name; ?>
							</td>
                            
							
                            <td class="center">
								<?php if($deals==1){
										echo '<b>Processing</b>';
									}elseif($deals==2){
										echo '<b>Processing</b>';
									}elseif($deals==3){
										echo $row->completed_date;
									}elseif($deals==4){
										echo $row->change_time;
									}elseif($deals==5){
										echo $row->change_time;
									}elseif($deals==6){
										echo '<b>Processing</b>';
									}
								 ?>
							</td>	
							
                            
							
							
                         
						</tr>
						<?php
							$g = $s;
							$s++;}
						}
						if($deals==2 ||$deals==6 ){
						if ($productList1->num_rows() > 0){
						
						foreach ($productList1->result() as $row){ ?>
						<tr>
							<td class="center">
								<?php echo $g=$g+1;;?>
							</td>
							<td class="center">
								<?php echo $row->res_code;?>
							</td>
							<td class="center">
								<?php echo $row->first_name.' '.$row->last_name; ?>
							</td>
							
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							
							<?php /*<td class="center">
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
							</td> */?>
							
							<td class="center">
								<?php echo '$'.number_format($row->net_purchase_price);
									$newTotl+=$row->net_purchase_price;
								?>
							</td>
							
							<td class="center">
								<?php /* if($deals=='1'){
										echo $row->dateAdded;
									}elseif($deals=='2'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
									}elseif($deals=='3'){
										echo $row->completed_date;
									}elseif($deals=='4'){
										echo $row->change_time;
									}elseif($deals=='5'){
										echo $row->change_time;
									}elseif($deals=='6'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
										
									} */
									echo $row->dateAdded;
								 ?>
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
							<td class="center">
								<?php echo $row->sold_admin_name; ?>
							</td>
                            
							
                            <td class="center">
								<?php echo '<b>Completed</b><br>'.$row->completed_date; ?>
							</td>	
							
                            
							
							
                         
						</tr>
						<?php }	}
						
						if ($productList2->num_rows() > 0){
						
						foreach ($productList2->result() as $row){ ?>
						<tr>
							<td class="center">
								<?php echo $g=$g+1;;?>
							</td>
							<td class="center">
								<?php echo $row->res_code;?>
							</td>
							<td class="center">
								<?php echo $row->first_name.' '.$row->last_name; ?>
							</td>
							
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							
							<?php /*<td class="center">
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
							</td> */?>
							
							<td class="center">
								<?php echo '$'.number_format($row->net_purchase_price);
									$newTotl+=$row->net_purchase_price;
								?>
							</td>
							
							<td class="center">
								<?php /* if($deals=='1'){
										echo $row->dateAdded;
									}elseif($deals=='2'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
									}elseif($deals=='3'){
										echo $row->completed_date;
									}elseif($deals=='4'){
										echo $row->change_time;
									}elseif($deals=='5'){
										echo $row->change_time;
									}elseif($deals=='6'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
										
									} */
									echo $row->dateAdded;
								 ?>
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
							<td class="center">
								<?php echo $row->sold_admin_name; ?>
							</td>
                            
							
                            <td class="center">
								<?php echo '<b>Cancelled</b><br>'.$row->change_time; ?>
							</td>	
							
                            
							
							
                         
						</tr>
						<?php }	}
						if ($productList3->num_rows() > 0){
						
						foreach ($productList3->result() as $row){ ?>
						<tr>
							<td class="center">
								<?php echo $g=$g+1;;?>
							</td>
							<td class="center">
								<?php echo $row->res_code;?>
							</td>
							<td class="center">
								<?php echo $row->first_name.' '.$row->last_name; ?>
							</td>
							
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							
							<?php /*<td class="center">
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
							</td> */?>
							
							<td class="center">
								<?php echo '$'.number_format($row->net_purchase_price);
									$newTotl+=$row->net_purchase_price;
								?>
							</td>
							
							<td class="center">
								<?php /* if($deals=='1'){
										echo $row->dateAdded;
									}elseif($deals=='2'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
									}elseif($deals=='3'){
										echo $row->completed_date;
									}elseif($deals=='4'){
										echo $row->change_time;
									}elseif($deals=='5'){
										echo $row->change_time;
									}elseif($deals=='6'){
										if($row->completed_date!=''){
											echo $row->completed_date;
										}elseif($row->change_time!=''){
											echo $row->change_time;
										}elseif($row->dateAdded!=''){
											echo $row->dateAdded;	
										}
										
									} */
									echo $row->dateAdded;
								 ?>
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
							<td class="center">
								<?php echo $row->sold_admin_name; ?>
							</td>
                            
							
                            <td class="center">
								<?php echo '<b>Swapped</b><br>'.$row->change_time; ?>
							</td>	
							
                            
							
							
                         
						</tr>
						<?php }	}}
						?>
						</tbody>
						<tfoot>
						<tr>							
                            <th>
								Total: <?php echo $g; ?>
							</th>
                            <th>
								
							</th>
							<th>
								
							</th>
							
							<th>
								
							</th>
							
							<th >
								$<?php echo number_format($newTotl); ?>
							</th>
							
							<th>
								
							</th>
							
							<th>
								
							</th>
                            
							<th>
								
							</th>
                            <th>
								
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