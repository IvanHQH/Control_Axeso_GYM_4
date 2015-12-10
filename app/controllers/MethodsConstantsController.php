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
class MethodsConstantsController extends BaseController{
    //put your code here   
    
    public function login()
    {
        $user = User::where('nick_name',Input::get('nick_name'))->first();
        if($user == null)
            return Redirect::to('login');
        else
        {
            if($user->password == Input::get('password')){
                $branchOffice = BranchOffice::where('name', Input::get('name_client'))->first();
                if($branchOffice != null){
                    if($branchOffice->id == $user->branch_office_id){
                        Auth::loginUsingId($user->id);
                        return Redirect::to('quick_search');                       
                    }else
                        return Redirect::to('login');
                }else
                    return Redirect::to('login');
            }
            else return Redirect::to('login');
        }  
    }
    
    private function createTurnUser($userId,$branchOfficeId)
    {
        $turn = new TurnUser();
        $turn->user_id = $userId;
        $turn->branch_offices_id = $branchOfficeId;
        $turn->save();
        return $turn;
    }
    
    public function dateTimeNow()
    {
        echo MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
    }        
    
    public function validate_member()
    {
        $input = Input::All();
        //var_dump($input);
        $member = Member::where('nickname', '=', $input['username'])->first();
        if(isset($member)){
            if($member->password == $input['password']){
                return Response::json(array('member' => $member));
            }
        }
        return Response::json(array('member' => "NULL"));
    }
    
    public function check_notifications()
    {        
        $notifications = DB::select('call notifications_actives('.
                Auth::user()->branch_office_id.')');
        if(count($notifications) > 0){
            DB::update('call clear_notifications('.Auth::user()->branch_office_id.')');            
                return Response::json(                                                         
                    array('success'=>true,
                        'notification'=>$notifications[0])
                );                                   
        }
        return Response::json(array('success'=>false));
    }    
    
    public function validate_membership()
    {
        $input = Input::All();
        $error = 0;
        $membership = null;
        $member = null;
        if($input['type'] == 'tarjet'){
            $nfc_tarjet = NfcTarjet::where('code', '=', $input['code'])->first();
            if(!is_null($nfc_tarjet)){
                $membership = Membership::where('id', '=', $nfc_tarjet->membership_id)->first();
                if(!is_null($membership)){
                   $member = Member::where('id', '=', $membership->member_id)->first();
                   if(is_null($member))
                        $error = 2;
                }
                else $error = 1;
            }else{
                $message = array();
                $message['type'] = 0;
                $message['name'] = "";
                $message['message'] = 'No hay membresias asociadas a esta tarjeta';
                return Response::json(array('message' => $message));         
            }
        }
        elseif($input['type'] == 'smartphone'){
            $membership = Membership::find($input['membership_id']); 
            if($membership != null){
               $member = Member::where('id', '=', $membership->member_id)->first();
               if(is_null($member))
                    $error = 2;
            }
            else $error = 1;              
        }        
        if($error == 2){
            $message = array();
            $message['name'] = "";
            $message['message'] = "No hay socio vinculado a tarjeta";
            $message['type'] = 0;
            return Response::json(array('message' => $message)); 
        }elseif($error == 1){
            $message = array();
            $message['name'] = "";
            $message['message'] = "No hay membresia vinculada a tarjeta";
            $message['type'] = 0;
            return Response::json(array('message' => $message));   
        }else{
            $dateEnd = new DateTime($membership->end_period);
            $dateStart = new DateTime($membership->start_period);
            $dateNowStr = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d ")."00:00:00");
            $dateNow = date_create($dateNowStr);
            NotificationAxeso::where('band', 1)->update(['band' => 0]); 
            $notification_axeso = new NotificationAxeso();
            if($input['type'] == 'tarjet')
                $notification_axeso->nfc_card = $input['code'];
            elseif($input['type'] == 'smartphone')
                $notification_axeso->membership_id = $input['membership_id'];
            $notification_axeso->band = 1;            
            $notification_axeso->branch_office_id = $input['branch_office_id'];  
            if($dateEnd >= $dateNow && $dateStart <= $dateNow){
                $assist =  new Assist();
                $assist->membership_id = $membership->id;
                $assist->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
                $assist->save();                                             
               
                $membershipType = MembershipType::where('id', $membership->membership_type_id)->first(); 
                $notification_axeso->type = 1;
                $notification_axeso->save();
                $interval = $dateEnd->diff($dateNow);
                $interval = $interval->format("%d dias");
                $fullName = $member->first_name.' '.$member->last_name;
                $membershipName = 'Membresia '.$membershipType->name;
                $validate = 'Faltan '.$interval.' '.'para la vigencia';
                $message = array();
                $message['name'] = $fullName;
                $message['membership'] = $membershipName;
                $message['validate'] = $validate;
                $message['type'] = 1;                        
                return Response::json(array('message' => $message));
            }
            $fullName = $member->first_name.' '.$member->last_name;
            $notification_axeso->type = 0;  
            $notification_axeso->save();
            $message = array();
            $message['type'] = 0;
            $message['name'] = $fullName;                  
            if($dateEnd < $dateNow){
                  $message['message'] = 'Verifique el estado de su membresia';
                  return Response::json(array('message' => $message));
            }elseif($dateStart > $dateNow){                      
              $message['message'] = 'Membresia valida hasta '.date_format($dateStart, 'd-m-Y');
              return Response::json(array('message' => $message));                      
            }            
        }
    }    
    
    public function linkup_nfc()
    {
        $input = Input::All();
        $member = Member::find($input['member_id']);
        if($member != null)
        {
            $memberships = DB::select('call member_with_membership_active('.$member->id.','.$member->branch_office_id.')');
            if(count($memberships)>0){
                $memberships = $memberships[0];
                $nfcTarjet = NfcTarjet::where('code',$input['nfc_code'])->first();
                if($nfcTarjet == null)
                    $nfcTarjet = new NfcTarjet();      
                else{
                    $memberNfc = Membership::find($nfcTarjet->membership_id);
                    $memberNfc = Member::find($memberNfc->member_id);
                    if($input['replace'] == 0)
                        return Response::json(array('success' => false,'tarjet_busy'=>true,
                            'message' => 'La tarjeta NFC ya esta vinculada a '.
                            $memberNfc->first_name." ".$memberNfc->last_name." ".$memberNfc->second_last_name));
                }                                          
                $nfcTarjet->membership_id = $memberships->membership_id;
                $nfcTarjet->code = $input['nfc_code'];                
                try 
                    {$nfcTarjet->save();} 
                catch (Exception $e) 
                    {return Response::json(array('success' => false,
                        'message'=>'No se guardo vinculacion, posiblemente el codigo NFC ya esta vinculado'));}
                return Response::json(array('success' => true,'member' => $member));
            }else
                return Response::json(array('success' => false,'message' => 'No hay membresias activas a vincular'));
        }else 
            return Response::json(array('success' => false,'message' => 'No hay socio enlazado con el id'));
        return Response::json(array('success' => false));        
    }
    
    public function payment_nfc()
    {
        $input = Input::All();        
        $nfcTarjet = NfcTarjet::where('code',$input['nfc_code'])->first();
        if($nfcTarjet != null){            
            $membership = Membership::find($nfcTarjet->membership_id);
            if($membership != null){
                $member = Member::find($membership->member_id);
                if($member != null){
                    $payment = new Payment();
                    $payment->concept = "PAGO NFC";
                    
                    $turn = TurnUser::turnOpenInPanel();
                    if($turn != null)
                        $payment->turn_user_id = $turn->id;
                    else
                        return Response::json(array('success' => false,'message'=>'No hay turno abierto en panel de admon. para aceptar pago'));                              
                    $payment->member_id = $member->id;
                    $payment->amount = $input['amount'];
                    $payment->description = $input['description'];
                    $payment->method_payment = "NFC";      
                    try {
                        $payment->save();
                        return Response::json(array('success' => true));
                    } 
                    catch (Exception $e) 
                        {return Response::json(array('success' => false,'message'=>'No se guardo el pago'));}
                }else
                    return Response::json(array('success' => false,'message'=>'No hay socio enlazado a la mebresia'));
            }else
                return Response::json(array('success' => false,'message'=>'No hay membresia vinculada con el codigo NFC'));
        }
        return Response::json(array('success' => false,'message'=>'Codigo NFC inexistente en base de datos'));
    }
    
}
