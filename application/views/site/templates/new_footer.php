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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>css/js/bliss-slider.js"></script>
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
