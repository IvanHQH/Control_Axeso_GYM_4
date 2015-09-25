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
            $end_dt .= " 00:00:00";              
            $visitors = DB::select("call visitors('".$init_dt."','".$end_dt."')");    
        } catch (Exception $e) {
            $visitors = DB::select("call visitors('0000-01-01 00:00:00','3000-01-01 00:00:00')");
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
        if($visitorId != 0)
        {
            $visitor = Visitor::find($visitorId);
            if($visitor == null){
                return Response::json(array('success'=>false,'errors'=>'visitor not found'));
            }                
        }                                
        $input = Input::All();                        
        $visitor->user_id = Auth::user()->id;                 
        $visitor->branch_office_id = 1;        
        $visitor->first_name = $input['first_name'];            
        $visitor->last_name = $input['last_name'];
        $visitor->second_last_name = $input['second_last_name'];        
        $visitor->amount = $input['amount'];
        $visitor->method_payment = $input['method_payment'];
        $visitor->reference_payment = $input['reference_payment'];
        $visitor->save();
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
