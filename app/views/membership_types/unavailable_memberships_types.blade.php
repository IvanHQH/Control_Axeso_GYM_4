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
                        <!-- show-entries -->
                        <div class="row">
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
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
                                style="width: 185px;">Creada Por
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" 
                                colspan="1" aria-label="Engine version: activate to sort column ascending" 
                                style="width: 149px;">Precio
                                </th><th class="sorting" tabindex="0" aria-controls="dataTables-example" 
                                rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" 
                                style="width: 110px;">Duración
                                </th>
                            </tr>
                            <!-- /.headers-columns -->
                        </thead>
                        <tbody>
                        @for($i = 0; $i < 2 ;$i++) 
                            <tr class="gradeA odd" role="row">
                                <td class="sorting_1">Membresia {{$i+7}}</td>
                                <td>25/Jun/2015</td>
                                <td>Usuario</td>
                                <td class="center">$1200</td>
                                <td class="center">60 días</td>
                            </tr>
                        @endfor     
                        </tbody>
                    </table></div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">
                                Showing 1 to 10 of 57 entries
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
@stop

@section('scripts')
@stop
