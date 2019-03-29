<?php

$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<script type="text/javascript">
/*=================
CHART 5
===================*/
$(function(){
  plot2 = jQuery.jqplot('chart5',
    [[['Verwerkende industrie', 9],['Retail', 0], ['Primaire producent', 0],
    ['Out of home', 0],['Groothandel', 0], ['Grondstof', 0], ['Consument', 3], ['Bewerkende industrie', 2]]],
    {
      title: ' ',
      seriesDefaults: {
        shadow: false,
        renderer: jQuery.jqplot.PieRenderer,
        rendererOptions: {
          startAngle: 180,
          sliceMargin: 4,
          showDataLabels: true }
      },
		grid: {
         borderColor: '#ccc',     // CSS color spec for border around grid.
        borderWidth: 2.0,           // pixel width of border around grid.
        shadow: false               // draw a shadow for grid.
    },
      legend: { show:true, location: 'w' }
    }
  );
});
</script>
<div id="content">
		<div class="grid_container">
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					
					<div class="widget_content">
						<div class="stat_block">
							<h4><?php echo $MembershipList->num_rows();?> membership Subscribed from this site</h4>
							<table>
							<tbody>
							<tr>
								<td><b>Membershipbox Name</b></td>
								<td><b>Subscription Count</b></td>
							</tr>
           					<?php foreach ($MembershipCount->result() as $row){ ?>
                            <tr>
								<td><?php echo $row->membership; ?></td>
								<td><?php echo $row->totCount; ?></td>
							</tr>
                            <?php } ?>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon image_1"></span>
						<h6>Recent Membership Subscription</h6>
					</div>
                    
					<div class="widget_content">
                    
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 User Name
							</th>
							<th>
								 Subscription Name
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Status
							</th>
						</tr>
						</thead>
						<tbody>
						<?php 
						if ($MembershipList->num_rows() > 0){
							foreach($MembershipList->result() as $fancyrow){

						?>
						<tr class="tr_even">
							<td>
								 <?php echo $fancyrow->first_name;?>
							</td>
							<td>
								 <?php echo $fancyrow->membership;?>
							</td>
							<td>
								 <?php echo $fancyrow->price;?>
							</td>
							<td>
							<?php 
							
							if ($fancyrow->approved == 'yes'){?>
								<span class="badge_style b_done">Paid</span>
							<?php }else {?>
								<span class="badge_style b_pending">Pending</span>
							<?php }?>
							</td>
						</tr>
						<?php 
								}
						
						}else {
						?>
						<tr>
							<td colspan="5" align="center">No Subscription Available</td>
						</tr>
						<?php }?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php 
$this->load->view('admin/templates/footer.php');
?>