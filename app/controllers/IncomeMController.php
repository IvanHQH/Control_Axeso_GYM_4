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
class IncomeMController extends BaseController{
    //put your code here
    public function incoms_list($params = "")
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
            $incomes = DB::select("call incomes('".$init_dt."','".$end_dt."')");  
        } catch (Exception $e) {
            $incomes = DB::select("call incomes('0000-01-01 00:00:00','3000-01-01 00:00:00')");
        }

        return View::make('cashbox.income',['incomes'=>$incomes,'date_init'=>$init_dt_aux,'date_end'=>$end_dt_aux]);
    }       
    
    public function store($incomeId)
    {
        
        $incomem = new IncomeM();
        
        $input = Input::All();                
        if($incomeId != 0){
            $incomed = IncomeD::find($incomeId);
            if($incomed == null)
                return Response::json(array('success' => false,
                    'errors'=>'income not found'));                 
        }else{
            $incomed = new IncomeD();   
            
            $incomem->turn_users_id = TurnUser::turnUserOpen(Auth::user()->branch_office_id)->id;
            $incomem->total = $input['amount'];
            $incomem->save();  
            
            $incomed->income_ms_id = $incomem->id;
        }
        //DB::transaction(function($input) use ($input) {              
            
            $incomed->description = $input['description'];
            $incomed->subtotal = $input['amount'];
            $incomed->save();        
            
            return Response::json(array(
                    'success' => true                   
            ));               
        /*});     
        return Response::json(array(
                'success' => false,'errors'=>'error'                   
        ));    */        
    }    	
    
    public function get($incomeId)
    {
        $income = DB::select('call income('.$incomeId.')');
        if(count($income)>0){
            $income = $income[0];
            return Response::json(array('success'=>true,'income'=>$income));
        }else{
            return Response::json(array('success'=>false));
        }
    }
    
    public function delete($incomeId)
    {
        $incomed = IncomeD::find($incomeId);
        if($incomed == null)
            return Response::json(array('success'=>false,'errors'=>'income not found'));
        DB::transaction(function ($incomed) use ($incomed) {
            IncomeD::where('income_ms_id',$incomed->income_ms_id)->delete();
            IncomeM::find($incomed->income_ms_id)->delete();            
        }); 
        return Response::json(array('success'=>true));
    }
    
}
