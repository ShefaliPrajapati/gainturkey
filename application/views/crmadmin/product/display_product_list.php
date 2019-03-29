<?php $this->load->view('crmadmin/templates/header.php');
extract($crm_privileges);

$rental = $crm_privileges[$urlState];

$complet = $crm_privileges['completed'];

//echo '<pre>'; print_r($rental);die;
$condition = $this->uri->segment(4);
$propid = $this->uri->segment(5);
$type = $this->uri->segment(6);

if($propid != '' && $type != '')
{
echo '<script>
$(document).ready(function(){
	$.colorbox({href:baseURL+"crmadmin/product/display_property_popup/'.$propid.'/'.$type.'/'.$condition.'"});
});
</script>';
}					
?>
<script>
function popupCall(valID){
	$.colorbox({href:baseURL+"crmadmin/product/display_property_popup/"+valID});
}
</script>

<input type="hidden" name="pagenames" id="pagenames" value="<?php echo $condition;?>" />
<div id="content">

	<?php /* ?><div class="grid_container">
<form action="crmadmin/product/product_list_search" method="post" name="formSearch" id="formSearch" enctype="multipart/form-data">
     <input type="hidden" name="sCurrentURL" id="sCurrentURL" value="<?php echo current_url(); ?>" />
     Search By:
     <select name="fieldType" id="fieldType" class="input_select fleft MR6">
		<option value="">Choose</option>
		<option value="p.property_id">Code</option>
 		<option value="p.res_source">Type</option>
 		<option value="p.sales_price">Price</option>
		<!-- <option value="sales_cash,sales_cf,sales_fs,sales_sl,sales_sdira">Sales type</option>-->
 		<option value="p.phone_no">Buyer phone</option>
 		<option value="p.entity_name">Entity Name</option>
 		<option value="p.email">Buyer Email</option>
 		<option value="p.dateAdded">Sale Date</option>
	</select>
    <input type="text" name="fieldVal" id="fieldVal" onfocus="if(this.value=='Search Text') this.value='';" onblur="if(this.value=='') this.value='Search Text';" value="Search Text" class="input_text fleft MR6" />
    <input type="submit" name="searchByField" id="submit" value="Search" class="btn_small btn_blue"  onClick="return searchValidation();"/>
</form>
	</div> <?php */ ?>
	<div class="grid_container">
	<?php $attributes = array('id' => 'display_form');
			echo form_open('crmadmin/product/change_product_status_global',$attributes);?>
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
                        <table class="display" id="examplerow">
						<thead>
						<tr>
                         	<th class="tip_top" >
								S.No
							</th>
                            <th class="tip_top" >
								Type
							</th>
                            <th class="tip_top">
								 Code
							</th>
							<th class="tip_top" >
								 Property Address
							</th>
							<th class="tip_top" >
								 Purchase Price
                            </th>
							<th class="tip_top">
								Sales Type
							</th>
							<th class="tip_top">
								Entity Name
							</th>
                            <th class="tip_top" >
								Buyer First Name
							</th>
                             <th class="tip_top">
								Buyer Last Name
							</th>
							<th class="tip_top" >
								Buyer Email Address
							</th>
                            <th class="tip_top" >
								Buyer Phone
							</th>
							<th class="tip_top">
								 Sale Date
							</th>
 						</tr>
						</thead>
						<tbody>
						<?php 
						//echo "<pre>"; print_r($crm_privileges);die;
						/*foreach($codeDetails->result() as $codename)
							{
								$codes[]=$codename->attribute_seourl;
							}*/
								if ($productList->num_rows() > 0){ $i =0; $s=0;
									foreach ($productList->result() as $row){ 
									
									 $crmcodenames = $crm_privileges[strtolower($row->res_code)];
										if($this->uri->segment(4) != 'completed' && $row->invoice_status != 'complete' || $this->uri->segment(4) == 'completed') {
											
											if ((isset($crmcodenames) && is_array($crmcodenames)) && in_array(0, $crmcodenames) || $allPrevCrm == '1'){ $i++;
											
										/*if($this->uri->segment(4) != 'completed' && $row->invoice_status != 'complete' || $this->uri->segment(4) == 'completed') {
											//if ((array_key_exists($row->res_code,$crm_privileges) || $login_admin_type == ''){ 
											/*$codesExists = array_keys($crm_privileges);
											if (in_array($row->res_code,$codesExists) || $login_admin_type == ''){	*/	?>
                         
						<tr>
                        	<td class="center">
								<?php echo $i;?>
							</td>
							<td class="center">
								<?php echo $row->res_source;?>
							</td>
                            <td class="center">
								<?php echo $row->res_code;?>
							</td>
                            <td class="center">
								<?php echo $row->address.', '.$row->cityname.', '.ucwords(str_replace('-',' ',$row->statename)).', '.$row->post_code;?>
							</td>
							<td class="center">
                                <?php if($row->adjustment!=''){echo number_format($row->net_purchase_price,0);}else{echo number_format($row->sales_price,0);} ?>
							</td>
							<td class="center">
								<?php echo $row->sales_cash.' '.$row->sales_cf.' '.$row->sales_fs.' '.$row->sales_sl.' '.$row->sales_sl_fs.' '.$row->sales_sdira;?>
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
                             <input type="hidden" value="<?php echo $row->id; ?>" id="reserved_Id_<?php echo $i; ?>" />
						</tr>
                       
						<?php  } } } }else{ ?> 
						<?php /* <tr>
                          <td colspan="11"><center>No Records Found...</center></td>
                        </tr> */ ?>
						<table>
							<p><center>No Records Found...</center></p>
						</table>
						<?php } ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             						</tbody>
						<tfoot>
						<tr>
							
						</tfoot>
						</table>
					</div>	
						
						
<?php 
	 $i =0; $s=0;
		foreach ($productList->result() as $row){ 
								
			$crmcodenames = $crm_privileges[strtolower($row->res_code)];
			if($this->uri->segment(4) != 'completed' && $row->invoice_status != 'complete' || $this->uri->segment(4) == 'completed') {
					
				if ((isset($crmcodenames) && is_array($crmcodenames)) && in_array(0, $crmcodenames) || $allPrevCrm == '1'){ $i++;
											
				?>
              
                <div id="row-<?php echo $row->id; ?>" style="display:none;">
				
                    <?php if ($allPrevCrm == '1' || in_array('0', $rental)){ ?>
	            
					<ul class="doc_list1">
					<?php
					if($row->have_alert == 'Yes') {
						$alertStatus=$this->product_model->get_alarm_status($row->id);
						if($alertStatus<=0){
							$alarmClass="alarm_default";
						}else{
							$alarmClass="alarm_notify";
						}
					?>
					<li class="alarm <?php echo $alarmClass; ?>">
						<a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/view-alert-list/'.$condition;?>')" class="alert_popup">
							&nbsp;
						</a>
					</li>
					<?php } ?>
                    <?php if($row->sales_sdira == '' && $row->sales_fs == '') {?>
                       
                    <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/general/'.$condition;?>')" class="general_popup">General</a></li>
                        
                        <li class="<?php if($row->loi_status == 'processing') echo 'doc_yellow'; else if($row->loi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loi/'.$condition;?>')" class="loi_popup ">LOI</a></li>
         
                <?php if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_cf != '' || $row->sales_cash || $row->sales_sdira != '') {?>
                                
                        <li class="<?php if($row->articles_status == 'processing') echo 'doc_yellow'; else if($row->articles_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/articles/'.$condition;?>')" class="ein_popup"><?php /*if($row->sales_sdira != '') echo 'Custodian Doc'; else*/ echo 'Articles / EIN';?></a></li>
                        
                <?php } ?>
                 
         				<li class="<?php if($row->pa_status == 'processing') echo 'doc_yellow'; else if($row->pa_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/pa/'.$condition;?>')" class="pa_popup">PA</a></li>
                                
                <?php if($row->sales_sl != '' || $row->sales_sl_fs != ''){ ?>
                        <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/llc';?>')" class="llc_popup">LLC</a></li>
                               
               <?php } if( $row->sales_fs != '' || $row->sales_cf != '' || $row->sales_sl_fs != '') { //$row->sales_sl != ''?> 
                        <li class="<?php if($row->loan_status == 'processing') echo 'doc_yellow'; else if($row->loan_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loan/'.$condition;?>')" class="loan_popup">Appraisal</a></li>
              
                <?php } if($row->sales_sl != '' || $row->sales_fs != '' || $row->sales_cf != '' || $row->sales_sl_fs != '') { ?>     
                        <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/fedex/'.$condition;?>')" class="fedex_popup">Fedex Labels</a></li>
              
                <?php } if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_sdira != '') {?> 
						<li class="<?php if($row->doi_status == 'processing') echo 'doc_yellow'; else if($row->doi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/doi/'.$condition;?>')" class="doi_popup" <?php if($row->sales_fs != '' || $row->sales_sl_fs != '') echo 'style="width:85px;"'; ?>>DOI<?php if($row->sales_fs != '' || $row->sales_sl_fs != '') echo ' / Reoccuring Bill Pay'; ?></a></li>
                                
               <?php } ?>
               
                <li class="<?php if($row->insurance_status == 'processing') echo 'doc_yellow'; else if($row->insurance_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/insurance/'.$condition;?>')" class="insurance_popup">Insurance</a></li>
                
                <li class="<?php if($row->closed_status == 'processing') echo 'doc_yellow'; else if($row->closed_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/closed/'.$condition;?>')" class="closed_popup">Closing Docs</a></li>
				
				<li class="<?php if($row->funded_status == 'processing') echo 'doc_yellow'; else if($row->funded_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/funded/'.$condition;?>')" class="fund_popup">Funded</a></li>
                
                <li class="<?php if($row->hand_off_status == 'processing') echo 'doc_yellow'; else if($row->hand_off_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/hand_off/'.$condition;?>')" class="pmhand_popup">PM Hand Off</a></li>
                
                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/master/'.$condition;?>')" class="master_popup">Master Notes</a></li>
                <li class="<?php if($row->invoice_status == 'processing') echo 'doc_yellow'; else if($row->invoice_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/invoice/'.$condition;?>')" class="invoice_popup">Invoice</a></li>
                
                                  
			  <?php if($this->uri->segment(4) != 'completed' && $this->uri->segment(4) != 'cancelled' && $this->uri->segment(4) != 'swapped' && $this->session->userdata('ror_crm_session_admin_type') == ''){?>
                          <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmCancel('<?php echo $row->id;?>')">Cancel</a></li>
			              <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmSwapped('<?php echo $row->id;?>')">Swap</a></li>			  
						  
              <?php } if($this->uri->segment(4) == 'completed'){
              if($this->session->userdata('ror_crm_session_admin_type') == ''){ ?>
                          <li class="<?php if($row->ror_iv_status == 'processing') echo 'doc_yellow'; else if($row->ror_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/ror_iv/'.$condition;?>')" class="loi_popup">ROR Invoice</a></li>
                          <li class="<?php if($row->gen_iv_status == 'processing') echo 'doc_yellow'; else if($row->gen_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/gen_iv/'.$condition;?>')" class="loi_popup">Lead Gen Invoice</a></li>
              <?php } }?>
                                
                                <?php } else if($row->sales_sdira != ''){ ?>
                              
                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/general/'.$condition;?>')" class="general_popup">General</a></li>
                
                <li class="<?php if($row->loi_status == 'processing') echo 'doc_yellow'; else if($row->loi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loi/'.$condition;?>')" class="loi_popup">LOI</a></li>
                
                <li class="<?php if($row->pa_status == 'processing') echo 'doc_yellow'; else if($row->pa_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/pa/'.$condition;?>')" class="pa_popup">PA</a></li>
 
                <?php if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_sdira != '') {?> 
                                <li class="<?php if($row->doi_status == 'processing') echo 'doc_yellow'; else if($row->doi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/doi/'.$condition;?>')" class="doi_popup" <?php if($row->sales_fs != '' || $row->sales_sl_fs != '') echo 'style="width:85px;"'; ?>>DOI<?php if($row->sales_fs != '' || $row->sales_sl_fs != '') echo ' / Reoccuring Bill Pay'; ?></a></li>
                                
          
                <?php } if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_cf != '' || $row->sales_cash || $row->sales_sdira != '') {
                			if($row->sales_sdira == '') {?>
                                <li class="<?php if($row->articles_status == 'processing') echo 'doc_yellow'; else if($row->articles_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/articles/'.$condition;?>')" class="ein_popup"><?php /*if($row->sales_sdira != '') echo 'Custodian Doc'; else*/ echo 'Articles / EIN';?></a></li>
                                
                <?php } } ?>
                 
                <?php if($row->sales_sl != '' || $row->sales_sl_fs != ''){ ?>
                                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/llc/'.$condition;?>')" class="llc_popup">LLC</a></li>
                               
                <?php } if($row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_cf != '') { //$row->sales_sl != ''?> 
                                <li class="<?php if($row->loan_status == 'processing') echo 'doc_yellow'; else if($row->loan_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loan/'.$condition;?>')" class="loan_popup">Appraisal</a></li>
              
                <?php } if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_cf != '') { ?>     
                                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/fedex/'.$condition;?>')" class="fedex_popup">Fedex Labels</a></li>
              
               <?php } ?>
               
                <li class="<?php if($row->insurance_status == 'processing') echo 'doc_yellow'; else if($row->insurance_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/insurance/'.$condition;?>')" class="insurance_popup">Insurance</a></li>
                
                <li class="<?php if($row->closed_status == 'processing') echo 'doc_yellow'; else if($row->closed_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/closed/'.$condition;?>')" class="closed_popup">Closing Docs</a></li>
				
				<li class="<?php if($row->funded_status == 'processing') echo 'doc_yellow'; else if($row->funded_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/funded/'.$condition;?>')" class="fund_popup">Funded</a></li>
                
                <li class="<?php if($row->hand_off_status == 'processing') echo 'doc_yellow'; else if($row->hand_off_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/hand_off/'.$condition;?>')" class="pmhand_popup">PM Hand Off</a></li>
                
                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/master/'.$condition;?>')" class="master_popup">Master Notes</a></li>
                <li class="<?php if($row->invoice_status == 'processing') echo 'doc_yellow'; else if($row->invoice_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/invoice/'.$condition;?>')" class="invoice_popup">Invoice</a></li>
                
                                
                      
					  <?php if($this->uri->segment(4) != 'completed' && $this->uri->segment(4) != 'cancelled' && $this->uri->segment(4) != 'swapped' && $this->session->userdata('ror_crm_session_admin_type') == ''){?>
                                  <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmCancel('<?php echo $row->id;?>')">Cancel</a></li>
								  <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmSwapped('<?php echo $row->id;?>')">Swap</a></li>
                      <?php } if($this->uri->segment(4) == 'completed'){
					  if( $this->session->userdata('ror_crm_session_admin_type') == '')  { ?>
                                  <li class="<?php if($row->ror_iv_status == 'processing') echo 'doc_yellow'; else if($row->ror_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/ror_iv/'.$condition;?>')" class="loi_popup">ROR Invoice</a></li>
                                  <li class="<?php if($row->gen_iv_status == 'processing') echo 'doc_yellow'; else if($row->gen_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/gen_iv/'.$condition;?>')" class="loi_popup">Lead Gen Invoice</a></li>
                      <?php } }?>
                                  
                                  
                                  
                                <?php } else if($row->sales_fs != '') { ?>
                                
                                
                                
			<li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/general/'.$condition;?>')" class="general_popup">General</a></li>
                
            <li class="<?php if($row->loi_status == 'processing') echo 'doc_yellow'; else if($row->loi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loi/'.$condition;?>')" class="loi_popup">LOI</a></li>
                
			<li class="<?php if($row->pa_status == 'processing') echo 'doc_yellow'; else if($row->pa_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/pa/'.$condition;?>')" class="pa_popup">PA</a></li>
                 
                <?php if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_sdira != '') {?> 
                                <li class="<?php if($row->doi_status == 'processing') echo 'doc_yellow'; else if($row->doi_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/doi/'.$condition;?>')" class="doi_popup" <?php if($row->sales_fs != '') echo 'style="width:85px;"'; ?>>DOI<?php if($row->sales_fs != '') echo ' / Reoccuring Bill Pay'; ?></a></li>
                                
                 
                <?php }
				 if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_cf != '' || $row->sales_cash || $row->sales_sdira != '') {?>
                                <li class="<?php if($row->articles_status == 'processing') echo 'doc_yellow'; else if($row->articles_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/articles/'.$condition;?>')" class="ein_popup"><?php /*if($row->sales_sdira != '') echo 'Custodian Doc'; else*/ echo 'Articles / EIN';?></a></li>
                <?php }
				if($row->sales_sl != '' || $row->sales_sl_fs != ''){ ?>
                                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/llc/'.$condition;?>')" class="llc_popup">LLC</a></li>
                <?php }
				if($row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_cf != '') { //$row->sales_sl != '' || ?> 
                                <li class="<?php if($row->loan_status == 'processing') echo 'doc_yellow'; else if($row->loan_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/loan/'.$condition;?>')" class="loan_popup">Appraisal</a></li>
                           
              
                <?php }
				if($row->sales_sl != '' || $row->sales_sl_fs != '' || $row->sales_fs != '' || $row->sales_cf != '') { ?>     
                                <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/fedex/'.$condition;?>')" class="fedex_popup">Fedex Labels</a></li>
              
               <?php } ?>
               
                     <li class="<?php if($row->insurance_status == 'processing') echo 'doc_yellow'; else if($row->insurance_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/insurance/'.$condition;?>')" class="insurance_popup">Insurance</a></li>
                                
                     <li class="<?php if($row->closed_status == 'processing') echo 'doc_yellow'; else if($row->closed_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/closed/'.$condition;?>')" class="closed_popup">Closing Docs</a></li>
					 
					 <li class="<?php if($row->funded_status == 'processing') echo 'doc_yellow'; else if($row->funded_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/funded/'.$condition;?>')" class="fund_popup">Funded</a></li>
                                
                     <li class="<?php if($row->hand_off_status == 'processing') echo 'doc_yellow'; else if($row->hand_off_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/hand_off/'.$condition;?>')" class="pmhand_popup">PM Hand Off</a></li>
                                
                     <li class="doc_grey"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/master/'.$condition;?>')" class="master_popup">Master Notes</a></li>
                     <li class="<?php if($row->invoice_status == 'processing') echo 'doc_yellow'; else if($row->invoice_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/invoice/'.$condition;?>')" class="invoice_popup">Invoice</a></li>
                                
                                
                      
					 <?php if($this->uri->segment(4) != 'completed' && $this->uri->segment(4) != 'cancelled' && $this->uri->segment(4) != 'swapped' && $this->session->userdata('ror_crm_session_admin_type') == ''){?>
                                  <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmCancel('<?php echo $row->id;?>')">Cancel</a></li>
								  <li class="doc_orange"><a href="javascript:void(0);" class="loi_popup " onclick="return confirmSwapped('<?php echo $row->id;?>')">Swap</a></li>
                      <?php }
					  if($this->uri->segment(4) == 'completed'){
					  if($this->session->userdata('ror_crm_session_admin_type') == ''){ ?>
                                  <li class="<?php if($row->ror_iv_status == 'processing') echo 'doc_yellow'; else if($row->ror_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/ror_iv/'.$condition;?>')" class="loi_popup">ROR Invoice</a></li>
                                  <li class="<?php if($row->gen_iv_status == 'processing') echo 'doc_yellow'; else if($row->gen_iv_status == 'complete') echo 'doc_green'; else echo 'doc_red';?>"><a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/gen_iv/'.$condition;?>')" class="loi_popup">Lead Gen Invoice</a></li>
                      <?php } }?>
                                
                                
                                
								<?php } ?>  
							<?php if($this->uri->segment(4) != 'completed' && $this->uri->segment(4) != 'cancelled' && $this->uri->segment(4) != 'swapped'){?>
								<li class="doc_grey">
									<a href="javascript:void(0);" onclick="popupCall('<?php echo $row->id.'/create-alert/'.$condition;?>')" class="alert_popup">
										Create Alert
									</a>
								</li>
							<?php }	?>
                                
                            </ul>
                   
				          <?php } ?>
                </div>          
						
						<?php  } } }  ?>
                        
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
<script>
function confirmCancel(id){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'Are you sure, you want to cancel this property?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
					
 					$.ajax({
        					type: 'POST',
							url: baseURL+'crmadmin/product/cancelProperty',
							data: {"id": id},
     						success: function()
        						{ 
									location.reload();
								}
    					});
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }
 
 function confirmSwapped(id){
 	$.confirm({
 		'title'		: 'Confirmation',
 		'message'	: 'Are you sure, you want to swap this property?',
 		'buttons'	: {
 			'Yes'	: {
 				'class'	: 'yes',
 				'action': function(){
					
 					$.ajax({
        					type: 'POST',
							url: baseURL+'crmadmin/product/swappedProperty',
							data: {"id": id},
     						success: function()
        						{ 
									location.reload();
								}
    					});
 				}
 			},
 			'No'	: {
 				'class'	: 'no',
 				'action': function(){
 					return false;
 				}	// Nothing to do in this case. You can as well omit the action property.
 			}
 		}
 	});
 }

 
</script>
<?php $this->load->view('crmadmin/templates/footer.php'); ?>