<?php 
$this->load->view('site/templates/header');
?>
<div class="main">
    			    <div class="feature_list">
    			<div class="page_title W99">Listing Property</div>
                 <?php foreach($subscription->result() as $subName)
							{
							?>
               			<div class="cms_txt">
                <div class="hole_con">
               
                <div class="top_holesplit">
                <div class=" left_split_content">
                <h2><?php echo $subName->name; ?></h2>
                <div class="clear"></div>
                <span>Membership</span>
                </div>
                <div class="right_split_content">
                <span style=" width: 50px;">$<?php echo $subName->price; ?></span>
                <p>&nbsp;</p>
                <?php if($subName->status=='Publish'){ ?>
                <a href="user_owner/<?php echo $user;?>/<?php echo $subName->id; ?>" class="submit_btn_1">Submit</a>
                <?php } ?>
               </div>
                
                </div>
                
                <div class="clear"></div>
                <div class="full_conview">
                <div class="bg_box">
                <!--<h2><?php echo $subName->name; ?></h2>-->
                 <ul class=" meals_list">
                 <?php echo $subName->description; ?>
     <!--	<li><img src="<?php echo base_url();// $subName->description?>images/tick.png" /> <p>Contrary to popular belief, Lorem Ipsum is not simply random text. </p></li>
        <li><img src="<?php echo base_url();?>images/tick.png" /> <p>It has roots in a piece of classical Latin literature from 45 BC, </p></li>
        <li><img src="<?php echo base_url();?>images/tick.png" /> <p>Making it over 2000 years old. Richard McClintock,</p></li>
       -->
     
     
     </ul>
                
                
                
                </div>
                <div class="bg_box" style="">
                <h2 style="color:#da0606; margin-left:180px;"><?php echo $subName->option_type; ?> for <?php echo $subName->valid_date; ?></h2>
                
                
                </div>
                
                
                </div>
                
                
                </div>
                	
                </div>
               <?php } ?>
		    </div>
    </div>
<?php 
$this->load->view('site/templates/footer');
?>