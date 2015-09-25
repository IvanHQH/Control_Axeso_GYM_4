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
class OutcomeMController extends BaseController{
    //put your code here
    public function outcoms_list($params = "")
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
            $outcomes = DB::select("call outcomes('".$init_dt."','".$end_dt."')");  
        } catch (Exception $e) {
            $outcomes = DB::select("call outcomes('0000-01-01 00:00:00','3000-01-01 00:00:00')");
        }
        
        return View::make('cashbox.outcome',['outcomes'=>$outcomes,'date_init'=>$init_dt_aux,'date_end'=>$end_dt_aux]);        
    }       
    
    public function store($outcomeId)
    {        
        $outcomem = new OutcomeM();        
        $input = Input::All();                
        if($outcomeId != 0){
            $outcomed = OutcomeD::find($outcomeId);
            if($outcomed == null)
                return Response::json(array('success' => false,
                    'errors'=>'outcome not found'));                 
        }else{                          
            $outcomem->turn_users_id = TurnUser::turnUserOpen(Auth::user()->branch_office_id)->id;
            $outcomem->total = $input['amount'];
            $outcomem->save();  
            
            $outcomed = new OutcomeD(); 
            $outcomed->outcome_ms_id = $outcomem->id;
        }
        //DB::transaction(function($input) use ($input) {              
            
        $outcomed->description = $input['description'];
        $outcomed->subtotal = $input['amount'];
        $outcomed->save();        

        return Response::json(array(
                'success' => true                   
        ));               
        /*});     
        return Response::json(array(
                'success' => false,'errors'=>'error'                   
        ));    */        
    }    	
    
    public function get($outcomeId)
    {
        $outcome = DB::select('call outcome('.$outcomeId.')');
        if(count($outcome)>0){
            $outcome = $outcome[0];
            return Response::json(array('success'=>true,'outcome'=>$outcome));
        }else{
            return Response::json(array('success'=>false));
        }
    }
    
    public function delete($outcomeId)
    {
        $outcomed = OutcomeD::find($outcomeId);
        if($outcomed == null)
            return Response::json(array('success'=>false,'errors'=>'outcome not found'));
        DB::transaction(function ($outcomed) use ($outcomed) {
            OutcomeD::where('outcome_ms_id',$outcomed->outcome_ms_id)->delete();
            OutcomeM::find($outcomed->outcome_ms_id)->delete();            
        }); 
        return Response::json(array('success'=>true));
    }
    
}
