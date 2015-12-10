<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Arellano
 */
class Membership extends BaseModel{
    //put your code here
    
    public function end_period($date,$memshipTypeId){
        $memshipType = MembershipType::find($memshipTypeId);
        $period = $memshipType->duration + " days";
        
    }
    
}
