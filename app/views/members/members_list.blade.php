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
<!-- row-content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4">                            
                        <button id="add_member"  type="button" class="btn btn-outline btn-primary" 
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
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Direcci&oacute;n</th>
                                <th>Colonia</th>          
                                <th>Ciudad</th>      
                                <th>Estado</th>     
                                <th>Tel. M&oacute;vil</th>         
                                <th>Socio desde</th>       
                                <th style="width: 70px"></th>                                 
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @if(isset($members))    
                        @foreach($members as $member)      
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">
                                    {{$member->id}}
                                </td>                                    
                                <td class="sorting_1">
                                    {{$member->first_name}}
                                </td>
                                <td class="sorting_1">{{$member->last_name}}</td>
                                <td class="sorting_1">{{$member->second_last_name}}</td>
                                <td class="sorting_1">{{$member->address}}</td>
                                <td class="sorting_1">{{$member->neighborhood}}</td>
                                <td>{{$member->city}}</td>
                                <td class="center">{{$member->town}}</td>
                                <td class="center">{{$member->cell_phone}}</td>
                                <td class="center">{{$member->created_at}}</td>
                                <td style="text-align: center; vertical-align: middle; ">
                                    <span class="member-id" style="display:none">
                                        {{$member->id}}
                                    </span>                                          
                                    <a class ="edit_member" href="javascript:void(0)" 
                                       title="Editar">
                                        <i class="glyphicon glyphicon-edit">                                    
                                        </i>
                                    </a>
                                    <a class ="delete_member" href="javascript:void(0)" 
                                       title="Eliminar">
                                        <i class="glyphicon glyphicon-remove">                                    
                                        </i>
                                    </a>                                      
                                    <a class = "add_pay" href="javascript:void(0)" title="Pago">
                                        <i class="glyphicon glyphicon-usd">                                    
                                        </i>
                                    </a>   
                                    <a class = "add_membership" href="javascript:void(0)" 
                                       title="Agregar Membresia">
                                        <i class="glyphicon glyphicon-credit-card">                                    
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
            <!-- /.panel-body -->
        </div>
    </div-->        
</div>
<!-- /.row-content -->        
</div>

<div class="modal fade" id="modal-member" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                </button>
                <h4 class="modal-title" id="head_member_modal">
                        Agregar socio
                </h4>
            </div>
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
                                                <label>Nombre</label>
                                                <input id="member_first_name" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label>Apellido Paterno</label>
                                                <input id="member_last_name" class="form-control" >
                                            </div>       
                                            <div class="form-group">
                                                <label>Apellido Materno</label>
                                                <input id="member_second_last_name" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label>Le gusta ser llamado</label>
                                                <input id="member_nickname" class="form-control">
                                            </div>                                    
                                        </div>
                                        <div class="col-md-4">    
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select id="member_sex" class="form-control">
                                                    <option>Masculino</option>
                                                    <option>Femenino</option>
                                                </select>
                                            </div>                                    
                                            <div class="form-group">
                                                <label>Fecha de nacimiento</label>
                                                <input id="member_date_birth" type="date" class="form-control">                                      
                                            </div>       
                                            <div class="form-group">
                                                <label>Socio desde</label>
                                                <input id="member_since" type="date" class="form-control">       
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
                                                    <label>Domicilio ( calle y número )</label>
                                                    <input id="member_address" class="form-control" >
                                                </div>        
                                                <div class="form-group">
                                                    <label>Colonia</label>
                                                    <input id="member_neighborhood" class="form-control">
                                                </div>  
                                                <div class="form-group">
                                                    <label>Estado</label>
                                                    <select id="member_town" class="form-control">
                                                        <option>San Luis Potosí</option>
                                                        <option>Queretaro</option>
                                                    </select>
                                                </div>                                    
                                                <div class="form-group">
                                                    <label>Ciudad</label>
                                                    <input id="member_city" class="form-control">
                                                </div>                                  
                                            </div>  
                                            <div class="col-md-4">      
                                                <div class="form-group">
                                                    <label>Código postal</label>
                                                    <input id="member_postal_code" class="form-control">
                                                </div>        
                                                <div class="form-group">
                                                    <label>Telèfono casa</label>
                                                    <input id="member_home_phone" class="form-control">
                                                </div>  
                                                <div class="form-group">
                                                    <label>Teléfono móvil</label>
                                                    <input id="member_cell_phone" class="form-control" >
                                                </div>  
                                                <div class="form-group">
                                                    <label>Correo electronico</label>
                                                    <input id="member_email" class="form-control">
                                                </div>                                 
                                            </div>  
                                            <div class="col-md-4">       
                                                <div class="form-group">
                                                    <label>Empresa</label>
                                                    <input id="member_company" class="form-control" >
                                                </div>  
                                                <div class="form-group">
                                                    <label>Ocupación</label>
                                                    <select id="member_job" class="form-control">
                                                        <option>Profesionista</option>
                                                        <option>Empresario(a)</option>                                        
                                                        <option>Estudiante</option>
                                                        <option>Empleado(a)</option>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button> 
                    <button id="save_member" type="button" class="btn btn-primary">
                            Guardar
                    </button>
                </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-pay" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
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
                                <div class="col-md-2">
                                    <img src="/img/user.jpg" class="img-thumbnail" 
                                         alt="Cinque Terre" width="80" height="80">                
                                </div>
                                <div class="col-md-10">   
                                        <h4 id="full_name_member_add_pay"></h4>         
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>#</th>
                                                <th>Descripci&oacute;n del producto</th>
                                                <th>Precio</th>
                                                <th>Pagado</th>
                                                <th>Nuevo Pago</th>
                                                <th>Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-memberships-actives">

                                        </tbody>
                                        </table>
                                    </div>            
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h4>Nuevo pago</h4>
                                                <textarea id ="amount_add_payment" class="form-control" 
                                                          rows="3"></textarea>
                                            </div>                  
                                            <div class="form-group">
                                                <label>Forma de Pago</label>
                                                <select id="method_payment_add_payment" class="form-control">
                                                    <option>Tarjeta</option>
                                                    <option>Depósito</option>
                                                    <option>Transferencia</option>
                                                    <option>Efectivo</option>
                                                </select>
                                            </div>                    
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table table-bordered 
                                                   table-hover table-striped">
                                            <thead>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Balance a pagar es de:</td>
                                                    <td>$200.00</td>
                                                </tr>                                        
                                                <tr>
                                                    <td>Saldo a favor pago anteriores:</td>
                                                    <td>$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td>Nuevo Pago:</td>
                                                    <td>$0.00</td>
                                                </tr>           
                                                <tr>     
                                                </tr>                               
                                            </tbody>
                                            </table>  
                                            <div class="alert alert-info">
                                                      El nuevo balance ser&aacute; de:$200.00
                                            </div>                                          
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                    </div>
                </div>
            </div>
            </div>
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

<div class="modal fade" id="modal-add-membership" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
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
                                    <div class="col-md-2">
                                        <img src="/img/user.jpg" class="img-thumbnail" 
                                             alt="Cinque Terre" width="80" height="80">                
                                    </div>
                                    <div class="col-md-10">   
                                            <h4 id="full_name_member_add_membership"></h4>         
                                    </div>
                                </div>                                 
                                <br>
                                <div class="form-group">
                                    <label>Tipo de membres&iacute;a</label>
                                    <select id ="type_add_membership" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Forma de Pago</label>
                                    <select id ="method_payment_add_membership" class="form-control">
                                        <option>Tarjeta</option>
                                        <option>Dep&oacute;sito</option>
                                        <option>Transferencia</option>
                                        <option>Efectivo</option>
                                    </select>
                                </div>                                                        
                                <div class="form-group">
                                    <label>Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="date_start">
                                </div>                                                                           
                                <div class="form-group">
                                    <label>Nuevo pago</label>
                                    <input id="amount_add_membership" class="form-control">
                                </div>      
                            </div> 
                        </div>
                    </div>
                </div>
                </div>
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

</div>
@stop

@section('scripts')
<script>
$(document).ready(function() {        

$('#dataTables-example').dataTable( {
    paging: true,
    searching: true,    
    responsive: true
} );  

/*
 |------------------------------------------------------------------------
 | Add Members
 |------------------------------------------------------------------------        
*/    

$('#save_member').on('click',function(e){
    //id = $('#member_id_edit').text();
    //alert(id);
    var birth = document.getElementById("member_date_birth");
    var since = document.getElementById("member_since");
    var data = {            
        first_name :$("#member_first_name").val(),
        last_name :$("#member_last_name").val(),
        second_last_name:$("#member_second_last_name").val(),
        nickname :$("#member_nickname").val(),
        sex :$("#member_sex").val(), 
        date_birth  :1,                                    
        member_since   :1,                               
        address :$("#member_address").val(), 
        neighborhood :$("#member_neighborhood").val(), 
        town :$("#member_town").val(), 
        city :$("#member_city").val(), 
        postal_code:$("#member_postal_code").val(),
        home_phone :$("#member_home_phone").val(), 
        cell_phone :$("#member_cell_phone").val(), 
        email :$("#member_email").val(), 
        company :$("#member_company").val(),  
        job :$("#member_job").val()                         
    }, 
    id = $('#member_id_edit').text();
    //alert("ok");        
    data.date_birth = birth.value;
    data.member_since = since.value;        
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/member') }}' + (typeof id !== 'undefined'?('/' + id):''),
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

$('#add_member').on('click', function(e) { 
    $("#head_member_modal").html("Agregar socio");
    $('#member_id_edit').html("0");
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
    $('#member_id_add_pay').html(id);
    fiilModalPayment(id);
    $('#modal-add-pay').modal();
});          

function fiilModalPayment(id) {
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member/info_payment_wizard') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            $('#full_name_member_add_pay').html(d.first_name+" "+
                    d.last_name+" "+d.second_last_name); 
            var tbody = $('#tbody-memberships-actives');

            var mems = d.memberships;
            for (i = 0; i < mems.length; i++)
            {
                tbody.append("<tr>"+
                    "<td>"+mems[i].start+"</td>"+
                    "<td>"+i+"</td>"+
                    "<td>"+mems[i].membership_name+"</td>"+
                    "<td>"+mems[i].price+"</td>"+
                    "<td>"+mems[i].paid+"</td>"+
                    "<td>"+0+"</td>"+
                    "<td>"+0+"</td></tr>");
            }                            
        }
    });
}        

$('#save_payment').on('click', function(e) {
    var data = {
        amount: $('#amount_add_payment').val(),                
        method_payment: $('#method_payment_add_payment').val(),
        concept: "PAGO GENERAL"
    }, 
    id = $('#member_id_add_pay').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/payment') }}' + (typeof id !== 'undefined'?('/' + id):''),
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

/*
 |------------------------------------------------------------------------
 | Add Memberships
 |------------------------------------------------------------------------
*/    

$('.add_membership').on('click', function(e) {  
    //alert('ok');
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text();          
    $('#member_id_add_membership').html(id);
    //$("#head_member_modal").html("Agregar socio");
    //alert("ok");
    fiilModalAddmembership(id);
    $('#modal-add-membership').modal();            
});             

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

            for (i = 0; i < memst.length; i++)
            {
                select.append("<option>"+memst[i].name+"</option>");
            }
        }
    });
}   

$('#save_add_membership').on('click', function(e) {
    var data = {
        amount: $('#amount_add_membership').val(),                
        method_payment: $('#method_payment_add_membership').val(),
        concept: "MEMBRESIA NUEVA",
        membership_type: $('#type_add_membership').val(),
        start: $('#date_start').val()
    }, 
    id = $('#member_id_add_membership').text();
    //alert(id+" "+data.amount+" "+data.method_payment+" "+data.concept+" "+data.membership_type+" "+data.start)
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/membership') }}' + (typeof id !== 'undefined'?('/' + id):''),
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
            $("#member_first_name").val(d.member.first_name);
            $("#member_last_name").val(d.member.last_name);
            $("#member_second_last_name").val(d.member.second_last_name);
            $("#member_nickname").val(d.member.nickname);
            $("#member_sex").val(d.member.sex); 
            $("#date_birth").val(d.member.birth);                                     
            $("#member_since").val(d.member.member_since);                               
            $("#member_address").val(d.member.address); 
            $("#member_neighborhood").val(d.member.neighborhood); 
            $("#member_town").val(d.member.town); 
            $("#member_city").val(d.member.city); 
            $("#member_postal_code").val(d.member.postal_code);
            $("#member_home_phone").val(d.member.home_phone); 
            $("#member_cell_phone").val(d.member.cell_phone); 
            $("#member_email").val(d.member.email); 
            $("#member_company").val(d.member.company);  
            $("#member_job").val(d.member.job);                  
        }
    });
}   

$('.edit_member').on('click', function(e) {
    var o = $(this),
    id = o.parents('td:first').find('span.member-id').text(); 
    $('#member_id_edit').html(id);
    $("#head_member_modal").html("Editar socio");
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
        type: "DELETE",
        url: '{{ URL::to('/member') }}' + '/' + id,
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
