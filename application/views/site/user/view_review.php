<?php
$this->load->view('site/templates/new_header');
?>
<div style="display:none">
<div class="popup" id="inquiry_popup" style="display:none;">
	<h1>Loading...</h1>
</div></div>
<p class="inquiry_link"></p>  
		<script src="js/site/jquery.colorbox.js"></script>
		<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements

				//$(".ajax").colorbox();

				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<script src="js/site/menu.js" type="text/javascript"></script>
<!--selection-->
<div class="clear"></div>
<!--body content-->
<section><div class="main">
	
    			    <div class="dashboard_full">
    					<div class="page_title W99">Reviews</div>
                			<div class="dashboard_full_tex">
                        <?php 
							$this->load->view('site/templates/dashboard_side');
						?>   	
                     <!---left_dashboard--->
                     <!---right dashboard--->
                     
                     
                     
                     
                     
                     
                     <div class="personal_text" style="min-height:184px; overflow:hidden; width: 780px;">
                     		<!--<h2 class="dashboard_heading">Welcome to <?php echo $meta_title;?> Admin Panel</h2>-->
                               <table width="96%" border="0" cellpadding="2" cellspacing="0" class="member_ship">
                                   
                                <tr>
                                <td width="20%" style="background:#f5f5f5;"><strong>Rental Name</strong></td>
                                <td width="10%" style="background:#f5f5f5;"><strong>Guest Name</strong></td>
                                
                                <td width="5%" style="background:#f5f5f5;"><strong>Rating</strong></td>
                                <td width="10%" style="background:#f5f5f5;"><strong>Title</strong></td>
                                
                                <td width="7%" style="background:#f5f5f5;"><strong>Arrival Date</strong></td>
                                <td width="10%" style="background:#f5f5f5;"><strong>Location</strong></td>
                                <td width="15%" style="background:#f5f5f5;"><strong>Action</strong></td>
                                </tr>
                                <?php 
  if($ReviewDisplay->num_rows() > 0){
  		foreach($ReviewDisplay->result() as $InquiryRow){
			//if($ProductRow->user_id==$fc_session_user_name){
		echo '<tr id="row_'.$InquiryRow->id.'"><td>';
		if($ProductDisplay->num_rows() > 0){
				foreach($ProductDisplay->result() as $ProductRow){
					if($ProductRow->id==$InquiryRow->product_id){
					?>
                    
                    <?php
						echo $ProductRow->product_name;
					}	
				}
				
			}
		echo '</td><td>'.$InquiryRow->full_name.'</td>
		
		<td>'.$InquiryRow->rateVal.'</td>
		<td>'.$InquiryRow->title.'</td>
		
	    <td>'.date('m/d/Y',strtotime($InquiryRow->date_arrival)).'</td>
		<td>'.$InquiryRow->location.'</td>
		<td><div class="edit"><img src="images/edit.png" /><a class="inquiry-popup ajax" onclick="return view_review('.$InquiryRow->id.');" href="javascript:void(0);">View</a> </div></td>
		</tr>';
		}
		
		
  }else{
  
  	echo '<tr><td colspan="9" align="center">No record found.</td></tr>';
  
  }
   ?>              
                              </table>
                              
                                     
                                </div>
                         
                	</div>
                </div>
               
		    </div>
   
<!--body content-->
</section>
<?php
$this->load->view('site/templates/new_footer');
?>
