<?php
$this->load->view('site/templates/new_header');
?>

<script src="js/site/jquery-1.2.1.min.js" type="text/javascript"></script>
<script src="js/site/menu.js" type="text/javascript"></script>
<script type="text/javascript" src="js/site/SpryTabbedPanels.js"></script>
<script type="text/javascript">

function displayfunction(id,id2,id3,id4){


if(document.getElementById(id).style.display=="none")
{
document.getElementById(id).style.display="block";
document.getElementById(id2).style.display="none";
return true;
}
if(document.getElementById(id).style.display=="block")
{
document.getElementById(id).style.display="none";
document.getElementById(id2).style.display="block";
return true;
}
if(document.getElementById(id).style.display=="block")
{
document.getElementById(id).style.display="none";
document.getElementById(id3).style.display="block";
return true;
}
if(document.getElementById(id).style.display=="block")
{
document.getElementById(id).style.display="none";
document.getElementById(id4).style.display="block";
return true;
}

}
</script>


<!--[if lt IE 9]>
<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
</head>
<body>

<div class="clear"></div>
<!--body content-->
<section>
<div class="main">
	
    			    <div class="dashboard_full">
    					<div class="page_title W99">Testimonials</div>
                			<div class="dashboard_full_tex">

                     <!---left_dashboard--->
                     <!---right dashboard--->
                     <div class="right_dashboard_content" style="width:98%;">
                     	
                        <div class="clear"></div>
                                       <div id="TabbedPanels1" class="TabbedPanels">
           
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab " tabindex="0">Testimonials</li>
             <!-- <li class="TabbedPanelsTab " tabindex="0">Lorem ipsum</li>
              <li class="TabbedPanelsTab " tabindex="0">Lorem ipsum</li>
              <li class="TabbedPanelsTab " tabindex="0">Lorem ipsum</li>-->
            </ul>
            
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent ">
            	  	<div class="tab_box">
                     
                      <div>
                          <div class="personal_detail" id="details_parent">
                                
                                <div class="personal_text">
                                <?php foreach($details->result() as $row)
								{ 
								?>
                                <div class="testimonal">
                               <h2> <?php echo $row->title;?></h2>
                               <a href="#">test </a>
                               <div class="clear"></div>
                               <div class="content_test">
                               <img src="images/test_img.png" />
                               <p><?php echo $row->description; ?>  </p>
                                </div> 
                                <div class="border_dot" style="margin-left:10px;"></div>
                               </div>
                               <?php } ?>
                               
                                
                                
                                
                                </div>
                          </div>
                         
                          </div>
                          <div>
                         
                      		
                      <div>
                          
                        
                      </div>
                     </div>
             	   <div class="clear"></div>
              </div>
              </div>
              <div class="TabbedPanelsContent">
              	<div class="view_invoice">
                <div class="personal_detail" id="details_parent">
                         <div class="personal_text">
                         <?php foreach($details->result() as $row)
								{ 
								?>
                                <div class="testimonal">
                               <h2><?php echo $row->title;?></h2>
                               <a href="#">consectetur </a>
                               <div class="clear"></div>
                               <div class="content_test">
                               <img src="images/test_img.png" />
                               <p><?php echo $row->description;?> </p>
                                </div> 
                                <div class="border_dot" style="margin-left:10px;"></div>
                               </div>
                               <?php } ?>
                               
                               </div>
                                
                                </div>
              
                    </div>
              </div>
              
              
              
              <div class="TabbedPanelsContent">
              	<div class="view_invoice">
                 <div class="personal_detail" id="details_parent">
                         <div class="personal_text">
                         <?php foreach($details->result() as $row)
						 {
						 ?>
                                <div class="testimonal">
                               <h2> <?php echo $row->title;?></h2>
                               <a href="#">consectetur test </a>
                               <div class="clear"></div>
                               <div class="content_test">
                               <img src="images/test_img.png" />
                               <p><?php echo $row->description;?> </p>
                                </div> 
                                <div class="border_dot" style="margin-left:10px;"></div>
                               </div>
                               <?php } ?>

                                </div>
                                
                                </div>
                             
             
                    </div>
              </div>
              
              
              <div class="TabbedPanelsContent">
              	<div class="view_invoice">
                
                  <div class="personal_detail" id="details_parent">
                         <div class="personal_text">
                              
                                <?php foreach($details->result() as $row)
						 {
						 ?>
                               
                                 <div class="testimonal">
                               <h2> <?php echo $row->title;?></h2>
                               <a href="#">consectetur test consect </a>
                               <div class="clear"></div>
                               <div class="content_test">
                               <img src="images/test_img.png" />
                               <p><?php echo $row->description;?> </p>
                                </div> 
                                <div class="border_dot" style="margin-left:10px;"></div>
                               </div>
                               <?php } ?>
                                </div>
                                
                                </div>
                        
                    </div>
              </div>
		 <script type="text/javascript">
            <!--
            var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
            //-->
            </script>
            
            </div>
            
           <div class="clear"></div>
           <!--end of tab panels-->
     
                     </div>
                     </div>  
                	
                </div>
               
		    </div>
   
<!--body content-->
</section>
<?php
$this->load->view('site/templates/new_footer');
?>
</body>
</html>
