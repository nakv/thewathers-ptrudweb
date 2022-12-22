<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Frontend routes
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'App\Http\Controllers\BrandProduct@show_brand_home');

Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@details_product');

// Admin routes
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');
//ADMIN Auth role
Route::get('/register-auth', 'App\Http\Controllers\AuthController@register_auth');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/login-auth', 'App\Http\Controllers\AuthController@login_auth');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::get('/logout-auth', 'App\Http\Controllers\AuthController@logout_auth');

// Category Product
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@index');
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');

Route::get('/edit-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/unactive-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//Brand
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@index');
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');

Route::get('/edit-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/unactive-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');


// Product
Route::get('/all-product', 'App\Http\Controllers\ProductController@index');
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');

Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');

Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');

Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

//CART
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart-quantity/{rowID}', 'App\Http\Controllers\CartController@update_cart_quantity');
//Update cart quantity ajax
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');

Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowID}', 'App\Http\Controllers\CartController@delete_to_cart');


//Cart AJAX
Route::post('/add-to-cartajax', 'App\Http\Controllers\CartController@add_to_cartajax');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/delete-product-cart/{sessionID}', 'App\Http\Controllers\CartController@delete_product_cart');
//CHECKOUT
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::POST('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::POST('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::POST('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');

Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');

Route::POST('/order-place', 'App\Http\Controllers\CheckoutController@order_place');

Route::POST('/select-delivery-user', 'App\Http\Controllers\CheckoutController@select_delivery_user');
Route::POST('/calculate-fee', 'App\Http\Controllers\CheckoutController@calculate_fee');
Route::get('/del-fee', 'App\Http\Controllers\CheckoutController@del_fee');

Route::post('/confirm-order', 'App\Http\Controllers\CheckoutController@confirm_order');
//Amin Order management

Route::get('/manage-order', 'App\Http\Controllers\OrderController@index');
Route::get('/view-order/{OrderCode}', 'App\Http\Controllers\OrderController@view_order');
Route::get('/delete-order/{OrderCode}', 'App\Http\Controllers\OrderController@delete_order');

Route::post('/update-order-status/{OrderCode}', 'App\Http\Controllers\OrderController@update_order_status');

// Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
// Route::get('/view-order/{orderId}', 'App\Http\Controllers\CheckoutController@view_order');
//User order
Route::get('/my-order', 'App\Http\Controllers\OrderController@my_order');
Route::get('/my-order-detail/{OrderCode}', 'App\Http\Controllers\OrderController@my_order_detail');
//Cart ajax
Route::post('/add-cart-ajax', [CartController::class, 'addCartAjax'])->name('cart.add');


//Delivery
Route::get('/delivery', 'App\Http\Controllers\DeliveryController@delivery');
Route::post('/select-delivery', 'App\Http\Controllers\DeliveryController@select_delivery');
Route::post('/insert-delivery', 'App\Http\Controllers\DeliveryController@insert_delivery');
Route::post('/select-feeship', 'App\Http\Controllers\DeliveryController@select_feeship');
Route::post('/update-feeship', 'App\Http\Controllers\DeliveryController@update_feeship');


//USER manager
Route::get('users', 'App\Http\Controllers\UserController@index');
Route::get('add-users', 'App\Http\Controllers\UserController@add_users');
Route::post('store-users', 'App\Http\Controllers\UserController@store_users');

Route::post('assign-roles', 'App\Http\Controllers\UserController@assign_roles');