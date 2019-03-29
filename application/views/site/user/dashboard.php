<?php
$this->load->view('site/templates/header');
?>
<script src="js/site/menu.js" type="text/javascript"></script>
<!--selection-->
<div class="clear"></div>
<!--body content-->
<section><div class="main">
	
    			    <div class="dashboard_full">
    					<div class="page_title W99">Dashboard</div>
                			<div class="dashboard_full_tex">
                        <?php 
							$this->load->view('site/templates/dashboard_side');
						?>
                     <!---left_dashboard--->
                     <!---right dashboard--->
                     <div class="right_dashboard_content">
                     	<!--<h2 class="dashboard_heading">Welcome to <?php echo $meta_title;?> Admin Panel</h2>-->
                        <div class="link_split">
                       		 <a href="dashboard/admin_settings"><img src="images/ad_1.png" /></a>
                         	 <div class="clear"></div>
                       		 <span><a href="dashboard/admin_settings">My Profile</a></span>
                        </div>
                         <?php if($userDetails->row()->group == 'Seller') {?>
                         <div class="link_split">
                       		 <a href="display_rentals_list"><img src="images/ad_2.png" /></a>
                             <div class="clear"></div>
                       		 <span style="margin-left: 15px;"><a href="display_rentals_list">Rental</a></span>
                        </div>
                        <?php } ?>
                         <div class="link_split">
                       		 <a href="view_inquiries"><img src="images/ad_3.png" /></a>
                         	 <div class="clear"></div>
                       		 <span><a href="view_inquiries" class="margin_a">Inquiry</a></span>
                        </div>
                       
                         <div class="link_split">
                       		 <a href="view_reviews"><img src="images/ad_4.png" /></a>
                         	 <div class="clear"></div>
                       		 <span><a href="view_reviews" class="margin_a">Reviews</a></span>
                             
                        </div>
                        
                        
                        
                        <div class="clear"></div>
                        <!-- <div class="split_active_left">
                          <h1>Subscription</h1>
                          <div class="clear"></div>
                       	 
                             <div class="clear"></div>
                             <h2>Total listing:</h2>
                             <span>2</span>
                             
                        </div> -->
                       <?php if($userDetails->row()->group == 'Seller') { ?>
                        <div class="clear"></div>
                        <div class="total_count">
                       		 <a href="view_inquiries"><img src="images/cont_add.png" /></a>
                         	 <div class="clear"></div>
                       		 <span><a href="view_inquiries">Total Customers</a></span>
                            <p> <?php echo $InquirieDisplay->num_rows(); ?></p>
                             
                            
                        </div>
                      <div class="total_count">
                       		 <a href="display_rentals_list"><img src="images/property.png" /></a>
                         	 <div class="clear"></div>
                       		 <span><a href="display_rentals_list">Total Rental</a></span>
                             <p><?php echo $user_count->row()->products;?></p>
                        </div>
                        
                        <?php } ?>
                        
                      
                        <div class="clear"></div>
                        
                        
                        
                     
                     <!---right dashboard--->
                     </div>
                     
                	</div>
                </div>
               
		    </div>
   
<!--body content-->
</section>
<?php 
$this->load->view('site/templates/footer');
?>