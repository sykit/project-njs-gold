<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['/'] = 'auth';

/**
 * auth
 */

/**
 * masking routes
 * Show page on pages controller
 * submission handling differently according to context, e.g: Product in Product.php controller,
 * Category in Category.php controller
 */

$route['api/v1/subcat/(:any)'] = 'async/fetch_subcatbycat/$1';
$route['api/v1/products'] = 'async/fetch_products';

/**
 * Administration
 */
$route['manage/product/category'] = 'pages/product_category';
$route['manage/product/category/edit/(:any)'] = 'category/edit/$1';
$route['manage/product/category/add'] = 'category/add';
$route['manage/product/category/delete'] = 'category/delete';
$route['products'] = 'pages/product_list_all';
$route['products/(:any)/(:any)/(:any)/(:any)'] = 'pages/product_list_all/$1/$2/$3/$4';

$route['manage/product/subcategory'] = 'pages/product_subcategory';
$route['manage/product/subcategory/edit'] = 'subcategory/edit';
$route['manage/prodcut/subcategory/delete'] = 'subcategory/delete';

$route['manage/product'] = 'pages/product_management';
$route['manage/product/list'] = 'pages/product_list';
$route['manage/product/add'] = 'product/add/$1';
$route['manage/product/edit'] = 'product/edit';
$route['manage/product/delete'] = 'product/delete';

$route['manage/users'] = 'pages/user_management';
$route['manage/users/edit'] = 'users/edit';
$route['manage/users/add'] = 'users/add';
$route['manage/users/delete'] = 'users/delete';

$route['manage/user/(:any)'] = 'pages/user_edit/$1';

$route['manage/fgroup'] = 'pages/fgroup_management';
$route['manage/fgroup/add'] = 'fgroup/add';
$route['manage/fgroup/edit'] = 'fgroup/edit';
$route['manage/fgroup/delete'] = 'fgroup/delete';

$route['manage/company_type'] = 'pages/company_type';
$route['manage/company'] = 'pages/company';
$route['manage/customer_data'] = 'pages/customer_data';
$route['manage/customer_data/edit'] = 'Customerdata/edit';
$route['manage/customer_data/add'] = 'Customerdata/add';
$route['manage/customer_data/delete'] = 'Customerdata/delete';

$route['manage/discount_maintenance'] = 'pages/discount_data';
$route['manage/discount_maintenance/edit'] = 'Discountmaintenance/edit';

/**
 * General SCM
 */
$route['transactions'] = 'pages/transactions';
$route['transactions/inprogress'] = 'Scm/inprogresspages/inprogress';
$route['transactions/incoming'] = 'Scm/incomingpages/incoming';
$route['transactions/inprocess'] = 'Scm/inprocesspages/inprocess';
$route['transactions/complete'] = 'Scm/completepages/complete';

/**
 * Produksi
 */
$route['transaksi/produksi/gd'] = 'Scm/Production/asyncgoodsdelivery/goods_delivery';

/**
 * SOM user format transaksi/<activity_category_alias>/<activity_code>/<anything>
 */
$route['transaksi/distribusi/som'] = 'Scm/Som/scmdistributepages/som';
$route['transaksi/distribusi/som/inprogress'] = 'Scm/Som/scmdistributepages/som_inprogress';
$route['transaksi/distribusi/som/inprocess'] = 'Scm/Som/scmdistributepages/som_inprocess';
$route['transaksi/distribusi/som/masuk'] = 'Scm/Som/scmdistributepages/som_masuk';
$route['transaksi/distribusi/som/complete'] = 'Scm/Som/scmdistributepages/som_complete';
$route['transaksi/distribusi/somdl'] = 'Scm/Som/scmdistributepages/somdl';
$route['transaksi/distribusi/somdl'] = 'Scm/Som/scmdistributepages/somdl';

$route['transaksi/distribusi/vsom'] = 'Scm/Som/scmdistributepages/somv';
$route['transaksi/distribusi/vsom/inprogress'] = 'Scm/Som/scmdistributepages/somv_inprogress';
$route['transaksi/distribusi/vsom/inprocess'] = 'Scm/Som/scmdistributepages/somv_inprocess';
$route['transaksi/distribusi/vsom/masuk'] = 'Scm/Som/scmdistributepages/somv_masuk';
$route['transaksi/distribusi/vsom/complete'] = 'Scm/Som/scmdistributepages/somv_complete';

/**
 * Report
 */
$route['report/product_stock_monitoring'] = 'pages/product_stock_monitoring';
$route['report/product_movement_monitoring'] = 'pages/product_movement_monitoring';

/**
 * API
 */

$route['api/v1/post_data'] = 'reqs/post_data';
$route['api/v1/get_data'] = 'reqs/get_data';
$route['api/v1/control_valve'] = 'reqs/control_valve';

$route['manage/product_alocation'] = 'pages/product_alocation';
$route['manage/product_alocation/add'] = 'Productalocation/add';


$route['transaksi/distribusi/por'] = 'Scm/Som/scmdistributepages/por';
$route['transaksi/distribusi/por/inprogress'] = 'Scm/Som/scmdistributepages/por_inprogress';
$route['transaksi/distribusi/por/inprocess'] = 'Scm/Som/scmdistributepages/por_inprocess';
$route['transaksi/distribusi/por/masuk'] = 'Scm/Som/scmdistributepages/por_masuk';
$route['transaksi/distribusi/por/complete'] = 'Scm/Som/scmdistributepages/por_complete';
