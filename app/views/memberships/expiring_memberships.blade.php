@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Membresías de socios a expirar</h1>
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
                    <div class="col-md-3">
                        <p>Fecha inicial</p>
                        <input type="date" class="form-control" id="date_init" value="{{$date_init}}">
                    </div>
                    <div class="col-md-3">
                        <p>Fecha final</p>
                        <input type="date" class="form-control" id="date_end" value="{{$date_end}}">
                    </div>                    
                    <p>&nbsp;</p>
                    <div class="col-md-2">
                        <button id="show_after" type="button" 
                            class="btn btn-outline btn-primary">Mostrar</button>
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
                                <th>Id</th>
                                <th>Nombre Completo</th>
                                <th>Detalle Membresía</th>
                                <th>Comienza</th>          
                                <th>Termina</th>                                   
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>               
                            @if(isset($experingMemberships))
                            @foreach($experingMemberships as $aMemShip)
                            <tr class="gradeA odd" role="row">
                                <td>{{$aMemShip->membership_id}}</td>
                                <td>{{$aMemShip->first_name}}&nbsp;{{$aMemShip->last_name}}&nbsp;{{$aMemShip->second_last_name}}</td>
                                <td>{{$aMemShip->name_membership_type}}</td>
                                <td>{{$aMemShip->start_period}}</td>
                                <td>{{$aMemShip->end_period}}</td>
                            </tr> 
                            @endforeach                            
                            @endif
                        </tbody>
                    </table></div>
                        </div>
                    </div>
                </div>
                <!-- /.datatable-wrapper -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div-->        
</div>
<!-- /.row-content -->        
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

$('#show_after').on('click', function() {    
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;
    window.location.replace("/crm_gym/public/expiring_memberships/"+params);
});  

});              
    
</script>
@stop
