<footer class="footer_sec">
    <div class="container">
        <div class="footer_log">
            <img src="<?php echo base_url(); ?>images/logo.png" alt="logo">
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_box">
                    <h2>address</h2>
                    <ul>
                        <li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>4167 Jim Rosa Lane, Oakland, CA, California<br> United States Of Amrica.</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="footer_box">
                    <h2>Get in touch</h2>
                    <ul>
                        <li><span><i class="fa fa-phone" aria-hidden="true"></i></span> 877-372-2010</li>
                        <li><span><i class="fa fa-envelope" aria-hidden="true"></i></span>info@gainturnkeyproperty.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_box">
                    <h2>Useful Links</h2>
                    <ul>
                        <li><a href="<?php echo $urlProperty.'pages/about-us'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; About Us</a></li>
                        <li><a href="#"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Misson</a></li>
                        <li><a href="<?php echo $urlProperty.'listing/viewall'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Properties</a></li>
                        <li><a href="<?php echo $urlProperty.'contact'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="footer_box">
                    <img src="<?php echo base_url(); ?>images/map.png" alt="map">
                </div>
            </div>
        </div>
        <div class="privacy_policy">
            <h2>Privacy Policy</h2>
            <p>All properties advertised via Gain Consulting website are sold 'as is', without expressed or implied warranty. You may purchase a home warranty from a 3rd party. Any property you purchase is a transaction between you and the seller of
                that property and every property will differ in condition and financial performance. We strongly suggest that you conduct any due-dilligence needed before finalizing the transaction. Gain Consulting and it's related entities does not
                offer any guarantee regarding the specific performance of a property including it's return on investment or cap rate. As all real estate transactions pose some risk, we suggest you contact your on accounting, legal or other professional
                advisor regarding any questions you have including the suitability of a specific transaction.</p>
        </div>
        <div class="copy_right">
            © 2019 - Gain Consulting
        </div>
    </div>
</footer>
<?php if($this->config->item('google_verification_code')){ echo stripslashes($this->config->item('google_verification_code'));}?>


<script>
function GetHTTPObject()  {
    // This is for FireFox
    if(window.XMLHttpRequest) {
        try {
            objHTTP = new XMLHttpRequest();
        } catch(e) {
            objHTTP = false;
        }
        // branch for IE/Windows ActiveX version
    }
    else if(window.ActiveXObject) {
        try {
            objHTTP = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                objHTTP = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                objHTTP = false;
            }
        }
    }
    return objHTTP;
}

        function SearchByCat(cat_id,subcat_id) {

         // alert("sss");
          //$("#container").hide();
          $("#fulldiv_container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
          $(".selected").removeClass('selected');
          var sPath = window.location.pathname;
            var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
            var url = baseURL+'site/product/Get_All_Property_List_page/'+cat_id+'/'+subcat_id;
            //alert(url);
            var req = GetHTTPObject();
            req.open('GET',url,false);
            req.send(null);
            if(req.readyState == 4 && req.status == 200)  {
                var responseText = req.responseText;
                //alert(responseText);
                $("#fulldiv_container").html(responseText).show();
                $("#active_"+cat_id).addClass('selected');
                 //$("#active_"+cat_id).className = "selected";

                //$container.isotope( 'insert', $( responseText ) );
            }
            }



            function SearchByFeatureCat(cat_id,subcat_id) {

         // alert("sss");
          //$("#container").hide();
          $("#container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
          $(".selected").removeClass('selected');
          var sPath = window.location.pathname;
            var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
            var url = baseURL+'site/product/Get_All_Property_Feature_List_page/'+cat_id+'/'+subcat_id;
            //alert(url);
            var req = GetHTTPObject();
            req.open('GET',url,false);
            req.send(null);
            if(req.readyState == 4 && req.status == 200)  {
                var responseText = req.responseText;
                //alert(responseText);
                $("#container").html(responseText).show();
                $("#active_"+cat_id).addClass('selected');
                 //$("#active_"+cat_id).className = "selected";

                //$container.isotope( 'insert', $( responseText ) );
            }
            }



        function SoldSearchByCat(cat_id,subcat_id) {

         // alert("sss");
          //$("#container").hide();
          $("#fulldiv_container").html('<a class="c-loader" href="javascript:void(0);" title="Loading" >Loading...</a>').show();
          $(".selected").removeClass('selected');
          var sPath = window.location.pathname;
            var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
            var url = baseURL+'site/product/display_all_sold_proptery/'+cat_id+'/'+subcat_id;
            //alert(url);
            var req = GetHTTPObject();
            req.open('GET',url,false);
            req.send(null);
            if(req.readyState == 4 && req.status == 200)  {
                var responseText = req.responseText;
                //alert(responseText);
                $("#fulldiv_container").html(responseText).show();
                $("#active_"+cat_id).addClass('selected');
                 //$("#active_"+cat_id).className = "selected";

                //$container.isotope( 'insert', $( responseText ) );
            }
            }
            /*$.ajax({
            type:'post',
            url:baseURL+'site/product/Get_All_Property_List',
            data:{'uid':'1'},
            dataType:'html',
            success:function(data){
                 $container.isotope( 'appended', $( $container.html(data) ) );
                 //$container.html(data);
            }
        });*/


  </script>
  <script id="godaddy-security-s" src="https://cdn.sucuri.net/badge/badge.js" data-s="205" data-i="8d7b9eaf239072b5bbdc5a8a16c72148180d0eb2d3" data-p="r" data-c="d" data-t="g"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script src="<?php echo base_url(); ?>js/bliss-slider.js"></script>
<script src="<?php echo base_url(); ?>js/popper-min.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap-min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#slider").blissSlider({
            auto: 1,
            transitionTime: 500,
            timeBetweenSlides: 4000
        });
    });
</script>
</body>
</html>
