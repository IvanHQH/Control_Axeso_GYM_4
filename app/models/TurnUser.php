<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author Arellano
 */
class TurnUser extends BaseModel{
    //put your code here
    public static function turnUserOpen($branchOfficeId){
        $turn = TurnUser::where('date_time_out','=','0000-00-00 00:00:00')->
                where('branch_offices_id',$branchOfficeId)->first();
        return $turn;
    }
    
    public static function descripTurnUserOpen($branchOfficeId){
        //$turn = TurnUser::where('date_time_out','=',null)->
        //        where('branch_offices_id',$branchOfficeId)->first();
        $turn = DB::select("call current_turn('".Auth::user()->branch_office_id."')");         
        if(count($turn) == 0)
            return "NO";
        return $turn[0]->created_at;
    }    
    
    public static function currentTurnId()
    {
        $turn = DB::select("call current_turn('".Auth::user()->branch_office_id."')");         
        if(count($turn) == 0)
            return null;
        return $turn[0]->id;        
    }
    
}