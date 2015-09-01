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
    
    public function store($membershipTypeId)
    {
        /*$fecha = DateTime::createFromFormat('Y-m-d', $input['available_until']);
        $membershipType->available_until =  $fecha->format('Y-m-d H:i:s');  */
        $input = Input::All();
        $membershipType = null;
        if($membershipTypeId == 0)
            $membershipType = new MembershipType();        
        else{
            $membershipType = MembershipType::find($membershipTypeId);        
            if($membershipType == null){
                return Response::json(
                        array('succes'=>false,'errors'=>'membership type not found')
                );                
            }   
        }            
        $membershipType->name = $input['name'];                                  
        $membershipType->available_until= $input['available_until'];                                                     
        $membershipType->price= $input['price'];         
        $membershipType->duration= $input['duration'];
        
        /*
            $fecha = DateTime::createFromFormat('Y-m-d', '2015-08-14');
            echo $fecha->format('Y-m-d H:i:s');      
            echo date("Y-m-d H:i:s");  
         */
        //$fecha = DateTime::createFromFormat('d-m-Y', date("Y-m-d H:i:s"));
        /*$now = date('d-m-Y');
        $date = $input['available_until'];
        if(strtotime($date)<strtotime($now))
           echo '1 is small='.strtotime($date1).','.$date1;
        else
           echo '2 is small='.strtotime($date2).','.$date2;  */      
        
        $membershipType->save(); 
        return Response::json(array('success'=>true));                
    }    
    
    public function delete($membeshipTypeId)
    {
        $membershipType = MembershipType::find($membeshipTypeId);
        if($membershipType != null){
            $membershipType->delete();
            return Response::json(
                    array('success'=>true)
            );            
        }
        return Response::json(
                array('success'=>false,'errors'=>'membership type not found')
        );
    }
    
    public function get($membeshipTypeId)
    {
        $membershipType = MembershipType::find($membeshipTypeId);
        if($membershipType != null){
            return Response::json(
                    array('success'=>true, 'membership_type'=>$membershipType)
            );            
        }
        return Response::json(
                array('success'=>false,'errors'=>'membership type not found')
        );
    }    
    
    public function available_memberships_types()
    {
        $membershipTypesAvailabes = DB::select('call membershyp_types_availables(true)'); 
        return View::make('membership_types.available_memberships_types',
            ['membershipTypesAvailabes'=>$membershipTypesAvailabes]);
    }

    public function unavailable_memberships_types()
    {
        $membershipTypesUnavailabes = DB::select('call membershyp_types_availables(false)'); 
        return View::make('membership_types.unavailable_memberships_types',
            ['membershipTypesUnavailabes'=>$membershipTypesUnavailabes]);     
    }    
    
}
