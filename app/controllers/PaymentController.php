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
	 
    public function payments_list()
    {
        //payments
        $payments = DB::select('call payments()');         
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
