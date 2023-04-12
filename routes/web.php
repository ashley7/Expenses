<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	if(Auth::guest())
    return view('auth.login');

	return redirect('home');
});
Auth::routes();

Route::post('activate_licence','UserController@activateLicence');  

Route::get('activate_licence','HomeController@index');


Route::group(['middleware' => ['auth','license']], function () {

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

	Route::resource('services','ServiceController');

	Route::resource('sales','SaleController');

	Route::post('sales_report','SaleController@sales_report');

	Route::get('sales_report','SaleController@index');

	Route::resource('sale_details','SaleDetailController');

	Route::resource('buyer','BuyerController');

	Route::resource('sale_payments','SalePaymentController');

});