<?php
error_reporting(1);
if (!session_id()) {
    session_start();
}

function url()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }

    return $protocol . "://" . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
}
unset($_SESSION['sExistingSold']);
$urlProperty = base_url();

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <meta name="Title" content="<?php echo $meta_title; ?>" />
    <meta name="keywords" content="<?php echo $meta_keyword; ?>" />
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <base href="<?php echo base_url(); ?>" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bliss-slider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/logo/<?php echo $this->config->item('fevicon_image'); ?>">
    <?php
    if ($heading == '') {
    ?>
    <title><?php echo $title; ?></title>
    <?php } else { ?>
    <title><?php echo $heading; ?></title>
    <?php } ?>

</head>

<body>

<div class="top_nav">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo url(); ?>">
                <img src="<?php echo base_url(); ?>images/logo.png" alt="logo" style="width:114px;">
            </a>
            <button class="navbar-toggler right_bt" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link scroll" href="<?php echo $urlProperty.'#about'; ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $urlProperty.'properties'; ?>">Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $urlProperty.'contact'; ?>">Contact Us</a>
                    </li>
                    <?php
                    if (isset($_SESSION['userdata']) && $_SESSION['userdata']['fc_session_user_id']) { ?>
                        <li class="nav-item bt_box">
                            <a class="nav-link" href="<?php echo $urlProperty.'signout'; ?>">Sign Out</a>
                        </li>
                    <?php } else {
                        ?>
                        <li class="nav-item bt_box">
                            <a class="nav-link" href="<?php echo $urlProperty.'signup'; ?>">Sign up</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="clearfix"></div>
<div class="banner_slider">
    <div id="slider" class="slider-container">
        <ul class="slider">
            <li class="slide">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>Building Sustainable Wealth Through Real Estate</h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
            <li class="slide" style="display: none;">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner2.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>We locate, purchase, and remodel homes in the best cash flow markets<br>
                        (All the hard work is done!) </h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
            <li class="slide" style="display: none;">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner3.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>Our professional property managers place tenants, collect rents, and deal with maintenance<br>
                        (All the management is done!)</h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
            <li class="slide" style="display: none;">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner4.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>Clients purchase a turnkey rental property and receive the cash flow, appreciation, and tax benefits that come with it<br>
                        (Risk mitigated, time saved, GAIN up!)</h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
            <li class="slide" style="display: none;">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner2.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>We supply property in the BEST cash flow markets in the country. Times change, markets change, and we change accordingly.  View our inventory to see where we are currently investing </h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
            <li class="slide" style="display: none;">
                <div class="slide-bg">
                    <img src="<?php echo base_url(); ?>images/banner3.jpg" alt="An Image" draggable="false">
                </div>
                <div class="slide-content">
                    <h2>With over 1,500 properties sold to investors,<br> our experience sets us apart from the competition.</h2>
                    <a href="<?php echo $urlProperty.'properties'; ?>">View Properties</a>
                </div>
            </li>
        </ul>
        <div class="slider-controls">
            <div class="slide-nav">
                <!--  <a href="#" class="prev">Prev</a>
    <a href="#" class="next">Next</a> -->
            </div>
            <ul class="slide-list">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<section class="wlelcome_sec" id="about">
    <div class="Welcome_rghte1">
        <div class="container">
            <div class="Welcome_rghte">
                <h2>About GAIN Turnkey Property</h2>
                <p>GAIN Turnkey Property is real estate company with a focus on building client wealth, using the number one wealth creator of all time...real estate.  GAIN was founded by Dallas Hall, a real estate professional with 20 years of hands on real estate experience.
                    GAIN is an acronym and stands for Gross Assets Income and Net worth.  These are the metrics used to measure wealth and these are the metrics we seek to grow for our clients.  We deal in single family and multi family homes and focus on the Midwest and Rust Belt markets of the U.S.  GAIN offers its clients turnkey income property and a power team to manage and maintain those investments long term.  We provide remodeled, rented, and professionally managed homes, as a turnkey solution for real estate investors.  Our model gives investors a hassle free and seamless means of building a portfolio in the best cash flow markets in the country.  With over 1,500 properties sold we have the experience and know how to increase your GAIN!!   </p>
                <a href="<?php echo $urlProperty.'pages/about-us'; ?>">Read more</a>
            </div>
        </div>
    </div>
    <div class="wlelcome_imag">
        <img src="<?php echo base_url(); ?>images/well.jpg" alt="">
    </div>
</section>
<div class="clearfix"></div>
<section class="Properties_sec">
    <div class="container">
        <div class="Properties_box">
            <div class="Properties_box2">
                <div class="Left_side">
                    <img src="<?php echo base_url(); ?>images/left.jpg" alt="">                    </div>
                <div class="center-text">
                    <h2>GAIN Turnkey Property is on the move!!!</h2>
                    <p>Over the better part of the last 10 years GAIN and its owner Dallas Hall have created networks and supplied property in over a dozen markets across the US.  We are constantly seeking out new markets, new opportunities, and new upside potential.  Many markets have fallen out of formula and we no longer invest in those markets.  Check out our inventory and see where we are focusing out efforts today.</p>                    </div>
                <div class="right_side">
                    <img src="<?php echo base_url(); ?>images/right.jpg" alt="">
                </div>
            </div>
            <a href="<?php echo $urlProperty.'properties'; ?>">View Our Turnkey Properties Here</a>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<footer class="footer_sec">
    <div class="container">
        <div class="footer_log">
            <img src="<?php echo base_url(); ?>images/logo.png" alt="logo" style="width:114px;">
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="footer_box">
                    <h2>address</h2>
                    <ul>
                        <li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>PMB 321, 425 Carr 693,<br>  Ste 1
                            Dorado, PR 00646.</li>
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
                        <li><a class="scroll"  href=" <?php echo $urlProperty.'#about'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> About Us</a></li>
                        <li><a href="<?php echo $urlProperty.'properties'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Properties</a></li>
                        <li><a href="<?php echo $urlProperty.'contact'; ?>"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> ContactUs</a></li>
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
             <div class="row">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="left_side">
                         <ul>
                             <li><a href="<?php echo $urlProperty.'pages/privacy-policy'; ?>">Privacy Policy</a></li>
                             <li><a href="<?php echo $urlProperty.'pages/terms-conditions'; ?>">Terms And Conditions</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="right_side">
                         © 2019 - Gain Consulting
                     </div>
                 </div>
             </div>



        </div>
    </div>
</footer>
<script src="<?php echo base_url(); ?>js/bootstrap-min.js"></script>
<script src="<?php echo base_url(); ?>js/popper-min.js"></script>
<script src="<?php echo base_url(); ?>js/site/jquery-1.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/bliss-slider.js"></script>
<script type="text/javascript">
    $(function() {
        $("#slider").blissSlider({
            auto: 1,
            transitionTime: 500,
            timeBetweenSlides: 4000
        });
    });
</script>

<script>
    $(document).ready(function(){
        // Add smooth scrolling to all links
        $(".scroll").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>




</body>
</html>
