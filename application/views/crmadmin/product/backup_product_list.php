<?php
$this->load->view('crmadmin/templates/header.php');
extract($crm_privileges);
$rental = $$urlState;
?>


<div id="content">
	<div class="grid_container">
	<?php 
		$attributes = array('id' => 'display_form');
		echo form_open('crmadmin/product/change_product_status_global',$attributes); 
	?>
	<div class="grid_12">
		<div class="widget_wrap">
			<div class="widget_top">
				<span class="h_icon blocks_images"></span>
				<h6><?php echo $heading; ?></h6>
				<div style="float: right;line-height:40px;padding:0px 10px;height:39px;">
				<?php if ($allPrev == '1' || in_array('1', $rental)){?>
					<!--<div class="btn_30_light" style="height: 29px;">
						<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Publish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to publish records"><span class="icon accept_co"></span><span class="btn_link">Publish</span></a>
					</div>
					<div class="btn_30_light" style="height: 29px;">
						<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('UnPublish','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to unpublish records"><span class="icon delete_co"></span><span class="btn_link">UnPublish</span></a>
					</div>-->
				<?php 
					} if ($allPrevCrm == '1' || in_array('2', $rental)){ ?>
					<!--<div class="btn_30_light" style="height: 29px;">
								<a href="javascript:void(0)" onclick="return checkBoxValidationAdmin('Delete','<?php echo $subAdminMail; ?>');" class="tipTop" title="Select any checkbox and click here to delete records"><span class="icon cross_co"></span><span class="btn_link">Delete</span></a>
							</div>-->
						<?php }?>
						</div>
					</div>
                    
					<div class="widget_content">
                    	<!--id="subadmin_tbl" class="tbl_details"-->
                        <table class="display display_tbl tbl_details " id="">
						<thead>
                        <!--<div class="click_doc">
                        	<span style="float:left; font-size:13px; font-weight:bold; color:#333333; margin:15px 0px 0 12px;">Click in Icon to View</span>
                            
                        </div>-->
                        
						<tr>
                            <th class="tip_top" title="Click to sort">
								Type
							</th>
                            <th class="tip_top" title="Click to sort">
								 Code
							</th>
							<th class="tip_top" title="Click to sort">
								 Property Address
							</th>
							<th class="tip_top" title="Click to sort">
								 Purchase Price
                            </th>
							<th>
								Sales Type
							</th>
							<th class="tip_top" title="Click to sort">
								Entity Name
							</th>
							
                            <th class="tip_top" title="Click to sort">
								Buyer First Name
							</th>
                             <th class="tip_top" title="Click to sort">
								Buyer Last Name
							</th>
							<th class="tip_top" title="Click to sort">
								Buyer Email Address
							</th>
                            <th class="tip_top" title="Click to sort">
								Buyer Phone
							</th>
							<th>
								 Sale Date
							</th>
							
 						</tr>
						</thead>
						<tbody>
						<?php 
						if ($productList->num_rows() > 0){
							foreach ($productList->result() as $row){
								
						?>
                         
						<tr >
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
                            <td class="center">
								<?php echo $row->property_id;?>
							</td>
                            <td class="center">
								<?php echo $row->address.','.$row->cityname.','.$row->statename;?>
							</td>
							<td class="center">
						 		
                                <?php echo number_format($row->sales_price,0); ?>
							</td>
							<td class="center">
								<?php echo $row->sales_cash.' '.$row->sales_cf.' '.$row->sales_fs.' '.$row->sales_sl.' '.$row->sales_sdira;?>
							</td>
							<td class="center">
								<?php echo $row->entity_name;?>
							</td>
							
                            <td class="center">
								<?php echo $row->first_name;?>
							</td>
                             <td class="center">
								<?php echo $row->last_name;?>
							</td>
							<td class="center">
								<?php echo $row->email;?>
							</td>
                            <td class="center">
								<?php echo $row->phone_no; ?>
							</td>
							<td class="center">
								<?php echo date('m/d/Y',strtotime($row->dateAdded)); ?>
                         
							</td>
                             
                             <input type="hidden" value="<?php echo $row->id; ?>" id="reserved_Id" />
                             
						</tr>
                       	
                        <?php if ($allPrevCrm == '1' || in_array('1', $rental)){ ?>
                          
	                        <div id="showId_<?php echo $row->property_id;?>" style="display:none;"> 

                           
   								<ul class="doc_list">
                       
                            	<li class="doc_grey"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/general';?>" class="general_popup ajax">General</a></li>
                                
                                <li class="<?php if($row->loi_status == 'processing') echo 'doc_yellow'; else if($row->loi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/loi';?>" class="loi_popup ajax">LOI</a></li>
                 
                <?php if($row->sales_sl != '' || $row->sales_cf != '' || $row->sales_cash || $row->sales_sdira != '') {?>
                                <li class="<?php if($row->articles_status == 'processing') echo 'doc_yellow'; else if($row->articles_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/articles';?>" class="ein_popup ajax"><?php if($row->sales_sdira != '') echo 'Custodian Doc'; else echo 'Articles / EIN';?></a></li>
                                
                <?php } ?>
                 
                                <li class="<?php if($row->pa_status == 'processing') echo 'doc_yellow'; else if($row->pa_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/pa';?>" class="pa_popup ajax">PA</a></li>
                                
              
                <?php if($row->sales_sl != ''){ ?>
                                <li class="doc_grey"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/llc';?>" class="llc_popup ajax">LLC</a></li>
                               
              
                <?php } if($row->sales_sl != '' || $row->sales_fs != '' || $row->sales_cf != '') { ?> 
                                <li class="<?php if($row->loan_status == 'processing') echo 'doc_yellow'; else if($row->loan_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/loan';?>" class="loan_popup ajax">Loan Docs</a></li>
                           
              
                <?php } if($row->sales_sl != '' || $row->sales_fs != '' || $row->sales_cf != '') { ?>     
                                <li class="doc_grey"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/fedex';?>" class="fedex_popup ajax">Fedex Labels</a></li>
              
                <?php } if($row->sales_sl != '' || $row->sales_fs != '' || $row->sales_sdira != '') {?> 
                                <li class="<?php if($row->doi_status == 'processing') echo 'doc_yellow'; else if($row->doi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/doi';?>" class="doi_popup ajax" <?php if($row->sales_fs != '') echo 'style="width:85px;"'; ?>>DOI<?php if($row->sales_fs != '') echo ' / Reoccuring Bill Pay'; ?></a></li>
                                
               <?php } ?>
               
                                <li class="<?php if($row->insurance_status == 'processing') echo 'doc_yellow'; else if($row->insurance_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/insurance';?>" class="insurance_popup ajax">Insurance</a></li>
                                
                                <li class="<?php if($row->funded_status == 'processing') echo 'doc_yellow'; else if($row->funded_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/funded';?>" class="fund_popup ajax">Funded</a></li>
                                
                                <li class="<?php if($row->closed_status == 'processing') echo 'doc_yellow'; else if($row->closed_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/closed';?>" class="closed_popup ajax">Closed</a></li>
                                
                                <li class="<?php if($row->hand_off_status == 'processing') echo 'doc_yellow'; else if($row->hand_off_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/hand_off';?>" class="pmhand_popup ajax">PM Hand Off</a></li>
                                
                                <li class="doc_grey"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/master';?>" class="master_popup ajax">Master Notes</a></li>
                                <li class="<?php if($row->invoice_status == 'processing') echo 'doc_yellow'; else if($row->invoice_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="crmadmin/product/display_property_popup/<?php echo $row->id.'/invoice';?>" class="invoice_popup ajax">Invoice</a></li>
                                
                            </ul>
                           
            		        </div>
                          <?php } ?>
                       
                                          
						<?php 
							} }else{ ?>
						<tr>
                          <td colspan="11"><center>No Records Found...</center></td>
                        </tr>
						<?php } ?>
                       
						</tbody>
						<tfoot>
						<tr>
							<th>
								 Type
							</th>
                            <th>
								 Code
							</th>
                            <th>
								 Property Address
							</th>
							<th>
								 Purchase Price
							</th>
							<th>
								 Sales Type
							</th>
							<th>
								Entity Name
							</th>
							<th>
								Buyer First Name
							</th>
                            <th>
								Buyer Last Name
							</th>
							<th>
								Buyer Email Address
							</th>
                            <th >
								Buyer Phone
							</th>
							<th>
								Sale Date
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
$this->load->view('crmadmin/templates/footer.php');
?>