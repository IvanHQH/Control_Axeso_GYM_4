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

    var $path = 'C:\xampp\htdocs\crm_gym\public\img';
    
    public function members_list()
    {
        $members = DB::select('call members('.Auth::user()->branch_office_id.')');
        return View::make('members.members_list',['members'=>$members]);         
    }
    
    public function info_payment_wizard($id)
    {
        $res = array();       
        $res['memberships'] = DB::select('call member_with_memberships('.$id.','.Auth::user()->branch_office_id.')');
        $res = array_merge(Member::find($id)->toArray(),$res); 
        $res['debts'] = DB::select('call member_debts('.$id.','.Auth::user()->branch_office_id.')');  
        return Response::json($res);
    }    
    
    public function info_membership_wizard($id)
    {
        $res = array();       
        $res['membership_types'] = DB::select('call membershyp_types_availables('.true.','.Auth::user()->branch_office_id.')');//MembershipType::All();  
        $res = array_merge(Member::find($id)->toArray(),$res); 
        return Response::json($res);
    }        
    
    public function store($memberId)
    {
        $input = Input::All();
        
        $validator = Validator::make(Input::all(),
            array(
                'nombre' => 'required|regex:([a-zA-Z ραινσϊ]{1,30})',
                'apellido_paterno' => 'required|regex:([a-zA-Z ραινσϊ]{1,30})',
                'apellido_materno' => 'regex:([a-zA-Z ραινσϊ]{1,30})', 
                'nombre_de_usuario' => 'required|required|regex:([a-zA-Z .ραινσϊ]{1,30})',
                'sexo' => 'required|in:Masculino,Femenino',
                'estado' => 'required|regex:([a-zA-Z ραινσϊ]{1,30})',
                'ciudad'=> 'required|regex:([a-zA-Z ραινσϊ]{1,30})',          
                'fecha_de_nacimiento' => 'date',
                'socio_desde' => 'date',
                //member_address
                //member_neighborhood
                'contrasena' => 'regex:([0-9a-zA-Z ραινσϊ]{1,30})',
                'codigo_postal' => 'numeric',
                'telefono_de_casa' => 'regex:(\d{3}-\d-\d{2}-\d{2}-\d{2})' ,//example : 123-12-1234567-1
                'telefono_celular' => 'regex:(\d{2}-\d{2}-\d{2}-\d{2}-\d{2})',//example : 044-44-41-78-84-04
                'correo' => 'email',
                'compania' => 'regex:([a-zA-Z ραινσϊ]{1,30})'//,
                //'job' => 'regex:([a-zA-Z0-9\(\) ραινσϊ]2,30})'
            )
        );        
        if ($validator->fails()){
            return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));
            //return Redirect::back()->withErrors($validator->errors());
        }
        
        $member = null;    

        if($memberId == 0)
            $member = new Member();    
        else{
            $member = Member::find($memberId); 
            if($member == null){
                return Response::json(array('success'=>false,'errors'=>'Socio no encontrado'));                
            }                
        }                       
        try{
            $member->branch_office_id = Auth::user()->branch_office_id;
            $member->first_name = $input['nombre'];       
            $member->last_name = $input['apellido_paterno']; 
            if (isset($input['contrasena']))
                $member->password = $input['contrasena'];             
            if (isset($input['apellido_materno']))
                $member->second_last_name = $input['apellido_materno'];  
            $member->nickname = $input['nombre_de_usuario'];    
            $member->sex = $input['sexo'];  
            if (isset($input['fecha_de_nacimiento']))
                $member->date_birth = $input['fecha_de_nacimiento'];                                       
            $member->member_since = $input['socio_desde'];
            if (isset($input['member_address']))
                $member->address = $input['member_address']; 
            if (isset($input['member_neighborhood']))
                $member->neighborhood = $input['member_neighborhood'];  
            $member->town = $input['estado'];          
            $member->city = $input['ciudad'];         
            if (isset($input['codigo_postal']))
                $member->postal_code = $input['codigo_postal'];
            if (isset($input['telefono_de_casa']))
                $member->home_phone = $input['telefono_de_casa']; 
            if (isset($input['telefono_celular']))        
                $member->cell_phone = $input['telefono_celular'];   

            if (isset($input['member_emergency_phone']))        
                $member->emergency_phone = $input['member_emergency_phone'];          

            if (isset($input['correo']))        
                $member->email = $input['correo']; 
            if (isset($input['compania']))        
                $member->company = $input['compania'];
            if (isset($input['member_job']))        
                $member->job = $input['member_job'];     
            $member->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));        

            $member->save();

            if(Input::hasFile('archivo')) {
                if (Input::file('archivo')->isValid()){ 
                   $file = $member->id.'.'.Input::file('archivo')->getClientOriginalExtension();
                   Input::file('archivo')->move($this->path,$file);            
                }             
            }                         
            
            return Response::json(array('success'=>true));
        }  
        catch (Exception $e)
        {
            return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
        }
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
            //chnage format to Y-m-d for can fill input type date
            $aux = explode(" ", $member->date_birth);
            $aux = explode("-", $aux[0]);
            $member->date_birth = $aux[0] . '-' . $aux[1] . '-' . $aux[2];
            
            $aux = explode(" ", $member->member_since);
            $aux = explode("-", $aux[0]);
            $member->member_since = $aux[0] . '-' . $aux[1] . '-' . $aux[2];            
            //
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
    
    public function get_post()
    {
        
        $input = Input::All();
        $member = Member::where('id',$input['member_id'])->where('branch_office_id',$input['branch_office_id'])->first();
        if( $member != null ){
            $aux = explode(" ", $member->date_birth);
            $aux = explode("-", $aux[0]);
            $member->date_birth = $aux[0] . '-' . $aux[1] . '-' . $aux[2];
            
            $aux = explode(" ", $member->member_since);
            $aux = explode("-", $aux[0]);
            $member->member_since = $aux[0] . '-' . $aux[1] . '-' . $aux[2];            
            //
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
            return Response::json(array('success' => false,'errors' => 'Socio no encontrado'));
        }   
        if(count($mem) > 1){
            return Response::json(array('success' => false,'members' => $mem));
        }

        $memberId = $mem->id;
        $idBranchOffice = Auth::user()->branch_office_id;
        $member = array();
        $member['member_id'] = $memberId;
        $member['img_member'] = Member::pathPhoto($memberId);         
               
        $member['txt_main'] = "<table class='table'>"
                . "<tr><td>Id</td>"
                    . "<td>".$mem->id."</td></tr>"
                . "<tr><td>Nombre de usuario</td>"
                    . "<td>".$mem->nickname."</td></tr>"
                . "<tr><td>Nombre</td>"
                    . "<td>".$mem->first_name." ".$mem->last_name." ".$mem->second_last_name."</td></tr>"
                . "<tr><td>Tel&eacute;fono mov&iacute;l</td>"
                    . "<td>".$mem->cell_phone."</td></tr>"
                . "</table>";

        $member['assists_last'] = MethodsConstants::datesTimesStrEnglishToEspanishArray(
                DB::select('call assists_last('.$memberId.','.$idBranchOffice.')'));
        $member['memberships'] = $this->dateTimeFormatMemberships(
                DB::select('call member_with_membership_active('.$memberId.','.$idBranchOffice.')'));
        $member['notes'] = DB::select('call member_notes('.$memberId.','.$idBranchOffice.')');
        $member['payments'] = DB::select('call member_payments('.$memberId.','.$idBranchOffice.')');

        return Response::json(array('success' => true,'member' => $member));                              
    }
    
    public function get_membership_active($memberId)
    {
        $memberships = $this->dateTimeFormatMemberships(
                DB::select('call member_with_membership_active('.$memberId.','.Auth::user()->branch_office_id.')'));        
        return Response::json(array(
            'success' => true,
            'memberships' => $memberships
        ));          
    }
    
    public function get_info_assistance($memberId)
    {         
        //$mem = Member::find($memberId);
        $mem = Member::find($memberId);
        if( $mem == null ){            
            return Response::json(array(                
                'success' => false,
                'errors' => 'Socio no encontrado'                                
            ));             
        }   
        $idBranchOffice = Auth::user()->branch_office_id;
        $member = array();
        $member['member_id'] = $memberId;
        $member['img_member'] = Member::pathPhoto($memberId);                        
        $member['full_name'] = $mem->first_name." ".$mem->last_name." ".$mem->second_last_name;
        $member['member_since'] =substr($mem->member_since,0,10);
        
        
        $member['last_assistance'] = MethodsConstants::datesTimesStrEnglishToEspanishArray(
                DB::select('call assists_last('.$memberId.','.$idBranchOffice.')'));        
        if(count($member['last_assistance'])>0)
            $member['last_assistance'] = $member['last_assistance'][0];
        else $member['last_assistance'] = null;        
        
        
        $member['membership'] = $this->dateTimeFormatMemberships(
                DB::select('call member_with_membership_active('.$memberId.','.$idBranchOffice.')'));
        if(count($member['membership'])>0)
            $member['membership'] = $member['membership'][0];
        else $member['membership'] = null;
        
        
        $member['note'] = DB::select('call member_notes('.$memberId.','.$idBranchOffice.')');        
        if(count($member['note'])>0){
            $member['note'] = 'hola';//$member['note'][0];
        }
        else $member['note'] = null;        
        
        $member['debt'] = DB::select('call member_debts('.$memberId.','.Auth::user()->branch_office_id.')');
        
        $totalDebt = 0;
        foreach($member['debt'] as $debt)
            $totalDebt = $totalDebt + $debt->debt; 
        
        $member['debt'] = $totalDebt;
            
        return Response::json(array(
            'success' => true,
            'member' => $member
        ));                              
    }    
    
    public function get_notes($memberId)
    {
        $notes = DB::select('call member_notes('.$memberId.','.Auth::user()->branch_office_id.')');        
        return Response::json(array(
            'success' => true,
            'notes' => $notes
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
    
    public function get_memberships()
    {
        $input = Input::All();
        $memberships = DB::select('call member_with_all_membership_active('.$input['idMember'].')');        
        if(!isset($memberships)){
            return Response::json(array('memberships' => 'NULL'));
        } 
        return Response::json(array('memberships' => $memberships));
    }    
    
    /*
     * Found member for id or part of the full name
     */
    private function foundMember($ident)
    {
        $member = Member::find($ident);
        if( $member == null ){         
	    $members = Member::whereIn('first_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->get();
	    if(count($members) > 1)
	    	return $members; 

	    $members = Member::whereIn('last_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->get();
	    if(count($members) > 1)
	    	return $members; 

	    $members = Member::whereIn('second_last_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->get();
	    if(count($members) > 1)
	    	return $members;             
            
            $member = Member::whereIn('first_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->first();
            if( $member == null ){  
                $member = Member::whereIn('last_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->first();
                if( $member == null ){
                    $member = Member::whereIn('second_last_name', [$ident])->where('branch_office_id', Auth::user()->branch_office_id)->first();
                }
            }
        }        
        return $member;
    }
    
    private function dateTimeFormatMemberships($memberships)
    {
        $array = array();
        foreach($memberships as $member){
            $dtt = explode("-", $member->start);
            $aux = MethodsConstants::nameMonthEnglishToEspanish($dtt[1]);
            $member->start = $dtt[0] . "-" . $aux . "-" . $dtt[2];
            
            $dtt = explode("-", $member->start_period);
            $aux = MethodsConstants::nameMonthEnglishToEspanish($dtt[1]);
            $member->start_period = $dtt[0] . "-" . $aux . "-" . $dtt[2]; 
            
            $dtt = explode("-", $member->end_period);
            $aux = MethodsConstants::nameMonthEnglishToEspanish($dtt[1]);
            $member->end_period = $dtt[0] . "-" . $aux . "-" . $dtt[2];             
            
            array_push($array, $member);
        }
        return $array;
    }    

    public function pause_membership($memberId){
        $memberships = DB::select('call member_with_all_membership_active('.$memberId.')');
        if(count($memberships)>0){
            try{
                $membership = $memberships[0];
	    	$membership = Membership::find($membership->membership_id);
                $membership->pause_period = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
                $membership->end_period = "0000-00-00 00:00:00";
                $membership->save();              
                return Response::json(array('success'=>true));
            }  catch (Exception $e){
                return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
            }
        }        
    }
    
    public function get_memberships_paused($memberId){
        $res = array();       
        $res['memberships'] = DB::select('call member_with_memberships_paused('.$memberId.','.Auth::user()->branch_office_id.')');
        return Response::json($res);        
    }
    
    public function membership_unpauses($membershipId){
        $membership = Membership::find($membershipId);
        if($membership != null){
            try{                                
                $start = date_create($membership->start_period);
                $pause = date_create($membership->pause_period);		
                
                $used = date_diff($start, $pause);
                $usedDays = $used->format('%a');

                $membershipType = MembershipType::find($membership->membership_type_id);
                $remainingDays = intval($membershipType->duration) - intval($usedDays);               

                $newEnd = date_create(date("Y-m-d H:i:s"));
                date_add($newEnd, date_interval_create_from_date_string($remainingDays.' days'));
                
                $membership->end_period = date_format($newEnd, 'Y-m-d H:i:s');
                $membership->pause_period = null;
                $membership->save();              
                return Response::json(array('success'=>true,'membership_type'=>$membershipType,'membership'=>$membership));
            }  catch (Exception $e){
                return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
            }
        }         
    }

    public function upload_photo($memberId){
        if(Input::hasFile('archivo')) {
            if (Input::file('archivo')->isValid()){ 
               $file = $memberId.'.'.Input::file('archivo')->getClientOriginalExtension();
               Input::file('archivo')->move($this->path,$file);            
            }             
        }          
        return Redirect::back();
    }
    
}
