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
class VisitorController extends BaseController{
    //put your code here
	 
    public function visitors_list()
    {
        return View::make('visitors.visitors_list',['payments'=>$payments]);         
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
}
