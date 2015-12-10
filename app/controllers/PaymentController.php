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
class PaymentController extends BaseController{
    //put your code here
	 
    public function payments_list($params = "")
    {        
        $elements = explode("+", $params);
        $init_dt = "";
        $end_dt = "";  
        $init_dt_aux = "";
        $end_dt_aux = "";                   
        
        try {
            $init_dt = $elements[0];
            $end_dt = $elements[1];                       
            
            $aux = explode("-", $init_dt);            
            
            $init_dt_aux = $aux[0] . "-" . $aux[1] . "-" .$aux[2];

            $aux = explode("-", $end_dt);
            $end_dt_aux = $aux[0] . "-" . $aux[1] . "-" .$aux[2];            
            
            $init_dt .= " 00:00:00";
            $end_dt .= " 23:59:59";              
            $payments = DB::select("call payments('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");  
        } catch (Exception $e) {
            $payments = DB::select("call payments('0000-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
        }
        
        return View::make('paymets.memberships_paymets',['payments'=>$payments,'date_init'=>$init_dt_aux,'date_end'=>$end_dt_aux]);         
    }    
    
    /**
    *post
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($memberId = 0)
    {                     

        //return Response::json(array('success'=>false,'errors'=>'bugs'));                
        $input = Input::All();
        $turnId = TurnUser::currentTurnId();
        if($turnId == null)
            return Response::json(array('success'=>false,'errors'=>'NO TURN')); 
        
        if($input['payment_type'] == 'Renovacion de membresia'){  
            $validator = Validator::make(Input::all(),
                array(
                    'descuento' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)', 
                    'cantidad' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',   
                    'cantidad_final' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',                
                    'metodo_de_pago_del_pago' => 'required|regex:([a-zA-Z ραινσϊ]{2,30})',
                    'concepto_del_pago' => 'required|regex:([a-zA-Z0-9 ραινσϊ]{2,30})',
                    'referencia_del_pago' => 'alpha_num',
                    'fecha_de_inicio' => 'date',
                    'membership_id' => 'integer'
                )
            );              
        }else{
            $validator = Validator::make(Input::all(),
                array(  
                    'cantidad_final' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',                
                    'metodo_de_pago_del_pago' => 'required|regex:([a-zA-Z ραινσϊ]{2,30})',
                    'concepto_del_pago' => 'required|regex:([a-zA-Z0-9 ραινσϊ]{2,30})',
                    'referencia_del_pago' => 'alpha_num',
                    'membership_id' => 'integer'
                )
            );              
        }       

        if ($validator->fails())
            return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));                    

        try{
            $input['memberId'] = $memberId;
            $payment = new Payment();        
            $payment->amount = $input['cantidad_final'];
            $payment->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $payment->member_id = $input['memberId'];        
            $payment->concept = $input['concepto_del_pago'];
            $payment->method_payment = $input['metodo_de_pago_del_pago'];     
            $payment->reference = $input['referencia_del_pago'];
            $payment->turn_user_id = TurnUser::currentTurnId();     
       
            if($input['payment_type'] == 'Renovacion de membresia'){         
                    $membership = Membership::find($input['membership_id']);  
                    $payment->reference_id = $membership->id;                            
                    $payment->save();                
                    $membershipType = MembershipType::find($membership->membership_type_id);                                                      

                    $dateEnd = new DateTime($membership->end_period);
                    $dateStart = new DateTime($membership->start_period);
                    $dateNowStr = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d ")."00:00:00");
                    $dateNow = date_create($dateNowStr);

                    $active = false;
                    if($dateEnd >= $dateNow && $dateStart <= $dateNow)
                        $active = true;                                            

                    if($active == false){    
                        if(strlen($input['fecha_de_inicio']) > 0)
                            $fecha = new DateTime(date($input['fecha_de_inicio'] . " 00:00:00"));                          
                        else
                            $fecha = new DateTime(MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s")));  
                    }
                    else
                        $fecha = new DateTime($membership->end_period);                          
                    $period = $membershipType->duration." days";                
                    date_add($fecha, date_interval_create_from_date_string($period)); 

                    $membership->end_period = date_format($fecha, 'Y-m-d H:m:s');    
                    
                    if($active == false)
                        if(strlen($input['fecha_de_inicio']) > 0)
                            $membership->start_period = $input['fecha_de_inicio'] . " 00:00:00";     
                        else    
                            $membership->start_period = date_format(new DateTime("now"), 'Y-m-d H:m:s');                      

                    $membership->debt =$membership->debt + (floatval($input['cantidad']) - floatval($input['cantidad_final'])); 
                    $membership->save();     
                    return Response::json(array('success' => true));                    
            }else{                                               

                    if($input['concepto_del_pago'] == 'CREDITO NFC'){  
  
                        $payment->save(); 

                        $member = Member::find($input['memberId']);
                        $member->credit = $member->credit + $input['cantidad_final'];                        
                        $member->save();                                       

                    }elseif($input['concepto_del_pago'] == 'MEMBRESIA'){  

                        $membership = Membership::find($input['membership_id']);  
                        $payment->reference_id = $membership->id;    
                        $payment->save(); 

                        $membership->paid = $membership->paid + $input['cantidad_final'];
                        $membership->debt = $membership->debt - $input['cantidad_final'];
                        $membership->save();                     
                    }
                    return Response::json(array('success' => true));
            }                  
        }  catch (Exception $e){
            return Response::json(array('success' => false,'errors'=>$e->getMessage())); 
        }               
        return Response::json(array('success' => false,'errors'=>'No se guardo el pago'));            
    }   
    
    public function store_edit($paymentId)
    {
        $payment = null;
        if($paymentId == 0)
            $payemnt = new Payment();
        else{
            $payemnt = Payment::find($paymentId);
            if($payemnt == null)
            {
                return Response::json(
                        array('succes'=>false,'errors'=>'Tipo de membresia no encontrado')
                );
            }
        }
        $input = Input::All();
        $payment = new Payment();
        $payment->member_id = $input['memberId'];
        $payment->amount = $input['amount'];
        $payment->concept = $input['concept'];
        $payment->method_payment = $input['method'];     
        $payment->description = $input['description']; 
        $payment->save(); 
        return Response::json(
                array('succes'=>true)
        );        
    }
    
    public function get($paymentId)
    {
        $payment = Payment::find($paymentId);
        if($payment == null){
            return Response::json(
                    array('success'=>false,'errors'=>'Pago no encontrado')
            );
        }
        return Response::json(
                array('success'=>true,'payment'=>$payment)
        );        
    }
    
    public function delete($paymentId)
    {
        $payment = Payment::find($paymentId);
        if($payment != null){
            $payment->delete();
            return Response::json(
                    array('success'=>true)
            );            
        }
        return Response::json(
                array('success'=>false,'errors'=>'Pago no encontrado')
        );
    }
    
}
