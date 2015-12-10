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
            <input id="input_search" type="text" class="form-control" 
                   placeholder="Nombre ó ID" value="">
            <span class="input-group-btn">
            <button id="btn_search" class="btn btn-default" type="button">
                <i class="fa fa-search"></i>
            </button>
            </span>
        </div>
        </div>
        </div>
        <!-- /.row-quick-search -->

        <div id="list_members_found" style="padding-top:-20px"></div>
        <br>

        <!-- row-first-lavel -->
        <div class="row">
        <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div style="display: none" id="member_id"></div>
                    <div id="img_member" class="col-lg-4" >
                        <img  src="img/user.jpg" class="img-thumbnail"
                             alt="Foto del socio" width="170" height="170">
                    </div>
                    <div class="col-lg-8">
                        <div id = "member-id" style="display:none"></div>
                        <div id="txt_main" class="well">
                            <br><br><br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
            <!-- latest-assists -->
            <div class="panel panel-info">
            <div id="panel_head_assists" class="panel-heading">    
                <i class="fa fa-check fa-fw"></i>
                Ultimas Asistencias
                <button id='add-assistance' type='button' class='btn btn-success' 
                        style="visibility: hidden">Agregar asistencia</button>
            </div>
            <div class="dataTable_wrapper">
                <table class="table table-bordered table-hover table-striped" id="tbl-assists">
                <thead>                                        
                    <tr>
                        <th>Día</th>
                        <th>Num.</th>
                        <th>Mes</th>
                        <th>Año</th>
                        <th>Hora</th>
                    </tr>                                                                       
                </thead>
                <tbody id="tbl_assists_last">
                </tbody>
                </table>                                 
            </div>                               
            </div>
            <!-- /.latest-assists -->
            </div>
        </div>
        </div>
        </div>
        <!-- /.row-first-lavel -->
<form id="form_add_member" method="GET" action="quick_search" enctype = 'multipart/form-data'>
<input type='file' style="float:left;" id='archivo' name='archivo' ></name>
<button id="save_member" type="submit" style="float:left;">Guardar Foto</button>
</form><br>
        <!-- row-second-lavel -->
        <br>
        <div class="row">
        <div class="col-lg-12">
            <div class="row">
            <div class="col-lg-8">
                <!-- memberships -->
                <div class="panel panel-info">
                <div class="panel-heading">                                
                    <i class="fa fa-list-alt fa-fw"></i>
                    Membresías
                </div>
                <div class="dataTable_wrapper">
                    <table class="table table-bordered table-hover table-striped" 
                           id="tbl-memberships">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Compra</th>
                                <th>Inicio período</th>
                                <th>Fin período</th>
                                <th>Activa</th>
                            </tr>                               
                        </thead>
                        <tbody id="tbl_memberships">
                        </tbody>
                    </table>
                </div>    
                </div>
                <!-- /.memberships -->
            </div> 
            <div class="col-lg-4">     
                <div class="chat-panel panel panel-info">
                <div class="panel-heading">
                    <i class="fa fa-edit fa-fw"></i>
                    Notas
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body" style=" max-height: 100px;">
                    <ul class="chat" id="list_notes">
                    </ul>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="input-group">
                        <input id="input-note" type="text" class="form-control input-sm" 
                               placeholder="Escribe tu mensaje aquí...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-add-note">
                                Guardar
                            </button>
                        </span>
                    </div>
                </div>
                <!-- /.panel-footer -->
                </div>                                                                             
            </div>                                    
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
                                <i class="fa fa-dollar fa-fw"></i>
                                Pagos
                            </div>
                            <table class="table table-striped" style="height:150px">
                                <thead>
                                    <tr style="width: 100%;display: inline-table;">
                                        <th>Fecha/Hora</th>
                                        <th>Concepto</th>
                                        <th>Cantidad</th>
                                        <th>Recibió</th>                                        
                                    </tr>                                        
                                </thead>
                                <tbody id="tbl_payments" 
                                       style="overflow-y: scroll;height: 110px;
                                       width: 97%;position: absolute;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.latest-sales -->
                    <!-- lockers -->
                    <!--div class="col-lg-4">                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <i class="fa fa-archive fa-fw"></i>
                                Casilleros
                            </div>
                            <ul id="tbl_list_lockers" class="list-group">
                            </ul>
                        </div>  
                    </div-->
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
  
$('#btn-add-note').on('click',function(){
    var data = {            
        note_text :$('#input-note').val(),                  
        member_id :$('#member_id').html()
    };
    $.ajax({
        type: "POST",
        url: '{{ URL::to('/note') }}',
        data: data,
        success: function(data, textStatus, jqXHR) {    
            if(data.success == true){
                $('#list_notes').html(" ");
                var member_id = $('#member_id').html();
                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/member/notes') }}' + '/' + member_id,
                    data: data,
                    success: function(data, textStatus, jqXHR) {    
                        if(data.success == true){
                            var tbnotes = $('#list_notes');
                            var notes = data.notes;           
                            for (i = 0; i < notes.length; i++){
                                tbnotes.append("<li class='center clearfix'>"+
                                    "<div class='chat-body clearfix'>"+
                                    "<div class='header'><small class='text-muted'>"+
                                            notes[i].created_at+
                                    "</small><strong class='pull-right primary-font'>"+
                                            notes[i].user_first_name+" "+notes[i].user_last_name+
                                    "</strong></div><p>"+
                                            notes[i].text+
                                    "</p></div></li>");
                            }
                            $('#input-note').val('');
                            $('#input-note').load();
                            $('#list_notes').load();
                        }else{}                        
                    },
                    dataType: 'json'
                }); 

            }
            else{

            }                        
        },
        dataType: 'json'
    });     

});
        
        
function fillSearch(ident){
$.ajax({
    type: 'GET',
    url: '{{ URL::to('/member/quick_search') }}' + '/' + ident,
    dataType: 'json',
    success: function(d) {
        if(d.success == true){
        $('#list_members_found').html("");
        $('#list_members_found').load();
            var img_cont = "<img  src='img/"+d.member.img_member+
                    "' class='img-thumbnail' alt='Foto del socio' width='100%' height='100%'> ";                        
            
            var frm = document.getElementById('form_add_member');
	    frm.setAttribute("action",'member/photo/'+d.member.member_id); 
	    frm.setAttribute("method",'POST'); 

            $("#img_member").html(img_cont);
            $("#txt_main").html("");
            $("#member_id").html(d.member.member_id);
            $("#txt_main").append("<h5>"+d.member.txt_main+"</h5>");
            
            var tbassists = $('#tbl_assists_last');
            var assists = d.member.assists_last;
            for (i = 0; i < assists.length && i < 3; i++){
                tbassists.append("<tr>"+
                    "<td>"+assists[i].name_day+"</td>"+
                    "<td>"+assists[i].number_day+"</td>"+
                    "<td>"+assists[i].month+"</td>"+
                    "<td>"+assists[i].year+"</td>"+
                    "<td>"+assists[i].time+"</td></tr>");
            }

            var tbmembers = $('#tbl_memberships');
            var memberships = d.member.memberships;
            
            if(memberships.length > 0)
                document.getElementById("add-assistance").style.visibility = "visible"; 
            
            for (i = 0; i < memberships.length && i < 3; i++){
                //alert(memberships[i].id);
                $('#member-id').text(memberships[i].id);    
                tbmembers.append("<tr>"+
                    "<td>"+memberships[i].membership_name+"</td>"+
                    "<td>"+memberships[i].start+"</td>"+
                    "<td>"+memberships[i].start_period+"</td>"+
                    "<td>"+memberships[i].end_period+"</td>"+
                    "<td>"+((memberships[i].active == 1)?'SI':'NO')+"</td></tr>");
            }

            var tbpayments = $('#tbl_payments');
            var payments = d.member.payments;           
            
            for (i = 0; i < payments.length; i++){
                tbpayments.append("<tr style='width: 100%;display: inline-table;'>"+
                    "<td>"+payments[i].created_at+"</td>"+    
                    "<td>"+payments[i].concept+"</td>"+
                    "<td>$"+payments[i].amount+"</td>"+
                    "<td>"+payments[i].user_first_name+" "+payments[i].user_last_name+"</td></tr>");
            }

            var tbnotes = $('#list_notes');
            var notes = d.member.notes;           
            
            for (i = 0; i < notes.length; i++){
                tbnotes.append("<li class='center clearfix'>"+
                            "<div class='chat-body clearfix'>"+
                            "<div class='header'><small class='text-muted'>"+
                                    notes[i].created_at+
                            "</small><strong class='pull-right primary-font'>"+
                                    notes[i].user_first_name+" "+notes[i].user_last_name+
                            "</strong></div><p>"+
                                    notes[i].text+
                            "</p></div></li>");
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
            $("#member_id").load();
        }
        else{
            if(d.members.length > 0){   
                var content = "";           
                for (i = 0; i < d.members.length; i++){
                    content = content + 
                    "<div class='liDiv'><span>"+d.members[i].id+"</span><p>"+d.members[i].first_name+" "+d.members[i].last_name+" "+d.members[i].second_last_name+"</p></div>";
                }   
                $('#list_members_found').html(content);
                $('#list_members_found').load();
                var listMembers = document.getElementById("list_members_found");
                var rows = listMembers.getElementsByTagName("div");
                for (i = 0; i < rows.length; i++) {
                    row = rows[i];
                    row.onclick = function(){
                        var idMember = this.getElementsByTagName("span");
                        idMember = idMember[0];
                        fillSearch(idMember.innerHTML);
                    };
                }      
            }else{alert(d.errors);}
        }
    }
});
}

function clearContent()
{
    $("#img_member").html("<img  src='img/user.jpg' class='img-thumbnail' alt='Cinque Terre' width='170' height='170'>");    
    $("#txt_main").html("<h4>¡Socio no encontrado!</h4><br><br><br><br>");
    $('#tbl_assists_last').html("");
    $('#tbl_memberships').html("");
    $('#list_notes').html("");
    $('#member_id').html("");
    $('#tbl_payments').html("");
    document.getElementById("add-assistance").style.visibility = "hidden"; 
}

$('#btn_search').on('click',function(){
    var ident = $('#input_search').val();
    clearContent();
    fillSearch(ident);
});

$('#add-assistance').on('click',function(){
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
                for (i = 0; i < assists.length && i < 3; i++){
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
