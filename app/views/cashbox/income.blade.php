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
                    <th style="width: 40px">Id</th>
                    <th style="width: 40px">Venta</th>
                    <th>Descripción</th>
                    <th style="width: 40px">Cant.</th>
                    <th style="width: 40px">Subtotal</th>
                    <th>Empleado</th>
                    <th>Fecha/Hora</th>
		    <th>M&eacute;todo de pago</th>
                    <th>NFC</th>
                    <th><font color ='white'>....</font> </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($incomes))
                    @foreach($incomes as $income)
                    <tr class="odd gradeX">
                        <td>{{$income->id}}</td>
                        <td>{{$income->income_ms_id}}</td>
                        <td>{{$income->description}}</td>
                        <td>{{$income->quantity}}</td>
                        <td>${{$income->subtotal}}</td>
                        <td>{{$income->user_name}}</td>
                        <td>{{$income->created_at}}</td>
			<td>{{$income->method_payment}}</td>
                        <td>{{$income->nfc_payment}}</td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="income-id" style="display:none">
                                {{$income->id}}
                            </span>      
                            <a  role="button" class="edit_income" 
                                title="Editar" data-toggle="modal">
                                <i class="glyphicon glyphicon-edit">                                
                                </i>
                            </a> 
                            @if(Auth::user()->type == 1) 
                            <a role="button" class="delete_income" title="Eliminar">
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

                <div class="row">
                    <div class="col-md-2">
                        <label for="description">C&oacute;digo:</label>
                    </div>
                    <div class="col-md-8"> 
                        <input id="code" type="text" class="form-control" 
                            placeholder="Intoduzca el código del producto para agregarlo"
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
                            <th>Precio</th>
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
                   <div class="form-group">                    
                    <div class="row">
                        <div class="col-md-4">
                            <button id="delete_payment_nfc" type="button" class="btn btn-outline btn-danger btn-lg">Borrar pago NFC</button>                        
                        </div>                         
                        <div class="col-md-8">
                            <button id="recive_payment_nfc" type="button" 
                                    class="btn btn-outline btn-primary btn-lg btn-block">
                                Recibir pago NFC</button>                        
                        </div>            
                    </div> 
                </div>            
                <div class="form-group">
                    <div id="member_id" style="display: none"></div>
                    <p class="text-center" id="member_name_of_nfc_card" style="font-size: 25px"><h2></h2></p>
                </div>                    
            </div>
        <div class="row">				
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <div class="form-group">         
                    <label> Referencia</label>
                    <input id="reference_income" class="form-control">
                </div>                
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>* Forma de Pago</label>
                    <select id="method_payment_income" class="form-control">
                        <option>Efectivo</option>
                        <option>Tarjeta</option>
                        <option>Dep&oacute;sito</option>
                        <option>Transferencia</option>
                        <option>Cheque</option>
                        <option>Otro</option>
                    </select>
                </div>                    
            </div>  
            <div class="col-md-1"></div> 								
        </div>  
	    <div id="errors_save_income"></div>
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
        
$('#recive_payment_nfc').on('click', function() {  
    $("#member_name_of_nfc_card").html("");
    $("#member_name_of_nfc_card").load();
    $("#errors_save_income").html("");
    $.ajax({
        type: "GET",
        url: '{{ URL::to('/get_code_payment_nfc') }}',
        success: function(data, textStatus, jqXHR) {                    
            if(data.success == true){       
                $("#member_name_of_nfc_card").html(data.info.member_name+" - Crédito $"+data.info.credit);
                $("#member_name_of_nfc_card").load();
                $("#member_id").html(data.info.member_id);
                $("#member_id").load();
            }
            else{
		$('#errors_save_income').html("<div class='alert alert-danger'>"+data.errors+"</div>");
		$('#errors_save_income').load();
		}       
        },
        dataType: 'json'
    });                  
});

$('#delete_payment_nfc').on('click', function() {  
    $("#member_name_of_nfc_card").html("");
    $("#member_name_of_nfc_card").load();
    $("#member_id").html("0");
    $("#member_id").load();                     
});
                        
$('#dataTables-example').DataTable({
    paging: true,
    searching: true,    
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
});   

$('.delete_income').on('click', function() {
    if (!confirm('Desea borrar el registro?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.income-id').text();  
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/income_ms/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert("¡Ingreso eliminado!");
                window.location.replace("/crm_gym/public/incomes");
            }
            else{
		$('#errors_save_income').html("<div class='alert alert-danger'>"+data.errors+"</div>");
		$('#errors_save_income').load();
		}                        
        },
        dataType: 'json'
    });              
    window.location.reload();     
});
    
$('#add_income').on('click', function() {
    $('#header_modal').html("Agregar ingreso");
    $("#member_name_of_nfc_card").html("");
    $('#income_id_edit').html("0");
    $("#member_id").html("0");
    $('#tb_products').html("");
    $('#tb_products').load();
	$('#errors_save_income').html("");
	$('#errors_save_income').load();
    $('#modal_income').modal();
});    
    
$('#save_income').on('click', function() {    
    var tblprods = document.getElementById('tbl_products');
    var rows = tblprods.getElementsByTagName("tr"); 
    var prods = new Array();
    if(rows.length==1){
	$('#errors_save_income').html("<div class='alert alert-danger'>¡Debe ingresar por lo menos un producto!</div>");
	$('#errors_save_income').load();	
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
        total :$("#total").html(),
        member_id : $("#member_id").html(),
        metodo_de_pago: $('#method_payment_income').val(),
        referencia: $('#reference_income').val()
    };
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/income_ms') }}',
        data: data,
        success: function(data, textStatus, jqXHR) {     
            if(data.success == true){
                alert("¡Ingreso guardado!");
                window.location.replace("/crm_gym/public/incomes");
            }
            else{
                if(data.errors == 'NO TURN'){
                    if (!confirm('¿No hay turno habilitado. ¿Desea crear un nuevo turno?'))
                        return false;   
                    $.ajax({
                        type: "POST",
                        url: '{{ URL::to('/turn_user/create') }}',
                        success: function(d, textStatus, jqXHR) {  
                            if(d.success == true){alert('¡Turno Agregado!');}
                            else{
                				$('#errors_save_income').html("<div class='alert alert-danger'>"+data.errors+"</div>");
                				$('#errors_save_income').load();	
        				    }                        
                        },
                        dataType: 'json'
                    });                         
                }else{
                    var txt = "Errores de validación : \n";                
                    for (i = 0; i < data.errors.length; i++)
                        txt = txt+'\n'+data.errors[i];
			$('#errors_save_income').html("<div class='alert alert-danger'>"+txt+"</div>");
			$('#errors_save_income').load();            
                }                   
            }                        
        },
        dataType: 'json'
    });          
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

    window.location.replace("/crm_gym/public/incomes/"+params);
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
                    "<td id = 'price-"+rows.length+"'>"+data.prod.price+"</td>"+
                    "<td id = 'subtotal-"+rows.length+"'>"+data.prod.price+"</td>"+
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