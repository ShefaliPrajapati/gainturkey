<!--<META http-equiv="refresh" content="5;URL=<?php echo base_url();?>"> -->


<?php
$this->load->view('site/templates/new_header');
?>
<link rel="stylesheet" type="text/css" href="css/site/master.css"/>
<!--<script type="text/javascript">
jQuery(document).ready(function(e)
 {
	window.open("listing",'_blank');
});
</script>-->
<!----------listing content------------------>
<div class="container">
    <div class="listing_content">
        <div class="cms_view">
            <h2>Property Reserved Details </h2>
            <div class="clear"></div>
                <?php echo $productListPopUp; ?>
             <div class="clear"></div>
        </div>
    </div>
</div>
</div>
</div>
<div class="clear"></div>

<script type="text/javascript">
function printthis()
{
    var w = window.open('', '', 'width=1000,height=700,resizeable');
    w.document.write($("#printthis").html());
    w.document.close(); // needed for chrome and safari
    javascript:w.print();
    w.close();
    return false;
}
</script>


<?php
$this->load->view('site/templates/new_footer');
?>
