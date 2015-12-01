<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = 'main';
$route['user'] = "user/login";

$route['user/dashboard/viewMessage_by_id/(:any)'] = "user/dashboard/viewMessage_by_id/$1";
$route['user/dashboard/(:any)'] = "user/dashboard/index/$1";

$route['user/user/add'] = "user/user/add";
$route['user/user/update/(:any)'] = "user/user/update/$1";
$route['user/user/edit/(:any)/(:any)'] = "user/user/edit/$1/$2";
$route['user/user/delete'] = "user/user/delete";
$route['user/user/chk_email'] = "user/user/chk_email";
$route['user/user/(:any)'] = "user/user/index/$1";

$route['user/device/add'] = "user/device/add";
$route['user/device/view/(:any)'] = "user/device/view/$1";
$route['user/device/edit/(:any)/(:any)'] = "user/device/edit/$1/$2";
$route['user/device/update/(:any)'] = "user/device/update/$1";
$route['user/device/delete'] = "user/device/delete";
$route['user/device/(:any)'] = "user/device/index/$1";

$route['user/company/add'] = "user/company/add";
$route['user/company/edit/(:any)'] = "user/company/edit/$1";
$route['user/company/update'] = "user/company/update";
$route['user/company/delete'] = "user/company/delete";
$route['user/company/(:any)'] = "user/company/index/$1";

$route['user/sim_card/add'] = "user/sim_card/add";
$route['user/sim_card/edit/(:any)'] = "user/sim_card/edit/$1";
$route['user/sim_card/update'] = "user/sim_card/update";
$route['user/sim_card/delete'] = "user/sim_card/delete";
$route['user/sim_card/(:any)'] = "user/sim_card/index/$1";

$route['user/message/test'] = "user/message/test";
$route['user/message/add'] = "user/message/add";
$route['user/message/inbox'] = "user/message/inbox";
$route['user/message/sentbox'] = "user/message/sentbox";
$route['user/message/create'] = "user/message/create";
$route['user/message/remove'] = "user/message/remove";
$route['user/message/viewMessage_by_id/(:any)/(:any)'] = "user/message/viewMessage_by_id/$1/$2";
$route['user/message/viewMessage_by_id_sentbox/(:any)/(:any)'] = "user/message/viewMessage_by_id_sentbox/$1/$2";
$route['user/message/sentbox/(:any)'] = "user/message/sentbox/$1";
$route['user/message/(:any)'] = "user/message/index/$1";

$route['user/model/add'] = "user/model/add";
$route['user/model/edit/(:any)'] = "user/model/edit/$1";
$route['user/model/update'] = "user/model/update";
$route['user/model/delete'] = "user/model/delete";
$route['user/model/(:any)'] = "user/model/index/$1";

$route['404_override'] = '';



/* End of file routes.php */
/* Location: ./application/config/routes.php */