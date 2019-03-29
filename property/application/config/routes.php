<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "site/landing";
$route['404_override'] = '';
$route['login'] = "site/user/signin_form";
$route['admin'] = "";
$route['admin_ror'] = "admin/adminlogin";

$route['pages/signup-content'] = "site/user/signup_form";
$route['signup'] = "site/user/signup_form";
$route['signin'] = "site/user/signin_form";
$route['owner'] = "site/user/seller_signup_form";
$route['owner_signin'] = "site/user/seller_signin_form";
$route['dashboard'] = "site/user/dashboard";
$route['forgot-password'] = "site/user/forgot_password_form";
$route['signout'] = "site/user/logout_user";
$route['city/(:any)'] = 'site/product/index/$1';
$route['state/(:any)'] = 'site/product/StateRentalView/$1';
$route['browse_all'] = 'site/product/BrowseAll';
$route['search/search_text'] = 'site/product/search_text';
$route['search/search_general'] = 'site/product/general_search';
$route['rental/(:any)/write_review'] = 'site/product/write_review/$1';
$route['rental/(:any)'] = 'site/product/display_product_detail/$1';
$route['view_inquiries'] = 'site/contact/display_inquiries_detail';
$route['view_reviews'] = 'site/product/display_review_detail';
$route['view_inquiry_details/(:any)'] = 'site/contact/view_inquiry_details/$1';
$route['dashboard/admin_settings'] = 'site/contact/admin_settings';
$route['testimonial'] = 'site/product/testimonial';
$route['list_your_property'] = 'site/user/list_property';
$route['add_rental'] = 'site/owner/add_rental_form';
$route['edit_rental/(:any)'] = 'site/owner/edit_rental_form/$1';
$route['payment_details/(:any)'] = 'site/user/payment_details_form';
$route['display_rentals_list'] = 'site/owner/rentals_details_form';
$route['mapview/(:any)'] = "site/product/mapview/$1";
$route['send-confirm-mail'] = "site/user/send_quick_register_mail";
$route['(:any)/write_review'] = "site/product/write_review";
$route['(:any)/write_review_one'] = "site/product/write_review1";
$route['matt'] = "site/product/matt";
$route['view_user'] = "site/user/view_user_details";
$route['cont_page'] = "site/user/continue_page";
$route['user_owner/(:any)/(:any)'] = "site/user/user_cum_owner/$1/$1";
$route['user_profile/(:any)'] = "site/user/display_user_profilddde/$1";
$route['my_account'] = "site/user/display_user_profile";
$route['displaysign/(:any)'] = "site/user/display_signaturepad/$1";
$route['viewagreement/(:any)'] = "site/user/viewagreement/$1";
$route['previewagreement/(:any)'] = "site/user/previewagreement/$1";
$route['confirmagreement/(:any)'] = "site/user/confirmagreement/$1";
$route['confirm-signature/(:any)'] = "site/user/confirmagreement/$1";
$route['signed-agreement/(:any)'] = "site/user/signedagreement/$1";
$route['viewconfirmation/(:any)'] = "site/user/viewconfirmation/$1";

$route['pages/(:any)'] = "site/cms";
$route['contact'] = "site/cms/contact_view";
$route['Property/(:any)'] = "site/product/display_product_detail/$1";
$route['listing'] = "site/product/display_all_product";
$route['featured_proptery'] = "site/landing/featured_proptery";
$route['soldlisting'] = "site/product/display_all_sold_proptery_nonclickable";
$route['soldlisting/(:any)'] = "site/product/display_all_sold_proptery_limit/$1";
$route['reservation/(:any)'] = "site/product/reservation_form/$1";
$route['reservation-continue/(:any)'] = "site/product/reservation_cont/$1";
$route['view_orders/(:any)'] = "site/user/view_orders/$1";
$route['reservation_conform/(:any)'] = "site/user/reservation_conform/$1";
$route['listing/(:any)'] = "site/product/Get_All_Property_List_page1/$1/$2";

$route['brochure/(:any)'] = "site/product/brochure_form/$1";

//Deals CRM Admin Routeslisting
$route['deals_crm'] = "crmadmin/adminlogin";



//cms section start here
$route['site/cms/news']='site/cms/news';
//cms section end here


//arms code start here
$route['seating_chart']="admin/seatingchart/seating_chart";
//arms code end here
/* End of file routes.php */
/* Location: ./application/config/routes.php */