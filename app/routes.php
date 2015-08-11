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

Route::get('/', function()
{
    return View::make('QuickSearch');
});

Route::get('test', 'HomeController@test');
Route::get('members_list', 'MemberController@members_list');
Route::get('membership_types_list', 'MembershipTypeController@membership_types_list');
Route::get('available_memberships_types', 'HomeController@available_memberships_types');
Route::get('unavailable_memberships_types', 'HomeController@unavailable_memberships_types');
Route::get('active_memberships', 'MembershipController@active_memberships');
Route::get('inactive_memberships', 'MembershipController@inactive_memberships');
Route::get('expiring_memberships', 'HomeController@expiring_memberships');
Route::get('memberships_paymets', 'PaymentController@payments_list');
Route::post('/payment/{memberId?}', 'PaymentController@store');
Route::post('validate_membership', 'HomeController@validate_membership');


