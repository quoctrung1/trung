<?php

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
// Authenticate
Auth::routes(); 

// Xu ly Login Logut ADMIN
Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm');
Route::post('/admin/login', 'Auth\LoginController@adminLogin');
// Admin ko co register de tam day test thu
Route::get('/admin/register', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/admin/register', 'Auth\RegisterController@createAdmin');
Route::get('/admin/logout', 'Auth\LoginController@adminLogout')->name('admin.logout');


// ADMIN HERE
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');

//Dinh Dang Lai Destroy
Route::delete('about_delete_modal', 'Admin\AboutController@destroy')->name('about_delete_modal');
Route::delete('brand_delete_modal', 'Admin\BrandController@destroy')->name('brand_delete_modal');
Route::delete('category_delete_modal', 'Admin\CategoryController@destroy')->name('category_delete_modal');
Route::delete('product_delete_modal', 'Admin\ProductController@destroy')->name('product_delete_modal');
Route::delete('slide_delete_modal', 'Admin\SlideController@destroy')->name('slide_delete_modal');
Route::delete('product_detail_delete_modal', 'Admin\Product_DetailController@destroy')->name('product_detail_delete_modal');
//End Destroy
// -------------------------------------------------------------------------------
Route::resource('admin/about','Admin\AboutController');
Route::resource('admin/brand','Admin\BrandController');
Route::resource('admin/category','Admin\CategoryController');
Route::resource('admin/comment','Admin\CommentController');
Route::resource('admin/image','Admin\ImageController');
Route::resource('admin/order','Admin\OrderController');
Route::resource('admin/orderdetail','Admin\OrderDetailController');
Route::resource('admin/product','Admin\ProductController');
Route::resource('admin/slide','Admin\SlideController');
Route::resource('admin/store','Admin\StoreController');
// function ajax
Route::get('/setvalue', 'Admin\ProductController@setvalue');
Route::get('/getcolor', 'Admin\ProductController@getcolor');
Route::get('/get_list_size', 'Admin\StoreController@getListSize');
Route::get('/get_list_color', 'Admin\StoreController@getListColor');
Route::get('/get_quantity', 'Admin\StoreController@getQuantity');
//END ajax
// -------------------------------------------------------------------------------
// END ADMIN
// --------------------------------------------

// USER 
// Xu ly Login Logout CLIENTS
Route::get('/login', 'Auth\LoginController@showClientLoginForm');
Route::post('/login', 'Auth\LoginController@clientLogin');
Route::get('/register', 'Auth\RegisterController@showClientRegisterForm');
Route::post('/register', 'Auth\RegisterController@createClient');
Route::get('/logout', 'Auth\LoginController@clientLogout')->name('logout');
// End Authenticate
// -------------------------------------------------------------------------------
Route::get('/','User\HomeController@homepage');
Route::resource('products','User\HomeController');
Route::resource('cart','User\CartController');
Route::get('profile','User\ClientController@index');
// ---------------------------------------------
// CART
Route::patch('update-cart', 'User\CartController@update');
Route::get('add-to-cart/{id}', 'User\CartController@addToCart');
Route::delete('remove-from-cart', 'User\CartController@remove');
// END CART
// ----------------------------------------------
// END USER
