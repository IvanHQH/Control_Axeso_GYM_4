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
class TurnUserController extends BaseController{
    //put your code here
    
    public function store()
    {
        $turn = new TurnUser();        
        $turn->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
        $turn->date_time_out = '0000-00-00 00:00:00';
        $turn->user_id = Auth::user()->id;
        $turn->branch_offices_id = Auth::user()->branch_office_id;
        $turn->save();
        return Response::json(array('success'=>true));
    }       
    
    public function turn_users_list()
    {
        $infom_boxcut = array();
        $infom_boxcut['boxcuts'] = DB::select('call turn_users('.Auth::user()->branch_office_id.')'); 
        return Response::json($infom_boxcut);
    }
    
    public function turn_user_detail($turnUserId)
    {
        $infom_boxcut = array();
        $aux = DB::select('call turn_user('.$turnUserId.')');
        $aux = $aux[0];
        if(count($aux) > 0){            
            $infom_boxcut['info'] = array();
                        
            $infom_boxcut['info']['id'] = $aux->id;
            $infom_boxcut['info']['user_admin_name'] = $aux->user_admin_name;            
            
            $infom_boxcut['info']['user_close_name'] = $aux->user_close_name;
            $infom_boxcut['info']['date_created_at'] = $aux->date_created_at;
            $infom_boxcut['info']['date_out'] = $aux->date_out;
            $infom_boxcut['info']['time_created_at'] = $aux->time_created_at;
            if($aux->time_out != null)
                $infom_boxcut['info']['time_out'] = $aux->time_out;
            else
                $infom_boxcut['info']['time_out'] = "";
            $infom_boxcut['info']['date_time_created_at'] = $aux->date_time_created_at ;            
            $infom_boxcut['info']['money_withdrawn'] = $aux->money_withdrawn;
            $infom_boxcut['info']['money_left'] = $aux->money_left;
            
            $turnBefore = TurnUser::where('branch_offices_id',Auth::user()->branch_office_id)->
                    where('date_time_out','<',$infom_boxcut['info']['date_time_created_at'])->
                    orderBy('date_time_out','desc')->first();
            
            if($turnBefore != null){
                if($turnBefore->money_left != null)
                    $infom_boxcut['detail']['money_open_box'] = $turnBefore->money_left;  
                else
                    $infom_boxcut['detail']['money_open_box'] = 0;
                $infom_boxcut['detail']['turn_before'] = $turnBefore->id;
            }
            else $infom_boxcut['detail']['money_open_box'] = 0;
            
            $payments = DB::select("call total_payments(".$turnUserId.",'MEMBRESIA',1)")[0]->total; 
            $inscriptions = DB::select("call total_payments(".$turnUserId.",'INSCRIPCION',1)")[0]->total; 
            $infom_boxcut['detail']['sales_membership_cash'] = $payments + $inscriptions ;
            
            $inscriptionsBank = DB::select("call total_payments(".$turnUserId.",'INSCRIPCION',0)")[0]->total; 
            $paymentsBank = DB::select("call total_payments(".$turnUserId.",'MEMBRESIA',0)")[0]->total;            
            $infom_boxcut['detail']['sales_membership_bank'] = $paymentsBank+$inscriptionsBank;
            
            $infom_boxcut['detail']['sales_lockers'] = 0;            

            $infom_boxcut['detail']['incomes_cash'] = DB::select("call total_incomes(".$turnUserId.",1)")[0]->total;            
            
            $infom_boxcut['detail']['incomes_bank'] = DB::select("call total_incomes(".$turnUserId.",0)")[0]->total;
            
            $cashNfc = DB::select("call total_payments(".$turnUserId.",'CREDITO NFC',0)")[0]->total;

            $bankNfc = DB::select("call total_payments(".$turnUserId.",'CREDITO NFC',1)")[0]->total;

            $infom_boxcut['detail']['payments_nfc'] = $cashNfc + $bankNfc;
            
            $infom_boxcut['detail']['sales_visits_cash'] = DB::select("call total_amount_visitors(".$turnUserId.",1)")[0]->total;
            
            $infom_boxcut['detail']['sales_visits_bank'] = DB::select("call total_amount_visitors(".$turnUserId.",0)")[0]->total;
            
            $infom_boxcut['detail']['total_sales_cash'] = /*$infom_boxcut['detail']['money_open_box'] +*/
                    $infom_boxcut['detail']['sales_membership_cash'] + 
                    $infom_boxcut['detail']['sales_lockers'] + 
                    $infom_boxcut['detail']['incomes_cash'] +
                    $infom_boxcut['detail']['payments_nfc'] +
                    $infom_boxcut['detail']['sales_visits_cash'] +
                    $infom_boxcut['info']['money_left'];

            $infom_boxcut['detail']['total_sales'] = $infom_boxcut['detail']['total_sales_cash'] +
                    $infom_boxcut['detail']['sales_membership_bank'] + 
                    $infom_boxcut['detail']['sales_visits_bank'] +
                    $infom_boxcut['detail']['incomes_bank'];
            
            $infom_boxcut['detail']['debits_credits'] = 0;            
            
            $infom_boxcut['detail']['buys'] = DB::select("call total_outcomes(".$turnUserId.")")[0]->total;
            
            $infom_boxcut['detail']['money_in_box'] = $infom_boxcut['detail']['total_sales_cash']  -
                    $infom_boxcut['detail']['buys'];
            
        }
        return Response::json(array('success'=>true,'data'=>$infom_boxcut));
        //return Response::json($infom_boxcut);
        //return View::make('cashbox.summary_boxcut',['infom_boxcut'=>$infom_boxcut]);
    }
    
    public function close_box()
    {
        $turn = TurnUser::where('date_time_out',null)->first();
        if($turn != null){
            $turn->date_time_out = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $turn->save();
            return Response::json(array('success'=>true));            
        }
        else
            return Response::json(array('success'=>false,'errors'=>'Ya se ha realizado este corte de caja!'));        
    }
    
    public function summary_boxcut()
    {
        return View::make('cashbox.summary_boxcut');        
    }
	 
    public function create($amount)
    {        
        try {
            $turns = DB::select('call turn_users_open('.Auth::user()->branch_office_id.')');
            if(count($turns) > 0){
                $message = "Hay ".count($turns)." turno abierto para esta sucursal, cierrelo para poder crear el suyo"; 
                return Response::json(array('success'=>false,'errors'=>$message));
            }
            $turn = new TurnUser();        
            $turn->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $turn->date_time_out = '0000-00-00 00:00:00';
            $turn->user_id = Auth::user()->id;
            $turn->branch_offices_id = Auth::user()->branch_office_id;
            $turn->money_left = $amount;        
            $turn->save();
            return Response::json(array('success'=>true));            
        } catch (Exception $e) {
            return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
        }
    }      
    
    public function close_turn_user($amount)
    {
        $turnId = TurnUser::currentTurnId();
        if($turnId != null){
            $turn = TurnUser::find($turnId);
            $turn->date_time_out = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $turn->money_withdrawn = $amount;
            $turn->save();
        }
        return Response::json(array('success'=>true));
    }     
    
}
