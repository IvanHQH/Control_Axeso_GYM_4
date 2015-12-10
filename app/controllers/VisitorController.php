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
	 
    public function visitors_list($params = "")
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
            $visitors = DB::select("call visitors('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");    
        } catch (Exception $e) {
            $visitors = DB::select("call visitors('0000-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
        }
        
        return View::make('visitors.visitors_list',['visitors'=>$visitors]);       
        /*$visitors = DB::select('call visitors()');
        return View::make('visitors.visitors_list',['visitors'=>$visitors]);*/         
    }    
    
    /**
    *post
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($visitorId)
    {                        
        $visitor = new Visitor();
        
        $turnId = TurnUser::currentTurnId();
        if($turnId == null)
            return Response::json(array('success'=>false,'errors'=>'NO TURN'));                     
        
        $validator = Validator::make(Input::all(),
            array(
                'nombre' => 'required|regex:([a-zA-Z ñáéíóú]{1,30})',                
                'apellido_paterno' => 'required|regex:([a-zA-Z ñáéíóú]{1,30})',
                'apellido_materno' => 'regex:([a-zA-Z ñáéíóú]{1,30})',
                'cantidad' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',
                'metodo_de_pago' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',
                'referencia_de_pago' =>'alpha_num'
            )
        );        
        if ($validator->fails())
                return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));         
        
        if($visitorId != 0)
        {
            $visitor = Visitor::find($visitorId);
            if($visitor == null){
                return Response::json(array('success'=>false,'errors'=>'visitor not found'));
            }                
        }              
        try{                  
            $input = Input::All();           
            $visitor->turn_user_id = TurnUser::currentTurnId();          
            $visitor->branch_office_id = Auth::user()->branch_office_id;        
            $visitor->first_name = $input['nombre'];            
            $visitor->last_name = $input['apellido_paterno'];
            $visitor->second_last_name = $input['apellido_materno'];        
            $visitor->amount = $input['cantidad'];
            $visitor->method_payment = $input['metodo_de_pago'];
            $visitor->reference_payment = $input['referencia_de_pago'];
            $visitor->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $visitor->save();

            $assist =  new Assist();
            $assist->full_name = $visitor->first_name ." ".$visitor->last_name." ".$visitor->second_last_name;
	    $assist->branch_office_id = Auth::user()->branch_office_id; 
            $assist->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $assist->save();
        }        
        catch(Exception $e){
            return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
        } 

        return Response::json(array('success'=>true));
    }    
    
    public function get($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        if($visitor == null){
            return Response::json(array('success'=>false,'errors'=>'visitor not found'));
        }                
        return Response::json(array('success'=>true,'visitor'=>$visitor));
    }
    
    public function delete($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        if($visitor == null)
            return Response::json(array('success'=>false,'errors'=>'visitor not found'));
        $visitor->delete();            
        return Response::json(array('success'=>true));
    }    
}
