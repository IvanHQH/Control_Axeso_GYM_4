<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MembersController
 *
 * @author Arellano
 */
class MembershipController extends BaseController{
    //put your code here
	 
    public function active_memberships()
    {
        $memberships = DB::select('call active_member_ships('.true.',1)'); 
        return View::make('memberships.active_memberships',['activeMemberships'=>$memberships]);
    }    
    
    public function inactive_memberships()
    {
        $memberships = DB::select('call inactive_members(1)'); 
        return View::make('memberships.inactive_memberships',['inactiveMemberships'=>$memberships]);         
    }      
    
    public function store($memberId)
    {
        $input = Input::All();
        $input['memberId'] = $memberId;        
        
        DB::transaction(function($input) use ($input) {                             
            
           $payment = new Payment();
           $payment->member_id = $input['memberId'];
           $payment->amount = $input['amount'];
           $payment->method_payment = $input['method_payment'];
           $payment->concept = $input['concept'];
           //$payment->user_id = Auth::user()->id;
           $payment->user_id = 1;
           $payment->save();                                                               
           
           $membership = new Membership();
           $membership->branch_office_id = 1; 
           $membership->member_id = $input['memberId'];
           $membership->paid = $input['amount'];
           $membershipType = MembershipType::where('name',$input['membership_type'])->get();                      
           
           if(count($membershipType) > 0){                                                                   
                $membership->membership_type_id = $membershipType[0]->id;
                $membership->start = $input['start'];
                $membership->active = 1;
                $membership->save();
                return Response::json(array(
                        'success' => true                   
                ));                           
           }           
        });        
        
        return Response::json(array(
            'error' => true
        ));                               
    }
    
    
}
