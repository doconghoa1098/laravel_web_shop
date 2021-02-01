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


Route::prefix('authenticate')->group(function() {
    Route::get('/login', 'AdminAuthController@getLogin')->name('admin.login');
    Route::post('/login', 'AdminAuthController@postLogin');

    Route::get('/logout', 'AdminAuthController@LogoutAdmin')->name('admin.logout');

});

Route::prefix('admin')->middleware('CheckLoginAdmin')->group(function() {
    Route::get('/', 'AdminController@index')-> name('admin.home');

    Route::group(['prefix' => 'category'], function(){
        Route::get('/','AdminCategoryController@index') ->name('admin.get.list.category');
        Route::get('/create','AdminCategoryController@create') ->name('admin.get.create.category');
        Route::post('/create','AdminCategoryController@store');
        Route::get('/update/{id}','AdminCategoryController@edit') ->name('admin.get.edit.category');
        Route::post('/update/{id}','AdminCategoryController@update');
        Route::get('/{action}/{id}','AdminCategoryController@action') ->name('admin.get.action.category');

    });

    Route::group(['prefix' => 'product'], function(){
        Route::get('/','AdminProductController@index') ->name('admin.get.list.product');
        Route::get('/create','AdminProductController@create') ->name('admin.get.create.product');
        Route::post('/create','AdminProductController@store');
        Route::get('/update/{id}','AdminProductController@edit') ->name('admin.get.edit.product');
        Route::post('/update/{id}','AdminProductController@update');
        Route::get('/{action}/{id}','AdminProductController@action') ->name('admin.get.action.product');

    });

    Route::group(['prefix' => 'article'], function(){
        Route::get('/','AdminArticleController@index') ->name('admin.get.list.article');
        Route::get('/create','AdminArticleController@create') ->name('admin.get.create.article');
        Route::post('/create','AdminArticleController@store');
        Route::get('/update/{id}','AdminArticleController@edit') ->name('admin.get.edit.article');
        Route::post('/update/{id}','AdminArticleController@update');
        Route::get('/{action}/{id}','AdminArticleController@action') ->name('admin.get.action.article');

    });
//quản lý đơn hàng
    Route::group(['prefix' => 'transaction'], function(){
        Route::get('/','AdminTransactionController@index') ->name('admin.get.list.transaction');
        Route::get('/view/{id}','AdminTransactionController@viewOrder') ->name('admin.get.view.order');
        Route::get('/{action}/{id}','AdminTransactionController@action') ->name('admin.get.action.order');

    });

    //quản lý thành viên
    Route::group(['prefix' => 'user'], function(){
        Route::get('/','AdminUserController@index') ->name('admin.get.list.user');
        Route::get('/{action}/{id}','AdminUserController@action') ->name('admin.get.action.user');

    });

    //quản lý rating
    Route::group(['prefix' => 'rating'], function(){
        Route::get('/','AdminRatingController@index') ->name('admin.get.list.rating');
        Route::get('/delete/{id}','AdminRatingController@delete')->name('admin.get.delete.rating');

    });

    //quản lý admin và các thành viên
    Route::group(['prefix' => 'member',  'middleware' => 'CheckRoles'], function(){
        Route::get('/','AdminMemberController@index') ->name('admin.get.list.member');
        Route::get('/create','AdminMemberController@create') ->name('admin.get.create.member');
        Route::post('/create','AdminMemberController@store');
        Route::get('/update/{id}','AdminMemberController@edit') ->name('admin.get.edit.member');
        Route::post('/update/{id}','AdminMemberController@update');
        Route::get('/{action}/{id}','AdminMemberController@action') ->name('admin.get.action.member');

    });

    // đổi mật khẩu cho người đang đăng nhập
    Route::group(['prefix' => 'member'], function(){
        Route::get('/password','AdminMemberController@updatePassword') ->name('admin.update.password');
        Route::post('/password','AdminMemberController@saveUpdatePassword');

    });





//Trả góp
    Route::group(['prefix' => 'repay'], function(){
        Route::get('/','AdminRepayController@index') ->name('admin.get.list.repay');
        Route::get('/create','AdminRepayController@create') ->name('admin.get.create.repay');
        Route::post('/create','AdminRepayController@store');
        Route::get('/update/{id}','AdminRepayController@edit') ->name('admin.get.edit.repay');
        Route::post('/update/{id}','AdminRepayController@update');
        Route::get('/{action}/{id}','AdminRepayController@action') ->name('admin.get.action.repay');

    });

    //quản lý slide
    Route::group(['prefix' => 'slide'], function(){
        Route::get('/','AdminSlideController@index') ->name('admin.get.list.slide');
        Route::get('/create','AdminSlideController@create') ->name('admin.get.create.slide');
        Route::post('/create','AdminSlideController@store');
        Route::get('/update/{id}','AdminSlideController@edit') ->name('admin.get.edit.slide');
        Route::post('/update/{id}','AdminSlideController@update');
        Route::get('/{action}/{id}','AdminSlideController@action') ->name('admin.get.action.slide');

    });
});
