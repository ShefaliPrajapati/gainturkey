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

    $urlProperty = url().'property/';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bliss-slider.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Gain</title>

</head>

<body>

    <div class="top_nav">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
                <a class="navbar-brand" href="<?php echo url(); ?>">
          <img src="images/logo.png" alt="logo">
        </a>
                <button class="navbar-toggler right_bt" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $urlProperty.'pages/about-us'; ?>">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Misson</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $urlProperty; ?>">Properties</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $urlProperty.'contact'; ?>">Contact Us</a>
                        </li>
                        <?php
                        if (isset($_SESSION['userdata']) && $_SESSION['userdata']['fc_session_user_id']) { ?>
                            <li class="nav-item bt_box">
                                <a class="nav-link" href="<?php echo $urlProperty.'signout'; ?>">Logout</a>
                            </li>
                        <?php } else {
                            ?>
                            <li class="nav-item bt_box">
                                <a class="nav-link" href="<?php echo $urlProperty.'signup'; ?>">Sign up</a>
                            </li>
                            <li class="nav-item bt_box">
                                <a class="nav-link" href="<?php echo $urlProperty.'signin'; ?>">Login</a>
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
                        <img src="images/banner.jpg" alt="An Image" draggable="false">
                    </div>
                    <div class="slide-content">
                        <p>We help clients build true freedom<br> and sustainable wealth using real estate as the vehicle.</p>
                        <h2>Let us help you Grow your GAIN.<br> Gross Assets Income and Net Worth</h2>
                        <a href="#">Explore Now</a>
                    </div>
                </li>
                <li class="slide">
                    <div class="slide-bg">
                        <img src="images/banner2.jpg" alt="An Image" draggable="false">
                    </div>
                    <div class="slide-content">
                        <p>We help clients build true freedom<br> and sustainable wealth using real estate as the vehicle.</p>
                        <h2>Let us help you Grow your GAIN.<br> Gross Assets Income and Net Worth</h2>
                        <a href="#">Explore Now</a>
                    </div>
                </li>
                <li class="slide">
                    <div class="slide-bg">
                        <img src="images/banner3.jpg" alt="An Image" draggable="false">
                    </div>
                    <div class="slide-content">
                        <p>We help clients build true freedom<br> and sustainable wealth using real estate as the vehicle.</p>
                        <h2>Let us help you Grow your GAIN.<br> Gross Assets Income and Net Worth</h2>
                        <a href="#">Explore Now</a>
                    </div>
                </li>
                <li class="slide">
                    <div class="slide-bg">
                        <img src="images/banner4.jpg" alt="An Image" draggable="false">
                    </div>
                    <div class="slide-content">
                        <p>We help clients build true freedom<br> and sustainable wealth using real estate as the vehicle.</p>
                        <h2>Let us help you Grow your GAIN.<br> Gross Assets Income and Net Worth</h2>
                        <a href="#">Explore Now</a>
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
                </ul>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="main_sec">
        <div class="container">
            <div class="wlelcome_text">
                <h2>Welcome to GAIN CONSULTING</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen
                    book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                    more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Aldus PageMaker including versions of Lorem Ipsum..</p>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <section class="wlelcome_sec">
        <div class="wlelcome_imag">
            <img src="images/well.jpg" alt="">
        </div>
        <div class="Welcome_rghte1">
            <div class="container">
                <div class="Welcome_rghte">
                    <h2>Welcome to GAIN CONSULTING</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum Aldus PageMaker including versions of Lorem Ipsum..</p>
                    <a href="#">Read more</a>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <section class="Properties_sec">
        <div class="container">
            <div class="Properties_box">
                <div class="Properties_box2">
                    <div class="Left_side">
                        <img src="images/left.jpg" alt="">                    </div>
                    <div class="center-text">
                        <h2>Lorem Ipsum is simply dummy text</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised .</p>                    </div>
                    <div class="right_side">
                        <img src="images/right.jpg" alt="">
                    </div>
                </div>
                <a href="#">View Our Turnkey Properties Here</a>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <footer class="footer_sec">
        <div class="container">
            <div class="footer_log">
                <img src="images/logo.png" alt="logo">
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
                            <li><a href="#"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; About Us</a></li>
                            <li><a href="#"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Misson</a></li>
                            <li><a href="#"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Properties</a></li>
                            <li><a href="#"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span>&nbsp; &nbsp; Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <div class="footer_box">
                        <img src="images/map.png" alt="map">
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
    <script src="js/bliss-slider.js"></script>
    <script src="js/popper-min.js"></script>
    <script src="js/bootstrap-min.js"></script>
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
