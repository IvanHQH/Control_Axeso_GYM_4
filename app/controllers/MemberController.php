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
        return View::make('members.members_list',['members'=>$members]);         
    }
    
    public function info_payment_wizard($id)
    {
        $res = array();       
        $res['memberships'] = DB::select('call member_with_membership_active('.$id.')');  
        $res = array_merge(Member::find($id)->toArray(),$res); 
        return Response::json($res);
    }    
    
    public function info_membership_wizard($id)
    {
        $res = array();       
        $res['membership_types'] = MembershipType::All();  
        $res = array_merge(Member::find($id)->toArray(),$res); 
        return Response::json($res);
    }        
    
    public function store($memberId)
    {
        $input = Input::All();
        
        $member = null;    
        
        if($memberId == 0)
            $member = new Member();    
        else{
            $member = Member::find($memberId); 
            if($member == null){
                return Response::json(
                        array('succes'=>false,'errors'=>'member not found')
                );                
            }                
        }        
        
        $member->first_name = $input['first_name'];        
        $member->last_name = $input['last_name']; 
        if (isset($input['second_last_name']))
            $member->second_last_name = $input['second_last_name'];  
        $member->nickname = $input['nickname'];    
        $member->sex = $input['sex'];  
        if (isset($input['date_birth']))
            $member->date_birth = $input['date_birth'];                                       
        $member->member_since = $input['member_since'];
        if (isset($input['address']))
            $member->address = $input['address']; 
        if (isset($input['neighborhood']))
            $member->neighborhood = $input['neighborhood'];  
        $member->town = $input['town'];          
        $member->city = $input['city'];         
        if (isset($input['postal_code']))
            $member->postal_code = $input['postal_code'];
        if (isset($input['home_phone']))
            $member->home_phone = $input['home_phone']; 
        if (isset($input['cell_phone']))        
            $member->cell_phone = $input['cell_phone'];   
        if (isset($input['email']))        
            $member->email = $input['email']; 
        if (isset($input['company']))        
            $member->company = $input['company'];
        if (isset($input['job']))        
            $member->job = $input['job'];                              
        $member->save();
                     
        return Response::json(
                array('succes'=>true)
        );
    }
    
    public function delete($memberId)
    {
        $member = Member::find($memberId);
        if( count( $member) > 0 ){
            $member->delete();
            return Response::json(array(
                    'success' => true
            ));             
        }   
        return Response::json(array(
                'success' => false,
                'errors' => 'Socio no eliminado'
        ));           
    }
    
    public function get($memberId)
    {
        $member = Member::find($memberId);
        if( count( $member) > 0 ){
            
            return Response::json(array(
                    'success' => true,
                    'member' => $member
            ));             
        }   
        return Response::json(array(
                'success' => false,
                'errors' => 'Socio no eliminado'
        ));        
    }
    
}
