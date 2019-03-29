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
                     	<h2 class="dashboard_heading"><!--Welcome to Morocco Renters Admin Panel--></h2>
                       <table width="99%" border="0" cellspacing="0" cellpadding="0" class="property_table">
  <tr>
    <td width="5%"><input type="checkbox" class="sub_check"/></td>
    <td width="20%"><span>Inquiry For Property Name</span></td>
    <td width="13%"><span>Inquirer First Name</span></td>
    <td width="10%"><span>Inquirer Email</span></td>
    <td width="10%"><span>Inquired Date</span></td>
    <td width="12%"><span>Inquired Status</span></td>
    <td width="25%"><span>Action</span></td>
  </tr>
  <?php 
  if($InquirieDisplay->num_rows() > 0){
  		foreach($InquirieDisplay->result() as $InquiryRow){
		echo '<tr><td><input type="checkbox" class="sub_check"/></td>';
			if($ProductDisplay->num_rows() > 0){
				foreach($ProductDisplay->result() as $ProductRow){
					if($ProductRow->id==$InquiryRow->rental_id){
					?>
                    
                    <?php
						echo '<td>'.$ProductRow->product_name.'</td>';
					}	
				}
				
			}
			echo '<td>'.$InquiryRow->lastname.'</td>
			<td>'.$InquiryRow->email.'</td>
    		<td><a href="#">'.$InquiryRow->dateAdded.'</a></td>
    		<td><a href="#" class="submit_btn_active_1">'.$InquiryRow->read_staus.'</a></td>
			<td>
    		<div class="edit"><img src="images/edit.png" /><a href="site/contact/view_inquiry_details/'.$InquiryRow->id.'">View</a></div>
    		<div class="edit"><img src="images/delete.png" /><a href="#">Delete</a></div>
			<div class="edit"><img src="images/delete.png" /><a href="admin/product/view_calendar/137"><span class="action-icons1 c1-edit1 tipTop" style="margin-bottom:-10px" title="Calender">fgf</span>fgf</a></div>
    		</td></tr>';
			
		}
		
  }else{
  
  	echo '<tr><td colspan="6">No record found.</td></tr>';
  
  }
   ?>
</table>
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
<div style='display:none'>

  <div id='inline_reg' style='background:#fff;'>
  
  		<div class="popup_page">
  
  			<div class="popup_header"> Sign up </div>
            
            <div class="popup_detail">
            
            	<div class="banner_signup">
                            	
                                           	
                                <a class="popup_facebook" onclick="window.location.href='<?php echo base_url().'facebook/user.php'; ?>'">Sign up with Facebook</a>
                               
                                	
                                 <span class="popup_signup_or">OR</span>
                                 <button class="btn btn-block btn-primary large btn-large padded-btn-block register-popup" type="submit">Sign up with Email</button>
                                 <p style="font-size:11px; margin:10px 0">By clicking "Sign up with Facebook" you confirm that you accept the <a data-popup="true" href="#">Terms of Service</a> and <a data-popup="true" href="#">Privacy Policy</a>.</p>
                                 <span class="popup_stay">Already member?<a href="#" style="font-size:13px; margin:0 0 0 3px" class="all-link login-popup">Log in</a></span>
                            </div>
                    
                    	
            </div>
        
        </div>
        
  </div>
  
</div>