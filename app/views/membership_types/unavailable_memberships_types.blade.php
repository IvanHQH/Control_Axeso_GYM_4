@extends ('base_templates.BaseLayout')

@section ('content')    
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tipos de membresía no disponibles</h1>
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
                                <th style="width: 50px">Id</th>
                                <th>Nombre</th>
                                <th>Fecha Creada</th>
                                <!--th>Creada Por</th-->
                                <th>Precio</th>
                                <th>Duración</th>
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @if(isset($membershipTypesUnavailabes))       
                        @foreach($membershipTypesUnavailabes as $memshipType) 
                            <tr class="gradeA odd" role="row">
                                <td>{{$memshipType->id}}</td>
                                <td>{{$memshipType->name}}</td>
                                <td>{{$memshipType->created_at}}</td>
                                <td>${{$memshipType->price}}</td>
                                <td>{{$memshipType->duration}} días</td>
                                <!--td>{{$memshipType->available_until}}</td-->
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
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
} ); 

});              
    
</script>
@stop
