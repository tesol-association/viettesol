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

	});

	//partner_sponsor
	Route::group(['prefix'=>'partner_sponsor'],function(){

	});

	//advertisements
	Route::group(['prefix'=>'advertisements'],function(){

	});

    //comment
    Route::group(['prefix'=>'comment'],function(){

	});

	//category
	Route::group(['prefix'=>'category'],function(){

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

	Route::group(['prefix'=>'contact'],function(){
		Route::get('/list', 'Admin\ContactController@index')->name('admin_contact_list');
		Route::get('/create', 'Admin\ContactController@create')->name('admin_contact_create');
		Route::post('/store', 'Admin\ContactController@store')->name('admin_contact_store');
		Route::get('/edit/{id}', 'Admin\ContactController@edit')->name('admin_contact_edit');
		Route::post('/update/{id}', 'Admin\ContactController@update')->name('admin_contact_update');
		Route::post('/delete/{id}', 'Admin\ContactController@destroy')->name('admin_contact_delete');
	});

	Route::group(['prefix'=>'contact_type'],function(){
		Route::get('/list', 'Admin\ContactTypeController@index')->name('admin_contact_type_list');
		Route::get('/create', 'Admin\ContactTypeController@create')->name('admin_contact_type_create');
		Route::post('/store', 'Admin\ContactTypeController@store')->name('admin_contact_type_store');
		Route::get('/edit/{id}', 'Admin\ContactTypeController@edit')->name('admin_contact_type_edit');
		Route::post('/update/{id}', 'Admin\ContactTypeController@update')->name('admin_contact_type_update');
		Route::post('/delete/{id}', 'Admin\ContactTypeController@destroy')->name('admin_contact_type_delete');
	});
});
Auth::routes();
