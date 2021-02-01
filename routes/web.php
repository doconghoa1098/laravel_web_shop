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




Auth::routes();
Route::group(['namespace' => 'Auth'],function (){
    Route::get('dang-ky', 'RegisterController@getRegister')->name('get.register');
    Route::post('dang-ky', 'RegisterController@postRegister')->name('post.register');

    Route::get('dang-nhap', 'LoginController@getLogin')->name('get.login');
    Route::post('dang-nhap', 'LoginController@postLogin')->name('post.login');

    Route::get('quen-mat-khau', 'ForgotPasswordController@getResetPassword')->name('get.reset.password');
    Route::post('quen-mat-khau', 'ForgotPasswordController@sentCodeResetPassword');

    Route::get('/password/reset', 'ForgotPasswordController@resetPassword')->name('get.link.reset.password');
    Route::post('/password/reset', 'ForgotPasswordController@saveresetPassword');


    Route::get('/active', 'ForgotPasswordController@getActiveAccount')->name('get.active.account');
    Route::get('/active/link', 'ForgotPasswordController@activeAccount')->name('get.link.active.account');



    Route::get('dang-xuat', 'LoginController@getLogout')->name('get.logout.user');

});

Route::get('/', 'HomeController@index')->name('home');

Route::get('danh_muc/{slug}-{id}', 'CategoryController@getListProduct')->name('get.list.product');
Route::get('san-pham', 'CategoryController@getListProduct')->name('get.product.list'); //rou tìm kiếm

Route::get('san-pham/{slug}-{id}', 'ProductDetailController@productDetail')->name('get.detail.product');


Route::prefix('shopping')->group(function (){
    Route::get('/add/{id}/{qty}', 'ShoppingCartController@addProduct')->name('add.shopping.cart');
    Route::get('/delete/{id}', 'ShoppingCartController@deleteProduct')->name('delete.shopping.cart');
    Route::get('/update/{rowid}/{qty}', 'ShoppingCartController@updateProduct')->name('update.shopping.cart');
    Route::get('/danh-sach', 'ShoppingCartController@getListShoppingCart')->name('get.list.shopping.cart');
});
//bài viết
Route::get('bai-viet', 'ArticleController@getListArticle')->name('get.list.article');
Route::get('bai-viet/{slug}-{id}', 'ArticleController@getDetailArticle')->name('get.detail.article');
//trả góp
Route::get('/tra-gop', 'RepaymentController@getPay')->name('get.list.repayment');


Route::group(['prefix' => 'gio-hang', 'middleware' =>  ['CheckLoginUser','CheckActiveUser','CheckBandUser'] ],function (){
    Route::get('/thanh-toan','ShoppingCartController@getFormPay')->name('get.form.repay');
    Route::post('/thanh-toan','ShoppingCartController@saveInfoShoppingCart');
});

Route::group(['prefix' => 'ajax', 'middleware' => 'CheckLoginUser' ],function (){
    Route::post('/danh-gia/{id}','RatingController@saveRating')->name('post.rating.product');
});


//thông tin user
Route::group(['prefix' => 'user', 'middleware' => 'CheckLoginUser' ],function (){
    Route::get('/','UserController@index')->name('user.dashboard');
    Route::get('/vieworder/{id}','UserController@viewOrder') ->name('user.view.order');
    Route::get('/exit/{id}','UserController@exitOrder') ->name('user.exit.order');
    Route::post('/','UserController@saveUpdateInfo');


    Route::get('/password','UserController@updatePassword') ->name('user.update.password');
    Route::post('/password','UserController@saveUpdatePassword');

});
