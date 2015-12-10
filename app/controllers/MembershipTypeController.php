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
class MembershipTypeController extends BaseController {
    //put your code here
	 
    public function membership_types_list()
    {
        //$membershipTypes = MembershipType::all();
        //membershyp_types
        $membershipTypes = DB::select('call membershyp_types('.Auth::user()->branch_office_id.')'); 
        return View::make('membership_types.membership_types_list',['membershipTypes'=>$membershipTypes]);         
    }    
    
    public function get_membership_types()
    {
        return MembershipType::all();
    }
    
    public function store($membershipTypeId)
    {

        $validator = Validator::make(Input::all(),
            array(
                'nombre' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',    
                'habilitada_hasta' => 'required|date',
                'precio' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',
                'duracion' => 'required|numeric'           
            )
        );        
        if ($validator->fails())
            return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));         
        
        $input = Input::All();
        $membershipType = null;
        if($membershipTypeId == 0)
            $membershipType = new MembershipType();        
        else{
            $membershipType = MembershipType::find($membershipTypeId);        
            if($membershipType == null){
                return Response::json(
                        array('succes'=>false,'errors'=>'tipo de membresia no encontrada')
                );                
            }   
        }            
        $membershipType->name = $input['nombre'];                                  
        $membershipType->available_until= $input['habilitada_hasta'];                                                     
        $membershipType->price= $input['precio'];         
        $membershipType->duration= $input['duracion'];
        $membershipType->branch_office_id = Auth::user()->branch_office_id;           
        $membershipType->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
        $membershipType->save(); 
        return Response::json(array('success'=>true));                
    }    
    
    public function delete($membeshipTypeId)
    {
        $membershipType = MembershipType::find($membeshipTypeId);
        if($membershipType != null){
            $membershipType->delete();
            return Response::json(
                    array('success'=>true)
            );            
        }
        return Response::json(
                array('success'=>false,'errors'=>'membership type not found')
        );
    }
    
    public function get($membeshipTypeId)
    {        
        $membershipType = MembershipType::find($membeshipTypeId);
        if($membershipType != null){
            $aux = explode(" ", $membershipType->available_until);
            //echo $aux[0];die();
            $aux = explode("-", $aux[0]);
            $membershipType->available_unitl = $aux[0] . '-' . $aux[1] . '-' . $aux[2];              
            
            return Response::json(
                    array('success'=>true, 'membership_type'=>$membershipType)
            );            
        }
        return Response::json(array('success'=>false,'errors'=>'membership type not found'));
    }    
    
    public function get_for_name($name)
    {
        $membershipType = MembershipType::where("name",$name)->
                where("branch_office_id",Auth::user()->branch_office_id)->first();
        if($membershipType != null){
            $aux = explode(" ", $membershipType->available_until);
            //echo $aux[0];die();
            $aux = explode("-", $aux[0]);
            $membershipType->available_unitl = $aux[0] . '-' . $aux[1] . '-' . $aux[2];              
            
            return Response::json(
                    array('success'=>true, 'membership_type'=>$membershipType)
            );            
        }
        return Response::json(array('success'=>false,'errors'=>'membership type not found'));        
    }
    
    public function available_memberships_types()
    {
        $membershipTypesAvailabes = DB::select('call membershyp_types_availables(true,'.Auth::user()->branch_office_id.')'); 
        return View::make('membership_types.available_memberships_types',
            ['membershipTypesAvailabes'=>$membershipTypesAvailabes]);
    }

    public function unavailable_memberships_types()
    {
        $membershipTypesUnavailabes = DB::select('call membershyp_types_availables(false,'.Auth::user()->branch_office_id.')'); 
        return View::make('membership_types.unavailable_memberships_types',
            ['membershipTypesUnavailabes'=>$membershipTypesUnavailabes]);     
    }    
    
}
