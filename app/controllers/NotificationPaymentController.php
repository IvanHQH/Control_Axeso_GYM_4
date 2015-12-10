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
class NotificationPaymentController extends BaseController{
    //put your code here
	 
    public function record_card_payment()
    {        
        $input = Input::All();        
        try{
            NotificationPayment::where('branch_office_id',$input['branch_office_id'])->delete();
            $not = new NotificationPayment();            
            $not->nfc_card = $input['code'];
            $not->branch_office_id = $input['branch_office_id'];        
            $not->save();
            $info = DB::select("call detail_nfc_code('".$not->nfc_card."')");
            if(count($info) > 0){
                $info = $info[0];
                return Response::json(array('success'=>true,'info'=>$info));                    
            }
        }catch (Exception $exc){
            return Response::json(array('success'=>false));      
        }        
        return Response::json(array('success'=>false)); 
    }    
 
    public function get_code_payment_nfc()
    {
        $input = Input::All();
        try{
            $not = NotificationPayment::where('branch_office_id',Auth::user()->branch_office_id)->first();                    
            if($not != null)
            {            
                $info = DB::select("call detail_nfc_code('".$not->nfc_card."')");
                if(count($info) > 0){
                    $info = $info[0];
                    return Response::json(array('success'=>true,'info'=>$info));
                }
            }
        }catch (Exception $exc){
            return Response::json(array('success'=>false,'errors'=>'Error en proceso'));    
        }     
        return Response::json(array('success'=>false,'errors'=>'No hay tarjeta a leer')); 
    }
    
    public function reset_record_card_payment()
    {
        $input = Input::All();
        NotificationPayment::where('branch_office_id',$input['branch_office_id'])->delete();
    }
    
}
