@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pagos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- row-content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-4">
                      <div class="input-group">   
                        <label for="date_ini">Fecha Inicial</label>
                            <input type="date" class="form-control" id="date_init">                                                                 
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->    
                    <div class="col-md-4">
                      <div class="input-group">   
                        <label for="date_end">Fecha Final</label>
                            <input type="date" class="form-control" id="date_end">   
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 --> 
                    <div class="col-lg-4">
                        <div class="input-group"><br>        
                            <button type="button" class="btn btn-outline btn-primary" 
                                    id="btn-show-excess">
                                Mostrar
                            </button>             
                        </div><!-- /input-group -->                        
                    </div><!-- /.col-lg-6 -->                      
                </div><!-- /.row -->                  
            </div>
            <!-- /.panel-heading -->
            <!-- panel-body -->
            <div class="panel-body">
                <!-- datatable-wrapper -->
                <div class="dataTable_wrapper">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper 
                         form-inline dt-bootstrap no-footer">
                        <!-- show-entries -->
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="dataTables_length" id="dataTables-example_length">
                                <label>Mostrar 
                                    <select name="dataTables-example_length" 
                                    aria-controls="dataTables-example" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> filas
                                </label>
                            </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="dataTables-example_filter" class="dataTables_filter">
                                    <label>Buscar:
                                        <input type="search" class="form-control input-sm" 
                                            placeholder="" aria-controls="dataTables-example">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.show-entries -->
                        <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered 
                                table-hover dataTable no-footer" id="dataTables-example"
                                role="grid" aria-describedby="dataTables-example_info">
                        <thead>
                            <!-- headers-columns -->
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" 
                                aria-controls="dataTables-example" rowspan="1" colspan="1" 
                                aria-sort="ascending" 
                                aria-label="Rendering engine: activate to sort column descending" 
                                style="width: 172px;">Nombre Socio
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" 
                                style="width: 204px;">Concepto de Pago
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" 
                                style="width: 185px;">Descripción
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" 
                                colspan="1" aria-label="Engine version: activate to sort column ascending" 
                                style="width: 149px;">Cantidad
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">Forma de pago
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">Fecha/Hora
                                </th>          
                                <!--th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">Recibido Por
                                </th-->        
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">
                                </th>                                  
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>    
                        @if(isset($payments))
                        @foreach($payments as $payment) 
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">{{$payment->middle_name}}</td>
                                <td>{{$payment->concept}}</td>
                                <td class="center">{{$payment->description}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->method_payment}}</td>
                                <td>{{$payment->created_at}}</td>
                                <td style="text-align: center; vertical-align: middle; ">
                                    <span class="payment-id" style="display: none">
                                        {{$payment->payment_id}}
                                    </span>                                      
                                    <a class="edit_membership_paymet" class="edit ml10" href="javascript:void(0)" title="Editar">
                                        <i class="glyphicon glyphicon-edit">                                    
                                        </i>
                                    </a>
                                    <a class="delete_membership_paymet" class="remove ml10" href="javascript:void(0)" title="Eliminar">
                                        <i class="glyphicon glyphicon-remove">                                    
                                        </i>
                                    </a>                                 
                                </td>                                 
                            </tr>  
                        @endforeach
                        @endif
                        </tbody>
                    </table></div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries
                            </div>                                    
                        </div>
                        <div class="col-sm-6">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                            <ul class="pagination">
                            <li class="paginate_button previous disabled" aria-controls="dataTables-example" 
                                tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li>
                            <li class="paginate_button active" aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">1</a></li>
                            <li class="paginate_button " aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">2</a></li>
                            <li class="paginate_button " aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">3</a></li>
                            <li class="paginate_button " aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">4</a></li>
                            <li class="paginate_button " aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">5</a></li>
                            <li class="paginate_button " aria-controls="dataTables-example" 
                                tabindex="0"><a href="#">6</a></li>
                            <li class="paginate_button next" aria-controls="dataTables-example" 
                                tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li>
                            </ul>
                            </div>
                        </div>
                        </div></div>
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


<div class="modal fade" id="modal-membership-paymet" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                        Editar pago
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="payment_edit" style="display: none"></div>
                            <div class="form-group">    
                                <label>Socio ID</label>
                                <input id="payment_member_id" class="form-control">                               
                            </div>                               
                            <div class="form-group">
                                <label>Concepto</label>
                                <select id="payment_concept" class="form-control">
                                    <option>MEMBRESIA</option>
                                    <option>MEMBRESIA NUEVA</option>
                                    <option>VENTA PRODUCTO</option>
                                </select>                               
                            </div>     
                            <div class="form-group">    
                                <label>Descripción</label>
                                <input id="payment_description" class="form-control">                               
                            </div>         
                            <div class="form-group">    
                                <label>Cantidad</label>
                                <input id="payment_amount" class="form-control">                               
                            </div>                                   
                            <div class="form-group">
                                <label>Agregada por</label>
                                <select id="payment_add_for" class="form-control">
                                    <option>Usuario 1</option>
                                    <option>Usuario 2</option>
                                    <option>Usuario 3</option>
                                </select>                               
                            </div>     
                            <div class="form-group">                            
                                <label>Forma de Pago</label>
                                <select id="payment_method" class="form-control">
                                    <option>Tarjeta</option>
                                    <option>Depósito</option>
                                    <option>Transferencia</option>
                                    <option>Efectivo</option>
                                </select>                            
                            </div>                             
                        </div>                        
                    </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button> 
                    <button id="payment_save" type="button" class="btn btn-primary">
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

/*
|------------------------------------------------------------------------
| Edit Payments
|------------------------------------------------------------------------
*/

function fillPayment(id)
{
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/payment') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {  
            if(d.success == true){
                $("#payment_member_id").val(d.payment.member_id);
                $("#payment_concept").val(d.payment.concept);
                $("#payment_description").val(d.payment.description);
                $("#payment_amount").val(d.payment.amount);
                $("#payment_method").val(d.payment.method_payment);            
            }else{
                alert(d.errors)
            }
        }
    });
}

$("#payment_save").on('click', function(e) {       
    var data = {        
        memberId:$("#payment_member_id").val(),
        amount:$("#payment_amount").val(),
        concept:$("#payment_concept").val(),
        method:$("#payment_method").val(),     
        description:$("#payment_description").val()                                                                  
    };
    alert(data.memberId+" "+data.amount+" "+data.concept+" "+data.method+" "+data.description);
    id = $('#payment_edit').text();         
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/payment/edit') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                window.location.reload();
            }
            else{alert(data.errors);}                        
        },
        dataType: 'json'
    });              
    window.location.reload();
});

$('.edit_membership_paymet').on('click', function(e) {   
    var o = $(this);
    var id = o.parents('td:first').find('span.payment-id').text(); 
    //alert(id);
    $('#payment_edit').html(id);    
    fillPayment(id);
    $('#modal-membership-paymet').modal();
});

/*
|------------------------------------------------------------------------
| Delete Payments
|------------------------------------------------------------------------
*/

$('.delete_membership_paymet').on('click', function(e) {
    if (!confirm('¿Desea borrar el pago?'))
            return false;
    var o = $(this),
    id = o.parents('td:first').find('span.payment-id').text();  
    $.ajax({
        type: "DELETE",
        url: '{{ URL::to('/payment') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                window.location.reload();
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
