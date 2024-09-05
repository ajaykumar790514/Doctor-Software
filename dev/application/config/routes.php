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
$route['default_controller']   = 'dashboard';
$route['404_override'] 			 = 'pagenotfound';
$route['translate_uri_dashes'] = FALSE;

$route['test/(:any)']			= 'main/test/$1';
$route['admin-login']			= 'login/index/admin';

$route['dashboard_content'] 	 = 'dashboard/dashboard_content';
$route['host_dashboard_content'] = 'dashboard/host_dashboard_content';






// Start :: Masters
$route['category'] 		       		= 'masters/categories';
$route['category/(:any)'] 		    = 'masters/categories/$1';
$route['category/(:any)/(:num)'] 	= 'masters/categories/$1/$2';

$route['medicines'] 		       	= 'masters/medicines';
$route['medicines/(:any)'] 		    = 'masters/medicines/$1';
$route['medicines/(:any)/(:num)'] 	= 'masters/medicines/$1/$2';

$route['clinics'] 		       		= 'masters/clinics';
$route['clinics/(:any)'] 		    = 'masters/clinics/$1';
$route['clinics/(:any)/(:num)'] 	= 'masters/clinics/$1/$2';

$route['patients'] 		       		= 'masters/patients';
$route['patients/(:any)'] 		    = 'masters/patients/$1';
$route['patients/(:any)/(:num)'] 	= 'masters/patients/$1/$2';

$route['unit-master'] 		       		= 'masters/unit_master';
$route['unit-master/(:any)'] 		    = 'masters/unit_master/$1';
$route['unit-master/(:any)/(:num)'] 	= 'masters/unit_master/$1/$2';

$route['general-settings'] 		       		= 'masters/general_settings';
$route['general-settings/(:any)'] 		    = 'masters/general_settings/$1';
$route['general-settings/(:any)/(:num)'] 	= 'masters/general_settings/$1/$2';
// End :: Masters


// Start:: Profile
$route['profile']		        	= 'profile/index';
$route['profile/(:any)']			= 'profile/index/$1';
// End:: Profile

$route['inventory']					= 'inventory/index';
$route['inventory/(:any)']			= 'inventory/index/$1';
$route['inventory/(:any)/(:num)']	= 'inventory/index/$1/$2';

$route['appointments']					= 'appointments/index';
$route['appointments/(:any)']			= 'appointments/index/$1';
$route['appointments/(:any)/(:num)']	= 'appointments/index/$1/$2';

$route['reports/prescription']					= 'reports/prescription';
$route['reports/prescription/(:any)']			= 'reports/prescription/$1';
$route['reports/prescription/(:any)/(:num)']	= 'reports/prescription/$1/$2';


// $route['template-details/(:num)']           = 'notifications/template_details/$1';
// End::notification

$route['getStates']        					 = 'main/getStates';
$route['getStates/(:num)']        			 = 'main/getStates/$1';
$route['getStates/(:num)/(:num)'] 			 = 'main/getStates/$1/$2';
$route['getCities']        			 		 = 'main/get_cities';
$route['getCities/(:num)']        			 = 'main/get_cities/$1';
$route['getCities/(:num)/(:num)'] 			 = 'main/get_cities/$1/$2';

$route['sub_categories']				= 'main/sub_categories';
$route['sub_categories/(:num)']			= 'main/sub_categories/$1';

$route['getProducts']					= 'main/getProducts';
$route['getProducts/(:num)']			= 'main/getProducts/$1';
$route['getProducts/(:num)/(:num)']		= 'main/getProducts/$1/$2';

$route['getStock/(:num)']				= 'main/product_stock/$1';
$route['getStock/(:num)/(:num)']		= 'main/product_stock/$1/$2';


$route['changeStatus']         		= 'main/changeStatus';
$route['changeVisibility']         	= 'main/changeStatus';
$route['changeStatus/(:any)']  		= 'main/changeStatus/$1';
$route['changeVisibility/(:any)']  	= 'main/changeStatus/$1';

$route['check-duplicate/(:any)/(:any)'] 		= 'main/check_duplicate/$1/$2';
$route['check-duplicate/(:any)/(:any)/(:any)'] 	= 'main/check_duplicate/$1/$2/$3';


$route['changeStatusDispaly']  = 'main/changeStatusDispaly';
$route['change_status']        = 'main/change_status';
$route['changeIndexing']       = 'main/changeIndexing';
$route['title/(:any)/(:num)']  = 'main/title/$1/$2';
$route['logout'] 	           = 'login/logout';
