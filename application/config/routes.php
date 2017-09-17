<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller']="login";
$route['404_override'] = '';
//$route['contents/(:any)'] = "sub_pages/index/$1";
//$route['about-mena-u'] = "about_us";
//$route['terms-of-use']="Terms_of_use";
//$route['cookie-policy']="Cookie_policy";
//$route['privacy-statement']="Privacy_statement";
//$route['register-user']="Register_user";
//$route['about-us']="About_us";
//$route['upcoming-events']="upcoming_events";
//$route['upcoming-events/(:any)'] = "upcoming_events/upcoming_events_detail/$1";
//$route['latest-news']="latest_news";
//$route['latest-news/(:any)'] = "latest_news/latest_news_detail/$1";
//$route['school/get_faq_answer'] = "school/get_faq_answer";
//$route['school/(:any)'] = "school/school_detail/$1";
//$route['our-program/(:any)'] = "our_program/our_program_detail/$1";
//$route['register']="register_user";
//$route['forgot-password']="forgot_password";
//$route['partners']="partner";
//$route['admissions/(:any)'] = "admissions/admission_detail/$1";
//$route['about-mena-u/(:any)'] = "about_us/about_detail/$1";
//$route['message-board'] = "message_board/get_direct_message_board/";
//$route['message-board/(:any)/(:any)']="message_board/index/$1/$2";
//
//$route['people']="People";
//$route['governance/(:any)'] = "governance/governance_detail/$1";
//$route['faqs/(:any)'] = "faqs/index/$1";
//$route['application-form']="application_form";




$route['translate_uri_dashes'] = FALSE;
