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
Route::get('member/info_payment_wizard/{id}', 'MemberController@info_payment_wizard');
Route::get('member/info_membership_wizard/{id}', 'MemberController@info_membership_wizard');
Route::post('member/{memberId?}','MemberController@store');
Route::delete('member/{memberId}','MemberController@delete');
Route::get('member/{memberId}','MemberController@get');
//Route::post('member/delete/{memberId?}','MemberController@delete');
/*Route::post('member//{memberId?}', function () {
    echo "ok";die();
});*/

/*
|------------------------------------------------------------------------
| Routes Memberships
|------------------------------------------------------------------------
*/

Route::get('active_memberships', 'MembershipController@active_memberships');
Route::get('inactive_memberships', 'MembershipController@inactive_memberships');
Route::post('/membership/{memberId?}', 'MembershipController@store');

/*
|------------------------------------------------------------------------
| Routes MembershipTypes
|------------------------------------------------------------------------
*/

Route::get('membership_types_list', 'MembershipTypeController@membership_types_list');

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
    return View::make('login.login');
});

/*
|------------------------------------------------------------------------
| Routes Visitors
|------------------------------------------------------------------------
*/

Route::get('/visitors_list', function(){
	return View::make('visitors.visitors_list');
});

/*
|-------------------------------------------------------------------------
| Routes for cashbox
|-------------------------------------------------------------------------
*/

Route::get('/incomes', function(){
	return View::make('cashbox.income');
});

Route::get('/turner_cash', function(){
	return View::make('cashbox.cash_out');
});

Route::get('/outcomes', function(){
	return View::make('cashbox.expenses');
});

Route::get('/settings_turner_cash', function(){
	return View::make('cashbox.adjustments');
});

/*
|-------------------------------------------------------------------------
| Routes test
|-------------------------------------------------------------------------
*/

Route::get('/test', function(){
    /*$payments = DB::select('call payments()');
    foreach($payments as $payment) {
    }  */
        $memberId = 10;
        if($memberId == 0)
            $member = new Member();    
        else{
            $member = Member::find($memberId); 
            if($member == null){
                return Response::json(
                        array('succes'=>false,'errors'=>'member not found')
                );                
            }else{
                return Response::json(
                        array('succes'=>true)
                );                  
            }                
        }       
});