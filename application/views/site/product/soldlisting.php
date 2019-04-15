<?php $this->load->view('site/templates/new_header'); ?>
<link rel="stylesheet" type="text/css" href="css/site/master.css"/>
<div class="container">

<div id="options" class="listing_content">
    <?php if ($userDetails->row()->reservation == 'Yes') {
    ?>
        <a href="<?php echo base_url() . 'reservation-continue/' . $userDetails->row()->property_id; ?>" class="detail_btn" style="margin-top:10px;"> Back To Reservation</a>
    <?php
} ?>
    <ul id="filters" class="button_tab option-set clearfix cssmenu" data-option-key="filter">

        <?php
        if ($loginCheck == '') {
            if (sizeof($this->data['PropertyType']) > 0) {
                $n = 0;
                foreach ($this->data['PropertyType'] as $PropertyRow) {
                    echo '<li class="active has-sub" ';
                    if ($n == 0) {
                        echo 'style="margin-left:10px;"';
                    }
                    echo '><a href="' . base_url('signin') . '" onclick="LoginPageRedirect();">' . $PropertyRow['attr_name'] . '</a>';
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
            $menuact = $this->uri->segment('2');
            $menuactcat = $this->uri->segment('3');
            if (sizeof($this->data['PropertyType']) > 0) {
                $n = 0;
                foreach ($this->data['PropertyType'] as $PropertyRow) {
                    echo '<li class="active has-sub" ';
                    if ($n == 0) {
                        echo 'style="margin-left:10px;"';
                    }
                    echo '><a href="javascript:void(0);" onclick="SoldSearchByCat(' . $PropertyRow['id'] . ',0)" data-option-value=".cat' . $PropertyRow['id'] . '" id="active_' . $PropertyRow['id'] . '"';

                    if ($menuact == $PropertyRow['id']) {
                        echo 'class="selected"';
                    }



                    echo '>' . $PropertyRow['attr_name'] . '</a>';
                    $SubcatArr = '';
                    if (sizeof($this->data['PropertySubType']) > 0) {
                        foreach ($this->data['PropertySubType'] as $PropertySubRow) {
                            if ($PropertyRow['id'] == $PropertySubRow['attr_id']) {
                                $SubcatArr .='<li class="active has-sub" style="float:left;"><a style="width:150px" onclick="SoldSearchByCat(' . $PropertyRow['id'] . ',' . $PropertySubRow['id'] . ')" href="javascript:void(0);" data-option-value=".subcat' . $PropertySubRow['id'] . '" >' . $PropertySubRow['subattr_name'] . '</a></li>';
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
            <li><a id="active_state" onclick="SoldSearchByCat('state', 0)" href="javascript:void(0);" data-option-value="name" <?php
                if ($menuact == 'state') {
                    echo 'class="selected"';
                }
                ?>>Sort By State</a></li>
            <li class="active has-sub"><a id="active_price" class="active has-sub" href="javascript:void(0);" data-option-value="number" <?php
                if ($menuact == 'price') {
                    echo 'class="selected"';
                }
                ?>>Sort By Price</a>
                <ul >
                    <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SoldSearchByCat('priceasc', 0)"  style="width:150px">Low to High </a></li>
                    <li style="float:left;" class="active has-sub"><a href="javascript:void(0);" onclick="SoldSearchByCat('pricedesc', 0)"  style="width:150px">High to Low </a></li>
                </ul>
            </li>
            <li><a id="active_viewall" onclick="SoldSearchByCat('viewall', 0)" href="javascript:void(0);" data-option-value="*" <?php
                if ($menuact == 'viewall' && $menuactcat == '0') {
                    echo 'class="selected"';
                }
                ?>>All Properties</a></li>
        </span>


    </ul>
    <div id="fulldiv_container" style="float:left; width:100%">
        <?php if ($paginationLink) {
                    ?>
            <div class="pagination">
                <ul class="pagination-ul"><?php echo $paginationLink; ?></ul>
            </div>
        <?php
                } ?>
        <div class="clear"></div><ul id="container" class="listing_page">
            <?php foreach ($productDetails->result() as $row) {
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
                    $Queryres = $this->product_model->ExecuteQuery($Queryq); ?>
                    <div class="img_content"><a><img src="<?php echo base_url() ?>images/product/thumb/<?php
                            if ($Queryres->row()->product_image != '') {
                                echo $Queryres->row()->product_image;
                            } else {
                                echo "dummyProductImage.jpg";
                            } ?>" /></a>
                        <!--  <div class="fianance">
                              <a href="#">FINANCING  AVAILABLE</a>
                          </div>-->
                    </div>
                    <div class="clear"></div>
                    <p><b class="doller_user">$</b><?php echo number_format($row->event_price, 0); ?> <span class="number" style="display:none"><?php echo $row->event_price; ?></span></p><span class="name_con"><?php echo $row->city . ', &nbsp;<span class="name">' . ucwords(str_replace('-', ' ', $row->state)); ?></span></span>
                    <div class="clear"></div>
                    <div class="rates_full_list">
                        <span><?php
                            if ($row->financing == 'Yes' && $row->cash_only == 'Yes') {
                                echo 'FINANCING  AVAILABLE';
                            } elseif ($row->financing == 'Yes') {
                                echo 'FINANCING  AVAILABLE';
                            } elseif ($row->cash_only == 'Yes') {
                                echo "CASH ONLY";
                            } ?></span><a class="detail_btn">Details</a>
                    </div>
                    <div class="sub_title_list"><a><?php echo $row->bedrooms; ?> Bedrooms + <?php echo $row->baths; ?> Bathrooms <br /><span class="subtitle_id"> ID: <?php echo $row->property_id; ?></span></div></a>

                </li>
            <?php
                } ?>
        </ul>
        <div class="clear"></div>
        <div class="pagination"><ul class="pagination-ul"><?php echo $paginationLink; ?></ul></div>
    </div>
    <!----------listing end content-------------->
</div>
<div class="clear"></div>
</div>


<?php $this->load->view('site/templates/new_footer'); ?>
