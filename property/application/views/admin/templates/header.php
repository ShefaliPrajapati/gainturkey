<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <base href="<?php echo base_url(); ?>">
        <title><?php echo $heading . ' - ' . $title; ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/logo/<?php echo $fevicon; ?>">
        <link href="css/reset.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/layout.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/themes.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/typography.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">

        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/jquery.jqplot.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/data-table.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/form.css" rel="stylesheet" type="text/css" media="screen">

        <link href="css/ui-elements.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/wizard.css" rel="stylesheet" type="text/css">
        <link href="css/sprite.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/gradient.css" rel="stylesheet" type="text/css" media="screen">
        <link href="css/developer.css" rel="stylesheet" type="text/css">
        <!--<link rel="stylesheet" type="text/css" href="css/ie/ie7.css" />
        <link rel="stylesheet" type="text/css" href="css/ie/ie8.css" />
        <link rel="stylesheet" type="text/css" href="css/ie/ie9.css" />-->
        <script type="text/javascript">
            var BaseURL = '<?php echo base_url(); ?>';
            var baseURL = '<?php echo base_url(); ?>';
        </script>
        <script src="js/jquery-1.7.1.min.js"></script>
        <script src="js/jquery-ui-1.8.18.custom.min.js"></script>
        <script src="js/jquery.ui.touch-punch.js"></script>
        <script src="js/chosen.jquery.js"></script>
        <script src="js/uniform.jquery.js"></script>
        <script src="js/bootstrap-dropdown.js"></script>
        <script src="js/bootstrap-colorpicker.js"></script>
        <script src="js/sticky.full.js"></script>
        <script src="js/jquery.noty.js"></script>
        <script src="js/selectToUISlider.jQuery.js"></script>
        <script src="js/fg.menu.js"></script>
        <script src="js/jquery.tagsinput.js"></script>

        <script src="js/jquery.cleditor.js"></script>
        <script src="js/jquery.tipsy.js"></script>
        <script src="js/jquery.peity.js"></script>
        <script src="js/jquery.simplemodal.js"></script>
        <script src="js/jquery.jBreadCrumb.1.1.js"></script>
        <script src="js/jquery.colorbox-min.js"></script>
        <script src="js/jquery.idTabs.min.js"></script>
        <script src="js/jquery.multiFieldExtender.min.js"></script>
        <script src="js/jquery.confirm.js"></script>
        <script src="js/elfinder.min.js"></script>
        <script src="js/accordion.jquery.js"></script>
        <script src="js/autogrow.jquery.js"></script>
        <script src="js/check-all.jquery.js"></script>
        <script src="js/data-table.jquery.js"></script>
        <script src="js/ZeroClipboard.js"></script>
        <script src="js/TableTools.min.js"></script>
        <script src="js/jeditable.jquery.js"></script>
        <script src="js/ColVis.min.js"></script>
        <script src="js/duallist.jquery.js"></script>
        <!--<script src="js/easing.jquery.js"></script>-->
        <script src="js/full-calendar.jquery.js"></script>
        <script src="js/input-limiter.jquery.js"></script>
        <script src="js/inputmask.jquery.js"></script>
        <script src="js/iphone-style-checkbox.jquery.js"></script>
        <script src="js/meta-data.jquery.js"></script>
        <script src="js/quicksand.jquery.js"></script>
        <script src="js/raty.jquery.js"></script>
        <script src="js/smart-wizard.jquery.js"></script>
        <script src="js/stepy.jquery.js"></script>
        <script src="js/treeview.jquery.js"></script>
        <script src="js/ui-accordion.jquery.js"></script> 
        <script src="js/vaidation.jquery.js"></script>
        <script src="js/mosaic.1.0.1.min.js"></script>
        <script src="js/jquery.collapse.js"></script>
        <script src="js/jquery.cookie.js"></script>
        <script src="js/jquery.autocomplete.min.js"></script>
        <script src="js/localdata.js"></script>
        <script src="js/excanvas.min.js"></script>
        <script src="js/jquery.jqplot.min.js"></script>
        <script src="js/chart-plugins/jqplot.dateAxisRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.cursor.min.js"></script>
        <script src="js/chart-plugins/jqplot.logAxisRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.canvasTextRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.highlighter.min.js"></script>
        <script src="js/chart-plugins/jqplot.pieRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.barRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.categoryAxisRenderer.min.js"></script>
        <script src="js/chart-plugins/jqplot.pointLabels.min.js"></script>
        <script src="js/chart-plugins/jqplot.meterGaugeRenderer.min.js"></script>
        <script src="js/jquery.MultiFile.js"></script>
        <script src="js/custom-scripts.js"></script>
        <script src="js/validation.js"></script>
        <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                browser_spellcheck: true,
                gecko_spellcheck: true,
                mode: "specific_textareas",
                editor_selector: "mceEditor",
                theme: "advanced",
                plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
                external_plugins: {"nanospell": "/nanospell/plugin.js"},
                nanospell_server: "php", // choose "php" "asp" "asp.net" or "java"

                // Theme options
                theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,nanospell,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                theme_advanced_toolbar_location: "top",
                theme_advanced_toolbar_align: "left",
                theme_advanced_statusbar_location: "bottom",
                theme_advanced_resizing: true,
                file_browser_callback: "ajaxfilemanager",
                relative_urls: false,
                convert_urls: false,
                // Example content CSS (should be your site CSS)
                content_css: "css/example.css",
                // Drop lists for link/image/media/template dialogs
                template_external_list_url: "js/template_list.js",
                external_link_list_url: "js/link_list.js",
                external_image_list_url: "js/image_list.js",
                media_external_list_url: "js/media_list.js",
                // Replace values for the template plugin
                template_replace_values: {
                    username: "Some User",
                    staffid: "991234"
                }
            });

            function ajaxfilemanager(field_name, url, type, win) {
                var ajaxfilemanagerurl = '<?php echo base_url(); ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php';
                switch (type) {
                    case "image":
                        break;
                    case "media":
                        break;
                    case "flash":
                        break;
                    case "file":
                        break;
                    default:
                        return false;
                }
                tinyMCE.activeEditor.windowManager.open({
                    url: '<?php echo base_url(); ?>js/tinymce/jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php',
                    width: 782,
                    height: 440,
                    inline: "yes",
                    close_previous: "no"
                }, {
                    window: win,
                    input: field_name
                });

                return false;
                var fileBrowserWindow = new Array();
                fileBrowserWindow["file"] = ajaxfilemanagerurl;
                fileBrowserWindow["title"] = "Ajax File Manager";
                fileBrowserWindow["width"] = "782";
                fileBrowserWindow["height"] = "440";
                fileBrowserWindow["close_previous"] = "no";
                tinyMCE.openWindow(fileBrowserWindow, {
                    window: win,
                    input: field_name,
                    resizable: "yes",
                    inline: "yes",
                    editor_id: tinyMCE.getWindowArg("editor_id")
                });

                return false;
            }
        </script>
        <script type="text/javascript">
            function hideErrDiv(arg) {
                document.getElementById(arg).style.display = 'none';
            }
        </script>
        <script>
            $(document).ready(function () {


                $('#cboxClose').click(function () {
                    $("#details").hide();
                    return false;
                });
                $(".cboxClose").click(function () {
                    $("#cboxOverlay,#colorbox,#draggable").hide();
                    //alert("jj");
                    window.location.href = baseURL + 'admin';
                });

                var prodid = '<?php echo $this->uri->segment(4, 0); ?>';

                $(".dragndrop").colorbox({width: "1000px", height: "500px", href: baseURL + "admin/product/dragimageuploadedit/" + prodid});

                $(".dragndrop1").colorbox({width: "1000px", height: "500px", href: baseURL + "admin/product/dragimageuploadinsert"});


                $("#onLoad").click(function () {
                    $('#onLoad').css({"background-color": "#f00", "color": "#fff", "cursor": "inherit"}).text("Open this window again and this message will still be here.");
                    return false;
                });

            });
        </script>
    </head>
    <body id="theme-default" class="full_block">
        <div id="actionsBox" class="actionsBox">
            <div id="actionsBoxMenu" class="menu">
                <span id="cntBoxMenu">0</span>
                <a class="button box_action">Archive</a>
                <a class="button box_action">Delete</a>
                <a id="toggleBoxMenu" class="open"></a>
                <a id="closeBoxMenu" class="button t_close">X</a>
            </div>
            <div class="submenu">
                <a class="first box_action">Move...</a>
                <a class="box_action">Mark as read</a>
                <a class="box_action">Mark as unread</a>
                <a class="last box_action">Spam</a>
            </div>
        </div>
        <?php
        $this->load->view('admin/templates/sidebar.php');
        ?>
        <div id="container">
            <div id="header" class="gary_lin">
                <div class="header_left">
                    <div class="logo">
                        <img src="images/logo/<?php echo $logo; ?>" alt="<?php echo $siteTitle; ?>" height="51px" title="<?php echo $siteTitle; ?>">
                    </div>
                    <div id="responsive_mnu">
                        <a href="#responsive_menu" class="fg-button" id="hierarchybreadcrumb"><span class="responsive_icon"></span>Menu</a>
                        <div id="responsive_menu" class="hidden">
                            <ul id="sidenav" class="accordion_mnu collapsible">

                                <li><a href="<?php echo base_url(); ?>admin/dashboard/admin_dashboard" <?php
                                    if ($currentUrl == 'dashboard') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="nav_icon computer_imac"></span> Dashboard</a></li>
                                <li><h6 style="margin: 10px 0;padding-left:40px;font-weight:normal;color:#0D68AF;">Managements</h6></li>

                                    <?php extract($privileges);
                                    if ($allPrev == '1') {
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

                                    <?php } if ((isset($user) && is_array($user)) && in_array('0', $user) || $allPrev == '1') { ?>
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

                                            <?php } if ((isset($renter) && is_array($renter)) && in_array('0', $renter) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
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
                                            <!--<li><a href="admin/seller/display_seller_requests" <?php
                                            if ($currentPage == 'display_seller_requests') {
                                                echo 'class="active"';
                                            }
                                            ?>><span class="list-icon">&nbsp;</span>Seller Requests</a></li>
                                            <li><a href="admin/commission/display_commission_lists" <?php
                                        if ($currentPage == 'display_commission_lists') {
                                            echo 'class="active"';
                                        }
                                        ?>><span class="list-icon">&nbsp;</span>Commission Tracking</a></li>-->
                                        </ul>
                                    </li>

                                        <?php } if ((isset($rental) && is_array($rental)) && in_array('0', $rental) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
                                        if ($currentUrl == 'product' || $currentUrl == 'comments') {
                                            echo 'class="active"';
                                        }
                                            ?>><span class="nav_icon folder"></span> Rentals<span class="up_down_arrow">&nbsp;</span></a>
                                        <ul class="acitem" <?php
                                                if ($currentUrl == 'product' || $currentUrl == 'comments') {
                                                    echo 'style="display: block;"';
                                                } else {
                                                    echo 'style="display: none;"';
                                                }
                                                ?>>


                                            <li><a href="admin/product/display_rental_dashboard" <?php
                                    if ($currentPage == 'display_rental_dashboard') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Dashboard</a></li>


                                            <li><a href="admin/product/display_product_list" <?php
                                    if ($currentPage == 'display_product_list') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="list-icon">&nbsp;</span>Rentals List</a></li>
                                            <!--<li><a href="admin/product/display_user_product_list" <?php
                                if ($currentPage == 'display_user_product_list') {
                                    echo 'class="active"';
                                }
                                    ?>><span class="list-icon">&nbsp;</span>Affiliate Rental List</a></li>
                        <li><a href="admin/comments/view_product_comments" <?php
                                if ($currentPage == 'view_product_comments') {
                                    echo 'class="active"';
                                }
                                    ?>><span class="list-icon">&nbsp;</span>Rental Comments List</a></li>-->
                                    <?php if ($allPrev == '1' || in_array('1', $rental)) { ?>
                                                <li><a href="admin/product/add_product_form" <?php
                                        if ($currentPage == 'add_product_form') {
                                            echo 'class="active"';
                                        }
                                        ?>><span class="list-icon">&nbsp;</span>Add New Rental</a></li>
                                    <?php } ?>
                                        </ul>
                                    </li>


                                <?php } if ((isset($membership) && is_array($membership)) && in_array('0', $membership) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
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
                                            <!--<li><a href="admin/membership/membership_list" <?php
                                                if ($currentPage == 'membership_list') {
                                                    echo 'class="active"';
                                                }
                                                ?>><span class="list-icon">&nbsp;</span>Subscribed Members</a></li>-->
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
                                    </li>


                                    <!--<?php } if ((isset($rate_package) && is_array($rate_package)) && in_array('0', $rate_package) || $allPrev == '1') { ?>
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
                                  
                                            <?php }if ((isset($paygateway) && is_array($paygateway)) && in_array('0', $paygateway) || $allPrev == '1') {
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


                                <?php } if ((isset($contact) && is_array($contact)) && in_array('0', $contact) || $allPrev == '1') { ?>

                                    <li><a href="#" <?php
                                           if ($currentUrl == 'contact' || $this->uri->segment(1, 0) == 'contact-review') {
                                               echo 'class="active"';
                                           }
                                           ?>><span class="nav_icon money_2"></span> Contact Owners <span class="up_down_arrow">&nbsp;</span></a>
                                        <ul class="acitem" <?php
                                            if ($currentUrl == 'contact' || $this->uri->segment(1, 0) == 'order-review') {
                                                echo 'style="display: block;"';
                                            } else {
                                                echo 'style="display: none;"';
                                            }
                                            ?>>
                                            <li><a href="admin/contact/display_contact_dashboard" <?php
                                            if ($currentPage == 'display_contact_dashboard') {
                                                echo 'class="active"';
                                            }
                                            ?>><span class="list-icon">&nbsp;</span>Dashboard </a></li>
                                            <li><a href="admin/contact/display_contact_list" <?php
                                            if ($currentPage == 'display_contact_list') {
                                                echo 'class="active"';
                                            }
                                            ?>><span class="list-icon">&nbsp;</span>Contact List </a></li>
                                        </ul>
                                    </li>

<?php } if ((isset($attribute) && is_array($attribute)) && in_array('0', $attribute) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
    if ($currentUrl == 'attribute') {
        echo 'class="active"';
    }
    ?>><span class="nav_icon cog_3"></span> List<span class="up_down_arrow">&nbsp;</span></a>
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
                                                ?>><span class="list-icon">&nbsp;</span>Lists</a></li>
                                            <li><a href="admin/attribute/display_list_values" <?php
                                                   if ($currentPage == 'display_list_values') {
                                                       echo 'class="active"';
                                                   }
                                                   ?>><span class="list-icon">&nbsp;</span>List Values</a></li>
                                                   <?php if ($allPrev == '1' || in_array('1', $attribute)) { ?>
                                                <li><a href="admin/attribute/add_attribute_form" <?php
                                               if ($currentPage == 'add_attribute_form') {
                                                   echo 'class="active"';
                                               }
                                               ?>><span class="list-icon">&nbsp;</span>Add New List</a></li>
                                                <li><a href="admin/attribute/add_list_value_form" <?php
                                               if ($currentPage == 'add_list_value_form') {
                                                   echo 'class="active"';
                                               }
                                                       ?>><span class="list-icon">&nbsp;</span>Add List Value</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>


                                            <?php } if ((isset($productattribute) && is_array($productattribute)) && in_array('0', $productattribute) || $allPrev == '1') { ?>
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
                                                <?php if ($allPrev == '1' || in_array('1', $productattribute)) { ?>
                                                <li><a href="admin/productattribute/add_product_attribute_form" <?php
                                                       if ($currentPage == 'add_product_attribute_form') {
                                                           echo 'class="active"';
                                                       }
                                                       ?>><span class="list-icon">&nbsp;</span>Add Property Type</a></li>
    <?php } ?>
                                        </ul>
                                    </li>

                                <?php } if ((isset($newsletter) && is_array($newsletter)) && in_array('0', $newsletter) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
                                    if ($currentUrl == 'newsletter') {
                                        echo 'class="active"';
                                    }
                                    ?>><span class="nav_icon mail"></span> Newsletter Template<span class="up_down_arrow">&nbsp;</span></a>
                                        <ul class="acitem" <?php
                                    if ($currentUrl == 'newsletter') {
                                        echo 'style="display: block;"';
                                    } else {
                                        echo 'style="display: none;"';
                                    }
                                    ?>>
                                            <li><a href="admin/newsletter/display_subscribers_list" <?php
                                if ($currentPage == 'display_subscribers_list') {
                                    echo 'class="active"';
                                }
                                    ?>><span class="list-icon">&nbsp;</span>Subscription List</a></li>
                                        <?php if ($allPrev == '1' || in_array('1', $newsletter)) { ?>
                                                <li><a href="admin/newsletter/display_newsletter" <?php
                                            if ($currentPage == 'display_newsletter') {
                                                echo 'class="active"';
                                            }
                                            ?>><span class="list-icon">&nbsp;</span>Email Template List</a></li>
                                                <li><a href="admin/newsletter/add_newsletter" <?php
                                                       if ($currentPage == 'add_newsletter') {
                                                           echo 'class="active"';
                                                       }
                                                       ?>><span class="list-icon">&nbsp;</span>Add Email Template</a></li>
                                    <?php } ?>
                                        </ul>
                                    </li>

                <?php } if ((isset($location) && is_array($location)) && in_array('0', $location) || $allPrev == '1') { ?>
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

            <?php } if ((isset($cms) && is_array($cms)) && in_array('0', $cms) || $allPrev == '1') { ?>
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
    <?php if ($allPrev == '1' || in_array('1', $cms)) { ?>
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
<?php } if ((isset($city) && is_array($city)) && in_array('0', $city) || $allPrev == '1') { ?>
                                    <li><a href="#" <?php
    if ($currentUrl == 'city') {
        echo 'class="active"';
    }
    ?>><span class="nav_icon record"></span> City Management<span class="up_down_arrow">&nbsp;</span></a>
                                        <ul class="acitem" <?php
    if ($currentUrl == 'city') {
        echo 'style="display: block;"';
    } else {
        echo 'style="display: none;"';
    }
    ?>>
                                            <li><a href="admin/city/display_city_list" <?php
    if ($currentPage == 'display_city_list') {
        echo 'class="active"';
    }
    ?>><span class="list-icon">&nbsp;</span>City List</a></li>
    <?php if ($allPrev == '1' || in_array('1', $city)) { ?>
                                                <li><a href="admin/city/add_city_form" <?php
        if ($currentPage == 'add_city_form') {
            echo 'class="active"';
        }
        ?>><span class="list-icon">&nbsp;</span>Add City</a></li>
    <?php } ?>
                                        </ul>
                                    </li>
<?php } /* <?php 
  if ((isset($multilang) && is_array($multilang)) && in_array('0', $multilang) || $allPrev == '1'){ ?>

  <li><a href="admin/multilanguage" <?php if($currentUrl=='multilanguage'){ echo 'class="active"';} ?>><span class="nav_icon cog_3"></span> Language Management</a></li><?php }?> */ ?>
                                <li><a href="#" <?php
if ($currentUrl == 'slider' || $currentUrl == 'comments') {
    echo 'class="active"';
}
?>><span class="nav_icon folder"></span> Slider<span class="up_down_arrow">&nbsp;</span></a>
                                    <ul class="acitem" <?php
if ($currentUrl == 'slider' || $currentUrl == 'comments') {
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
                                        <li><a href="admin/slider/add_slider_form" <?php
if ($currentPage == 'add_slider_form') {
    echo 'class="active"';
}
?>><span class="list-icon">&nbsp;</span>Add New Slider</a></li>
                                    </ul>
                                </li>


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
<?php if ((isset($testimonials) && is_array($testimonials)) && in_array('0', $testimonials) || $allPrev == '1') { ?>

                                    <li><a href="#" <?php
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
                                    </li> 
<?php } ?>   
                            </ul>
                        </div>
                    </div>
                </div>
<?php
extract($privileges);
?>
                <div class="header_right">
                    <div id="user_nav" <?php if ($allPrev != '1') { ?>style="width: 250px;"<?php } ?>>
                        <ul>
                            <li class="user_thumb"><span class="icon"><img src="images/user_thumb.png" width="30" height="30" alt="User"></span></li>
                            <li class="user_info">
                                <span class="user_name">Administrator</span>
<?php if ($allPrev == '1') { ?>
                                    <span>
                                        <a href="<?php echo base_url(); ?>" target="_blank" class="tipBot" title="View Site">Visit Site</a> &#124; 
                                        <a href="admin/adminlogin/admin_global_settings_form" class="tipBot" title="Edit account details">Settings</a>
                                    </span>
<?php } else { ?>
                                    <span>
                                        <a href="<?php echo base_url(); ?>" target="_blank" class="tipBot" title="View Site">Visit Site</a> &#124; 
                                        <a href="admin/adminlogin/change_admin_password_form" class="tipBot" title="Click to change your password">Change Password</a> 
                                    </span>
<?php } ?>
                            </li>
                            <li class="logout"><a href="admin/adminlogin/admin_logout" class="tipBot" title="Logout"><span class="icon"></span>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="page_title">
                <span class="title_icon"><span class="computer_imac"></span></span>
                <h3><?php echo $heading; ?></h3>
                <!-- 
                <div class="top_search">
                        <form action="#" method="post">
                                <ul id="search_box">
                                        <li>
                                        <input name="" type="text" class="search_input" id="suggest1" placeholder="Search...">
                                        </li>
                                        <li>
                                        <input name="" type="submit" value="" class="search_btn">
                                        </li>
                                </ul>
                        </form>
                </div>
                -->
            </div>
<?php if (validation_errors() != '') { ?>
                <div id="validationErr">
                    <script>setTimeout("hideErrDiv('validationErr')", 3000);</script>
                    <p><?php echo validation_errors(); ?></p>
                </div>
<?php } ?>
<?php if ($flash_data != '') { ?>
                <div class="errorContainer" id="<?php echo $flash_data_type; ?>">
                    <script>setTimeout("hideErrDiv('<?php echo $flash_data_type; ?>')", 3000);</script>
                    <p><span><?php echo $flash_data; ?></span></p>
                </div>
<?php } ?>
            <!-- Preloader -->
            <script type="text/javascript">// <![CDATA[
                $(window).load(function () {
                    $("#spinner").fadeOut("slow");
                })
                // ]]></script>
            <!-- Preloader -->
            <div id="spinner"></div>