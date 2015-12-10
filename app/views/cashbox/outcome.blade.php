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
                    <th style="width: 40px">Id</th>
		    <th style="width: 40px">Egreso</th>
                    <th>Descripci&oacute;n</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Empleado</th>
                    <th>Fecha/Hora</th>
                    <th><font color ='white'>....</font> </th>
                </tr>
            </thead>
            <tbody>
                @if(isset($outcomes))
                @foreach($outcomes as $outcome)
                <tr class="odd gradeX">
		    <td>{{$outcome->id}}</td>
                    <td>{{$outcome->outcome_ms_id}}</td>
                    <td>{{$outcome->description}}</td>
                    <td>{{$outcome->quantity}}</td>
                    <td>${{$outcome->subtotal}}</td>
                    <td>{{$outcome->user_name}}</td>
                    <td>{{$outcome->created_at}}</td>
                    <td style="text-align: center; vertical-align: middle; ">
                        <span class="outcome-id" style="display:none">
                            {{$outcome->id}}
                        </span>             
                        <a  role="button" class="edit_outcome" title="Editar" >
                            <i class="glyphicon glyphicon-edit">                                
                            </i>
                        </a> 
                        @if(Auth::user()->type == 1)
                        <a role="button" class="delete_outcome" title="Eliminar">
                            <i class="glyphicon glyphicon-remove">                                    
                            </i>
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
    
    <div class="modal fade" id="modal_outcome" role="dialog" 
             aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                        aria-hidden="true">x</button>
                <h4 id="header_modal" class="modal-title" id="myModalLabel">Agregar egreso</h4>
            </div>
            <div class="modal-body">
                <div id="outcome_id_edit" style="display:none"></div>            

                <div class="row">
                    <div class="col-md-2">
                        <label for="description">C&oacute;digo:</label>
                    </div>
                    <div class="col-md-8"> 
                        <input id="code" type="text" class="form-control" 
                            placeholder="Intoduzca el c&oacute;digo del producto para agregarlo"
                            value="">                  
                    </div>                    
                    <div class="col-md-2">            
                        <button id="add-product" type="button" class="btn btn-outline btn-primary">
                            <i class="fa fa-search-plus"></i></button>                    
                    </div>
                </div>    

                <div class="table-responsive">
                <table id="tbl_products" class="table table-striped">
                    <thead>
                        <tr>
                            <th>C&oacute;digo</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Subtotal</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="tb_products">
                    </tbody>
                </table>                
                </div>
                <div class="row">
                    <div class="col-md-7"></div>
                    <div class="col-md-2"><h4>Total</h4></div> 
                    <div class="col-md-2"><h4 id="total"></h4></div> 
                    <div class="col-md-1"></div>
                </div>                                   
            </div>
		<div id="errors_save_outcome"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" 
                        data-dismiss="modal">Cerrar</button> 
                <button id="save_outcome" type="button" class="btn btn-primary">Guardar
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
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
});   

$('.delete_outcome').on('click', function() {
    if (!confirm('¿Desea borrar el egreso?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.outcome-id').text();  
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/outcome_ms/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert('¡Egreso eliminado!');
                window.location.replace("/crm_gym/public/outcomes");
            }
            else{alert(data.errors);}                        
        },
        dataType: 'json'
    });              
    window.location.reload();     
});
    
$('#add_outcome').on('click', function() {
    $('#outcome_id_edit').html("0");
$('#errors_save_outcome').html("");
$('#errors_save_outcome').load();
    $('#modal_outcome').modal();
});    

$('#save_outcome').on('click', function() {
    var tblprods = document.getElementById('tbl_products');
    var rows = tblprods.getElementsByTagName("tr"); 
    var prods = new Array();
    if(rows.length==1){
$('#errors_save_outcome').html("<div class='alert alert-danger'>&#161;Debe ingresar por lo menos un producto!</div>");
$('#errors_save_outcome').load();	
        return false;
    }            
    //init at one why header table descriptiod
    for (i = 1; i < rows.length; i++) {
        var prod = new Array();
        prod.push(rows[i].getElementsByTagName("td")[0].innerHTML);
        prod.push(rows[i].getElementsByTagName("td")[2].getElementsByTagName("input")[0].value);
        prods.push(prod);
    }
    var data = {            
        products : prods,
        total :$("#total").html()
    };
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/outcome_ms') }}',
        data: data,
        success: function(data, textStatus, jqXHR) {     
            if(data.success == true){
                alert("Â¡Egreso guardado!");
                window.location.replace("/crm_gym/public/outcomes");
            }
            else{
                if(data.errors == 'NO TURN'){
                    if (!confirm('Â¡No hay turno habilitado!. ¿Desea crear un nuevo turno?'))
                        return false;   
                    $.ajax({
                        type: "POST",
                        url: '{{ URL::to('/turn_user/create') }}',
                        success: function(d, textStatus, jqXHR) {  
                            if(d.success == true){alert('¡Turno Agregado!');}
                            else{
				$('#errors_save_outcome').html("<div class='alert alert-danger'>"+data.errros+"</div>");
				$('#errors_save_outcome').load();
				}                        
                        },
                        dataType: 'json'
                    });                         
                }else{
                    var txt = "Errores de validación : \n";                
                    for (i = 0; i < data.errors.length; i++)
                        txt = txt+'\n'+data.errors[i];
			$('#errors_save_outcome').html("<div class='alert alert-danger'>"+txt+"</div>");
			$('#errors_save_outcome').load();	               
                }                   
            }                        
        },
        dataType: 'json'
    });              
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

    window.location.replace("/crm_gym/public/outcomes/"+params);    
});      

function sumTotal(){
    var total = 0;
    var table = document.getElementById("tbl_products");
    for (var i = 1, row; row = table.rows[i]; i++) {
        total = total + parseInt(row.cells[4].innerHTML);
    }    
    $('#total').html(total);
    $('#total').load();      
}

$('#add-product').on('click',function(){       
    var data = {            
        code : $('#code').val()
    }; 
    id = $('#income_id_edit').text();
    $.ajax({
        type: "GET",
        url: '{{ URL::to('/product_find') }}' + (typeof id !== 'undefined'?('/' + data.code):''),
        data: data,
        success: function(data, textStatus, jqXHR) {     
            if(data.success == true){
                
                var tblprods = document.getElementById('tbl_products');
                var rows = tblprods.getElementsByTagName("tr");                
                
                var tbprods = $('#tb_products');
                tbprods.append("<tr id='row-"+rows.length+"'>"+
                    "<td>"+data.prod.code+"</td>"+
                    "<td>"+data.prod.name+"</td>"+
                    "<td>"+"<input id='input-"+rows.length+"' style='width:30px' type='text' value='1'> "+"</td>"+
                    "<td id = 'price-"+rows.length+"'>"+data.prod.cost+"</td>"+
                    "<td id = 'subtotal-"+rows.length+"'>"+data.prod.cost+"</td>"+
                    "<td style='width:30px'><button id='delete-prod-"+rows.length+"' type='button' class='btn btn-outline btn-danger btn-xs'>x</button></td></tr>");
                $('#tb_products').load();
                sumTotal(); 
                
                var index = rows.length-1;
                
                var input = document.getElementById('input-'+(index)); 
                input.addEventListener("keyup", function(){
                    var subtotal = document.getElementById('subtotal-'+(index));
                    var price = document.getElementById('price-'+(index));
                    subtotal.innerHTML = this.value * price.innerHTML;
                    sumTotal();                   
                });    
                
                var btnDel = document.getElementById('delete-prod-'+(index)); 
                btnDel.addEventListener("click", function(){
                    var row = this.parentNode.parentNode;
                    document.getElementById('tb_products').removeChild(row);
                    $('#tbl_products').load()
                    sumTotal(); 
                });        
                $('#code').val("");
                $('#code').load();
            }
            else{

            }                        
        },
        dataType: 'json'
    });    
    
});

});
</script>
@endsection