@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Socios con membresías a punto de expirar</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- row-content -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
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
                                <th>Membresia ID</th>
                                <th>Detalle Membresía</th>
                                <th>Comienza</th>          
                                <th>Termina</th>                                   
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>               
                        @for($i = 0; $i < 6 ;$i++)                             
                            @if($i%2==0)
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">Antonio</td>
                                <td>López</td>
                                <td>Rodríguez</td>
                                <td class="center">8407</td>
                                <td>Mensualidad Estudiante</td>
                                <td>29/May/2015</td>
                                <td>29/Jul/2015</td>
                            </tr>                             
                            @else
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">José</td>
                                <td>Sanchéz</td>
                                <td>Pérez</td>
                                <td class="center">8410</td>
                                <td>Mensualidad General</td>
                                <td>12/Jul/2015</td>
                                <td>12/Sep/2015</td>
                            </tr>  
                            @endif   
                        @endfor    
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
    responsive: true
} ); 

});              
    
</script>
@stop
