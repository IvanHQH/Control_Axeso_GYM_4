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
                            <input type="date" class="form-control" id="date_init" value="{{$date_init}}">                                                                 
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->    
                    <div class="col-md-4">
                      <div class="input-group">   
                        <label for="date_end">Fecha Final</label>
                            <input type="date" class="form-control" id="date_end" value="{{$date_end}}">   
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 --> 
                    <div class="col-lg-4">
                        <div class="input-group"><br>        
                            <button type="button" class="btn btn-outline btn-primary" 
                                    id="show_between_dates">
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
                        <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered 
                                table-hover dataTable no-footer" id="dataTables-example"
                                role="grid" aria-describedby="dataTables-example_info">
                        <thead>
                            <!-- headers-columns -->
                            <tr role="row">
                                <th>Id</th>
                                <th>Nombre Socio</th>
                                <th>Concepto de Pago</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Forma de pago</th>
                                <th>Fecha/Hora</th>           
                                <th style="width: 70px"></th>                                   
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>    
                        @if(isset($payments))
                        @foreach($payments as $payment) 
                            <tr class="gradeA odd" role="row">
                                <td>{{$payment->payment_id}}</td>
                                <td>{{$payment->middle_name}}</td>
                                <td>{{$payment->concept}}</td>
                                <td>{{$payment->description}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->method_payment}}</td>
                                <td>{{$payment->created_at}}</td>
                                <td style="text-align: center; vertical-align: middle; ">
                                    <span class="payment-id" style="display: none">
                                        {{$payment->payment_id}}
                                    </span>                                      
                                    <a class="edit_membership_paymet" class="edit ml10" style="cursor: pointer" title="Editar">
                                        <i class="glyphicon glyphicon-edit">                                    
                                        </i>
                                    </a>
                                    <a class="delete_membership_paymet" class="remove ml10" style="cursor: pointer" title="Eliminar">
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
                                    <option>Cheque</option>
                                    <option>Otro</option>
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

$('#dataTables-example').dataTable( {
    paging: true,
    searching: true,    
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
} ); 

$('#show_between_dates').on('click', function() {
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;
    window.location.replace("/crm_gym/public/memberships_paymets/"+params);
});

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
        type: "POST",
        url: '{{ URL::to('/payment/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert("¡Pago eliminado!");
                window.location.replace("/crm_gym/public/memberships_paymets");
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
