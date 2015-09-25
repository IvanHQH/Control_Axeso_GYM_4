@extends ('base_templates.BaseLayout')

@section('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Egresos</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-2">
                        <p>&nbsp;</p>
                        <button id="add_outcome" role="button" type="button" class="btn btn-outline btn-primary" 
                                data-toggle="modal">Agregar Egreso</button>
                    </div>
                    <div class="col-md-4">
                        <p>Fecha inicial</p>
                        <input type="date" class="form-control" id="date_init" value="{{$date_init}}">
                    </div>
                    <p>Fecha final</p>
                    <div class="col-md-4">
                        <input type="date" class="form-control" id="date_final" value="{{$date_end}}">
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
                            <th>Descripción del egreso</th>
                            <th>Cantidad</th>
                            <th>Empleado</th>
                            <th>Fecha/Hora</th>
                            <th><font color ='white'>....</font> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($outcomes))
                        @foreach($outcomes as $outcome)
                        <tr class="odd gradeX">
                            <td>{{$outcome->description}}</td>
                            <td>${{$outcome->subtotal}}</td>
                            <td>{{$outcome->user_name}}</td>
                            <td>{{$outcome->created_at}}</td>
                            <td style="text-align: center; vertical-align: middle; ">
                                <span class="outcome-id" style="display:none">
                                    {{$outcome->id}}
                                </span>                             
                                <a  role="button" class="edit_outcome" 
                                    title="Editar" data-toggle="modal">
                                    <i class="glyphicon glyphicon-edit">                                
                                    </i>
                                </a> 
                                <a class="delete_outcome" title="Eliminar">
                                    <i class="glyphicon glyphicon-remove">                                    
                                    </i>
                                </a>
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
    
<div class="modal fade" id="modal_outcome" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Asistente para agregar</h4>
            </div>
            <div class="modal-body">
            <div id="outcome_id_edit" style="display:none"></div>    
            <div class="form-group">
                <label for="description">Descripción del egreso:</label>
                <input id="outcome_description" type="text" class="form-control" id="name" 
                       placeholder="descripción del egreso">
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input id="outcome_amount" type="text" class="form-control" id="cantidad" 
                       placeholder="Cantidad">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
                <button id="save_outcome" type="button" class="btn btn-primary">Guardar</button>
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
    responsive: true
});   

$('.delete_outcome').on('click', function() {
    if (!confirm('Desea borrar el registro?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.outcome-id').text();  
    $.ajax({
        type: "DELETE",
        url: '{{ URL::to('/outcome_ms') }}' + '/' + id,
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
    
$('#add_outcome').on('click', function() {
    $('#outcome_id_edit').html("0");
    $('#modal_outcome').modal();
});    
    
$('#save_outcome').on('click', function() {
    var data = {            
        description :$("#outcome_description").val(),
        amount :$("#outcome_amount").val()                      
    }; 
    id = $('#outcome_id_edit').text();
    //alert(data.description+" "+data.amount);
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/outcome_ms') }}' + (typeof id !== 'undefined'?('/' + id):''),
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
    
$('.edit_outcome').on('click', function() {
    var o = $(this),
    id = o.parents('td:first').find('span.outcome-id').text(); 
    $('#outcome_id_edit').html(id);    
    filloutcome(id);
    $('#modal_outcome').modal();
});      
    
function filloutcome(id){
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/outcome') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $("#outcome_description").val(d.outcome.description),
            $("#outcome_amount").val(d.outcome.subtotal)                         
        }
    });    
} 
    
$('#show_between_dates').on('click', function() {
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;

    window.location.replace("http://axeso_gym.dev/incomes/"+params);
});      
    
});
</script>
@endsection