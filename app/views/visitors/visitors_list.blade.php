@extends ('base_templates.BaseLayout')

@section('content')
<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Visitas de invitados</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2">
                <p>&nbsp;</p>
                    <button id="add_visitor" role="button" type="button" 
                            class="btn btn-outline btn-primary" data-toggle="modal">
                        Agregar visita</button>
                </div>
                 <div class="col-md-4">
                    <p>Fecha inicial</p>
                    <input type="date" class="form-control" id="date_init">
                </div>
                <p>Fecha final</p>
                <div class="col-md-4">
                        <input type="date" class="form-control" id="date_end">
                </div>
                <p></p>
                <div class="col-md-2">
                        <button id="show_between_dates" type="button" class="btn btn-outline btn-primary">Mostrar</button>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
        <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                <th style="width: 50px">Id</th>
                <th>Nombre Completo</th>
                <th>Costo</th>
                <th>Forma de pago</th>
                <th>Referencia de pago</th>
                <th>Fecha/Hora</th>
                <th>Agregado por</th>
                <th style="width: 60px;"><font color ='white'>....</font> </th>
                </tr>
            </thead>
            <tbody>
                @if(isset($visitors))
                    @foreach($visitors as $visitor)
                    <tr class="odd gradeX">
                        <td>{{$visitor->id}}</td>
                        <td>{{$visitor->first_name}}&nbsp;{{$visitor->last_name}}&nbsp;{{$visitor->second_last_name}}</td>                                          
                        <td>${{$visitor->amount}}</td>
                        <td>{{$visitor->method_payment}}</td>
                        <td>{{$visitor->reference_payment}}</td>
                        <td>{{$visitor->created_at}}</td>
                        <td>{{$visitor->user_name}}</td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="visitor-id" style="display: none">
                                {{$visitor->id}}
                            </span>                              
                            <a role="button" class="edit_visit"  title="Edit" 
                               data-toggle="modal" style="cursor:pointer">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a> 
                            @if(Auth::user()->type == 1)                                    
                            <a role="button" class="delete_visitor"  title="Remove">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                            @endif
                        </td>
                    </tr>                    
                    @endforeach
                @endif
            </tbody>
        </table>
        </div>
        </div>
        </div>
    </div>
    </div>
    
    <div class="modal fade" id="visitor_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="header_modal">Agregar visita</h4>
            </div>
        <div class="modal-body">
        <form role="form">
            <div id="visitor_id_edit" style="display: none"></div>
            <div class="form-group">
                <label for="name">* Nombre</label>
                <input id="first_name" type="text" class="form-control" id="name" 
                       placeholder="Nombre">
            </div>
            <div class="form-group">
                <label for="apellido">* Apellido paterno</label>
                <input id="last_name" type="text" class="form-control" id="apellido" 
                       placeholder="Apellido paterno">
            </div>
            <div class="form-group">
                <label for="costo">Apellido materno</label>
                <input id="second_last_name" type="text" class="form-control" id="costo" 
                       placeholder="Apellido materno">
            </div>
            <div class="form-group">
                <label for="costo">* Costo por visita</label>
                <input id="amount" type="text" class="form-control" id="costo" 
                       placeholder="Costo">
            </div>            
            <div class="form-group">
                <label >* Forma de pago</label>
                <select id="method_payment" class="form-control">
                    <option>Efectivo</option>
                    <option>Tarjeta</option>
                    <option>Depósito</option>
                    <option>Transferencia</option>
                    <option>Cheque</option>
                    <option>Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="referenciapago">Referencia de pago</label>
                <input id="reference_payment" type="text" class="form-control" id="costo" 
                       placeholder="Referencia de pago">
            </div>
        </form>
        </div>
	<div id="errors_save_visitor"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
            <button id="save_visitor" type="button" class="btn btn-primary">Guardar</button>
        </div>
        </div>
        </div>
    </div>    
    
</div>
@endsection

@section('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
        
$('#dataTables-example').DataTable({
    paging: true,
    searching: true,    
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
});    
    
$('#add_visitor').on('click', function() {
    $('#header_modal').html("Agregar vista");
    $('#visitor_id_edit').html("0");
$('#errors_save_visitor').html("");
$('#errors_save_visitor').load();
    $('#visitor_modal').modal();
});

$('#save_visitor').on('click', function() {    
    var data = {            
        nombre :$("#first_name").val(),
        apellido_paterno :$("#last_name").val(),
        apellido_materno :$("#second_last_name").val(),
        metodo_de_pago :$("#method_payment").val(),
        cantidad : $('#amount').val(),
        referencia_de_pago :$("#reference_payment").val()                       
    }, 
    id = $('#visitor_id_edit').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/visitor') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {     
            if(data.success == true){
                alert('¡Visita guardada!'); 
                window.location.reload();
            }
            else{
                if(data.errors == 'NO TURN'){
                    if (!confirm('¿No hay turno habilitado. ¿Desea crear un nuevo turno?'))
                        return false;   
                    $.ajax({
                        type: "POST",
                        url: '{{ URL::to('/turn_user/create') }}',
                        success: function(d, textStatus, jqXHR) {  
                            if(d.success == true){   
                                alert('¡Turno Agregado!');     
                                window.location.reload();
                            }
                            else{
				$('#errors_save_visitor').html("<div class='alert alert-danger'>"+data.errors+"</div>");
				$('#errors_save_visitor').load();
				}                        
                        },
                        dataType: 'json'
                    });                         
                }else{
                    var txt = "Errores de validación : \n";                
                    for (i = 0; i < data.errors.length; i++)
                        txt = txt+'\n'+data.errors[i];
			$('#errors_save_visitor').html("<div class='alert alert-danger'>"+txt+"</div>");
			$('#errors_save_visitor').load();             
                }                
            }                        
        },
        dataType: 'json'
    });                  
});

$('.delete_visitor').on('click', function() {
    if (!confirm('¿Desea borrar la visita?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.visitor-id').text(); 
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/visitor/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert("¡Visita eliminada!");
                window.location.replace("/crm_gym/public/visitors_list");
            }
            else{alert(data.errors);}                        
        },
        dataType: 'json'
    });              
    window.location.reload();     
});

$('.edit_visit').on('click', function() {
    var o = $(this),
    id = o.parents('td:first').find('span.visitor-id').text();
    $('#header_modal').html("Editar vista");
    $('#visitor_id_edit').html(id);
    fillModalVisitor(id);
    $('#visitor_modal').modal();
});

function fillModalVisitor(id)
{
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/visitor') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $('#first_name').val(d.visitor.first_name);
            $('#last_name').val(d.visitor.last_name);
            $('#second_last_name').val(d.visitor.second_last_name);
            $('#amount').val(d.visitor.amount);
            $('#method_payment').val(d.visitor.method_payment);
            $('#reference_payment').val(d.visitor.reference_payment);                          
        }
    });    
}

$('#show_between_dates').on('click', function() {   
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;

    window.location.replace("visitors_list/"+params);
});  

});
</script>
@endsection