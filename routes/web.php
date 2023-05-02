<?php

use Illuminate\Support\Facades\Route;

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



// Route::group(['prefix' => '/'], function () {
//     Route::get('/', function () { return view('index'); });
// });

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});

Route::namespace('Auth')->group(function () {
	Route::post('login','LoginController@login')->name('login');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('home','homeController@index')->name('home');

Route::group(['prefix' => 'clinic'], function () {
	Route::get('fahwanmai','fahwanmai@index')->name('fah.index');
	Route::get('fahwanmai/list','fahwanmai@list')->name('fah.list');
	Route::get('fahwanmai/register','fahwanmai@register')->name('fah.register');
	Route::get('fahwanmai/register/add','fahwanmai@newPatient')->name('fah.add');
	Route::get('fahwanmai/list/{id}','fahwanmai@showPatient')->name('fah.patient');
	Route::get('fahwanmai/update/{id}','fahwanmai@updatePatient')->name('fah.update');
	Route::get('fahwanmai/consent/{id}','fahwanmai@consentPrint')->name('fah.consent');
	Route::get('fahwanmai/discharge/{id}','fahwanmai@dischargePatient')->name('fah.discharge');
});

Route::group(['prefix' => 'clinic/fahwanmai/methadone'], function () {
	Route::get('/','methadone@index')->name('met.index');
	Route::get('therapy/{id}','methadone@therapy')->name('met.therapy');
});

Route::group(['prefix' => 'clinic/fahwanmai/matrix'], function () {
	Route::get('/','matrix@index')->name('mtx.index');
	Route::get('therapy/{id}','matrix@therapy')->name('mtx.therapy');
});


Route::group(['prefix' => 'clinic/form'], function () {
	Route::get('info/{id}','form@info')->name('form.info');
	Route::get('addInfo/{id}','form@addInfo')->name('form.addInfo');
	Route::get('updateInfo/{id}','form@updateInfo')->name('form.updateInfo');
	Route::get('screen/{id}','form@screen')->name('form.screen');
	Route::get('addScreen/{id}','form@addScreen')->name('methadone.addScreen');
	Route::get('updateScreen/{id}','form@updateScreen')->name('methadone.updateScreen');
	Route::get('depress/{id}','form@depress')->name('form.depress');
	Route::get('addDepress/{id}','form@addDepress')->name('form.addDepress');
	Route::get('delDepress/{id}','form@delDepress')->name('form.delDepress');
	Route::get('updateDepress/{id}','form@updateDepress')->name('form.updateDepress');
	Route::get('add2Q/{id}','form@add2Q')->name('depress.add2Q');
	Route::get('add9Q/{id}','form@add9Q')->name('depress.add9Q');
	Route::get('add8Q/{id}','form@add8Q')->name('depress.add8Q');
	Route::get('9Q/{id}','form@Q9')->name('depress.9Q');
	Route::get('8Q/{id}','form@Q8')->name('depress.8Q');
});

Route::group(['prefix' => 'config'], function () {
	Route::get('users','users@list')->name('users.list');
	Route::get('users/add','users@add')->name('users.add');
	Route::get('users/{id}','users@edit')->name('users.edit');
	Route::get('users/reset/{id}','users@reset')->name('users.reset');
});

Route::group(['prefix' => 'visit'], function () {
	Route::get('/','visit@index')->name('visit.index');
	Route::get('/search','visit@search')->name('visit.search');
	Route::get('/search/patient/{id}','visit@list')->name('visit.list');
});

Route::group(['prefix' => 'clinic/anc'], function () {
	Route::get('report','anc@report')->name('anc.report');
});
