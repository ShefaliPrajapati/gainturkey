<?php
$this->load->view('admin/templates/header.php');
extract($privileges);


?>
<?php 
	 /*$orderIndex1 = 0;
	 foreach($getOrderDetails as $orderdetails) { 
	
	$orderDetails .='['.date('Y', strtotime($orderdetails['created'])).', '.$orderdetails['price'].'],'; 
	
	$orderIndex1++;
	}*/ ?>
<script>
/*=================
CHART 6
===================*/
$(function () {
   // var s1 = [<?php echo $orderDetails; ?>];
  //  var s2 = [<?php echo $orderDetails; ?>];
 var s1 = [[2004, 104000], [2005, 99000], [2006, 121000],
    [2007, 148000], [2008, 114000], [2009, 133000], [2010, 161000],[2011, 112000], [2012, 122000], [2013, 173000]];
    var s2 = [[2004, 11200], [2005, 11800], [2006, 12400],
    [2007, 12800], [2008, 13200], [2009, 12600], [2010, 10200], [2011, 10800], [2012, 13100]];



    plot1 = $.jqplot("chart6", [s2, s1], {
        // Turns on animatino for all series in this plot.
        animate: true,
        // Will animate plot on calls to plot1.replot({resetAxes:true})
        animateReplot: true,
        cursor: {
            show: true,
            zoom: false,
            looseZoom: true,
            showTooltip: false
        },
        series:[
            {
                pointLabels: {
                    show: true
                },
                renderer: $.jqplot.BarRenderer,
                showHighlight: false,
                yaxis: 'y2axis',
                rendererOptions: {
                    // Speed up the animation a little bit.
                    // This is a number of milliseconds. 
                    // Default for bar series is 3000. 
                    animation: {
                        speed: 2500
                    },
                    barWidth: 15,
                    barPadding: -15,
                    barMargin: 0,
                    highlightMouseOver: false
                }
            },
            {
                rendererOptions: {
                    // speed up the animation a little bit.
                    // This is a number of milliseconds.
                    // Default for a line series is 2500.
                    animation: {
                        speed: 2000
                    }
                }
            }
        ],
        axesDefaults: {
            pad: 0
        },
        axes: {
            // These options will set up the x axis like a category axis.
            xaxis: {
                tickInterval: 1,
                drawMajorGridlines: false,
                drawMinorGridlines: true,
                drawMajorTickMarks: false,
                rendererOptions: {
                tickInset: 0.5,
                minorTicks: 1
            }
            },
            yaxis: {
                tickOptions: {
                    formatString: "$%'d"
                },
                rendererOptions: {
                    forceTickAt0: true
                }
            },
            y2axis: {
                tickOptions: {
                    formatString: "$%'d"
                },
                rendererOptions: {
                    // align the ticks on the y2 axis with the y axis.
                    alignTicks: true,
                    forceTickAt0: true
                }
            }
        },
        highlighter: {
            show: true,
            showLabel: true,
            tooltipAxes: 'y',
            sizeAdjust: 7.5 , tooltipLocation : 'ne'
        },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    },
	seriesDefaults: {
        lineWidth: 2, // Width of the line in pixels.
        shadow: false,   // show shadow or not.
		 markerOptions: {
            show: true,             // wether to show data point markers.
            style: 'filledCircle',  // circle, diamond, square, filledCircle.
                                    // filledDiamond or filledSquare.
            lineWidth: 2,       // width of the stroke drawing the marker.
            size: 14,            // size (diameter, edge length, etc.) of the marker.
            color: '#ff8a00',    // color of marker, set to color of line by default.
            shadow: true,       // wether to draw shadow on marker or not.
            shadowAngle: 45,    // angle of the shadow.  Clockwise from x axis.
            shadowOffset: 1,    // offset from the line of the shadow,
            shadowDepth: 3,     // Number of strokes to make when drawing shadow.  Each stroke
                                // offset by shadowOffset from the last.
            shadowAlpha: 0.07   // Opacity of the shadow
        }
	}
    });
});	</script>    
    <div class="switch_bar">
    	<?php if($this->session->userdata('fc_session_admin_mode') =='fc_admin'){ ?>
		<ul>
			<li><a href="admin/users/display_user_list" ><span class="stats_icon user_sl"><span class="alert_notify orange"><?php echo $totalUserCounts;?></span></span><span class="label"> Users</span></a>
			</li>
						
			<li><a href="admin/adminlogin/admin_global_settings_form"><span class="stats_icon config_sl"></span><span class="label">Settings</span></a></li>
	
            
           <!-- <li><a href="admin/seller/display_seller_list"><span class="stats_icon user_seller"><span class="alert_notify orange"><?php echo $getTotalSellerCount;?></span></span><span class="label"> Renters</span></a></li>-->
            
            
            <li><a href="admin/product/display_product_list"><span class="stats_icon folder_sl"><span class="alert_notify orange"><?php echo $getTotalProductCount;?></span></span><span class="label">Properties</span></a></li>
            
            
			<!--<li><a href="admin/membership/display_membership"><span class="stats_icon category_sl"></span><span class="label">Membership</span></a></li>-->
            <li><a href="admin/contact/display_contact_list"><span class="stats_icon address_sl"></span><span class="label">Contact</span></a></li>
			<!--<li><a href="admin/attribute/display_attribute_list"><span class="stats_icon list_dash"></span><span class="label">List</span></a></li>-->
			<!--<li><a href="admin/couponcards/display_couponcards"><span class="stats_icon coupon_dash"></span><span class="label">Coupons</span></a></li>-->

            
          <!--  <li><a href="admin/newsletter/display_subscribers_list"><span class="stats_icon newsletter_dash"></span><span class="label">Newsletter</span></a></li>-->

            <li><a href="admin/cms/display_cms"><span class="stats_icon administrative_docs_sl"></span><span class="label">Pages</span></a></li>
			<!--<li><a href="admin/paygateway/display_gateway"><span class="stats_icon payment_dash"></span><span class="label">Payment</span></a></li>-->
			
            
		</ul>
        <?php }else{ ?>
        <ul>
			<li><a href="<?php echo base_url(); ?>" target="_blank" ><span class="stats_icon frames"><span></span></span><span class="label"> Take me to the Site</span></a>
			</li>

            <li><a href="<?php echo base_url().'admin/adminlogin/change_admin_password_form'; ?>"><span class="stats_icon config_sl"><span ></span></span><span class="label">Change Password</span></a></li>
            
            <li><a href="<?php echo base_url().'admin/adminlogin/admin_logout'; ?>"><span class="stats_icon user"><span ></span></span><span class="label">Logout my account</span></a></li>
          
            
		</ul>
        <?php } ?>
        
	</div>
	<div id="content">
		<div class="grid_container">
			
			<span class="clear"></span>
            <div class="grid_12">
				<div class="widget_wrap collapsible_widget">
					<div class="widget_top active">
						<span class="h_icon"></span>
						<h6>Dashboard</h6>
					</div>
					<div class="widget_content">
                    
                    <p>
                                        
                    
                    
			<div class="social_activities">
				<!--<div class="activities_s">
                <div><span class="logout"><a href="admin/adminlogin/admin_logout" class="tipBot" title="Logout"><span class="icon"></span>Logout</a></span>
						<h3>Administrator Profile</h3>
                        <span class="data">
       <span style="float:left;"><a href="#"><span class="btn_intro"><img src="images/user-thumb1.png"/></span></a></span>
       <span style="float:right;">	User Name : <?php echo $this->session->userdata('fc_session_admin_name'); ?><br>
       	Email : <?php echo $this->session->userdata('fc_session_admin_email'); ?><br></span>
       	<br>
        </span>
					</div>-->
					<!--<div class="activities_chart">
						<span class="activities_chart">100,150,130,100,250,280,350,250,400,450,280,350,250,400,</span>
					</div>
				</div>-->
                
                <div class="user_s" style="float: left !important; margin-right: 8px;">
					<div class="block_label">
						Total Users<span><?php echo $totalUserCounts;?></span>
					</div>
					<span class="badge_icon customers_sl"></span>
				</div>
				<div class="views_s">
					<div class="block_label">
						Total Properties<span><?php echo $getTotalProductCount;?></span>
					</div>
					<span class="badge_icon bank_sl"></span>
				</div>
				<!--<div class="activities_s">
					<div class="block_label">
						Total Renters<span><?php echo $getTotalSellerCount;?></span>
					</div>
					<!--<span class="badge_icon comment_sl"></span>--
				</div>-->
				
			<!--	<div class="activities_s">
					<div class="block_label">
						Total Subscribers<span><?php echo $getTotalSubscriberCount;?></span>
					</div>
					<span class="badge_icon customers_sl"></span>
				</div>-->
                <div class="comments_s">
					<div class="block_label">
						Contacts<span><?php echo $getTotalContactCount; ?></span>
					</div>
					<span class="badge_icon comment_sl"></span>
				</div>
                
                <!--<div class="comments_s">
					<div class="block_label">
						Testimonials<span>17000</span>
					</div>
					<span class="badge_icon comment_sl"></span>
				</div>-->
                
			</div></p>
			</div>
				</div>
			</div>
            
			
            
            
            
           <!-- 
            <div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_content">
						<div id="chart6" class="chart_block">
						</div>
					</div>
				</div>
			</div>-->
            
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6>Users</h6>
					</div>
					<div class="widget_content">
						<div class="stat_block">
							<h4>Users Count <?php echo $totalUserCounts;?></h4>
							<table>
							<tbody>
							<tr>
								<td>
									Today
								</td>
								<td>
									<?php echo $todayUserCounts;?>
								</td>
								<!-- <td class="min_chart">
									<span class="bar">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Month
								</td>
								<td>
									<?php echo $getThisMonthCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							<tr>
								<td>
									This Year
								</td>
								<td>
									<?php echo $getLastYearCount;?>
								</td>
								<!-- <td class="min_chart">
									<span class="line">20,30,50,200,250,280,350</span>
								</td>-->
							</tr>
							</tbody>
							</table>
							<!--<div class="stat_chart">
								<div class="pie_chart">
									<span class="inner_circle">1/1.5</span>
									<span class="pie">1/1.5</span>
								</div>
								<div class="chart_label">
									<ul>
										<li><span class="new_visits"></span>New Visitors: 7000</li>
										<li><span class="unique_visits"></span>Unique Visitors: 3000</li>
									</ul>
								</div>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon users"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<div class="user_list">
							
                            <?php foreach($getRecentUsersList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['first_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> -->
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>-->
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/users/change_user_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
								</ul>
							</div>
                            <?php } ?>
                            
                            
						</div>
					</div>
				</div>
			</div>
			<!--<div class="grid_6">
				<div class="widget_wrap tabby">
					<div class="widget_top">
						<span class="h_icon h_icon users"></span>
						<h6>Recent Renters List</h6>
						<div id="widget_tab">
							<ul>
								
								<li><a href="admin/seller/display_seller_list">Renters<span class="alert_notify blue"><?php echo $getTotalSellerCount;?></span></a></li>
							</ul>
						</div>
					</div>
					<div class="widget_content">
						
						<div id="tab1">
                        
                        <div class="user_list">
								
								 <?php foreach($getRecentSellerList as $userList) { ?>
							
							<div class="user_block">
								<div class="info_block">
									<div class="widget_thumb">
                                    <?php if($userList['thumbnail'] != '') {?>
                                   		 <img src="images/users/<?php echo $userList['thumbnail'];?> " width="40" height="40" alt="user">
                                      <?php } else { ?>
										<img src="images/user-thumb1.png" width="40" height="40" alt="user">
                                      <?php } ?>
									</div>
									<ul class="list_info">
										<li><span>Name: <i><a href="admin/users/view_user/<?php echo $userList['id'];?>"><?php echo stripslashes($userList['first_name']); ?></a></i></span></li>
										<li><span>IP: <?php echo $userList['last_login_ip']; ?> Date: <?php echo $userList['created']; ?></span></li>
										<!-- <li><span>User Type: Paid, <i>Package Name:</i><b>Gold</b></span></li> --
									</ul>
								</div>
								<ul class="action_list">
									<li><a class="p_edit" href="admin/users/edit_user_form/<?php echo $userList['id'];?>";>Edit</a></li>
									<li><a class="p_del" href="javascript:confirm_delete('admin/users/delete_user/<?php echo $userList['id'];?>')">Delete</a></li>
									<!-- <li><a class="p_reject" href="#">Suspend</a></li>--
									<li class="right"><a class="p_approve" href="javascript:confirm_status('admin/seller/change_seller_status/0/<?php echo $userList['id'];?>');"><?php echo $userList['status']; ?></a></li>
								</ul>
							</div>
                            <?php } ?>
								
							</div>
							
						</div>
					</div>
				</div>
			</div>-->
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>