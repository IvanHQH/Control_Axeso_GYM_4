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
class MembershipTypeController {
    //put your code here
	 
    public function index()
    {
        return View::make('MembershipTypesList');         
    }    
}
