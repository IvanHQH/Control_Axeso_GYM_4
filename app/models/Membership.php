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
    public function setIsActiveMembership()
    {
        $memt = MembershipType::find($this->membership_type_id);
        if($memt != null){
            $fecha = date_create($this->created_at);
            date_add($fecha, date_interval_create_from_date_string($memt->duration.' days'));
            
            $expiration = date_create($fecha);
            $availableUntil = date_create($memt->available_until);
            
            if($expiration < $availableUntil ){
                $this->active = 0;
                return false;
            }else{
                $this->active = 1;
                return true;
            }               
        }
        return false;
    }
}
