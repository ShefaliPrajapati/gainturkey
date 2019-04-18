<?php
$this->load->view('crmadmin/templates/header.php');
?>
<style>
.chzn-container .chzn-results{
	max-height: 150px !important; 
}
.spe{
        height:29px !important;
    } 
</style>

<div id="content">
  <div class="grid_container">
    <div class="grid_12">
      <div class="widget_wrap">
        <div class="widget_top"> <span class="h_icon list"></span>
          <h6>Create Report</h6>
        
          <div id="widget_tab">
            
          </div>
        </div>
        <div class="widget_content">
			<?php 
				/* $attributes = array('class' => 'form_container left_label', 'id' => 'createreport_form', 'enctype' => 'multipart/form-data');
				echo form_open_multipart('crmadmin/report/createreport',$attributes)  */
			?>
             
			<form id="createreport_form" method="GET" action="crmadmin/report/createreport" class="form_container left_label" autocomplete="off"> 
            <ul>
            <li>
				<div class="form_grid_12">
					<label class="field_title" for="datefrom">Date Range<span class="req">*</span></label>
						<div class="form_input">
							<input name="datefrom" id="datefrom" type="text" tabindex="1" class="required small tipTop datepicker1" title="Please select the date"/>
						
						To	
						
							<input name="dateto" id="dateto" type="text" tabindex="2" class="required small tipTop datepicker1" title="Please select the date"/>
						</div>
				</div>
			</li>
			
			<!--<li>
				<div class="form_grid_12">
					<label class="field_title" for="group">Max No. of Coupons <span class="req">*</span></label>
						<div class="form_input">
							<input name="quantity" id="quantity" type="text" tabindex="3" class="required small tipTop" title="Please enter the quantity"/>
						</div>
				</div>
			</li>-->
			
			<li>
				<div class="form_grid_12">					
					<div class="form_input">						
						<input type="radio" name="deals" id="process_deal" value="1" tabindex="3" checked="checked">	Processing Deals
						<input type="radio" name="deals" id="new_deal" value="2" tabindex="4">	New Deals
						<input type="radio" name="deals" id="complete_deal" value="3" tabindex="4">	Completed Deals
						<input type="radio" name="deals" id="cancel_deal" value="4" tabindex="5">   Cancelled Deals
						<input type="radio" name="deals" id="swap_deal" value="5" tabindex="5">	Swapped Deals
						<input type="radio" name="deals" id="all_deal" value="6" tabindex="5">	All Deals
					</div>
				</div>
			</li>
						
			<li class="spe">
				<div class="form_grid_12">			
					<label class="field_title" for="group">Code</label>
					<div class="form_input">
											
                                            <?php if ($this->session->userdata("ror_crm_session_admin_name") == "ReturnRentalAdmin" || $this->session->userdata("ror_crm_session_admin_name") == "tcadmin") { ?>
                                                 <select class="chzn-select " name="code" tabindex="6" style="width: 200px; float:left;" data-placeholder="Select Code">
													<option value=""></option>
												 <?php foreach ($reportcode->result() as $code) { ?>
                                                    
                                                    <option value="<?php echo $code->attribute_name; ?>"><?php echo $code->attribute_name; ?></option>
                                                    
                                            <?php }?>
											</select>
                                            <?php } else { ?>
                                                   <input type="text" name="code" id="code" value="ZUR" readonly  style="width: 194px; float:left;"/>
                                            <?php } ?>
                                        
                                    </div>
				</div>
			</li>
			
			<li>
				<div class="form_grid_12">		
					<label class="field_title" for="group">Reservation Source</label>
					<div class="form_input">						
						<select class="chzn-select " name="reservation_source" tabindex="7" style="width: 200px; float:left;" data-placeholder="Select Reservation Source">
							<option value=""></option>
							<option value="event">Event</option>
							<option value="office">Office</option>
						</select>
					</div>
				</div>
			</li>
			
			<li>
				<div class="form_grid_12">			
					<label class="field_title" for="group">State</label>
					<div class="form_input">						
						<select class="chzn-select " name="state" tabindex="8" style="width: 200px; float:left;" data-placeholder="Select State">
							<option value=""></option>
							<?php foreach($reportstate->result() as $state) { ?>
								<option value="<?php echo $state->seourl; ?>"><?php echo $state->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</li>
					
			<li>
				<div class="form_grid_12">			
					<label class="field_title" for="group">Sales Type</label>
					<div class="form_input">						
						<select class="chzn-select " name="sales_type" tabindex="9" style="width: 200px; float:left;" data-placeholder="Select Sales Type">
							<option value=""></option>
							<option value="sales_cash">CASH PURCHASE</option>
							<option value="sales_cf">CASH + FINANCE</option>
							<option value="sales_cs">SDIRA</option>
							<option value="sales_fs">FINANCE + SDIRA</option>
							<option value="sales_sl">SDIRA LLC</option>
							<option value="sales_sl_fs">SDIRA LLC + FINANCE</option>							
						</select>
					</div>
				</div>
			</li>
			
			<li>
				<div class="form_grid_12">			
					<label class="field_title" for="group">Sold Admin Name</label>
					<div class="form_input">						
						<select class="chzn-select " name="sold_admin" tabindex="10" style="width: 200px; float:left;" data-placeholder="Select Sold Admin Name">
							<option value=""></option>
							<?php foreach($soldadminName->result() as $adminname) { ?>
								<option value="<?php echo $adminname->sold_admin_name; ?>"><?php echo $adminname->sold_admin_name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</li>
			
			<li>
				<div class="form_grid_12">					
					<div class="form_input">						
						<input type="checkbox" name="show_property" checked="checked" value="spa" tabindex="11">   Show Property Address
						<input type="checkbox" name="show_purchase" checked="checked" value="spp" tabindex="12">   Show Purchase Price
					</div>
				</div>
			</li>
			
			<li>
              <div class="form_grid_12">
                  <div class="form_input">
                   <input type="submit" name="general" id="generalInfo" class="btn_small btn_blue nxtTab" tabindex="13" value="CREATE REPORT"/>
                  </div>
                </div>
              </li>
            </ul>          
         </form>
        </div>		
      </div>
    </div>
  </div>
  <span class="clear"></span> </div>
</div>
<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

	<!-- CSS and JS for our code -->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/site/jquery-gmaps-latlon-picker.css"/>
	<script src="<?php echo base_url(); ?>js/site/jquery-gmaps-latlon-picker.js"></script>-->
<?php 
$this->load->view('crmadmin/templates/footer.php');
//include_once('googlemap.php');
?>
