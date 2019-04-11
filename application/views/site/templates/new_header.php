<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php
    unset($_SESSION['sCheckTimeReser']);
    unset($_SESSION['sCheckTimeSold']);
    if ($heading == '') {
        ?>
        <title><?php echo $title; ?></title>
    <?php } else { ?>
        <title><?php echo $heading; ?></title>
    <?php } ?>

    <meta name="Title" content="<?php echo $meta_title; ?>" />
    <meta name="keywords" content="<?php echo $meta_keyword; ?>" />
    <meta name="description" content="<?php echo $meta_description; ?>" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/logo/<?php echo $this->config->item('fevicon_image'); ?>">
    <base href="<?php echo base_url(); ?>" />

    <script type="text/javascript">
        var baseURL = '<?php echo base_url(); ?>';
        var BaseURL = '<?php echo base_url(); ?>';
    </script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bliss-slider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/site/banner_style.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="css/developer.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
    <script src="js/site/jquery-1.7.1.min.js"></script>
    <script type="text/javascript">
        /***
         Simple jQuery Slideshow Script
         Released by Jon Raasch (jonraasch.com) under FreeBSD license: free to use or modify, not responsible for anything, etc.  Please link out to me if you like it :)
         ***/

        function slideSwitch() {
            var $active = $('#slideshow IMG.active');


            if ($active.length == 0)
                $active = $('#slideshow IMG:last');

            // use this to pull the images in the order they appear in the markup
            var $next = $active.next().length ? $active.next()
                : $('#slideshow IMG:first');

            // uncomment the 3 lines below to pull the images in random order

            // var $sibs  = $active.siblings();
            // var rndNum = Math.floor(Math.random() * $sibs.length );
            // var $next  = $( $sibs[ rndNum ] );


            $active.addClass('last-active');

            $next.css({opacity: 0.0})
                .addClass('active')
                .animate({opacity: 1.0}, 1000, function () {
                    $active.removeClass('active last-active');
                });
        }

        function slideSwitchForPopup() {
            var $active = $('#fadein-shownone-demo div');
            for (var i = 0; i < $active.length; i++) {
                $("#fadein-" + i).fadeIn('slow');
            }
        }

        function slideSwitchForPopup1() {
            var $active = $('#fadein-shownone-demo1 div');
            for (var i = 0; i < $active.length; i++) {
                $("#fadein1-" + i).fadeIn('slow');
            }
        }

        $(function () {
            setInterval("slideSwitch()", 5000);
        });

        function displayBlockIdeas() {
            $.get("site/product/changereservationStatus", function (data) {

                $("#reservatiosnIDLists").html(data);

                var quotes = $(".fadein-shownone-fn");
                var $active = $('#fadein-shownone-demo div');
                var quoteIndex = 1;
                var j;
                for (j = 0; j < 23; j++) {
                    displayBlock2();
                }
                $(".fadein-shownone-fn").hide();
                //$( ".fadein-shownone-fn" ).fadeIn(3000).delay(173000).fadeOut(4000);
            });
        }

        function displayBlockIdeas2() {
            $.get("site/product/changesoldStatus", function (data) {

                $("#soldIDLists").html(data);

                var quotes = $(".fadein-showold-st");
                var $active = $('#fadein-shownone-demo1 div');
                var quoteIndex = 1;
                var i;
                for (i = 0; i < 3; i++) {
                    displayBlock1();
                }

                $(".fadein-showold-st").hide();
                $(".fadein-shownone-fn").fadeIn(3000).delay(20000).fadeOut(5000);
                //$( ".fadein-showold-st" ).fadeIn(500).delay(12000).fadeOut(4000);
                //clearInterval(interval);
            });
        }




        function displayBlock1() {
            $(".fadein-showold-st").fadeIn(4000).delay(8000).fadeOut(5000);
            //$( ".fadein-showold-st" ).fadeIn(3000).delay(3000).fadeOut(5000);
        }
        function displayBlock2() {
            $(".fadein-shownone-fn").fadeIn(3000).delay(3000).fadeOut(5000);
        }

    </script>
    <?php
    if ($loginCheck != '' && $this->config->item('id_reservation') != '') {
        ?>
        <script type="text/javascript">
            jQuery(function () {
                //window.setTimeout(function(){ displayBlockIdeas(); },1000);
                //setInterval("displayBlockIdeas()",180000);

            });
        </script>
        <?php
    }
    if ($loginCheck != '' && $this->config->item('id_sold') != '') {
        ?>
        <script type="text/javascript">
            jQuery(function () {
                /* window.setTimeout(function(){ displayBlockIdeas2(); },1000);
                 setInterval("displayBlockIdeas2()",25000); */
            });


        </script>

    <?php } ?>
    <!--Popup-->
    <link rel="stylesheet" href="css/site/popup.css" type="text/css" media="all"/>
    <!-- End pop up-->

    <script src="js/site/jquery.colorbox.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="css/site/colorbox.css" />
</head>

<body>

<div class="top_nav">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>images/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler right_bt" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $urlProperty.'#about'; ?>">About Us</a>
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
                            <a class="nav-link" href="<?php echo $urlProperty.'signout'; ?>">Sign out</a>
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
<?php  if (isset($_SESSION['userdata']) && $_SESSION['userdata']['fc_session_user_id']) {  ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="right_bt">
                <a class="btn btn-primary <?php
                if ($this->uri->segment(1, 0) == 'listing') {
                    echo 'nav-link';
                }
                ?>" href="<?php
                if ($loginCheck == '') {
                    echo base_url() . 'signin';
                } else {
                    echo base_url() . 'listing/viewall/0';
                }
                ?> ">Current Inventory</a>
                <a class="btn btn-primary <?php
                if ($this->uri->segment(1, 0) == 'soldlisting') {
                    echo 'nav-link';
                }
                ?>" href="<?php
                if ($loginCheck == '') {
                    echo base_url() . 'signin';
                } else {
                    echo base_url() . 'soldlisting/viewall/0';
                }
                ?>">Past/Sold Inventory </a>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!----------listing content------------------>
<script type="text/javascript">
    function hideErrDiv(arg) {
        $("#" + arg).slideUp();
        //window.location.reload();
        document.getElementById(arg).style.display = 'none';

    }</script>
<div class="container">
    <?php if (validation_errors() != '') { ?>
        <div id="validationErr" >
            <script>setTimeout("hideErrDiv('validationErr')", 6000);</script>
            <p><?php echo validation_errors(); ?></p>
        </div>
    <?php } ?>
    <script>setTimeout("hideErrDiv('location_val')", 6000);</script>
    <?php if ($flash_data != '') { ?>
        <div class="errorContainer"  id="<?php echo $flash_data_type; ?>">
            <script>setTimeout("hideErrDiv('<?php echo $flash_data_type; ?>')", 6000);</script>
            <p ><span><?php echo $flash_data; ?></span></p>
        </div>
    <?php } ?>
</div>
<?php
//$this->load->view('site/templates/popup_templates.php',$this->data);

if ($this->config->item('google_verification')) {
    echo stripslashes($this->config->item('google_verification'));
}
?>
<script type="text/javascript">
    function LoginPageRedirect() {
        window.location.href = baseURL + 'signin';
    }
</script>
