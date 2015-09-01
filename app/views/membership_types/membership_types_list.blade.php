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
            <!-- panel-body -->
            <div class="panel-body">
                <!-- datatable-wrapper -->
                <div class="dataTable_wrapper">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper 
                         form-inline dt-bootstrap no-footer">
                        <!-- show-entries -->
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-outline btn-primary" 
                                    id="add_membership_type" data-toggle="modal">                                   
                                Agregar
                                </button>                                 
                            </div>                              
                            <div class="col-sm-4">         
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
                            <div class="col-sm-4">
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
                                style="width: 172px;">Nombre
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" 
                                style="width: 204px;">Fecha Creada
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" 
                                style="width: 185px;">Diponible hasta
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" 
                                colspan="1" aria-label="Engine version: activate to sort column ascending" 
                                style="width: 149px;">Precio
                                </th><th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">Duraci&oacute;n
                                </th>
                                </th><th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">
                                </th>                                
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @if(isset($membershipTypes))       
                        @foreach($membershipTypes as $memshipType) 
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">{{$memshipType->name}}</td>
                                <td>{{$memshipType->created_at}}</td>
                                <td class="center">{{$memshipType->available_until}}</td>
                                <td class="center">{{$memshipType->price}}</td>
                                <td class="center">{{$memshipType->duration}}</td>
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
                                <label>Nombre</label>
                                <input id="membership_type_name" class="form-control" value="promocion spetiembre">                                
                            </div>     
                            <div class="form-group">    
                                <label>habilitada hasta</label>
                                <input id="membership_type_available_unitl" type="date" class="form-control">                                
                            </div>         
                            <div class="form-group">                                 
                                <label>Precio</label>
                                <input id="membership_type_price" class="form-control" value="600"> 
                            </div>     
                            <div class="form-group">                                 
                                <label>Duración (días)</label>
                                <input id="membership_type_duration" class="form-control" value="6">                                 
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

/*
 |------------------------------------------------------------------------
 | Add MembershipTypes 
 |------------------------------------------------------------------------        
*/  

$('#add_membership_type').on('click',function(e){    
    $('#modal-membershiptype').modal();
    $('#membership_type_id_edit').html("0");
});

$('#save_membership_type').on('click',function(e){
    var available_unitl = document.getElementById("membership_type_available_unitl");
    var data = {
        name : $("#membership_type_name").val(),                            
        //available_unitl : $("#membership_type_available_unitl").val(),                            
        available_until : 0,
        price : $("#membership_type_price").val(),
        duration : $("#membership_type_duration").val()//,
        //available : $("#membership_type_available").val()
        //available : $("#membership_type_available").val()  
    },     
    id = $('#membership_type_id_edit').text();
    data.available_until = available_unitl.value;
    //alert(id);
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/membership_type') }}' + (typeof id !== 'undefined'?('/' + id):''),
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
 | Edit MembershipTypes 
 |------------------------------------------------------------------------        
*/  

$('.edit_membershiptype').on('click', function(e) {
    //alert('ok');
    var o = $(this),  
    id = o.parents('td:first').find('span.membership-type-id').text();     
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
            $("#membership_type_name").val(d.membership_type.name),                                                        
            $("#membership_type_price").val(d.membership_type.price),
            $("#membership_type_duration").val(d.membership_type.duration)            
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
        type : "DELETE",
        url : '{{URL::to('/membership_type')}}'+'/'+id,
        success: function(data, textStatus, jqXHR){
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