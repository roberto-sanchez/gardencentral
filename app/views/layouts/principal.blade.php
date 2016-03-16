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
    <script>
        $(document).ready(function(){
          $("#acordeon h3").click(function(){
          $("#acordeon ul ul").slideUp();
                if(!$(this).next().is(":visible")){
                  $(this).next().slideDown();
                }
          })
      });
    </script>
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
                      @section('pedidos_user')
                        <li class="divider"></li>
                        <li><a id="p_cliente" href="#pedidos" data-toggle="modal"><span class="glyphicon glyphicon-shopping-cart"></span> Pedidos</a></li>
                      @show
                      <li class="divider"></li>
                      @if(Auth::user()->rol_id == 1)
                        <li><a class="logout"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
                      @else
                        <li><a href="/logout"><span class="glyphicon glyphicon-off"></span> Cerrar Sesión</a></li>
                      @endif
                      <li class="divider"></li>
                  </ul>
              </li>

          </ul>
        @if(Auth::user()->rol_id == 3)
          <div class="alerts-msjs">
            <div class="m-alert">
              <div class="num-a"></div>
              <div class="msj-alerts">
                Alertas
              </div>
            </div>
          </div>
           @else
         @endif
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
                    @section('pedidos_user')
                      <li>
                        <a id="p_cliente" href="#pedidos" data-toggle="modal"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="caption">Pedidos</span></a>
                      </li>
                    @show
                    <li>
                      <a href="/logout"><span class="logout glyphicon glyphicon-off"></span> <span class="caption">Cerrar Sesión</span></a>
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
        </div>
    </div>
    <!--____________________-->

    <!--   ___________Aside que estara oculto en dispositivos moviles ______________-->
    <div id="sidebar-nav" class="hidden-xs">

      <div id="acordeon">
    <ul>
        <li class="admin">
            <h3 class="t-admin"><span class="glyphicon glyphicon-home"></span><a class="dash" id="dashboard" href="{{ URL::to('admin') }}">Dashboard</a></h3>
        </li>
        <!-- we will keep this LI open by default -->
        <li class="catalogos">
            <h3 class="t-catalogos"><span class="glyphicon glyphicon-folder-open"></span>Catalogos</h3>
            <ul class="ScrollY">
                <li><a href="{{ URL::to('/catalogo/Almacen') }}">Almacen</a></li>
                <li><a href="{{ URL::to('/catalogo/Cliente') }}">Clientes</a></li>
                <li><a href="{{ URL::to('/catalogo/Comercializador') }}">Comercializador</a></li>
               <!-- <li><a href="{{ URL::to('/catalogo/Contacto') }}">Contacto</a></li>-->
                <li><a href="{{ URL::to('/catalogo/Descuentos') }}">Descuentos</a></li>
                <li><a href="{{ URL::to('/catalogo/Estados') }}">Estados</a></li>
                <li><a href="{{ URL::to('/catalogo/Familias') }}">Familias</a></li>
                <li><a href="{{ URL::to('/catalogo/FormaPago') }}">Formas de pago</a></li>
                <li><a href="{{ URL::to('/catalogo/Importador') }}">Importador</a></li>
                <li><a href="{{ URL::to('/catalogo/Mensajeria') }}">Mensajeria</a></li>
                <li><a href="{{ URL::to('/catalogo/Municipios') }}">Municipio</a></li>
                <li><a href="{{ URL::to('/catalogo/NivelDescuento') }}">Nivel de descuento</a></li>
                <li><a href="{{ URL::to('/catalogo/Pais') }}">País</a></li>
                <!--<li><a href="{{ URL::to('/catalogo/Precio') }}">Precio</a></li>-->
                <li><a href="{{ URL::to('/catalogo/Producto') }}">Producto</a></li>
                <li><a href="{{ URL::to('/catalogo/Proveedor') }}">Proveedor</a></li>
                <li><a href="{{ URL::to('/catalogo/Rol') }}">Rol</a></li>
                <li><a href="{{ URL::to('/catalogo/UnidadMedida') }}">Unidad medida</a></li>
                <li><a href="{{ URL::to('/catalogo/Usuario') }}">Usuario</a></li>
            </ul>
        </li>
        <li class="pedidos">
            <h3 class="t-pedidos"><span class="glyphicon glyphicon-search"></span>Consultas</h3>
            <ul>
                <li><a href="{{ URL::to('/consultas/pedidos') }}">Pedidos</a></li>
            </ul>
        </li>
        <li class="paginas">
           <h3 class="t-paginas"><span class="glyphicon glyphicon-duplicate"></span>Paginas</h3>
            <ul>
                <li><a href="{{ URL::to('/paginas/agregarpagina') }}">Términos y condiciones</a></li>
                <li><a href="{{ URL::to('/notas/notas') }}">Notas</a></li>
            </ul>
        </li>
        <li>
            <h3><span class="glyphicon glyphicon-random"></span>Movimientos</h3>
            <ul>
                <li><a href="#">Enlace 2</a></li>
                <li><a href="#">Enlace 4</a></li>
            </ul>
        </li>
        <li class="addentrada">
            <h3 class="t-addentrada"><span class="glyphicon glyphicon-folder-close"></span>Entradas</h3>
            <ul>
                <li><a href="{{ URL::to('/entradas/agregar') }}">Nueva entrada</a></li>
            </ul>
        </li>
       <!--  <li>
            <h3><span class="glyphicon glyphicon-level-up"></span>Salidas</h3>
            <ul>
                <li><a href="#">Enlace 2</a></li>
                <li><a href="#">Enlace 4</a></li>
            </ul>
        </li>-->
        <li class="inventario">
           <h3 class="t-inventario"><span class="glyphicon glyphicon-list-alt"></span>Inventario</h3>
           <ul>
               <li><a href="{{ URL::to('/consultas/inventario') }}">Consultas</a></li>
           </ul>
       </li>
    </ul>
  </div>
    </div>
    <!--_________________________-->
@show


 @yield('content')

   <footer>
      <hr>
      <p>
          &copy; Copyright: Todos los derechos reservados. Garden Central. 
          @if(Auth::user()->rol_id == 1)
            <a id="terminos_c" target="_blank" href="{{ URL::to('/productos/terminosycondiciones') }}">Términos y condiciones.</a>
          @else
          @endif

      </p>
   </footer>

   <!-- Modal para cambiar la contraseña -->
   <div id="cambiarpass" class="modal fade">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h2 class="modal-title text-danger"><span class="glyphicon glyphicon-lock"></span> Cambia tu contraseña</h2>
               </div>
               <div class="modal-body modal-c-pass">
                   {{ Form::open(array('url' => 'users/cambiarpass')) }}
                  <h4 class="text-info">Contraseña Actual</h4>
                  <div class=" form-group">
                     {{ Form::password('password0', array('class' => 'form-control', 'placeholder' => 'Contraseña actual', 'required')) }}
                   </div>
                   <h4 class="text-info">Nueva Contraseña</h4>
                   <div class=" form-group">
                     {{ Form::password('password1', array('class' => 'form-control', 'placeholder' => 'Nueva contraseña', 'required')) }}
                   </div>
                   <div class=" form-group">
                     {{ Form::password('password2', array('class' => 'form-control', 'placeholder' => 'Repetir la nueva contraseña', 'required')) }}
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                   {{ Form::submit('Guardar', array('class' => 'btn btn-primary', 'id' => 'registrar')) }}

                 {{ Form::close() }}
               </div>
           </div>
       </div>
   </div>

  <!--Modal para listar los pedidos del usuario-->
    <div id="pedidos" class=" modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header header-detalle">
            <button type="button" class="close close-mp" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center txt-p"><span class="glyphicon glyphicon-shopping-cart"></span> Pedidos</h2>
          </div>
          <div class="modal-body body-d-cli">
          <h2 class="t-p-clientes"></h2>
            <div class="pedidosCliente">
                <div class="table-pd">
                  <table id="list_p_" class="table table-striped table-hover">
                    <thead class="thead-pedido">
                      <tr>
                        <th>N° pedido</th>
                        <th>Fecha de registro</th>
                        <th>Forma de pago</th>
                        <th>Estatus</th>
                      </tr>
                    </thead>
                 </table>
               </div>
            </div>
          </div>
          <div class="modal-footer modal-conf-estat">

              <span id="con-pd" class="sa-p c-p-cli btn btn-primary" data-dismiss="modal" >
                <span class="glyphicon glyphicon-chevron-left"></span>
                 Cerrar
              </span>
          </div>
        </div>
      </div>
    </div>

     <!--Modal detalle del pedido del cliente-->
    <div id="detallepedidocliente" class=" modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog m-detalle">
        <div class="modal-content content-p">
          <div class="modal-header header-detalle">
            <button type="button" class="close close-mp" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h2 class="modal-title text-center n-pedd"></h2>
           <h2 class="modal-title text-center n-peee"></h2>
          </div>
          <div class="modal-body content-datos">
            <div class="cont-btn">
               <span class="btnmenu-pedido btn">
              <span class="glyphicon glyphicon-th-list"></span>
               </span>
            </div>
            <div class="d-detallep">
       <div class="content-navp">
        <ol class="breadcrumb navegacion-p">
          <li><a class="enlace-active" id="det-p" href="#">Pedido</a></li>
          <li><a id="fotop" href="#">Domicilio</a></li>
          <a title="Imprimir pedido" class="im-pedido" target="_blank" href="">Imprimir</a>
         </ol>
       </div>
            <div class="table-detail">
              <table class="table table-striped table-hover detail-t">
                <thead>
                  <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Iva</th>
                    <th>Cantidad</th>
                  <!--  <th>Pedimento</th>-->
                    <th>Foto</th>
                    <th>Total producto</th>
                  </tr>
                </thead>
                <tbody id="detail-dp">

                </tbody>
             </table>
             
             <div class="cont-dt">
               <table class="table-striped table-condensed table-hover total-pedido de-t" >
                  <tr>
                    <td id="subtotalp">
                      <span class="text-info">Subtotal:  </span>
                    </td>
                    <td id="totalp">
                      <span class="sub-p"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Iva: </span>
                    </td>
                    <td>
                       <span class="sub-iva"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Total:  </span>
                    </td>
                    <td>
                      <span class="total-p">
                    </td>
                  </tr>
                </table>
             </div>
              
      <div class="content-ped">      

        <div class="div_p_d">
          <h2 class="text-center text-info txt-ped-d">Pedimentos</h2>
          <table class="table table-striped table-condensed table-hover table-bordered table-detalle">
           <thead>
             <tr>
               <th>Producto</th>
               <th>Pedimento</th>
               <th>Cantidad</th>
             </tr>
           </thead>
            <tbody id="body-ped"></tbody>
          </table>
        </div>
      </div>

           </div>


           <div class="table-cli">
              <table class="table cliente-pedido">
                <tbody id="cli-dpedido" class="cli-pedidod">
                  <tr id="sindomi">
                  <td>RFC: <span class="c_rfc"></span> <span class="cir">• </span>Nombre: <span class="c_nombre"></span> <span class="cir">• </span>Correo: <span class="c_correo"></span> <span class="cir">• </span>N° cliente: <span class="c_numero"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>País: <span class="c_pais"> </span><span class="cir">• </span>Estado: <span class="c_estado"></span> <span class="cir">• </span>Municipio: <span class="c_municipio"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>Calle 1: <span class="c_calle1"></span> <span class="cir">• </span>Calle 2: <span class="c_calle2"></span> <span class="cir">• </span>Colonia: <span class="c_colonia"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>Delegacion: <span class="c_delegacion"></span> <span class="cir">• </span>CP: <span class="c_cp"></span> <span class="cir">• </span>Teléfono: <span class="c_telefono"></span></td>
                </tr>
                <tr class="pc_domiclio onservaciones">
                  <td>
                    <div class="ob">Observaciones: <span class="c_observaciones"></span> </div>

                  </td>
                </tr>
                </tbody>
             </table>
           </div>
            </div>
          </div>
          <div class="modal-footer modal-conf-estat">

              <span id="con-pd" class="sa-p btn btn-primary" data-dismiss="modal" >
                <span class="glyphicon glyphicon-chevron-left"></span>
                 Cerrar
              </span>
          </div>
        </div>
      </div>
    </div>

            <!--Modal para ver la foto del pedido-->
    <div id="verfotop" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content c-fotope">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title title-f text-info text-center">
            <span class="glyphicon glyphicon-picture"></span>

             </h4>
          </div>
          <div class="modal-body m-foto">
            <div class="v-foto">
                <img class="f-p-p" alt="Foto del producto">
            </div>
          </div>
          <div class="modal-footer f-foto modal-confirmar">

          </div>
        </div>
      </div>
    </div>

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
