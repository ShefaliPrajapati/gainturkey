<?php
$this->load->view('crmadmin/templates/header.php');
extract($crm_privileges);

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
		<ul>
			<li><a href="<?php echo base_url(); ?>" target="_blank" ><span class="stats_icon frames"><span></span></span><span class="label"> Take me to the Site</span></a>
			</li>

            <li><a href="<?php echo base_url().'crmadmin/adminlogin/change_admin_password_form'; ?>"><span class="stats_icon config_sl"><span ></span></span><span class="label">Change Password</span></a></li>
            
            <li><a href="<?php echo base_url().'crmadmin/adminlogin/admin_logout'; ?>"><span class="stats_icon user"><span ></span></span><span class="label">Logout my account</span></a></li>
          
            
		</ul>
	</div>
	<div id="content">
		<div class="grid_container">
			
			<span class="clear"></span>
            
            
			
            
        
			<span class="clear"></span>
		</div>
		<span class="clear"></span>
	</div>
	
</div>
<?php 
$this->load->view('crmadmin/templates/footer.php');
?>