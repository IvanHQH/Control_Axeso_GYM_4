@extends ('base_templates.BaseLayout')

@section ('content')
<div id="page-wrapper">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Busqueda rápida de socios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div id="all_content" class="row">
    <!-- row-content -->
    <div class="col-lg-12">
        <!-- row-quick-search -->
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group custom-search-form">
                    <input id="input_search" type="text" class="form-control" placeholder="Nombre ó ID" value="1">
                    <span class="input-group-btn">
                    <button id="btn_search" class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    </span>
                </div>
            </div>
        </div>
        <!-- /.row-quick-search -->
        <br>
        <!-- row-first-lavel -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div id="img_member" class="col-lg-4" >
                                <img  src="/img/user.jpg" class="img-thumbnail"
                                     alt="Cinque Terre" width="170" height="170">
                            </div>
                            <div class="col-lg-8">
                                <div id = "member-id" style="display:none"></div>
                                <div id="txt_main" class="well">
                                    <br><br><br><br><br><br>
                                    <!--h4>!Bienvenido Juan Pérez!</h4>
                                    <p>¡Hoy parece ser tu primer visita!</p>
                                    <p>Hay un saldo pendiente de $200</p>
                                    <p>Tu ultima membresía activa vence 20/Ago/2015</p-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- latest-assists -->
                        <div class="panel panel-info">
                            <div id="panel_head_assists" class="panel-heading">
                                Ultimas Asistencias&nbsp;&nbsp;
                                <button id='add-assistance' type='button' class='btn btn-success' style="visibility: hidden">Agregar asistencia</button>
                            </div>
                            <table class="table table-bordered table-hover table-striped" style="height: 110px">
                                <thead>
                                </thead>
                                <tbody id="tbl_assists_last" style="overflow-y: scroll;height: 110px;width: 92%;position: absolute">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.latest-assists -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row-first-lavel -->
        <!-- row-second-lavel -->
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- memberships -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Membresías
                            </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                </thead>
                                <tbody id="tbl_memberships">
                                    <!--tr>
                                        <td>Mensualidad Estudiante</td>
                                        <td>20/Jul/2015</td>
                                        <td>20/Sep/2015</td>
                                        <td>Activa</td>
                                    </tr-->
                                </tbody>
                            </table>
                        </div>
                        <!-- /.memberships -->
                    </div>
                    <div class="col-lg-4" >
                        <!-- notes -->
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Casilleros
                            </div>
                            <ul id="tbl_list_lockers" class="list-group">
                              <!--li class="list-group-item">A12</li-->
                            </ul>
                        </div>
                        <!-- /.notes -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row-second-lavel -->
        <!-- row-third-lavel -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- latest-sales -->
                    <div class="col-lg-8">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Últimas Ventas
                            </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                </thead>
                                <tbody id="tbl_sales_last">
                                    <!--tr>
                                        <td>25/07/2015</td>
                                        <td>08:40</td>
                                        <td>Producto A</td>
                                        <td>2</td>
                                        <td>$60</td>
                                    </tr>
                                    <tr>
                                        <td>25/07/2015</td>
                                        <td>08:40</td>
                                        <td>Producto A</td>
                                        <td>2</td>
                                        <td>$60</td>
                                    </tr>
                                    <tr>
                                        <td>25/07/2015</td>
                                        <td>08:40</td>
                                        <td>Producto A</td>
                                        <td>2</td>
                                        <td>$60</td>
                                    </tr-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.latest-sales -->
                    <!-- lockers -->
                    <div class="col-lg-4">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Notas
                            </div>
                            <div id="txt_notes" class="panel-body">
                            </div>
                        </div>
                    </div>
                    <!-- /.lockers -->
                </div>
            </div>
        </div>
        <!-- row-third-lavel -->
    </div>
    <!-- /.row-content -->
</div>
<!-- /.row -->
</div>
@stop

@section('scripts')
<script>
$(document).ready(function() {

function fillSearch(ident){
$.ajax({
    type: 'GET',
    url: '{{ URL::to('/member/quick_search') }}' + '/' + ident,
    dataType: 'json',
    success: function(d) {
        if(d.success == true){
            var img_cont = "<img  src='/img/photos_members/"+d.member.img_member+
                    "' class='img-thumbnail' alt='Cinque Terre' width='170' height='170'> ";
            
            //$('#add-assistance').style.visibility = "visible"; 
            document.getElementById("add-assistance").style.visibility = "visible"; 
            
            $("#img_member").html(img_cont);
            $("#txt_main").html("<h4>"+d.member.txt_main+"</h4>");
            
            var tbassists = $('#tbl_assists_last');
            var assists = d.member.assists_last;
            for (i = 0; i < assists.length; i++){
                tbassists.append("<tr>"+
                    "<td>"+assists[i].name_day+"</td>"+
                    "<td>"+assists[i].number_day+"</td>"+
                    "<td>"+assists[i].month+"</td>"+
                    "<td>"+assists[i].year+"</td>"+
                    "<td>"+assists[i].time+"</td></tr>");
            }

            var tbmembers = $('#tbl_memberships');
            var memberships = d.member.memberships;
            for (i = 0; i < memberships.length; i++){
                $('#member-id').text(memberships[i].id);    
                tbmembers.append("<tr style='display: inline-table'>"+
                    "<td>"+memberships[i].membership_name+"</td>"+
                    "<td>"+memberships[i].start+"</td>"+
                    "<td>"+memberships[i].available_until+"</td>"+
                    "<td>"+memberships[i].active+"</td></tr>");
            }

            /*var lstLock = $('#tbl_list_lockers');
            var lockers = d.lockers;
            for (i = 0; i < lockers.length; i++){
                lstLock.append("<li>"+lstLock[i].available+"</li>");
            }

            var tbsales = $('#tbl_tbl_sales_last');
            var sales = d.sales_last;
            for (i = 0; i < sales.length; i++){
                tbsales.append("<tr>"+
                    "<td>"+sales[i].date+"</td>"+
                    "<td>"+sales[i].time+"</td>"+
                    "<td>"+sales[i].product_name+"</td>"+
                    "<td>"+sales[i].quantity+"</td>"+
                    "<td>"+sales[i].amount+"</td></tr>");
            }

            $("#txt_notes").val(d.member.notes);*/

            $('#page-wrapper').load();
        }
        else{
            alert(data.errors);
        }
    }
});
}

function clearContent()
{
    $("#img_member").html("<img  src='/img/user.jpg' class='img-thumbnail' alt='Cinque Terre' width='170' height='170'>");    
    $("#txt_main").html("<h4>¡Socio no encontrado!</h4><br><br><br><br>");
    $('#tbl_assists_last').html("");
    $('#tbl_memberships').html("");    
    document.getElementById("add-assistance").style.visibility = "hidden"; 
}

$('#btn_search').on('click',function(){
    var ident = $('#input_search').val();
    clearContent();
    //all_content
    //$('#all_content').load();
    fillSearch(ident);
});

//

$('#add-assistance').on('click',function(){
//
    var id = $('#member-id').text();
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/assist') }}/' +  id,
        success: function(d, textStatus, jqXHR) {  
            if(d.success == true){   
                fillAssists(id);
                $('#tbl_assists_last').load();
                alert('asistencia guardada');                
            }
            else{
                if (!confirm(d.errors))
                    return false;   
                                        
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/turn_user/create') }}',
                    success: function(d, textStatus, jqXHR) {  
                        if(d.success == true){   
                            alert('¡Turno Agregado!');     
                            window.location.reload();
                        }
                        else{
                            alert(d.errors);
                        }                        
                    },
                    dataType: 'json'
                });                      
                    
                    
            }                        
        },
        dataType: 'json'
    });              
});

function fillAssists(id)
{
    $.ajax({
        type: 'GET',
        url: '{{ URL::to('/member/assists_last') }}' + '/' + id,
        dataType: 'json',
        success: function(d) {
            if(d.success == true){
                $('#tbl_assists_last').html("");
                var tbassists = $('#tbl_assists_last');
                var assists = d.member.assists_last;
                for (i = 0; i < assists.length; i++){
                    tbassists.append("<tr>"+
                        "<td>"+assists[i].name_day+"</td>"+
                        "<td>"+assists[i].number_day+"</td>"+
                        "<td>"+assists[i].month+"</td>"+
                        "<td>"+assists[i].year+"</td>"+
                        "<td>"+assists[i].time+"</td></tr>");
                }
                $('#tbl_assists_last').load();
            }
            else{
                alert(data.errors);
            }
        }
    });    
}

});
</script>
@stop
