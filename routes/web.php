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
//Auth
Route::get('/login', 'AuthController@login');
// Route::get('/register','AuthController@register');
Route::post('/login','AuthController@postLogin');
// Route::post('/register','AuthController@postRegister');

//Home page
Route::get('/','BlogController@indexBlog');

Route::group(['middleware' => ['visit']],function(){
    Route::get('/post-page/{id}','BlogController@blogPost');
    Route::get('/post-more/{post_id}','BlogController@blogPostMore');
    Route::get('/post-search','BlogController@searchPost');
    Route::get('/contact-us','BlogController@usContact');
    Route::get('mail-send', 'MailController@send');
    
});
Route::group(['middleware' => ['auth']],function(){

    //dashboard and Logout
    Route::get('/dashboard','AuthController@index');
    Route::get('/logout','AuthController@getLogout');

    //Resource controller
    Route::resource('users','AdminPanel\UserController');
    Route::resource('permission','AdminPanel\PermissionController');

    Route::resource('slide-show','AdminPanel\SystemCodeController');

    // Route::resource('/post','AdminPanel\PostController');
    Route::group(['prefix' => 'post'], function () {
        Route::get('data', 'AdminPanel\PostController@data');
        Route::get('post-add', 'AdminPanel\PostController@create');
        // Route::get('post-edit', 'AdminPanel\PostController@edit');
    });

    //Bannner
    Route::get('banner','BannerController@index');
    Route::get('banner/{id}','BannerController@show');
    Route::put('banner/{id}','BannerController@update');

    // Route::group(['prefix' => 'banner'],function(){
    //     Route::get('index',function(){
    //         return 'asdasd';
    //     });
    // });

    Route::resource('post','AdminPanel\PostController');

    // Route::get('/post-add',function(){
    //     return view('pages.post-add');
    // });
    // Route::get('/post-edit',function(){
    //     return view('pages.post-edit');
    // });

    Route::get('/settings','AdminPanel\SettingController@settingIndex');

    Route::get('ajax-social-media','AdminPanel\SettingController@socialMedia');
    Route::post('ajax-social-media','AdminPanel\SettingController@postSocialMedia');
    Route::get('ajax-footer-information','AdminPanel\SettingController@footerInformation');
    Route::post('ajax-footer-information','AdminPanel\SettingController@postFooterInformation');
    Route::get('ajax-profile','AdminPanel\SettingController@getProfile');
   
    Route::post('ajax-permission-active','AdminPanel\AjaxChangeController@AjaxPermissionPageActive');
    Route::get('/log','AdminPanel\AjaxChangeController@viewLog');
    Route::get('/ajax-log','AdminPanel\AjaxChangeController@getLog');
    Route::post('img-store-edit','AdminPanel\AjaxChangeController@imgStoreEdit');

});