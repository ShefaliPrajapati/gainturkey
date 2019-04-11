<?php
$currentUrl = $this->uri->segment(2, 0);
$currentPage = $this->uri->segment(3, 0);
if ($currentUrl == '') {
    $currentUrl = 'dashboard';
} if ($currentPage == '') {
    $currentPage = 'dashboard';
}
?>
<?php $admin_mode = $this->session->userdata('fc_session_admin_mode'); ?>

<div id="left_bar" >

    <div id="sidebar">
        <div id="secondary_nav">
            <ul id="sidenav" class="accordion_mnu collapsible">
                <?php
                extract($privileges);
                if ($allPrev == '1' && $admin_mode != 'fc_subadmin') {
                    ?>
                    <li><a href="<?php echo base_url(); ?>admin/dashboard/admin_dashboard" <?php
                        if ($currentUrl == 'dashboard') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
                    <li><h6 style="margin: 10px 0;padding-left:40px;font-weight:normal;">Managements</h6></li>
                <?php } ?>
                <?php
                extract($privileges);
                if ($allPrev == '1' && $admin_mode != 'fc_subadmin') {
                    ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'adminlogin') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon admin_user"></span> Admin<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'adminlogin' || $currentUrl == 'sitemapcreate') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/adminlogin/display_admin_list" <?php
                                if ($currentPage == 'display_admin_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Admin Users</a></li>
                            <li><a href="admin/adminlogin/change_admin_password_form" <?php
                                if ($currentPage == 'change_admin_password_form') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Change Password</a></li>
                            <li><a href="admin/adminlogin/admin_global_settings_form" <?php
                                if ($currentPage == 'admin_global_settings_form') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Settings</a></li>
                            <!--<li><a href="admin/adminlogin/pr_admin_global_settings_form" <?php
/*                                if ($currentPage == 'pr_admin_global_settings_form') {
                                    echo 'class="active"';
                                }  */?>>
                                    <span class="list-icon">&nbsp;</span>Preigrentals Settings</a></li>-->
                            <li><a href="admin/adminlogin/admin_smtp_settings" <?php
                                if ($currentPage == 'admin_smtp_settings') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>SMTP Settings</a></li>
                            <li><a href="admin/sitemapcreate" <?php
                                if ($currentUrl == 'sitemapcreate') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Sitemap Creation</a></li>
                        </ul>
                    </li>

                    <li><a href="#" <?php
                        if ($currentUrl == 'subadmin') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon user"></span> Subadmin<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'subadmin') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/subadmin/display_sub_admin" <?php
                                if ($currentPage == 'display_sub_admin') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Subadmin List</a></li>
                            <li><a href="admin/subadmin/add_sub_admin_form" <?php
                                if ($currentPage == 'add_sub_admin_form') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Add New Subadmin</a></li>
                        </ul>
                    </li>

                <?php } if ((isset($user) && is_array($user)) && in_array('0', $user) && $admin_mode != 'fc_subadmin' || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'users') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon users"></span> Users<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'users') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/users/display_user_dashboard" <?php
                                if ($currentPage == 'display_user_dashboard') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
                            <li><a href="admin/users/display_user_list" <?php
                                if ($currentPage == 'display_user_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Users List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $user)) { ?>
                                <li><a href="admin/users/add_user_form" <?php
                                    if ($currentPage == 'add_user_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New User</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($renter) && is_array($renter)) && in_array('0', $renter) || $allPrev == '1' && $admin_mode != 'fc_subadmin') { ?>
                    <!--<li><a href="#" <?php
                    if ($currentUrl == 'seller' || $currentUrl == 'commission') {
                        echo 'class="active"';
                    }
                    ?>><span class="nav_icon users_2"></span> Renters<span class="up_down_arrow">&nbsp;</span></a>
                    <ul class="acitem" <?php
                    if ($currentUrl == 'seller' || $currentUrl == 'commission') {
                        echo 'style="display: block;"';
                    } else {
                        echo 'style="display: none;"';
                    }
                    ?>>
                            <li><a href="admin/seller/display_seller_dashboard" <?php
                    if ($currentPage == 'display_seller_dashboard') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
                            <li><a href="admin/seller/display_seller_list" <?php
                    if ($currentPage == 'display_seller_list') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Renters List</a></li>
                            <li><a href="admin/seller/display_seller_requests" <?php
                    if ($currentPage == 'display_seller_requests') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Seller Requests</a></li>
                            <li><a href="admin/commission/display_commission_lists" <?php
                    if ($currentPage == 'display_commission_lists') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Commission Tracking</a></li>
                    </ul>
                    </li>-->

                <?php } if ((isset($property) && is_array($property)) && in_array('0', $property) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'product' || $currentUrl == 'comments') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span> Properties<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'product' || $currentUrl == 'comments') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>


                            <!--<li><a href="admin/product/display_rental_dashboard" <?php
                            if ($currentPage == 'display_rental_dashboard') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>-->


                            <li><a href="admin/product/display_product_list" <?php
                                if ($currentPage == 'display_product_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Property List</a></li>
                            <!--<li><a href="admin/product/display_user_product_list" <?php
                            if ($currentPage == 'display_user_product_list') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>UnSold Property List</a></li>
        <li><a href="admin/comments/view_product_comments" <?php
                            if ($currentPage == 'view_product_comments') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>Rental Comments List</a></li>-->
                            <?php if ($allPrev == '1' || in_array('1', $property)) { ?>
                                <li><a href="admin/product/add_product_form" <?php
                                    if ($currentPage == 'add_product_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Property</a></li>
                                   <?php } ?>

                        </ul>
                    </li>


                <?php } if ((isset($membership) && $admin_mode != 'fc_subadmin' && is_array($membership)) && in_array('0', $membership) || $allPrev == '1') { ?>
                    <!--<li><a href="#" <?php
                    if ($currentUrl == 'membership') {
                        echo 'class="active"';
                    }
                    ?>><span class="nav_icon chart_8"></span> Membership Package<span class="up_down_arrow">&nbsp;</span></a>
                    <ul class="acitem" <?php
                    if ($currentUrl == 'membership') {
                        echo 'style="display: block;"';
                    } else {
                        echo 'style="display: none;"';
                    }
                    ?>>
            <li><a href="admin/membership/display_membership_dashboard" <?php
                    if ($currentPage == 'display_membership_dashboard') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>
        <li><a href="admin/membership/membership_list" <?php
                    if ($currentPage == 'membership_list') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Subscribed Members</a></li>
                            <li><a href="admin/membership/display_membership" <?php
                    if ($currentPage == 'display_membership') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Membership Package List</a></li>
                    <?php if ($allPrev == '1' || in_array('1', $membership)) { ?>
                                            <li><a href="admin/membership/add_membership_form" <?php
                        if ($currentPage == 'add_membership_form') {
                            echo 'class="active"';
                        }
                        ?>><span class="list-icon">&nbsp;</span>Add Membership Package</a></li>
                    <?php } ?>
                    </ul>
                    </li>-->


                    <!--<?php } if ((isset($rate_package) && is_array($rate_package)) && $admin_mode != 'fc_subadmin' && in_array('0', $rate_package) || $allPrev == '1') { ?>
                                  <li><a href="#" <?php
                    if ($currentUrl == 'rate_package') {
                        echo 'class="active"';
                    }
                    ?>><span class="nav_icon chart_8"></span> Rental Price Package<span class="up_down_arrow">&nbsp;</span></a>
                                  <ul class="acitem" <?php
                    if ($currentUrl == 'rate_package') {
                        echo 'style="display: block;"';
                    } else {
                        echo 'style="display: none;"';
                    }
                    ?>>
                         
                                          <li><a href="admin/rate_package/display_package_list" <?php
                    if ($currentPage == 'display_package_list') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Rental Price Package List</a></li>
                    <?php if ($allPrev == '1' || in_array('1', $rate_package)) { ?>
                                                          <li><a href="admin/rate_package/add_package_form" <?php
                        if ($currentPage == 'add_package_form') {
                            echo 'class="active"';
                        }
                        ?>><span class="list-icon">&nbsp;</span>Add Rental Price Package</a></li>
                    <?php } ?>
                                  </ul>
                                  </li>
                  
                <?php }if ((isset($paygateway) && is_array($paygateway)) && $admin_mode != 'fc_subadmin' && in_array('0', $paygateway) || $allPrev == '1') {
                    ?>
                  <li><a href="#" <?php
                    if ($currentUrl == 'order' || $this->uri->segment(1, 0) == 'order-review') {
                        echo 'class="active"';
                    }
                    ?>><span class="nav_icon coverflow"></span> Orders<span class="up_down_arrow">&nbsp;</span></a>
                                  <ul class="acitem" <?php
                    if ($currentUrl == 'order' || $this->uri->segment(1, 0) == 'order-review') {
                        echo 'style="display: block;"';
                    } else {
                        echo 'style="display: none;"';
                    }
                    ?>>
                                          <li><a href="admin/order/display_order_paid" <?php
                    if ($currentPage == 'display_order_paid') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Paid Payment</a></li>
                                          <li><a href="admin/order/display_order_pending" <?php
                    if ($currentPage == 'display_order_pending') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Failed Payment</a></li>

                                  </ul>
                                  </li>-->


                <?php } if ((isset($contact) && is_array($contact)) && $admin_mode != 'fc_subadmin' && in_array('0', $contact) || $allPrev == '1') { ?>

                    <li><a href="#" <?php
                        if ($currentUrl == 'contact' || $this->uri->segment(1, 0) == 'contact-review') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon money_2"></span> Contact Management <span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'contact' || $this->uri->segment(1, 0) == 'order-review') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <!-- <li><a href="admin/contact/display_contact_dashboard" <?php
                            if ($currentPage == 'display_contact_dashboard') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>Dashboard </a></li>-->
                            <li><a href="admin/contact/display_contact_list" <?php
                                if ($currentPage == 'display_contact_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Contact List </a></li>
                        </ul>
                    </li>

                <?php } if ((isset($code) && is_array($code)) && $admin_mode != 'fc_subadmin' && in_array('0', $code) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'attribute') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon cog_3"></span> Code<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'attribute') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/attribute/display_attribute_list" <?php
                                if ($currentPage == 'display_attribute_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Code List</a></li>
                            <!--<li><a href="admin/attribute/display_list_values" <?php
                            if ($currentPage == 'display_list_values') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>List Values</a></li>-->
                            <?php if ($allPrev == '1' || in_array('1', $attribute)) { ?>
                                <li><a href="admin/attribute/add_attribute_form" <?php
                                    if ($currentPage == 'add_attribute_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Code</a></li>
                                <!-- <li><a href="admin/attribute/add_list_value_form" <?php
                                if ($currentPage == 'add_list_value_form') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Add List Value</a></li>-->
                            <?php } ?>
                        </ul>
                    </li>


                <?php } if ((isset($propertytype) && is_array($propertytype)) && $admin_mode != 'fc_subadmin' && in_array('0', $propertytype) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'productattribute') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon computer_imac"></span> Property Type<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'productattribute') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/productattribute/display_product_attribute_list" <?php
                                if ($currentPage == 'display_product_attribute_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Property Type List</a></li>
                            <li><a href="admin/productattribute/display_product_subattribute_list" <?php
                                if ($currentPage == 'display_product_subattribute_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Property Sub Type List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $propertytype)) { ?>
                                <li><a href="admin/productattribute/add_product_attribute_form" <?php
                                    if ($currentPage == 'add_product_attribute_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add Property Type</a></li>
                                <li><a href="admin/productattribute/add_product_subattribute_form" <?php
                                    if ($currentPage == 'add_product_subattribute_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add Property Sub Type</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($location) && is_array($location)) && in_array('0', $location) && $admin_mode != 'fc_subadmin' || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'location') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon globe"></span> Location<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'location') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/location/display_location_list" <?php
                                if ($currentPage == 'display_location_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Location List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $location)) { ?>
                                <!-- <li><a href="admin/location/add_location_form" <?php
                                if ($currentPage == 'add_location_form') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Add Location</a></li>-->
                            <?php } ?>
                            <!--<li><a href="admin/state/display_location_list" <?php
                            if ($currentUrl == 'state') {
                                echo 'class="active"';
                            }
                            ?>><span class="nav_icon cog_3"></span> Country Management</a></li>-->
                            <!-- <li><a href="admin/location/display_country_list" <?php
                            if ($currentPage == 'display_country_list') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>Country List</a></li>
                            
                            <li><a href="admin/location/add_tax_form" <?php
                            if ($currentPage == 'add_tax_form') {
                                echo 'class="active"';
                            }
                            ?>><span class="list-icon">&nbsp;</span>Add State Tax</a></li>
                            -->
                        </ul>
                    </li>

                <?php } if ((isset($sourcer) && is_array($sourcer)) && $admin_mode != 'fc_subadmin' && in_array('0', $sourcer) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'sourcer') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span>Property Sourcer Mgmt<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'sourcer') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/sourcer/display_sourcer_list" <?php
                                if ($currentPage == 'display_sourcer_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Sourcer List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $sourcerproperty)) { ?>
                                <li><a href="admin/sourcer/add_sourcer_form" <?php
                                    if ($currentPage == 'add_sourcer_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Sourcer</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($manager) && is_array($manager)) && $admin_mode != 'fc_subadmin' && in_array('0', $manager) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'manager') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span>Property Manager Mgmt<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'manager') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/manager/display_manager_list" <?php
                                if ($currentPage == 'display_manager_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Manager List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $sourcerproperty)) { ?>
                                <li><a href="admin/manager/add_manager_form" <?php
                                    if ($currentPage == 'add_manager_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Manager</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($pages) && is_array($pages)) && $admin_mode != 'fc_subadmin' && in_array('0', $pages) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'cms') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon documents"></span> Pages<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'cms') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/cms/display_cms" <?php
                                if ($currentPage == 'display_cms') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>List of pages</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $pages)) { ?>
                                <li><a href="admin/cms/add_cms_form" <?php
                                    if ($currentPage == 'add_cms_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add Main Page</a></li>
                                <li><a href="admin/cms/add_subpage_form" <?php
                                    if ($currentPage == 'add_subpage_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add Sub Page</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($slider) && is_array($slider)) && $admin_mode != 'fc_subadmin' && in_array('0', $slider) || $allPrev == '1') { ?>
                    <li><a href="#" <?php
                        if ($currentUrl == 'slider') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span> Slider<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'slider') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/slider/display_slider_list" <?php
                                if ($currentPage == 'display_slider_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Slider List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $slider)) { ?>
                                <li><a href="admin/slider/add_slider_form" <?php
                                    if ($currentPage == 'add_slider_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Slider</a></li>
                                   <?php } ?>
                        </ul>
                    </li>

                <?php } if ((isset($videos) && is_array($videos)) && $admin_mode != 'fc_subadmin' && in_array('0', $videos) || $allPrev == '1') { ?>

                    <li><a href="#" <?php
                        if ($currentUrl == 'video') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span> Videos<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'video') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/video/display_video_list" <?php
                                if ($currentPage == 'display_video_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Video List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $videos)) { ?>
                                <li><a href="admin/video/add_video_form" <?php
                                    if ($currentPage == 'add_video_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Video</a></li>
                                   <?php } ?>
                        </ul>
                    </li>
                <?php } ?>



                <?php if ((isset($consultant) && is_array($consultant)) && $admin_mode != 'fc_subadmin' && in_array('0', $consultant) || $allPrev == '1') { ?>

                    <li><a href="#" <?php
                        if ($currentUrl == 'consultant') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span> Consultant<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'consultant') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/consultant/display_consultant_list" <?php
                                if ($currentPage == 'display_consultant_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Initial List</a></li>
                                   <?php if ($allPrev == '1' || in_array('1', $consultant)) { ?>
                                <li><a href="admin/consultant/add_consultant_form" <?php
                                    if ($currentPage == 'add_consultant_form') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Add New Initial</a></li>
                                   <?php } ?>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ((isset($brochure) && is_array($brochure)) && $admin_mode != 'fc_subadmin' && in_array('0', $brochure) || $allPrev == '1') { ?>
                    
                    <li><a href="#" <?php
                        if ($currentUrl == 'brochure') {
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span> brochure<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'brochure') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/brochure/display_brochure_list" <?php
                                if ($currentPage == 'display_brochure_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Brochure List</a></li>

                        </ul>
                    </li>
                <?php } ?>
                
                <?php if ((isset($news) && is_array($news)) && $admin_mode != 'fc_subadmin' && in_array('0', $news) || $allPrev == '1') { ?>
                    
                    <!--<li><a href="#" <?php
                        if ($currentUrl == 'news') {
                            echo "hello";
                            echo 'class="active"';
                        }
                        ?>><span class="nav_icon folder"></span>News<span class="up_down_arrow">&nbsp;</span></a>
                        <ul class="acitem" <?php
                        if ($currentUrl == 'news') {
                            echo 'style="display: block;"';
                        } else {
                            echo 'style="display: none;"';
                        }
                        ?>>
                            <li><a href="admin/news/newsList" <?php
                                if ($currentPage == 'display_news_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>News List</a></li>
                            <li><a href="admin/news/add_news_form" <?php
                                if ($currentPage == 'display_news_list') {
                                    echo 'class="active"';
                                }
                                ?>><span class="list-icon">&nbsp;</span>Add New News</a></li>

                        </ul>
                    </li>-->
                <?php } ?>

                <?php /* if ((isset($testimonials) && is_array($testimonials)) && in_array('0', $testimonials) || $allPrev == '1'){ ?>

                  <li><a href="#" <?php if($currentUrl=='testimonials' || $this->uri->segment(1,0)=='testimonials-review'){ echo 'class="active"';} ?>><span class="nav_icon folder"></span> Testimonials <span class="up_down_arrow">&nbsp;</span></a>
                  <ul class="acitem" <?php if($currentUrl=='testimonials' || $this->uri->segment(1,0)=='testimonials-review'){ echo 'style="display: block;"';}else{ echo 'style="display: none;"';} ?>>

                  <li><a href="admin/testimonials/display_testimonials_list" <?php if($currentPage=='display_testimonials_list'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Testimonials List </a></li>
                  <?php if ($allPrev == '1' || in_array('1', $testimonials)){?>
                  <li><a href="admin/testimonials/add_testimonials_form" <?php if($currentPage=='add_testimonials_form'){ echo 'class="active"';} ?>><span class="list-icon">&nbsp;</span>Add Testimonial</a></li>
                  <?php } ?>
                  </ul>
                  </li>
                  <?php } */ ?>   
                <?php if ((isset($testimonials) && is_array($testimonials)) && $admin_mode != 'fc_subadmin' && in_array('0', $testimonials) || $allPrev == '1') { ?>

                    <!--<li><a href="#" <?php
                    if ($currentUrl == 'testimonials' || $this->uri->segment(1, 0) == 'testimonials-review') {
                        echo 'class="active"';
                    }
                    ?>><span class="nav_icon folder"></span> Review <span class="up_down_arrow">&nbsp;</span></a>
                                    <ul class="acitem" <?php
                    if ($currentUrl == 'testimonials' || $this->uri->segment(1, 0) == 'testimonials-review') {
                        echo 'style="display: block;"';
                    } else {
                        echo 'style="display: none;"';
                    }
                    ?>>
                   
                                            <li><a href="admin/review/display_review_list" <?php
                    if ($currentPage == 'display_testimonials_list') {
                        echo 'class="active"';
                    }
                    ?>><span class="list-icon">&nbsp;</span>Review List </a></li>
                      
                                    </ul>
                                    </li> -->
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
