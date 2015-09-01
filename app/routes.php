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
Route::get('member/quick_search/{ident}','MemberController@get_quick_search');
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
Route::post('membership_type/{membershipTypeId?}','MembershipTypeController@store');
Route::delete('membership_type/{membeshipTypeId}','MembershipTypeController@delete');
Route::get('membership_type/{membeshipTypeId}','MembershipTypeController@get');

Route::get('available_memberships_types', 'MembershipTypeController@available_memberships_types');
Route::get('unavailable_memberships_types', 'MembershipTypeController@unavailable_memberships_types');

/*
|------------------------------------------------------------------------
| Routes Payments
|------------------------------------------------------------------------
*/

Route::get('memberships_paymets', 'PaymentController@payments_list');
Route::post('/payment/{memberId?}', 'PaymentController@store');
Route::post('/payment/edit/{paymentId?}', 'PaymentController@store_edit');
Route::get('payment/{paymentId}','PaymentController@get');
Route::delete('payment/{paymentId}','PaymentController@delete');

/*
|------------------------------------------------------------------------
| Routes Home
|------------------------------------------------------------------------
*/

Route::post('validate_membership', 'HomeController@validate_membership');
Route::get('/check_notifications_axeso', 'HomeController@check_notifications');
Route::get('expiring_memberships', 'HomeController@expiring_memberships');
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
    //return "ok";
    //echo date_format("2015-08-14", 'Y-m-d');    
    /*$fecha = DateTime::createFromFormat('Y-m-d', '2015-08-14');
    echo $fecha->format('Y-m-d H:i:s');  */    
    //echo date("Y-m-d H:i:s");  now
    //$membershipTypesAvailabes = DB::select('call membershyp_types_availables(false)'); 
    //echo count($membershipTypesAvailabes);
    /*$dateTimes = DB::select('call assists_last(1,1)');
    $dateTimesArray = array();
    foreach($dateTimes as $dateTime)
    {
        $dtt = explode(" ", $dateTime->entrance);     
        $dtt2 = explode("-", $dtt[1]);
        $array = array('name_day'=>$dtt[0],'number_day'=>$dtt2[0],'month'=>$dtt2[1],'year'=>$dtt2[2],'time'=>$dtt[2]);
        array_push($dateTimesArray, $array);
    }
    return Response::json($dateTimesArray);    */     
});