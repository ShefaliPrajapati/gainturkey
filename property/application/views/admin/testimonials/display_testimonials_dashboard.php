<?php
$this->load->view('admin/templates/header.php');
extract($privileges);
?>

<?php 
	if ($contactList->num_rows()>0){
		foreach ($contactList->result() as $contactRow){
	?>
	  <?php 
	  
	  $RenterTopList .='["'.ucfirst($contactRow->user_name).'",'.$contactRow->contact_count.'],';?>
   <?php }
   } ?>
   <?php 
	if ($TopRentalList->num_rows()>0){
		foreach ($TopRentalList->result() as $contactRow){
	?>
	  <?php 
	  
	  $RentalTopList .='["'.ucfirst($contactRow->product_name).'",'.$contactRow->rental_count.'],';?>
   <?php }
   } ?>
<script type="text/javascript">
$(function(){
  plot2 = jQuery.jqplot('chart5',
    [[
	
	<?php echo $RenterTopList;?>
	
	]],
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
$(function(){
  plot2 = jQuery.jqplot('chart6',
    [[
	
	<?php echo $RentalTopList;?>
	
	]],
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
						<h6>Top 5 Contact Renters</h6>
					</div>
					<div class="widget_content">
						<h3>Renters</h3>
						<!--<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
						<div id="chart5" class="chart_block">
						</div>
					</div>
				</div>
			</div>
            
            <div class="grid_6">
				<div class="widget_wrap">
					<div class="widget_top">
						<span class="h_icon list"></span>
						<h6>Top 5 Contact Rentals</h6>
					</div>
					<div class="widget_content">
						<h3>Rentals</h3>
						<!--<p>
							 Cras erat diam, consequat quis tincidunt nec, eleifend a turpis. Aliquam ultrices feugiat metus, ut imperdiet erat mollis at. Curabitur mattis risus sagittis nibh lobortis vel.
						</p>-->
						<div id="chart6" class="chart_block">
						</div>
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