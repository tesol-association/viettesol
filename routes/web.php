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

Route::get('/', function () {
    return view('layouts.home.layout');
});
Route::get('/demo-conference',function () {
    return view('layouts.conference.layout');
});
Route::get('/demo-admin',function () {
    return view('layouts.admin.layout');
});
Route::get('/demo-home',function () {
    return view('layouts.home.layout');
});

//'middleware'=>'auth'
Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin']],function(){
    Route::get('/index',function () {
        return view('layouts.admin.layout');
    });
    //menu
    Route::group(['prefix'=>'menu'],function(){
        Route::get('/list','Admin\MenuController@index')->name('admin_menu_list');

        Route::get('/create','Admin\MenuController@create')->name('admin_menu_create');
        Route::post('/store','Admin\MenuController@store')->name('admin_menu_store');
        Route::post('/delete/{id}','Admin\MenuController@destroy')->name('admin_menu_delete');

        Route::get('/view/{id}','Admin\MenuController@edit')->name('admin_menu_edit');
        Route::post('/update/{id}','Admin\MenuController@update')->name('admin_menu_update');
    });

    //banner
    Route::group(['prefix'=>'banner'],function(){
        Route::get('/list','Admin\BannerController@index')->name('admin_banner_list');

        Route::get('/create','Admin\BannerController@create')->name('admin_banner_create');
        Route::post('/store','Admin\BannerController@store')->name('admin_banner_store');

        Route::post('/delete/{id}','Admin\BannerController@destroy')->name('admin_banner_delete');

        Route::get('/view/{id}','Admin\BannerController@edit')->name('admin_banner_edit');
        Route::post('/update/{id}','Admin\BannerController@update')->name('admin_banner_update');
    });

    //partner_sponsor
    Route::group(['prefix'=>'partner_sponsor'],function(){
        Route::get('/list','Admin\PartnerController@index')->name('admin_partner_list');

        Route::get('/create','Admin\PartnerController@create')->name('admin_partner_create');
        Route::post('/store','Admin\PartnerController@store')->name('admin_partner_store');

        Route::post('/delete/{id}','Admin\PartnerController@destroy')->name('admin_partner_delete');

        Route::get('/view/{id}','Admin\PartnerController@edit')->name('admin_partner_edit');
        Route::post('/update/{id}','Admin\PartnerController@update')->name('admin_partner_update');
    });

    //advertisements
    Route::group(['prefix'=>'advertisements'],function(){
        Route::get('/list','Admin\AdvertisementController@index')->name('admin_advertisement_list');

        Route::get('/create','Admin\AdvertisementController@create')->name('admin_advertisement_create');
        Route::post('/store','Admin\AdvertisementController@store')->name('admin_advertisement_store');

        Route::post('/delete/{id}','Admin\AdvertisementController@destroy')->name('admin_advertisement_delete');

        Route::get('/view/{id}','Admin\AdvertisementController@edit')->name('admin_advertisement_edit');
        Route::post('/update/{id}','Admin\AdvertisementController@update')->name('admin_advertisement_update');
    });

    //comment
    Route::group(['prefix'=>'comment'],function(){

    });

    //category
    Route::group(['prefix'=>'category'],function(){

    });

    /**
     * CONTENT MANAGER
     */
	Route::group(['prefix'=>'news'], function(){
	    Route::get('/list', 'Admin\NewsController@index')->name('admin_news_list');
	    Route::get('/create', 'Admin\NewsController@create')->name('admin_news_create');
	    Route::post('/store', 'Admin\NewsController@store')->name('admin_news_store');
	    Route::get('/edit/{id}', 'Admin\NewsController@edit')->name('admin_news_edit');
	    Route::post('/update/{id}', 'Admin\NewsController@update')->name('admin_news_update');
	    Route::post('/delete/{id}', 'Admin\NewsController@destroy')->name('admin_news_delete');
	});

    Route::group(['prefix'=>'news_category'], function(){
        Route::get('/list', 'Admin\NewsCategoryController@index')->name('admin_news_category_list');
        Route::get('/create', 'Admin\NewsCategoryController@create')->name('admin_news_category_create');
        Route::post('/store', 'Admin\NewsCategoryController@store')->name('admin_news_category_store');
        Route::get('/edit/{id}', 'Admin\NewsCategoryController@edit')->name('admin_news_category_edit');
        Route::post('/update/{id}', 'Admin\NewsCategoryController@update')->name('admin_news_category_update');
        Route::post('/delete/{id}', 'Admin\NewsCategoryController@destroy')->name('admin_news_category_delete');
    });

	Route::group(['prefix'=>'events'],function(){
        Route::get('/list', 'Admin\EventController@index')->name('admin_event_list');
        Route::get('/create', 'Admin\EventController@create')->name('admin_event_create');
        Route::post('/store', 'Admin\EventController@store')->name('admin_event_store');
        Route::get('/edit/{id}', 'Admin\EventController@edit')->name('admin_event_edit');
        Route::post('/update/{id}', 'Admin\EventController@create')->name('admin_event_update');
        Route::post('/delete/{id}', 'Admin\EventController@destroy')->name('admin_event_delete');
	});

	Route::group(['prefix'=>'events_category'],function(){
        Route::get('/list', 'Admin\EventController@index')->name('admin_events_category_list');
        Route::get('/create', 'Admin\EventController@create')->name('admin_events_category_create');
        Route::post('/store', 'Admin\EventController@store')->name('admin_events_category_store');
        Route::get('/edit/{id}', 'Admin\EventController@edit')->name('admin_events_category_edit');
        Route::post('/update/{id}', 'Admin\EventController@create')->name('admin_events_category_update');
        Route::post('/delete/{id}', 'Admin\EventController@destroy')->name('admin_events_category_delete');
	});
    //news
    Route::group(['prefix'=>'news'],function(){

    });

    //events
    Route::group(['prefix'=>'events'],function(){

    });

    //room
    Route::group(['prefix'=>'room'],function(){

    });

    //building
    Route::group(['prefix'=>'building'],function(){

    });

});
Auth::routes();
