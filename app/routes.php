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
| Routes Login
|------------------------------------------------------------------------
*/

Route::get('', function(){
    return View::make('login.login');
});

Route::get('login', function(){
    return View::make('login.login');
});

Route::get('logout',  function () { 
    Auth::logout();
    return Redirect::to('login');      
});

Route::post('post_login','MethodsConstantsController@login');

Route::get('profile', array('as' => 'profile', function () { })); 


Route::group(array('before' => 'auth'), function()
    {       


    /*
    |------------------------------------------------------------------------
    | Routes Members
    |------------------------------------------------------------------------
    */

    Route::get('members_list', 'MemberController@members_list');
    Route::get('member/info_payment_wizard/{id}', 'MemberController@info_payment_wizard');
    Route::get('member/info_membership_wizard/{id}', 'MemberController@info_membership_wizard');
    Route::post('member/{memberId?}','MemberController@store');
    Route::post('validate_fields_member','MemberController@validate_fields_member');
    Route::post('member/delete/{memberId}','MemberController@delete');
    Route::get('member/{memberId}','MemberController@get');
    Route::get('member/quick_search/{ident}','MemberController@get_quick_search');
    Route::get('member/assists_last/{ident}','MemberController@get_assists_last');
    Route::get('member/notes/{memberId}','MemberController@get_notes');
    Route::get('member/info_assistance/{ident}','MemberController@get_info_assistance');
    Route::get('member/membership_active/{memberId}','MemberController@get_membership_active');
    Route::get('member/pause_membership/{memberId}','MemberController@pause_membership');
    Route::get('member/memberships_paused/{memberId}','MemberController@get_memberships_paused');
    Route::get('membership_unpauses/{membershipId}','MemberController@membership_unpauses');
    Route::post('member/photo/{membershipId}','MemberController@upload_photo');

    /*
    |------------------------------------------------------------------------
    | Routes Memberships
    |------------------------------------------------------------------------
    */

    Route::get('active_memberships', 'MembershipController@active_memberships');
    Route::get('inactive_memberships', 'MembershipController@inactive_memberships');
    Route::post('membership/{memberId?}', 'MembershipController@store');
    Route::get('expiring_memberships/{params?}', 'MembershipController@expiring_memberships');
    Route::get('membership_active/{memberId?}', 'MembershipController@membership_active');

    /*
    |------------------------------------------------------------------------
    | Routes MembershipTypes
    |------------------------------------------------------------------------
    */

    Route::get('membership_types_list', 'MembershipTypeController@membership_types_list');
    Route::post('membership_type/{membershipTypeId?}','MembershipTypeController@store');
    Route::post('membership_type/delete/{membeshipTypeId}','MembershipTypeController@delete');
    Route::get('membership_type/{membeshipTypeId}','MembershipTypeController@get');
    Route::get('membership_type_for_name/{name}','MembershipTypeController@get_for_name');

    Route::get('available_memberships_types', 'MembershipTypeController@available_memberships_types');
    Route::get('unavailable_memberships_types', 'MembershipTypeController@unavailable_memberships_types');

    /*
    |------------------------------------------------------------------------
    | Routes Payments
    |------------------------------------------------------------------------
    */

    Route::get('memberships_paymets/{params?}', 'PaymentController@payments_list');
    Route::post('payment/{memberId?}', 'PaymentController@store');
    Route::post('payment/edit/{paymentId?}', 'PaymentController@store_edit');
    Route::get('payment/{paymentId}','PaymentController@get');
    Route::post('payment/delete/{paymentId}','PaymentController@delete');

    /*
    |------------------------------------------------------------------------
    | Routes Home
    |------------------------------------------------------------------------
    */

    Route::get('quick_search', 'HomeController@quick_search');  

    /*
    |------------------------------------------------------------------------
    | Routes Visitors
    |------------------------------------------------------------------------
    */

    Route::get('visitors_list/{params?}','VisitorController@visitors_list');
    Route::post('visitor/{visitorId?}', 'VisitorController@store');
    Route::get('visitor/{visitorId}','VisitorController@get');
    Route::post('visitor/delete/{visitorId}','VisitorController@delete');

    /*
    |-------------------------------------------------------------------------
    | Routes for cashbox
    |-------------------------------------------------------------------------
    */

    Route::get('incomes/{params?}','IncomeMController@incoms_list');
    Route::post('income_ms','IncomeMController@store');
    Route::get('income/{incomeId}','IncomeMController@get');
    Route::post('income_ms/delete/{incomeId}','IncomeMController@delete');

    Route::get('outcomes/{params?}','OutcomeMController@outcoms_list');
    Route::post('outcome_ms','OutcomeMController@store');
    Route::get('outcome/{outcomeId}','OutcomeMController@get');
    Route::post('outcome_ms/delete/{outcomeId}','OutcomeMController@delete');

    Route::get('close_box','TurnUserController@close_box');

    /*
    |------------------------------------------------------------------------
    | Routes Turn Users
    |------------------------------------------------------------------------
    */

    Route::get('turn_users', 'TurnUserController@turn_users_list');
    Route::get('turn_user/{turnUserId}', 'TurnUserController@turn_user_detail');
    Route::get('turner_cash','TurnUserController@summary_boxcut');
    Route::post('turn_user/create','TurnUserController@store');
    Route::get('close_turn_user/{amount}','TurnUserController@close_turn_user');
    Route::get('create_new_turn/{amount}','TurnUserController@create');

    /*
    |-------------------------------------------------------------------------
    | Routes Assits
    |-------------------------------------------------------------------------
    */

    Route::post('assist/{memberId}','AssistController@store');
    Route::get('assists_list/{params?}','AssistController@assists_list');
    Route::post('assist/delete/{assistId}','AssistController@delete');

    /*
    |------------------------------------------------------------------------
    | Routes Products
    |------------------------------------------------------------------------
    */

    Route::get('products_list', 'ProductController@products_list');
    Route::post('product/{productId?}','ProductController@store');
    Route::post('product/delete/{productId}','ProductController@delete');    
    Route::get('product/{productId?}','ProductController@get');    
    Route::get('product_find/{productId}','ProductController@get_find');    
    
    }      
);

/*
|------------------------------------------------------------------------
| Routes Notes
|------------------------------------------------------------------------
*/

Route::post('note','NoteController@store');

/*
|------------------------------------------------------------------------
| Routes Payment Notification
|------------------------------------------------------------------------
*/

Route::post('record_card_payment', 'NotificationPaymentController@record_card_payment');
Route::get('get_code_payment_nfc', 'NotificationPaymentController@get_code_payment_nfc');
Route::post('reset_record_card_payment', 'NotificationPaymentController@reset_record_card_payment');

/*
|-------------------------------------------------------------------------
| Routes Methods & Constants
|-------------------------------------------------------------------------
*/

Route::post('validate_member', 'MethodsConstantsController@validate_member');
Route::post('validate_membership', 'MethodsConstantsController@validate_membership');
Route::get('check_notifications', 'MethodsConstantsController@check_notifications');
Route::post('linkup_nfc','MethodsConstantsController@linkup_nfc');
Route::post('check_payment_nfc','MethodsConstantsController@check_payment_nfc');
//check_payment_nfc

Route::post('get_memberships','MemberController@get_memberships');
Route::post('payment_nfc','MemberController@payment_nfc');

/*
|-------------------------------------------------------------------------
| Routes Others
|-------------------------------------------------------------------------
*/
Route::post('get_member','MemberController@get_post');
/*
|-------------------------------------------------------------------------
| Routes test
|-------------------------------------------------------------------------
*/

Route::get('date_time_now','MethodsConstantsController@dateTimeNow');

Route::get('test', function(){
    echo "ok";die();
});