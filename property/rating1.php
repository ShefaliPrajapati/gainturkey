	<link rel="stylesheet" href="js/jquery/jRating.jquery1.css" type="text/css" />
	<style type="text/css">
		body {margin:15px;font-family:Arial;font-size:13px}
		a img{border:0}
		.datasSent, .serverResponse{margin-top:20px;width:470px;height:73px;border:1px solid #F0F0F0;background-color:#F8F8F8;padding:10px;float:left;margin-right:10px}
		.datasSent{width:200px;position:fixed;left:680px;top:0}
		.serverResponse{position:fixed;left:680px;top:100px}
		.datasSent p, .serverResponse p {font-style:italic;font-size:12px}
		.exemple{margin-top:15px;}
		.clr{clear:both}
		pre {margin:0;padding:0}
		.notice {background-color:#F4F4F4;color:#666;border:1px solid #CECECE;padding:10px;font-weight:bold;width:600px;font-size:12px;margin-top:10px}
	</style>


<div class="exemple">
	
	<div class="basic" data-average="12" data-id="1"></div>
</div>

<input type="hidden" name="rateVal" id="rateVal" value="0"  />
<br />
<span id="error_rating" style="display:none; color:#FF0000;">Please give your rating</span>
	<script type="text/javascript" src="js/jquery/jquery.js"></script>
	<script type="text/javascript" src="js/jquery/jRating.jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.basic').jRating();

			
		});
	</script>

