	
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery/jquery1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery/rating.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/rating.css" />
<script type="text/javascript">
$(document).ready(function() {
	$('#star1').rating('www.url.php', {maxvalue: 1});
	$('#star2').rating('www.url.php', {maxvalue:1, curvalue:1});
	$('#rate1').rating('www.url.php', {maxvalue:5});
	$('#rate2').rating('www.url.php', {maxvalue:5, curvalue:3});
});
</script>
<style type="text/css">
.implementation{
	border:dashed 2px #333333;
	background-color:#CCCCCC;
	color:#000000;
	width:50%;
}

.spacer{
clear:both;
height:0px;
}
.left{
	float:left;
	width:250px;
}
</style>


<div id="rate1" class="rating">&nbsp;</div>
<div class="implementation">
<pre>$('#rate1').rating('www.url.php', {maxvalue:5});</pre>
</div>
</div>

