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
        $memberships = DB::select('call active_member_ships('.true.')'); 
        return View::make('ActiveMemberships',['activeMemberships'=>$memberships]);
    }    
    
    public function inactive_memberships()
    {
        $memberships = DB::select('call inactive_members(1)'); 
        return View::make('InactiveMemberships',['inactiveMemberships'=>$memberships]);         
    }      
}
