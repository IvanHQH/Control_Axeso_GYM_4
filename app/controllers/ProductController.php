<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductsController
 *
 * @author Arellano
 */
class ProductController extends BaseController{
    //put your code here
    
    public function products_list()
    {
        $products = Product::where('branch_office_id',Auth::user()->branch_office_id)->get();
        return View::make('pos.products_list',['products'=>$products]);         
    }     
    
    public function store($productId)
    {
        try{
            $validator = Validator::make(Input::all(),
                array(
                    'nombre' => 'required|regex:([a-zA-Z ραινσϊ]{1,30})',
                    'descripcion' => 'regex:([a-zA-Z ραινσϊ]{1,30})',
                    'precio' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',
                    'costo' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',
                    'saldo' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)',
                    'tipo' => 'required|regex:([a-zA-Z ραινσϊ]{1,30})',
                    'codigo' => 'required|regex:([0-9]+(\.[0-9][0-9]?)?)'
                )
            );        
            if ($validator->fails()){
                return Response::json(array('success'=>false,'errors'=>$validator->messages()->all()));                
            }else{
                //return "no";
            }

            $input = Input::All();   
            $product = null;            
            if($productId == 0){
                $product = new Product();    
                if(Product::where('code',$input['codigo'])->orwhere('name',$input['nombre'])->count() > 0 ){
                    $prods = Product::where('code',$input['codigo'])->orwhere('name',$input['nombre'])->get();
                    foreach($prods as $prod){
                        if($prod->branch_office_id == Auth::user()->branch_office_id)
                            return Response::json(array('success'=>false,'errors'=>
                                'Ya existe producto con el nombre o codigo espicificado'));                            
                    }   
                }
            }
            else{
                $product = Product::find($productId); 
                if($product == null)
                    return Response::json(array('success'=>false,'errors'=>'Producto no encontrado'));                
            }                       

            $product->branch_office_id = Auth::user()->branch_office_id;
            $product->name = $input['nombre'];               
            $product->code = $input['codigo']; 
            $product->price = $input['precio']; 
            $product->cost = $input['costo']; 
            $product->stock = $input['saldo']; 
            $product->type = $input['tipo']; 
            if (isset($input['descripcion']))
                $product->description = $input['descripcion'];    
            $product->created_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));     
            $product->updated_at = MethodsConstants::dateTimeMexicoCenter(date("Y-m-d H:i:s"));        
            $product->save();          
            return Response::json(array('success'=>true));
        }  catch (Exception $e){
            return Response::json(array('success'=>false,'errors'=> $e->getMessage()));
        }                       
    }    
    
    public function delete($productId)
    {
        $product = Product::find($productId);
        if( count( $product) > 0 ){
            $product->delete();
            return Response::json(array(
                    'success' => true
            ));             
        }   
        return Response::json(array(
                'success' => false,
                'errors' => 'Producto no eliminado'
        ));           
    }
    
    public function get($productId)
    {
        $product = Product::find($productId);
        if( count( $product) > 0 ){
            return Response::json(array(
                    'success' => true,
                    'product' => $product
            ));             
        }   
        return Response::json(array(
                'success' => false,
                'errors' => 'Producto no encontrado'
        ));        
    }

    public function get_find($code)
    {
        $prod = Product::where('code',$code)->where('branch_office_id',
                Auth::user()->branch_office_id)->first();
        if($prod == null)
            return Response::json(array('success'=>false));
        return Response::json(array('success'=>true,'prod'=>$prod));
    }
    
}
