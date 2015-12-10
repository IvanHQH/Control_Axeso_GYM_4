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
    
    public static function descripTurnUserOpen($branchOfficeId){
        $turn = DB::select("call current_turn('".Auth::user()->branch_office_id."')");         
        if(count($turn) == 0)
            return "NO";
        try{
            if($turn[0]->user_id == Auth::user()->id){

                $aux = explode(" ", $turn[0]->created_at);
                $date = $aux[0];
                $date = explode("-", $date);
                $month = MethodsConstants::nameMonthEnglishToEspanish($date[1]);
                $month = substr($month,0, 3);
                $time = explode(":", $aux[1]);
                $time = $time[0].":".$time[1];

                $dateTime = $date[0]."-".$month."-".$date[2]." ".$time;

                return $dateTime;
            }
            else
                return "NO";            
        }catch(Exception $e){
            return "NO";                       
        }
        return "NO";
    }    
    
    public static function currentNameBranchOffice()
    {
        try {
            $branchOffice = BranchOffice::find(Auth::user()->branch_office_id);
            return $branchOffice->name;                        
        } catch (Exception $ex) {
            return "";
        }
    }
    
    public static function currentTurnId()
    {
        $turn = DB::select("call current_turn('".Auth::user()->branch_office_id."')");         
        if(count($turn) == 0)
            return null;
        return $turn[0]->id;        
    }
    
    public static function turnOpenInPanel($branchOfficeId)
    {
        try{
            $turn = DB::select("call current_turn('".$branchOfficeId."')");         
            if(count($turn) == 0)
                return null;            
            $aux = explode(" ", $turn[0]->created_at);
            $date = $aux[0];
            $date = explode("-", $date);
            $month = MethodsConstants::nameMonthEnglishToEspanish($date[1]);
            $month = substr($month,0, 3);
            $time = explode(":", $aux[1]);
            $time = $time[0].":".$time[1];
            $dateTime = $date[0]."-".$month."-".$date[2]." ".$time;
            return $dateTime;      
        }catch(Exception $e){
            return null;                       
        }
        return null;
    }
    
}