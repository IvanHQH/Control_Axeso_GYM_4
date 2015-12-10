@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">        
    <div class="col-lg-12">                        
        <h1 class="page-header">Socios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- Table -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
    <!-- /.panel-heading -->
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-4">                            
                <button id="add_member" type="button" class="btn btn-outline btn-primary" 
                         data-toggle="modal">
                    Agregar
                </button>                            
            </div>
        </div>             
    </div>
    <!-- panel-body -->
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <!--table class="table table-striped table-bordered table-hover" id="dataTables-example"-->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">                     
            <thead>
                <!-- headers-columns -->
                <tr role="row">
                    <th>Id</th>
                    <th>Nombre Completo</th>
                    <th>Direcci&oacute;n</th>
                    <th>Colonia</th>          
                    <th>Ciudad</th>      
                    <th>Estado</th>     
                    <th>Tel. M&oacute;vil</th>         
                    <th>Registrado</th>       
                    <th>Tarjeta NFC</th>       
                    <th style="width: 70px"></th>                                 
                </tr>
                <!-- /.headers-columns -->
            </thead>
            <tbody>
            @if(isset($members))    
            @foreach($members as $member)      
                <tr class="gradeA odd" role="row">
                    <td>{{$member->id}}</td>                        
                    <td>{{$member->full_name}}</td>
                    <td>{{$member->address}}</td>
                    <td>{{$member->neighborhood}}</td>
                    <td>{{$member->city}}</td>
                    <td>{{$member->town}}</td>
                    <td>{{$member->cell_phone}}</td>
                    <td>{{$member->created_at}}</td>
                    <td>{{$member->code_nfc}}</td>
                    <td style="text-align: center; vertical-align: middle; ">
                        <span class="member-id" style="display:none">
                            {{$member->id}}
                        </span>          
                        @if(Auth::user()->type == 1)
                        <a class ="edit_member" style="cursor: pointer" title="Editar">
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        <a class ="delete_member" style="cursor: pointer" title="Eliminar">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>       
                        @endif
                        <a class = "add_pay" style="cursor: pointer" title="Pago">
                            <i class="glyphicon glyphicon-usd"></i>
                        </a>   
                        <a class = "add_membership" style="cursor: pointer" title="Agregar Membres&iacuet;a">
                            <i class="glyphicon glyphicon-credit-card"></i>
                        </a>         
                    </td>                                
                </tr>  
            @endforeach   
            @endif    
            </tbody>
            </table>
        </div>
    </div>
    <!-- /.panel-body -->
</div>
</div-->        
</div>
<!-- /.row-content -->        
</div>

<!-- Add Member -->
<div class="modal fade" id="modal-member" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                       
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                x
        </button>
        <h4 class="modal-title" id="head_member_modal">
                Agregar socio
        </h4>
    </div>
    <!--form id="form_add_member" method="POST" action="/member/0" enctype = 'multipart/form-data'-->
    <div class="modal-body">          
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="tabbable" id="tabs-102605">
                <div id="member_id_edit" style="display:none"></div>
                <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#panel-919134" data-toggle="tab">
                        Datos personales</a>
                </li>
                <li >
                    <a href="#panel-913591" data-toggle="tab">
                        Contacto</a>
                </li>                 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="panel-919134">  
                        <br> 
                    <div class="row">
                    <div class="col-md-4"> 
                        <div class="form-group">
                            <label>* Nombre</label>
                            <input id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>* Apellido Paterno</label>
                            <input id="apellido_paterno" name="apellido_paterno" class="form-control">
                        </div>       
                        <div class="form-group">
                            <label>Apellido Materno</label>
                            <input id="apellido_materno" name="apellido_materno" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label>* Nombre de usuario</label>
                            <input id="nombre_de_usuario" name="nombre_de_usuario" class="form-control">
                        </div>                                    
                    </div>
                    <div class="col-md-4">    
                        <div class="form-group">
                            <label>* Sexo</label>
                            <select id="sexo" name="sexo" class="form-control">
                                <option>Masculino</option>
                                <option>Femenino</option>
                            </select>
                        </div>                                    
                        <div class="form-group">
                            <label>Fecha de nacimiento</label>
                            <input id="fecha_de_nacimiento" name="fecha_de_nacimiento" type="date" class="form-control">                                      
                        </div>       
                        <div class="form-group">
                            <label>Socio desde</label>
                            <input id="socio_desde" name="socio_desde" type="date" class="form-control">       
                        </div>         
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input id="socio_contrasena" name="socio_contrasena" type="password" class="form-control">       
                        </div>                                        
                    </div>   
                    <div class="col-md-4">                  
                    </div>                                  
                    </div>                                               
                    </div>
                    <div class="tab-pane" id="panel-913591"> 
                    <br>        
                    <div class="row">
                        <div class="col-md-4">   
                            <div class="form-group">
                                <label>Domicilio</label>
                                <input id="member_address" name="member_address" class="form-control" placeholder="calle y n&uacute;mero ">
                            </div>        
                            <div class="form-group">
                                <label>Colonia</label>
                                <input id="member_neighborhood" name="member_neighborhood" class="form-control">
                            </div>  
                            <div class="form-group">
                                <label>* Estado</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option>San Luis Potos&iacute;</option>
                                </select>
                            </div>                                    
                            <div class="form-group">
                                <label>* Ciudad</label>
                                <input id="ciudad" name="ciudad" class="form-control">
                            </div>                                  
                        </div>  
                        <div class="col-md-4">      
                            <div class="form-group">
                                <label>C&oacute;digo postal</label>
                                <input id="codigo_postal" name="codigo_postal" class="form-control">
                            </div>        
                            <div class="form-group">
                                <label>Tel&eacute;fono casa</label>
                                <input type="text" id="telefono_de_casa" name="telefono_de_casa" class="form-control" placeholder="000-0-00-00-00">
                            </div>  
                            <div class="form-group">
                                <label>Tel&eacute;fono m&oacute;vil</label>
                                <input id="telefono_celular" name="telefono_celular" class="form-control" placeholder="000-00-00-00-00-00">
                            </div>  
                            <div class="form-group">
                                <label>Tel&eacute;fono de emergencia</label>
                                <input id="member_emergency_phone" name="member_emergency_phone" class="form-control" placeholder="">
                            </div>                                                                   
                        </div>  
                        <div class="col-md-4">   
                            <div class="form-group">
                                <label>Correo electronico</label>
                                <input id="correo" name="correo" class="form-control" placeholder="email@email.com">                                           
                            </div>                                
                            <div class="form-group">
                                <label>Empresa</label>
                                <input id="compania" name="compania" class="form-control" >
                            </div>  
                            <div class="form-group">
                                <label>Ocupaci&oacute;n</label>
                                <select id="member_job" name="member_job" class="form-control">
                                    <option>Empleado(a)</option>
                                    <option>Profesionista</option>
                                    <option>Empresario(a)</option>                                        
                                    <option>Estudiante</option>
                                    <option>Ama de casa</option>
                                </select>
                            </div>                                  
                        </div>                              
                    </div>    
                    </div>                         
                </div>
            </div>
            </div>
        </div>
        </div>
        </div>
        <div id="errors_save_member"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
            </button>                 
            <button id="save_member" class="btn btn-info" type="submit" >Guardar</button>
        </div>
    <!--/form-->
</div>
</div>
</div>

<!-- Assistant Payments -->
<div class="modal fade" id="modal-add-pay" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                       
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                x
        </button>
        <h4 class="modal-title" id="myModalLabel">
            Asistente de pagos
        </h4>
    </div>
    <div class="modal-body">
        <div id="member_id_add_pay" style="display: none"></div>
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-7">   
                    <h4 id="full_name_member_add_pay"></h4>         
                </div>        
                <button id = "add-credit-nfc" type="button" 
                        class="btn btn-warning" style="float:right">
                    Dep&oacute;sito cr&eacute;dito NFC</button>
            </div>
            <div class="row">
            <div class="col-md-12">
            <!--div class="table-responsive"-->
                Membres&iacute;a
                <div class="dataTable_wrapper">
                    <table id="memberships_actives" class="table table-striped table-bordered table-hover">
                        <thead id="tbhead-memberships-actives">
                        </thead>               
                        <tbody id="tbody-memberships-actives">
                        </tbody>
                    </table>
                </div>  
                Deudas
                <div class="dataTable_wrapper">
                    <table id="payments-debts" class="table table-striped table-bordered table-hover">
                        <thead id="tbhead-payments_debt">
                        </thead>               
                        <tbody id="tbody-payments_debt">
                        </tbody>
                    </table>
                </div>                                
            <!--/div-->            
            </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label id="payment_type" style="color: #00b3ee"> Seleccione la membres&iacute;a a renovar una deuda a pagar </label><br>
                </div>
            </div>    
            <div class="row">        
                <div id="id_debt_to_pay" style="display: none"></div>                               
                <div class="col-md-3">
                    <div class="form-group">         
                        <label> Concepto </label><br>
                        <label id="desc_debt_to_pay"></label>
                    </div>
                </div>    
                <div class="col-md-2"  style="text-align:left">
                    <div class="form-group">          
                        <label id="desc_amount">Deuda</label><br>
                        <label id="amount_debt_to_pay"></label>
                    </div>                                    
                </div>            
                <div class="col-md-2">
                    <label> Desc.%Mem.</label>
                    <input id="discount_add_payment" class="form-control">                                     
                </div>                                                
                <div class="col-md-2">
                    <div class="form-group">         
                        <label> No. Ref.</label>
                        <input id="reference_add_payment" class="form-control"></input>
                    </div>                                    
                </div>                                  
                <div class="col-md-3">
                    <div class="form-group">
                        <label>* Forma de Pago</label>
                        <select id="method_payment_add_payment" class="form-control">
                            <option>Efectivo</option>
                            <option>Tarjeta</option>
                            <option>Dep&oacute;sito</option>
                            <option>Transferencia</option>
                            <option>Cheque</option>
                            <option>Otro</option>
                        </select>
                    </div>                                                                      
                </div>
            </div>
            <div class="row">                                                               
                <div class="col-md-4">
                    <label>Monto a pagar de membres&iacute;a</label>
                    <input id="amount_add_payment" class="form-control" readonly>                                    
                </div>               
                <div class="col-md-4">
                    <label>Inicio Membresia</label><br><br>
                    <input id="def_init_mem" name="def_init_mem" type="date" class="form-control">       
                </div> 
                <div class="col-md-4">    
                    <label>* Pago</label><br><br>
                    <input class="form-control" id="amount_end_add_payment">  	
                </div>	      
            </div>    
            <div class="row" style="display: none">
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered 
                           table-hover table-striped">
                    <thead>
                    </thead>
                    <tbody>                                     
                        <tr><td>Balance a pagar es de:</td>
                            <td id="balance_due">0</td></tr>                                                   
                        <tr><td>Nuevo Pago:</td>
                            <td id="new_payment">0</td></tr>           
                        <tr style="background-color:#d9edf7"><td>Nuevo balance ser&aacute;:</td>
                            <td id="new_balance">0</td></tr>                               
                    </tbody>
                    </table>                                         
                </div>
                </div>
                </div>
            </div>                            
        </div>
        </div>
        </div>
        </div>
    <div id="errors_save_payment"></div>	
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
                Cerrar
        </button> 
        <button id="save_payment" type="button" class="btn btn-primary">
                Guardar
        </button>
    </div>
</div>
</div>
</div>

<!-- Add Membership -->
<div class="modal fade" id="modal-add-membership" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                       
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                x
        </button>
        <h4 class="modal-title" id="myModalLabel">
                Agregar membres&iacute;a
        </h4>
    </div>
    <div class="modal-body">
        <div id="member_id_add_membership" style="display: none"></div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">                           
            <div class="container-fluid">                                
                <div class="row">
                    <div class="col-md-12">   
                        <h4 id="full_name_member_add_membership"></h4>         
                    </div>
                </div>                                 
                <br>
                <div class="form-group">
                    <label>* Tipo de membres&iacute;a</label>
                    <select id ="type_add_membership" class="form-control"
                            onChange="javascript:changeSelectMemberType(this);">
                    </select>
                </div>
                <div class="form-group">
                    <label>* Forma de Pago</label>
                    <select id ="method_payment_add_membership" class="form-control">
                        <option>Efectivo</option>                        
                        <option>Tarjeta</option>
                        <option>Dep&oacute;sito</option>
                        <option>Transferencia</option>
                        <option>Cheque</option>
                        <option>Otro</option>
                    </select>
                </div>              
                <div class="form-group">
                    <label>Referencia</label>
                    <input id="reference_add_membership"  class="form-control">                                                      
                </div>                                          
                <div class="form-group">
                    <label>* Fecha de Inicio</label>
                    <input type="date" class="form-control" id="date_start">
                </div>    
                <div class="form-group">                            
                    <label>* Monto de inscripci&oacute;n</label>
                    <input class="form-control" id="inscription_add_membership">                            
                </div>                       
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>* Costo de<br>membres&iacute;a</label>
                            <input id="amount_payable" class="form-control" readonly>                                    
                        </div>                                 
                        <div class="col-md-4">
                            <label>Descuento % de membres&iacute;a</label>
                            <input id="discount_add_membership" class="form-control">                                     
                        </div>                                  
                        <div class="col-md-4">
                            <label>Monto a pagar de membres&iacute;a</label>
                            <input id="amount_end_add_membership" class="form-control" readonly>                                    
                        </div>                          
                    </div>
                </div>
                <div class="form-group">                            
                    <label>* Pago membres&iacute;a</label>
                    <input class="form-control" id="amount_add_membership">                            
                </div>                         
            </div> 
            </div>
            </div>
        </div>
        </div>
        <div id="errors_save_membership"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cerrar
            </button> 
            <button id="save_add_membership" type="button" class="btn btn-primary">
                    Guardar
            </button>
        </div>
</div>
</div>
</div>

<!-- Pause Membership -->
<div class="modal fade" id="modal-pause-membership" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        x
                </button>
                <h4 class="modal-title" id="myModalLabel">
                        Pausar membres&iacute;a
                </h4>
            </div>
            <div class="modal-body">
                <div id="member_id_pause_membership" style="display: none"></div>
                <div class="container-fluid">
                    <div class="row">
                        <h3 id="pause_full_name_member"></h3>
                        <br>
                        <div id="pause_photo" class="col-md-4"> 
                            <img src="img/user.jpg" class="img-thumbnail" 
                                alt="Cinque Terre" width="150" height="200">                                                                             
                        </div>
                        <div id="assistance_col1" class="col-md-4">                            
                            <div class="form-group">
                                <label>Membres&iacute;a</label></div>       
                            <div class="form-group">
                                <label>Inicio de membres&iacute;a</label></div>                               
                            <div class="form-group">
                                <label>Vigencia</label></div>                                     
                        </div>
                        <div id="assistance_col1" class="col-md-4">                            
                            <div class="form-group">
                                <label id="membership_pause_name"></label></div>      
                            <div class="form-group">
                                <label id="membership_pause_init_period"></label></div>                              
                            <div class="form-group">
                                <label id="membership_pause_end_period"></label></div>                                     
                        </div>                         

                    </div>
                </div>
                </div>
		<div id="errors_save_pause_membership"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button> 
                    <button id="btn-pause-membership" type="button" class="btn btn-primary">
                            Pausar
                    </button>
                </div>
        </div>
    </div>
</div>

</div>
@stop

@section('scripts')

<script>         

function changeSelectMemberType(obj)
{
    var turnUserId = obj.value;
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/membership_type_for_name') }}' + '/' + obj.value,
        dataType: 'json',
        success: function(d) {
            if(d.success == true)
                $('#amount_payable').val(d.membership_type.price);
            else
                $('#amount_payable').val("");                           
            $('#amount_payable').load();       
        }
    });     
}

$("#amount_add_payment").keyup(function() {
    if($('#payment_type').text() == 'Pagar deuda')
    {
        $('#new_payment').html($("#amount_add_payment").val());
        $('#new_payment').load();
        $('#new_balance').html(parseInt($('#balance_due').html()) - parseInt($("#amount_add_payment").val()));
        $('#new_balance').load();        
    }
});

$("#amount_add_membership").keyup(function() {
    calculatePaymentEndMembership();
});

$("#discount_add_membership").keyup(function() {
    calculatePaymentEndMembership();        
});

function calculatePaymentEndMembership()
{
    var amount = $("#amount_payable").val();
    var discount = $("#discount_add_membership").val();
        
    try {
        var aux =  parseFloat(amount) * 0.01;
	aux = parseFloat(aux) * parseFloat(discount);
        aux = parseFloat(amount) - aux;
        $('#amount_end_add_membership').val(aux);
    }
    catch(err) { 
        $('#amount_end_add_membership').val(amount);
    }        
    $('#amount_end_add_membership').load();    
}

$("#discount_add_payment").keyup(function() {
    calculatePaymentEndPayment();        
});

function calculatePaymentEndPayment()
{
    var amount = $("#amount_debt_to_pay").html();
    var discount = $("#discount_add_payment").val();
        
    try {
        var aux =  parseFloat(amount) * 0.01;
	aux = parseFloat(aux) * parseFloat(discount);
        aux = parseFloat(amount) - aux;
        $('#amount_add_payment').val(aux);
    }
    catch(err) { 
        $('#amount_add_payment').val(amount);
    }        
    $('#amount_add_payment').load();    
}

$(document).ready(function() {                    
    
var setStylePayments = false;

$('#dataTables-example').DataTable( {
    paging: true,
    searching: true,    
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
} );  

/*
 |------------------------------------------------------------------------
 | Add Members
 |------------------------------------------------------------------------        
*/    

$('#save_member').on('click',function(e){
var birth = document.getElementById("fecha_de_nacimiento");
    var since = document.getElementById("socio_desde");
    var data = {
        /*some fields are written in Spanish that will be shown in the message Validation*/
        nombre :$("#nombre").val(),
        apellido_paterno :$("#apellido_paterno").val(),
        apellido_materno:$("#apellido_materno").val(),
        nombre_de_usuario :$("#nombre_de_usuario").val(),
        sexo :$("#sexo").val(), 
        fecha_de_nacimiento  :1,                                    
        socio_desde   :1,                               
        member_address :$("#member_address").val(), 
        member_neighborhood :$("#member_neighborhood").val(), 
        estado :$("#estado").val(), 
        ciudad :$("#ciudad").val(), 
        codigo_postal:$("#codigo_postal").val(),
        telefono_de_casa :$("#telefono_de_casa").val(), 
        telefono_celular :$("#telefono_celular").val(), 
        correo :$("#correo").val(), 
        compania :$("#compania").val(),  
        member_emergency_phone:$("#member_emergency_phone").val(),
        contrasena:$("#socio_contrasena").val(),
        member_job :$("#member_job").val()                         
    }; 
    data.fecha_de_nacimiento = birth.value;
    data.socio_desde = since.value;   
    id = $('#member_id_edit').val();
    $.ajax({
        type: "POST",
        //url: '{{ URL::to('/validate_fields_member') }}',
	    url: '{{ URL::to('/member') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {    
            if(data.success == true){
                alert('¡Socio guardado!');
                window.location.replace("/crm_gym/public/members_list");
            }
            else{
                var txt = "Errores de validacion : \n";                
                for (i = 0; i < data.errors.length; i++)
                    txt = txt+'\n'+data.errors[i];
                $('#errors_save_member').html("<div class='alert alert-danger'>"+txt+"</div>");
                $('#errors_save_member').load();
            }                        
        },
        dataType: 'json'
    });                         
});

$('#add_member').on('click', function(e) { 
    $('input').val('');
    $("#head_member_modal").html("Agregar socio");
    $('#member_id_edit').val("0");
    $('#errors_save_member').html("");
    $('#errors_save_member').load();    
    $('#modal-member').modal();
}); 

/*
 |------------------------------------------------------------------------
 | Add Payments
 |------------------------------------------------------------------------
*/        

$('.add_pay').on('click', function(e) {
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text(); 
    $('input').val('');
    $('#member_id_add_pay').html(id);
    $('#tbody-memberships-actives').html("");
    $('#tbody-payments_debt').html("");
    $('#balance_due').html("");
    $('#new_payment').html("");
    $('#new_balance').html("");
    $('#errors_save_payment').html("");
    $('#payment_type').html("Seleccione la membresia a renovar una deuda a pagar");
    $('#id_debt_to_pay').html("");
    $('#id_debt_to_pay').load();
    $('#payment_type').load();
    fillModalPayment(id);
    $('#modal-add-pay').modal(); 
});          

function fillModalPayment(id) {
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member/info_payment_wizard') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
	    $('#errors__save_payment').html("");
	    $('#errors_save_payment').load();
            $('#full_name_member_add_pay').html(d.first_name+" "+
                    d.last_name+" "+d.second_last_name); 
            //Init Membership active              
            var tbody = $('#tbody-memberships-actives');
            var mems = d.memberships;            
            if(mems.length > 0){
                var thead = $('#tbhead-memberships-actives');
                  thead.html(
                    "<th>Id</th>"+      
                    "<th>Fin per&iacute;odo</th>"+
                    "<th>Descripci&oacute;n</th>"+
                    "<th>Precio</th>"+
                    "<th>Activa</th>");                     
                tbody.append("<tr>"+
                    "<td>"+mems[0].membership_id+"</td>"+    
                    "<td>"+mems[0].end_period+"</td>"+
                    "<td>"+mems[0].membership_name+"</td>"+
                    "<td>"+mems[0].price+"</td>"+
                    "<td>"+((mems[0].active == 1)?'SI':'NO')+"</td></tr>");
            }
            
            var table = document.getElementById("memberships_actives");
            var rows = table.getElementsByTagName("tr");
            for (i = 0; i < rows.length; i++) {
                row = table.rows[i];
                row.onclick = function(){
                    var cell = this.getElementsByTagName("td");
                    $('#id_debt_to_pay').html(cell[0].innerHTML);
                    $('#desc_debt_to_pay').html(cell[2].innerHTML);
                    $('#amount_debt_to_pay').html(cell[3].innerHTML);
                    $('#desc_amount').html("Total");
                    $('#payment_type').html("Renovacion de membresia");
                    $('#discount_add_payment').val("0");
                    $('#amount_add_payment').val(cell[3].innerHTML);                    
                };
            }                          
            //End Membership Active
                        
            //Init Debts
            var table = document.getElementById("payments-debts");            
            var debts = d.debts;            
            var theadpd = $('#tbhead-payments_debt');
              theadpd.html(
                "<th>Id</th>"+      
                "<th>Fecha</th>"+
                "<th>Descripci&iacute;n</th>"+
                "<th>Total</th>"+
                "<th>Pagado</th>"+
                "<th>Deuda</th>");                   
            var tbodypd = $('#tbody-payments_debt');               
            
            var totalDebt = 0 ;
            for(i=0 ; i < debts.length ; i++)
            {
                var totalRow = parseInt(debts[i].paid)+parseInt(debts[i].debt);
                tbodypd.append("<tr>"+
                    "<td>"+debts[i].id+"</td>"+    
                    "<td>"+debts[i].created_at+"</td>"+
                    "<td>"+debts[i].concept+"</td>"+
                    "<td>"+totalRow+"</td>"+
                    "<td>"+debts[i].paid+"</td>"+
                    "<td>"+debts[i].debt+"</td></tr>");                                      
                totalDebt = totalDebt + parseInt(debts[i].debt);    
            }//End Debts                                                
            
            $('#balance_due').html(totalDebt);
            
            var rows = table.getElementsByTagName("tr");
            
            for (i = 0; i < rows.length; i++) {
                row = table.rows[i];
                row.onclick = function(){
                    var cell = this.getElementsByTagName("td");
                    $('#id_debt_to_pay').html(cell[0].innerHTML);
                    $('#desc_debt_to_pay').html(cell[2].innerHTML);
                    $('#amount_debt_to_pay').html(cell[5].innerHTML);
                    $('#desc_amount').html("Deuda");
                    $('#payment_type').html("Pagar deuda");
                    $('#discount_add_payment').val("");
                    $('#amount_add_payment').val("");
                };
            }        
            
            $('#id_debt_to_pay').load();
            $('#balance_due').load();
            $('#desc_debt_to_pay').load();
            $('#amount_debt_to_pay').load();
            $('#desc_amount').load();
            $('#payment_type').load();
            $('#tbody-memberships-actives').load();
            $('#tbody-payments_debt').load();
            $('#discount_add_payment').load();
            $('#amount_add_payment').load();            
        }
    });
}        

$('#save_payment').on('click', function(e) {
    $('#errors_save_payment').html("");
    $('#errors_save_payment').load();
    var defInit = document.getElementById("def_init_mem");
    var data = {
        /*some fields are written in Spanish that will be shown in the message Validation*/
        descuento: $('#discount_add_payment').val(),
        cantidad: $('#amount_add_payment').val(),      
        cantidad_final: $('#amount_end_add_payment').val(),
        metodo_de_pago_del_pago: $('#method_payment_add_payment').val(),
        concepto_del_pago: $('#desc_debt_to_pay').text(),
        payment_id: $('#id_debt_to_pay').text(),
        payment_type: $('#payment_type').text(),
        referencia_del_pago: $('#reference_add_payment').val(),
        membership_id: $('#id_debt_to_pay').html(),
        fecha_de_inicio: 1
    }; 
    data.fecha_de_inicio = defInit.value;
    if(data.payment_id == "" && data.concepto_del_pago != 'CREDITO NFC'){
        $('#errors_save_payment').html("<div class='alert alert-danger'>Seleccione la membres\u00eda a renovar, abono NFC \u00f3 una deuda a pagar</div>");
	$('#errors_save_payment').load();
        return false;
    }
    id = $('#member_id_add_pay').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/payment') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert('¡Pago guardado!');
		window.location.replace("/crm_gym/public/members_list");
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
                            }
                            else{
                                $('#errors_save_payment').html("<div class='alert alert-danger'>"+d.errors+"</div>");
                                $('#errors_save_payment').load();		
                            }                        
                        },
                        dataType: 'json'
                    });                         
                }else{
                    var txt = "Errores de validaci&oacute;n : \n";              
                    for (i = 0; i < data.errors.length; i++)
                        txt = txt+'\n'+data.errors[i];
		    $('#errors_save_payment').html("<div class='alert alert-danger'>"+txt+"</div>");
		    $('#errors_save_payment').load();           
                }
            }                        
        },
        dataType: 'json'
    });                           
});        

/*
 |------------------------------------------------------------------------
 | Add Memberships
 |------------------------------------------------------------------------
*/    

$('.add_membership').on('click', function(e) {  
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text();    
    $('input').val('');
    $('#member_id_pause_membership').html(id);
    $("#member_id_pause_membership").load();  
    $('#member_id_add_membership').html(id);
    $('#errors_save_membership').html("");
    $('#errors_save_membership').load();
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/membership_active') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {   
            if(d.member_active == false){  
                $.ajax({
                    type: 'GET',
                    url: '{{ URL::to('/member/memberships_paused') }}' + '/' + id,
                    dataType: 'json',
                    success: function(d) {   
                        if(d.memberships.length > 0){    
                            var membership = d.memberships[0];
                            if (!confirm('¡Este socio tiene la membres&iacute;a '+ membership.membership_name+' '+
				membership.start+' pausada el '+membership.pause +'!.¿Desea continuarla la membres&iacute;a actual?')){
                         	fiilModalAddmembership(id);
                            	$('#modal-add-membership').modal();
			    }else{
                	$.ajax({
                        type: 'GET',url: '{{ URL::to('/membership_unpauses') }}' + '/' + membership.membership_id,dataType: 'json',
                        success: function(d) {   
                            if(d.success == true){   
                                alert('Nueva vigencia de membresia '+d.membership_type.name + ' '+d.membership.end_period);
                            }else{alert(d.errors);}
                        }
                	});
			    }
                        }else{
                            fiilModalAddmembership(id);
                            $('#modal-add-membership').modal();
                        }
                    }
                });
            }else{
                if (!confirm('¡Este socio aun tiene una membres&iacute;a activa!.¿Desea pausar la membres&iacute;a actual?'))
                    return false;    
                $("#assistance_full_name_member").html("");
                $("#membership_pause_name").html("");
                $("#membership_pause_init_period").html("");
                $("#membership_pause_end_period").html("");
                fiilModalPauseMembership(id);
                $('#modal-pause-membership').modal();
            }
        }
    });                             
});             

function fiilModalPauseMembership(id) {    
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member/membership_active') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            if(d.success == true){                
                var memberships = d.memberships;                
                if(memberships.length > 0)
                {                            
                    $("#assistance_full_name_member").html(memberships[0].first_name+" "+memberships[0].last_name);
                    $("#membership_pause_name").html(memberships[0].membership_name);
                    $("#membership_pause_init_period").html(memberships[0].start_period);
                    $("#membership_pause_end_period").html(memberships[0].end_period);
                    
                    $("#assistance_full_name_member").load();
                    $("#membership_pause_name").load();
                    $("#membership_pause_init_period").load();
                    $("#membership_pause_end_period").load();
                }
            }else{
                alert("¡Error en peticion de informaci&oacute;n!");
            }
        }
    });                    
}   

function fiilModalAddmembership(id) {    
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member/info_membership_wizard') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $('#full_name_member_add_membership').html(d.first_name+" "+
                    d.last_name+" "+d.second_last_name); 
            var select = $('#type_add_membership');
            var memst = d.membership_types;

            select.html("");     

            select.append("<option></option>");            
            for (i = 0; i < memst.length; i++)
            {
                select.append("<option>"+memst[i].name+"</option>");
            }
        }
    });                    
}   

$('#save_add_membership').on('click', function(e) {
    var date_start = document.getElementById("date_start");    
    var data = {
        cantidad: $('#amount_add_membership').val(),                
        metodo_de_pago: $('#method_payment_add_membership').val(),
        concepto: "MEMBRESIA",
        tipo_de_membresia: $('#type_add_membership').val(),
        inscripcion: $('#inscription_add_membership').val(),
        fecha_de_inicio: 0,
	cantidad_final: $('#amount_end_add_membership').val(),
        descuento: $('#discount_add_membership').val(),
        reference:  $('#reference_add_membership').val()
    }, 
    id = $('#member_id_add_membership').text();
    data.fecha_de_inicio = date_start.value;
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/membership') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert('¡Membres&iacute;a guardada!');
		window.location.replace("/crm_gym/public/members_list");
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
                            }
                            else{
                                $('#errors_save_membership').html("<div class='alert alert-danger'>"+d.errors+"</div>");
                                $('#errors_save_membership').load();	
                            }                        
                        },
                        dataType: 'json'
                    });                         
                }else{
                    var txt = "Errores de validaci&oacute;n : \n";                
                    for (i = 0; i < data.errors.length; i++)
                            txt = txt+'\n'+data.errors[i];
			$('#errors_save_membership').html("<div class='alert alert-danger'>"+txt+"</div>");
			$('#errors_save_membership').load();                  
                }                
            }                        
        },
        dataType: 'json'
    });                                  
});     

/*
 |------------------------------------------------------------------------
 | Edit Members
 |------------------------------------------------------------------------
*/    

function fiilModalMember(id) {
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $("#nombre").val(d.member.first_name);
            $("#apellido_paterno").val(d.member.last_name);
            $("#apellido_materno").val(d.member.second_last_name);
            $("#nombre_de_usuario").val(d.member.nickname);
            $("#seco").val(d.member.sex); 
            $("#fecha_de_nacimiento").val(d.member.date_birth);
            $("#socio_contrasena").val(d.member.password); 
            $("#socio_desde").val(d.member.member_since);                               
            $("#member_address").val(d.member.address); 
            $("#member_neighborhood").val(d.member.neighborhood); 
            $("#estado").val(d.member.town); 
            $("#ciudad").val(d.member.city); 
            $("#codigo_postal").val(d.member.postal_code);
            $("#telefono_de_casa").val(d.member.home_phone); 
            $("#telefono_movil").val(d.member.cell_phone); 
            $("#correo").val(d.member.email); 
            $("#compania").val(d.member.company);  
            $("#member_job").val(d.member.job);      
            $("#member_emergency_phone").val(d.member.emergency_phone);
        }
    });
}   

$('.edit_member').on('click', function(e) {
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text(); 
    $('input').val('');
    //document.getElementById('form_add_member').action = "/member/"+id;
    $('#member_id_edit').val(id);
    $("#head_member_modal").html("Editar socio");
    $('#errors_save_member').html("");
    $('#errors_save_member').load();
    fiilModalMember(id);
    $('#modal-member').modal();
});        

/*
 |------------------------------------------------------------------------
 | Delete Members
 |------------------------------------------------------------------------
*/    

$('.delete_member').on('click', function(e) {
    if (!confirm('¿Desea borrar el socio?'))
            return false;
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text();  
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/member/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert("¡Socio eliminado!");
                window.location.replace("/crm_gym/public/members_list");
            }
            else{alert(data.errors);}                        
        },
        dataType: 'json'
    });              
});                                            

$('#add-credit-nfc').on('click', function(e) {    
    $('#amount_add_payment').val("0");
    $('#discount_add_payment').val("0");          
    var table = document.getElementById("memberships_actives");        
    var rows = table.getElementsByTagName("tr");
    if (rows.length > 0){
        $('#payment_type').html("Deposito credito NFC");
        $('#desc_debt_to_pay').html("CREDITO NFC");
        $('#amount_debt_to_pay').html("");
        $('#amount_debt_to_pay').load();
        $('#payment_type').load();
        $('#desc_debt_to_pay').load(); 
    }else alert("Se requeire tener una membresia ctiva");       
});     

/*
 |------------------------------------------------------------------------
 | Pause memberships
 |------------------------------------------------------------------------
*/   
$('#btn-pause-membership').on('click', function(e) {
    id = $("#member_id_pause_membership").html(); 
    $.ajax({
        type: "GET",
        url: '{{ URL::to('/member/pause_membership') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert("¡Membresia pausada!");
                window.location.replace("/crm_gym/public/members_list");
            }
            else{
                alert(data.errors);
            } 
        },
        dataType: 'json'
    });              
});

});              
    
</script>
@stop
