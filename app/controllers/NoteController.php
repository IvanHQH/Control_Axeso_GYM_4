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
class NoteController extends BaseController{
    //put your code here
	 
    public function notes_list($memberId)
    {
        $notes = DB::select("call member_notes('".$memberId."',".Auth::user()->branch_office_id.")");             
        return Response::json($notes);
    }    
    
    /**
    *post
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {                      
        $input = Input::All();
        $note = new Note();
                                           
        $note->user_id = Auth::user()->id;         
        $note->branch_office_id = Auth::user()->branch_office_id;        
        $note->member_id = $input['member_id'];
        $note->text = $input['note_text'];
        $note->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
        $note->save();
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
