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
        $res['memberships'] = DB::select('call member_with_membership_active('.$id.','.Auth::user()->branch_office_id.')');  
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
                'errors' => 'Socio no encontrado'
        ));        
    }
    
    public function get_quick_search($ident)
    {         
        //$mem = Member::find($memberId);
        $mem = $this->foundMember($ident);
        if( $mem == null ){            
            return Response::json(array(                
                'success' => false,
                'errors' => 'Socio no encontrado'                                
            ));             
        }   
        $memberId = $mem->id;
        $idBranchOffice = Auth::user()->branch_office_id;
        $member = array();
        $member['img_member'] = Member::pathPhoto($memberId);                        
        $member['txt_main'] = $mem->first_name." ".$mem->last_name." ".$mem->second_last_name;
        $member['assists_last'] = MethodsConstants::datesTimesStrEnglishToEspanishArray(
                DB::select('call assists_last('.$memberId.','.$idBranchOffice.')'));
        $member['memberships'] = $this->dateTimeFormatMemberships(
                DB::select('call member_with_membership_active('.$memberId.','.$idBranchOffice.')'));
        $member['notes'] = 'notes';                              
        return Response::json(array(
            'success' => true,
            'member' => $member
        ));                              
    }
    
    public function get_assists_last($memberId)
    {
        $mem = $this->foundMember($memberId);
        if( $mem == null ){            
            return Response::json(array(                
                'success' => false,
                'errors' => 'Socio no encontrado'                                
            ));             
        }           
        $member = array();
        $member['assists_last'] = MethodsConstants::datesTimesStrEnglishToEspanishArray(
                DB::select('call assists_last('.$memberId.','.Auth::user()->branch_office_id.')'));          
        return Response::json(array(
            'success' => true,
            'member' => $member
        ));            
    }

    /*
     * Found member for id or part of the full name
     */
    private function foundMember($ident)
    {
        $member = Member::find($ident);
        if( $member == null ){            
            $member = Member::whereIn('first_name', [$ident])->first();
            if( $member == null ){  
                $member = Member::whereIn('last_name', [$ident])->first();
                if( $member == null )
                    $member = Member::whereIn('second_last_name', [$ident])->first();
            }
        }        
        return $member;
        /*if($member == null)
            return Response::json(array('success' => false,'errors' => 'Socio no encontrado'));             
        else
            return Response::json(array('success' => true,'member' => $member)); */           
    }
    
    private function dateTimeFormatMemberships($memberships)
    {
        $array = array();
        foreach($memberships as $member){
            $dtt = explode("-", $member->start);
            $aux = MethodsConstants::nameMonthEnglishToEspanish($dtt[1]);
            $member->start = $dtt[0] . "-" . $aux . "-" . $dtt[2];
            
            $dtt = explode("-", $member->available_until);
            $aux = MethodsConstants::nameMonthEnglishToEspanish($dtt[1]);
            $member->available_until = $dtt[0] . "-" . $aux . "-" . $dtt[2]; 
            
            if($member->active == 1)
                $member->active  = "Activa";
            else
                $member->active  = "No Activa";
            array_push($array, $member);
        }
        return $array;
    }
    
}
