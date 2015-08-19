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
class MembershipTypeController extends BaseController {
    //put your code here
	 
    public function membership_types_list()
    {
        $membershipTypes = MembershipType::all();
        return View::make('membership_types.membership_types_list',['membershipTypes'=>$membershipTypes]);         
    }    
    
    public function get_membership_types()
    {
        return MembershipType::all();
    }
    
}
