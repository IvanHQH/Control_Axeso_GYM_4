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
                <th style="width: 40px">Id</th>
                <th>Nombre Completo</th>
                <th>Fecha/Hora</th>
                @if(Auth::user()->type == 1) 
                <th style="width: 60px;"><font color ='white'>....</font> </th>
                @endif
                </tr>
            </thead>
            <tbody>
                @if(isset($members))
                    @foreach($members as $member)
                    <tr class="odd gradeX">
                        <td>{{$member->id}}</td>                        
                        <td>{{$member->first_name}}&nbsp;{{$member->last_name}}&nbsp;{{$member->second_last_name}}</td>                                                                    
                        <td class="center">{{$member->created_at}}</td>
                        @if(Auth::user()->type == 1) 
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="assist-id" style="display: none">
                                {{$member->id}}
                            </span>                              
                            <a class="delete_assist" title="Remove" style="cursor:pointer">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                        @endif
                    </tr>                    
                    @endforeach
                @endif
                @if(isset($visitors))
                    @foreach($visitors as $visitor)
                    <tr class="odd gradeX">
                        <td>{{$visitor->id}}</td>                        
                        <td>{{$visitor->full_name}}</td>
                        <td class="center">{{$visitor->created_at}}</td>
                        @if(Auth::user()->type == 1) 
                        <td style="text-align: center; vertical-align: middle; ">
                            <span class="assist-id" style="display: none">
                                {{$visitor->id}}
                            </span>                              
                            <a class="delete_assist" title="Remove" style="cursor:pointer">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </td>
                        @endif
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
    responsive: true,
    "aaSorting": [[0, 'desc']],
    "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"}
});    

$('.delete_assist').on('click', function() {
    if (!confirm('¿Desea borrar la asistencia?')) {
        return false;
    }
    var o = $(this),
    id = o.parents('td:first').find('span.assist-id').text(); 
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/assist/delete') }}' + '/' + id,
        success: function(data, textStatus, jqXHR) {                        
            if(data.success == true){
                alert('¡Asistencia eliminada!');
                window.location.replace("/crm_gym/public/assists_list");
            }
            else{alert(data.errors);}                        
        },
        dataType: 'json'
    });                
});

$('#show_between_dates').on('click', function() {
    //alert("ok");
    var init = document.getElementById("date_init")
    var end = document.getElementById("date_end")
    var params;
    params = init.value+"+"+end.value;

    window.location.replace("assists_list/"+params);
});  

});
</script>
@endsection