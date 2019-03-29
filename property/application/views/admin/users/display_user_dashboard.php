<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>
<?php 
	$active_users = $inactive_users = 0;
	if ($usersList->num_rows()>0){
		foreach ($usersList->result() as $row){
			$status = strtolower($row->status);
			if ($status == 'active'){
				$active_users++;
			}else {
				$inactive_users++;
			}
		}
	}
?>
<script type="text/javascript">
/*=================
CHART 5
===================*/
$(function(){
  plot2 = jQuery.jqplot('chart5',
    [[['Active',<?php echo $active_users; ?>],['Inactive', <?php echo $inactive_users; ?>]]],
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
						<span class="h_icon list"></span>
						<h6>Users Dashboard</h6>
					</div>
					<div class="widget_content">
					<h4><?php echo $usersList->num_rows();?> users registered in this site</h4>	
						<!--<p>
							 <?php echo $usersList->num_rows();?> users registered in this site
						</p>-->
						<div id="chart5" class="chart_block">
						</div>
					</div>
				</div>
			</div>
            
            
            
            
            <!--<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon graph"></span>
						<h6><?php echo $heading;?></h6>
					</div>
					<?php 
						$active_users = $inactive_users = 0;
						if ($usersList->num_rows()>0){
							foreach ($usersList->result() as $row){
								$status = strtolower($row->status);
								if ($status == 'active'){
									$active_users++;
								}else {
									$inactive_users++;
								}
							}
						}
					?>
					<div class="widget_content">
						<div class="stat_block">
							<h4> <?php echo $usersList->num_rows();?> users registered in this site</h4>
							<table>
							<tbody>
							<tr>
								<td>
									Active Users
								</td>
								<td>
									<?php echo $active_users;?>
								</td>
							</tr>
							<tr>
								<td>
									Inactive Users
								</td>
								<td>
									<?php echo $inactive_users;?>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>-->
            
			<div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon image_1"></span>
						<h6>Recent Users</h6>
					</div>
					<div class="widget_content">
						<table class="wtbl_list">
						<thead>
						<tr>
							<th>
								 First Name
							</th>
							<th>
								 Last Name
							</th>
							<th>
								 Username
							</th>
							<th>
								 Email
							</th>
<!-- 							<th>
								 Status
							</th>
 -->						</tr>
						</thead>
						<tbody>
						<?php 
						if ($usersList->num_rows() > 0){
							$result = $usersList->result_array();
							for ($i=0;$i<5;$i++){
								if (isset($result[$i]) && is_array($result[$i])){
						?>
						<tr class="tr_even">
							<td>
								 <?php echo $result[$i]['first_name'];?>
							</td>
							<td>
								 <?php echo $result[$i]['last_name'];?>
							</td>
                            <td>
								 <?php echo $result[$i]['user_name'];?>
							</td>
							<td>
								 <?php echo $result[$i]['email'];?>
							</td>
							
<!-- 							<td>
							<?php if (strtolower($result[$i]['status']) == 'active'){?>
								 <span class="badge_style b_done"><?php echo $result[$i]['status'];?></span>
							<?php }else {?>
								 <span class="badge_style b_active"><?php echo $result[$i]['status'];?></span>
							<?php }?>
							</td>
 -->						</tr>
						<?php 
								}
							}
						}else {
						?>
						<tr>
							<td colspan="5" align="center">No Users Available</td>
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