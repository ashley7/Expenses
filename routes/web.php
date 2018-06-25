<?php
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('account','ExpenseaccountController');
	Route::resource('expense','ExpenseController');
	Route::resource('reports','ReportsController');
});