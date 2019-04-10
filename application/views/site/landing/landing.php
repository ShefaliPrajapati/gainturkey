<?php
$this->load->view('site/templates/new_header');
?>
<link rel="stylesheet" type="text/css" href="css/site/master.css"/>
<div class="container">
<div id="options" class="listing_content" >
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
                                $SubcatArr .='<li class="active has-sub" style="float:left;"><a href="' . base_url('signin') . '" onclick="LoginPageRedirect();" style="width:150px" >' . $PropertySubRow['subattr_name'] . '</a></li>';
                            }
                        }
                    }

                    echo '<ul>' . $SubcatArr . '</ul></li>';
                    $n = $n + 1;
                }
            }
        } else {

            $menuact = $this->uri->segment('2');
            $menuactcat = $this->uri->segment('3');
            if (sizeof($this->data['PropertyType']) > 0) {
                $n = 0;
                foreach ($this->data['PropertyType'] as $PropertyRow) {
                    echo '<li class="active has-sub" ';
                    if ($n == 0) {
                        echo 'style="margin-left:10px;"';
                    }echo '><a href="javascript:void(0);" onclick="SearchByCat(' . $PropertyRow['id'] . ',0)" data-option-value=".cat' . $PropertyRow['id'] . '" id="active_' . $PropertyRow['id'] . '"';

                    if ($menuact == $PropertyRow['id']) {
                        echo 'class="selected"';
                    }



                    echo '>' . $PropertyRow['attr_name'] . '</a>';
                    $SubcatArr = '';
                    if (sizeof($this->data['PropertySubType']) > 0) {
                        foreach ($this->data['PropertySubType'] as $PropertySubRow) {
                            if ($PropertyRow['id'] == $PropertySubRow['attr_id']) {
                                $SubcatArr .='<li class="active has-sub" style="float:left;"><a  onclick="SearchByCat(' . $PropertyRow['id'] . ',' . $PropertySubRow['id'] . ')" href="javascript:void(0);" data-option-value=".subcat' . $PropertySubRow['id'] . '" >' . $PropertySubRow['subattr_name'] . '</a></li>';
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
            <li><a id="active_state" onclick="SearchByCat('state', 0)" href="javascript:void(0);" data-option-value="name" <?php
                if ($menuact == 'state') {
                    echo 'class="selected"';
                }
                ?>>Sort By State</a></li>
            <li class="active has-sub" style="float:left;"><a id="active_price" href="javascript:void(0);" data-option-value="number" <?php
                if ($menuact == 'price') {
                    echo 'class="selected"';
                }
                ?>>Sort By Price</a>
                <ul>
                    <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SearchByCat('priceasc', 0)">Low to High </a></li>
                    <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SearchByCat('pricedesc', 0)">High to Low </a></li>
                </ul>
            </li>
            <li><a id="active_viewall" onclick="SearchByCat('viewall', 0)" href="javascript:void(0);"
                   data-option-value="*" <?php
                if ($menuact == 'viewall' && $menuactcat == '0') {
                    echo 'class="selected"';
                }
                ?>>All Properties</a></li>
        </span>
    </ul>
    <div id="fulldiv_container">
        <div class="pagination">
            <ul class="pagination-ul">
                <?php echo $paginationLink; ?>
            </ul>
        </div>
        <div class="clear"></div>
        <ul id="container" class="listing_page">
            <?php foreach ($FeaturedProducts->result() as $row) {
                ?>
                <li  class="element subcat<?php echo $row->property_sub_type; ?> cat<?php echo $row->property_type; ?>"  data-category="cat<?php echo $row->property_type; ?>">
                    <?php
                    if ($row->featured == 'Yes') {
                        echo '<div class="feature">
    					<img src="images/site/feature.png" />
    					</div>';
                    }

                    $Queryq = "SELECT product_image
			FROM " . PRODUCT_PHOTOS . " WHERE property_id = " . $row->id . "
			ORDER BY imgPriority ASC
			LIMIT 0 , 1";
                    $Queryres = $this->product_model->ExecuteQuery($Queryq);

                    if ($loginCheck == '') {
                        $url =  base_url() . 'signin';
                    } else {
                        if ($row->property_status != 'Sold') {
                            $url = base_url() . 'Property/' . $row->id . '/' . $row->property_id;
                        }
                    }
                    ?>
                    <div class="img_content">

                        <a href="<?php  echo $url; ?>"
                        ><img src="<?php echo base_url(); ?>images/product/thumb/<?php
                            if ($Queryres->row()->product_image != '')
                                echo $Queryres->row()->product_image;
                            else
                                echo "dummyProductImage.jpg";
                            ?>" /></a>
                    </div>
                    <div class="clear"></div>
                    <p><b class="doller_user">$</b><?php echo number_format($row->event_price, 0); ?> <span class="number" style="display:none"><?php echo $row->event_price; ?></span></p><span class="name_con"><?php echo ucwords($row->city) . ', <span class="name">' . ucwords(str_replace('-', ' ', $row->state)); ?></span></span>
                    <div class="clear"></div>
                    <div class="rates_full_list">
                        <span><?php
                            if ($row->financing == 'Yes' && $row->cash_only == 'Yes')
                                echo 'FINANCING  AVAILABLE';
                            else if ($row->financing == 'Yes')
                                echo 'FINANCING  AVAILABLE';
                            else if ($row->cash_only == 'Yes')
                                echo "CASH ONLY";
                            ?></span>

                        <a href="<?php  echo $url; ?>" class="detail_btn">Details</a>
                    </div>
                    <div class="sub_title_list"><a href="<?php if ($row->property_status != 'Sold') echo base_url() . 'Property/' . $row->id . '/' . $row->property_id; /* else echo base_url(soldlisting); */ ?>"><?php echo $row->bedrooms; ?> Bedrooms + <?php echo $row->baths; ?> Bathrooms <br /><span class="subtitle_id"> ID: <?php echo $row->property_id; ?></span></a></div>

                </li>
            <?php } ?>
        </ul>
        <div class="clear"></div>
        <div class="pagination">
            <ul class="pagination-ul"><?php echo $paginationLink; ?></ul>
        </div>
    </div>
</div>

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
<?php $this->load->view('site/templates/new_footer'); ?>
