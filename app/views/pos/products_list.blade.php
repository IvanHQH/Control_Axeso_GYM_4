@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- row-content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-heading">
                
                <div class="row">
                    <div class="col-sm-4">                            
                        <button type="button" class="btn btn-outline btn-primary" 
                            id="add_product" data-toggle="modal">                                   
                        Agregar
                        </button>    
                    </div>
                </div>                 
                
            </div>
            <!-- panel-body -->
            <div class="panel-body">
                <!-- datatable-wrapper -->
                <div class="dataTable_wrapper">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper 
                         form-inline dt-bootstrap no-footer">
                        <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered 
                                table-hover dataTable no-footer" id="dataTables-example"
                                role="grid" aria-describedby="dataTables-example_info">
                        <thead>
                            <!-- headers-columns -->
                            <tr role="row">
                                <th style="width: 40px;">Id</th>
                                <th style="width: 110px;">C&oacute;digo</th>                                  
                                <th style="width: 172px;">Nombre</th>
                                <th style="width: 185px;">Drescripci&oacute;n</th>
                                <th style="width: 149px;">Precio</th>
                                <th style="width: 110px;">Costo</th>                                   
                                <th style="width: 204px;">Fecha Creado</th> 
                                <th style="width: 110px;">Saldo</th> 
                                @if(Auth::user()->type == 1)
                                <th style="width: 110px;"></th>          
                                @endif
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @if(isset($products))       
                        @foreach($products as $product) 
                            <tr class="gradeA odd" role="row">
                                <td>{{$product->id}}</td>
                                <td>{{$product->code}}</td>                                   
                                <td>{{$product->name}}</td>
                                <td>{{$product->description}}</td>    
                                <td>${{$product->price}}</td>                            
                                <td>${{$product->cost}}</td>                                                             
                                <td>{{$product->created_at}}</td> 
                                @if($product->type == 'Producto')                               
                                    <td>{{$product->stock}}</td> 
                                @else
                                    <td></td>
                                @endif                                
                                @if(Auth::user()->type == 1)
                                <td style="text-align: center; vertical-align: middle; ">                                    
                                    <span class="product-id" style="display:none">
                                        {{$product->id}}
                                    </span>                                              
                                    <a class="edit_product" role="button" title="Editar">
                                        <i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <a class="delete_product" role="button" title="Eliminar">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>        
                                </td>           
                                @endif
                            </tr>
                        @endforeach    
                        @endif
                        </tbody>
                    </table></div>
                        </div>
                    </div>
                </div>
                <!-- /.datatable-wrapper -->
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div-->        
</div>
<!-- /.row-content -->        
</div>

<div class="modal fade" id="modal-product" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Producto
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="product_id" style="display: none"></div>       
                            <div class="form-group">
                                <label>* C&oacute;digo</label>
                                <input id="product_code" class="form-control">                                
                            </div>                              
                            <div class="form-group">
                                <label>* Nombre</label>
                                <input id="product_name" class="form-control">                                
                            </div>     
                            <div class="form-group">    
                                <label> Decripci&oacute;n</label>
                                <input id="product_description" class="form-control">                                
                            </div>         
                            <div class="form-group">                                 
                                <label>* Existencia</label>
                                <input id="product_stock" class="form-control"> 
                            </div>

                            <div class="form-group">                                 
                            <label>* Tipo</label>
                                <select id="product_type" name="sexo" class="form-control">
                                    <option>Producto</option>
                                    <option>Servicio</option>
                                </select>
                            </div>            

                            <div class="form-group">                                 
                                <label>* Precio</label>
                                <input id="product_price" class="form-control"> 
                            </div>     
                            <div class="form-group">                                 
                                <label>* Costo</label>
                                <input id="product_cost" class="form-control">                                 
                            </div>                                    
                        </div>                        
                    </div>
                </div>
                </div>
		<div id="errors_save_product"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button> 
                    <button id="save_product" type="button" class="btn btn-primary">
                            Guardar
                    </button>
                </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
$(document).ready(function() {

$('#dataTables-example').DataTable({
    paging: true,
    searching: true,    
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
});  

/*
 |------------------------------------------------------------------------
 | Add Product
 |------------------------------------------------------------------------        
*/  

$('#add_product').on('click',function(e){    
    $('#modal-product').modal();
    $('input').val('');
$('#errors_save_product').html("");
$('#errors_save_product').load();
    $('#product_id').html("0");
});

$('#save_product').on('click',function(e){
    var data = {
        codigo : $("#product_code").val(),      
        nombre : $("#product_name").val(),    
        descripcion : $("#product_description").val(),        
        precio : $("#product_price").val(),
        costo : $("#product_cost").val(),
        tipo : $("#product_type").val(),
        saldo : $("#product_stock").val()
    },     
    id = $('#product_id').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/product') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {  
            if(data.success == true){
                alert("¡Producto guardado!");
                window.location.reload();
            }
            else{
                var txt = "Errores de validación : \n";                
                for (i = 0; i < data.errors.length; i++)
                    txt = txt+'\n'+data.errors[i];
		$('#errors_save_product').html("<div class='alert alert-danger'>"+txt+"</div>");
		$('#errors_save_product').load();		                
            }                        
        },
        dataType: 'json'
    });                                          
});

/*
 |------------------------------------------------------------------------
 | Edit Product
 |------------------------------------------------------------------------        
*/  

$('.edit_product').on('click', function(e) {
    var o = $(this),  
    id = o.parents('td:first').find('span.product-id').text();    
    $('input').val('');
    $('#product_id').html(id);        
    fillModal(id);
    $('#modal-product').modal();
});        

function fillModal(id){
    $.ajax({
        type : 'GET',
        url : '{{URL::to('product')}}'+'/'+id,
        datatype: 'json',
        success:function(d){
            $("#product_name").val(d.product.name);                                                        
            $("#product_price").val(d.product.price);
            $("#product_code").val(d.product.code);
            $("#product_cost").val(d.product.cost);
            $("#product_stock").val(d.product.stock);
            $("#product_type").val(d.product.type);
            $("#product_description").val(d.product.description);            
        },
    });
}

/*
 |------------------------------------------------------------------------
 | Delete product
 |------------------------------------------------------------------------        
*/  

$('.delete_product').on('click', function(e) {
    if (!confirm('¿Desea borrar producto?'))
            return false;
    var o = $(this),  
    id = o.parents('td:first').find('span.product-id').text(); 
    $.ajax({
        type : "POST",
        url : '{{URL::to('/product/delete')}}'+'/'+id,
        success: function(data, textStatus, jqXHR){
            if(data.success == true){
                alert("¡Producto eliminado!");
                window.location.replace("/crm_gym/public/products_list");
            }
            else{alert(data.errors);}             
        },
        dataType: 'json'
    });    
    window.location.reload();  
});        

});
</script>
@stop