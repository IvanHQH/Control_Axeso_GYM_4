@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Socios con membres&iacute;a inactivas</h1>
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
                        <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered 
                                table-hover dataTable no-footer" id="dataTables-example"
                                role="grid" aria-describedby="dataTables-example_info">
                        <thead>
                            <!-- headers-columns -->
                            <tr role="row">
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Direcci&oacute;n</th>
                                <th>Colonia</th>          
                                <th>Ciudad</th>            
                                </th><th>Estado</th>        
                                <th>Tel&eacute;fono Movil</th>                                         
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                            @if(isset($inactiveMemberships))
                            @foreach($inactiveMemberships as $iMemShip)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">{{$iMemShip->first_name}}</td>
                                <td>{{$iMemShip->last_name}}</td>
                                <td>{{$iMemShip->second_last_name}}</td>
                                <td>{{$iMemShip->address}}</td>
                                <td>{{$iMemShip->neighborhood}}</td>
                                <td>{{$iMemShip->city}}</td>
                                <td class="center">{{$iMemShip->town}}</td>
                                <td class="center">{{$iMemShip->cell_phone}}</td>
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
@stop

@section('scripts')
<script>
$(document).ready(function() {        

$('#dataTables-example').dataTable( {
    paging: true,
    searching: true,    
    responsive: true
} ); 

});              
    
</script>
@stop
