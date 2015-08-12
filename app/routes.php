<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|------------------------------------------------------------------------
| Routes Members
|------------------------------------------------------------------------
*/

Route::get('members_list', 'MemberController@members_list');

/*
|------------------------------------------------------------------------
| Routes Memberships
|------------------------------------------------------------------------
*/

Route::get('membership_types_list', 'MembershipTypeController@membership_types_list');
Route::get('active_memberships', 'MembershipController@active_memberships');
Route::get('inactive_memberships', 'MembershipController@inactive_memberships');

/*
|------------------------------------------------------------------------
| Routes Payments
|------------------------------------------------------------------------
*/

Route::get('memberships_paymets', 'PaymentController@payments_list');
Route::post('/payment/{memberId?}', 'PaymentController@store');

/*
|------------------------------------------------------------------------
| Routes Home
|------------------------------------------------------------------------
*/

Route::post('validate_membership', 'HomeController@validate_membership');
Route::get('/check_notifications_axeso', 'HomeController@check_notifications');
Route::get('expiring_memberships', 'HomeController@expiring_memberships');
Route::get('memberships_paymets', 'HomeController@memberships_paymets');
Route::get('test', 'HomeController@test');
Route::get('available_memberships_types', 'HomeController@available_memberships_types');
Route::get('unavailable_memberships_types', 'HomeController@unavailable_memberships_types');
Route::get('quick_search', 'HomeController@quick_search');

/*
|------------------------------------------------------------------------
| Routes Login
|------------------------------------------------------------------------
*/

Route::get('/', function(){
    return View::make('login');
});

/*
|------------------------------------------------------------------------
| Routes Visitors
|------------------------------------------------------------------------
*/

Route::get('/visitors_list', function(){
	return View::make('visitors_list');
});

/*
|-------------------------------------------------------------------------
| Routes for cashbox
|-------------------------------------------------------------------------
*/

Route::get('/incomes', function(){
	return View::make('income');
});

Route::get('/turner_cash', function(){
	return View::make('cash_out');
});

Route::get('/outcomes', function(){
	return View::make('expenses');
});

Route::get('/settings_turner_cash', function(){
	return View::make('adjustments');
});

