@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
<script>
$(document).ready(function(){
    $('.catalogos').addClass('active');
    $('.t-catalogos').addClass('en-admin');
  });
</script>
@stop

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop


@section('pedidos_user') @stop

@section('content')

<div class="content">
  <div class="row contenido-principal">
      <div class="titulo_catalogo" >
         <h2>  Catálogo    {{$catalogo }}  </h2>
      </div>
      <div class="col-md-12 main-content" id="catalogo_principal" class="panel-body">
              @include('layouts/inc/estatus')
                      <?php                           
                      switch ($catalogo) {
                        case 'Almacen':      ?>
                            <div class="table-responsive">
                            <table id="tablaResult" class="table table-first-column-check">
                                <thead>
                                  <tr>
                                    <th class="col-md-4">Clave</th>
                                    <th class="col-md-4">Nombre</th>
                                    <th class="col-md-1">Status</th>
                                    <th class="col-md-3">Acción</th>
                                  </tr>
                                </thead>  
                                <tbody>
                                  <form>
                                  <tr visible="false">
                                    <td><input type="text" id="clave_0" name="clave" required class="form-control"> </td>
                                    <td><input type="text" id="nombre_0" name="nombre" required class="form-control"> </td>
                                    <td><input type="checkbox" id="status_0" name="status" value=1 checked="true" class="checkbox" disabled></td>
                                <!--    <input type="hidden" id="catalogo_0" value="Almacen"  >
                                    <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                    <td><button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Almacen" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span></button></td>
                                  </tr>
                                  </form>
                                
                                  @foreach($almacenes as $almacen)
                                  {{Form::open() }}
                                    <tr id="tr_{{$almacen->id}}">
                                      <td> <input type="text" name="clave_{{$almacen->id}}" value="{{$almacen->clave}}" id="clave_{{$almacen->id}}" disabled="disabled" required class="form-control"> </td>
                                      <td> <input type="text" name="nombre_{{$almacen->id}}" value="{{$almacen->nombre}}" id="nombre_{{$almacen->id}}" disabled="disabled" required class="form-control"></td>
                                      <td> <input type="checkbox" name="status_{{$almacen->id}}" value="{{$almacen->estatus}}"  id="status_{{$almacen->id}}" disabled="disabled" <?php  if ($almacen->estatus==1): ?> checked <?php endif ?> class="form-check"> </td>
                                      
                                      <td>
                                        <button type="button" value="Modificar" id="btn_mod" data-id="{{$almacen->id}}" data-cat="Almacen" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" value="Actualizar" id="btn_guardar_{{$almacen->id}}" disabled="disabled" data-id="{{$almacen->id}}" data-cat="Almacen"class="enviarG btn btn-success"><span class="glyphicon glyphicon-">OK</span></button>
                                        <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$almacen->id}}" data-cat="Almacen" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                      </td>

                                    </tr>
                                  {{Form::close()}}                          
                                  @endforeach
                                  
                                </tbody>
                            </table>
                            </div>
                            <?php
                            break;

                        case 'Cliente': ?>
                          <div>
                            <button type="button" value="Nuevo" id="nuevo" class="editar btn btn-primary" data-info="" data-cat="Cliente" ><span class="glyphicon glyphicon-">NUEVO</span></button>
                          </div>
                          <div class="table-responsive">
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th class="col-md-3">RFC</th>
                                <th class="col-md-2">Usuario</th>
                                <th class="col-md-2">Agente</th>
                                <th class="col-md-3">Numero cliente</th>
                                <th class="col-md-2"></th>
                              </tr>
                            </thead>
                            <tbody>              

                            @foreach($clientes as $cliente)
                            
                            <!--<form class="form-group"> -->
                              <tr id="tr_{{$cliente->id}}">
                                <td><input type="text" id="rfc_{{$cliente->id}}"  value="{{$cliente->rfc}} " disabled   class="form-control input-xlarge"></td>
                                <td><input type="text" id="usuario_id_{{$cliente->id}}"  value="{{$cliente->usuario}}" disabled class="form-control"></td>
                                <td><input type="text" id="agente_id_{{$cliente->id}}"  value="{{$cliente->agente}}" disabled class="form-control"></td>
                                <td><input type="text" id="numero_cliente_{{$cliente->id}}"  value="{{$cliente->numero_cliente}}" disabled class="form-control"></td>
                                <td style="width: 150px; height: 25px; ">
                                  <button type="button" value="Modificar" id="editarClienteProveedor" data-id="{{$cliente->id}}" class="editar btn btn-primary" data-info='{{json_encode($cliente,JSON_HEX_APOS)}}' data-cat="Cliente"><span class="glyphicon glyphicon-edit"></span></button>
                                <!--  <input type="hidden" id="campo_id{{$cliente->id}}" value="{{$cliente->id}}" name="campo_id" >
                                  <button type="button" value="Actualizar" id="btn_actualizar_{{$cliente->id}}" disabled="disabled" data-id="{{$cliente->id}}" > Act</button> -->
                                  <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$cliente->id}}" data-cat="Cliente" data-info="{{$cliente->idUsuario}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                              </tr>
                            <!--</form> -->

                            @endforeach()
                            </tbody>
                          </table> 
                          </div>
                          <?php
                          break;
                        
                        case 'Comercializador': ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th style="width: 200px;">Nombre</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="nombre_0" name="nombre_0" value="" class="form-control"></td>
                                    <td>
                                      <!-- <input type="hidden" id="tipoMov_0" value="Guardar" name="">-->
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Comercializador" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                    </td>
                                  </tr>
                                </form>
                                @forelse($comercializadores as $comercializador)
                                <form>
                                <tr id="tr_{{$comercializador->id}}">
                                  <td><input type="text" id="nombre_{{$comercializador->id}}" name="nombre_{{$comercializador->id}}" value="{{$comercializador->nombre}}" disabled="disabled" class="form-control"></td>
                                  <td>
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$comercializador->id}}" data-cat="Comercializador" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                    <button type="button" value="Actualizar" id="btn_guardar_{{$comercializador->id}}" disabled="disabled" data-id="{{$comercializador->id}}" data-cat="Comercializador" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$comercializador->id}}" data-cat="Comercializador" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                                </tr>
                                </form>
                                @empty
                                
                                @endforelse
                            </tbody>
                          </table>

                          <?php
                          break;
                       
                        case 'NivelDescuento':      ?>
                          <div class="col-md-8 col-sm-10 col-xs-12">
                            <table class="table table-first-column-check" id="tablaResult">
                              <thead>
                                <tr class="">
                                  <th class="col-md-4 col-xs-5 col-sm-4">Descripcion</th>
                                  <th class="col-md-2 col-xs-1 col-sm-2">Decuento</th>
                                  <th class="col-md-2 col-xs-1 col-sm-2">Estatus</th>
                                  <th class="col-md-4 col-xs-5 col-sm-4"></th>
                                </tr>
                              </thead>
                              <tbody>
                                  <form>
                                    <tr class="">
                                      <td class="col-md-4 col-xs-5 col-sm-4"><input type="text" id="descripcion_0"  value="" class="form-control"></td>
                                      <td class="col-md-2 col-xs-1 col-sm-2"><input type="text" id="descuento_0"  pattern="[0-9]" value="" class="form-control"></td>
                                      <td class="col-md-2 col-xs-1 col-sm-2" style="text-align: center"><input type="checkbox" id="estatus_0" name="status" value checked="true" class="form-check" disabled></td>
                                      <td class="col-md-4 col-xs-5 col-sm-4" style="text-align: center">
                                         <!-- <input type="hidden" id="tipoMov_0" value="Guardar" name="">-->
                                          <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="NivelDescuento" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                      </td>
                                    </tr>
                                  </form>
                                 @forelse($descuentos as $descuento)

                                  <tr id="tr_{{$descuento->id}}" class="">
                                    <td class="col-md-4 col-xs-5 col-sm-4"><input type="text" id="descripcion_{{$descuento->id}}" name="descripcion_{{$descuento->id}}" value="{{$descuento->descripcion}}" disabled class="form-control"></td>
                                    <td class="col-md-2 col-xs-1 col-sm-2"><input type="text" id="descuento_{{$descuento->id}}" name="descuento_{{$descuento->id}}" value="{{$descuento->descuento}}" disabled class="form-control"></td>
                                    <td class="col-md-2 col-xs-1 col-sm-2" style="text-align: center"> <input type="checkbox"  value=""  id="estatus_{{$descuento->id}}" disabled <<?php  if ($descuento->estatus==1) {?> checked <?php } ?> > </td>
                                    <td class="col-md-4 col-xs-5 col-sm-4" style="text-align: center">
                                      <button type="button" value="Modificar" id="btn_mod" data-id="{{$descuento->id}}" data-cat="NivelDescuento" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" value="Actualizar" id="btn_guardar_{{$descuento->id}}" disabled="disabled" data-id="{{$descuento->id}}" data-cat="NivelDescuento" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                      <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$descuento->id}}" data-cat="NivelDescuento" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                  </tr>
                                  @empty
                                  <tr>
                                    <td>
                                       <p>NO HAY DATOS PARA MOSTRAR</p>
                                    </td>
                                 
                                  </tr>
                                  @endforelse 
                              </tbody>
                            </table>
                          </div>
                      
                           <?php 
                          break; 

                        case 'FormaPago':  ?>
                          <div class="col-md-8 col-sm-12">
                          <table class="table table-first-column-check " id="tablaResult">
                            <thead>
                              <tr class="">
                                <th class="col-md-6 col-sm-6">Descripción</th>
                                <th class="col-md-6 col-sm-6"></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr class="">
                                    <td class="col-md-6 col-sm-6"><input type="text" id="descripcion_0" name="" value="" class="form-control"></td>
                                    <td class="col-md-6 col-sm-6" style="text-align: center;"><button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="FormaPago" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span></button></td>
                                  </tr>
                                </form>
                               @foreach($formasPago as $formaPago)
                                <tr id="tr_{{$formaPago->id}}" class="" >
                                  <td class="col-md-6 col-sm-6"><input type="text" id="descripcion_{{$formaPago->id}}" name="" value="{{$formaPago->descripcion}}" disabled="disabled" class="form-control"></td>
                                  <td class="col-md-6 col-sm-6" style="text-align: center;">
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$formaPago->id}}" data-cat="FormaPago" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                    <button type="button" value="Actualizar" id="btn_guardar_{{$formaPago->id}}" disabled="disabled" data-id="{{$formaPago->id}}" data-cat="FormaPago" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$formaPago->id}}" data-cat="FormaPago" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                                </tr>
                               @endforeach
                            </tbody>
                          </table>
                          </div>
                          <?php
                          break; 

                        case 'UnidadMedida':  ?>
                          <div class="col-md-8 col-sm-10 col-xs-12">
                          <div class="table-responsive">
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th class="col-md-6 col-xs-6 col-sm-6">Descripcion</th>
                                <th class="col-md-3 col-xs-1 col-sm-3">Estatus</th>
                                <th class="col-md-3 col-xs-5 col-sm-3"></th>
                              </tr>
                            </thead>
                              <tbody>
                                  <form>
                                    <tr>
                                      <td class="col-md-6 col-xs-6 col-sm-6"><input type="text" id="descripcion_0" name="descripcion_0" value="" class="form-control"></td>
                                      <td class="col-md-3 col-xs-1 col-sm-3" style="text-align: center"><input type="checkbox" id="estatus_0" name="status" value checked="true" class="form-check" disabled></td>
                                      <td class="col-md-3 col-xs-5 col-sm-3" style="text-align: center">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="UnidadMedida" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                      </td>
                                    </tr>
                                  </form>
                                    @forelse($unidadMedida as $uMedida)

                                  <tr id="tr_{{$uMedida->id}}">
                                    <td class="col-md-6 col-xs-6 col-sm-6"><input type="text" id="descripcion_{{$uMedida->id}}"  value="{{$uMedida->descripcion}}" disabled class="form-control"></td>
                                    <td class="col-md-3 col-xs-1 col-sm-3" style="text-align: center"> <input type="checkbox"  value="{{$uMedida->estatus}}"  id="estatus_{{$uMedida->id}}" disabled <<?php  if ($uMedida->estatus==1) {?> checked <?php } ?> > </td>
                                    <td class="col-md-3 col-xs-5 col-sm-3" style="text-align: center">
                                      <button type="button" value="Modificar" id="btn_mod" data-id="{{$uMedida->id}}" data-cat="UnidadMedida" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" value="Actualizar" id="btn_guardar_{{$uMedida->id}}" disabled="disabled" data-id="{{$uMedida->id}}" data-cat="UnidadMedida" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                      <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$uMedida->id}}" data-cat="UnidadMedida" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                  </tr>
                                  @empty
                                  <tr>
                                    <td>
                                       <p>NO HAY DATOS PARA MOSTRAR</p>
                                    </td>
                                 
                                  </tr>
                                  @endforelse 
                                 
                              </tbody>
                            </table>
                          </div>
                          </div>
                          <?php
                          break; 

                        case 'Rol':  ?>
                          <div class="col-md-6 col-sm-8 col-xs-12">
                          <div class="table-responsive">
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th class="col-xs-6">Nombre</th>
                                <th class="col-xs-6"></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td class="col-xs-6"><input type="text" id="nombre_0" value="" class="form-control"></td>
                                    <td class="col-xs-6" style="text-align: center">
                                      <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Rol" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>    
                                    </td>
                                  </tr>
                                </form>
                                  @forelse($rol as $rol)

                                <tr id="tr_{{$rol->id}}">
                                  <td class="col-xs-6"><input type="text" id="nombre_{{$rol->id}}"  value="{{$rol->nombre}}" disabled class="form-control"></td>
                                  <td class="col-xs-6" style="text-align: center">
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$rol->id}}" data-cat="Rol" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                    <button type="button" value="Actualizar" id="btn_guardar_{{$rol->id}}" disabled="disabled" data-id="{{$rol->id}}" data-cat="Rol" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$rol->id}}" data-cat="Rol" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                                </tr>
                                @empty
                                <tr>
                                  <td>
                                     <p>NO HAY DATOS PARA MOSTRAR</p>
                                  </td>
                               
                                </tr>
                                @endforelse 
                               
                            </tbody>
                          </table>
                          </div>
                          </div>
                          <?php
                          break; 

                        case 'Proveedor': ?>
                          <div>
                            <button type="button" value="Nuevo" id="nuevo" class="editar btn btn-primary" data-info='' data-cat="Proveedor"><span class="glyphicon glyphicon-">NUEVO</span></button>
                          </div>
                          <div class="col-xs-12" style="padding: 10px;">
                          <div class="table-responsive">
                            <table class="table table-first-column-check" id="tablaResult">
                              <thead>
                                <tr>
                                  <th class="col-md-3 col-sm-2 col-xs-2">Nombre</th>
                                  <th class="col-md-2 col-sm-2 col-xs-2">Nombre comercial</th>
                                  <th class="col-md-2 col-sm-2 col-xs-2">Razon social</th>
                                  <th class="col-md-1 col-sm-2 col-xs-1">Estatus</th>
                                  <th class="col-md-2 col-sm-2 col-xs-2">Comercializador</th>
                                  <th class="col-md-2 col-sm-2 col-xs-3">Acción</th>
                                </tr>
                              </thead>
                              <tbody>   
                                 @forelse($proveedor as $proveedor)

                                  <tr id="tr_{{$proveedor->id}}">
                                    <td class="col-md-3 col-sm-2 col-xs-2"><input type="text" id="nombre_{{$proveedor->id}}"  value="{{$proveedor->nombre}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="nombre_comercial_{{$proveedor->id}}"  value="{{$proveedor->nombre_comercial}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="razon_social_{{$proveedor->id}}"  value="{{$proveedor->razon_social}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-1 col-sm-2 col-xs-1"><input type="checkbox" id="status_{{$proveedor->id}}" name="status" value  disabled <?php  if ($proveedor->estatus==1): ?> checked <?php endif ?>></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="comercializador_{{$proveedor->id}}"  value="{{$proveedor->comercializador}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-3">
                                      <button type="button" value="Modificar" id="editarClienteProveedor" data-id="{{$proveedor->id}}" class="editar btn btn-primary" data-info='{{json_encode($proveedor,JSON_HEX_APOS)}}' data-cat="Proveedor"><span class="glyphicon glyphicon-edit"></span></button>
                                    </td>
                                  </tr>
                                  @empty
                                  
                                  @endforelse 
                              </tbody>
                            </table> 
                            </div>
                            </div>
                          <?php
                          break;
                        
                        case 'Pais': ?>
                          <div class="col-sm-6">
                            <div class="table-responsive">
                              <table class="table table-first-column-check" id="tablaResult">
                                <thead>
                                  <tr>
                                    <th class="col-sm-6">Pais</th>
                                    <th class="col-sm-2" style="text-align: center;">Estatus</th>
                                    <th class="col-sm-4" style="text-align: center;"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <form>
                                      <tr>
                                        <td class="col-sm-6"><input type="text" id="pais_0" name="pais_0" value="" class="form-control"></td>
                                        <td class="col-sm-2" style="text-align: center;"><input type="checkbox" id="estatus_0" name="estatus" value=1 checked="true" class="checkbox" disabled></td>
                                        <td class="col-sm-4" style="text-align: center;">
                                          <!--  <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                            <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Pais" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                        </td>
                                      </tr>
                                    </form>
                                    @forelse($pais as $pais)
                                    <form class="form-group">
                                    <tr id="tr_{{$pais->id}}">
                                      <td class="col-sm-6"><input type="text" id="pais_{{$pais->id}}" name="nombre_{{$pais->id}}" value="{{$pais->pais}}" disabled="disabled" class="form-control"></td>
                                      <td class="col-sm-2" style="text-align: center;"><input type="checkbox" id="estatus_{{$pais->id}}" name="" value="1" <?php if ($pais->estatus==1): ?> checked <?php endif ?>  class="checkbox" disabled></td>
                                      <td class="col-sm-4" style="text-align: center;">
                                        <button type="button" value="Modificar" id="btn_mod" data-id="{{$pais->id}}" data-cat="Pais" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" value="Actualizar" id="btn_guardar_{{$pais->id}}" disabled="disabled" data-id="{{$pais->id}}" data-cat="Pais" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                        <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$pais->id}}" data-cat="Pais" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                      </td>
                                    </tr>
                                    </form>
                                    @empty
                                    <tr>
                                      <td>
                                         <p>NO HAY DATOS PARA MOSTRAR</p>
                                      </td>
                                   
                                    </tr>
                                    @endforelse
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php
                          break;

                        case 'Estados': ?>
                          <div class="table-responsive">
                          <table class="table table-first-column-check data-table display full table-condensed" id="tablaResult">
                            <thead>
                              <tr>
                                <th class="col-sm-4">Estado</th>
                                <th class="col-sm-4">País</th>
                                <th class="col-sm-1">Estatus</th>
                                <th class="col-sm-3"></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="estado_0" name="estado_0" value="" class="form-control"></td>
                                    <td><select id="pais_0" name="" class="form-control options " value="" required>
                                          <option value="-1">Seleccione pais</option>
                                          @foreach($paises as $pais)
                                          <option value="{{$pais->id}}">{{$pais->pais}}</option>
                                          @endforeach
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="estatus_0" name="estatus" value=1 checked="true" class="checkbox" disabled></td>
                                    <td>
                                      <!--  <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Estados" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                    </td>
                                  </tr>
                                </form>

                               
                                @forelse($estados as $estado)
                                <form class="form-group">
                                <tr id="tr_{{$estado->id}}">
                                  <td><input type="text" id="estado_{{$estado->id}}" name="estado_{{$estado->id}}" value="{{$estado->estados}}" disabled="disabled" class="form-control"></td>
                                  <td><select id="pais_{{$estado->id}}" name="" class="form-control default-option" data-option="2" required disabled>
                                        @foreach($paises as $pais)
                                          <option value="{{$pais->id}}" <?php if ($estado->pais_id===$pais->id): ?> selected <?php endif ?> >{{$pais->pais}}</option>
                                        @endforeach
                                      </select>
                                  </td>
                                  <td><input type="checkbox" id="estatus_{{$estado->id}}" name="" value="1" <?php if ($estado->estatus==1): ?> checked <?php endif ?>  class="checkbox" disabled></td>
                                  <td>
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$estado->id}}" data-cat="Estados" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                    <button type="button" value="Actualizar" id="btn_guardar_{{$estado->id}}" disabled="disabled" data-id="{{$estado->id}}" data-cat="Estados" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$estado->id}}" data-cat="Estados" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                                </tr>
                                </form>
                                @empty
                                <tr>
                                  <td>
                                     <p>NO HAY DATOS PARA MOSTRAR</p>
                                  </td>
                               
                                </tr>
                                @endforelse
                            </tbody>
                          </table>
                          </div>
                          <?php
                          break;

                        case 'Municipios': ?>
                          <div class="table-responsive">
                            <table class="table table-first-column-check data-table display full table-condensed" id="tablaResult">
                              <thead>
                                <tr>
                                  <th class="col-sm-4">Municipio</th>
                                  <th class="col-sm-4">Estado</th>
                                  <th class="col-sm-1">Estatus</th>
                                  <th class="col-sm-3"></th>
                                </tr>
                              </thead>
                              <tbody>
                                  <form>
                                    <tr>
                                      <td><input type="text" id="municipio_0" name="municipio_0" value="" class="form-control"></td>
                                      <td><select id="estado_0" name="" class="form-control options " value="" required>
                                            <option value="-1">Seleccione estado</option>
                                            @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->estados}}</option>
                                            @endforeach
                                          </select>
                                      </td>
                                      <td><input type="checkbox" id="estatus_0" name="estatus" value="" checked="true" class="checkbox" disabled></td>
                                      <td>
                                        <!--  <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                          <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Municipios" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                      </td>
                                    </tr>
                                  </form>

                                 
                                  @forelse($municipios as $municipio)
                                  <form class="form-group">
                                  <tr id="tr_{{$municipio->id}}">
                                    <td><input type="text" id="municipio_{{$municipio->id}}" name="municipio_{{$municipio->id}}" value="{{$municipio->municipio}}" disabled="disabled" class="form-control"></td>
                                    <td><select id="estado_{{$municipio->id}}" name="" class="form-control "  required disabled>
                                          @foreach($estados as $estado)
                                            <option value="{{$estado->id}}" <?php if ($municipio->estado_id===$estado->id): ?> selected <?php endif ?> >{{$estado->estados}}</option>
                                          @endforeach
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="estatus_{{$municipio->id}}" name="" value="" <?php if ($municipio->estatus==1): ?> checked <?php endif ?>  class="checkbox" disabled></td>
                                    <td>
                                      <button type="button" value="Modificar" id="btn_mod" data-id="{{$municipio->id}}" data-cat="Municipios" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                      <button type="button" value="Actualizar" id="btn_guardar_{{$municipio->id}}" disabled="disabled" data-id="{{$municipio->id}}" data-cat="Municipios" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                      <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$municipio->id}}" data-cat="Municipios" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                  </tr>
                                  </form>
                                  @empty
                                  <tr>
                                    <td>
                                       <p>NO HAY DATOS PARA MOSTRAR</p>
                                    </td>
                                 
                                  </tr>
                                  @endforelse
                              </tbody>
                            </table>
                          </div>
                          <?php
                          break;

                        case 'Familias':  ?>
                          <div class="">
                            <div class="table-responsice">
                              <table class="table table-first-column-check data-table display full table-condensed" id="tablaResult">
                                
                                <thead>
                                  <tr>
                                    <th class="col-sm-3">Descripcion</th>
                                    <th class="col-sm-3">Descuento</th>
                                    <th class="col-sm-2">Factor de descuento</th>
                                    <th class="col-sm-1">Estatus</th>
                                    <th class="col-sm-3"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                      <tr>
                                        <td class="col-sm-3"><input type="text" id="descrFam_0" name="" value="" class="form-control"></td>
                                        <td class="col-sm-3"><select id="descFam_0" name="" class="form-control options " value="" required>
                                              <option value="-1">Seleccione descuento</option>
                                           <!--   
                                              <option value=""></option>
                                                 -->
                                            </select>
                                        </td>
                                        <td class="col-sm-2"><input type="text" id="factorDescFam_0" name="" value="" class="form-control"></td>
                                        <td class="col-sm-1"><input type="checkbox" id="estatusFam_0" name="" value="" checked="true" class="checkbox" disabled></td>
                                        <td class="col-sm-3">
                                          <!--  <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                            <button type="button" id="btn_guardarFam" name="" value="Guardar" data-id="0" data-cat="Familias" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                        </td>
                                      </tr>
                                    

                                   
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php
                          break;

                        case 'Descuentos':  ?>
                          <div class="col-sm-6">
                            <div>
                              <table class="table table-first-column-check " id="tablaResult">
                                
                                <thead>
                                  <tr>
                                    <th class="col-sm-4">Descripcion</th>
                                    <th class="col-sm-2">Descuento</th>
                                    <th class="col-sm-2">Estatus</th>
                                    <th class="col-sm-4"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                      <tr>
                                        <td class="col-sm-4"><input type="text" id="descrDesc_0" name="" value="" class="form-control"></td>
                                        <td class="col-sm-2"><input type="number" id="descDesc_0" name="" class="form-control" value="" min="0" required></td>
                                        <td class="col-sm-2"><input type="checkbox" id="estatusDesc_0" name="" value="" checked="true" class="checkbox" disabled></td>
                                        <td class="col-sm-4">
                                          <button type="button" id="btn_guardarDesc" name="" value="Guardar" data-id="0" data-cat="Familias" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                        </td>
                                      </tr>
                                    

                                   
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php  
                          break;

                        case 'Producto':  ?>
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table table-first-column-check " id="tablaResult" style="text-align: center">
                                
                                <thead>
                                  <tr >
                                    <th class="col-sm-1" style="text-align: center">Clave</th>
                                    <th class="col-sm-3" style="text-align: center">Nombre</th>
                                    <th class="col-sm-3" style="text-align: center">Color</th>
                                    <th class="col-sm-1" style="text-align: center">Almacen</th>
                                    <th class="col-sm-2" style="text-align: center">Familia</th>
                                    <th class="col-sm-1" style="text-align: center">Estatus</th>
                                    <th class="col-sm-1" style="text-align: center"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($producto as $producto)
                                      <tr>
                                        <td class="col-sm-1"><input type="text" id="claveProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->clave}}" ></td>
                                        <td class="col-sm-3"><input type="text" id="nombreProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->nombre}}" required></td>
                                        <td class="col-sm-3"><input type="text" id="colorProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->color}}" required></td>
                                        <td class="col-sm-1"><input type="text" id="almacenProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->cveAlmacen}}" required></td>
                                        <td class="col-sm-2"><input type="text" id="familiaProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->descrFamilia}}" required></td>
                                        <td class="col-sm-1" style="text-align: center"><input type="checkbox" id="estatusProd_{{$producto->idProd}}" name="" value="{{$producto->estatus}}" checked="true" class="checkbox" disabled></td>
                                        <td class="col-sm-1" >
                                          <button type="button" value="Modificar" id="btn_editarProd" data-id="{{$producto->idProd}}" class="editar btn btn-primary" data-info='{{json_encode($producto,JSON_HEX_APOS)}}' data-cat="Proveedor"><span class="glyphicon glyphicon-edit"></span></button>
                                        </td>
                                      </tr>
                                    @endforeach

                                   
                                  
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <?php
                          break;

                        default:
                          # code...
                          break;
                      }
                      ?>
                        
                      
                        
                     
      </div>
      <div id="contenido_esp" class="panel-body" style="display: none">  <!-- CONTENIDO PARA VER TODOS LOS DETALLES DE UN CLIENTE O PROVEEDOR -->
        <div style="padding: 5px;">
          <a href="/catalogo/{{$catalogo}}" type="button" class="btn-link"> REGRESAR </a>
        </div>
        <div id="detalles" style="padding: 5px;">
          <form class="add" id="addform">
            
          </form>
        </div>
        <div class="fancy-tab-container " id="tab">
          <ul id="myTab" class="nav nav-tabs two-tabs fancy">
            <li class="active"><a href="#telefono" data-toggle="tab">Telefono</a></li>
            <li><a href="#direccion" data-toggle="tab">Direccion</a></li>
            @if($catalogo == "Proveedor")
              <li><a href="#contactos" data-toggle="tab">Contactos</a></li>
            @endif
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade in active table-responsive" id="telefono">
              <table id="telCliente" class="table table-first-column-number ">
                <thead >
                  <tr>
                    <th class="col-xs-4">Numero</th>
                    <th class="col-xs-3">Tipo</th>
                    <th class="col-xs-2">Status</th>
                    <th class="col-xs-3"></th>
                  </tr>
                </thead>
                <tbody id="tbodyCliente">
                  <tr id="tr_0">
                    <td class="col-xs-4"><input type="tel" onkeyup="" id="telefono_0"  value="" class="form-control"> </td>
                    <td class="col-xs-3">
                      <select id="tipo_0" name="" class="input-xlarge form-control   options " value="" required >
                        <option value="-1">Seleccione el tipo</option>
                        <option value="Celular">Celular</option>
                        <option value="Fijo">Fijo</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </td>
                    <td class="col-xs-2"><input type="checkbox" id="estatusTel_0"  value="1"   checked disabled></td>
                    <td class="col-xs-3">
                      <input type="hidden" id="<?php if ($catalogo === "Cliente"): ?>id_Cliente<?php else: ?>id_Proveedor<?php endif ?>" value="" name="">
                      <button type="button" id="btn_guardarTel" name="btn_guardar" value="Guardar" data-id="0" data-cat="<?php if ($catalogo === "Cliente"): ?>TelefonoCliente<?php else: ?>TelefonoProveedor<?php endif ?>" class="enviarG  btn btn-success">OK</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade table-responsive" id="direccion">
                <table id="tableDireccion" class="table table-first-column-check">
                  <thead>
                    <th><h3>Pais</h3></th>
                    <th><h3>Estado</h3></th>
                    <th><h3>municipio</h3></th>
                    <th><h3>Delegacion</h3></th>
                    <th><h3>Colonia</h3></th>
                    <th><h3>Calle 1</h3></th>
                    <th><h3>Calle 2</h3></th>
                    <th><h3>C.P.</h3></th>
                    <th><h3>Tipo</h3></th>
                    <th><h3>estatus</h3></th>
                    <th>
                      <button type="button" class="btn btn-warning" data-accion="Guardar" data-toggle="modal" data-id="" value="Guardar" id="editDirCliente" data-cat="<?php if ($catalogo === "Cliente"): ?>TelefonoCliente<?php else: ?>TelefonoProveedor<?php endif ?>"><span class="glyphicon glyphicon-open"></span></button>
                    </th>
                  </thead>
                  <tbody id="tbodyClienteDir">
                  
                  </tbody>
                </table>
            </div> 
              @if ($catalogo=== "Proveedor") <!-- En caso de ser proveedor aparecera este tab-pane para los contactos del proveedor -->
            <div class="tab-pane fade table-responsive" id="contactos" >
              <table id="contactosProv" class="table table-first-column-number ">
                <thead >
                  <tr>
                    <th class="col-xs-3">Nombre</th>
                    <th class="col-xs-3">Correo</th>
                    <th class="col-xs-1">Status</th>
                    <th class="col-xs-3"></th>
                  </tr>
                </thead>
                <tbody id="tbodyContacto">
                  <tr id="trContacto_0">
                    <td class="col-xs-3"><input type="text" onkeyup="" id="nomProveedor_0"  value="" class="form-control"> </td>
                    <td class="col-xs-3"><input type="email" onkeyup="" id="correoProveedor_0"  value="" class="form-control"> </td>
                    <td class="col-xs-1"><input type="checkbox" id="estatusContacto_0"  value="1"   checked disabled></td>
                    <td class="col-xs-3">
                      <button type="button" id="btn_guardarContacto" name="btn_guardar" value="Guardar" data-id="0" data-cat="Contacto" class="enviarG  btn btn-success">OK</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>  
              @endif

            
          </div> 
        </div>
      </div>
      
    </div>
    
</div>
<div class='notifications top-right' data-html="true"></div>
<!--::::::::::::::::::::::::::::: MODAL PARA LAS DIRECCIONES  :::::::::::::::::::::::::::::-->
<div id="myModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>DIRECCION</h3>
      </div>
      <form action="" method="" accept-charset="utf-8">
        <div class="modal-body">
          <div class="row form-inline " style="text-align: center;">
            <div class="calle1 input-group col-sm-5"  style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Calle 1</span>
              </span>
              <input class="form-control" placeholder="Calle 1" required="required" id="calle1" name="calle1" type="text">
            </div>
            <div class="calle2 input-group col-sm-5 " style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Calle 2</span>
              </span>
              <input class="form-control" placeholder="Calle 2" required="required" id="calle2" name="calle2" type="text">
            </div>
          </div>
          <div class="row form-inline" style="text-align: center;">
            <div class="colonia input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Colonia</span>
              </span>
              <input class="form-control" placeholder="Colonia" required="required" id="colonia" name="colonia" type="text">
            </div>
            <div class="delegacion input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Delegación</span>
              </span>
              <input class="form-control" placeholder="Delegación" id="delegacion" name="delegacion" type="text">
            </div>
          </div>
          <div class="row form-inline" style="text-align: center;">
            <div class="pais input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">País</span>
              </span>
              <select class="form-control options pais" id="pais" data-option="" name="pais" required=""></select>
            </div>
            <div class="estado input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Estado</span>
              </span>
              <select class="form-control options" id="estado" name="estado" required="">
              </select>
            </div>
          </div>
          <div class="row form-inline" style="text-align: center;">
            <div class="municipio input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Municipio</span>
              </span>
              <select class="form-control" id="municipio" name="municipio" required="">
              </select>
            </div>        
            <div class="cp input-group col-sm-5" style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Codigo Postal</span>
              </span>
              <input class="form-control" placeholder="Codigo postal" required="required" id="cp" name="cp" type="text">
            </div>
          </div>   
          <div class="row form-inline" style="text-align: center;">
            <div class="col-sm-5  input-group" style="padding: 5px;">
              <span class="input-group-addon" >
                <span class="text-info">Tipo</span>
              </span>
              <select class="form-control " id="tipoDir" name="" required="">
                <option value="">Seleccione tipo de domicilio</option>
                <option value="Fiscal">Domicilio Fiscal</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="input-group col-sm-5" style="text-align: left; padding: 5px;">
              <div class=" input-group-addon col-sm-6" style="height: ">
                <span class="input-group-addon" >
                  <span class="text-info">Estatus:</span>
                </span>
              </div>
              <div class=" input-group col-sm-2" >
                <input type="checkbox" value="" id="estatusDirCliente" class="form-control" style="width: 22px;">
              </div>
            </div>
          </div> 
          <div class="row form-inline" style="text-align: center;">
            <div class="col-sm-5  input-group" style="padding: 5px;">
              <span class="input-group-addon" >
                <span class="text-info">Teléfono</span>
              </span>
              <select class="form-control " id="telefonoDir" name="" required="required">
              </select>
            </div>
            <div class="col-sm-5  input-group" style="padding: 5px;">
            </div>
          </div>
        </div>
        <div class="modal-footer" id="modalFooterDir">
          
        </div>
      </form>
    </div>
  </div>
</div>

<!--::::::::::::: MODAL PARA LAS CONFIRMACIONES :::::::::::::::::::::::::::::::::::::::-->
<div id="modalConfirmacion" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="modalConfirmacionLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h3>CONFIRMACION</h3>
      </div>
      <form action="" method="" accept-charset="utf-8">
        <div class="modal-body">
          
        </div>
        <div class="modal-footer" id="modalFooterDir">
        </div>
      </form>
    </div>
  </div>
</div>

<!--:::::::::::: MODAL PARA INGRESAR UN NUEVO DESCUENTO DESDE CATALOGO CLIENTE :::::::::::::::::-->
<div id="modalDescuentos" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="modalDescuentosLabel" aria-hidden="true" >
  <div class="modal-dialog xs-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h3>DESCUENTO</h3>
      </div>
      <form action="" method="" accept-charset="utf-8">
        <div class="modal-body">
          <div class="row form-inline " style="text-align: center;">
            <div class="descripcionDesc input-group col-sm-5"  style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Descripción:</span>
              </span>
              <input class="form-control" placeholder="Descripción" required="required" id="descripcionDesc" name="" type="text">
            </div>
            <div class="descuentoDesc input-group col-sm-5 " style="padding: 5px;">
              <span class="input-group-addon">
                <span class="text-info">Descuento:</span>
              </span>
              <input class="form-control" placeholder="Descuento" required="required" id="descuentoDesc" name="" type="number" min="0">
            </div>
          </div>
        </div>
        <div class="modal-footer" id="modalDescuentosFooter">
          <button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true" id="btn_CancelDescN">CANCELAR</button>
          <button type="button" id="btn_guardarDescuento" name="" value="Guardar" data-id="" data-cat="DescuentoCliente" class="enviarG  btn btn-success" >GUARDAR</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function () {
    var catalogo= '{{$catalogo}}';

    

                

//:::::::---- FUNCION PARA HABILITAR LOS CAMPOS A MODIFICAR ---::::::::::::::::::::::::::::::::::::://
    $(document).on('click', '.modificar', function(){
      catalogo = $(this).data('cat');
      switch (catalogo){
        case 'Almacen':
          $('#clave_'+$(this).data('id')).prop('disabled',false);
          $('#nombre_'+$(this).data('id')).prop('disabled',false);
          $('#status_'+$(this).data('id')).prop('disabled',false);
          $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
          break;
        /*case 'Cliente':
            $('#rfc_'+$(this).data('id')).prop('disabled',false);
            $('#usuario_id_'+$(this).data('id')).prop('disabled',false);
            $('#agente_id_'+$(this).data('id')).prop('disabled',false);
            $('#nivel_descuento_id_'+$(this).data('id')).prop('disabled',false);
            $('#nombre_'+$(this).data('id')).prop('disabled',false);
            $('#paterno_'+$(this).data('id')).prop('disabled',false);
            $('#materno_'+$(this).data('id')).prop('disabled',false);
            $('#nombre_comercial_'+$(this).data('id')).prop('disabled',false);
            $('#razon_social_'+$(this).data('id')).prop('disabled',false);
            $('#numero_'+$(this).data('id')).prop('disabled',false);
            $('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
          break*/
        case 'Comercializador':
            $('#nombre_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'FormaPago':
            $('#descripcion_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'NivelDescuento':
            $('#descripcion_'+$(this).data('id')).prop('disabled',false);
            $('#descuento_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'UnidadMedida':
            $('#descripcion_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'Rol':
            $('#nombre_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'TelefonoCliente':
            $('#telefono_'+$(this).data('id')).prop('disabled',false);
            $('#tipo_'+$(this).data('id')).prop('disabled',false);
            $('#estatusTel_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break; 

        case 'Pais':
            $('#pais_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;

        case 'Estados':
            $('#estado_'+$(this).data('id')).prop('disabled',false);
            $('#pais_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break;  

        case 'Municipios':
            $('#municipio_'+$(this).data('id')).prop('disabled',false);
            $('#estado_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break; 

        case 'TelefonoProveedor':
            $('#telefono_'+$(this).data('id')).prop('disabled',false);
            $('#tipo_'+$(this).data('id')).prop('disabled',false);
            $('#estatusTel_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
            break; 

        case 'Contacto':
          $('#nomProveedor_'+$(this).data('id')).prop('disabled',false);
          $('#correoProveedor_'+$(this).data('id')).prop('disabled',false);
          $('#estatusContacto_'+$(this).data('id')).prop('disabled',false);
          $('#btn_guardarContacto_'+$(this).data('id')).prop('disabled',false);
          break;

      }
    });

    function confirmar(){
      var respuesta=confirm('¿Estas seguro de guardar los datos? ');
      return respuesta;
    }

    function confirmarEliminar(){
      var respuesta= confirm('¿Estas seguro de eliminar este registro?');
      return respuesta;
    }
    

//::::::::---- FUNCION PARA ENVIAR LOS DATOS PARA ALMACENARLOS  ----:::::::::::::::::::::::::::\\
    $(document).on('click','.enviarG', function(){
        catalogo = $(this).data('cat');
        $(this).prop('disabled',true);
        //  alert(catalogo);
        var msg="";
        var validar = true;
        switch (catalogo) {   //------SWHITCH PARA VALIDAR QUE NO SE VAYA NINGUN CAMPO VACIO --------------------//
            case 'Almacen':
                var estatus=null;
                if ($('#status_'+$(this).data('id')).is(':checked')) {
                  estatus=1;
                }else{
                  estatus=0;
                }
                if ($('#clave_'+$(this).data('id')).val().trim() === ""){
                  msg += ';Ingrese la clave. ';
                  validar = false;
                }
                if ($('#nombre_'+$(this).data('id')).val().trim()==="") {
                  msg += ';Ingrese el nombre. ';
                  validar = false;
                };  
                break;

            case 'Cliente':
                  if ($('#nombre_'+$(this).data('id')).val().trim() === ""){
                    $('.nombre_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese nombre.';
                  validar = false;
                  }else{
                    $('.nombre_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($('#paterno_'+$(this).data('id')).val().trim() === ""){
                    $('.paterno_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese apellido paterno.';
                    validar = false;
                  }else{
                    $('.paterno_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($('#materno_'+$(this).data('id')).val().trim() === ""){
                    $('.materno_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese apellido materno.';
                    validar = false;
                  }else{
                    $('.materno_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($('#rfc_'+$(this).data('id')).val().trim() === ""){
                    $('.rfc_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese RFC.';
                    validar = false;
                  }else{
                    $('.rfc_'+$(this).data('id')).removeClass('has-error');
                  }
                 /* if ($('#nombre_comercial_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese el nombre comercial. \n';
                    validar = false;
                  }
                  if ($('#razon_social_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese razon social. \n';
                    validar = false;
                  }
                  /*if ($(this).data('info')=== 'Actualizar') {
                    if ($('#numeroCliente_'+$(this).data('id')).val() === ""){
                      msg += 'Ingrese el numero de cliente. \n';
                      validar = false;
                    }
                  }*/

                  if ($('#agenteCliente_'+$(this).data('id')).val().trim() === "-1"){
                    $('.agenteCliente_'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione un agente.';
                    validar = false;
                  }else{
                    $('.agenteCliente_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($('#descuento_'+$(this).data('id')).val().trim() <= "0"){
                    $('.descuento_'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione un descuento.';
                    validar = false;
                  }else{
                    $('.descuento_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($('#usuario_'+$(this).data('id')).val().trim() === ""){
                    $('.usuario_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese usuario.';
                    validar = false;
                  }else{
                    $('.usuario_'+$(this).data('id')).removeClass('has-error');
                  }
                  if ($(this).val()==="Guardar"){
                    if ($('#password_'+$(this).data('id')).val().trim() === ""){
                        $('.password_'+$(this).data('id')).addClass('has-error');
                        msg += ';Ingrese contraseña.';
                        validar = false;
                    }else{
                        $('.password_'+$(this).data('id')).removeClass('has-error');
                  }
                  }
                  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                  if (!regex.test( $('#email_'+$(this).data('id')).val().trim())) {
                    $('.email_'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese E-mail.';
                    validar = false;
                  }else{
                    $('.email_'+$(this).data('id')).removeClass('has-error');
                  }
                
                  break;
            
            case 'Comercializador':
                if ($('#nombre_'+$(this).data('id')).val().trim()==="") {
                  msg += 'Ingrese el nombre. \n';
                  validar = false;
                };  
                break;

            case 'FormaPago':
                if ($('#descripcion_'+$(this).data('id')).val().trim()==="") {
                  msg += 'Ingrese descripción. \n';
                  validar = false;
                };  
                break;

            case 'Pais':
                if ($('#pais_'+$(this).data('id')).val().trim()==="") {
                  msg += 'Ingrese el pais.';
                  validar = false;
                };  
                break;

            case 'Estados':
                if ($('#estado_'+$(this).data('id')).val().trim()==="") {
                  msg += ';Ingrese el estado.';
                  validar = false;
                };
                if ($('#pais_'+$(this).data('id')).val().trim()==="-1") {
                  msg += ';Ingrese el pais.';
                  validar = false;
                };
                break;

            case 'Municipios':
                if ($('#municipio_'+$(this).data('id')).val().trim() ==="") {
                  msg += ';Ingrese municipio.';
                  validar = false;
                };
                if ($('#estado_'+$(this).data('id')).val().trim() ==="-1") {
                  msg += ';Ingrese estado.';
                  validar = false;
                };
                break;

            case 'NivelDescuento':
                if ($('#descripcion_'+$(this).data('id')).val().trim()==="") {
                  msg += ';Ingrese la descripcion.';
                  validar = false;
                };  
                if ($('#descuento_'+$(this).data('id')).val().trim()==="") {
                  msg += ';Ingrese el descuento.';
                  validar = false;
                };  
                break;

            case 'UnidadMedida':
                if ($('#descripcion_'+$(this).data('id')).val().trim()==="") {
                  msg += 'Ingrese la descripcion.';
                  validar = false;
                };  
                break;

            case 'Rol':
                if ($('#nombre_'+$(this).data('id')).val().trim()==="") {
                  msg += 'Ingrese el nombre.';
                  validar = false;
                };  
                break;

            case 'TelefonoCliente':
                var estatus=null;
                if ($('#estatusTel_'+$(this).data('id')).is(':checked')) {
                  estatus=1;
                }else{
                  estatus=0;
                }
                if ($('#telefono_'+$(this).data('id')).val().trim().length!==10 && $('#telefono_'+$(this).data('id')).val().trim().length!==7){
                  msg += ';Ingrese el telefono.';
                  validar = false;
               
                }
                if ($('#tipo_'+$(this).data('id')).val()==="-1") {
                  msg += ';Seleccione el tipo de telefono.';
                  validar = false;
                };  

                break;

            case 'DireccionCliente':
                
                if ($('#calle1').val().trim() === ""){
                    msg += ';Ingrese calle1.';
                    validar = false;
                  }
                if ($('#calle2').val().trim() === ""){
                    msg += ';Ingrese calle2.';
                    validar = false;
                  }
                if ($('#colonia').val().trim() === ""){
                    msg += ';Ingrese la colonia.';
                    validar = false;
                  }
                if ($('#delegacion').val().trim() === ""){
                    msg += ';Ingrese la delegación.';
                    validar = false;
                  }
                if ($('#pais').val() === ""){
                    msg += ';Seleccione un pais.';
                    validar = false;
                  }
                if ($('#estado').val() === ""){
                    msg += ';Seleccione un estado.';
                    validar = false;
                  }
                if ($('#municipio').val() === ""){
                    msg += ';Seleccione un municipio.';
                    validar = false;
                  }
                if ($('#cp').val().trim() === "" || $('#cp').val().trim().length!==5){
                    msg += ';Ingrese el Código Postal.';
                    validar = false;
                  }
                if ($('#tipoDir').val() === ""){
                    msg += ';Seleccione el tipo de domicilio.';
                    validar = false;
                  }
                if ($('#telefonoDir').val() === "-1"){
                    msg += ';Seleccione un telefono.';
                    validar = false;
                  }
                break;

            case 'Proveedor':
                if ($('#nombre_'+$(this).data('id')).val().trim() === ""){
                   $('.nombre_'+$(this).data('id')).addClass('has-error');
                   msg += ';Ingrese nombre.';
                   validar = false;
                }else{
                  $('.nombre_'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#nombreComercial_'+$(this).data('id')).val().trim() === ""){
                  $('.nombreComercial_'+$(this).data('id')).addClass('has-error');
                  msg += ';Ingrese nombre comercial.';
                  validar = false;
                }else{
                  $('.nombreComercial_'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#razonSocial_'+$(this).data('id')).val().trim() === ""){
                  $('.razonSocial_'+$(this).data('id')).addClass('has-error');
                  msg += ';Ingrese razón social.';
                  validar = false;
                }else{
                    $('.razonSocial_'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#comercializador_'+$(this).data('id')).val().trim() === "-1"){
                    $('.comercializador_'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione un comercializador.';
                  validar = false;
                }else{
                    $('.comercializador_'+$(this).data('id')).removeClass('has-error');
                }
                break;

            case 'TelefonoProveedor':
                if ($('#telefono_'+$(this).data('id')).val().trim().length!==10 && $('#telefono_'+$(this).data('id')).val().trim().length!==7){
                  msg += ';Ingrese el telefono.';
                  validar = false;
                }
                if ($('#tipo_'+$(this).data('id')).val()==="-1") {
                  msg += ';Seleccione el tipo de telefono.';
                  validar = false;
                  };
                break;

            case 'DireccionProveedor':
                
                if ($('#calle1').val().trim() === ""){
                    msg += ';Ingrese calle1.';
                    validar = false;
                  }
                if ($('#calle2').val().trim() === ""){
                    msg += ';Ingrese calle2.';
                    validar = false;
                  }
                if ($('#colonia').val().trim() === ""){
                    msg += ';Ingrese la colonia.';
                    validar = false;
                  }
                if ($('#delegacion').val().trim() === ""){
                    msg += ';Ingrese la delegación.';
                    validar = false;
                  }
                if ($('#pais').val() === ""){
                    msg += ';Seleccione un pais.';
                    validar = false;
                  }
                if ($('#estado').val() === ""){
                    msg += ';Seleccione un estado.';
                    validar = false;
                  }
                if ($('#municipio').val() === ""){
                    msg += ';Seleccione un municipio.';
                    validar = false;
                  }
                if ($('#cp').val().trim() === "" || $('#cp').val().trim().length!==5){
                    msg += ';Ingrese el Código Postal.';
                    validar = false;
                  }
                if ($('#tipoDir').val() === ""){
                    msg += ';Seleccione el tipo de domicilio.';
                    validar = false;
                  }
                if ($('#telefonoDir').val() === "-1"){
                    msg += ';Seleccione un telefono.';
                    validar = false;
                  }
                break;

            case 'Contacto':
              if ($('#nomProveedor_'+$(this).data('id')).val().trim()==="") {
                  msg += ';Ingrese nombre.';
                  validar = false;
                  };
              var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
              if (!regex.test( $('#correoProveedor_'+$(this).data('id')).val().trim())) {
                  //$('.email_'+$(this).data('id')).addClass('has-error');
                  msg += ';Ingrese E-mail.';
                  validar = false;
              //  }else{
              //      $('.email_'+$(this).data('id')).removeClass('has-error');
                  }
              break;

            case 'DescuentoCliente':
              if ($('#descripcionDesc'+$(this).data('id')).val().trim() === ""){
                    $('.descripcionDesc'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese descripción.';
                  validar = false;
                  }else{
                    $('.descripcionDesc'+$(this).data('id')).removeClass('has-error');
                  }
              if ($('#descuentoDesc'+$(this).data('id')).val().trim() === ""){
                    $('.descuentoDesc'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese descuento.';
                  validar = false;
                  }else{
                    $('.descuentoDesc'+$(this).data('id')).removeClass('has-error');
                  }
              break;

            default:
                msg += ';No se ha validado ningun dato.';
                validar = false;
              break;

        }

        if(!validar){//------- PREGUNTA SI LAS VALIDACIONES SON INCORRECTAS MUESTRA UNA ADVERTENCIA CON LOS ERRORES ------------------//
         // alert(msg);
          var arreglo=msg.split(';'); //::- SEPARA LA CADENA DE TEXTO CADA QUE ENCUENTRA ";" 
          for (var i=0; i<arreglo.length;i++){
            if(arreglo[i]!==""){
              alertas('error',arreglo[i]);
            }
          }
          $(this).prop('disabled',false);
        }else {  //-- SI LAS VALIDACIONES SON CORRECTAS SE PROCEDE A RECOGER LOS DATOS A ENVIAR ---//
          if(confirmar()){

            switch (catalogo){ //--- SIWTCH PARA RECOGER LOS VALORES DEPENDIENDO DE EL ALMACEN DEL QUE SE TRATE  ---//

              case 'Almacen':
                var datos={
                    
                    clave   : $('#clave_'+$(this).data('id')).val().trim(),
                    nombre  : $('#nombre_'+$(this).data('id')).val().trim(),
                    estatus : estatus,
                    catalogo: catalogo,
                    tipoMov : $(this).val(),
                    id_upd  : $(this).data('id')
                };
                //alert('datos cargados: \n ' +datos['clave']+'\n ' +datos['nombre']+'\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
                break;

              case 'Cliente':
                  var datos = {
                    nombre              :   $('#nombre_'+$(this).data('id')).val().trim(),
                    paterno             :   $('#paterno_'+$(this).data('id')).val().trim(),
                    materno             :   $('#materno_'+$(this).data('id')).val().trim(),
                    rfc                 :   $('#rfc_'+$(this).data('id')).val().trim(),
                    nombre_comercial    :   $('#nombre_comercial_'+$(this).data('id')).val().trim(),
                    razon_social        :   $('#razon_social_'+$(this).data('id')).val().trim(),
                    //numeroCliente       :   $('#numeroCliente_'+$(this).data('id')).val(),
                    agente_id           :   $('#agenteCliente_'+$(this).data('id')).val().trim(),
                    nivel_descuento_id  :   $('#descuento_'+$(this).data('id')).val().trim(),
                    usuario             :   $('#usuario_'+$(this).data('id')).val().trim(),
                    usuario_id             :   $('#usuario_id_'+$(this).data('id')).val().trim(),
                    contraseña          :   $('#password_'+$(this).data('id')).val().trim(),
                    email               :   $('#email_'+$(this).data('id')).val().trim(),
                    catalogo            :   catalogo,
                    tipoMov             :   $(this).val(),
                    id_upd              :   $(this).data('id')
                  };
                  //alert('datos cargados: \n ' +datos['nombre']+'\n ' +datos['paterno']+'\n ' +datos['materno']+ '\n ' +datos['rfc']+'\n ' +datos['nombre_comercial']+'\n ' +datos['razon_social']+'\n ' +datos['agente_id']+ '\n ' +datos['nivel_descuento_id']+ '\n ' +datos['usuario']+ '\n '+datos['usuario_id']+ '\n ' +datos['contraseña']+ '\n ' +datos['email']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']);
                  break;

              case 'Comercializador':
                  var datos = {
                      nombre  : $('#nombre_'+$(this).data('id')).val().trim(),
                      catalogo: catalogo,
                      tipoMov : $(this).val(),
                      id_upd  : $(this).data('id')
                  };
                  break;

              case 'FormaPago':
                  var datos = {
                      descripcion  : $('#descripcion_'+$(this).data('id')).val().trim(),
                      catalogo: catalogo,
                      tipoMov : $(this).val(),
                      id_upd  : $(this).data('id')
                  };
                  break;

              case 'NivelDescuento':
                  var datos = {
                      descripcion   : $('#descripcion_'+$(this).data('id')).val().trim(),
                      descuento     : $('#descuento_'+$(this).data('id')).val().trim(),
                      estatus       : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                      catalogo      : catalogo,
                      tipoMov       : $(this).val(),
                      id_upd        : $(this).data('id')
                  }
                  break;

              case 'UnidadMedida':
                  var datos={
                      descripcion   : $('#descripcion_'+$(this).data('id')).val().trim(),
                      estatus       : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                      catalogo      : catalogo,
                      tipoMov       : $(this).val(),
                      id_upd        : $(this).data('id')
                  };
                  break;

              case 'Rol':
                  var datos = {
                      nombre        : $('#nombre_'+$(this).data('id')).val().trim(),
                      catalogo      : catalogo,
                      tipoMov       : $(this).val(),
                      id_upd        : $(this).data('id')
                  }
                  break;

              case 'TelefonoCliente':
                  var datos={
                    
                    numero    : $('#telefono_'+$(this).data('id')).val().trim(),
                    tipo      : $('#tipo_'+$(this).data('id')).val().trim(),
                    cliente_id: $('#id_Cliente').val().trim(),
                    estatus   : estatus,
                    catalogo  : catalogo,
                    tipoMov   : $(this).val(),
                    id_upd    : $(this).data('id')
                  };
                  alert('datos cargados: \n ' +datos['numero']+'\n ' +datos['tipo']+'\n ' +datos['cliente_id']+ '\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
                  break;
              
              case 'DireccionCliente':
                  
                  var datos={
                    
                    pais      : $('#pais').val().trim(),
                    estado      : $('#estado').val().trim(),
                    municipio      : $('#municipio').val().trim(),
                    calle1      : $('#calle1').val().trim(),
                    calle2      : $('#calle2').val().trim(),
                    colonia      : $('#colonia').val().trim(),
                    delegacion      : $('#delegacion').val().trim(),
                    cp      : $('#cp').val().trim(),
                    tipoDir :  $('#tipoDir').val().trim(),
                    estatus : (($('#estatusDirCliente').is(':checked')) ? '1' : '0'),
                    telefonoDir : $('#telefonoDir').val().trim(),
                  //tipo      : $('#tipo').val(),
                    cliente_id: $('#id_Cliente').val().trim(),
                  //  estatus   : estatus,
                    catalogo  : catalogo,
                    tipoMov   : $(this).val(),
                    id_upd    : $(this).data('id')
                  };
                  break;

              case 'DescuentoCliente':
                  var datos = {
                      descripcion   : $('#descripcionDesc'+$(this).data('id')).val().trim(),
                      descuento     : $('#descuentoDesc'+$(this).data('id')).val().trim(),
                     // estatus       : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                      catalogo      : catalogo,
                      tipoMov       : $(this).val(),
                     // id_upd        : $(this).data('id')
                  }
                  break;
            
              case 'Pais':
                var datos={
                    pais   : $('#pais_'+$(this).data('id')).val().trim(),
                    estatus : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo: catalogo,
                    tipoMov : $(this).val(),
                    id_upd  : $(this).data('id')
                };
                break;

              case 'Estados':
                var datos={
                    estado  : $('#estado_'+$(this).data('id')).val().trim(),
                    pais   : $('#pais_'+$(this).data('id')).val().trim(),
                    estatus : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo: catalogo,
                    tipoMov : $(this).val(),
                    id_upd  : $(this).data('id')
                };
                break;

              case 'Municipios':
                var datos={
                    municipio  : $('#municipio_'+$(this).data('id')).val().trim(),
                    estado   : $('#estado_'+$(this).data('id')).val().trim(),
                    estatus : (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo: catalogo,
                    tipoMov : $(this).val(),
                    id_upd  : $(this).data('id')
                };
                break;

              case 'Proveedor':
                  var datos = {
                    nombre             :   $('#nombre_'+$(this).data('id')).val().trim(),
                    nombreComercial    :   $('#nombreComercial_'+$(this).data('id')).val().trim(),
                    razonSocial        :   $('#razonSocial_'+$(this).data('id')).val().trim(),
                    comercializador    :   $('#comercializador_'+$(this).data('id')).val().trim(),
                    estatus            :   (($('#estatus_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo           :   catalogo,
                    tipoMov            :   $(this).val(),
                    id_upd             :   $(this).data('id')
                  };
                  break;
              
              case 'TelefonoProveedor':
                  var datos={
                    
                    numero      : $('#telefono_'+$(this).data('id')).val().trim(),
                    tipo        : $('#tipo_'+$(this).data('id')).val().trim(),
                    idProveedor : $('#id_Proveedor').val().trim(),
                    estatus     : (($('#estatusTel_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo    : catalogo,
                    tipoMov     : $(this).val(),
                    id_upd      : $(this).data('id')
                  };
                 // alert('datos cargados: \n ' +datos['numero']+'\n ' +datos['tipo']+'\n ' +datos['idProveedor']+ '\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
                  break;

              case 'DireccionProveedor':
                  var datos={
                    pais      : $('#pais').val().trim(),
                    estado      : $('#estado').val().trim(),
                    municipio      : $('#municipio').val().trim(),
                    calle1      : $('#calle1').val().trim(),
                    calle2      : $('#calle2').val().trim(),
                    colonia      : $('#colonia').val().trim(),
                    delegacion      : $('#delegacion').val().trim(),
                    cp      : $('#cp').val().trim(),
                    tipoDir :  $('#tipoDir').val().trim(),
                    estatus : (($('#estatusDirCliente').is(':checked')) ? '1' : '0'),
                    //telefonoDir : $('#telefonoDir').val().trim(),
                    idProveedor: $('#id_Proveedor').val().trim(),
                    catalogo  : catalogo,
                    tipoMov   : $(this).val(),
                    id_upd    : $(this).data('id')
                  };

              case 'Contacto':
                var datos={
                    
                    nombre      : $('#nomProveedor_'+$(this).data('id')).val().trim(),
                    correo        : $('#correoProveedor_'+$(this).data('id')).val().trim(),
                    idProveedor : $('#id_Proveedor').val().trim(),
                    estatus     : (($('#estatusContacto_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                    catalogo    : catalogo,
                    tipoMov     : $(this).val(),
                    id_upd      : $(this).data('id')
                  };
                break;



              default:
                break;

            }
            //alert($(this).val());
            if ($(this).val()==="Guardar") {
                $.ajax({    //--- INICIA LA CONEXION MEDIANTE AJAX ---//  
                  url: "/catalogo/create",
                  type: "POST",
                  data: datos,
                  success: function(respuesta){
                    console.log(respuesta);

                    switch (catalogo){    //--- SWTICH PARA LAS DIFERENTES ACCIONES QUE REALIZARA CON LOS DATOS OBTENIDOS, DEPENDIENDO DEL CATALOGO  ----/
                      case 'Almacen':
                        if (respuesta.estatus==1) {var activar="checked"};
                        var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td> <input type="text" name="clave_'+respuesta.id+'" value="'+respuesta.clave + '" id="clave_'+respuesta.id+'" disabled="disabled" required class="form-control">  </td>' +
                                      '<td> <input type="text" name="nombre_'+respuesta.id+'" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" required class="form-control">  </td>' +
                                      '<td><input type="checkbox" name="status_'+respuesta.id+'" value="'+respuesta.estatus+'"  id="status_'+respuesta.id+'" disabled="disabled" '+ activar+' class="checkbox"> </td>' +
                                      '<td>'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Almacen" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Almacen"class="enviarG btn btn-success"><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Almacen" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                          '</td>'+
                                   '</tr>';
                        $('#tablaResult').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                        $('#clave_0').val('');
                        $('#nombre_0').val('');
                        
                        break;
                      
                      case 'Cliente':
                          vistaDetalles(respuesta,'Actualizar');
                          //$("#contenido_esp").show();
                          $('#telefono_0').prop('disabled',false);
                          $('#tipo_0').prop('disabled',false);
                          $('#btn_guardarTel').prop('disabled',false);
                          $('#editDirCliente').prop('disabled',false);
                          $('#id_Cliente').val(respuesta.id);
                          break;

                      case 'TelefonoCliente':
                          var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td class="col-md-1"> <input type="text" value="'+respuesta.numero + '" id="telefono_'+respuesta.id+'" disabled="disabled" required class="form-control col-md-1">  </td>' +
                                      '<td class="col-md-1"> <select id="tipo_'+respuesta.id+'" name="" class="form-control options " value="" required disabled>' +
                                                      '<option value="Celular">Celular</option>' +
                                                      '<option value="Fijo">Fijo</option>' +
                                                      '<option value="Otro">Otro</option>' +
                                                    '</select></td>' +
                                      '<td ><input type="checkbox" value="'+respuesta.estatus+'"  id="estatusTel_'+respuesta.id+'" disabled="disabled" '+(respuesta.estatus===1 ? 'checked':'') +' > </td>' +
                                      '<td class="col-md-1">'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="TelefonoCliente" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="TelefonoCliente" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="TelefonoCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                   '</tr>';
                          $('#tbodyCliente').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                          $('#telefono_0').val('');
                          $('#tipo_0').val('');
                          $('#tipo_'+respuesta.id).val(respuesta.tipo_tel); 
                          $('#btn_guardarTel').prop('disabled',false);
                          break;

                      case 'DireccionCliente':
                          var trDir = '<tr id="trDir_'+respuesta.idDir+'">'+
                                             '<td >'+respuesta.pais+'</td>'+ 
                                             '<td >'+respuesta.estados+'</td>'+ 
                                             '<td >'+respuesta.municipio+'</td>'+ 
                                             '<td >'+respuesta.delegacion+'</td>'+ 
                                             '<td >'+respuesta.colonia+'</td>'+ 
                                             '<td >'+respuesta.calle1+'</td>'+ 
                                             '<td >'+respuesta.calle2+'</td>'+ 
                                             '<td >'+respuesta.codigo_postal+'</td>'+ 
                                             '<td >'+respuesta.tipo+'</td>'+ 
                                             '<td id="tdDir_'+respuesta.idDir+'"><input type="checkbox" id="estatusDir_'+respuesta.idDir+'" disabled value="'+respuesta.estatus+'" '+(respuesta.estatus=== 1 ? 'checked':'')+' ></td>'+ 
                                             '<td >'+
                                              '<button type="button" class="btn btn-primary" data-accion="Modificar" data-toggle="modal" data-id="'+respuesta.idCliente+'" value="" data-cat="TelefonoCliente" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                             '</td>'+
                                        '</tr>';
                                  $('#tbodyClienteDir').append(trDir);
                                  $('#myModal').modal('hide');
                          break;

                      case 'DescuentoCliente':

                        $('#descuento_'+$('#btn_guardar').data('id')).append('<option value="'+respuesta.id+'" selected>'+respuesta.descripcion+'</option>');
                        $('#modalDescuentos').modal('hide');
                        break;

                      case 'Comercializador':
                          var fila =  '<tr id="tr_'+respuesta.id+'">' +
                                        '<td> <input type="text" name="nombre_'+respuesta.id+'" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" class="form-control" required>  </td>' +
                                        '<td>'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar btn btn-primary" data-cat="Comercializador"><span class="glyphicon glyphicon-edit" ></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG btn btn-success" data-cat="Comercializador"><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Comercializador" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></button>'+
                                          '</td>'+
                                      '</tr>';
                          $('#tablaResult').append(fila);
                          $('#nombre_0').val('');
                          break;
                      
                      case 'NivelDescuento':
                          var fila =  '<tr id="tr_'+respuesta.id+'">' +
                                        '<td col-md-4 col-xs-5 col-sm-4> <input type="text" name="descripcion_'+respuesta.id+'" value="'+respuesta.descripcion+'" id="descripcion_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
                                        '<td col-md-2 col-xs-1 col-sm-2> <input type="text" name="descuento_'+respuesta.id+'" value="'+respuesta.descuento+'" id="descuento_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
                                        '<td col-md-2 col-xs-1 col-sm-2 style="text-align: center"> <input type="checkbox" value="'+respuesta.estatus+'"  id="estatus_'+respuesta.id+'" disabled="disabled" '+ ((respuesta.estatus==1) ?  'checked ':'')+' > </td>' +
                                        '<td col-md-4 col-xs-5 col-sm-4 style="text-align: center">'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar btn btn-primary" data-cat="NivelDescuento"><span class="glyphicon glyphicon-edit" ></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG btn btn-success" data-cat="NivelDescuento"><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="NivelDescuento" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></button>'+    
                                        '</td>'+
                                      '</tr>';
                          $('#tablaResult').append(fila);
                          $('#descripcion_0').val('');
                          $('#descuento_0').val('');
                          break;

                      case 'UnidadMedida':
                       var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td class="col-md-6 col-xs-6 col-sm-6"> <input type="text" value="'+respuesta.descripcion + '" id="descripcion_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
                                      '<td class="col-md-3 col-xs-1 col-sm-3" style="text-align: center"><input type="checkbox" value="'+respuesta.estatus+'"  id="estatus_'+respuesta.id+'" disabled="disabled" '+ ((respuesta.estatus==1) ?  'checked ':'')+' > </td>' +
                                      '<td class="col-md-3 col-xs-5 col-sm-3" style="text-align: center">'+
                                        '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar btn btn-primary" data-cat="UnidadMedida"><span class="glyphicon glyphicon-edit" ></span></button>'+
                                        '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG btn btn-success" data-cat="UnidadMedida"><span class="glyphicon glyphicon-">OK</span></button>'+
                                        '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="UnidadMedida" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></button>'+          
                                      '</td>'+
                                   '</tr>';
                        $('#tablaResult').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                        $('#descripcion_0').val('');
                        
                        
                        break;
                      
                      case 'Rol':
                          var fila =  '<tr id="tr_'+respuesta.id+'">' +
                                        '<td class="col-xs-6"> <input type="text" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
                                        '<td class="col-xs-6" style="text-align: center;">'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar btn btn-primary" data-cat="Rol"><span class="glyphicon glyphicon-edit" ></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG btn btn-success" data-cat="Rol"><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Rol" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span></button>'+          
                                        '</td>'+
                                      '</tr>';
                          $('#tablaResult').append(fila);
                          $('#nombre_0').val('');
                          break;

                      case 'Pais':
                          var fila =  '<tr id="tr_'+respuesta.id+'">'+
                                        '<td><input type="text" id="pais_'+respuesta.id+'" name="nombre_'+respuesta.id+'" value="'+respuesta.pais+'" disabled="disabled" class="form-control"></td>'+
                                        '<td><input type="checkbox" id="estatus_'+respuesta.id+'" name="" value="'+respuesta.estatus+'" '+ ((respuesta.estatus==1) ?  'checked ':'')+'  class="checkbox" disabled></td>'+
                                        '<td>'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Pais" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Pais" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Pais" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                      '</tr> ';
                          $('#tablaResult').append(fila);
                          $('#pais_0').val('');
                          break;

                      case 'Estados':
                          var fila =  '<tr id="tr_'+respuesta['estado'].id+'">'+
                                        '<td><input type="text" id="estado_'+respuesta['estado'].id+'" name="" value="'+respuesta['estado'].estados+'" disabled="disabled" class="form-control"></td>'+
                                        '<td><select id="pais_'+respuesta['estado'].id+'" name="" class="form-control" required disabled>'+
                                             '</select>'+ 
                                        '</td>'+
                                        '<td><input type="checkbox" id="estatus_'+respuesta['estado'].id+'" name="" value="'+respuesta['estado'].estatus+'" '+ ((respuesta['estado'].estatus==1) ?  'checked ':'')+'  class="checkbox" disabled></td>'+
                                        '<td>'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta['estado'].id+'" data-cat="Estados" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta['estado'].id+'" disabled="disabled" data-id="'+respuesta['estado'].id+'" data-cat="Estados" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta['estado'].id+'" data-cat="Estados" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                      '</tr> ';
                          $('#tablaResult').append(fila);
                          $('#estado_0').val('');
                          $('#pais_0').val('-1');
                          var option="";
                          $.each(respuesta['paises'],function(index,pais){
                             option += '<option value="'+pais.id+'" '+((estado.pais_id===pais.id) ? 'selected':'')+'>'+pais.pais+'</option>';
                          })
                          $('#pais_'+respuesta['estado'].id).html(option);
                          $('#pais_'+respuesta['estado'].id).val(respuesta['estado'].pais_id);
                          break; 

                      case 'Municipios':
                          var fila =  '<tr id="tr_'+respuesta['municipio'].id+'">'+
                                        '<td><input type="text" id="municipio_'+respuesta['municipio'].id+'" name="" value="'+respuesta['municipio'].municipio+'" disabled="disabled" class="form-control"></td>'+
                                        '<td><select id="estado_'+respuesta['municipio'].id+'" name="" class="form-control" required disabled>'+
                                             '</select>'+ 
                                        '</td>'+
                                        '<td><input type="checkbox" id="estatus_'+respuesta['municipio'].id+'" name="" value="'+respuesta['municipio'].estatus+'" '+ ((respuesta['municipio'].estatus==1) ?  'checked ':'')+'  class="checkbox" disabled></td>'+
                                        '<td>'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta['municipio'].id+'" data-cat="Municipios" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta['municipio'].id+'" disabled="disabled" data-id="'+respuesta['municipio'].id+'" data-cat="Municipios" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta['municipio'].id+'" data-cat="Municipios" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                      '</tr> ';
                          $('#tablaResult').append(fila);
                          $('#municipio_0').val('');
                          $('#estado_0').val('-1'); 
                          var option="";
                          $.each(respuesta['estados'],function(index,estado){
                            option += '<option value="'+estado.id+'" '+((municipio.estado_id === estado.id) ? 'selected':'')+'>'+estado.estados+'</option>';
                          })
                          $('#estado_'+respuesta['municipio'].id).html(option);
                          $('#estado_'+respuesta['municipio'].id).val(respuesta['municipio'].estado_id);
                          break; 

                      case 'Proveedor':
                          vistaDetalles(respuesta,'Actualizar');
                          $('#telefono_0').prop('disabled',false);
                          $('#tipo_0').prop('disabled',false);
                          $('#btn_guardarTel').prop('disabled',false);
                          $('#editDirCliente').prop('disabled',false);
                          $('#id_Proveedor').val(respuesta.idProveedor);
                          //$('#proveedor_0').prop('disabled',false);
                          $('#nomProveedor_0').prop('disabled',false);
                          $('#correoProveedor_0').prop('disabled',false);
                          $('#btn_guardarContacto').prop('disabled',false);
                          break;

                      case 'TelefonoProveedor':
                          var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td class="col-md-1"> <input type="text" value="'+respuesta.numero + '" id="telefono_'+respuesta.id+'" disabled="disabled" required class="form-control col-md-1">  </td>' +
                                      '<td class="col-md-1"> <select id="tipo_'+respuesta.id+'" name="" class="form-control options " value="" required disabled>' +
                                                      '<option value="Celular">Celular</option>' +
                                                      '<option value="Fijo">Fijo</option>' +
                                                      '<option value="Otro">Otro</option>' +
                                                    '</select></td>' +
                                      '<td ><input type="checkbox" value="'+respuesta.estatus+'"  id="estatusTel_'+respuesta.id+'" disabled="disabled" '+(respuesta.estatus===1 ? 'checked':'') +' > </td>' +
                                      '<td class="col-md-1">'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="TelefonoProveedor" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="TelefonoProveedor" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="TelefonoProveedor" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                   '</tr>';
                          $('#tbodyCliente').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                          $('#telefono_0').val('');
                          $('#tipo_0').val('');
                          $('#tipo_'+respuesta.id).val(respuesta.tipo_tel); 
                          $('#btn_guardarTel').prop('disabled',false);
                          break;

                      case 'DireccionProveedor':
                          var trDir = '<tr id="trDir_'+respuesta.idDir+'">'+
                                             '<td >'+respuesta.pais+'</td>'+ 
                                             '<td >'+respuesta.estados+'</td>'+ 
                                             '<td >'+respuesta.municipio+'</td>'+ 
                                             '<td >'+respuesta.delegacion+'</td>'+ 
                                             '<td >'+respuesta.colonia+'</td>'+ 
                                             '<td >'+respuesta.calle1+'</td>'+ 
                                             '<td >'+respuesta.calle2+'</td>'+ 
                                             '<td >'+respuesta.codigo_postal+'</td>'+ 
                                             '<td >'+respuesta.tipo+'</td>'+ 
                                             '<td id="tdDir_'+respuesta.idDir+'"><input type="checkbox" id="estatusDir_'+respuesta.idDir+'" disabled value="'+respuesta.estatus+'" '+(respuesta.estatus=== 1 ? 'checked':'')+' ></td>'+ 
                                             '<td >'+
                                              '<button type="button" class="btn btn-primary" data-accion="Modificar" data-toggle="modal" data-id="'+respuesta.idProveedor+'" value="" data-cat="TelefonoProveedor" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                             '</td>'+
                                        '</tr>';
                                  $('#tbodyClienteDir').append(trDir);
                                  $('#myModal').modal('hide');
                          break;

                      case 'Contacto':
                          var fila =  '<tr id="trContacto_'+respuesta.idContacto+'">'+
                                        '<td class="col-xs-3"><input type="text" onkeyup="" id="nomProveedor_'+respuesta.idContacto+'"  value="'+respuesta.nombre+'" class="form-control" disabled> </td>'+
                                        '<td class="col-xs-3"><input type="email" onkeyup="" id="correoProveedor_'+respuesta.idContacto+'"  value="'+respuesta.correo+'" class="form-control" disabled> </td>'+
                                        '<td class="col-xs-1"><input type="checkbox" id="estatusContacto_'+respuesta.idContacto+'"  value=""  '+(respuesta.estatus===1 ? 'checked':'')+' disabled></td>'+
                                        '<td class="col-xs-3">'+
                                          '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.idContacto+'" data-cat="Contacto" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                          '<button type="button" value="Actualizar" id="btn_guardarContacto_'+respuesta.idContacto+'" disabled="disabled" data-id="'+respuesta.idContacto+'" data-cat="Contacto" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                          '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.idContacto+'" data-cat="Contacto" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                        '</td>'+
                                      '</tr>';
                            $('#tbodyContacto').append(fila);
                            $('#nomProveedor_0').val('');
                            $('#correoProveedor_0').val('');
                            $('#btn_guardarContacto').prop('disabled',false);
                          break;

                    }
                    alertas('success',"Datos almacenados correctamente");
                    $('#btn_guardar').prop('disabled',false);
                    
                  },
                  error: function(msgError){
                    console.log(msgError.responseText);

                    var arreglo=msgError.responseText.split(';');
                    for (var i=0; i<arreglo.length;i++){
                      if(arreglo[i]!=='' && arreglo[i]!=="\""){
                        alertas('error',arreglo[i]);
                      }
                    }
                    //$('#btn_guardar').prop('disabled',false);
                    switch (catalogo){
                      case 'TelefonoCliente':
                          $('#btn_guardarTel').prop('disabled',false);
                        break;
                      case 'TelefonoProveedor':
                          $('#btn_guardarTel').prop('disabled',false);
                        break;

                      case 'Contacto':
                          $('#btn_guardarContacto').prop('disabled',false);
                        break;

                      case 'DescuentoCliente':
                          $('#btn_guardarDescuento').prop('disabled',false);
                        break;

                      default:
                        $('#btn_guardar').prop('disabled',false);
                        break;
                    }
                  }

                });
            }else if($(this).val()==="Actualizar"){
                
                var id_upd= $(this).data('id');
               // alert($(this).val() + id_upd);
                $.ajax({
                    url:  "/catalogo/update/"+id_upd,
                    type: "PUT",
                    data: datos,
                    success: function (respuesta){
                      console.log(respuesta);
                      switch (catalogo){
                        case 'Almacen':
                         //   if (respuesta.estatus==1) {var activar="checked"};
                         //   $('#clave_'+respuesta.id).val(respuesta.clave);
                         //   $('#nombre_'+respuesta.id).val(respuesta.nombre);
                            $('#clave_'+respuesta.id).prop('disabled',true);
                            $('#nombre_'+respuesta.id).prop('disabled',true);
                         //   if (respuesta.estatus==1) { $('#status_'+respuesta.id).prop('checked',true); }else{ $('#status_'+respuesta.id).prop('checked',false); } 
                            $('#status_'+respuesta.id).prop('disabled',true);
                            $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                          break;

                        case 'Cliente':
                            //vistaDetalles(respuesta,'Actualizar');
                            $('#btn_guardar').prop('disabled',false);
                            //$("#contenido_esp").show();    
                            break;

                        case 'TelefonoCliente':
                            $('#telefono_'+id_upd).prop('disabled',true);
                            $('#tipo_'+id_upd).prop('disabled',true);
                            $('#estatusTel_'+id_upd).prop('disabled',true);
                            $('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'Comercializador':
                            $('#nombre_'+respuesta.id).val(respuesta.nombre);
                            $('#nombre_'+respuesta.id).prop('disabled',true);
                            $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                            break;

                        case 'NivelDescuento':
                            $('#descripcion_'+id_upd).prop('disabled',true);
                            $('#descuento_'+id_upd).prop('disabled',true);
                            //$('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'UnidadMedida':
                            $('#descripcion_'+id_upd).prop('disabled',true);
                            $('#estatus_'+id_upd).prop('disabled',true);
                            //$('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'Rol':
                            $('#nombre_'+id_upd).prop('disabled',true);
                           // $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                            break;

                        case 'DireccionCliente':
                          var trDir =   '<td >'+respuesta.pais+'</td>'+ 
                                        '<td >'+respuesta.estados+'</td>'+ 
                                        '<td >'+respuesta.municipio+'</td>'+ 
                                        '<td >'+respuesta.delegacion+'</td>'+ 
                                        '<td >'+respuesta.colonia+'</td>'+ 
                                        '<td >'+respuesta.calle1+'</td>'+ 
                                        '<td >'+respuesta.calle2+'</td>'+ 
                                        '<td >'+respuesta.codigo_postal+'</td>'+ 
                                        '<td >'+respuesta.tipo+'</td>'+ 
                                        '<td ><input type="checkbox" id="estatusDir_'+respuesta.idDir+'" disabled value="'+respuesta.estatus+'" '+(respuesta.estatus=== 1 ? 'checked':'')+ ' ></td>'+ 
                                        '<td >'+
                                          '<button type="button" class="btn btn-primary" data-accion="Modificar" data-toggle="modal" data-id="'+respuesta.idCliente+'" value="" data-cat="TelefonoCliente" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                        '</td>';
                                        
                                  $('#trDir_'+respuesta.idDir).html(trDir);
                                  $('#myModal').modal('hide');
                          break;

                        case 'Pais':
                            $('#pais_'+id_upd).prop('disabled',true);
                            $('#estatus_'+id_upd).prop('disabled',true);
                            $('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'Estados':
                            $('#estado_'+id_upd).prop('disabled',true);
                            $('#pais_'+id_upd).prop('disabled',true);
                            $('#estatus_'+id_upd).prop('disabled',true);
                            $('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'Municipios':
                            $('#municipio_'+id_upd).prop('disabled',true);
                            $('#estado_'+id_upd).prop('disabled',true);
                            $('#estatus_'+id_upd).prop('disabled',true);
                            $('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'Proveedor':
                            //vistaDetalles(respuesta,'Actualizar');
                            $('#btn_guardar').prop('disabled',false);
                            break;

                        case 'TelefonoProveedor':
                            $('#telefono_'+id_upd).prop('disabled',true);
                            $('#tipo_'+id_upd).prop('disabled',true);
                            $('#estatusTel_'+id_upd).prop('disabled',true);
                            $('#btn_guardar_'+id_upd).prop('disabled',true);
                            break;

                        case 'DireccionProveedor':
                          var trDir = '<td >'+respuesta.pais+'</td>'+ 
                                      '<td >'+respuesta.estados+'</td>'+ 
                                      '<td >'+respuesta.municipio+'</td>'+ 
                                      '<td >'+respuesta.delegacion+'</td>'+ 
                                      '<td >'+respuesta.colonia+'</td>'+ 
                                      '<td >'+respuesta.calle1+'</td>'+ 
                                      '<td >'+respuesta.calle2+'</td>'+ 
                                      '<td >'+respuesta.codigo_postal+'</td>'+ 
                                      '<td >'+respuesta.tipo+'</td>'+ 
                                      '<td ><input type="checkbox" id="estatusDir_'+respuesta.idDir+'" disabled value="'+respuesta.estatus+'" '+(respuesta.estatus=== 1 ? 'checked':'')+' ></td>'+ 
                                      '<td >'+
                                        '<button type="button" class="btn btn-primary" data-accion="Modificar" data-toggle="modal" data-id="'+respuesta.idProveedor+'" value="" data-cat="TelefonoProveedor" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                      '</td>';
                                       // '</tr>';
                                  $('#trDir_'+respuesta.idDir).html(trDir);
                                  $('#myModal').modal('hide');
                          break;

                        case 'Contacto':
                          $('#nomProveedor_'+id_upd).prop('disabled',true);
                          $('#correoProveedor_'+id_upd).prop('disabled',true);
                          $('#estatusContacto_'+id_upd).prop('disabled',true);
                          $('#btn_guardarContacto_'+id_upd).prop('disabled',true);
                          break;

                      }
                      alertas('success',"Datos actualizados correctamente");

                    },
                    error: function(msgError){
                      console.log(msgError);
                     
                       var arreglo=msgError.responseText.split(';');
                      for (var i=0; i<arreglo.length;i++){
                        if(arreglo[i]!=='' && arreglo[i]!=="\""){
                          alertas('error',arreglo[i]);
                        }
                      }
                      //$(this).prop('disabled',false);
                      
                      switch (catalogo){
                        case 'TelefonoCliente':
                            $('#btn_guardarTel').prop('disabled',false);
                          break;
                        case 'TelefonoProveedor':
                            $('#btn_guardarTel').prop('disabled',false);
                          break;

                        case 'Contacto':
                            $('#btn_guardarContacto_'+id_upd).prop('disabled',false);
                          break;

                      default:
                        $('#btn_guardar').prop('disabled',false);
                        $('#btn_guardar_'+id_upd).prop('disabled',false);
                        break;
                    }
                    }

                  });
            }

          }else{$(this).prop('disabled',false);} 
        }

    });


//::::::::::::::::::::::-----  ELIMINAR  ----::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://   
    $(document).on('click','#btn_Eliminar', function(){ 
      catalogo = $(this).data('cat');
      var id_Elim= $(this).data('id');
    //  alert(id_Elim+ " " + catalogo);
      if(confirmarEliminar()){
          $.ajax({
            url: "/catalogo/destroy/" + id_Elim,
            type: "DELETE",
            data: {catalogo: catalogo},
            success: function(respuesta){
              alertas('success',"Registro eliminado");
              
              switch (catalogo){
                  case 'DireccionCliente':
                      $('#estatusDir_'+id_Elim).prop('checked',(datos.estatus===1 ? 'checked' : ''));
                    break;

                  case 'Contacto':
                    $('#trContacto_'+id_Elim).remove(); 
                    break;

                  default:
                    $('#tr_'+id_Elim).remove(); 
                    break;
              }
            },
            error: function(respuesta){
              console.log(respuesta);
              alertas('error',"Registro no eliminado");
              //alert('no eliminado \n ' + respuesta.responseText);
            }
          });
        }
    });

//::::::::::::::::::---     FUNCION PARA MOSTRAR LA FORMA EDITAR  ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
    $(document).on('click', '#editarClienteProveedor', function () {
            $("#catalogo_principal").empty();
            var obj = $(this).data('info');
            vistaDetalles(obj,'Actualizar');
            $("#contenido_esp").show();
            $('#id_'+$(this).data('cat')).val(obj.id);  //ASIGNA EL ID DEL CLIENTE O PROVEEDOR, DEPENDIENDO DEL CATALOGO
            
        });

//:::::::::::::::::::-----  FUNCION PARA MOSTRAR LA FORMA NUEVO   ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
    $(document).on('click','#nuevo',function(){
          $("#catalogo_principal").empty();
            var obj =null;
            vistaDetalles(obj,'Guardar');
            $("#contenido_esp").show();
            $('#telefono_0').prop('disabled',true);
            $('#tipo_0').prop('disabled',true);
            //$('#estatusTel_0').prop('disabled',true);
            $('#btn_guardarTel').prop('disabled',true);
            $('#editDirCliente').prop('disabled',true);
            if ($(this).data('cat')==="Proveedor") {
              $('#proveedor_0').prop('disabled',true);
              $('#nomProveedor_0').prop('disabled',true);
              $('#correoProveedor_0').prop('disabled',true);
              $('#btn_guardarContacto').prop('disabled',true);
            };
    });
//:::::::::::::::::::----- FUNCION PARA EL CONTENIDO DE LOS TAB  ----:::::::::::::::::::::::::::::::::::::::::::::::::::::://
    function vistaDetalles(obj,tipoMovimiento){
        switch (catalogo){
                case 'Cliente':
                    var cont= '<div class="row">'+
                                '<div class="col-sm-3 nombre_'+(obj === null ? '0' : obj.id)+' " for="">'+
                                  '<label> NOMBRE:  </label>'+
                                  '<input type="text" id="nombre_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.nombre_cliente)+'" class="form-control nomCl"></td>'+
                                '</div>'+
                                '<div class="col-sm-3 paterno_'+(obj === null ? 0 : obj.id)+'">'+
                                  '<label> PATERNO:  </label>'+
                                  '<input type="text" id="paterno_'+(obj === null ? 0 : obj.id)+'" value="'+(obj === null ? '' : obj.paterno)+'" class="form-control"></td></p>'+
                                '</div>'+
                                '<div class="col-sm-3 materno_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> MATERNO:  </label>'+
                                  '<p><input type="text" id="materno_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.materno)+'" class="form-control">'+
                                '</div>'+
                               '</div>'+
                              '<div class="row">'+
                                '<div class=" col-sm-3 rfc_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> RCF:  </label>'+
                                  '<input type="text" id="rfc_'+(obj === null ? '0' : obj.id)+'"  value="'+(obj === null ? '' : obj.rfc)+'" class="form-control">'+
                                '</div>'+
                                '<div class=" col-sm-3 nombre_comercial_'+(obj === null ? '0' : obj.id)+'" >'+
                                  '<label> NOMBRE COMERCIAL:  </label>'+
                                  '<input type="text" id="nombre_comercial_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.nombre_comercial)+'" class="form-control"></td>'+
                                '</div>'+
                                '<div class=" col-sm-3 razon_social_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> RAZON SOCIAL:  </label>'+
                                  '<input type="text" id="razon_social_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.razon_social)+'" class="form-control"></td>  </p> '+
                                '</div>'+
                              '</div>'+
                              '<div class="row">'+
                                '<div class=" col-sm-3">'+
                                  '<label> NUMERO DE CLIENTE:  </label>'+
                                  '<input type="text" id="numeroCliente_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.numero_cliente)+'" class="form-control" readonly></td>  </p> '+
                                '</div>'+
                                '<div class="col-sm-3 agenteCliente_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> AGENTE:  </label><br>'+
                                '<select id="agenteCliente_'+(obj === null ? '0' : obj.id)+'" name="" class="form-control input-default" value="" required>' +
                                '</select>' +
                                '</div>'+
                                '<div class=" col-sm-3 descuento_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> DESCUENTO:  </label><br>'+
                                  '<select id="descuento_'+(obj === null ? '0' : obj.id)+'" name="" data-valAct="'+(obj === null ? '-1' : obj.idDescuento)+'" class="form-control input-default" required onchange="($(this).val()===\'-2\' ? abrirModalDesc($(this).data(\'valact\'),$(\'#id_Cliente\').val()):\'\')">' +
                                  '</select>' +
                                '</div>'+
                              '</div>'+  
                              '<div class="row">'+
                                '<div class="col-sm-3 usuario_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> USUARIO:  </label>'+
                                  '<input type="text" id="usuario_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.usuario)+'" class="form-control" ></td>'+
                                  '<input type="hidden" id="usuario_id_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.idUsuario)+'" name="">'+  
                                '</div>'+
                                '<div class="col-sm-3 password_'+(obj === null ? '0' : obj.id)+'">'+
                                  (obj===null ? '<label> CONTRASEÑA:  </label>':'<button type="button" class="btn-link" id="nuevaPass" data-id="'+obj.id+'">NUEVA CONTRASEÑA</button>')+   
                                  '<input type="password" id="password_'+(obj === null ? '0' : obj.id)+'" value="" placeholder="Unicamente nueva contraseña" class="form-control" '+(obj===null ? '':'disabled')+'></td>'+
                                '</div>'+
                                '<div class="col-sm-3 email_'+(obj === null ? '0' : obj.id)+'">'+
                                  '<label> EMAIL:  </label>'+
                                  '<input type="email" name="email"  id="email_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.email)+'" class="form-control" ></td>'+
                                '</div>'+
                              '</div>'+
                              '<div class="row">'+
                                '<div class="form-action col-sm-offset-9">'+     
                                  '<button type="button" id="btn_guardar" name="btn_guardar" value="'+tipoMovimiento+'" data-id="'+(obj === null ? '0' : obj.id)+'" data-info="" data-cat="Cliente" class="enviarG btn btn-success"><span class="glyphicon glyphicon-">OK</span></button></td>'+
                                '</div>'+
                              '</div>';

                    $('#addform').html(cont);
                    
                    var datos=obtenerElementos('agentes',null);
                    datos.done(function(respuesta){
                                  var agente=(obj === null ? '<option value="-1">--Selecione un agente--</option>'  : '<option value="'+obj.idAgente+'">'+obj.agente+'</option>');
                                  $.each(respuesta, function(index, respuesta){
                                      console.log(respuesta);
                                      if( respuesta.id!=(obj === null ? '0' : obj.idAgente) ){
                                      agente += '<option value="'+respuesta.id+'">'+respuesta.usuario+'</option>'; 
                                      }
                                    });
                                  $('#agenteCliente_'+(obj === null ? '0' : obj.id)).append(agente);
                              });
                    datos=obtenerElementos('descuentoCliente',null);
                    datos.done(function(respuesta){
                                  var descuento=(obj === null ? '<option value="-1">--Selecione descuento--</option>'  : '<option value="'+obj.idDescuento+'">'+obj.descripcion+'</option>');
                                  $.each(respuesta, function(index, respuesta){
                                      console.log(respuesta);
                                      if( respuesta.id!=(obj === null ? '0' : obj.idDescuento) ){
                                      descuento += '<option value="'+respuesta.id+'">'+respuesta.descripcion+'</option>'; 
                                      }
                                    });
                                  descuento += '<option value="-2">Otro</option>'; 
                                  $('#descuento_'+(obj === null ? '0' : obj.id)).append(descuento);
                              });

                    if (obj) { //:::::--- EN CASO DE SER UN CLIENTE YA REGISTRADO PROCEDE A CONSULTAR TODOS LOS DATOS EXISTENTES ---:::::\\
                      datos=obtenerElementos('tabCliente',obj.id);
                      datos.done(function(respuesta){
                                  console.log(respuesta);
                                  //var trTel="";
                                  $.each(respuesta['telefonoCliente'], function(index, telefono){
                                      //console.log(telefono);
                                      var trTel =  '<tr id="tr_'+telefono.idTel+'">'+
                                                '<td class="col-xs-4">'+
                                                  '<input type="text" id="telefono_'+telefono.idTel+'"  value="'+telefono.numero+'" class="form-control col-md-1" disabled>'+
                                                 '</td>'+ 
                                                 '<td class="col-xs-3">'+
                                                   '<select id="tipo_'+telefono.idTel+'" name="" class="form-control options " value="" required disabled>' +
                                                      '<option value="Celular">Celular</option>' +
                                                      '<option value="Fijo">Fijo</option>' +
                                                      '<option value="Otro">Otro</option>' +
                                                    '</select>' +
                                                 '</td>'+ 
                                                 '<td class="col-xs-2"><input type="checkbox" id="estatusTel_'+telefono.idTel+'"  value="'+telefono.estatus+'" '+(telefono.estatus=== 1 ? 'checked':'')+ ' disabled></td>'+
                                                 '<td class="col-xs-3">'+
                                                  '<button type="button" value="Modificar" id="btn_mod" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                                  '<button type="button" value="Actualizar" id="btn_guardar_'+telefono.idTel+'" disabled="disabled" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                                  '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                                '</td>'+
                                              '</tr>';
                                      $('#tbodyCliente').append(trTel);
                                      $('#tipo_'+telefono.idTel).val(telefono.tipo_tel);         
                                    });
                                
                                  var trDir="";
                                  $.each(respuesta['dirCliente'], function(index, direccion){
                                      //console.log(direccion);
                                      trDir += '<tr id="trDir_'+direccion.idDir+'">'+
                                             '<td >'+direccion.pais+'</td>'+ 
                                             '<td >'+direccion.estados+'</td>'+ 
                                             '<td >'+direccion.municipio+'</td>'+ 
                                             '<td >'+direccion.delegacion+'</td>'+ 
                                             '<td >'+direccion.colonia+'</td>'+ 
                                             '<td >'+direccion.calle1+'</td>'+ 
                                             '<td >'+direccion.calle2+'</td>'+ 
                                             '<td >'+direccion.codigo_postal+'</td>'+ 
                                             '<td >'+direccion.tipo+'</td>'+ 
                                             '<td ><input type="checkbox" id="estatusDir_'+direccion.idDir+'" disabled value="'+direccion.estatus+'" '+(direccion.estatus=== 1 ? 'checked':'')+ ' ></td>'+ 
                                             '<td >'+
                                              '<button type="button" class="btn btn-primary" data-accion="Modificar" data-id="'+(obj === null ? '' : obj.id)+'" data-toggle="modal" value="" data-cat="TelefonoCliente" data-info=\''+JSON.stringify(direccion)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '</td>'+
                                           '</tr>';
                                          
                                    });
                                  $('#tbodyClienteDir').html(trDir);
                              });
                      
                    }

                    //console.log(obj);
                  break;
                case 'Proveedor':
                    var contenido = '<div class="row">'+
                                      '<div class="col-sm-3 nombre_'+(obj === null ? '0' : obj.id)+' " for="">'+
                                        '<label> NOMBRE:  </label>'+
                                        '<input type="text" id="nombre_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.nombre)+'" class="form-control nomCl"></td>'+
                                      '</div>'+
                                      '<div class="col-sm-3 nombreComercial_'+(obj === null ? 0 : obj.id)+'">'+
                                        '<label> NOMBRE COMERCIAL:  </label>'+
                                        '<input type="text" id="nombreComercial_'+(obj === null ? 0 : obj.id)+'" value="'+(obj === null ? '' : obj.nombre_comercial)+'" class="form-control"></td></p>'+
                                      '</div>'+
                                      '<div class="col-sm-3 razonSocial_'+(obj === null ? '0' : obj.id)+'">'+
                                        '<label> RAZÓN SOCIAL:  </label>'+
                                        '<p><input type="text" id="razonSocial_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.razon_social)+'" class="form-control">'+
                                      '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                      '<div class=" col-sm-3 comercializador_'+(obj === null ? '0' : obj.id)+'">'+
                                        '<label> COMERCIALIZADOR:  </label>'+
                                        '<select id="comercializador_'+(obj === null ? '0' : obj.id)+'" name="" class="form-control input-default" value="" required>' +
                                        '</select>' +
                                      '</div>'+
                                      '<div class=" col-sm-1 estatus_'+(obj === null ? '0' : obj.id)+'" >'+
                                        '<label> ESTATUS:  </label>'+
                                        '<input type="checkbox" id="estatus_'+(obj === null ? '0' : obj.id)+'" value="" class="form-control" '+((!obj) ? 'checked disabled' : (obj.estatus === 1 ? 'checked': ''))+'></td>'+
                                      '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                      '<div class="form-action col-sm-offset-8">'+     
                                        '<button type="button" id="btn_guardar" name="btn_guardar" value="'+tipoMovimiento+'" data-id="'+(obj === null ? '0' : obj.id)+'" data-info="" data-cat="Proveedor" class="enviarG btn btn-success"><span class="glyphicon glyphicon-">GUARDAR</span></button></td>'+
                                      '</div>'+
                                    '</div>';

                    $('#addform').html(contenido);  
                    var comercializadores = obtenerElementos('Comercializador',null); //::-AQUI SE OBTIENE LA LISTA DE COMERCIALIZADORES 
                    comercializadores.done(function(respuesta){                       //::-QUE ESTAN REGISTRADOS
                      console.log(respuesta);
                      var optionComer = (obj === null ? '<option value="-1">--Selecione un comercializador--</option>'  : '');
                      $.each(respuesta,function(index,comercializador){
                        optionComer += '<option value="'+comercializador.id+'" >'+comercializador.nombre+'</option>';
                      });
                      $('#comercializador_'+(obj === null ? '0' : obj.id)).html(optionComer); 
                      $('#comercializador_'+(obj === null ? '0' : obj.id)).val(((!obj) ? '-1' : obj.idComercializador));
                    });
     
                    $('#myTab').removeClass('two-tabs');
                    $('#myTab').addClass('three-tabs');
                    //console.log(obj);
                    if (obj) { //:::::--- EN CASO DE SER UN PROVEEDOR YA REGISTRADO PROCEDE A CONSULTAR TODOS LOS DATOS EXISTENTES ---:::::\\
                      datos=obtenerElementos('tabProveedor',obj.id);
                      datos.done(function(respuesta){
                                  console.log(respuesta);
                                  //var trTel="";
                                  $.each(respuesta['telefonoProveedor'], function(index, telefono){
                                      //console.log(telefono);
                                      var trTel =  '<tr id="tr_'+telefono.idTel+'">'+
                                                '<td class="col-xs-4">'+
                                                  '<input type="text" id="telefono_'+telefono.idTel+'"  value="'+telefono.numero+'" class="form-control col-md-1" disabled>'+
                                                 '</td>'+ 
                                                 '<td class="col-xs-3">'+
                                                   '<select id="tipo_'+telefono.idTel+'" name="" class="form-control options " value="" required disabled>' +
                                                      '<option value="Celular">Celular</option>' +
                                                      '<option value="Fijo">Fijo</option>' +
                                                      '<option value="Otro">Otro</option>' +
                                                    '</select>' +
                                                 '</td>'+ 
                                                 '<td class="col-xs-2"><input type="checkbox" id="estatusTel_'+telefono.idTel+'"  value="'+telefono.estatus+'" '+(telefono.estatus=== 1 ? 'checked':'')+ ' disabled></td>'+
                                                 '<td class="col-xs-3">'+
                                                  '<button type="button" value="Modificar" id="btn_mod" data-id="'+telefono.idTel+'" data-cat="TelefonoProveedor" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                                  '<button type="button" value="Actualizar" id="btn_guardar_'+telefono.idTel+'" disabled="disabled" data-id="'+telefono.idTel+'" data-cat="TelefonoProveedor" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                                  '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+telefono.idTel+'" data-cat="TelefonoProveedor" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                                '</td>'+
                                              '</tr>';
                                      $('#tbodyCliente').append(trTel);
                                      $('#tipo_'+telefono.idTel).val(telefono.tipo_tel);         
                                    });
                                
                                  var trDir="";
                                  $.each(respuesta['dirProveedor'], function(index, direccion){
                                      //console.log(direccion);
                                      trDir += '<tr id="trDir_'+direccion.idDir+'">'+
                                             '<td >'+direccion.pais+'</td>'+ 
                                             '<td >'+direccion.estados+'</td>'+ 
                                             '<td >'+direccion.municipio+'</td>'+ 
                                             '<td >'+direccion.delegacion+'</td>'+ 
                                             '<td >'+direccion.colonia+'</td>'+ 
                                             '<td >'+direccion.calle1+'</td>'+ 
                                             '<td >'+direccion.calle2+'</td>'+ 
                                             '<td >'+direccion.codigo_postal+'</td>'+ 
                                             '<td >'+direccion.tipo+'</td>'+ 
                                             '<td ><input type="checkbox" id="estatusDir_'+direccion.idDir+'" disabled value="'+direccion.estatus+'" '+(direccion.estatus=== 1 ? 'checked':'')+ ' ></td>'+ 
                                             '<td >'+
                                              '<button type="button" class="btn btn-primary" data-accion="Modificar" data-id="'+(obj === null ? '' : obj.id)+'" data-toggle="modal" value="" data-cat="TelefonoProveedor" data-info=\''+JSON.stringify(direccion)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '</td>'+
                                           '</tr>';
                                          
                                    });
                                  $('#tbodyClienteDir').html(trDir);
                                  $.each(respuesta['contacto'], function(index, contactos){
                                      var trContacto =  '<tr id="trContacto_'+contactos.idContacto+'">'+
                                                          '<td class="col-xs-3"><input type="text" onkeyup="" id="nomProveedor_'+contactos.idContacto+'"  value="'+contactos.nombre+'" class="form-control" disabled> </td>'+
                                                          '<td class="col-xs-3"><input type="email" onkeyup="" id="correoProveedor_'+contactos.idContacto+'"  value="'+contactos.correo+'" class="form-control" disabled> </td>'+
                                                          '<td class="col-xs-1"><input type="checkbox" id="estatusContacto_'+contactos.idContacto+'"  value=""  '+((contactos.estatus===1) ? 'checked':'')+' disabled></td>'+
                                                          '<td class="col-xs-3">'+
                                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+contactos.idContacto+'" data-cat="Contacto" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                                            '<button type="button" value="Actualizar" id="btn_guardarContacto_'+contactos.idContacto+'" disabled="disabled" data-id="'+contactos.idContacto+'" data-cat="Contacto" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+contactos.idContacto+'" data-cat="Contacto" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                                          '</td>'+
                                                        '</tr>';
                                      $('#tbodyContacto').append(trContacto);
                                  });
                              });
                      
                    }
                  break;
          }

        
    }

    $(document).on('click','#editDirCliente', function(){ //:::::-- FUNCION PARA ABRIR EL MODAL PARA UN INGRESAR O EDITAR UNA NUEVA DIRECCION DE CLIENTE
                      var datos = $(this).data('info'); //:::-- RECUPERA LOS DATOS QUE TRAE ESTE ELEMENTO EN DATA-INFO
                      var catDir = (($(this).data('cat') === "TelefonoCliente") ? "Cliente" : "Proveedor"); //:- PARA SABER SI EL BOTON PERTENECE A CLIENTE O PROVEEDOR
                      var telefonoDir = obtenerElementos($(this).data('cat'),$('#id_'+catDir).val()); //::- CONSULTA LOS TELEFONOS DE UN CLIENTE PARA
                      telefonoDir.done(function(telefonos){                                           
                          console.log(telefonos);
                          numTelReg = telefonos.length; //::-- ALMACENA EL NUMERO DE REGISTROS DE TELEFONO DEVUELTOS
                        
                          if (numTelReg >=1){   //::::-- SI EL NUMERO DE REGISTROS ES > O = 1 ABRE EL MODAL 
                            $('#myModal').modal('show');
                            
                            var options = "";
                            var idCliente= $('#id_'+catDir).val();
                            var footerDir = '<input type="hidden" id="id_'+catDir+'" value="'+idCliente+'" name="">'+
                                            '<button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true">CANCELAR</button>'+
                                            '<button type="button" id="btn_guardarDir" name="btn_guardar" value="'+((!datos) ? 'Guardar' : 'Actualizar')+'" data-id="'+((!datos) ? '0' : datos.idDir)+'" data-cat="Direccion'+catDir+'" class="enviarG  btn btn-success" >OK</button>';
                            $('#modalFooterDir').html(footerDir);

                            $('#calle1').val(((!datos) ? '' : datos.calle1));
                            $('#calle2').val(((!datos) ? '' : datos.calle2));
                            $('#colonia').val(((!datos) ? '' : datos.colonia));
                            $('#delegacion').val(((!datos) ? '' : datos.delegacion));
                            $('#cp').val(((!datos) ? '' : datos.codigo_postal));
                            $('#tipoDir').val(((!datos) ? '' : datos.tipo));
                            $('#estatusDirCliente').prop('checked',((!datos) ? 'checked' : (datos.estatus===1 ? 'checked' : '')));
                            var pais=obtenerElementos('Pais',null);  //::-- OBTIENE LA LISTA DE PAISES DISPONIBLES ---::::://
                            pais.done(function(respuesta){
                              
                              $.each(respuesta,function(index,pais){
                                options += '<option value="'+pais.idPais+'">'+pais.pais+'</option>';
                              });
                              $('#pais').html(options);
                              $('#pais').val(((!datos) ? '' : datos.idPais));
                            });
                            if(!datos){ //:::::-- CONDICION PARA SABER SI ES UN DOMICILIO NUEVO O EXISTENTE, SI DATOS ES NULO, ENTONCES SE ABRIRA EL MODAL
                              options = '<option value="">Seleccione un país</option>'  //::-- PARA UN NUEVO DOMICILIO 
                              $('#estado').html('<option value="">Seleccione primero un pais</option>');
                              $('#municipio').html('<option value="">Seleccione primero un estado</option>');
                            }else{  //:::::-- SI DATOS NO ES NULO PROCEDE A CONSULTAR TODOS LOS ESTADOS Y MUNICIPIOS --:::://
                              var estados = obtenerElementos('Estados',datos.idPais); //::-- CONSULTA LOS ESTADOS DEPENDIENDO DE EL PAIS -:://
                              var opEstados="";
                              estados.done(function(respuesta){
                                $.each(respuesta,function(index,estado){
                                  opEstados += '<option value="'+estado.idEstado+'">'+estado.estados+'</option>';
                                });
                                $('#estado').html(opEstados);
                                $('#estado').val(datos.idEstado);
                              });
                              var municipios = obtenerElementos('Municipios',datos.idEstado); //::-- CONSULTA LOS MUNICIPIOS DEPENDIENDO DE EL ESTADO --:://
                              var opMunicipio="";
                              municipios.done(function(respuesta){
                                console.log(respuesta);
                                $.each(respuesta,function(index,municipio){
                                  opMunicipio += '<option value="'+municipio.idMunicipio+'">'+municipio.municipio+'</option>';
                                });
                                $('#municipio').html(opMunicipio);
                                 $('#municipio').val(datos.idMunicipio);
                              });
                            }
                            var opTel = '<option value="-1">Seleccione teléfono</option>';
                                        
                            $.each(telefonos,function(index,telDir){
                              opTel += '<option value="'+telDir.id+'">'+telDir.numero+'</option>';
                            });
                            $('#telefonoDir').html(opTel);
                            $('#telefonoDir').val(((!datos) ? '-1' : datos.idTelDir));
                          
                          }else{  //::::-- EN CASO DE numTelReg=0 NO PERMITIRA ABRIR EL MODAL Y SE MOSTRARA
                            alertas('warning',"Se debe ingresar al menos un telefono.")  //:::--  <-- ESTA ALERTA
                          }
                      });
    }); 

    $(document).on('change','#pais', function(){ //::::--- FUNCION PARA CUANDO SE CAMBIE UN PAIS RECARGUE LOS ESTADOS ---:::://
                        var idPais = $(this).val();
                       
                        var datos=obtenerElementos('Estados',idPais);
                        datos.done(function(respuesta){
                          var options = '<option value="">Seleccione un estado</option>';
                         
                          $.each(respuesta,function(index,estados){
                            options += '<option value="'+estados.idEstado+'">'+estados.estados+'</option>';
                          });
                          $('#estado').html(options);
                        });
                        $('#municipio').html('<option value="">Seleccione primero un estado</option>');
    });

    $(document).on('change','#estado', function(){ //::::--- FUNCION PARA CUANDO SE CAMBIE UN ESTADO RECARGUE LOS MUNICIPIOS ---:::://
                        var idEstado = $(this).val();
                       
                        var datos=obtenerElementos('Municipios',idEstado);
                        datos.done(function(respuesta){
                          var options = '<option value="">Seleccione un municipio</option>';
                          
                          $.each(respuesta,function(index,municipio){
                            options += '<option value="'+municipio.idMunicipio+'">'+municipio.municipio+'</option>';
                          });
                          $('#municipio').html(options);
                        });
                        
    });

    $(document).on('click','#nuevaPass',function(){
      $('#password_'+$(this).data('id')).prop('disabled',false);
      $('#password_'+$(this).data('id')).focus();
    });

    
    $(document).on('click','#btn_CancelDescN',function(){  // ACCION PARA DEVOLVER EL SELECT DESCUENTO A SU VALOR ANTERIOR
      
      $('#descuento_'+$('#btn_guardar').data('id')).val($(this).val());
    });


    $(function(){
       $('table.data-table.sort').dataTable( {
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": false,
            "bAutoWidth": false 
        });
       $('table.data-table.full').dataTable( {
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""f>t<"F"lp>',
            "sPaginationType": "bootstrap"
        });
    });


  }); 
  
  function abrirModalDesc(valorAct,idCliente){  //:::-- FUNCION PARA ABRIR EL MODAL PARA AGREGAR UN NUEVO DESCUENTO DESDE CATALOGO CLIENTE
      $('#modalDescuentos').modal('show');    //::-- ABRE EL MODAL 
      $('#btn_CancelDescN').val(valorAct);    //::-- GUARDA EL VALOR ACTUAL PARA QUE CUENDO SE DE CANCELAR DEVUELVA EL SELECT AL VALOR QUE TENIA ANTES
      //$('#btn_CancelDescN').data('id',idCliente);
    }
  

//:::::::::::::--  FUNCION PARA LAS ALERTAS --::::::::::::::::::::::::::::::://
  function alertas(tipo,mensaje){
    $('.top-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }
//:::::::::::-- FUNCION PARA HACER LLAMADAS AJAX PARA OBTENER ELEMENTOS EN ESPECIFICO QUE SE REQUIERAN --:::::::::::::://
  function obtenerElementos(cat,id){

      var ajax=$.ajax({
          url:    "/getElementos/"+cat,
          type:   "POST",
          data:   {catalogo: cat, id: id},
          
      });
      return ajax;
    }
</script>
@stop
