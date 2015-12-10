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
        $memberships = DB::select('call active_member_ships('.true.','.Auth::user()->branch_office_id.')'); 
        return View::make('memberships.active_memberships',['activeMemberships'=>$memberships]);
    }    
    
    public function inactive_memberships()
    {
        $memberships = DB::select('call inactive_members('.Auth::user()->branch_office_id.')'); 
        return View::make('memberships.inactive_memberships',['inactiveMemberships'=>$memberships]);         
    }      
    
    public function expiring_memberships($params = "")
    {       
        $dt_init_aux = "";
        $dt_end_aux = "";
        try {
            $elemts = explode("+", $params);
            
            $init_dt = $elemts[0];                                
            $aux = explode("-", $init_dt);
            $dt_init_aux = $aux[0] . "-" . $aux[1] . "-" .$aux[2];            
            $init_dt = $init_dt." 00:00:00";     
            
            $end_dt = $elemts[1];                                
            $aux = explode("-", $end_dt);
            $dt_end_aux = $aux[0] . "-" . $aux[1] . "-" .$aux[2];            
            $end_dt = $end_dt." 23:59:59";                 
            
            $experingMemberships = DB::select("call expering_member_ships('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");  
        } catch (Exception $e) {
            $experingMemberships = DB::select("call expering_member_ships('0001-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
        }        
        return View::make('memberships.expiring_memberships',['experingMemberships'=>$experingMemberships,
            'date_init'=>$dt_init_aux,'date_end'=>$dt_end_aux]);          
    }
    
    public function membership_active($memberId = "")
    {
        $memsActive = DB::select('call member_with_membership_active('.$memberId.','.Auth::user()->branch_office_id.')');
        if(count($memsActive) > 0)
            return Response::json(array('member_active'=>true));
        return Response::json(array('member_active'=>false));
    }
    
    public function store($memberId)
    {
        $input = Input::All();
        
        $turnId = TurnUser::currentTurnId();
        if($turnId == null)
            return Response::json(array('success'=>false,
                'errors'=>'NO TURN'));        
        
        $validator = Validator::make(Input::all(),
            array(
                'inscripcion' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',  
		'descuento' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',       
                'cantidad' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',     
                'cantidad_final' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',           
                'metodo_de_pago' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',
		'reference' => 'alpha_num',
                'concepto' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',
                'tipo_de_membresia' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',
                'fecha_de_inicio' => 'required|date'
            )
        );        
        if ($validator->fails())
                return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));         
        
        $input['memberId'] = $memberId;  
        $input['branch_office_id'] = Auth::user()->branch_office_id;
        $input['turn_user_id'] = TurnUser::currentTurnId();
        $input['date'] = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
        $input['user_id'] = Auth::user()->id;
	$input['membership_type'] = MembershipType::where('name',$input['tipo_de_membresia'])->where('branch_office_id',Auth::user()->branch_office_id)->first();
        
        //DB::transaction(function($input) use ($input) {                             
           $membershipType = $input['membership_type'];     
           $payment = new Payment();
           $payment->member_id = $input['memberId'];
           $payment->amount = $input['cantidad'];
           $payment->method_payment = $input['metodo_de_pago'];
           $payment->concept = $input['concepto'];
           $payment->turn_user_id = $input['turn_user_id'];
           $payment->created_at = $input['date'];                                    
           
           $membership = new Membership();
           $membership->branch_office_id = $input['branch_office_id']; 
           $membership->member_id = $input['memberId'];
           $membership->debt = floatval($input['cantidad_final']) - floatval($input['cantidad']);
           $membership->paid = $input['cantidad'];
           //$membership->created_at = $input['start'];
           $membership->start_period = $input['fecha_de_inicio'];
           $membership->turn_user_id = $turnId;           
           
            $memberships = DB::select("call member_with_memberships(".$input['memberId'].",".Auth::user()->branch_office_id.")");
            if(count($memberships) == 0 ){
                $member = Member::find($input['memberId']);
                if($member != null){
                    $member->member_since = $input['fecha_de_inicio'];
                    $member->save();
                }
            }           
           
           if($membershipType != null){                      
                $membership->membership_type_id = $membershipType->id;
                $membership->start = $input['fecha_de_inicio'];
                $membership->user_id = $input['user_id'];
                
                $fecha = date_create($input['fecha_de_inicio']);
                $period = $membershipType->duration . " days";    
                date_add($fecha, date_interval_create_from_date_string($period));
                $membership->end_period = date_format($fecha, 'Y-m-d H:m:s');                
                
                $membership->save();
                $payment->reference_id = $membership->id;
                $payment->save();  
                if($input['inscripcion'] != 0){
                    $payment = new Payment();
                    $payment->member_id = $input['memberId'];
                    $payment->amount = $input['inscripcion'];
                    $payment->method_payment = $input['metodo_de_pago'];
                    $payment->concept = 'INSCRIPCION';
                    $payment->turn_user_id = $input['turn_user_id'];
                    //$payment->created_at = $input['start'];  
                    $payment->reference_id = $membership->id;
                    $payment->save();                      
                }                                
                
                return Response::json(array('success' => true));                           
           }           
        //});      
        
        return Response::json(array(
            'error' => true
        ));                               
    }       
    
}
