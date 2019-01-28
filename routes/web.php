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
Route::get('qrLogin', ['uses' => 'QrLoginController@qr1']);
Route::get('qrLogin2', ['uses' => 'QrLoginController@qr2']);
Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);
//image
Route::get('avatar/{type}/{file_id}','FileController@image');

Route::group(['middleware' => ['web', 'auth', 'permission'] ], function () {
  Route::get('/', function () {
      return view('welcome');
  });
 	Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'as' => 'home.dashboard']);
	//users
	Route::resource('user', 'UserController');
	Route::post('user/ajax_all', ['uses' => 'UserController@ajax_all']);
	//users profil
	Route::post('user/ganti-profil/{id}', ['uses' => 'UserController@gantiprofil']);
	Route::get('profil', ['uses' => 'UserController@showprofil']);
	Route::get('edit-profil', ['uses' => 'UserController@editprofil']);
	Route::patch('edit-profil/{id}', ['uses' => 'UserController@updateprofile']);
	Route::get('edit-password', ['uses' => 'UserController@showpassword']);
	Route::patch('edit-password/{id}', ['uses' => 'UserController@gantipassword']);
	//user password
	Route::get('password', ['uses' => 'UserController@showpassword']);
	Route::post('password', ['uses' => 'UserController@gantipassword']);
	//user activation
	Route::get('active/{id}','UserController@active')->name('user.activate');
	Route::get('deactive/{id}','UserController@deactivate')->name('user.deactivate');
	//user permission
	Route::get('user/{id}/permission', 'UserController@permissions')->name('user.permissions');
	Route::post('user/{id}/permission', 'UserController@simpan')->name('user.simpan');
	//qrcode
	Route::get('user/qr-code/{id}','QrLoginController@UserQrCode');
	Route::get('My-QrCode','QrLoginController@MyQrCode');
	Route::post('autogenerateqrcode','QrLoginController@QrAutoGenerate');

	//role
	Route::resource('role','RoleController');
	//role permission
	Route::get('role/{id}/permission','RoleController@permissions')->name('role.permissions');
	Route::post('role/{id}/permission', 'RoleController@simpan')->name('role.simpan');

});
