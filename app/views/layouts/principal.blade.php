<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    @yield('title')
    <meta name="description" content="">
    @section('scripts')
       @include('layouts/inc/head_common')
       @include('layouts/inc/footer_common')
    @show
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!-->
  <body>
  <!--<![endif]-->
    <!--Boton para dispositivos pequeños-->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-th-list"></span>
          </button>
          <a class="navbar-brand" href="#">Garden Central</a>
        </div>
        <!--Menu oculto para dispositivos moviles -->
      <div class="hidden-xs">
          <ul class="nav navbar-nav pull-right menu-sm">
              <li id="fat-menu" class="dropdown">
                  <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                      @yield('username')
                      <i class="icon-caret-down"></i>
                  </a>

                  <ul class="dropdown-menu">
                      <li class="divider"></li>
                        <li><a href="#cambiarpass" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span> Cambiar Contraseña</a></li>
                      <li class="divider"></li>
                        <li><a class="log-out" href="/logout"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
                      <li class="divider"></li>
                  </ul>
              </li>

          </ul>
      </div><!--/.navbar-collapse -->
</div>

</div>

@section('menu_users')
  <!-- Menu unicamente visible para dispositivos moviles, view usuarios -->
    <div class="navbar-collapse collapse">
        <div id="main-menu">
            <div id="phone-navigation" class="visible-xs">
                <ul id="dashboard-menu" class="nav nav-list">
                    <li>
                      <a href="#cambiarpass" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span> <span class="caption">Cambiar Contraseña</span></a>
                    </li>
                    <li>
                      <a href="/logout"><span class="glyphicon glyphicon-off"></span> <span class="caption">Cerrar Sesión</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@show

@section('menu')
  <!-- Menu unicamente visible para dispositivos moviles, view admin -->
    <div class="navbar-collapse collapse">
        <div id="main-menu">
            <div id="phone-navigation" class="visible-xs">
                <ul id="dashboard-menu" class="nav nav-list">

                    <li class="active "><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="admin"><span class="glyphicon glyphicon-home"></span> <span class="caption">Administración</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Reports" href="reports.html"><span class="glyphicon glyphicon-stats"></span> <span class="caption">Reportes</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="components.html"><span class="glyphicon glyphicon-briefcase"></span> <span class="caption">Paquetes</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="pricing.html"><span class="glyphicon glyphicon-usd"></span> <span class="caption">Precios</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Media" href="users"><span class="glyphicon glyphicon-user"></span> <span class="caption">Usuarios</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog" href="blog.html"><span class="glyphicon glyphicon-envelope"></span> <span class="caption">Mensajes</span></a></li>




                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Help" href="help.html"><span class="glyphicon glyphicon-flag"></span>Ayuda</a></li>

                    <li class=" ">
                      <a rel="tooltip" data-placement="right" data-original-title="Faq" href="#cambiarpass" data-toggle="modal"><span class="glyphicon glyphicon-lock"></span> <span class="caption">Cambiar Contraseña</span></a>
                    </li>

                    <li class=" ">
                      <a rel="tooltip" data-placement="right" data-original-title="Faq" href="logout"><span class="glyphicon glyphicon-off"></span> <span class="caption">Cerrar Sesión</span></a>
                    </li>

                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><span class="glyphicon glyphicon-ban-circle"></span> <span class="caption">Vacío</span></a></li>


                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><span class="glyphicon glyphicon-ban-circle"></span> <span class="caption">Vacío</span></a></li>



                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><span class="glyphicon glyphicon-ban-circle"></span> <span class="caption">Vacío</span></a></li>

                    <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><span class="glyphicon glyphicon-ban-circle"></span> <span class="caption">Vacío</span></a></li>


                </ul>
            </div>
            <!--  ____Menu que no sera visible en dispositivos moviles______ -->
            <ul class="nav nav-tabs hidden-xs">
                <li class="active"><a href="index.html"><span class="glyphicon glyphicon-scale"></span> <span>Administración</span></a></li>
                <li ><a href="reports.html" ><span class="glyphicon glyphicon-stats"></span> <span>Reportes</span></a></li>
                <li ><a href="components.html" ><span class="glyphicon glyphicon-briefcase"></span> <span>Paquetes</span></a></li>
                <li ><a href="pricing.html"><span class="glyphicon glyphicon-usd"></span> <span>Precios</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> Sistema <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="sign-in.html"><span>Copias de Seguridad</span></a></li>
                        <li><a href="sign-up.html"><span>Logs</span></a></li>
                        <li><a href="reset-password.html"><span>Licencia</span></a></li>
                        <li><a href="reset-password.html"><span>Acerca de...</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--____________________-->

    <!--   ___________Aside que estara oculto en dispositivos moviles ______________-->
    <div id="sidebar-nav" class="hidden-xs">

        <ul id="dashboard-menu" class="nav nav-list">

            <li class="active "><a rel="tooltip" data-placement="right" data-original-title="Dashboard" href="index.html"><i class="glyphicon glyphicon-home"></i> <span class="caption">Administración</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Reports" href="reports.html"><i class="glyphicon glyphicon-stats"></i> <span class="caption">Reportes</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="UI Features" href="components.html"><i class="glyphicon glyphicon-briefcase"></i> <span class="caption">Paquetes</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Pricing" href="pricing.html"><i class="glyphicon glyphicon-usd"></i> <span class="caption">Precios</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Media" href=""><i class="glyphicon glyphicon-user"></i> <span class="caption">Usuarios</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Blog" href="blog.html"><i class="glyphicon glyphicon-envelope"></i> <span class="caption">Mensajes</span></a></li>



            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Help" href="help.html"><i class="glyphicon glyphicon-flag"></i> <span class="caption">Ayuda</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Faq" href="faq.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Calendar" href="calendar.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Forms" href="forms.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>


            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Tables" href="tables.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>



            <li class=" theme-mobile-hack"><a rel="tooltip" data-placement="right" data-original-title="Mobile" href="mobile.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>

            <li class=" "><a rel="tooltip" data-placement="right" data-original-title="Icons" href="icons.html"><i class="glyphicon glyphicon-ban-circle"></i> <span class="caption">Vacío</span></a></li>


        </ul>
    </div>
    <!--_________________________-->
@show


 @yield('content')

   <footer>
      <hr>
      <p>
          &copy; Copyright: Todos los derechos reservados. Garden Central
      </p>
   </footer>





  <!-- Modal II  para confirmar cambio de contraseña -->
<!--  <div id="confirmarpass" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-danger">Confirmar</h4>
      </div>
      <div class="modal-body">
        <p class="text-primary">¿Esta seguro que desea cambiar su contraseña?</p>
      <span class="label label-danger esta center"></span>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <a href="javascript:compararPasswords();" class="btn btn-primary">Guardar</a>
      </div>
    </div>
  </div>
</div> -->






    <script type="text/javascript">
        $("[rel=tooltip]").tooltip({animation:false});
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>



  </body>
</html>
