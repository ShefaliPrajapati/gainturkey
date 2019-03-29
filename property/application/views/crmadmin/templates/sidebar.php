<?php $currentUrl = $this->uri->segment(2,0); $currentPage = $this->uri->segment(3,0); $currentCurl = $this->uri->segment(4,0);
if($currentUrl==''){$currentUrl = 'dashboard';} if($currentPage==''){$currentPage = 'dashboard';}
?>
<div id="left_bar" >

	<div id="sidebar">
		<div id="secondary_nav">
			<ul id="sidenav" class="accordion_mnu collapsible">

				<li><a href="<?php echo base_url();?>crmadmin/dashboard/admin_dashboard" <?php if($currentUrl=='dashboard'){ echo 'class="active"';} ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
				<li><h6 style="margin: 10px 0;padding-left:40px;font-weight:normal;">Managements</h6></li>
                
				<?php extract($crm_privileges);
				//echo '<pre>'; print_r($crm_privileges);
				 if ($allPrevCrm == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='adminlogin'){ echo 'class="active"';} ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='adminlogin' || $currentUrl=='sitemapcreate'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="crmadmin/adminlogin/display_admin_list" <?php if($currentPage=='display_admin_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
					<li><a href="crmadmin/adminlogin/change_admin_password_form" <?php if($currentPage=='change_admin_password_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
					<li><a href="crmadmin/adminlogin/admin_global_settings_form" <?php if($currentPage=='admin_global_settings_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
                    <li><a href="crmadmin/adminlogin/admin_smtp_settings" <?php if($currentPage=='admin_smtp_settings'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
                    <?php /*?><li><a href="crmadmin/sitemapcreate" <?php if($currentUrl=='sitemapcreate'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li><?php */?>
				</ul>
				</li>
                
				<li><a href="#" <?php if($currentUrl=='subadmin'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> Subadmin<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='subadmin'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="crmadmin/subadmin/display_sub_admin" <?php if($currentPage=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Subadmin List</a></li>
					<li><a href="crmadmin/subadmin/add_sub_admin_form" <?php if($currentPage=='add_sub_admin_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add New Subadmin</a></li>
				</ul>
				</li>
                
                <li><a href="#" <?php if($currentUrl=='state'){ echo 'class="active"';} ?>><span class="nav_icon user"></span> States<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='state'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="crmadmin/state/display_state" <?php if($display_state=='display_sub_admin'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>State List</a></li>
				</ul>
				</li>
              
                
                <?php }
				

				 if ((isset($all) && is_array($all)) && in_array('0', $all) || $allPrevCrm == '1'){ 	?>
				<li><a href="#" <?php if($currentCurl == 'all' && $currentUrl=='product' && $currentPage !='display_document'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> All Deals<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentCurl == 'all' &&  $currentUrl=='product' && $currentPage !='display_document'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="crmadmin/product/display_product_list/all" <?php if($currentPage=='display_product_list' && $currentCurl == 'all'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal List</a></li>
					                    
				</ul>
				</li>
                <?php } ?>
                
                <?php foreach($stateDetails->result_array() as $stateDets){
					$urlName = '';
					$urlName = $stateDets['seourl'];
					$crmnames = $crm_privileges[$urlName];
					//echo '<pre>'; print_r($crmnames);					
						 if ((isset($crmnames) && is_array($crmnames)) && in_array('0', $crmnames) || $allPrevCrm == '1'){ 	?>
				<li><a href="#" <?php if($currentCurl == $urlName && $currentCurl != '0'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> <?php echo $stateDets['name']; ?><span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentCurl == $urlName && $currentCurl != '0'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
                  
                  
					<li><a href="crmadmin/product/display_product_list/<?php echo $urlName; ?>" <?php if($currentCurl== $urlName && $currentCurl != '0'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal List</a></li>
					                    
				</ul>
				</li>
                
                <?php } } ?>
                
                
                <?php  /*} if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrevCrm == '1'){  ?>
				<li><a href="#" <?php if($currentUrl=='newsletter'){ echo 'class="active"';} ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='newsletter'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					
					<?php if ($allPrevCrm == '1' || in_array('1', $newsletter)){?>
					<li><a href="crmadmin/newsletter/display_newsletter" <?php if($currentPage=='display_newsletter'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
                  
					<?php }?>
				</ul>
                </li>
				<!--</li>

				<?php } if ((isset($location) && is_array($location)) && in_array('0', $location) || $allPrevCrm == '1'){ ?>
				<li><a href="#" <?php if($currentUrl=='location'){ echo 'class="active"';} ?>><span class="nav_icon globe"></span> Location<span class="up_down_arrow">&nbsp;</span></a>
				<ul class="acitem" <?php if($currentUrl=='location'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="admin/location/display_location_list" <?php if($currentPage=='display_location_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Location List</a></li>
                 
				</ul>
				</li>-->
                
                <?php*/ if ((isset($completed) && is_array($completed)) && in_array('0', $completed) || $allPrevCrm == '1'){ 	?>
				<li><a href="#" <?php if($currentCurl == 'completed' && $currentUrl=='product' && $currentPage !='display_document' ){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Completed Deals<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentCurl == 'completed' &&  $currentUrl=='product' && $currentPage !='display_document'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
                  
                  
					<li><a href="crmadmin/product/display_product_list/completed" <?php if($currentPage=='display_product_list' && $currentCurl == 'completed'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal List</a></li>
					                    
				</ul>
				</li>
                
                <?php } if ((isset($cancelled) && is_array($cancelled)) && in_array('0', $cancelled) || $allPrevCrm == '1'){?>
                <li><a href="#" <?php if($currentCurl == 'cancelled' && $currentUrl=='product' && $currentPage !='display_document'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Cancelled Deals<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentCurl == 'cancelled' &&  $currentUrl=='product' && $currentPage !='display_document'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
                  
                  
					<li><a href="crmadmin/product/display_product_list/cancelled" <?php if($currentPage=='display_product_list' && $currentCurl == 'cancelled'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal List</a></li>
                    
                    
					                    
				</ul>
				</li>
				
				<?php } if ((isset($swapped) && is_array($swapped)) && in_array('0', $swapped) || $allPrevCrm == '1'){?>
                <li><a href="#" <?php if($currentCurl == 'swapped' && $currentUrl=='product' && $currentPage !='display_document'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Swapped Deals<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentCurl == 'swapped' &&  $currentUrl=='product' && $currentPage !='display_document'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
                  
                  
					<li><a href="crmadmin/product/display_product_list/swapped" <?php if($currentPage=='display_product_list' && $currentCurl == 'swapped'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Deal List</a></li>
                    
                    
					                    
				</ul>
				</li>
                
                <?php /*?><li><a href="crmadmin/product/display_document" <?php if($currentPage=='display_document' && $currentCurl == 'cancelled'){ echo 'class="active"';} ?>><span class="nav_icon folder">&nbsp;</span>Document<span class="up_down_arrow">&nbsp;</span></a></li><?php */?>
				
				<?php } if ((isset($reportmgmt) && is_array($reportmgmt)) && in_array('0', $reportmgmt) || $allPrevCrm == '1'){?>
                <li><a href="#" <?php if($currentUrl == 'report'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Report Management<span class="up_down_arrow">&nbsp;</span></a>
				  <ul class="acitem" <?php if($currentUrl == 'report'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>
					<li><a href="crmadmin/report/create_report" <?php if($currentPage=='create_report'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Create Report</a></li>
                    
                    
					                    
				</ul>
				</li>
				
                <?php } ?>
			</ul>
		</div>
	</div>
</div>