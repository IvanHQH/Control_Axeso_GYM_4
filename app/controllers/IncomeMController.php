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
            $end_dt .= " 23:59:59";              
            $incomes = DB::select("call incomes('".$init_dt."','".$end_dt."',".Auth::user()->branch_office_id.")");  
        } catch (Exception $e) {
            $incomes = DB::select("call incomes('0000-01-01 00:00:00','3000-01-01 00:00:00',".Auth::user()->branch_office_id.")");
        }

        return View::make('cashbox.income',['incomes'=>$incomes,'date_init'=>$init_dt_aux,'date_end'=>$end_dt_aux]);
    }       
    
    public function store()
    {               
        $validator = Validator::make(Input::all(),
            array(              
                'metodo_de_pago' => 'required|regex:([a-zA-Z ñáéíóú]{2,30})',
                'referencia' => 'alpha_num'
            )
        );  

        if ($validator->fails())
            return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));  

        $turnId = TurnUser::currentTurnId();
        if($turnId == null)
            return Response::json(array('success'=>false,'errors'=>'NO TURN'));                                     
        
        $input = Input::All(); 
        $nfc = false;
        if($input['member_id'] != 0){
            $member = Member::find($input['member_id']);
            if($member->credit < $input['total']){
                $errors = array();
                $errors[0] = "CrÃ©dito insuficiente";
                return Response::json(array('success'=>false,'errors'=>$errors)); 
            }
            $member->credit = $member->credit - $input['total'];
            $member->save();
            $nfc = true;
        }

        $incomem = new IncomeM();                               
        $incomem->turn_users_id = TurnUser::currentTurnId();
        $incomem->total = $input['total'];

        if($input['member_id'] != 0)            
            $incomem->method_payment = 'NFC';
        else
             $incomem->method_payment = $input['metodo_de_pago'];

        $incomem->reference = $input['referencia']; 
        $incomem->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
        if($nfc == true)
            $incomem->nfc_payment = 1;
        else $incomem->nfc_payment = 0;
        $incomem->save();          

        try{
            if (Input::has('products')) {
                $prods = Input::get('products');
                if (!is_array($prods)) {
                    $prods = array($prods);
                }
                foreach ($prods as $e) {
                    $incomed = new IncomeD();
                    $prod = Product::where('code',$e[0])->first();
                    $prod->stock = $prod->stock - intval($e[1]);
                    $prod->save();
                    $incomed->product_id = $prod->id;
                    $incomed->description = $prod->name;
                    $incomed->quantity = intval($e[1]);
                    $incomed->subtotal = intval($e[1])*$prod->price;
                    $incomed->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));
                    $incomed->income_ms_id = $incomem->id;
                    $incomed->save();
                }
            }        
            return Response::json(array('success'=>true));
        }catch(Exception $e){
            return Response::json(array('success'=>false,'errors'=>$e->getMessage()));
        }        

        return Response::json(array(
                'success' => true                   
        ));                     
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
        $incomem = IncomeD::find($incomeId);
        if($incomem == null)
            return Response::json(array('success'=>false,'errors'=>'Ingreso no encontrado'));
        DB::transaction(function ($incomem) use ($incomem) {
            IncomeD::where('income_ms_id',$incomem->income_ms_id)->delete();
            IncomeM::find($incomem->income_ms_id)->delete();            
        }); 
        return Response::json(array('success'=>true));
    }
    
}
