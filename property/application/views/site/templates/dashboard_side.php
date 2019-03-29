<?php $currentUrl = $this->uri->segment(1); ?>
<div class="left_dashboard_menu">
                            	        	<ul id="menu" class="menu noaccordion">
		<li >
			<a href="dashboard">Dashboard</a>
            <ul class="submenu" id="submenu1">
                    <li><a href="dashboard" <?php if($currentUrl == 'dashboard') echo 'class="active"'; ?>>Dashboard Details</a></li>                   
                </ul> </li>
				<li><a href="#">Setting</a>
                <ul class="submenu" id="submenu1">
                    <li><a href="dashboard/admin_settings" <?php if($this->uri->segment(2) == 'admin_settings') echo 'class="active"'; ?>>Account Setting</a></li>                   
                </ul>
                
                
                </li>
				<!--<li><a href="#">Owner admin</a></li>
				<li><a href="#">Customer</a></li>-->
			
		</li>
        <?php if($userDetails->row()->group == 'Seller') {?>
		<li>
			<a href="#">Rental</a>
			<ul>
				<li><a href="add_rental" <?php if($currentUrl == 'add_rental') echo 'class="active"'; ?>>Add Rental</a></li>
				<!--<li><a href="display_rentals_list" <?php if($currentUrl == 'display_rentals_list') echo 'class="active"'; ?>>View Rental</a></li>-->
				
			</ul>
		</li>
       <?php } ?>
         <li class="active"  >
			<a href="#">Manage Inquiries</a>
			<ul>
				<li style="background:#ff8f12;"><a href="view_inquiries" <?php if($currentUrl == 'view_inquiries') echo 'class="active"'; ?>>View Inquiries</a></li>
			</ul>
		</li>
         
         <li >
			<a href="#">Manage Reviews</a>
			<ul>
				<li><a href="view_reviews" <?php if($currentUrl == 'view_reviews') echo 'class="active"'; ?>>View Reviews</a></li>
			</ul>
		</li>
      
	</ul>	
                
        			 </div>&nbsp;
                     
                     <?php 
					 	if($this->uri->segment(1) != dashboard)
							{
								echo '<a href="'.base_url(dashboard).'" style="font-size:12px;">Dashboard</a> <b style="font-size:10px"> > </b>';
					 			echo '<b style="font-size:12px">'.ucfirst(str_replace("_"," ",$this->uri->segment(1))).'</b>';
							}
					 ?>