<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'HQH GYM')</title>
    
    {{-- Bootstrap --}}
    {{ HTML::style('assets/css/bootstrap.min.css', array('media' => 'screen')) }}
    {{-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --}}

    <!-- Bootstrap Core CSS -->
    {{ HTML::style('assets/bower_components/bootstrap/dist/css/bootstrap.min.css', array('media' => 'screen')) }}
    <!-- MetisMenu CSS -->
    {{ HTML::style('assets/bower_components/metisMenu/dist/metisMenu.min.css', array('media' => 'screen')) }}
    <!-- Timeline CSS -->
    {{ HTML::style('assets/dist/css/timeline.css', array('media' => 'screen')) }}
    <!-- Custom CSS -->
    {{ HTML::style('assets/dist/css/sb-admin-2.css', array('media' => 'screen')) }}
    <!-- Morris Charts CSS -->
    {{ HTML::style('assets/bower_components/morrisjs/morris.css', array('media' => 'screen')) }}
    <!-- Custom Fonts -->
    {{ HTML::style('assets/bower_components/font-awesome/css/font-awesome.min.css', array('media' => 'screen')) }}
    <!-- Extra Theme CSS -->
    {{ HTML::style('assets/css/extra-theme.css', array('media' => 'screen')) }}
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->        
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">            
        <div class="navbar-header">                
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>                       
            <a class="navbar-brand"><img src="img/hqh.png" style="width:60px;height:25px;"></a>
            <!--a class="navbar-brand"></a-->                
            <a class="navbar-brand">
                <p class="text-info" style="font-size:15px">
                    {{TurnUser::currentNameBranchOffice()}}     
                </p> 
            </a>                
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">          
            <li class="dropdown">
                <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>               
            </li>
        </ul>
        <!-- /.navbar-top-links -->    
        <div class="navbar-default sidebar" role="navigation">               
            <div class="sidebar-nav navbar-collapse">
                <div class="panel panel-info">         
                    <a class="list-group-item">
                        <i class="fa fa-user"></i>                        
                        {{Auth::user()->first_name." ".Auth::user()->last_name}}</a>
                    <a class="list-group-item">
                        <i class="fa fa-history"></i>                        
                        {{"Turno ".TurnUser::descripTurnUserOpen(Auth::user()->branch_office_id)}}</a>
                    <a class="list-group-item">
            <button id="close_turn" type="button" 
                    class="btn btn-outline btn-primary btn-sm btn-block">
                @if(TurnUser::descripTurnUserOpen(Auth::user()->branch_office_id)  != "NO" ) 
                    Cerrar Turno
                @else
                    Crear Turno
                @endif
            </button>                     
                    </a>                    
                </div>                 
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="quick_search"><i class="fa fa-user fa-fw"></i> Busqueda r&aacute;pida</a></li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Socios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="members_list">Listado</a></li>                        
                            <li><a href="active_memberships">Membres&iacute;as activas</a></li>
                            <li><a href="inactive_memberships">Membres&iacute;as inactivas</a></li>                                
                            <li><a href="expiring_memberships">Membres&iacute;as a expirar</a></li>                                  
                        </ul>
                        <!-- /.nav-members-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-list-alt fa-fw"></i> Tipos membres&iacute;as<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="membership_types_list">Listado</a></li>
                            <li><a href="available_memberships_types">Tipos Disponibles</a></li>
                            <li><a href="unavailable_memberships_types">Tipos No Disponibles</a></li>                            
                            <li><a href="memberships_paymets">Pagos</a></li>                                 
                        </ul>
                        <!-- /.nav-memberships-level -->
                    </li>    
                    <li>
                        <a href="#"><i class="fa fa-ticket fa-fw"></i> Visitas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="visitors_list">Listado</a></li>                               
                        </ul>
                        <!-- /.nav-memberships-level -->
                    </li>        
                    <li>
                        <a href="#"><i class="fa fa-dollar fa-fw"></i> Caja<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="incomes">Ingresos Punto de Venta</a></li>                               
                            <li><a href="outcomes">Egresos</a></li>                                                         
                            <li><a href="turner_cash">Cortes</a></li>                                                                    
                        </ul>
                        <!-- /.nav-memberships-level -->
                    </li>       
                    <li>
                        <a href="#"><i class="fa fa-cubes fa-fw"></i> Productos<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="products_list">Listado</a></li>                                                                                                     
                        </ul>
                        <!-- /.nav-memberships-level -->
                    </li>                     
                    <li>
                        <a href="#"><i class="fa fa-check fa-fw"></i> Asistencias<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">                             
                            <li><a href="assists_list">Listado</a></li>                                                                                                                            
                        </ul>
                        <!-- /.nav-memberships-level -->
                    </li>                         
                </ul>
            </div>
            <!-- /.sidebar-collapse -->               
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    @yield('content')        

    <!-- /#page-wrapper -->
</div>    
<!-- /#wrapper -->    

<div class="modal fade" id="modal-assistance" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">                       
        <div class="modal-header" style="background-color: #5cb85c">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
            <h4 class="modal-title" id="myModalLabel">
                    Asistencia</h4>
        </div>
        <div class="modal-body">
            <div id="member_id_add_membership" style="display: none"></div>
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">                           
                <div class="container-fluid">                                
                    <div class="row">
                        <h3 id="assistance_full_name_member"></h3>
                        <br>
                        <div id="assistance_photo" class="col-md-4"> 
                            <img src="/img/user.jpg" class="img-thumbnail" 
                                alt="Cinque Terre" width="150" height="200">                                                                             
                        </div>
                        <div id="assistance_col1" class="col-md-3">                            
                            <div class="form-group">
                                <label id="label_assistance_membership" >Membresía</label></div>       
                            <div class="form-group">
                                <label id="label_assistance_member_sice" >Socio desde</label></div>                               
                            <div class="form-group">
                                <label id="label_assistance_validity" >Vigencia</label></div>   
                            <!--div class="form-group">
                                <label>Adeudo</label></div-->      
                            <div class="form-group">
                                <label id="label_assistance_note" >Ultima nota</label></div>                                
                        </div>
                        <div id="assistance_col1" class="col-md-5">                            
                            <div class="form-group">
                                <label id="assistance_membership"></label></div>      
                            <div class="form-group">
                                <label id="assistance_member_sice"></label></div>                              
                            <div class="form-group">
                                <label id="assistance_validity"></label></div>   
                            <!--div class="form-group">
                                <label id="assistance_debt"></label></div-->      
                            <div class="form-group">
                                <label id="assistance_note"></label></div>                                
                        </div>                        
                    </div>
                </div> 
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cerrar</button> 
            </div>
    </div>
    </div>
</div>

    
<div class="modal fade" id="modal-no-assistance" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">                       
        <div class="modal-header" style="background: #d9534f">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
            <h4 class="modal-title" id="myModalLabel">Acceso denegado</h4>
        </div>
        <div class="modal-body">
            <div id="member_id_add_membership" style="display: none"></div>
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-12">                           
                <div class="container-fluid">                                
                    <div class="row">
                        <h3 id="no_assistance_full_name_member"></h3>
                        <br>
                        <div id="no_assistance_photo" class="col-md-4"> 
                            <img src="/img/user.jpg" class="img-thumbnail" 
                                alt="Cinque Terre" width="150" height="200">                                                                             
                        </div>
                        <div id="assistance_col1" class="col-md-8">                            
                            <div class="form-group">
                                <h1>MEMBRESÍA INACTIVA</h1>
                            </div>                                 
                        </div>                     
                    </div>
                </div> 
                </div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cerrar</button> 
            </div>
    </div>
    </div>
</div>

<div class="modal fade" id="modal-open-close-cashbox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                  
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                x</button>
        <h4 class="modal-title" id="title_close_open_cashbox"></h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">                           
            <div class="container-fluid">                                
                <div class="row">
                    <div class="form-group">
                        <label>* Cantidad</label>
                        <input type="text" class="form-control" id="amount_cashbox">
                    </div>                    
                </div>
            </div> 
            </div>
            </div>
        </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" 
                data-dismiss="modal">Cerrar</button> 
        <button id="save_amount_cashbox" type="button" class="btn btn-primary">Guardar
        </button>  
    </div>
</div>
</div>
</div>

<div class="modal fade" id="modal-success" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                  
    <div class="modal-header" style="background: #5cb85c">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                x</button>
        <h4 class="modal-title" id="title_close_open_cashbox">Mensaje</h4>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">                                                        
                <div class="row">
                    <div class="form-group">
                        <label id="message_success"></label>
                    </div>                    
                </div>
            </div>
            </div>
        </div>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" 
            data-dismiss="modal">Cerrar</button>  
    </div>
</div>
</div>
</div>
{{-- Wrap all page content here --}}	    
{{-- jQuery (necessary for Bootstrap's JavaScript plugins) --}}
<script src="//code.jquery.com/jquery.js"></script> 

@yield('scripts')
{{-- Include all compiled plugins (below), or include individual files as needed --}}
{{ HTML::script('assets/js/jquery.min.js') }}
{{ HTML::script('assets/js/bootstrap.min.js') }}
<!-- jQuery -->
{{ HTML::script('assets/bower_components/jquery/dist/jquery.min.js') }}
<!-- Bootstrap Core JavaScript -->
{{ HTML::script('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
<!-- Metis Menu Plugin JavaScript -->
{{ HTML::script('assets/bower_components/metisMenu/dist/metisMenu.min.js') }}
<!-- Morris Charts JavaScript -->
{{ HTML::script('assets/bower_components/raphael/raphael-min.js') }}   
{{ HTML::script('assets/bower_components/morrisjs/morris.min.js') }}
<!-- DataTables JavaScript -->
{{ HTML::script('assets/bower_components/datatables/media/js/jquery.dataTables.min.js') }}
{{ HTML::script('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}  
<!-- Custom Theme JavaScript -->
{{ HTML::script('assets/dist/js/sb-admin-2.js') }}

<script>
$(document).ready(function() {         

    function showModalSuccess(message){
            $('#message_success').html($message);
            $('#message_success').load();
            $('#modal_success').modal();	
    }

    $('#close_turn').on('click', function() {

        if($("#close_turn").html().indexOf("Cerrar Turno") > -1){
            $("#title_close_open_cashbox").html("Cierre de caja");
        }
        else{
            $("#title_close_open_cashbox").html("Apertura de caja");
        }        
        $('#modal-open-close-cashbox').modal();
    }); 

    $('#save_amount_cashbox').on('click', function() {	
        var amount = $("#amount_cashbox").val();
        if($("#close_turn").html().indexOf("Cerrar Turno") > -1){
            $.ajax({
                type: 'GET',
                url: '{{ URL::to('/close_turn_user/') }}' + '/' + amount,
                dataType: 'json',
                success: function(d) {
                    if(d.success == true){}
                    else{     
                        alert(d.errors);
                    }
                    window.location.replace("crm_gym/public/quick_search/");
                }
            }); 
        }
        else{            
            $.ajax({
                type: 'GET',
                url: '{{ URL::to('/create_new_turn/') }}' + '/' + amount,
                dataType: 'json',
                success: function(d) {
                    if(d.success == true){alert("Turno creado");}
                    else{                                   
                        alert(d.errors);
                    }
                    window.location.replace('crm_gym/public/quick_search/');
                }
            }); 
        }     
    }); 

    setInterval( function () {
        $.ajax({
            type: 'GET',
            url: '{{ URL::to('/check_notifications') }}',
            dataType: 'json',
            success: function(d) {
                if(d.success == true){                     
                    if(d.notification.type == 1){
                        $("#assistance_photo").html("<img src='img/"+d.notification.member_id+".jpg' class='img-thumbnail' alt='Foto del socio' width='150' height='200'>");
                        $("#assistance_full_name_member").html(d.notification.member_name);
                        $("#assistance_membership").html(d.notification.membership_name);
                        $("#assistance_member_sice").html(d.notification.member_since);
                        $("#assistance_validity").html(d.notification.membership_end_period);
                        $("#assistance_note").html(d.notification.last_note);
            			$("#assistance_photo").load();
            			$("#assistance_full_name_member").load();
                        $("#modal-assistance").load();
                        $("#modal-assistance").modal();
                    }
                    else if (d.notification.type == 0){
                        $("#no_assistance_photo").html("<img src='img/"+d.notification.member_id+".jpg' class='img-thumbnail' alt='Foto del socio' width='150' height='200'>");
                        $("#no_assistance_full_name_member").html(d.notification.member_name);
                        $("#modal-no-assistance").load();
                        $("#modal-no-assistance").modal();
                    }               
                }else{           
                }
            }
        });                  
    }, 1000 );                       
});
</script>

</body>
</html>