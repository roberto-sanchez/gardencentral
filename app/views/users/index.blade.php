@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
{{ HTML::style('css/select2.min.css') }}
{{ HTML::style('css/bootstrap-select.min.css') }}
{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
{{ HTML::script('js/i18n/defaults-es_CL.min.js') }}
<style>

/*.glyphicon{
  position:static;
}

.btn-group{
  position:static;
}*/

  .t-extra{
    display:none;
  }
  
  .notas_a{
    width:70%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack:start;
  -webkit-justify-content:flex-start;
      -ms-flex-pack:start;
          justify-content:flex-start;
  }


  .l_vaciar{
    cursor:pointer;
  }

.dialog-ped-cli{
  width:50%;
}

.totales-p-dclie{
  padding:0 .5em .5em .5em;
  max-height:515px;
  overflow-y: scroll;
}

  #list_p_ {
        margin-bottom:0;
      }

      #list_p_ tbody tr{
        text-align: center;
        font-size:.8em;
      }

       ul.fancy li a, #list_p__info{
        font-size:.9em;
      }

  #con-pd-cli{
    width:100px;
  }

  /*---Fila de los extras--*/
  .fila_extras, .fila_total{
    display:none;
  }

  .c-carga{
    display:none;
  }


  #env_p{
    background:rgba(0, 0, 0, 0.7);
  }
  
  .img-gif{
    width:100%;
    margin:0 auto;
    text-align:center;
    margin-top:5em;
  }



</style>
@stop

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('menu_users')
  @parent
@stop

@section('menu')

@stop

@section('content')
<div class="users">
  <section class="container">
     @include('layouts/inc/estatus')
     <div class="notifications bottom-right" data-html="true"></div>
  
      <button class="btn btn-primary" id="mostar-modal-catalogo">Ver Catalogo</button>

      <div class="buscador">
         {{ Form::open(['id'=>'searchForm','method' => 'POST', 'class' => 'buscador input-group has-feedback']) }}

        {{ Form::text('input','Clave del producto',array('class' => 'form-control', 'id' => 'clave')) }}

             <button id="btn_search" type="submit" class="btn buscar input-group-addon">
                  Buscar
                  <span class="glyphicon glyphicon-search"></span>
            </button>

      {{ Form::close() }}
      </div>


     <!--   <div id="productoPanel" class="panel" style="display:none;"> -->
        <div id="productoPanel" class="panel">
            <div class="panel-heading">
              <h1 class="text-center text-primary rbusqueda">Resultados de la busqueda</h1>
              <h2 id="nombreProd" data-clave="" data-id="" data-tipo="" class="text-center text-info"></h2>
            </div>
            <div class="panel-body panel-producto">

                  <img id="imagenProd" src="" data-foto="" alt="Imagen del producto" class="imagenproducto img-responsive img-circle" />

                <div class="datos">
                   <h2 class="text-center text-primary txt-info">
                     Color: <span id="colorProd" class="text-info"></span>
                     <hr class="separador">
                     Precio: <span id="precioProd" class="text-info"></span>
                     <hr class="separador">
                     <span id="descPrecio" data-precio="" class="text-info"></span>
                     Iva: <span id="t_iva_" data-iva="" class="text-info"></span>
                     <hr class="separador">
                     Productos disponibles: <span id="dispoProd" class="text-info"></span>
                 <!--    <hr class="separador">
                     Piezas por paquete: <span id="piezasProd" class="text-info"></span>-->
                   </h2>
                 <!--  <buttom id="idProd" value="" class="btn btn-primary add-car">Añadir al carrito.</buttom> -->
                </div>

          </div>

          <div class="panel-footer footer-producto">
            <div class="agregar-producto input-group has-feedback" title="Ingrese la cantidad de paquetes">

               <input type="number" class="form-control idProd" id="agregarproducto" min="1" placeholder="Cantidad" title="Ingrese la cantidad">
              <span class="ingresar-p">
                <a id="enviar-producto" class="btn input-group-addon" id="" title="Ingrese la cantidad de paquetes">
                  Agregar
                   <span class="glyphicon glyphicon-plus"></span>
                </a>
              </span>
            </div>

          </div>

        </div>
      

    <div id="t-pedidoc">
      <div class="panel panel-datos">
          <div class="panel-heading panelcarrito">
              <h2>
                <span class=" glyphicon glyphicon-shopping-cart"></span>
                Pedido
              </h2>
                <span id="v-pedido" class="btn btn-danger">
                  Vaciar pedido
                  <span class="glyphicon glyphicon-trash"></span>
                </span>
          </div>
          <div class="panel-body bodycarrito">

              <!--Tabla oculta para dispositivos moviles-->
            <div class="table-responsive table-carrito">
              <table class="table table-hover tcarrito tcarrido-productos">
                <thead>
                  <tr id="c-ped" class="cabecerapedido">
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Iva</th>
                    <th>Cantidad</th>
                    <th>Foto</th>
                    <th>Total producto</th>
                    <th>Quitar</th>
                  </tr>
                </thead>
                <tbody id="nEntrada"></tbody>
              </table>
              <table class=" table-striped table-condensed table-hover  total-pedido">
                  <tr>
                    <td id="subtotalp">
                      <span class="text-info">Subtotal:  </span>
                    </td>
                    <td id="totalp-d-d" value="0"></td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Iva: </span>
                    </td>
                    <td id="t_t_iva" value="0"></td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Total:  </span>
                    </td>
                    <td id="total_mas_iva" class="total-ped" data-pedido="">

                    </td>
                  </tr>
                </table>

            
                <div class="notas_a">
                    <div class="alert alert-desc">
                    <strong>Descuento incluido.</strong>
                  </div>
                </div>
    

              </div> <!-- END table responsive -->


            </div>
        
            <div class="agregar-ex">
              <button class="btn btn-primary btn-md" id="add-extras">Agregar extras</button>
              <span data-id="0" id="add-extras-s"></span>
              <table class="table t-ext">
                <thead class="thead-ext">
                  <tr>
                    <th>Clave</th>
                    <th>Producto</th>
                    <th>Editar</th>
                    <th>Quitar</th>
                  </tr>
                </thead>
                <tbody id="b-extra"></tbody>
              </table>
            </div>

    
              <div class="tipoEnvio">
                <!--Lista de notas aclaratorias-->
                <div class="list-n"></div>
                <div class="select-tipo">
                  <h3 class="text-info text-cotizar">Cotizar Envío.</h3>
                  <select class="selectpicker selectTipo btn btn-default form-control ">
                      <option value="nada" disabled selected>-- Seleccione --</option>
                      <option class="tienda" value="tienda">Recoger en tienda</option>
                      <option value="domicilio">Enviar a domicilio</option>
                  </select>
                  <h5 class="text-info txt-costos">Aplican costos adicionales</h5>
                </div>
              </div>
              <input id="inpEnvio" type="text">
               <!-- <button class="presioname">Presioname</button>-->
          </div>

            <div class="panel-elegir">
              
              <div class="alert alert-info alert-v alert-pago">
                <strong>Elige un domiclio.!</strong>
              </div>

              <div class="input-group infopago">
                 <select id="formapago" class="selectpicker btn btn-info form-control formapago" name="formapago" data-style="btn-primary">
                     <option value="" disabled selected>Elige la forma de pago</option>
                   @foreach($pago as $pagos)
                     <option id="text_{{ $pagos->id }}" value="{{ $pagos->id }}">{{ $pagos->descripcion }}</option>
                   @endforeach
                 </select>
              </div>
            </div>
           <div class="div-generar-pedido">
             <span id="g-tipo" data-toggle="modal" class="g-tipo btn btn-success">
              Generar pedido
            </span>
           </div>


        <section class="selecTipoEnvio">
              <div class="panel-footer footer-total">
                <div class="d-entrega">
                  <label>
                    <div class="radio">
                      <input type="checkbox" name="domentrega" id="checkdomicilio">
                        <label for="checkdomicilio" class="domicilio">
                            <span class="text-primary">Domicilio de entrega</span>
                        </label>
                    </div>
                  </label>
                </div>
             </div> <!--Panel footer-->
             </section><!--selecTipoEnvio-->
        </div>  <!--Panel productos-->
      </div>


      <!-- Modal cuando se procesa el pedido -->
            <div id="env_p" class="modal fade" data-keyboard="false" data-backdrop="static">
              <div class="modal-dialog">
                <div class="img-gif">
                  <img class="img-proce" src="img/Cargandocc.gif" width="200px">
                  <h1 class="text-info text-center txt-pro">Procesando pedido..</h1>
                </div>
                <div class="modal-content c-carga">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                  </div>
                </div>
              </div>
            </div>



        <!--  Modal para ver los productos-->
<div id="modal-catalogo-productos" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-productos">
        <div class="modal-content content-productos">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">Catalogo de productos</h4>
          </div>
          <div class="modal-body">
          
          <div class="header-productos">
            <div>
              <label for="select-producto-categoria" class="text-info">Categorías:</label>
              <select id="select-producto-categoria" class="form-control"></select>
            </div>
          </div>

          <div class="body-productos">
           <div class="img-espera">
             <img src="/img/cargando.gif" alt="Espere un momento.." >
           </div>
           <div class="div-seleccione-categoria">
             <h2 class="text-info">Seleccione una categoría.</h2>
           </div>
           <div class="div-nohay-categoria">
             <h2 class="text-info">Actualmente no hay productos en la categoria seleccionada.</h2>
           </div>

          <table class="table-datos-producto">
           <tbody class="contenedor-productos"></tbody>
          </table>
          </div>
                
          </div>
          <div class="footer-catalogo-productos">
              <button id="salir-catalogo-p" type="button" class="btn btn-primary confirm-pro-s" data-dismiss="modal">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Salir
              </button>
              <button id="agregar-del-catalogo" class="btn btn-success confirm-pro">Agregar al pedido</button>
          </div>
        </div>
      </div>
    </div>

<!-- Modal detalle del producto  -->
    <div id="modaldetalleproducto" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-detalle-pro">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <h4 id="to-ped" class="modal-title text-info text-center">Detalle del producto</h4>
          </div>
          <div class="modal-body body-detalle-pro">
            <div class="cont-img">
              <img id="img-detalle-p" src="/img/productos/Bebederoparapajaros.png" alt="Imagen del producto">
            </div>
            <div class="datos-detalle-pro">

            </div>      
          </div>
          <div class="modal-footer modal-conf-estat">
              <button id="cerrar-detalle-pro" class="btn btn-primary confirm" data-dismiss="modal">
                <span class="glyphicon glyphicon-chevron-left"></span>
              Salir
              </button>
          </div>
        </div>
      </div>
    </div>


          <!--Modal para agregar extras-->
        <div id="modalextras" class="modal fade" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-primary text-center">
                  <span class="glyphicon glyphicon-plus"></span>
                  Agregar extras
                </h4>
              </div>
              <div class="modal-body body-extras">
                <div class="area-nota error-c">
                  <label class="text-info label-ext">Extras: </label>
                  <textarea id="txt-extra" class="form-control" rows="5"></textarea>
                  <span class="icon-c"></span>
                </div>
              </div>
              <div class="modal-footer modal-confirmar">
                <button id="can-extras" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
                <span id="env-extras" class="btn btn-primary confirm" data-dismiss="modal">Agregar</span>
              </div>
            </div>
          </div>
        </div>


  <!--Modal para editar extras-->
        <div id="modalextraedit" class="modal fade" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-primary text-center">
                  <span class="glyphicon glyphicon-edit"></span>
                  Editar extras
                </h4>
              </div>
              <div class="modal-body body-extras">
                <label class="text-info label-ext">Extras: </label>
                  <div class="area-extra">
                  <textarea id="txt-extra-edit" class="txta-edit form-control" rows="5"></textarea>
                  <span class="icon-area"></span>
                </div>
              </div>
              <div class="modal-footer modal-confirmar">
                <button id="can-extras-edit" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
                <span id="env-extras-actualizar" class="btn btn-primary confirm" data-dismiss="modal">Actualizar</span>
              </div>
            </div>
          </div>
        </div>

        <!--Modal para ver la foto del producto-->
  <div id="verfoto-p" class="modal fade">
      <div class="modal-dialog p-fotop">
          <div class="modal-content content-f">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h2 class="modal-title text-primary text-center title-fp">
                  <span class="glyphicon glyphicon-picture "></span>
                    Foto del producto</h2>
              </div>
              <div class="modal-body body-foto">

                  <div class="fp-foto">
                    <img id="fotopro" class="foto-p-p" alt="Foto del producto">
                  </div>

              </div>
              <div class="modal-footer modal-rest">
                  <h4 class="text-center text-info t-foto"></h4>
              </div>
          </div>
      </div>
  </div>

       <!-- Modal para confirmar el pedido sin domicilio -->
            <div id="confirmpedido" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-danger text-center">Confirmar pedido</h4>
                  </div>
                  <div class="modal-body">
                    <h2 class="text-primary text-center t-exsts">¿Están correctos sus datos?</h2>
                  </div>
                  <div class="modal-footer modal-confirmar">
                      <button type="button" class="btn btn-danger confirm t-no-c" data-dismiss="modal">No</button>
                     <a id="p-s-dom" class="btn btn-primary confirm " data-dismiss="modal" >Si</a>
                     <span id="" class="btn btn-primary confirm regis-exixts-t" data-dismiss="modal" >Si</span>
                  </div>
                </div>
              </div>
            </div>

  <!--____Domicilio de entrega_____-->
  <div class="panel panel-entrega">

      <h2 class="text-primary m-domicilios">Mis domicilios</h2>

      <!---Domicilio para dispositivos pequeños-->
     <div class="panel panel-default p-addressxs">
        <div class="panel-body p-bxs">
           <table class="table-addressxs table-condensed">
            <tbody id="dom_cxs" class="c-addressxs">
            </tbody>
           </table>

        </div>
        <div class="panel-footer p-f">

        </div>
     </div> <!--Cerramos domicilio para dispositivos pequeños-->

      <!---Domicilio para dispositivos grandes-->
     <div class="panel panel-default p-address">
        <div class="panel-body p-b">
          <div class="table-responsive div-p-table">
           <table class="table-address table-condensed">
            <thead class="c-address">
              <tr>
                <th>Usar</th>
                <th>País</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Calle 1</th>
                <th>Calle 2</th>
                <th>Colonia</th>
                <th>Delegacion</th>
                <th>CP</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
              <tbody id="dom_c"></tbody>
           </table>
        </div>

        </div>
        <div class="panel-footer p-f">

        </div>
     </div> <!--Cerramos domicilio para dispositivos grandes-->
    <h3 class="text-primary exist-dom">Aun no tienes ningún domicilio registrado</h3>

            <div class="panel-body">
              @if(count($direcfiscal))
                 @else
                    <div class="checkbox">
                      <input type="checkbox" name="domfiscal" id="checkfiscal">
                        <label for="checkfiscal" id="iddomfiscal">
                            <span class="domentrega1 text-info">Domicilio Fiscal</span>
                        </label>
                    </div>
                @endif
                  <!--Otro domicilio-->
                    <div class="checkbox">
                      <input type="checkbox" name="dompersonal" id="checkpersonal">
                        <label for="checkpersonal" id="idotrodom" >
                            <span class="domentrega2 text-info">Otro Domicilio</span>
                        </label>
                    </div>


                 <form id="formulario_entrega" role="form" action="productos/registrarpedido" method="post">
                  <div id="domfiscal" class="domfiscal">
                      <div class="group2">
                        <div class="calle1 input-group">
                        <label class="h-xs text-info text-center">Calle 1</label>
                          <span class="input-group-addon">
                            <span class="text-info">Calle 1</span>
                          </span>
                            {{ Form::text('calle1',null, array('class' => 'form-control', 'placeholder' => 'Calle 1', 'required', 'id' => 'calle1')) }}
                        </div>
                        <div class="calle2 input-group">
                        <label class="h-xs text-info text-center">Calle 2</label>
                          <span class="input-group-addon">
                            <span class="text-info">Calle 2</span>
                          </span>
                            {{ Form::text('calle2',null, array('class' => 'form-control', 'placeholder' => 'Calle 2', 'required', 'id' => 'calle2')) }}
                        </div>
                        <div class="colonia input-group">
                        <label class="h-xs text-info text-center">Colonia</label>
                            <span class="input-group-addon">
                              <span class="text-info">Colonia</span>
                            </span>
                              {{ Form::text('colonia',null, array('class' => 'form-control', 'placeholder' => 'Colonia','required', 'id' => 'colonia')) }}
                         </div>
                      </div>
                      <div class="group3">
                         <div class="delegacion input-group">
                         <label class="h-xs text-info text-center">Delegación</label>
                          <span class="input-group-addon">
                            <span class="text-info">Delegación</span>
                          </span>
                            {{ Form::text('delegacion',null, array('class' => 'form-control', 'placeholder' => 'Delegación', 'id' => 'delegacion')) }}
                         </div>
                         <div class="cp input-group">
                         <label class="h-xs text-info text-center">CP</label>
                          <span class="input-group-addon">
                            <span class="text-info">CP</span>
                          </span>
                            {{ Form::text('cp',null, array('class' => 'form-control', 'placeholder' => 'Codigo postal','required', 'id' => 'cp')) }}
                         </div>
                         <div class="input-group ocd">
                          <span class="input-group-addon">
                          </span>
                            <input type="text" class="inp-oc">
                         </div>
                          {{ Form::text('domicilio',null, array('class' => 'd-domicilio hidden')) }}
                      </div>
                      <div class="group1">
                          <div class="pais input-group">
                          <label class="h-xs text-info text-center">País</label>
                            <span class="input-group-addon">
                              <span class="text-info">País</span>
                            </span>
                              <select class="form-control options pais" id="pais" name="pais" required></select>
                          </div>
                          <div class="estado input-group">
                          <label class="h-xs text-info text-center">Estado</label>
                            <span class="input-group-addon">
                              <span class="text-info">Estado</span>
                            </span>
                              <select  class="form-control options" id="estado" name="estado" required>
                                  <option value="">Debe seleccionar un país</option>
                              </select>
                          </div>
                          <div class="municipio input-group">
                          <label class="h-xs text-info text-center">Municipio</label>
                            <span class="input-group-addon">
                              <span class="text-info">Municipio</span>
                            </span>
                              <select  class="form-control" id="municipio"  name="municipio" required>
                                <option value="">Debe seleccionar un estado</option>
                              </select>
                          </div>
                      </div>

                      <!--Tabla para mostrar los telefonos del cliente-->
                      <h2 class="text-primary text-oculto">Mis teléfonos disponibles</h2>
                        <div class="t-oculto">
                          <table class="table table-striped table-condensed table-hover table-tel">
                            <thead class="cb">
                              <th>Numero</th>
                              <th>Tipo</th>
                              <th>Usar</th>
                            </thead>
                            <tbody id="list-tel">

                            </tbody>
                          </table>
                        </div>
                          <label class=" text-info telclienteotro">Agregar otro teléfono</label>

                      <label class=" text-info telcliente">Teléfono</label> <!--Este se oculta en caso de que aiga telefonos disponibles del cliente-->


                        <div class="group4 otrotel-c">
                          <div class="c-telcel">
                            <div class="t1 tel1 input-group">
                            <label class="h-xs text-info text-center">Celular</label>
                              <span class="input-group-addon">
                                <span class="text-info">Celular</span>
                              </span>
                                {{ Form::text('tel',null, array('class' => 'form-control tel-celular phone-c requerido', 'placeholder' => 'Teléfono celular', 'data-id' => 'idtel' , 'id' => 'tel1', 'required', 'onkeyup' => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')")) }}
                             </div>
                              {{ Form::text('tipo',null, array('class' => 'hidden t-tipo')) }}
                               <span class="text-danger msgTelcel"></span>
                          </div>
                          <div class="c-fijo">
                           <div class="tel2 input-group">
                           <label class="h-xs text-info text-center">Fijo</label>
                            <span class="input-group-addon">
                              <span class="text-info">Fijo</span>
                            </span>
                              {{ Form::text('tel',null, array('class' => 'form-control tel-fijo phone-f t2', 'placeholder' => 'Teléfono fijo', 'id' => 'tel-2', 'required', 'onkeyup' => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" )) }}
                           </div>
                           <span class="text-danger msgTelfijo"></span>
                          </div>

                          <div class="c-otro">
                           <span id="add-tel">Otro ></span>

                           <div class="tel3 input-group t-otro">
                           <label class="h-xs text-info text-center">Otro</label>
                            <span class="input-group-addon">
                              <span class="text-info">Otro</span>
                            </span>
                              {{ Form::text('tel',null, array('class' => 'form-control tel-otro phone-o t3', 'placeholder' => 'Otro teléfono', 'id' => 'tel-3', 'onkeyup' => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')")) }}
                           </div>
                            <span class="text-danger msgTelotro"></span>
                          </div>
                         </div>


                        <div class="text-coment">
                          <label class=" text-info">Comentarios</label>
                          <textarea name="comentarios" id="coment" class="form-control" rows="3"></textarea>
                        </div>

                        {{ Form::text('tel',null, array('class' => 'f-p hidden', 'id'=>'formapago')) }}
                        {{ Form::text('forma',null, array('class' => 'f-t hidden', 'id'=>'pago')) }}
                      <!--<div class="group5">
                       <div id="tel_2" >
                           <a class="bt_plus" id="1" >Otro teléfono ></a>
                        </div>

                      </div> -->

                   </div>


            <div class="panel-footer footer-formpago">
            <span id="conf-p1" class="btn btn-success btn-conf-1 disabled"> <!--   -->
              Generar pedido
            </span>
            <span id="gen-c"  class="btn btn-success">
              Generar pedido
            </span>
            <a id="conf-p" href="#confirmarpedido" class="btn btn-success hidden ge-p" data-toggle="modal"> <!--   -->
              Generar pedido
            </a>




            <!-- Modal para eliminar el domicilio -->
            <div id="confirm-delete" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-danger text-center">Eliminar domicilio</h4>
                  </div>
                  <div class="modal-body">
                    <h2 class="text-primary text-center text-elim">¿Está seguro que desea eliminar este domicilio?</h2>
                  <span class="label label-danger esta center"></span>
                  </div>
                  <div class="modal-footer modal-confirmar">
                    <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
                 <!--    <a href="{{ URL::to('productos/datosdelpedido') }}" class="btn btn-primary confirm">Si</a> -->
                  <span id="eliminar-address" data-id="" data-dismiss="modal" class="btn btn-primary confirm" > <!--   -->
                    Si
                  </span>

                  </div>
                </div>
              </div>
            </div>




              <!-- Modal para confirmar el pedido -->
            <div id="confirmarpedido" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-danger text-center">Confirmar pedido</h4>
                  </div>
                  <div class="modal-body">
                    <h2 class="text-primary text-center text-exito">¿Están correctos sus datos?</h2>
                    <h2 class="text-danger text-center text-selectdom">Seleccione un domicilio.</h2>
                  <span class="label label-danger esta center"></span>
                  </div>
                  <div class="modal-footer modal-confirmar">
                 <!--    <a href="{{ URL::to('productos/datosdelpedido') }}" class="btn btn-primary confirm">Si</a> -->
                      <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
                      <button href="#" id="regispedido" class="btn btn-primary confirm confirm-p disabled" data-dismiss="modal"> <!--   -->
                        Si
                      </button>
                      <!--boton que se activa si el cliente elige un dom existente-->
                     <a id="" class="btn btn-primary confirm confirm-d" data-dismiss="modal" >Si</a>
                     <!--boton que se activa si el cliente elige un tel existente-->
                     <span id="" class="btn btn-primary confirm regis-exixts-t" data-dismiss="modal" >Si</span>
                  </div>
                </div>
              </div>
            </div>

            <div id="confirmartel" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-danger text-center">Confirmar pedido</h4>
                  </div>
                  <div class="modal-body">
                    <h2 class="text-danger text-center text-add-tel">Seleccione o agregue un teléfono.</h2>
                  <span class="label label-danger esta center"></span>
                  </div>
                  <div class="modal-footer modal-confirmar">
                    <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
                  <button class="btn btn-primary confirm" data-dismiss="modal"> <!--   -->
                    Si
                  </button>
                  </div>
                </div>
              </div>
            </div>


              {{ Form::close() }}




            <!--Modal editar direccion-->
            <div class="modal fade" id="updateadress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content edit-direc">
                <div class="modal-header cabecera-editar">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title text-info text-center">
                     Editar domicilio
                   <span class="glyphicon glyphicon-refresh"></span>
                  </h4>
                </div>
                <div class="modal-body">

              <form action="productos/actualizar" method="post" id="formEdit">
              <div class=" input-group d-e">
                <span class="input-group-addon">
                  <span class="text-info">País</span>
                </span>
                  <select class="form-control pais" id="paisedit" name="paisedit" >
                  <option id="select-p" value="" selected></option>
                  <!--   <option id="p_edit" value=""></option> -->
                  </select>
              </div>
              <div class=" input-group d-e">
                <span class="input-group-addon">
                  <span class="text-info">Estado</span>
                </span>
                  <select  class="form-control" id="listestados" name="estadoedit">
                  <option id="select-est" value="" selected></option>

                  </select>
              </div>
              <div class=" input-group d-e">
                <span class="input-group-addon">
                  <span class="text-info">Municipio</span>
                </span>
                  <select  class="form-control" id="municipioedit"  name="municipioedit">
                    <option id="select-muni" value=""></option>
                  </select>
              </div>
                <div class=" input-group d-e calle1edit">
                  <span class="input-group-addon">
                    <span class="text-info">Calle 1</span>
                  </span>
                    {{ Form::text('calle1edit',null, array('class' => 'form-control', 'placeholder' => 'Calle 1', 'required', 'id' => 'calle1edit')) }}
                </div>
                <div class=" input-group d-e calle2edit">
                  <span class="input-group-addon">
                    <span class="text-info">Calle 2</span>
                  </span>
                    {{ Form::text('calle2edit',null, array('class' => 'form-control', 'placeholder' => 'Calle 2', 'required', 'id' => 'calle2edit')) }}
                </div>
                <div class=" input-group d-e coloniadit">
                    <span class="input-group-addon">
                      <span class="text-info">Colonia</span>
                    </span>
                      {{ Form::text('coloniaedit',null, array('class' => 'form-control', 'placeholder' => 'Colonia','required', 'id' => 'coloniadit')) }}
                 </div>
               <div class=" input-group d-e delegacionedit">
                <span class="input-group-addon">
                  <span class="text-info">Delegación</span>
                </span>
                  {{ Form::text('delegacionedit',null, array('class' => 'form-control', 'placeholder' => 'Delegación', 'id' => 'delegacionedit')) }}
               </div>
               <div class=" input-group d-e cpedit">
                <span class="input-group-addon">
                  <span class="text-info">Codigo Postal</span>
                </span>
                  {{ Form::text('cpedit',null, array('class' => 'form-control', 'placeholder' => 'Codigo postal','required', 'id' => 'cpedit')) }}
               </div>
            <!--   <div class=" input-group d-e">
                <span class="input-group-addon">
                  <span class="text-info">Teléfono</span>
                </span>
                  {{ Form::text('teledit',null, array('class' => 'form-control tel-fijo', 'placeholder' => 'Teléfono', 'id' => 'tel' )) }}
               </div> -->
               <div class=" input-group d-e teledit">
                <span class="input-group-addon">
                  <span class="text-info">Teléfono</span>
                </span>
                  {{ Form::text('telefono',null, array('class' => 'form-control', 'placeholder' => 'Teléfono', 'id' => 'teledit')) }}
               </div>
                 <span class="msgTeledit"></span>
               <div class=" input-group d-e">
                <span class="input-group-addon">
                  <span class="text-info">Tipo</span>
                </span>
                  <select  class="form-control"  name="tipoedit" id="tipoedit" required>
                    <option id="tipotel" value="" selected></option>
                    <option id="otrotel" value=""></option>
                    <option id="otrotel2" value=""></option>
                  </select>
               </div>
           <!--   <div class="input-group infopago">
               <select class="form-control" name="formapagoedit" id="formapago" required>
                   <option id="" value="" disabled selected>Forma de pago</option>
                 @foreach($pago as $pagos)
                   <option value="{{ $pagos->id }}">{{ $pagos->descripcion }}</option>
                 @endforeach
               </select>
              </div> -->
         <!--     <div class=" input-group">
                <span class="input-group-addon">
                  <span class="text-info">Tipo de domicilio</span>
                </span>
                  <select  class="form-control"  name="domicilioedit" required>
                    <option id="tipodom" value="Fiscal"></option>
                    <option id="otroodom" value="Otro"></option>
                  </select>
              </div> -->
              <input type="text" class="hidden" name="tipodom" id="t-dom" value="">
              <input id="iddom" type="hidden" name="iddom" value="">

            </div>
            <div class="modal-footer">
              <button type="button" id="cancel-u" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
             <span id="acttualizar-dom" class="btn btn-primary" data-dismiss="modal">
                Actualizar
                <span class="glyphicon glyphicon-refresh"></span>
             </span>

             </form>
            </div>
          </div>
      <!-- End Modal -->



           </div>
        </div>
      </div>
    </div>
 <!--  ___________________________________END IF_________________________________________ -->

  </section>
</div> <!-- Content users -->

{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/accounting.min.js') }}
{{ HTML::script('js/principal.js') }}
{{ HTML::script('js/list_main.js') }}
{{ HTML::script('js/main.js') }}



@stop
