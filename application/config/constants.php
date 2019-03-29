<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Table Constants
  |--------------------------------------------------------------------------
  |
 */
define('TBL_PREF', 'fc_');

define('ADMIN', TBL_PREF . 'admin');
define('ADMIN_SETTINGS', TBL_PREF . 'admin_settings');
define('ADMIN_SETTINGS_PR', TBL_PREF . 'pr_admin_settings');
define('SUBADMIN', TBL_PREF . 'subadmin');
define('USERS', TBL_PREF . 'users');
define('CATEGORY', TBL_PREF . 'category');
define('COUPONCARDS', TBL_PREF . 'couponcards');
define('GIFTCARDS', TBL_PREF . 'giftcards');
define('GIFTCARDS_SETTINGS', TBL_PREF . 'giftcards_settings');
define('GIFTCARDS_TEMP', TBL_PREF . 'giftcards_temp');
define('SUBSCRIBERS_LIST', TBL_PREF . 'subscribers_list');
define('NEWSLETTER', TBL_PREF . 'newsletter');
define('CMS', TBL_PREF . 'cms');
define('REVIEW', TBL_PREF . 'review');
define('PRODUCT', TBL_PREF . 'product');
define('PRODUCT_CATEGORY', TBL_PREF . 'product_category');
define('LOCATIONS', TBL_PREF . 'country');
define('PAYMENT_GATEWAY', TBL_PREF . 'payment_gateway');
define('STATE_TAX', TBL_PREF . 'states');
define('CITY', TBL_PREF . 'cities');
define('ATTRIBUTE', TBL_PREF . 'attribute');
define('PRODUCT_LIKES', TBL_PREF . 'product_likes');
define('PRODUCT_ADDRESS', TBL_PREF . 'product_address');
define('PRODUCT_FEATURES', TBL_PREF . 'product_features');
define('PRODUCT_BOOKING', TBL_PREF . 'product_booking');
define('PRODUCT_RATE_PACKAGE', TBL_PREF . 'rate_package');
define('PRODUCT_PACKAGES', TBL_PREF . 'product_package_rate');
define('PRODUCT_PHOTOS', TBL_PREF . 'rental_photos');
define('CONTACT', TBL_PREF . 'contactus');
define('TESTIMONIALS', TBL_PREF . 'testimonials');
define('LANGUAGES', TBL_PREF . 'languages');
define('SHOPPING_CART', TBL_PREF . 'shopping_carts');
define('PAYMENT', TBL_PREF . 'payment');
define('SHIPPING_ADDRESS', TBL_PREF . 'shipping_address');
define('COUNTRY_LIST', TBL_PREF . 'country');
define('USER_ACTIVITY', TBL_PREF . 'user_activity');
define('LISTS_DETAILS', TBL_PREF . 'lists');
define('WANTS_DETAILS', TBL_PREF . 'wants');
define('LIST_VALUES', TBL_PREF . 'list_values');
define('FANCYYBOX', TBL_PREF . 'fancybox');
define('FANCYYBOX_TEMP', TBL_PREF . 'fancybox_temp');
define('FANCYYBOX_USES', TBL_PREF . 'fancybox_uses');
define('USER_PRODUCTS', TBL_PREF . 'user_product');
define('PRODUCT_COMMENTS', TBL_PREF . 'product_comments');
define('NOTIFICATIONS', TBL_PREF . 'notifications');
define('VENDOR_PAYMENT', TBL_PREF . 'vendor_payment_table');
define('REVIEW_COMMENTS', TBL_PREF . 'review_comments');
define('BANNER_CATEGORY', TBL_PREF . 'banner_category');
define('PRODUCT_ATTRIBUTE', TBL_PREF . 'product_attribute');
define('SUBPRODUCT', TBL_PREF . 'subproducts');
define('TRANSACTIONS', TBL_PREF . 'transaction');
define('SLIDER', TBL_PREF . 'slider');
define('VIDEO', TBL_PREF . 'video');
define('REPLIES', TBL_PREF . 'replies');
define('CANCELLED', TBL_PREF . 'property_cancelled');
define('SWAPPED', TBL_PREF . 'property_swapped');
define('RESERVED_INFO', TBL_PREF . 'property_reserved_info');
define('PRODUCT_SUBATTRIBUTE', TBL_PREF . 'subattribute');
define('SOURCE_INFO', TBL_PREF . 'source_info');
define('SOURCER_INFO', TBL_PREF . 'property_source_info');
define('MANAGER_INFO', TBL_PREF . 'property_manager_info');
define('SEATING_CHART', TBL_PREF . 'seating_chart');
define('SEATING_CLIENT', TBL_PREF . 'seating_client');
define('SEATING_INITIALS', TBL_PREF . 'seating_initials');
define('BROCHURE', TBL_PREF . 'brochure');
define('news',TBL_PREF.'news');
define('SCHEDULE', 'schedule');
define('CALENDARBOOKING', 'bookings');
define('CITY_NEW', 'cities_extended');
define('NOTES', 'notes');
define('ADMINNOTES', 'notes_client');
define('NOTESIMAGE', 'notes_image');
define('STATUS', 'popup_status');
define('SIGNTEMPLATE', 'sign_templates');
define('SIGNUPLOAD', 'sign_upload');

define('RENTALCOMPS', TBL_PREF . 'rental_comps');
define('ALERT', TBL_PREF . 'property_alert');


/*
  |--------------------------------------------------------------------------
  | Path Constants
  |--------------------------------------------------------------------------
  |
 */

define('CATEGORY_PATH', 'images/category/');
define('GIFTPATH', 'images/giftcards/');
define('PRODUCTPATH', 'images/product/');
define('FANCYBOXPATH', 'images/fancyybox/');
define('PLUGIN_PATH', 'plugin/');
//define('SITE_COMMON_DEFINE', 'fancyy-');

/* End of file constants.php */
/* Location: ./application/config/constants.php */