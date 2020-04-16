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

// ADMIN HERE
// Trang chu Admin hien thi o day
Route::get('admin/home', function() {
	return view('admin.homeadmin');
});

Route::resource('admin/about','AboutController');
Route::resource('admin/brand','BrandController');
Route::resource('admin/category','CategoryController');
Route::resource('admin/comment','CommentController');
Route::resource('admin/image','ImageController');
Route::resource('admin/order','OrderController');
Route::resource('admin/orderdetail','OrderDetailController');
Route::resource('admin/product','ProductController');
Route::resource('admin/slide','SlideController');

Route::get('/setvalue', 'ProductController@setvalue');
// END ADMIN

// --------------------------------------------

// USER HERE
// Trang chu User hien thi o day
Route::get('/', function () {
    return view('user.home');
});
// END USER

// ---------------------------------------------
Route::get('admin/home', function () {
    return view('admin.homeadmin');
});

// CART
Route::get('product', 'ProductsController@index');

Route::get('cart', 'ProductsController@cart');

Route::get('add-to-cart/{id}', 'ProductsController@addToCart');

Route::patch('update-cart', 'ProductsController@update');

Route::delete('remove-from-cart', 'ProductsController@remove');
// END CART

// ----------------------------------------------