<?php

class HomeController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function test()
    {
        $members = Member::all();
        echo $members[0]->name;
        die();
    }
    
    public function showWelcome()
    {
            return View::make('hello');
    }

    public function memberships_types_list()
    {
        return View::make('MembershipTypesList'); 
    }

    public function available_memberships_types()
    {
        return View::make('AvailableMembershipsTypes');             
    }

    public function unavailable_memberships_types()
    {
        return View::make('UnavailableMembershipsTypes');             
    }

    public function active_memberships()
    {
        return View::make('ActiveMemberships');             
    }        

    public function inactive_memberships()
    {
        return View::make('InactiveMemberships');             
    }    

    public function expiring_memberships()
    {
        return View::make('ExpiringMemberships');             
    }    

    public function memberships_sold()
    {
        return View::make('MembershipsSold');             
    }    

    public function memberships_paymets()
    {
        return View::make('MembershipsPaymets');             
    }    
    
    public function members_list()
    {
        return View::make('MembersList');
    }                 
    
    public function validate_membership()
    {
        $input = Input::All();
        $validate = DB::select('call validate_membership('.$input['code'].')'); 
        if(count($validate) > 0)
        {
            $validate = $validate[0];
            return Response::json($validate);
        }
        return Response::json(array('full_name' => 'null','active'=>'null'));
    }
    
}
