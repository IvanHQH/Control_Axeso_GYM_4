@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tipos de membres&iacute;a</h1>
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
                            id="add_membership_type" data-toggle="modal">                                   
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
                                <th style="width: 172px;">Nombre</th>
                                <th style="width: 204px;">Fecha Creada</th>
                                <th style="width: 185px;">Fecha limite de entrega</th>
                                <th style="width: 149px;">Precio</th>
                                <th style="width: 110px;">Duraci&oacute;n</th>
                                @if(Auth::user()->type == 1)
                                <th style="width: 110px;"></th>          
                                @endif
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @if(isset($membershipTypes))       
                        @foreach($membershipTypes as $memshipType) 
                            <tr class="gradeA odd" role="row">
                                <td>{{$memshipType->id}}</td>
                                <td>{{$memshipType->name}}</td>
                                <td>{{$memshipType->created_at}}</td>
                                <td>{{$memshipType->available_until}}</td>
                                <td>${{$memshipType->price}}</td>
                                <td>{{$memshipType->duration}} días</td>
                                @if(Auth::user()->type == 1)
                                <td style="text-align: center; vertical-align: middle; ">                                    
                                    <span class="membership-type-id" style="display:none">
                                        {{$memshipType->id}}
                                    </span>                                              
                                    <a class="edit_membershiptype" href="javascript:void(0)" title="Editar">
                                        <i class="glyphicon glyphicon-edit">                                    
                                        </i>
                                    </a>
                                    <a class="delete_membershiptype" href="javascript:void(0)" title="Eliminar">
                                        <i class="glyphicon glyphicon-remove">                                    
                                        </i>
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

<div class="modal fade" id="modal-membershiptype" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">                       
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        ×
                </button>
                <h4 class="modal-title" id="myModalLabel">
                        Agregar tipo de membres&iacute;a
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="membership_type_id_edit" style="display: none"></div>                            
                            <div class="form-group">
                                <label>* Nombre</label>
                                <input id="membership_type_name" class="form-control">                                
                            </div>     
                            <div class="form-group">    
                                <label>* Fecha limte de entrega</label>
                                <input id="membership_type_available_unitl" type="date" class="form-control">                                
                            </div>         
                            <div class="form-group">                                 
                                <label>* Precio</label>
                                <input id="membership_type_price" class="form-control"> 
                            </div>     
                            <div class="form-group">                                 
                                <label>* Duración (días)</label>
                                <input id="membership_type_duration" class="form-control">                                 
                            </div>     
                            <!--div class="form-group">                             
                                <label>
                                    <input id="membership_type_available" type="checkbox" value="1">  Disponible
                                </label>
                            </div-->                                  
                        </div>                        
                    </div>
                </div>
                </div>
		<div id="errors_save_membershiptype"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                    </button> 
                    <button id="save_membership_type" type="button" class="btn btn-primary">
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
 | Add MembershipTypes 
 |------------------------------------------------------------------------        
*/  

$('#add_membership_type').on('click',function(e){    
    $('#modal-membershiptype').modal();
    $('input').val('');
$('#errors_save_membershiptype').html("");
$('#errors_save_membershiptype').load();
    $('#membership_type_id_edit').html("0");
});

$('#save_membership_type').on('click',function(e){
    var available_unitl = document.getElementById("membership_type_available_unitl");
    var data = {
        nombre : $("#membership_type_name").val(),                                                     
        habilitada_hasta : 0,
        precio : $("#membership_type_price").val(),
        duracion : $("#membership_type_duration").val()
    },     
    id = $('#membership_type_id_edit').text();
    data.habilitada_hasta = available_unitl.value;
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/membership_type') }}' + (typeof id !== 'undefined'?('/' + id):''),
        data: data,
        success: function(data, textStatus, jqXHR) {  
            if(data.success == true){
                alert("Tipo de membresia guardada");
                window.location.reload();
            }
            else{
                var txt = "Errores de validación : \n";                
                for (i = 0; i < data.errors.length; i++)
                    txt = txt+'\n'+data.errors[i];

			$('#errors_save_membershiptype').html("<div class='alert alert-danger'>"+txt+"</div>");
			$('#errors_save_membershiptype').load();	                      
            }                        
        },
        dataType: 'json'
    });                                          
});

/*
 |------------------------------------------------------------------------
 | Edit MembershipTypes 
 |------------------------------------------------------------------------        
*/  

$('.edit_membershiptype').on('click', function(e) {
    //alert('ok');
    var o = $(this),  
    id = o.parents('td:first').find('span.membership-type-id').text();    
    $('input').val('');
    $('#membership_type_id_edit').html(id);        
    fillModal(id);
    $('#modal-membershiptype').modal();
});        

function fillModal(id){
    $.ajax({
        type : 'GET',
        url : '{{URL::to('membership_type')}}'+'/'+id,
        datatype: 'json',
        success:function(d){
            $("#membership_type_name").val(d.membership_type.name);                                                        
            $("#membership_type_price").val(d.membership_type.price);
            $("#membership_type_duration").val(d.membership_type.duration);
            $("#membership_type_available_unitl").val(d.membership_type.available_unitl);
        },
    });
}

/*
 |------------------------------------------------------------------------
 | Delete MembershipTypes 
 |------------------------------------------------------------------------        
*/  

$('.delete_membershiptype').on('click', function(e) {
    if (!confirm('¿Desea borrar tipo de membresía?'))
            return false;
    var o = $(this),  
    id = o.parents('td:first').find('span.membership-type-id').text(); 
    $.ajax({
        type : "POST",
        url : '{{URL::to('/membership_type/delete')}}'+'/'+id,
        success: function(data, textStatus, jqXHR){
            if(data.success == true){
                alert("¡Tipo de membresía eliminada!");
                window.location.replace("/crm_gym/public/membership_types_list");
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