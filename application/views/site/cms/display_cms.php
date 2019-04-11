<?php
$this->load->view('site/templates/new_header');
?>
<!----------listing content------------------>
<div class="main_sec">
    <div class="container">
        <div class="col-md-12">
            <?php if ($pageDetails->num_rows()>0){ ?>
                <div class="cms_view">
                    <h1><?php echo $pageDetails->row()->page_name; ?></h1>
                    <h2><?php echo $pageDetails->row()->page_title; ?></h2>
                    <div class="clear"></div>
                    <div class="text-justify" style="margin-bottom: 10px; margin-top: 10px;">
                        <?php echo $pageDetails->row()->description; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<!--
<style>
  .innerfade li{
    display:none;
    background:#eee;
    padding:10px;
    position:absolute;
}
</style>
<ul class="innerfade">
<?php foreach($reservedStatus->result() as $reservedProp)
  	{ ?>
   <li><?php echo "Property id :".$reservedProp->property_id." is reserved";?></li>
   
   <?php } ?>
</ul>
<script type="text/javascript">
var el = $('.innerfade li'),
    i = 0;
$(el[0]).show();

(function loop() {
    el.delay(1000).fadeOut(300).eq(++i%el.length).fadeIn(500, loop);
}());
</script>-->


<?php
$this->load->view('site/templates/new_footer');
?>
