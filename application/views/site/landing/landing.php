<?php
$this->load->view('site/templates/header');
unset($_SESSION['sExistingSold'])
?>

<div id="options" class="listing_content">
    <ul id="filters" class="button_tab option-set clearfix cssmenu" data-option-key="filter">
        <?php
        if ($loginCheck == '') {
            if (sizeof($this->data['PropertyType']) > 0) {
                $n = 0;
                foreach ($this->data['PropertyType'] as $PropertyRow) {
                    echo '<li class="active has-sub" ';
                    if ($n == 0) {
                        echo 'style="margin-left:10px;"';
                    }echo '><a href="' . base_url('signin') . '" onclick="LoginPageRedirect();">' . $PropertyRow['attr_name'] . '</a>';
                    $SubcatArr = '';
                    if (sizeof($this->data['PropertySubType']) > 0) {
                        foreach ($this->data['PropertySubType'] as $PropertySubRow) {
                            if ($PropertyRow['id'] == $PropertySubRow['attr_id']) {
                                $SubcatArr .='<li class="active has-sub" style="float:left;"><a style="width:150px" href="' . base_url('signin') . '" onclick="LoginPageRedirect();">' . $PropertySubRow['subattr_name'] . '</a></li>';
                            }
                        }
                    }

                    echo '<ul>' . $SubcatArr . '</ul></li>';
                    $n = $n + 1;
                }
            }
        } else {
            if (sizeof($this->data['PropertyType']) > 0) {
                $n = 0;
                foreach ($this->data['PropertyType'] as $PropertyRow) {
                    echo '<li class="active has-sub" ';
                    if ($n == 0) {
                        echo 'style="margin-left:10px;"';
                    }echo '><a href="javascript:void(0);" onclick="SearchByFeatureCat(' . $PropertyRow['id'] . ',0);">' . $PropertyRow['attr_name'] . '</a>';
                    $SubcatArr = '';
                    if (sizeof($this->data['PropertySubType']) > 0) {
                        foreach ($this->data['PropertySubType'] as $PropertySubRow) {
                            if ($PropertyRow['id'] == $PropertySubRow['attr_id']) {
                                $SubcatArr .='<li class="active has-sub" style="float:left;"><a style="width:150px" href="javascript:void(0);" onclick="SearchByFeatureCat(' . $PropertyRow['id'] . ',' . $PropertySubRow['id'] . ');">' . $PropertySubRow['subattr_name'] . '</a></li>';
                            }
                        }
                    }

                    echo '<ul>' . $SubcatArr . '</ul></li>';
                    $n = $n + 1;
                }
            }
        }
        ?>
        <span id="sort-by" class="option-set clearfix" data-option-key="sortBy">
            <li><a href="javascript:void(0);" onclick="SearchByFeatureCat('state', 0)" <?php
                if ($menuact == 'state') {
                    echo 'class="selected"';
                }
                ?>>Sort By State</a></li>
        </span>
        <li class="active has-sub"><a href="javascript:void(0);" <?php
            if ($menuact == 'price') {
                echo 'class="selected"';
            }
            ?> >Sort By Price</a>
            <ul>
                <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SearchByFeatureCat('asc', 0)" style="width:150px">Low to High </a></li>
                <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SearchByFeatureCat('desc', 0)" style="width:150px">High to Low </a></li>
            </ul>  

        </li>

        <li><a onclick="SearchByFeatureCat('viewall', 0)" href="javascript:void(0);" <?php
            if ($menuact == 'viewall' && $menuactcat == '0') {
                echo 'class="selected"';
            }
            ?> >All Properties</a></li>
    </ul>
    <div class="clear"></div>
    <ul id="container" class="listing_detail">
        <?php
        if (count($FeaturedProducts->result()) > 0) {
            $countid = 0;
            foreach ($FeaturedProducts->result() as $featureRow) {
                $countid = $countid + 1;
                if ($countid < 9) {
                    ?>
                    <li class="element subcat<?php echo $featureRow->property_sub_type; ?> cat<?php echo $featureRow->property_type; ?>"  data-category="cat<?php echo $featureRow->property_type; ?>">
                        <div class="feature"> <img src="images/site/feature.png" /> </div>
                        <div class="img_content"><a href="<?php
                            if ($loginCheck == '') {
                                echo base_url() . 'signin';
                            } else {
                                echo base_url() . 'Property/' . $featureRow->id . '/' . $featureRow->property_id;
                            }
                            ?>" >
                                                        <?php
                                                        $Queryq = "SELECT product_image
			FROM " . PRODUCT_PHOTOS . " WHERE property_id = " . $featureRow->id . "
			ORDER BY imgPriority ASC
			LIMIT 0 , 1";
                                                        $Queryres = $this->product_model->ExecuteQuery($Queryq);

                                                        if ($Queryres->row()->product_image != '') {
                                                            ?>
                                    <img src="<?php echo $base_url_image; ?>images/product/thumb/<?php echo trim(stripslashes($Queryres->row()->product_image)); ?>" />
                                <?php } else { ?>
                                    <img src="<?php echo $base_url_image; ?>images/product/thumb/dummyProductImage.jpg" />
                                <?php } ?>
                            </a></div>
                        <div class="clear"></div>
                        <p><?php echo $featureRow->cityname . ',  <span class="name">&nbsp;' . ucwords(str_replace('-', ' ', $featureRow->statename)); ?></span></p>
                        <div class="clear"></div>

                        <div class="rates_full"><b class="doller_user" style="font-size:16px">$</b> <?php echo '<b style="font-size:16px">' . number_format($featureRow->event_price, 0) . '</b>'; ?><span class="number" style="margin-left:0px; display:none"><?php echo $featureRow->event_price; ?></span><a href="<?php
                            if ($loginCheck == '') {
                                echo base_url() . 'signin';
                            } else {
                                echo base_url() . 'Property/' . $featureRow->id . '/' . $featureRow->property_id;
                            }
                            ?>" class="detail_btn ">Details</a> </div>
                        <div class="sub_title"><a href="<?php
                            if ($loginCheck == '') {
                                echo base_url() . 'signin';
                            } else {
                                echo base_url() . 'Property/' . $featureRow->id . '/' . $featureRow->property_id;
                            }
                            ?>"><?php echo $featureRow->bedrooms; ?> Bedrooms + <?php echo $featureRow->baths; ?> Bathrooms <br /><span class="subtitle_id"> ID: <?php echo $featureRow->property_id; ?></span></a></div>
                    </li>
                    <?php
                }
            }
        }
        ?>
    </ul>
    <nav id="page_nav">

    </nav> 
    <!----------listing end content--------------> 
</div>
<div class="clear"></div>
<div class="turn_key">
    <div class="split_turn1"> <img src="images/site/home.png" />
        <h2><?php echo $HomePageContentLeft->row()->page_title; ?></h2>
        <?php echo $HomePageContentLeft->row()->description; ?>
        <div class="read"> <a href="pages/<?php echo $HomePageContentLeft->row()->seourl; ?>">Read More</a><img src="images/site/arr_read.png" /> </div>
    </div>
    <div class="bor_use"></div>
    <div class="split_turn1" style="margin-left:10px;"> <img src="images/site/box.png" />
        <h2><?php echo $HomePageContentRight->row()->page_title; ?></h2>
        <?php echo $HomePageContentRight->row()->description; ?>
        <div class="read"> <a href="pages/<?php echo $HomePageContentRight->row()->seourl; ?>">Read More</a><img src="images/site/arr_read.png" /> </div>
    </div>
</div>
<div class="clear"></div>
<div class="turn_bor"></div>
<?php if ($videolist->num_rows() > 0) { ?>
    <script type="text/javascript" src="js/site/jcarousellite_1.0.1.pack.js"></script>

    <script type="text/javascript">
                var baseURL = '<?php echo base_url(); ?>';
                $(function () {
                    $(".slider_1").jCarouselLite({
                        btnNext: ".next_1",
                        btnPrev: ".prev_1",
                        auto: true,
                        speed: 5000,
                        visible: 5
                    });
                });


    </script>
    <div class="return_bar">
        <div class="split_return">
            <h2>Gain Turnkey Property has thousands of happy students – listen to just a few of them below:</h2>
        </div>
        <div class="clear"></div>
        <div class=" scroller_con">
            <div class="prev_1"><img src="images/site/left_arrow.png" alt="prev" /></div>
            <div class="slider_1">
                <ul>
                    <?php
                    $ittt = 1;
                    foreach ($videolist->result() as $videodetail) {
                        $youtube_link = $videodetail->video_link;
                        $video_id = substr($youtube_link, strpos($youtube_link, '?v=') + 3);
                        $vid_play_link = 'http://www.youtube.com/embed/' . $video_id;
                        ?>
                        <li class="youtubevideo<?php echo $ittt; ?>"> <img  src="http://img.youtube.com/vi/<?php echo $video_id; ?>/0.jpg" alt="Brand 1" /><iframe id="youtube_video<?php echo $ittt; ?>" width="560" height="315" src="<?php echo $vid_play_link; ?>" frameborder="0" allowfullscreen></iframe> </li>

                        <?php
                        $ittt++;
                    }
                    ?>

                                                                                                <!--  <li class="youtubevideo2"> <img src="images/site/sc_2.jpg" alt="Brand 2" /><iframe id="youtube_video2" width="560" height="315" src="//www.youtube-nocookie.com/embed/HuM6TXjpDVA" frameborder="0" allowfullscreen></iframe> </li>
                    -->
                </ul>
            </div>
            <div class="next_1"><img src="images/site/right_arrow.png" alt="next" /></div>
        </div>
    </div>
<?php } ?>
</div>
</div>
<script src="js/site/jquery.infinitescroll.min.js"></script> 
<script src="js/site/jquery.isotope.min.js"></script>
<script>

            $(function () {

                var $container = $('#container');

                $container.isotope({
                    itemSelector: '.element',
                    getSortData: {
                        name: function ($elem) {
                            return $elem.find('.name').text();
                        },
                        number: function ($elem) {
                            return parseInt($elem.find('.number').text(), 10);
                        }
                    }
                });



                $container.infinitescroll({
                    navSelector: '#page_nav', // selector for the paged navigation 
                    nextSelector: '#page_nav a', // selector for the NEXT link (to page 2)
                    itemSelector: '.element', // selector for all items you'll retrieve
                    loading: {
                        finishedMsg: 'No more pages to load.',
                        img: baseURL + 'images/site/qkKy8.gif'
                    }
                },
                // call Isotope as a callback
                // call Isotope as a callback
                        function (newElements) {
                            // var newElements = '';
                            $container.isotope('appended', $(newElements));
                        }


                );

                var $optionSets = $('#options .option-set'),
                        $optionLinks = $optionSets.find('a');

                $optionLinks.click(function () {
                    var $this = $(this);
                    // don't proceed if already selected
                    if ($this.hasClass('selected')) {
                        return false;
                    }
                    var $optionSet = $this.parents('.option-set');
                    $optionSet.find('.selected').removeClass('selected');
                    $this.addClass('selected');

                    // make option object dynamically, i.e. { filter: '.my-filter-class' }
                    var options = {},
                            key = $optionSet.attr('data-option-key'),
                            value = $this.attr('data-option-value');
                    // parse 'false' as false boolean
                    value = value === 'false' ? false : value;
                    options[ key ] = value;
                    if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                        // changes in layout modes need extra logic
                        changeLayoutMode($this, options)
                    } else {
                        // otherwise, apply new options
                        $container.isotope(options);
                    }

                    return false;
                });


            });
</script> 
<?php $this->load->view('site/templates/footer'); ?>
