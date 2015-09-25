@extends ('base_templates.BaseLayout')

@section('content')
<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ingresos</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2">
                <p>&nbsp;</p>
                <button id="add_income" role="button" 
                        type="button" class="btn btn-outline btn-primary" data-toggle="modal">
                    Agregar Ingreso
                </button>
                </div>
                <div class="col-md-4">
                    <p>Fecha inicial</p>
                    <input type="date" class="form-control" id="date_init" value="{{$date_init}}">
                </div>
                <p>Fecha final</p>
                <div class="col-md-4">
                    <input type="date" class="form-control" id="date_end" value="{{$date_end}}">
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
                    <th>Descripción del ingreso</th>
                    <th>Cantidad</th>
                    <th>Empleado</th>
                    <th>Fecha/Hora</th>
                    <th><font color ='white'>....</font> </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($incomes))
                    @foreach($incomes as $income)
                    <tr class="odd gradeX">
                        <td>{{$income->description}}</td>
                        <td>${{$income->subtotal}}</td>
                        <td>{{$income->user_name}}</td>
                        <td>{{$income->created_at}}</td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="income-id" style="display:none">
                                {{$income->id}}
                            </span>                             
                            <a  role="button" class="edit_income" 
                                title="Editar" data-toggle="modal">
                                <i class="glyphicon glyphicon-edit">                                
                                </i>
                            </a> 
                            <a class="delete_income" title="Eliminar">
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
    
<div class="modal fade" id="modal_income" role="dialog" 
         aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" 
                    aria-hidden="true">×</button>
            <h4 id="header_modal" class="modal-title" id="myModalLabel">Agregar ingreso</h4>
        </div>
        <div class="modal-body">
            <div id="income_id_edit" style="display:none"></div>            
            <div class="form-group">
                <label for="description">Descripción del ingreso:
                </label>
                <input id="income_description" type="text" class="form-control" id="name" 
                       placeholder="descripción del ingreso">
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input id="income_amount" type="text" class="form-control" 
                       id="cantidad" placeholder="Cantidad">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" 
                    data-dismiss="modal">Cerrar</button> 
            <button id="save_income" type="button" class="btn btn-primary">Guardar
            </button>
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

$('.delete_income').on('click', function() {
    if (!confirm('Desea borrar el registro?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.income-id').text();  
    $.ajax({
        type: "DELETE",
        url: '{{ URL::to('/income_ms') }}' + '/' + id,
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
    
$('#add_income').on('click', function() {
    $('#header_modal').html("Agregar ingreso");
    $('#income_id_edit').html("0");
    $('#modal_income').modal();
});    
    
$('#save_income').on('click', function() {
    var data = {            
        description :$("#income_description").val(),
        amount :$("#income_amount").val()                      
    }; 
    id = $('#income_id_edit').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/income_ms') }}' + (typeof id !== 'undefined'?('/' + id):''),
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
    
$('.edit_income').on('click', function() {
    var o = $(this),
    id = o.parents('td:first').find('span.income-id').text();
    $('#header_modal').html("Editar ingreso");
    $('#income_id_edit').html(id);    
    fillIncome(id);
    $('#modal_income').modal();
});      
    
function fillIncome(id){
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/income') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $("#income_description").val(d.income.description),
            $("#income_amount").val(d.income.subtotal)                         
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