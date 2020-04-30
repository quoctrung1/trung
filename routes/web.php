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

Route::resource('admin/about','Admin\AboutController');
//Dinh Dang Lai Destroy
Route::delete('about_delete_modal', 'Admin\AboutController@destroy')->name('about_delete_modal');
Route::delete('brand_delete_modal', 'Admin\BrandController@destroy')->name('brand_delete_modal');
Route::delete('category_delete_modal', 'Admin\CategoryController@destroy')->name('category_delete_modal');
Route::delete('product_delete_modal', 'Admin\ProductController@destroy')->name('product_delete_modal');
Route::delete('slide_delete_modal', 'Admin\SlideController@destroy')->name('slide_delete_modal');
Route::delete('product_detail_delete_modal', 'Admin\Product_DetailController@destroy')->name('product_detail_delete_modal');

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
// END ADMIN

// --------------------------------------------

// USER HERE
// Trang chu User hien thi o day
Route::get('/','User\HomeController@homepage');
Route::resource('products','User\HomeController');

// ---------------------------------------------
// CART
Route::get('cart', 'User\CartController@cart');
Route::patch('update-cart', 'User\CartController@update');
Route::get('add-to-cart/{id}', 'User\CartController@addToCart');
Route::delete('remove-from-cart', 'User\CartController@remove');
// END CART
// ----------------------------------------------
// END USER