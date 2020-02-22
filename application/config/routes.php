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

/*backend routes*/
$route['admin/login'] = 'backend/Auth/login';
$route['admin/logout']="backend/Auth/logout";
$route['admin/index'] = 'backend/Admin/index';
$route['admin/404']="backend/Admin/error404";

$route['admin/messages'] = 'backend/Message/index';
$route['admin/message/delete/(:any)']="backend/Message/delete/$1";

$route['admin/quotations'] = 'backend/Quotation/index';
$route['admin/quotation/delete/(:any)']="backend/Quotation/delete/$1";

$route['admin/subscriptions'] = 'backend/Subscription/index';

$route['admin/customers'] = 'backend/Customer/index';

$route['admin/engineers'] = 'backend/Engineer/index';
$route['admin/engineer/update/(:any)'] = 'backend/Engineer/update/$1';
$route['admin/engineer/delete/(:any)'] = 'backend/Engineer/delete/$1';
$route['admin/hired-engineers']= 'backend/Engineer/hired';


$route['admin/sales-consultants'] = 'backend/Sale/index';
$route['admin/sellers'] = 'backend/Seller/index';
$route['admin/logistics-service-providers'] = 'backend/Logistics/index';

$route['admin/orders'] = 'backend/Order/index';
$route['admin/order/view/(:any)'] = 'backend/Order/view/$1';
$route['admin/order/confirm/(:any)'] = 'backend/Order/confirm/$1';
$route['admin/order/payment/(:any)'] = 'backend/Order/payment/$1';
$route['admin/order/received/(:any)'] = 'backend/Order/received/$1';
$route['admin/order/paid/(:any)'] = 'backend/Order/paid/$1';

$route['admin/register'] = 'backend/User/registration';
$route['admin/profile'] = 'backend/User/index';
$route['admin/users'] = 'backend/User/users';
$route['admin/profile/edit'] = 'backend/User/edit';

$route['admin/product/add'] = 'backend/Product/add';
$route['admin/products'] = 'backend/Product/index';
$route['admin/product/(:any)'] = 'backend/Product/edit/$1';
$route['admin/product/delete/(:any)']="backend/Product/delete/$1";

$route['admin/category/add'] = 'backend/Category/add';
$route['admin/categories'] = 'backend/Category/index';
$route['admin/category/(:any)'] = 'backend/Category/edit/$1';
$route['admin/category/delete/(:any)']="backend/Category/delete/$1";

$route['admin/brand/add'] = 'backend/Brand/add';
$route['admin/brands'] = 'backend/Brand/index';
$route['admin/brand/(:any)'] = 'backend/Brand/edit/$1';
$route['admin/brand/delete/(:any)']="backend/Brand/delete/$1";

$route['admin/subcategory/add'] = 'backend/Subcategory/add';
$route['admin/subcategories'] = 'backend/Subcategory/index';
$route['admin/subcategory/(:any)'] = 'backend/Subcategory/edit/$1';
$route['admin/subcategory/delete/(:any)']="backend/Subcategory/delete/$1";
/*backend routes*/

/*frontend routes*/
$route['shopping-cart'] = 'frontend/Cart/add';
$route['cart'] = 'frontend/Cart/details';
$route['delete/(:any)'] = 'frontend/Cart/delete/$1';
$route['update/(:any)'] = 'frontend/Cart/updatecart/$1';

$route['brands'] = 'frontend/Front/brands';
$route['all-brands'] = 'frontend/Front/getBrands';
$route['all-brands/(:any)'] = 'frontend/Front/getBrands/$1';

$route['new-products'] = 'frontend/Front/newproducts';

$route['sign-in']="frontend/Customer/login";
$route['orders/sign-in']="frontend/Customer/order";
$route['wishlist/sign-in']="frontend/Customer/wishlist";
$route['sign-up']="frontend/Customer/register";
$route['profile']="frontend/Customer/edit";
$route['logout']="frontend/Customer/logout";
$route['forgot-password']="frontend/Customer/forgot";
$route['verify']="frontend/Customer/verify";
$route['reset-password']="frontend/Customer/resetpassword";
$route['change-password']="frontend/Customer/changePassword";
$route['subscribe'] = 'frontend/Customer/subscription';
$route['subscription'] = 'frontend/Customer/subscribe';
$route['orders'] = 'frontend/Customer/orders';

$route['wishlist']="frontend/Front/wishlist";
$route['addwish']="frontend/Front/addwish";
$route['wishlist/delete/(:any)']="frontend/Front/deletewish/$1";

$route['contact-us']="frontend/Front/contact";
$route['404']="frontend/Front/error404";
$route['search'] = 'frontend/Front/search';

$route['earn-with-us']="frontend/Front/earn";
$route['get-quotation']="frontend/Front/quotation";

$route['engineers']="frontend/Front/engineers";
$route['hire-engineer']="frontend/Front/hire";
$route['engineer-profile']="frontend/Front/profile";

$route['engineer']="frontend/Earn/engineers";
$route['logistics-service-provider']="frontend/Earn/logistics";
$route['sales-consultant']="frontend/Earn/sales";
$route['seller']="frontend/Earn/sellers";
$route['verify-engineer']="frontend/Earn/verifyengineer";
$route['verify-sale']="frontend/Earn/verifysales";
$route['verify-logistics']="frontend/Earn/verifylogistics";
$route['verify-seller']="frontend/Earn/verifyseller";

$route['check-out'] = 'frontend/Checkout/shippingdetails';
$route['payment'] = 'frontend/Checkout/payment';
$route['payment-details'] = 'frontend/Checkout/paymentdetails';
$route['confirm-order/(:any)'] = 'frontend/Checkout/confirmorder/$1';

$route['details/(:any)']="frontend/Front/details/$1";
$route['category/(:any)']="frontend/Front/category/$1";
$route['subcategory/(:any)']="frontend/Front/subcategory/$1";
$route['brand/(:any)']="frontend/Front/brand/$1";

/*frontend routes*/
$route['default_controller'] = 'pages/view';
$route['(:any)']="pages/view/$1";
$route['404_override'] = '';   
$route['translate_uri_dashes'] = FALSE;
