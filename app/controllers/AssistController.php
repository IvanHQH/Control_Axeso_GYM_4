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
class AssistController extends BaseController{
    
    public function store($memberId) 
    {
        $turnId = TurnUser::currentTurnId();
        if($turnId != null){
            $assist =  new Assist();
            $memberships = DB::select(
                    'call member_with_membership_active('.$memberId.
                    ','.Auth::user()->branch_office_id.')');  
            $membership = $memberships[0];
            $assist->membership_id = $membership->membership_id;
            $assist->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
            $assist->save();
            return Response::json(array('success'=>true));            
        }
        else{
            return Response::json(array('success'=>false,
                'errors'=>'No hay turno habilitado. ¿Desea crear un nuevo turno?')); 
        } 
    }
    
    public function assists_list($params = 0)
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

            $members = DB::select("call assists('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");
            $visitors = DB::select("call assists_visitors('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");
        } catch (Exception $e) {
            $members = DB::select("call assists('0000-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
            $visitors = DB::select("call assists_visitors('0000-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
        }
                
	return View::make('assists.assists_list',['members'=>$members,'visitors'=>$visitors]);       
    }
    
    public function delete($assistId)
    {
        $assist = Assist::find($assistId);
        if($assist == null)
            return Response::json(array('success'=>false,'errors'=>'Aisistencia no encontrada'));
        $assist->delete();            
        return Response::json(array('success'=>true));        
    }
    
}
