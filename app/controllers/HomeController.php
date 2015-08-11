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
        $nfc_tarjet = NfcTarjet::where('code', '=', $input['code'])->first();
        if(!is_null($nfc_tarjet)){
            $membership = Membership::where('id', '=', $nfc_tarjet->membership_id)->first();
            if(!is_null($membership)){
               $member = Member::where('id', '=', $membership->member_id)->first();
               if(!is_null($member)){
                  if($membership->active == 1){
                      NotificationAxeso::where('band', 1)->update(['band' => 0]); 
                      $notification_axeso = new NotificationAxeso();
                      $notification_axeso->nfc_card = $input['code'];
                      $notification_axeso->band = 1;
                      $notification_axeso->save();
                      $mensaje = 'Bienvenido'.' '.$member->first_name;
                      return Response::json(array('message' => $mensaje));
                  }
                  if($membership->active == 0){
                      return Response::json(array('message' => 'Axeso denegado, verifique el estado de su membresia'));
                  }
               }
            }
        }
       else{
         return Response::json(array('message' => 'Axeso denegado, no hay membresias asociadas a esta tarjeta'));
       }
    }

 public function check_notifications(){
   $notification_axeso = NotificationAxeso::whereBand(1)->first();
   if(!is_null($notification_axeso)){
      $notification_axeso->band = 0;
      $notification_axeso->save();
      $nfc_tarjet = NfcTarjet::where('code', '=', $notification_axeso->nfc_card)->first();
      if(!is_null($nfc_tarjet)){
         $membership = Membership::where('id', '=', $nfc_tarjet->membership_id)->first();
         if(!is_null($membership)){
            $member = Member::where('id', '=', $membership->member_id)->first();
            if(!is_null($member)){
               return Response::json($member);
            }
         }
      }
    }
  }
    
}
