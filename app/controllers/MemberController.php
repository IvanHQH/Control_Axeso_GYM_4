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
class MemberController extends BaseController{
    //put your code here
	 
    public function members_list()
    {
        $members = Member::all();
        return View::make('MembersList',['members'=>$members]);         
    }    
}
