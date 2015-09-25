@extends ('base_templates.BaseLayout')

@section('content')
<div id="page-wrapper">
    <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Asistencias</h1>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                 <div class="col-md-3">
                    <p>Fecha inicial</p>
                    <input type="date" class="form-control" id="date_init">
                </div>
                <p>Fecha final</p>
                <div class="col-md-3">
                    <input type="date" class="form-control" id="date_end">
                </div>
                <p></p>
                <div class="col-md-2">
                    <button id="show_between_dates" type="button" 
                        class="btn btn-outline btn-primary">Mostrar</button>
                </div>
            </div>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
        <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Fecha/Hora</th>
                <th>Turno</th>
                <th style="width: 60px;"><font color ='white'>....</font> </th>
                </tr>
            </thead>
            <tbody>
                @if(isset($assists))
                    @foreach($assists as $assist)
                    <tr class="odd gradeX">
                        <td>{{$assist->first_name}}</td>
                        <td>{{$assist->last_name}}</td>
                        <td>{{$assist->second_last_name}}</td>                                                
                        <td class="center">{{$assist->created_at}}</td>
                        <td class="center">{{$assist->turn}}</td>
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="assist-id" style="display: none">
                                {{$assist->id}}
                            </span>                              
                            <a class="delete_assist" title="Remove" style="cursor:pointer">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
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
    
</div>
@endsection

@section('scripts')
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
        
$('#dataTables-example').DataTable({
    paging: true,
    searching: true,    
    responsive: true
});    

$('.delete_assist').on('click', function() {
    if (!confirm('Desea borrar la asistencia?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.assist-id').text(); 
    $.ajax({
        type: "DELETE",
        url: '{{ URL::to('/assist') }}' + '/' + id,
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

$('#show_between_dates').on('click', function() {
    //alert("ok");
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;

    window.location.replace("http://axeso_gym.dev/assists_list/"+params);
});  

});
</script>
@endsection