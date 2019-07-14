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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['setup']  					                = 'setup/setup';
$route['setup/install']  					        = 'setup/setup/install';

$route['root']  					                = 'root/root';
$route['root/home']  					            = 'root/root/list';


$route['root/listar']              	        = 'root/root/list';
$route['root/cadastrar']                     = 'root/root/create';
$route['root/blocker/:num']                  = 'root/root/blocker';
$route['root/editar/:num']                     = 'root/root/edit';
$route['root/meuperfil']                     = 'root/root/myprofile';



$route['login']              	        = 'login/login';
$route['logout']              	        = 'login/logout';



// # =================================== ADMIN =================================== 
// $route['admin/login']						        = 'admin/admin/login';
// $route['admin/template']     			            = 'admin/template';
// $route['admin/template2']     			            = 'admin/template/template2';
// $route['admin']     			    	            = 'admin/admin';
// $route['admin/home']			    	            = 'admin/admin/home';
// $route['logout']              				        = 'admin/admin/logout';

// $route['admin/users/listar']              	        = 'admin/users/list';
// $route['admin/users/cadastrar']                     = 'admin/users/create';
// $route['admin/users/blocker/:num']                  = 'admin/users/blocker';
// $route['admin/users/edit/:num']                     = 'admin/users/edit';
// $route['admin/users/meuperfil']                     = 'admin/users/myprofile';

// $route['admin/casamentos']                          = 'admin/casamentos';
// $route['admin/casamentos/listar']                   = 'admin/casamentos/list';
// $route['admin/casamentos/cadastrar']                = 'admin/casamentos/create';
// $route['admin/casamentos/editar/:num']              = 'admin/casamentos/edit';

// $route['admin/news']              	                = 'admin/news/list';
// $route['admin/news/listar']              	        = 'admin/news/list';
// $route['admin/news/cadastrar']                      = 'admin/news/create';
// $route['admin/news/blocker/:num']                   = 'admin/news/blocker';
// $route['admin/news/editar/:num']                    = 'admin/news/edit';

// $route['admin/blog']              	                = 'admin/blog/list';
// $route['admin/blog/listar']              	        = 'admin/blog/list';
// $route['admin/blog/cadastrar']                      = 'admin/blog/create';
// $route['admin/blog/blocker/:num']                   = 'admin/blog/blocker';
// $route['admin/blog/editar/:num']                    = 'admin/blog/edit';

// $route['admin/config/analytics']                    = 'admin/portalconfigs/analytics';

// $route['cadastrar']						            = 'dashboard/dashboard/cadastrar';
// $route['admin/perfil']			    	            = 'dashboard/dashboard/perfil';
// $route['admin/artigo']			    	            = 'dashboard/dashboard/perfil';
// $route['admin/evento']			    	            = 'dashboard/dashboard/perfil';
// $route['admin/minicurs']			                = 'dashboard/dashboard/perfil';


// # =================================== ADMIN =================================== 

// $route['']                         = 'casamentos/home';
// $route['listar']                   = 'casamentos/list';
// $route['cadastrar']                = 'casamentos/create';
// $route['editar/:num']              = 'casamentos/edit';
