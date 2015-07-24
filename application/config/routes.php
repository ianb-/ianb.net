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
|	http://codeigniter.com/user_guide/general/routing.html
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

//Games
$route['games/compare_csgo'] = 'games/compare_csgo';
$route['games/compare_tf2'] = 'games/compare_tf2';
$route['games/compare_l4d2'] = 'games/compare_l4d2';
$route['games/get_csgo_stats'] = 'games/get_csgo_stats';
$route['games/get_tf2_stats'] = 'games/get_tf2_stats';
$route['games/get_l4d2_stats'] = 'games/get_l4d2_stats';
$route['games/get_steam_status'] = 'games/get_steam_status';
$route['games/csgo'] = 'games/csgo';
$route['games/tf2'] = 'games/tf2';
$route['games/l4d2'] = 'games/l4d2';
$route['games'] = 'games/index';
//Blog
$route['blog/archive'] = 'blogs/archive';
$route['blog/(:any)'] = 'blogs/view/$1';
$route['blog'] = 'blogs/index';
//Music
$route['music/get_recent_music'] = 'music/get_recent_music';
$route['music/albums_month'] = 'music/albums_month';
$route['music'] = 'music/index';
//About
$route['about'] = 'home/about';
$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
