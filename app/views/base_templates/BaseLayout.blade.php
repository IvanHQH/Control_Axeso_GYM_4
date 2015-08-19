<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'axeso')</title>
    
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
                <a class="navbar-brand" href="index.html">Control de Accesos</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil de usuario</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuraci&oacuate;n</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesi�n</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->    
            <div class="navbar-default sidebar" role="navigation">               
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <!--a href="/"><i class="fa fa-align-justify fa-fw"></i></a-->                           
                        </li>                        
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="quick_search"><i class="fa fa-user fa-fw"></i> Busqueda r&aacute;pida</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Socios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="members_list">Listado</a>
                                </li>                        
                                <li>
                                    <a href="active_memberships">Membres&iacute;as activas</a>
                                </li>
                                <li>
                                    <a href="inactive_memberships">Membres&iacute;as inactivas</a>
                                </li>                                
                                <li>
                                    <a href="expiring_memberships">Membres&iacute;as a punto de expirar</a>
                                </li>                                  
                            </ul>
                            <!-- /.nav-members-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-alt fa-fw"></i> Membres&iacute;as<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="membership_types_list">Listado</a>
                                </li>
                                <li>
                                    <a href="available_memberships_types">Tipos Disponibles</a>
                                </li>
                                <li>
                                    <a href="unavailable_memberships_types">Tipos No Disponibles</a>
                                </li>                            
                                <li>
                                    <a href="memberships_paymets">Pagos</a>
                                </li>                                 
                            </ul>
                            <!-- /.nav-memberships-level -->
                        </li>    
                        <li>
                            <a href="#"><i class="fa fa-ticket fa-fw"></i> Visitas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="visitors_list">Listado</a>
                                </li>                               
                            </ul>
                            <!-- /.nav-memberships-level -->
                        </li>        
                        <li>
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> Caja<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="incomes">Ingresos</a>
                                </li>                               
                                <li>
                                    <a href="outcomes">Egresos</a>
                                </li>                                                         
                                <li>
                                    <a href="turner_cash">Cortes</a>
                                </li>                      
                                <li>
                                    <a href="settings_turner_cash">Ajustes</a>
                                </li>                                                      
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
$(document).ready(
    /*function checkNotifications()
    {

        $.ajax({
                async: false,
                type: 'get',
                url: '{{ URL::to('/check_notifications_axeso') }}',
                dataType: 'json',
                success: function(data){
                    alert("Bienvenido "+ data.first_name+'!!!');
                }
            });
           setInterval(checkNotifications, 3000);
    }*/
);
</script>

</body>
</html>