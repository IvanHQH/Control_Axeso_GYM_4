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
    
    public function turn_users_list($branchOfficeId)
    {
        //$input = Input::All();
        $infom_boxcut = array();
        //$infom_boxcut['boxcuts'] = DB::select('call turn_users('.$input['$branch_office_id'].')'); 
        $infom_boxcut['boxcuts'] = DB::select('call turn_users('.$branchOfficeId.')'); 
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
            $infom_boxcut['info']['time_out'] = $aux->time_out;
            $infom_boxcut['info']['date_time_created_at'] = $aux->date_time_created_at ;            
            $infom_boxcut['info']['money_withdrawn'] = $aux->money_withdrawn;
            $infom_boxcut['info']['money_left'] = $aux->money_left;
            
            $turnBefore = TurnUser::where('branch_offices_id',1)->
                    where('date_time_out','<',$infom_boxcut['info']['date_time_created_at'])->
                    orderBy('date_time_out','desc')->first();
            
            if($turnBefore != null)
                $infom_boxcut['detail']['money_open_box'] = $turnBefore->money_left;     
            else $infom_boxcut['detail']['money_open_box'] = 0;
            
            $infom_boxcut['detail']['sales_membership'] = 0;
            
            $infom_boxcut['detail']['sales_lockers'] = 0;
            
            $infom_boxcut['detail']['sales_products'] = 0;
            
            $infom_boxcut['detail']['sales_visits'] = 0;
            
            $infom_boxcut['detail']['total_sales'] = $infom_boxcut['detail']['money_open_box'] + 
                    $infom_boxcut['detail']['sales_membership'] + 
                    $infom_boxcut['detail']['sales_lockers'] + 
                    $infom_boxcut['detail']['sales_products'] +
                    $infom_boxcut['detail']['sales_visits'];
            
            $infom_boxcut['detail']['debits_credits'] = 0;
            
            $infom_boxcut['detail']['total_money_received'] = $infom_boxcut['detail']['debits_credits'] + 
                    $infom_boxcut['detail']['total_sales'];
            
            $infom_boxcut['detail']['buys'] = 0;
            
            $infom_boxcut['detail']['adjust_box_income'] = 0;
            
            $infom_boxcut['detail']['adjust_box_outcome'] = 0;
            
            $infom_boxcut['detail']['money_in_box'] = $infom_boxcut['detail']['total_money_received'] + 
                    $infom_boxcut['detail']['adjust_box_income'] - $infom_boxcut['detail']['adjust_box_outcome'] -
                    $infom_boxcut['detail']['buys'];
            
        }
        return Response::json(
                array('success'=>true,'data'=>$infom_boxcut)
        );
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
	 
}
