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
<<<<<<< HEAD

Route::group(['prefix'=>'admin'],function(){
        
    //menu
    Route::get('/menu/list','Admin\MenuController@index')->name('admin_menu_list');    

});

=======
Auth::routes();
>>>>>>> 7407b93459303c9dc86e06260c6637097841ae70
