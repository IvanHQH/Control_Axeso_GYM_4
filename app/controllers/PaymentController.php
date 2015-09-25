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
            $end_dt .= " 00:00:00";              
            $payments = DB::select("call payments('".$init_dt."','".$end_dt."')");    
        } catch (Exception $e) {
            $payments = DB::select("call payments('0000-01-01 00:00:00','3000-01-01 00:00:00')");
        }
        
        return View::make('paymets.memberships_paymets',['payments'=>$payments]);         
    }    
    
    /**
    *post
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($memberId = 0)
    {                             
        $input = Input::All();
        $input['memberId'] = $memberId;

        DB::transaction(function($input) use ($input) {
            
           $payment = new Payment();
           $payment->member_id = $input['memberId'];
           $payment->amount = $input['amount'];
           $payment->concept = $input['concept'];
           $payment->method_payment = $input['method_payment'];     
           $payment->turn_user_id = TurnUser::turnUserOpen(Auth::user()->branch_office_id)->id;
           $payment->save();                        
           
           $membership = Membership::where('member_id',$input['memberId'])->get();
           if(count($membership) > 0){
               $membership = $membership[0];
               $membership->active = true;
               $membership->save();
           }

           return Response::json(array(
                   'success' => true                   
           ));           
        });      
        return Response::json(array(
                'success' => false, 'errors'=>'error'                   
        ));            
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
                        array('succes'=>false,'errors'=>'membership type not found')
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
                    array('success'=>false,'errors'=>'payment not found')
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
                array('success'=>false,'errors'=>'payment not found')
        );
    }
    
}
