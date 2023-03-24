<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('account','ExpenseaccountController');

	Route::resource('expense','ExpenseController');

	Route::resource('reports','ReportsController');

	Route::post('bank_report','ReportsController@bank_report');

	Route::get('bankreport','ReportsController@bankreport');

	Route::resource('bank','BankController');

	Route::resource('bank_deposite','BankDepositController');

	Route::resource('cheque','ChequeController');

	Route::resource('user','UserController');

	Route::get('cheque_report','ReportsController@cheque_report');

	Route::post('chequereport','ReportsController@chequereport');

	Route::resource('income_account','IncomeAccountController');

	Route::resource('income','IncomeController');

	Route::resource('customer','CustomerController');

	Route::post('import_customer','CustomerController@importCustomers');

	Route::get('import_customer','CustomerController@importCustomer');

	Route::post('report','IncomeController@report');

	Route::get('income_report/{income_account_id}','IncomeController@incomereport');

	Route::get('income_report','IncomeController@income_report');

	Route::get('change_password','UserController@changePassword');

	Route::get('search_record','ExpenseController@index');

	Route::post('search_record','ExpenseController@searchRecord');

	Route::post('search_income_record','IncomeController@search_income_record');

	Route::get('search_income_record','IncomeController@index');

});