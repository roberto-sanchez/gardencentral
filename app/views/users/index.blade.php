@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
{{ HTML::style('css/select2.min.css') }}
@include('layouts/inc/lib')
<style>

  #list_p__length{
    display:none;
  }
  #list_p__filter{
    float:left;
    margin:.5em 0;
  }

  .pedidosCliente{
    margin:0;
    padding:0 .5em;
  }

  .t-p-clientes{
    margin:0;
    padding:0;
  }
  #list_p_{
    margin-bottom:0;
  }

  .dataTables_paginate{
    margin-bottom:.5em;
    margin-top:.3em;
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
         <div class="buscador">
         {{ Form::open(['id'=>'searchForm','method' => 'POST', 'class' => 'buscador input-group has-feedback']) }}

        {{ Form::text('input','Clave del producto',array('class' => 'form-control', 'id' => 'clave')) }}

             <button id="btn_search" type="submit" class="btn buscar input-group-addon">
                  Buscar
                  <span class="glyphicon glyphicon-search"></span>
            </button>

      {{ Form::close() }}
      </div>

      <div class="b-exists">
        <div class='notifications top top-xs'></div>
      </div>
      <div class="ingresar-p">
            <div class='notifications t'></div>
          </div>


     <!--   <div id="productoPanel" class="panel" style="display:none;"> -->
        <div id="productoPanel" class="panel">
            <div class="panel-heading">
              <h1 class="text-center text-primary rbusqueda">Resultados de la busqueda</h1>
              <h2 id="nombreProd" class="text-center text-info"></h2>
            </div>
            <div class="panel-body panel-producto">

                  <img id="imagenProd" src="" alt="Imagen del producto" class="imagenproducto img-responsive img-circle" />

                <div class="datos">
                   <h2 class="text-center text-primary txt-info">
                     Color: <span id="colorProd" class="text-info"></span>
                     <hr class="separador">
                     Precio: <span id="precioProd" class="text-info"></span>
                     <hr class="separador">
                     Descuento: <span id="descProd" class="text-info"></span>
                     <hr class="separador">
                     Piezas por paquete: <span id="piezasProd" class="text-info"></span>
                   </h2>
                 <!--  <buttom id="idProd" value="" class="btn btn-primary add-car">Añadir al carrito.</buttom> -->
                </div>

          </div>

          <div class="panel-footer footer-producto">
            <div class="agregar-producto input-group has-feedback" title="Ingrese la cantidad de paquetes">

               {{ Form::number('agregarproducto',null,array('class' => 'form-control idProd', 'id' => 'agregarproducto', 'min' => '1', 'max' => '100', 'placeholder' => 'Nº de paquetes', 'title' => 'Ingrese la cantidad de paquetes', 'required')) }}
              <span class="ingresar-p">
                <a href="" class="btn input-group-addon claveProd btn-update-sum idProd2 disabled" id="" title="Ingrese la cantidad de paquetes">
                  Agregar
                   <span class="glyphicon glyphicon-plus"></span>
                </a>
              </span>
            </div>

          </div>

        </div>


      @if(count($cart))
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

              <!-- Tabla visible para dispositivos moviles -->
              <table class=" tcarritoxs">
              @foreach($cart as $item)
                <thead>
                  <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                     <td>Clave: {{ $item->clave }}</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Nombre: <div class="pnombre">{{ $item->nombre }}</div></td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Color: {{ $item->color }}</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Precio: ${{ number_format($item->precio_venta, 2)}}</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Iva: 16%</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Piezas paquete: {{ $item->piezas_paquete }}</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td class="td-cpa">
                        <div class="c-paxs">
                          <input type="number" data-id="p_{{ $item -> id }}" class="form-control cant_{{ $item -> id }}" min="1" max="100" value="{{ $totalp = $item->quantity }}" id="productxs_{{$item->id }}">
                          <a href="{{ URL::to('productos/update', $item->clave) }}" class="btn btn-info btn-update-pxs" id="{{ $item -> id }}" title="Actualizar la cantidad de paquetes">
                            <span class="glyphicon glyphicon-refresh"></span>
                          </a>
                        </div>
                      </td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>
                        <span class="verfotop" id="{{ $item->foto }}" data-id="{{ $item->nombre }}" alt="Foto del producto">
                          Ver Foto
                        </span>
                      </td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>Total producto: ${{ number_format($item->precio_venta * $item->quantity, 2) }}</td>
                   </tr>
                   <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                      <td>
                        <span class="btn btn-danger delete-p" title="Eliminar producto" data-id="{{ $item->clave }}" value="{{ $item->id }}">
                          <span class="glyphicon glyphicon-remove"></span>
                        </span>
                      </td>
                   </tr>

                </thead>
                  @endforeach
              </table> <!--- Se cierra la tabla visible para dispositivos moviles -->
              <table class=" table-striped table-condensed table-hover  total-pedidoxs">
                <tr>
                  <td id="subtotalp">
                    <span class="text-info">Subtotal:  </span>
                  </td>
                  <td id="totalp">
                    ${{ number_format($total, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Iva: </span>
                  </td>
                  <td>
                      <?php $iva = $total * 0.16 ?>
                      ${{ number_format($total * 0.16, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Total:  </span>
                  </td>
                  <td>
                    ${{ number_format($total + $iva, 2) }}
                  </td>
                </tr>
              </table>
              <!--Tabla oculta para dispositivos moviles-->
              <div class="table-responsive table-carrito">
                <table class="table table-hover tcarrito">
                  <thead>
                    <tr id="c-ped" class="cabecerapedido">
                      <th>Clave</th>
                      <th>Nombre</th>
                      <th>Color</th>
                      <th>Precio</th>
                      <th>Iva</th>
                      <th>Piezas por paquete</th>
                      <th>Cantidad de paquetes</th>
                      <th>Foto</th>
                      <th>Total producto</th>
                      <th>Quitar</th>
                    </tr>
                  </thead>
                  <tbody id="c-carp">
                    @foreach($cart as $item)
                      <tr class="tr-car filap_{{ $item->id }}" id="{{ $item->id }}">
                        <td>{{ $item->clave }}</td>
                        <td class="p-nom">{{ $item->nombre }}</td>
                        <td>{{ $item->color }}</td>
                        <td><?php $des = $item->precio_venta * $item->factor_descuento ?>${{ number_format($tpro = $item->precio_venta - $des, 2) }}</td>
                        <td>16%</td>
                        <td>{{ $item->piezas_paquete }}</td>
                        <td class="td-cpa">
                          <div class="c-pa">
                            <input type="number" data-id="p_{{ $item -> id }}" class="form-control cant_{{ $item -> id }}" min="1" max="100" value="{{ $totalp = $item->quantity }}" id="product_{{$item->id }}">
                            <a href="{{ URL::to('productos/update', $item->clave) }}" class="btn btn-info btn-update-p" id="{{ $item -> id }}" title="Actualizar la cantidad de paquetes">
                              <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                          </div>
                        </td>
                        <td>
                          <span class="verfotop" id="{{ $item->foto }}" data-id="{{ $item->nombre }}" alt="Foto del producto">
                            Ver Foto
                          </span>
                        </td>
                        <td>${{ number_format($sub = $tpro * $item->quantity, 2) }}</td>
                        <td>
                          <span class="btn btn-danger delete-p" title="Eliminar producto" data-id="{{ $item->clave }}" value="{{ $item->id }}">
                            <span class="glyphicon glyphicon-remove"></span>
                          </span>
                        </td>
                      </tr>
                  </tbody>
                    @endforeach
                </table>
                <table class=" table-striped table-condensed table-hover  total-pedido">
                  <tr>
                    <td id="subtotalp">
                      <span class="text-info">Subtotal:  </span>
                    </td>
                    <td id="totalp">
                      ${{ number_format($total, 2) }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Iva: </span>
                    </td>
                    <td>
                       <?php $iva = $total * 0.16 ?>
                        ${{ number_format($total * 0.16, 2) }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Total:  </span>
                    </td>
                    <td>
                      ${{ number_format($total + $iva, 2) }}
                    </td>
                  </tr>
                </table>
                <div class="alert alert-desc">
                  <strong>Descuento incluido.</strong>
                </div>
              </div>
            </div>


              <div class="tipoEnvio">
                <div class="select-tipo">
                  <h3 class="text-info">Cotizar Envío.</h3>
                  <select class="selectTipo btn-group">
                      <option value="nada" disabled selected>-- Seleccione --</option>
                      <option value="tienda">Recoger en tienda</option>
                      <option value="domicilio" title="Aplican costos adicionales">Enviar a domicilio</option>
                  </select>
                </div>
              </div>
              <input id="inpEnvio" type="text">

          </div>

         <div class="g-p-tipo">
            <span id="g-tipo" href="#confirmpedido" data-toggle="modal" class="g-tipo btn btn-primary">
              Generar pedido
            </span>
         </div>

            <div class="panel-elegir">
              <div class="alert alert-info alert-v alert-pago">
                <strong>Elige un domiclio.!</strong>
              </div>

              <div class="input-group infopago">
                 <select id="formapago" class="btn btn-info form-control formapago" name="formapago">
                     <option value="" disabled selected>Elige la forma de pago</option>
                   @foreach($pago as $pagos)
                     <option id="text_{{ $pagos->id }}" value="{{ $pagos->id }}">{{ $pagos->descripcion }}</option>
                   @endforeach
                 </select>
              </div>
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
                  <h2 class="text-danger text-center t-error-pago">Debe seleccionar la forma de pago.</h2>
                    <h2 class="text-primary text-center t-exsts">¿Están correctos sus datos?</h2>
                  </div>
                  <div class="modal-footer modal-confirmar">
                      <button type="button" class="btn btn-danger confirm t-no-c" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-danger t-cancel confirm" data-dismiss="modal">Cancelar</button>
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


            <div class='notifications top-right'></div>
            <div class="panel-footer footer-formpago">
            <a id="conf-p1" href="#confirmarpedido" class="btn btn-primary btn-conf-1 disabled" data-toggle="modal"> <!--   -->
              Generar pedido
            </a>
            <span id="gen-c"  class="btn btn-primary">
              Generar pedido
            </span>
            <a id="conf-p" href="#confirmarpedido" class="btn btn-primary hidden ge-p" data-toggle="modal"> <!--   -->
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
                    <h2 class="text-danger text-center text-pago">Debe seleccionar la forma de pago.</h2>
                    <h2 class="text-danger text-center text-selectdom">Seleccione un domicilio.</h2>
                  <span class="label label-danger esta center"></span>
                  </div>
                  <div class="modal-footer modal-confirmar">
                 <!--    <a href="{{ URL::to('productos/datosdelpedido') }}" class="btn btn-primary confirm">Si</a> -->
                      <button type="button" class="btn btn-danger confirm c-no" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-danger confirm c-pe" data-dismiss="modal">Cancelar</button>
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
     @else

    @endif

  </section>
</div> <!-- Content users -->

{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/accounting.min.js') }}
{{ HTML::script('js/principal.js') }}

<script type="text/javascript">

$(document).ready(function(){

    //Listar pedidos del cliente
    $('.pedidosCliente').hide();
    pedido_c = $("#pedido_cliente");
    $(document).on('click','#p_cliente', function(){
          $.ajax({
            dataType: 'json',
            url: '/productos/listarpedidos',
            success: function(l){
                if(l == 0){
                    $('.t-p-clientes').text('No tienes ningún pedido.');
                  } else {
                    $('.pedidosCliente').show();

                      tabla_a = $('#list_p_').DataTable({
                        "oLanguage": { 
                            "oPaginate": { 
                            "sPrevious": "Anterior", 
                            "sNext": "Siguiente", 
                            "sLast": "Ultima", 
                            "sFirst": "Primera" 
                            }, 

                        "sLengthMenu": 'Mostrar <select>'+ 
                        '<option value="10">10</option>'+ 
                        '<option value="20">20</option>'+ 
                        '<option value="30">30</option>'+ 
                        '<option value="40">40</option>'+ 
                        '<option value="50">50</option>'+ 
                        '<option value="-1">Todos</option>'+ 
                        '</select> registros', 

                        "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ pedidos)", 
                        "sInfoFiltered": " - filtrados de _MAX_ registros", 
                        "sInfoEmpty": "No hay resultados de búsqueda", 
                        "sZeroRecords": "No hay registros a mostrar", 
                        "sProcessing": "Espere, por favor...", 
                        "sSearch": "Buscar:", 

                     },

                      "aaSorting": [[ 2, "desc" ]], 

                      "sPaginationType": "simple_numbers",
                       "sPaginationType": "bootstrap",



                  });



                  tabla_a.fnClearTable();

                      for(var i = 0; i < l.length; i++) {
                             tabla_a.fnAddData([
                                       '<a id="c-estatus" class="'+l[i].num_pedido+'" data-id="'+l[i].id+'" value="'+l[i].created_at+'" href="#detallepedidocliente" data-toggle="modal">'+l[i].num_pedido+'</a>',
                                        l[i].created_at,
                                        l[i].nombre,
                                        '<span class="estatus_'+l[i].estatus+'"</span>',
                                      ]);


                              }


                        $('.estatus_0').text('Pendiente');
                        $('.estatus_0').addClass('text-warning');
                        $('.estatus_1').text('Crédito');
                        $('.estatus_1').addClass('text-primary');
                        $('.estatus_2').text('Pagado');
                        $('.estatus_2').addClass('text-success');
                        $('.estatus_3').text('Cancelado');
                        $('.estatus_3').addClass('text-danger');

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');


                }
            },

            error: function(){
              alert('failure');
            }
          });
    });

      //Reinicializamos la data table
    $(document).on('click', '.c-p-cli', function(){
      $('#list_p_').DataTable().fnDestroy();
    });

    $(document).on('click', '.close-mp', function(){
      $('#list_p_').DataTable().fnDestroy();
    });

      $(document).on('click','.fancy > li, a',function(){
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });




    //Detalle del pedido del cliente
    $(document).on('click', '#c-estatus', function(){
          $('.table-detail').show();
          $('#fotop').removeClass('enlace-active');
          $('#det-p').addClass('enlace-active');
          id = $(this).attr('data-id');
          num = $(this).attr('class');
          fe = $(this).attr('value');
          $('.n-pe').text('Pedido #'+num);
          $('.n-fe').text('Fecha: '+fe);
    });

      //Listar domicilios
     dom = $('#dom_c');

            $.ajax({
                type: "GET",
                url: "productos/listardomicilios",
                success: function (domi) {
                    d = "";
        //comprobamos si existen domicilios
        if (domi.direc.length) {


            for(datos in domi.direc){

                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td><button id="btn_Use" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-default usar-d"><span class="cambiar-g glyphicon glyphicon-off" ></span></button></td>';
                    d += '<td>'+domi.direc[datos].pais+'</td>';
                    d += '<td>'+domi.direc[datos].estados+'</td>';
                    d += '<td>'+domi.direc[datos].municipio+'</td>';
                    d += '<td>'+domi.direc[datos].calle1+'</td>';
                    d += '<td>'+domi.direc[datos].calle2+'</td>';
                    d += '<td>'+domi.direc[datos].colonia+'</td>';
                    d += '<td>'+domi.direc[datos].delegacion+'</td>';
                    d += '<td>'+domi.direc[datos].codigo_postal+'</td>';
                    d += '<td>'+domi.direc[datos].numero+'</td>';
                    d += '<td>'+domi.direc[datos].tipo+'</td>';
                    d += '<td><button id="btn_Update" href="#updateadress" data-toggle="modal" data-id="'+domi.direc[datos].tipo+'" value="'+domi.direc[datos].id+'" class="update-ad btn btn-primary"><span class="glyphicon glyphicon-refresh" ></span></button></td>';
                    d += '<td><button href="#confirm-delete" title="Eliminar domicilio" id="btn_Delete" data-toggle="modal" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove" ></span></button></td></tr>';
                 }
                dom.append(d);
                $('.exist-dom').hide();
                //Si no existe ningun domiclio ocultamos el panel
            } else {
                $('.p-address').hide();
                $('.m-domicilios').hide();
            }



        },

        error: function () {
            alert("failure");
        }
    });

         domxs = $('#dom_cxs');

            $.ajax({
                type: "GET",
                url: "productos/listardomicilios",
                success: function (domi) {
                    d = "";
        //comprobamos si existen domicilios
        if (domi.direc.length) {


            for(datos in domi.direc){

                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td><div class="text-acc text-info">Acciones</div><span class="acc"><button title="Usar este domicilio" id="btn_Use" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-default usar-d"><span class="cambiar-g glyphicon glyphicon-off" ></span></button>';
                    d += '<button title="Editar domicilio" id="btn_Update" href="#updateadress" data-toggle="modal" data-id="'+domi.direc[datos].tipo+'" value="'+domi.direc[datos].id+'" class="update-ad btn btn-primary"><span class="glyphicon glyphicon-refresh" ></span></button>';
                    d += '<button href="#confirm-delete" title="Eliminar domicilio" id="btn_Delete" data-toggle="modal" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove" ></span></button></span></td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>País: '+domi.direc[datos].pais+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Estado: '+domi.direc[datos].estados+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Municipio: '+domi.direc[datos].municipio+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Calle 1: '+domi.direc[datos].calle1+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Calle 2: '+domi.direc[datos].calle2+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Colonia: '+domi.direc[datos].colonia+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Delegación: '+domi.direc[datos].delegacion+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>CP: '+domi.direc[datos].codigo_postal+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Teléfono: '+domi.direc[datos].numero+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Domicilio: '+domi.direc[datos].tipo+'</td></tr>';
                 }
                domxs.append(d);
                $('.exist-dom').hide();
                //Si no existe ningun domiclio ocultamos el panel
            } else {
                $('.p-address').hide();
                $('.m-domicilios').hide();
            }



        },

        error: function () {
            alert("failure");
        }
    });


      //Listar telefonos del usuario
         tabalatel = $('#list-tel');

            $.ajax({
                type: "GET",
                url: "productos/listartelefonos",
                success: function (t) {
                    tel = "";
        //comprobamos si existen domicilios
        if (t.telefono.length) {


            for(datos in t.telefono){

                    tel += '<tr class="telefono"><td>'+t.telefono[datos].numero+'</td>';
                    tel += '<td>'+t.telefono[datos].tipo_tel+'</td>';
                    tel += '<td><span id="btn_Use" data-id="'+t.telefono[datos].id+'" value="'+t.telefono[datos].id+'" class="btn-add-id btn btn-default"><span class="cambiar-t glyphicon glyphicon-off" ></span></span></td></tr>';
                 }
                tabalatel.append(tel);
                $('.telcliente').hide();
                $('.otrotel-c').hide();
                $('.phone-c').removeClass('tel-celular');
                $('.phone-f').removeClass('tel-fijo');
                $('.phone-o').removeClass('tel-otro');
                $('#conf-p').attr('href','#confirmartel');
            } else {
                $('.telclienteotro').hide();
                $('.t-oculto').hide();
                $('.text-oculto').hide();
            }



        },

        error: function () {
            alert("failure");
        }
    });






});


</script>



@stop
