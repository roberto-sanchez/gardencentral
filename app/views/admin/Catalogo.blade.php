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

@section('content')

    <div class="content">
        <div class="row contenido-principal">
            <div class="titulo_catalogo" >
                <h2>    &nbsp;&nbsp;&nbsp;Catálogo    {{$catalogo }}  </h2>
            </div>
            <div class="col-md-12 main-content" id="catalogo_principal" class="panel-body">
                @include('layouts/inc/estatus')
                <?php
                switch ($catalogo) {
                case 'Almacen':      ?>
                <div class="table-responsive">
                    <table id="tablaResult" class="table table-first-column-number" >
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
                            <tr>
                                <td><input type="text" id="clave_0" name="clave" required class="form-control"> </td>
                                <td><input type="text" id="nombre_0" name="nombre" required class="form-control"> </td>
                                <td><input type="checkbox" id="status_0" name="status" value=1 checked="true" class="form-check" disabled></td>
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
                <div class="row col-xs-12" style="margin-top: 1em">
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
                </div>
                <?php
                break;

                case 'Comercializador': ?>
                <div class="row col-sm-8">
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
                                        <td class="col-xs-6"><input type="text" id="nombre_{{$comercializador->id}}" name="nombre_{{$comercializador->id}}" value="{{$comercializador->nombre}}" disabled="disabled" class="form-control"></td>
                                        <td class="col-xs-6">
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
                    </div>
                </div>
                <?php
                break;

                case 'NivelDescuento':      ?>
                <div class="col-md-8 col-sm-10 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                            <tr class="">
                                <th class="col-md-4 col-xs-5 col-sm-4">Descripcion</th>
                                <th class="col-md-2 col-xs-1 col-sm-2">Descuento</th>
                                <th class="col-md-2 col-xs-1 col-sm-2">Estatus</th>
                                <th class="col-md-4 col-xs-5 col-sm-4"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <form>
                                <tr class="">
                                    <td class="col-md-4 col-xs-5 col-sm-4"><input type="text" id="descripcion_0"  value="" class="form-control"></td>
                                    <td class="col-md-2 col-xs-1 col-sm-2"><input type="number" id="descuento_0" value="" class="form-control"></td>
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
                                    <td class="col-md-2 col-xs-1 col-sm-2"><input type="number" id="descuento_{{$descuento->id}}" name="descuento_{{$descuento->id}}" value="{{$descuento->descuento}}" disabled class="form-control"></td>
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
                </div>

                <?php
                break;

                case 'FormaPago':  ?>
                <div class="row col-md-8 col-sm-12">
                    <div class="table-respnsive">
                        <table class="table table-first-column-check " id="tablaResult">
                            <thead>
                            <tr class="">
                                <th class="col-md-6 col-sm-6">Descripción</th>
                                <th class="col-md-6 col-sm-6"></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyFormaPago">
                            <form>
                                <tr class="">
                                    <td class="col-md-6 col-sm-6"><input type="text" id="descrFormaPago_0" name="" value="" class="form-control"></td>
                                    <td class="col-md-6 col-sm-6" style="text-align: center;"><button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="FormaPago" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span></button></td>
                                </tr>
                            </form>
                            @foreach($formasPago as $formaPago)
                                <tr id="tr_{{$formaPago->id}}" class="" >
                                    <td class="col-md-6 col-sm-6"><input type="text" id="descrFormaPago_{{$formaPago->id}}" name="" value="{{$formaPago->descripcion}}" disabled="disabled" class="form-control"></td>
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
                                <th class="col-xs-6">Rol</th>
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
                                <th class="col-md-3 col-sm-3 col-xs-2">Nombre</th>
                                <th class="col-md-2 col-sm-2 col-xs-2">Nombre comercial</th>
                                <th class="col-md-2 col-sm-2 col-xs-2">Razon social</th>
                                <th class="col-md-2 col-sm-2 col-xs-1">Comercializador</th>
                                <th class="col-md-1 col-sm-1 col-xs-2">Estatus</th>
                                <th class="col-md-2 col-sm-2 col-xs-3">Acción</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($proveedor as $proveedor)

                                <tr id="tr_{{$proveedor->id}}">
                                    <td class="col-md-3 col-sm-3 col-xs-2"><input type="text" id="nombre_{{$proveedor->id}}"  value="{{$proveedor->nombre}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="nombre_comercial_{{$proveedor->id}}"  value="{{$proveedor->nombre_comercial}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="razon_social_{{$proveedor->id}}"  value="{{$proveedor->razon_social}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-2 col-sm-2 col-xs-2"><input type="text" id="comercializador_{{$proveedor->id}}"  value="{{$proveedor->comercializador}}" disabled="disabled" class="form-control"></td>
                                    <td class="col-md-1 col-sm-1 col-xs-1"><input type="checkbox" id="status_{{$proveedor->id}}" name="status" value  disabled <?php  if ($proveedor->estatus==1): ?> checked <?php endif ?>></td>
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
                <div class="row col-sm-8">
                    <div class="table-responsice">
                        <table class="table table-first-column-check data-table display full table-condensed" id="tablaResult">

                            <thead>
                            <tr>
                                <th class="col-sm-6">Descripcion</th>
                                <th class="col-sm-2">Estatus</th>
                                <th class="col-sm-4"></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyFamilia">

                            <tr>
                                <td class="col-sm-6"><input type="text" id="descrFam_0" name="" value="" class="form-control"></td>
                                <td class="col-sm-2" style="text-align: center"><input type="checkbox" id="estatusFam_0" name="" value="" checked="true" class="form-check" disabled></td>
                                <td class="col-sm-4" style="text-align: center">
                                    <button type="button" id="btn_guardarFam" name="" value="Guardar" data-id="0" data-cat="Familias" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                </td>
                            </tr>

                            @foreach($familias as $familia)
                                <tr>
                                    <td class="col-sm-6"><input type="text" id="descrFam_{{$familia->id}}" name="" value="{{$familia->descripcion}}" class="form-control" disabled></td>
                                    <td class="col-sm-2" style="text-align: center"><input type="checkbox" id="estatusFam_{{$familia->id}}" name="" value="" <?php if ($familia->estatus===1): ?>  checked="true" <?php endif ?> class="form-check" disabled></td>
                                    <td class="col-sm-4" style="text-align: center">
                                        <button type="button" value="Modificar" id="btn_mod" data-id="{{$familia->id}}" data-cat="Familias" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" value="Actualizar" id="btn_guardar_{{$familia->id}}" disabled="disabled" data-id="{{$familia->id}}" data-cat="Familias" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                        <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$familia->id}}" data-cat="Familias" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                break;

                case 'Descuentos':  ?>
                <div class="row col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-first-column-check " id="tablaResult">

                            <thead>
                            <tr>
                                <th class="col-sm-2">Descripción</th>
                                <th class="col-sm-2">Familia</th>
                                <th class="col-sm-1">Descuento</th>
                                <th class="col-sm-2">Fecha Inicio</th>
                                <th class="col-sm-2">Fecha fin</th>
                                <th class="col-sm-1">Estatus</th>
                                <th class="col-sm-2"></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyDesc">
                            <tr>
                                <td class="col-sm-2"><input type="text" id="descrDesc_0" name="" value="" class="form-control"></td>
                                <td class="col-sm-2"><select id="familiaDesc_0" name="" class="form-control options" value="" required>
                                        <option value="-1">Seleccione familia</option>
                                        @foreach($familias as $familia)
                                            <option value="{{$familia->id}}">{{$familia->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="col-sm-1"><input type="number" id="descDesc_0" name="" class="form-control" value="" min="0" required></td>
                                <td class="col-sm-2"><input type="date" id="fechaInicioDesc_0" name="" value="" class="form-control"></td>
                                <td class="col-sm-2"><input type="date" id="fechaFinDesc_0" name="" value="" class="form-control"></td>
                                <td class="col-sm-1"><input type="checkbox" id="estatusDesc_0" name="" value="" checked="true" class="form-check" disabled></td>
                                <td class="col-sm-2">
                                    <button type="button" id="btn_guardarDesc" name="" value="Guardar" data-id="0" data-cat="Descuentos" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                </td>
                            </tr>
                            @foreach($descuentos as $descuento)
                                <tr id="tr_{{$descuento->id}}">
                                    <td class="col-sm-2"><input type="text" id="descrDesc_{{$descuento->id}}" name="" value="{{$descuento->descripcion}}" class="form-control" disabled=""></td>
                                    <td class="col-sm-2"><select id="familiaDesc_{{$descuento->id}}" name="" class="form-control options" value="" required disabled="">
                                            <option value="-1">Seleccione familia</option>
                                            @foreach($familias as $familia)
                                                <option value="{{$familia->id}}"  <?php if ($familia->id===$descuento->familia_id): ?> selected <?php endif ?> >{{$familia->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="col-sm-1"><input type="number" id="descDesc_{{$descuento->id}}" name="" class="form-control" value="{{$descuento->descuento}}" min="0" required disabled=""></td>
                                    <td class="col-sm-2"><input type="date" id="fechaInicioDesc_{{$descuento->id}}" name="" value="{{$descuento->fecha_inicio}}" class="form-control" disabled=""></td>
                                    <td class="col-sm-2"><input type="date" id="fechaFinDesc_{{$descuento->id}}" name="" value="{{$descuento->fecha_fin}}" class="form-control" disabled=""></td>
                                    <td class="col-sm-1"><input type="checkbox" id="estatusDesc_{{$descuento->id}}" name="" value="" <?php if ($descuento->estatus === 1): ?> checked <?php endif ?> class="form-check" disabled></td>
                                    <td class="col-sm-2">
                                        <button type="button" value="Modificar" id="btn_mod" data-id="{{$descuento->id}}" data-cat="Descuentos" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" value="Actualizar" id="btn_guardar_{{$descuento->id}}" disabled="disabled" data-id="{{$descuento->id}}" data-cat="Descuentos" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                        <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$descuento->id}}" data-cat="Descuentos" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                break;

                case 'Producto':  ?>
                <div>
                    <button type="button" value="Nuevo" id="nuevoProducto" class="editarProducto btn btn-primary" data-info='' data-cat="Producto"><span class="glyphicon glyphicon-">NUEVO</span></button>
                </div>
                <div class="row" style="padding: 10px;">
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
                                    <td class="col-sm-1"><input type="text" id="claveProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->clave}}" required disabled></td>
                                    <td class="col-sm-3"><input type="text" id="nombreProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->nomProd}}" required disabled></td>
                                    <td class="col-sm-3"><input type="text" id="colorProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->color}}" required disabled></td>
                                    <td class="col-sm-1"><input type="text" id="almacenProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->cveAlmacen}}" required disabled></td>
                                    <td class="col-sm-2"><input type="text" id="familiaProd_{{$producto->idProd}}" name="" class="form-control" value="{{$producto->descrFamilia}}" required disabled></td>
                                    <td class="col-sm-1" style="text-align: center"><input type="checkbox" id="estatusProd_{{$producto->idProd}}" name="" value="{{$producto->estatus}}" class="checkbox" <?php if ($producto->estatus===1): ?> checked <?php endif ?> disabled></td>
                                    <td class="col-sm-1" >
                                        <button type="button" value="Modificar" id="btn_editarProd" data-id="{{$producto->idProd}}" class="editar btn btn-primary" data-info='{{json_encode($producto,JSON_HEX_APOS)}}' data-cat="Producto"><span class="glyphicon glyphicon-edit"></span></button>
                                    </td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                break;

                case 'Importador':  ?>
                <div class="row col-md-6 col-sm-8 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                            <tr>
                                <th class="col-xs-6">Nombre</th>
                                <th class="col-xs-6"></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyImportador">
                            <form>
                                <tr>
                                    <td class="col-xs-6"><input type="text" id="nomImportador_0" value="" class="form-control"></td>
                                    <td class="col-xs-6" style="text-align: center">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Importador" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                    </td>
                                </tr>
                            </form>
                            @forelse($importador as $importador)

                                <tr id="tr_{{$importador->id}}">
                                    <td class="col-xs-6"><input type="text" id="nomImportador_{{$importador->id}}"  value="{{$importador->nombre}}" disabled class="form-control"></td>
                                    <td class="col-xs-6" style="text-align: center">
                                        <button type="button" value="Modificar" id="btn_mod" data-id="{{$importador->id}}" data-cat="Importador" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                        <button type="button" value="Actualizar" id="btn_guardar_{{$importador->id}}" disabled="disabled" data-id="{{$importador->id}}" data-cat="Importador" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                        <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$importador->id}}" data-cat="Importador" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
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

                case 'Usuario':  ?>
                <div class="row col-md-12 col-sm-10 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                            <tr>
                                <th class="col-xs-2">Usuario</th>
                                <th class="col-xs-2">Contraseña</th>
                                <th class="col-xs-3">E-mail</th>
                                <th class="col-xs-2">Rol</th>
                                <th class="col-xs-3"></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyUsuario">
                            <form>
                                <tr id="trUsuario">
                                    <td class="col-xs-2"><input type="text" id="usuario_0" value="" class="form-control"></td>
                                    <td class="col-xs-2"><input type="password" id="contraseñaUsuario_0" value="" class="form-control"  maxlength="12"></td>
                                    <td class="col-xs-3"><input type="email" id="emailUsuario_0" value="" class="form-control"></td>
                                    <td class="col-xs-2"><select id="rolUsuario_0" name="" class="form-control options" value="" required>
                                            <option value="-1">Seleccione rol</option>
                                            <option value="2">Agente</option>
                                            <option value="3">administrador</option>
                                            <option value="4">Contabilidad</option>
                                        </select>
                                    </td>
                                    <td class="col-xs-3" style="text-align: center">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Usuario" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                    </td>
                                </tr>
                            </form>
                            @forelse($usuario as $usuario)
                                <tr id="tr_{{$usuario->id}}">
                                    <td class="col-xs-2"><input type="text" id="usuario_{{$usuario->id}}"  value="{{$usuario->usuario}}" disabled class="form-control"></td>
                                    <td class="col-xs-2"><input type="password" id="contraseñaUsuario_{{$usuario->id}}" value="" placeholder="Ingrese nueva contraseña" disabled class="form-control"  maxlength="12"></td>
                                    <td class="col-xs-3"><input type="email" id="emailUsuario_{{$usuario->id}}" value="{{$usuario->email}}" disabled class="form-control"></td>
                                    <td class="col-xs-2"><select id="rolUsuario_{{$usuario->id}}" name="" class="form-control options" value="" required disabled="">
                                            @if($usuario->rol_id===1)
                                                <option value="1" <?php if ($usuario->rol_id===1): ?> selected <?php endif ?>>Cliente</option>
                                            @endif
                                            <option value="2" <?php if ($usuario->rol_id===2): ?> selected <?php endif ?>>Agente</option>
                                            <option value="3" <?php if ($usuario->rol_id===3): ?> selected <?php endif ?>>administrador</option>
                                            <option value="4" <?php if ($usuario->rol_id===4): ?> selected <?php endif ?>>Contabilidad</option>
                                        </select>
                                    </td>
                                    <td class="col-xs-3" style="text-align: center">
                                        @if($usuario->rol_id!==1)
                                            <button type="button" value="Modificar" id="btn_mod" data-id="{{$usuario->id}}" data-cat="Usuario" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>
                                            <button type="button" value="Actualizar" id="btn_guardar_{{$usuario->id}}" disabled="disabled" data-id="{{$usuario->id}}" data-cat="Usuario" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>
                                            <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$usuario->id}}" data-cat="Usuario" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                        @endif
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
                default:
                    # code...
                    break;
                }
                ?>




            </div>
            <!-- CONTENIDO PARA VER TODOS LOS DETALLES DE UN CLIENTE O PROVEEDOR -->
            <div id="contenido_esp" class="panel-body" style="display: none">
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
                                <th>Pais</th>
                                <th>Estado</th>
                                <th>municipio</th>
                                <th>Delegacion</th>
                                <th>Colonia</th>
                                <th>Calle 1</th>
                                <th>Calle 2</th>
                                <th>C.P.</th>
                                <th>Tipo</th>
                                <th>estatus</th>
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
            <!-- CONTENIDO PARA VER LOS DETALLES DE UN PRODUCTO Y AGREGAR NUEVO -->
            <div id="panelProducto" class="panel-body" style="display: none">
                <div style="padding: 5px;">
                    <a href="/catalogo/{{$catalogo}}" type="button" class="btn-link"> REGRESAR </a>
                </div>
                <div id="detallesProducto" style="padding: 5px;">
                    <form class="add" id="formProducto" enctype="multipart/form-data">
                        <div class="row" style="padding: 5px;">
                            <div class="col-sm-3 claveProd">
                                <label>Clave:</label>
                                <input type="text" id="claveProd" value="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>N° Artículo:</label>
                                <input type="text" id="numArtProd" value="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Nombre:</label>
                                <input type="text" id="nomProd" value="" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Ean-code:</label>
                                <input type="text" id="eanCodeProd" value="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Color:</label>
                                <input type="text" id="colorProd" value="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>N° Color:</label>
                                <input type="number" id="numColorProd" value="" min=0 class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Unidad Medida:</label>
                                <select id="uMedidaProd" name="" class="form-control   options " value="" required >
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Dimensiones:</label>
                                <input type="text" id="DimenProd" value="" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Cantidad minima:</label>
                                <input type="number" id="cantMinProd" value="" class="form-control" >
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Piezas x paquete:</label>
                                <input type="number" id="piezasPaqProd" value="" min="1" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Piezas pallet:</label>
                                <input type="number" id="piezasPalletProd" value="" min="1" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <label>Total Piezas:</label>
                                <input type="number" id="totalPiezasProd" value="" min="0" class="form-control">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Importador:</label>
                                <select id="importadorProd" value="" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Almacen:</label>
                                <select id="almacenProd" value="" class="form-control" required>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label>Familia:</label>
                                <select id="familiaProd" value="" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Foto:</label>
                                <input type="file" id="fotoProd" value="" class="" accept="image/*">
                            </div>
                            <div class="col-sm-2">
                                <label>Estatus web:</label>
                                <input type="checkbox" id="estatusWebProd" value="" class="form-control" disabled="" checked="">
                            </div>
                            <div class="col-sm-1">
                                <label>Estatus:</label>
                                <input type="checkbox" id="estatusProd" value="" class="form-control" disabled="" checked="">
                            </div>
                            <div class="col-sm-1">
                                <label>Iva 0:</label>
                                <input type="checkbox" id="iva" value="" class="form-control" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <button type="button" class="btn-link" id="verFotoProd">Ver foto</button>
                            </div>
                            <div class="col-sm-offset-5">
                                <button type="button" id="btn_guardarProducto" name="btn_guardarProducto" value="Guardar" data-id="" data-info="" data-cat="Producto" class="btn btn-success"><span class="glyphicon glyphicon-">GUARDAR</span></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="sidebar">
                    <div class="widget" id="tabProducto">
                        <h2>Producto</h2>
                        <ul class="cards list-group">
                            <li class="list-group-item">
                                <div class="table-responsive" id="tabPaneProdPrecio">
                                    <table id="tableProdPrecio" class="table table-first-column-number ">
                                        <thead >
                                        <tr>
                                            <th class="col-xs-2">Precio</th>
                                            <th class="col-xs-2">Tipo precio</th>
                                            <th class="col-xs-1">Moneda</th>
                                            <th class="col-xs-2">Fecha inicio</th>
                                            <th class="col-xs-2">Fecha fin</th>
                                            <th class="col-xs-1">Estatus</th>
                                            <th class="col-xs-2"></th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbodyProdPrecio">
                                        <tr id="trProdPrecio_0">
                                            <td class="col-xs-2">
                                                <!--<div class="precio input-group  " style="padding: 5px;">
                          <span class="input-group-addon">
                            <span class="text-info">$</span>
                          </span>-->
                                                <input type="number" onkeyup="" id="precio_0"  value="" class="form-control" min="0" disabled="">
                                                <!--</div>-->
                                            </td>
                                            <td class="col-xs-2">
                                                <select id="tipoPrecio_0" name="" class="form-control   options " value="" required disabled="">
                                                    <option value="-1">Seleccione tipo precio</option>
                                                    <option value="0">Compra</option>
                                                    <option value="1">Retail</option>
                                                    <option value="2">Mayorista</option>
                                                    <option value="3">Distribuidor</option>
                                                </select>
                                            </td>
                                            <td class="col-xs-1">
                                                <select id="monedaProd_0" name="" class="form-control   options " value="" required disabled="">
                                                    <option value="-1">Seleccione tipo de moneda</option>
                                                    <option value="Pesos">Pesos Mx</option>
                                                    <option value="Dolar">Dolar</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </td>
                                            <td class="col-xs-2"><input type="date" onkeyup="" id="fechaInicioProdPrecio_0"  value="" class="form-control" disabled=""> </td>
                                            <td class="col-xs-2"><input type="date" onkeyup="" id="fechaFinProdPrecio_0"  value="" class="form-control" disabled=""> </td>
                                            <td class="col-xs-1"><input type="checkbox" id="estatusPrecioProd_0"  value="1"   checked disabled></td>
                                            <td class="col-xs-2">
                                                <input type="hidden" id="idProducto" value="" name="">
                                                <button type="button" id="btn_guardarPrecioProd" name="btn_guardarPrecioProd" value="Guardar" data-id="0" data-cat="ProductoPrecio" class="enviarG  btn btn-success" disabled="">OK</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
        <div class="modal-dialog xs-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="text-align: center;">CONFIRMACION</h3>
                </div>
                <form action="" method="" accept-charset="utf-8">
                    <div class="modal-body">
                        <h4 style="text-align: center;">¿Esta seguro de enviar los datos? </h4>
                    </div>
                    <div class="modal-footer" id="modalFooterDir">
                        <button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true" id="btn_CancelEnviar">CANCELAR</button>
                        <button type="button" id="btn_enviar" name="" value="" data-id="" data-cat="" class="btn btn-success" >GUARDAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--::::::::::::: MODAL PARA LAS CONFIRMACIONES DE LAS ELIMINACIONES :::::::::::::::::::::::::::::::::::::::-->
    <div id="modalConfirmEliminar" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="modalConfirmEliminarLabel" aria-hidden="true" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 style="text-align: center;">CONFIRMACION</h3>
                </div>
                <form action="" method="" accept-charset="utf-8">
                    <div class="modal-body">
                        <h4 style="text-align: center;">¿Esta seguro de eliminar este registro? </h4>
                    </div>
                    <div class="modal-footer" id="modalFooterDir">
                        <button type="button" class="btn btn-info" data-dismiss="modal" aria-hidden="true" id="btn_CancelEnviar">CANCELAR</button>
                        <button type="button" id="btn_enviarEliminar" name="" value="" data-id="" data-cat="" class="btn btn-success" >ELIMINAR</button>
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

    <!--::::::::::: MODAL PARA VER LA FOTO DEL PRODUCTO   :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::-->
    <div id="modalFotoProd" class="modal fade" tabindex="-1"   >
        <div class="modal-dialog p-fotop">
            <div class="modal-content content-f">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title text-primary text-center title-fp">
                        <span class="glyphicon glyphicon-picture "></span>
                        Imagen del producto</h2>
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

    <script type="text/javascript">
        $(document).ready(function () {
            var catalogo= '{{$catalogo}}';
            {{---- FUNCION PARA HABILITAR LOS CAMPOS A MODIFICAR ---}}
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
                        $('#descrFormaPago_'+$(this).data('id')).prop('disabled',false);
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

                    case 'Importador':
                        $('#nomImportador_'+$(this).data('id')).prop('disabled',false);
                        $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
                        break;

                    case 'ProductoPrecio':
                        $('#precio_'+$(this).data('id')).prop('disabled',false);
                        $('#tipoPrecio_'+$(this).data('id')).prop('disabled',false);
                        $('#monedaProd_'+$(this).data('id')).prop('disabled',false);
                        $('#fechaInicioProdPrecio_'+$(this).data('id')).prop('disabled',false);
                        $('#fechaFinProdPrecio_'+$(this).data('id')).prop('disabled',false);
                        $('#estatusPrecioProd_'+$(this).data('id')).prop('disabled',false);
                        $('#btn_guardarPrecioProd_'+$(this).data('id')).prop('disabled',false);
                        break;

                    case 'Descuentos':
                        $('#descrDesc_'+$(this).data('id')).prop('disabled',false);
                        $('#familiaDesc_'+$(this).data('id')).prop('disabled',false);
                        $('#descDesc_'+$(this).data('id')).prop('disabled',false);
                        $('#fechaInicioDesc_'+$(this).data('id')).prop('disabled',false);
                        $('#fechaFinDesc_'+$(this).data('id')).prop('disabled',false);
                        $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
                        break;
                    case 'Usuario':
                        $('#usuario_'+$(this).data('id')).prop('disabled',false);
                        $('#contraseñaUsuario_'+$(this).data('id')).prop('disabled',false);
                        $('#rolUsuario_'+$(this).data('id')).prop('disabled',false);
                        $('#emailUsuario_'+$(this).data('id')).prop('disabled',false);
                        $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
                        break;
                    case 'Familias':
                        $('#descrFam_'+$(this).data('id')).prop('disabled',false);
                        $('#estatusFam_'+$(this).data('id')).prop('disabled',false);
                        $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
                        break;

                }
            });

            /* function confirmar(){
             //var respuesta = $('#modalConfirmacion').modal({erfalse});
             var respuesta=confirm('¿Estas seguro de guardar los datos? ');
             return respuesta;
             }

             function confirmarEliminar(){
             var respuesta= confirm('¿Estas seguro de eliminar este registro?');
             return respuesta;
             }*/


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
                            $('#nombre_'+$(this).data('id')).focus();
                            msg += 'Ingrese el nombre.';
                            validar = false;
                        };
                        break;

                    case 'Importador':
                        if ($('#nomImportador_'+$(this).data('id')).val().trim()==="") {
                            $('#nomImportador_'+$(this).data('id')).focus();
                            msg += 'Ingrese importador.';
                            validar = false;
                        };
                        break;

                    case 'FormaPago':
                        if ($('#descrFormaPago_'+$(this).data('id')).val().trim()==="") {
                            msg += 'Ingrese descripción. \n';
                            validar = false;
                            $('#descrFormaPago_'+$(this).data('id')).focus();
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

                    case 'ProductoPrecio':
                        if ($('#precio_'+$(this).data('id')).val().trim() === ""){
                            $('.precio_'+$(this).data('id')).addClass('has-error');
                            msg += ';Ingrese precio.';
                            validar = false;
                        }else{
                            $('.precio_'+$(this).data('id')).removeClass('has-error');
                        }
                        if ($('#tipoPrecio_'+$(this).data('id')).val().trim() === "-1"){
                            $('.tipoPrecio_'+$(this).data('id')).addClass('has-error');
                            msg += ';Seleccione tipo.';
                            validar = false;
                        }else{
                            $('.tipoPrecio_'+$(this).data('id')).removeClass('has-error');
                        }
                        if ($('#monedaProd_'+$(this).data('id')).val().trim() === "-1"){
                            $('.monedaProd_'+$(this).data('id')).addClass('has-error');
                            msg += ';Seleccione moneda.';
                            validar = false;
                        }else{
                            $('.monedaProd_'+$(this).data('id')).removeClass('has-error');
                        }
                        if ($('#fechaInicioProdPrecio_'+$(this).data('id')).val().trim() === ""){
                            $('.fechaInicioProdPrecio_'+$(this).data('id')).addClass('has-error');
                            msg += ';Ingrese fecha de inicio.';
                            validar = false;
                        }else{
                            $('.fechaInicioProdPrecio_'+$(this).data('id')).removeClass('has-error');
                        }
                        if ($('#fechaFinProdPrecio_'+$(this).data('id')).val().trim() === ""){
                            $('.fechaFinProdPrecio_'+$(this).data('id')).addClass('has-error');
                            msg += ';Ingrese fecha fin.';
                            validar = false;
                        }else{
                            $('.fechaFinProdPrecio_'+$(this).data('id')).removeClass('has-error');
                        }
                        break;

                    case 'Descuentos':
                        if ($('#descrDesc_'+$(this).data('id')).val().trim()==="") {
                            msg += ';Ingrese descripción.';
                            validar = false;
                            $('#descrDesc_'+$(this).data('id')).focus();
                            break;
                        };
                        if ($('#familiaDesc_'+$(this).data('id')).val().trim()==="-1") {
                            msg += ';Seleccione familia.';
                            validar = false;
                            $('#familiaDesc_'+$(this).data('id')).focus();
                            break;
                        };
                        if ($('#descDesc_'+$(this).data('id')).val().trim()==="") {
                            msg += ';Ingrese descuento.';
                            validar = false;
                            $('#descDesc_'+$(this).data('id')).focus();
                            break;
                        };
                        if ($('#fechaInicioDesc_'+$(this).data('id')).val().trim()==="") {
                            msg += ';Ingrese fecha inicio.';
                            validar = false;
                            $('#fechaInicioDesc_'+$(this).data('id')).focus();
                            break;
                        };
                        if ($('#fechaFinDesc_'+$(this).data('id')).val().trim()==="") {
                            msg += ';Ingrese fecha fin.';
                            validar = false;
                            $('#fechaFinDesc_'+$(this).data('id')).focus();
                            break;
                        };
                        break;
                    case 'Usuario':
                        if ($('#usuario_'+$(this).data('id')).val().trim() === ""){
                            msg += ';Ingrese usuario. ';
                            validar = false;
                        }
                        if ($(this).val()==="Guardar"){
                            if ($('#contraseñaUsuario_'+$(this).data('id')).val().trim() === "" ){
                                $('.contraseñaUsuario_'+$(this).data('id')).addClass('has-error');
                                msg += ';Ingrese contraseña.';
                                validar = false;
                            }else if($('#contraseñaUsuario_'+$(this).data('id')).val().trim().length < 6 ){
                                $('.contraseñaUsuario_'+$(this).data('id')).addClass('has-error');
                                msg += ';Contraseña muy corta.';
                                validar = false;
                            }else if($('#contraseñaUsuario_'+$(this).data('id')).val().trim().length > 12 ){
                                $('.contraseñaUsuario_'+$(this).data('id')).addClass('has-error');
                                msg += ';Contraseña muy larga.';
                                validar = false;
                            }else {
                                $('.contraseñaUsuario_'+$(this).data('id')).removeClass('has-error');
                            }
                        }
                        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
                        if (!regex.test( $('#emailUsuario_'+$(this).data('id')).val().trim())) {
                            $('.emailUsuario_'+$(this).data('id')).addClass('has-error');
                            msg += ';Ingrese e-mail.';
                            validar = false;
                        }else{
                            $('.emailUsuario_'+$(this).data('id')).removeClass('has-error');
                        }
                        if ($('#rolUsuario_'+$(this).data('id')).val().trim() === "-1"){
                            msg += ';Seleccione rol. ';
                            validar = false;
                        }
                        break;
                    case 'Familias':
                        if ($('#descrFam_'+$(this).data('id')).val().trim() === ""){
                            msg += ';Ingrese descripcion.';
                            validar = false;
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
                    //$('#modalConfirmacion').modal('show');

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
                        case 'Importador':
                            var datos = {
                                nomImportador  : $('#nomImportador_'+$(this).data('id')).val().trim(),
                                catalogo: catalogo,
                                tipoMov : $(this).val(),
                                id_upd  : $(this).data('id')
                            };
                            break;
                        case 'FormaPago':
                            var datos = {
                                descripcion  : $('#descrFormaPago_'+$(this).data('id')).val().trim(),
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
                            // alert('datos cargados: \n ' +datos['numero']+'\n ' +datos['tipo']+'\n ' +datos['cliente_id']+ '\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
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

                        case 'ProductoPrecio':
                            var datos={
                                precio              : $('#precio_'+$(this).data('id')).val().trim(),
                                tipoPrecio          : $('#tipoPrecio_'+$(this).data('id')).val().trim(),
                                monedaProd          : $('#monedaProd_'+$(this).data('id')).val().trim(),
                                fechaInicio         : $('#fechaInicioProdPrecio_'+$(this).data('id')).val(),
                                fechaFin            : $('#fechaFinProdPrecio_'+$(this).data('id')).val(),
                                idProducto          : $('#idProducto').val().trim(),
                                estatus             : (($('#estatusPrecioProd_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                                catalogo            : catalogo,
                                tipoMov             : $(this).val(),
                                id_upd              : $(this).data('id')
                            };

                        case 'Descuentos':
                            var datos={
                                descrDesc           : $('#descrDesc_'+$(this).data('id')).val().trim(),
                                familiaDesc         : $('#familiaDesc_'+$(this).data('id')).val().trim(),
                                descDesc            : $('#descDesc_'+$(this).data('id')).val().trim(),
                                fechaInicioDesc     : $('#fechaInicioDesc_'+$(this).data('id')).val(),
                                fechaFinDesc        : $('#fechaFinDesc_'+$(this).data('id')).val(),
                                estatusDesc         : (($('#estatusDesc_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                                catalogo            : catalogo,
                                tipoMov             : $(this).val(),
                                id_upd              : $(this).data('id')
                            };
                            break;
                        case 'Usuario':
                            var datos={
                                usuario             : $('#usuario_'+$(this).data('id')).val().trim(),
                                contraseña          : $('#contraseñaUsuario_'+$(this).data('id')).val().trim(),
                                email               : $('#emailUsuario_'+$(this).data('id')).val().trim(),
                                rol                 : $('#rolUsuario_'+$(this).data('id')).val(),
                                catalogo            : catalogo,
                                tipoMov             : $(this).val(),
                                id_upd              : $(this).data('id')
                            };
                            break;
                        case 'Familias':
                            var datos={
                                descripcion         : $('#descrFam_'+$(this).data('id')).val().trim(),
                                estatus             : (($('#estatusFam_'+$(this).data('id')).is(':checked')) ? '1' : '0'),
                                catalogo            : catalogo,
                                tipoMov             : $(this).val(),
                                id_upd              : $(this).data('id')
                            };
                            break;

                        default:
                            break;

                    }
                    $('#btn_enviar').val($(this).val());
                    $('#btn_enviar').data('id',$(this).data('id'));
                    $('#btn_enviar').data('info',datos);
                    $('#btn_enviar').data('function','1'); //hace referencia para saber que funcion abrira
                    $('#modalConfirmacion').modal('show');
                    /*if(confirmar()){
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
                     '<td class="col-xs-6"> <input type="text" name="nombre_'+respuesta.id+'" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" class="form-control" required>  </td>' +
                     '<td class="col-xs-6">'+
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
                     '<td col-md-2 col-xs-1 col-sm-2> <input type="number" name="descuento_'+respuesta.id+'" value="'+respuesta.descuento+'" id="descuento_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
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

                     case 'ProductoPrecio':
                     var fila =  '<tr id="trProdPrecio_'+respuesta.id+'">'+
                     '<td class="col-xs-2">'+
                     '<div class="precio input-group  " style="padding: 5px;">'+
                     '<span class="input-group-addon">'+
                     '<span class="text-info">$</span>'+
                     '</span>'+
                     '<input type="number" onkeyup="" id="precio_'+respuesta.id+'"  value="'+respuesta.precio+'" class="form-control" min="0" disabled="">'+
                     '</div>'+
                     '</td>'+
                     '<td class="col-xs-2">'+
                     '<select id="tipoPrecio_'+respuesta.id+'" name="" class="form-control   options " value="" required disabled="">'+
                     '<option value="-1">Seleccione tipo precio</option>'+
                     '<option value="0">Compra</option>'+
                     '<option value="1">Retail</option>'+
                     '<option value="2">Mayorista</option>'+
                     '<option value="3">Distribuidor</option>'+
                     '</select>'+
                     '</td>'+
                     '<td class="col-xs-1">'+
                     '<select id="monedaProd_'+respuesta.id+'" name="" class="form-control   options " value="" required disabled="">'+
                     '<option value="-1">Seleccione tipo de moneda</option>'+
                     '<option value="Pesos">Pesos Mx</option>'+
                     '<option value="Dolar">Dolar</option>'+
                     '<option value="Otro">Otro</option>'+
                     '</select>'+
                     '</td>'+
                     '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaInicioProdPrecio_'+respuesta.id+'"  value="" class="form-control" disabled=""> </td>'+
                     '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaFinProdPrecio_'+respuesta.id+'"  value="" class="form-control" disabled=""> </td>'+
                     '<td class="col-xs-1"><input type="checkbox" id="estatusPrecioProd_'+respuesta.id+'"  value="" disabled></td>'+
                     '<td class="col-xs-2">'+
                     '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                     '<button type="button" value="Actualizar" id="btn_guardarPrecioProd_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                     '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                     '</td>'+
                     '</tr>';
                     $('#tbodyProdPrecio').append(fila);
                     $('#precio_0').val('');
                     $('#tipoPrecio_'+respuesta.id).val(respuesta.tipo);
                     $('#tipoPrecio_0').val('-1');
                     $('#monedaProd_'+respuesta.id).val(respuesta.moneda);
                     $('#monedaProd_0').val('-1');
                     $('#fechaInicioProdPrecio_'+respuesta.id).val(respuesta.fechaInicio);
                     $('#fechaInicioProdPrecio_0').val('');
                     $('#fechaFinProdPrecio_'+respuesta.id).val(respuesta.fechaFin);
                     $('#fechaFinProdPrecio_0').val('');
                     $('#estatusPrecioProd_'+respuesta.id).prop('checked',(respuesta.estatus===1 ? true : false));
                     $('#btn_guardarPrecioProd').prop('disabled',false);
                     break;

                     case 'Descuentos':
                     var fila =  '<tr id="tr_'+respuesta['descuento'].id+'">'+
                     '<td class="col-sm-2"><input type="text" id="descrDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].descripcion+'" class="form-control" disabled=""></td>'+
                     '<td class="col-sm-2"><select id="familiaDesc_'+respuesta['descuento'].id+'" name="" class="form-control options" value="" required disabled="">'+
                     '</select> '+
                     '</td>'+
                     '<td class="col-sm-1"><input type="number" id="descDesc_'+respuesta['descuento'].id+'" name="" class="form-control" value="'+respuesta['descuento'].descuento+'" min="0" required disabled=""></td>'+
                     '<td class="col-sm-2"><input type="date" id="fechaInicioDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].fecha_inicio+'" class="form-control" disabled=""></td>'+
                     '<td class="col-sm-2"><input type="date" id="fechaFinDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].fecha_fin+'" class="form-control" disabled=""></td>'+
                     '<td class="col-sm-1"><input type="checkbox" id="estatusDesc_'+respuesta['descuento'].id+'" name="" value="" '+(respuesta['descuento'].estatus === 1 ? 'checked' :'')+' class="form-check" disabled></td>'+
                     '<td class="col-sm-2">'+
                     '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                     '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta['descuento'].id+'" disabled="disabled" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                     '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                     '</td>'+
                     '</tr>';
                     $('#tbodyDesc').append(fila);
                     $.each(respuesta['familias'],function(index,familia){
                     var optionsFam = '<option value="'+familia.id+'" '+(familia.id===respuesta['descuento'].familia_id ? 'selected': '')+' >'+familia.descripcion+'</option>';
                     $('#familiaDesc_'+respuesta['descuento'].id).append(optionsFam);
                     });
                     $('#btn_guardarDesc').prop('disabled',false);
                     $('#descrDesc_0').val('');
                     $('#familiaDesc_0').val('-1');
                     $('#descDesc_0').val('');
                     $('#fechaInicioDesc_0').val('');
                     $('#fechaFinDesc_0').val('');
                     break;

                     case 'FormaPago':
                     var tr =  '<tr id="tr_'+respuesta.id+'" class="" >'+
                     '<td class="col-md-6 col-sm-6"><input type="text" id="descrFormaPago_'+respuesta.id+'" name="" value="'+respuesta.descripcion+'" disabled="disabled" class="form-control"></td>'+
                     '<td class="col-md-6 col-sm-6" style="text-align: center;">'+
                     '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="FormaPago" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                     '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="FormaPago" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                     '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="FormaPago" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                     '</td>'+
                     '</tr>';
                     $('#tbodyFormaPago').append(tr);
                     $('#descrFormaPago_0').val('');
                     break;
                     case 'Importador':
                     var tr =  '<tr id="tr_'+respuesta.id+'">'+
                     '<td class="col-xs-6"><input type="text" id="nomImportador_'+respuesta.id+'"  value="'+respuesta.nombre+'" disabled class="form-control"></td>'+
                     '<td class="col-xs-6" style="text-align: center">'+
                     '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Importador" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                     '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Importador" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                     '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Importador" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                     '</td>'+
                     '</tr>';
                     $('#tbodyImportador').append(tr);
                     $('#nomImportador_0').val('');
                     break;
                     case 'Usuario':
                     var trUsuario = '<tr id="tr_'+respuesta.id+'">'+
                     '<td class="col-xs-2"><input type="text" id="usuario_'+respuesta.id+'"  value="'+respuesta.usuario+'" disabled class="form-control"></td>'+
                     '<td class="col-xs-2"><input type="password" id="contraseñaUsuario_'+respuesta.id+'" value="" placeholder="Ingrese nueva contraseña" disabled class="form-control"  maxlength="12"></td>'+
                     '<td class="col-xs-3"><input type="email" id="emailUsuario_'+respuesta.id+'" value="'+respuesta.email+'" disabled class="form-control"></td>'+
                     '<td class="col-xs-2"><select id="rolUsuario_'+respuesta.id+'" name="" class="form-control options" value="" required disabled="">'+
                     '<option value="2">Agente</option>'+
                     '<option value="3">administrador</option>'+
                     '<option value="4">Contabilidad</option>'+
                     '</select>'+
                     '</td>'+
                     '<td class="col-xs-3" style="text-align: center">'+
                     '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Usuario" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                     '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Usuario" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                     '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Usuario" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                     '</td>'+
                     '</tr>';
                     $('#tbodyUsuario tr:first').after(trUsuario);
                     $('#rolUsuario_'+respuesta.id).val(respuesta.rol_id);
                     $('#usuario_0').val('');
                     $('#contraseñaUsuario_0').val('');
                     $('#emailUsuario_0').val('');
                     $('#rolUsuario_0').val('-1');
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
                     case 'ProductoPrecio':
                     $('#btn_guardarPrecioProd').prop('disabled',false);
                     break;
                     case 'Descuentos':
                     $('#btn_guardarDesc').prop('disabled',false);
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
                     $('#clave_'+respuesta.id).prop('disabled',true);
                     $('#nombre_'+respuesta.id).prop('disabled',true);
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
                     //$('#nombre_'+respuesta.id).val(respuesta.nombre);
                     $('#nombre_'+respuesta.id).prop('disabled',true);
                     $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                     break;

                     case 'NivelDescuento':
                     $('#descripcion_'+id_upd).prop('disabled',true);
                     $('#descuento_'+id_upd).prop('disabled',true);
                     $('#estatus_'+id_upd).prop('disabled',true);
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

                     case 'ProductoPrecio':
                     $('#precio_'+id_upd).prop('disabled',true);
                     $('#tipoPrecio_'+id_upd).prop('disabled',true);
                     $('#monedaProd_'+id_upd).prop('disabled',true);
                     $('#fechaInicioProdPrecio_'+id_upd).prop('disabled',true);
                     $('#fechaFinProdPrecio_'+id_upd).prop('disabled',true);
                     $('#estatusPrecioProd_'+id_upd).prop('disabled',true);
                     $('#btn_guardarPrecioProd_'+id_upd).prop('disabled',true);
                     break;
                     case 'Descuentos':
                     $('#descrDesc_'+id_upd).prop('disabled',true);
                     $('#familiaDesc_'+id_upd).prop('disabled',true);
                     $('#descDesc_'+id_upd).prop('disabled',true);
                     $('#fechaInicioDesc_'+id_upd).prop('disabled',true);
                     $('#fechaFinDesc_'+id_upd).prop('disabled',true);
                     $('#estatusDesc_'+id_upd).prop('disabled',true);
                     $('#btn_guardarDesc'+id_upd).prop('disabled',true);
                     break;
                     case 'FormaPago':
                     $('#descrFormaPago_'+id_upd).prop('disabled',true);
                     break;
                     case 'Importador':
                     $('#nomImportador_'+id_upd).prop('disabled',true);
                     break;
                     case 'Usuario':
                     $('#usuario_'+id_upd).prop('disabled',true);
                     $('#contraseñaUsuario_'+id_upd).prop('disabled',true);
                     $('#emailUsuario_'+id_upd).prop('disabled',true);
                     $('#rolUsuario_'+id_upd).prop('disabled',true);
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
                     case 'Descuentos':
                     $('#btn_guardarDesc').prop('disabled',false);
                     break;
                     default:
                     $('#btn_guardar').prop('disabled',false);
                     $('#btn_guardar_'+id_upd).prop('disabled',false);
                     break;
                     }
                     }

                     });
                     }

                     }else{$(this).prop('disabled',false);} */
                }

            });

            $(document).on('click','#btn_enviar', function(){
                var datos = $(this).data('info');
                if ($(this).data('function')==='1') {
                    guardar1(datos);
                }else if ($(this).data('function')==='Producto') {
                    guardarProducto(datos);
                };

            })
            // FUNCION QU HACE LA LLAMADA A ENVIAR LOS DATOS A GUARDAR
            function guardar1(datos){

                if ($('#btn_enviar').val()==="Guardar") {
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
                                            '<td class="col-xs-6"> <input type="text" name="nombre_'+respuesta.id+'" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" class="form-control" required>  </td>' +
                                            '<td class="col-xs-6">'+
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
                                            '<td col-md-2 col-xs-1 col-sm-2> <input type="number" name="descuento_'+respuesta.id+'" value="'+respuesta.descuento+'" id="descuento_'+respuesta.id+'" disabled class="form-control" required>  </td>' +
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

                                case 'ProductoPrecio':
                                    var fila =  '<tr id="trProdPrecio_'+respuesta.id+'">'+
                                            '<td class="col-xs-2">'+
                                            '<div class="precio input-group  " style="padding: 5px;">'+
                                            '<span class="input-group-addon">'+
                                            '<span class="text-info">$</span>'+
                                            '</span>'+
                                            '<input type="number" onkeyup="" id="precio_'+respuesta.id+'"  value="'+respuesta.precio+'" class="form-control" min="0" disabled="">'+
                                            '</div>'+
                                            '</td>'+
                                            '<td class="col-xs-2">'+
                                            '<select id="tipoPrecio_'+respuesta.id+'" name="" class="form-control   options " value="" required disabled="">'+
                                            '<option value="-1">Seleccione tipo precio</option>'+
                                            '<option value="0">Compra</option>'+
                                            '<option value="1">Retail</option>'+
                                            '<option value="2">Mayorista</option>'+
                                            '<option value="3">Distribuidor</option>'+
                                            '</select>'+
                                            '</td>'+
                                            '<td class="col-xs-1">'+
                                            '<select id="monedaProd_'+respuesta.id+'" name="" class="form-control   options " value="" required disabled="">'+
                                            '<option value="-1">Seleccione tipo de moneda</option>'+
                                            '<option value="Pesos">Pesos Mx</option>'+
                                            '<option value="Dolar">Dolar</option>'+
                                            '<option value="Otro">Otro</option>'+
                                            '</select>'+
                                            '</td>'+
                                            '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaInicioProdPrecio_'+respuesta.id+'"  value="" class="form-control" disabled=""> </td>'+
                                            '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaFinProdPrecio_'+respuesta.id+'"  value="" class="form-control" disabled=""> </td>'+
                                            '<td class="col-xs-1"><input type="checkbox" id="estatusPrecioProd_'+respuesta.id+'"  value="" disabled></td>'+
                                            '<td class="col-xs-2">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardarPrecioProd_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="ProductoPrecio" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyProdPrecio').append(fila);
                                    $('#precio_0').val('');
                                    $('#tipoPrecio_'+respuesta.id).val(respuesta.tipo);
                                    $('#tipoPrecio_0').val('-1');
                                    $('#monedaProd_'+respuesta.id).val(respuesta.moneda);
                                    $('#monedaProd_0').val('-1');
                                    $('#fechaInicioProdPrecio_'+respuesta.id).val(respuesta.fechaInicio);
                                    $('#fechaInicioProdPrecio_0').val('');
                                    $('#fechaFinProdPrecio_'+respuesta.id).val(respuesta.fechaFin);
                                    $('#fechaFinProdPrecio_0').val('');
                                    $('#estatusPrecioProd_'+respuesta.id).prop('checked',(respuesta.estatus===1 ? true : false));
                                    $('#btn_guardarPrecioProd').prop('disabled',false);
                                    break;

                                case 'Descuentos':
                                    var fila =  '<tr id="tr_'+respuesta['descuento'].id+'">'+
                                            '<td class="col-sm-2"><input type="text" id="descrDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].descripcion+'" class="form-control" disabled=""></td>'+
                                            '<td class="col-sm-2"><select id="familiaDesc_'+respuesta['descuento'].id+'" name="" class="form-control options" value="" required disabled="">'+
                                            '</select> '+
                                            '</td>'+
                                            '<td class="col-sm-1"><input type="number" id="descDesc_'+respuesta['descuento'].id+'" name="" class="form-control" value="'+respuesta['descuento'].descuento+'" min="0" required disabled=""></td>'+
                                            '<td class="col-sm-2"><input type="date" id="fechaInicioDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].fecha_inicio+'" class="form-control" disabled=""></td>'+
                                            '<td class="col-sm-2"><input type="date" id="fechaFinDesc_'+respuesta['descuento'].id+'" name="" value="'+respuesta['descuento'].fecha_fin+'" class="form-control" disabled=""></td>'+
                                            '<td class="col-sm-1"><input type="checkbox" id="estatusDesc_'+respuesta['descuento'].id+'" name="" value="" '+(respuesta['descuento'].estatus === 1 ? 'checked' :'')+' class="form-check" disabled></td>'+
                                            '<td class="col-sm-2">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta['descuento'].id+'" disabled="disabled" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta['descuento'].id+'" data-cat="Descuentos" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyDesc').append(fila);
                                    $.each(respuesta['familias'],function(index,familia){
                                        var optionsFam = '<option value="'+familia.id+'" '+(familia.id===respuesta['descuento'].familia_id ? 'selected': '')+' >'+familia.descripcion+'</option>';
                                        $('#familiaDesc_'+respuesta['descuento'].id).append(optionsFam);
                                    });
                                    $('#btn_guardarDesc').prop('disabled',false);
                                    $('#descrDesc_0').val('');
                                    $('#familiaDesc_0').val('-1');
                                    $('#descDesc_0').val('');
                                    $('#fechaInicioDesc_0').val('');
                                    $('#fechaFinDesc_0').val('');
                                    break;

                                case 'FormaPago':
                                    var tr =  '<tr id="tr_'+respuesta.id+'" class="" >'+
                                            '<td class="col-md-6 col-sm-6"><input type="text" id="descrFormaPago_'+respuesta.id+'" name="" value="'+respuesta.descripcion+'" disabled="disabled" class="form-control"></td>'+
                                            '<td class="col-md-6 col-sm-6" style="text-align: center;">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="FormaPago" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="FormaPago" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="FormaPago" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyFormaPago').append(tr);
                                    $('#descrFormaPago_0').val('');
                                    break;
                                case 'Importador':
                                    var tr =  '<tr id="tr_'+respuesta.id+'">'+
                                            '<td class="col-xs-6"><input type="text" id="nomImportador_'+respuesta.id+'"  value="'+respuesta.nombre+'" disabled class="form-control"></td>'+
                                            '<td class="col-xs-6" style="text-align: center">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Importador" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Importador" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Importador" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyImportador').append(tr);
                                    $('#nomImportador_0').val('');
                                    break;
                                case 'Usuario':
                                    var trUsuario = '<tr id="tr_'+respuesta.id+'">'+
                                            '<td class="col-xs-2"><input type="text" id="usuario_'+respuesta.id+'"  value="'+respuesta.usuario+'" disabled class="form-control"></td>'+
                                            '<td class="col-xs-2"><input type="password" id="contraseñaUsuario_'+respuesta.id+'" value="" placeholder="Ingrese nueva contraseña" disabled class="form-control"  maxlength="12"></td>'+
                                            '<td class="col-xs-3"><input type="email" id="emailUsuario_'+respuesta.id+'" value="'+respuesta.email+'" disabled class="form-control"></td>'+
                                            '<td class="col-xs-2"><select id="rolUsuario_'+respuesta.id+'" name="" class="form-control options" value="" required disabled="">'+
                                            '<option value="2">Agente</option>'+
                                            '<option value="3">administrador</option>'+
                                            '<option value="4">Contabilidad</option>'+
                                            '</select>'+
                                            '</td>'+
                                            '<td class="col-xs-3" style="text-align: center">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Usuario" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Usuario" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Usuario" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyUsuario tr:first').after(trUsuario);
                                    $('#rolUsuario_'+respuesta.id).val(respuesta.rol_id);
                                    $('#usuario_0').val('');
                                    $('#contraseñaUsuario_0').val('');
                                    $('#emailUsuario_0').val('');
                                    $('#rolUsuario_0').val('-1');
                                    break;
                                case 'Familias':
                                    var tr =  '<tr>'+
                                            '<td class="col-sm-6"><input type="text" id="descrFam_'+respuesta.id+'" name="" value="'+respuesta.descripcion+'" class="form-control" disabled></td>'+
                                            '<td class="col-sm-2" style="text-align: center"><input type="checkbox" id="estatusFam_'+respuesta.id+'" name="" value="" class="form-check" '+(respuesta.estatus === 1 ? 'checked' :'')+' disabled></td>'+
                                            '<td class="col-sm-4" style="text-align: center">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" data-cat="Familias" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" data-cat="Familias" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="Familias" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                            '</tr>';
                                    $('#tbodyFamilia').append(tr);
                                    $('#descrFam_0').val('');
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
                                case 'ProductoPrecio':
                                    $('#btn_guardarPrecioProd').prop('disabled',false);
                                    break;
                                case 'Descuentos':
                                    $('#btn_guardarDesc').prop('disabled',false);
                                    break;
                                default:
                                    $('#btn_guardar').prop('disabled',false);
                                    break;
                            }
                        }

                    });
                }else if($('#btn_enviar').val()==="Actualizar"){

                    var id_upd= $('#btn_enviar').data('id');
                    // alert($(this).val() + id_upd);
                    $.ajax({
                        url:  "/catalogo/update/"+id_upd,
                        type: "PUT",
                        data: datos,
                        success: function (respuesta){
                            console.log(respuesta);
                            switch (catalogo){
                                case 'Almacen':
                                    $('#clave_'+respuesta.id).prop('disabled',true);
                                    $('#nombre_'+respuesta.id).prop('disabled',true);
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
                                    //$('#nombre_'+respuesta.id).val(respuesta.nombre);
                                    $('#nombre_'+respuesta.id).prop('disabled',true);
                                    $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                                    break;

                                case 'NivelDescuento':
                                    $('#descripcion_'+id_upd).prop('disabled',true);
                                    $('#descuento_'+id_upd).prop('disabled',true);
                                    $('#estatus_'+id_upd).prop('disabled',true);
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

                                case 'ProductoPrecio':
                                    $('#precio_'+id_upd).prop('disabled',true);
                                    $('#tipoPrecio_'+id_upd).prop('disabled',true);
                                    $('#monedaProd_'+id_upd).prop('disabled',true);
                                    $('#fechaInicioProdPrecio_'+id_upd).prop('disabled',true);
                                    $('#fechaFinProdPrecio_'+id_upd).prop('disabled',true);
                                    $('#estatusPrecioProd_'+id_upd).prop('disabled',true);
                                    $('#btn_guardarPrecioProd_'+id_upd).prop('disabled',true);
                                    break;
                                case 'Descuentos':
                                    $('#descrDesc_'+id_upd).prop('disabled',true);
                                    $('#familiaDesc_'+id_upd).prop('disabled',true);
                                    $('#descDesc_'+id_upd).prop('disabled',true);
                                    $('#fechaInicioDesc_'+id_upd).prop('disabled',true);
                                    $('#fechaFinDesc_'+id_upd).prop('disabled',true);
                                    $('#estatusDesc_'+id_upd).prop('disabled',true);
                                    $('#btn_guardarDesc'+id_upd).prop('disabled',true);
                                    break;
                                case 'FormaPago':
                                    $('#descrFormaPago_'+id_upd).prop('disabled',true);
                                    break;
                                case 'Importador':
                                    $('#nomImportador_'+id_upd).prop('disabled',true);
                                    break;
                                case 'Usuario':
                                    $('#usuario_'+id_upd).prop('disabled',true);
                                    $('#contraseñaUsuario_'+id_upd).prop('disabled',true);
                                    $('#emailUsuario_'+id_upd).prop('disabled',true);
                                    $('#rolUsuario_'+id_upd).prop('disabled',true);
                                    break;
                                case 'Familias':
                                    $('#descrFam_'+id_upd).prop('disabled',true);
                                    $('#estatusFam_'+id_upd).prop('disabled',true);
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
                                case 'Descuentos':
                                    $('#btn_guardarDesc').prop('disabled',false);
                                    break;
                                default:
                                    $('#btn_guardar').prop('disabled',false);
                                    $('#btn_guardar_'+id_upd).prop('disabled',false);
                                    break;
                            }
                        }

                    });
                }
                $('#modalConfirmacion').modal('hide');

            }


//::::::::::::::::::::::-----  ELIMINAR  ----::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::://
            $(document).on('click','#btn_Eliminar', function(){
                $('#btn_enviarEliminar').data('cat',$(this).data('cat'));
                $('#btn_enviarEliminar').data('id',$(this).data('id'));
                $('#modalConfirmEliminar').modal('show');
                //$('#btn_enviarEliminar').data('cat')
                //  alert(id_Elim+ " " + catalogo);
                /* if(confirmarEliminar()){
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

                 case 'ProductoPrecio':
                 $('#trProdPrecio_'+id_Elim).remove();
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
                 }*/
            });

            //:::-- FUNCION PARA HACER LA LLAMADA AJAX PARA ELIMINAR UN REGISTRO --::
            $(document).on('click','#btn_enviarEliminar', function(){
                catalogo = $(this).data('cat');
                var id_Elim= $(this).data('id');
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

                            case 'ProductoPrecio':
                                $('#trProdPrecio_'+id_Elim).remove();
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
                $('#modalConfirmEliminar').modal('hide');
            });


//::::::::::::::::::---     FUNCION PARA MOSTRAR LA FORMA EDITAR DE CLIENTE Y PROVEEDOR ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
            $(document).on('click', '#editarClienteProveedor', function () {
                $("#catalogo_principal").empty();
                var obj = $(this).data('info');
                vistaDetalles(obj,'Actualizar');
                $("#contenido_esp").show();
                $('#id_'+$(this).data('cat')).val(obj.id);  //ASIGNA EL ID DEL CLIENTE O PROVEEDOR, DEPENDIENDO DEL CATALOGO

            });

//:::::::::::::::::::-----  FUNCION PARA MOSTRAR LA FORMA NUEVO DE CLIENTE Y PROVEEDOR  ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
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

            //::-- FUNCIÓN PARA ABRIR EL PANEL DE DETALLESPRODUCTO Y AGREGAR UNO NUEVO ---::::::::::::::::://
            $(document).on('click','#nuevoProducto', function(){
                $('#catalogo_principal').empty();
                $('#catalogo_principal').hide();
                $('#panelProducto').show();
                var uMedidaProdOption = obtenerElementos('UMedidas',null); //::- RECUPERA LAS UNIDADES DE MEDIDA DISPONIBLES
                uMedidaProdOption.done(function(respuesta){
                    var optionUMedida = '<option value="-1">- Selecione unidad de medida -</option>';
                    $.each(respuesta,function(index,medidas){
                        console.log(medidas);
                        optionUMedida += '<option value="'+medidas.id+'" >'+medidas.descripcion+'</option>';
                    });
                    $('#uMedidaProd').html(optionUMedida);
                });
                var importadoresProdOption = obtenerElementos('Importadores',null); //::- rECUPERA LS IMPORTADORES DISPONIBLES
                importadoresProdOption.done(function(respuesta){
                    var optionsImport = '<option value="-1">- Selecione importador -</option>';
                    $.each(respuesta, function(index,importadores){
                        console.log(importadores);
                        optionsImport += '<option value="'+importadores.id+'" >'+importadores.nombre+'</option>';
                    });
                    $('#importadorProd').html(optionsImport);
                });
                var almacenesProdOption = obtenerElementos('Almacenes',null);
                almacenesProdOption.done(function(respuesta){
                    var optionsAlmacen = '<option value="-1">- Selecione almacen -</option>';
                    $.each(respuesta, function(index,almacenes){
                        console.log(almacenes);
                        optionsAlmacen += '<option value="'+almacenes.id+'" >'+almacenes.nombre+'</option>';
                    });
                    $('#almacenProd').html(optionsAlmacen);
                });
                var familiaProdOption = obtenerElementos('Familias',null);
                familiaProdOption.done(function(respuesta){
                    var optionsFam = '<option value="-1">- Selecione familia -</option>';
                    $.each(respuesta, function(index,familias){
                        optionsFam += '<option value="'+familias.id+'" >'+familias.descripcion+'</option>';
                    });
                    $('#familiaProd').html(optionsFam);
                });

            });
            //::-- FUNCIÓN PARA ABRIR EL PANEL DETALLESPRODUCTO Y LOS DETALLES DE UN PRODUCTO YA EXISTENTE, ASI COMO PARA MODIFICARLO
            $(document).on('click','#btn_editarProd', function(){
                var detProd=$(this).data('info');
                $('#catalogo_principal').empty();
                $('#catalogo_principal').hide();
                $('#panelProducto').show();
                $('#claveProd').val(detProd.clave);
                $('#numArtProd').val(detProd.numero_articulo);
                $('#nomProd').val(detProd.nomProd);
                $('#eanCodeProd').val(detProd.ean_code);
                $('#colorProd').val(detProd.color);
                $('#numColorProd').val(detProd.numero_color);
                var uMedidaProdOption = obtenerElementos('UMedidas',null); //::- RECUPERA LAS UNIDADES DE MEDIDA DISPONIBLES
                uMedidaProdOption.done(function(respuesta){
                    var optionUMedida = "";
                    $.each(respuesta,function(index,medidas){
                        console.log(medidas);
                        optionUMedida += '<option value="'+medidas.id+'" >'+medidas.descripcion+'</option>';
                    });
                    $('#uMedidaProd').html(optionUMedida);
                });
                var importadoresProdOption = obtenerElementos('Importadores',null); //::- RECUPERA LOS IMPORTADORES DISPONIBLES
                importadoresProdOption.done(function(respuesta){
                    var optionsImport = "";
                    $.each(respuesta, function(index,importadores){
                        console.log(importadores);
                        optionsImport += '<option value="'+importadores.id+'" >'+importadores.nombre+'</option>';
                    });
                    $('#importadorProd').html(optionsImport);
                });
                var almacenesProdOption = obtenerElementos('Almacenes',null);
                almacenesProdOption.done(function(respuesta){
                    var optionsAlmacen = "";
                    $.each(respuesta, function(index,almacenes){
                        console.log(almacenes);
                        optionsAlmacen += '<option value="'+almacenes.id+'" >'+almacenes.nombre+'</option>';
                    });
                    $('#almacenProd').html(optionsAlmacen);
                });
                var familiaProdOption = obtenerElementos('Familias',null);
                familiaProdOption.done(function(respuesta){
                    var optionsFam = "";
                    $.each(respuesta, function(index,familias){
                        optionsFam += '<option value="'+familias.id+'" >'+familias.descripcion+'</option>';
                    });
                    $('#familiaProd').html(optionsFam);
                });

                $('#uMedidaProd').val(detProd.unidad_medida_id);
                $('#piezasPaqProd').val(detProd.piezas_paquete);
                $('#DimenProd').val(detProd.dimensiones);
                $('#cantMinProd').val(detProd.cantidad_minima);
                $('#piezasPalletProd').val(detProd.piezas_pallet);
                $('#totalPiezasProd').val(detProd.total_piezas);
                $('#fotoProd').val();
                $('#importadorProd').val(detProd.importador_id);
                $('#almacenProd').val(detProd.almacen_id);
                $('#familiaProd').val(detProd.familia_id);
                $('#estatusWebProd').prop('checked',(detProd.estatus_web===1 ? true : false));
                $('#estatusWebProd').prop('disabled',false);
                $('#estatusProd').prop('checked',(detProd.estatus===1 ? true : false));
                $('#estatusProd').prop('disabled',false);
                $('#iva').prop('checked',(detProd.iva===1 ? true : false));
                $('#iva').prop('disabled',false);
                $('#btn_guardarProducto').data('id',detProd.idProd);
                $('#btn_guardarProducto').val('Actualizar')
                $('#precio_0').prop('disabled',false);
                $('#tipoPrecio_0').prop('disabled',false);
                $('#monedaProd_0').prop('disabled',false);
                $('#btn_guardarPrecioProd').prop('disabled',false);
                $('#fechaInicioProdPrecio_0').prop('disabled',false);
                $('#fechaFinProdPrecio_0').prop('disabled',false);
                $('#idProducto').val(detProd.idProd);
                $('#verFotoProd').data('id',detProd.foto);
                $('#verFotoProd').val(detProd.nomProd);

                var preciosProducto = obtenerElementos('ProductoPrecio',detProd.idProd);
                preciosProducto.done(function(respuesta){
                    console.log(respuesta);
                    $.each(respuesta,function(index,precios){
                        var fila = '<tr id="trProdPrecio_'+precios.id+'">'+
                                '<td class="col-xs-2">'+
                                /*'<div class="precio input-group  " style="padding: 5px;">'+
                                 '<span class="input-group-addon">'+
                                 '<span class="text-info">$</span>'+
                                 '</span>'+*/
                                '<input type="number" onkeyup="" id="precio_'+precios.id+'"  value="'+precios.precio+'" class="form-control" min="0" disabled="">'+
                                //'</div>'+
                                '</td>'+
                                '<td class="col-xs-2">'+
                                '<select id="tipoPrecio_'+precios.id+'" name="" class="form-control   options " value="" required disabled="">'+
                                '<option value="-1">Seleccione tipo precio</option>'+
                                '<option value="0">Compra</option>'+
                                '<option value="1">Retail</option>'+
                                '<option value="2">Mayorista</option>'+
                                '<option value="3">Distribuidor</option>'+
                                '</select>'+
                                '</td>'+
                                '<td class="col-xs-1">'+
                                '<select id="monedaProd_'+precios.id+'" name="" class="form-control   options " value="" required disabled="">'+
                                '<option value="-1">Seleccione tipo de moneda</option>'+
                                '<option value="Pesos">Pesos Mx</option>'+
                                '<option value="Dolar">Dolar</option>'+
                                '<option value="Otro">Otro</option>'+
                                '</select>'+
                                '</td>'+
                                '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaInicioProdPrecio_'+precios.id+'"  value="" class="form-control" disabled=""> </td>'+
                                '<td class="col-xs-2"><input type="date" onkeyup="" id="fechaFinProdPrecio_'+precios.id+'"  value="" class="form-control" disabled=""> </td>'+
                                '<td class="col-xs-1"><input type="checkbox" id="estatusPrecioProd_'+precios.id+'"  value="" disabled></td>'+
                                '<td class="col-xs-2">'+
                                '<button type="button" value="Modificar" id="btn_mod" data-id="'+precios.id+'" data-cat="ProductoPrecio" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                '<button type="button" value="Actualizar" id="btn_guardarPrecioProd_'+precios.id+'" disabled="disabled" data-id="'+precios.id+'" data-cat="ProductoPrecio" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+precios.id+'" data-cat="ProductoPrecio" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                '</td>'+
                                '</tr>';
                        $('#tbodyProdPrecio').append(fila);
                        $('#tipoPrecio_'+precios.id).val(precios.tipo);
                        $('#monedaProd_'+precios.id).val(precios.moneda);
                        $('#fechaInicioProdPrecio_'+precios.id).val(precios.fechaInicio);
                        $('#fechaFinProdPrecio_'+precios.id).val(precios.fechaFin);
                        $('#estatusPrecioProd_'+precios.id).prop('checked',(precios.estatus===1 ? true : false));
                    });
                });

            });

            //:::::--   FUNCION PARA ABRIR EL MODAL Y VER LA FOTO DEL PRODUCTO
            $(document).on('click','#verFotoProd',function(){
                foto = $(this).data('id');
                nombre = $(this).val();
                $('#fotopro').prop('src','\\img\\productos\\'+foto);
                $('.t-foto').text(nombre);
                $('#modalFotoProd').modal({
                    show: 'false'
                });
            });

            //::-- FUNCION PARA GUARDAR UN PRODUCTO --:://
            $(document).on('click','#btn_guardarProducto', function(){
                $(this).prop('disabled',true);
                var msg="";
                var validar = true;
                if ($('#claveProd').val().trim() === ""){
                    //$('.claveProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese clave del producto.';
                    validar = false;
                }else{
                    $('.claveProd').removeClass('has-error');
                }
                if ($('#numArtProd').val().trim() === ""){
                    //$('.numArtProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese numero de articulo.';
                    validar = false;
                }else{
                    $('.numArtProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#nomProd').val().trim() === ""){
                    //$('.nomProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese nombre.';
                    validar = false;
                }else{
                    $('.nomProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#eanCodeProd').val().trim() === ""){
                    $('.eanCodeProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese Ean-code.';
                    validar = false;
                }else{
                    $('.eanCodeProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#colorProd').val().trim() === ""){
                    $('.colorProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese color.';
                    validar = false;
                }else{
                    $('.colorProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#numColorProd').val().trim() === ""){
                    $('.numColorProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese número de color.';
                    validar = false;
                }else{
                    $('.numColorProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#DimenProd').val().trim() === ""){
                    $('.DimenProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese dimensiones.';
                    validar = false;
                }else{
                    $('.DimenProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#cantMinProd').val().trim() === ""){
                    $('.cantMinProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese cantidad minima.';
                    validar = false;
                }else{
                    $('.cantMinProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#piezasPaqProd').val().trim() === ""){
                    $('.piezasPaqProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese N° piezas.';
                    validar = false;
                }else{
                    $('.piezasPaqProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#piezasPalletProd').val().trim() === ""){
                    $('.piezasPalletProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese N° piezas pallet.';
                    validar = false;
                }else{
                    $('.piezasPalletProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#totalPiezasProd').val().trim() === ""){
                    $('.totalPiezasProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Ingrese total piezas.';
                    validar = false;
                }else{
                    $('.totalPiezasProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#uMedidaProd').val().trim() === "-1"){
                    $('.uMedidaProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione unidad de medida.';
                    validar = false;
                }else{
                    $('.uMedidaProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#importadorProd').val().trim() === "-1"){
                    $('.importadorProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione un importador.';
                    validar = false;
                }else{
                    $('.importadorProd').removeClass('has-error');
                }
                if ($('#almacenProd').val().trim() === "-1"){
                    $('.almacenProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione un almacen.';
                    validar = false;
                }else{
                    $('.almacenProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($('#familiaProd').val().trim() === "-1"){
                    $('.familiaProd'+$(this).data('id')).addClass('has-error');
                    msg += ';Seleccione una familia.';
                    validar = false;
                }else{
                    $('.familiaProd'+$(this).data('id')).removeClass('has-error');
                }
                if ($(this).val()==="Guardar") {
                    if ($('#fotoProd').val().trim() === ""){
                        $('.fotoProd'+$(this).data('id')).addClass('has-error');
                        msg += ';Elija una foto.';
                        validar = false;
                    }else{
                        $('.fotoProd'+$(this).data('id')).removeClass('has-error');
                    }
                };
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
                    var datos = new FormData();
                    datos.append('claveProd',$('#claveProd').val().trim());
                    datos.append('numArtProd',$('#numArtProd').val().trim());
                    datos.append('nomProd',$('#nomProd').val().trim());
                    datos.append('eanCodeProd',$('#eanCodeProd').val().trim());
                    datos.append('colorProd',$('#colorProd').val().trim());
                    datos.append('numColorProd',$('#numColorProd').val().trim());
                    datos.append('uMedidaProd',$('#uMedidaProd').val().trim());
                    datos.append('DimenProd',$('#DimenProd').val().trim());
                    datos.append('cantMinProd',$('#cantMinProd').val().trim());
                    datos.append('piezasPaqProd',$('#piezasPaqProd').val().trim());
                    datos.append('piezasPalletProd',$('#piezasPalletProd').val().trim());
                    datos.append('totalPiezasProd',$('#totalPiezasProd').val().trim());
                    datos.append('importadorProd',$('#importadorProd').val().trim());
                    datos.append('almacenProd',$('#almacenProd').val().trim());
                    datos.append('familiaProd',$('#familiaProd').val().trim());
                    datos.append('fotoProd',$('#fotoProd')[0].files[0]);
                    datos.append('estatusWebProd',(($('#estatusWebProd').is(':checked')) ? '1' : '0'));
                    datos.append('estatusProd',(($('#estatusProd').is(':checked')) ? '1' : '0'));
                    datos.append('iva',(($('#iva').is(':checked')) ? '1' : '0'));
                    datos.append('catalogo','Producto');
                    datos.append('tipoMov',$(this).val());
                    $('#btn_enviar').val($(this).val());
                    $('#btn_enviar').data('id',$(this).data('id'));
                    $('#btn_enviar').data('info',datos);
                    $('#btn_enviar').data('function','Producto'); //hace referencia para saber que funcion abrira
                    $('#modalConfirmacion').modal('show');
                    /* if(confirmar()){

                     if ($(this).val()==="Guardar") {
                     $.ajax({    //--- INICIA LA CONEXION MEDIANTE AJAX ---//
                     url: "/catalogo/create",
                     type: "POST",
                     data: datos,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: function(respuesta){
                     console.log(respuesta);
                     alertas('success',"Datos almacenados correctamente");
                     $('#btn_guardarProducto').val('Actualizar');
                     $('#btn_guardarProducto').data('id',respuesta.idProd);
                     $('#btn_guardarProducto').prop('disabled',false);
                     $('#precio_0').prop('disabled',false);
                     $('#tipoPrecio_0').prop('disabled',false);
                     $('#monedaProd_0').prop('disabled',false);
                     $('#fechaInicioProdPrecio_0').prop('disabled',false);
                     $('#fechaFinProdPrecio_0').prop('disabled',false);
                     $('#btn_guardarPrecioProd').prop('disabled',false);
                     $('#idProducto').val(respuesta.idProd);
                     },
                     error: function(msgError){
                     console.log(msgError.responseText);

                     var arreglo=msgError.responseText.split(';');
                     for (var i=0; i<arreglo.length;i++){
                     if(arreglo[i]!=='' && arreglo[i]!=="\""){
                     alertas('error',arreglo[i]);
                     }
                     }
                     $('#btn_guardarProducto').prop('disabled',false);
                     }
                     });
                     }else if($(this).val()==="Actualizar"){

                     var id_upd = $(this).data('id');
                     datos.append('id_upd',id_upd);
                     console.log(datos, id_upd);
                     $.ajax({
                     url:  "/catalogo/update/"+id_upd,
                     type: "POST",
                     data: datos,
                     cache: false,
                     contentType: false,
                     processData: false,
                     success: function (respuesta){
                     console.log(respuesta);
                     alertas('success',"Datos actualizados correctamente");
                     $('#btn_guardarProducto').prop('disabled',false);

                     },
                     error: function(msgError){
                     console.log(msgError);

                     var arreglo=msgError.responseText.split(';');
                     for (var i=0; i<arreglo.length;i++){
                     if(arreglo[i]!=='' && arreglo[i]!=="\""){
                     alertas('error',arreglo[i]);
                     }
                     }
                     $('#btn_guardarProducto').prop('disabled',false);
                     }
                     });
                     }
                     }else{
                     $(this).prop('disabled',false);
                     }*/
                }
            });

            function guardarProducto(datos){
                if ($('#btn_enviar').val()==="Guardar") {
                    $.ajax({    //--- INICIA LA CONEXION MEDIANTE AJAX ---//
                        url: "/catalogo/create",
                        type: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta){
                            console.log(respuesta);
                            alertas('success',"Datos almacenados correctamente");
                            $('#btn_guardarProducto').val('Actualizar');
                            $('#btn_guardarProducto').data('id',respuesta.idProd);
                            $('#btn_guardarProducto').prop('disabled',false);
                            $('#precio_0').prop('disabled',false);
                            $('#tipoPrecio_0').prop('disabled',false);
                            $('#monedaProd_0').prop('disabled',false);
                            $('#fechaInicioProdPrecio_0').prop('disabled',false);
                            $('#fechaFinProdPrecio_0').prop('disabled',false);
                            $('#btn_guardarPrecioProd').prop('disabled',false);
                            $('#idProducto').val(respuesta.idProd);
                        },
                        error: function(msgError){
                            console.log(msgError.responseText);

                            var arreglo=msgError.responseText.split(';');
                            for (var i=0; i<arreglo.length;i++){
                                if(arreglo[i]!=='' && arreglo[i]!=="\""){
                                    alertas('error',arreglo[i]);
                                }
                            }
                            $('#btn_guardarProducto').prop('disabled',false);
                        }
                    });
                }else if($('#btn_enviar').val()==="Actualizar"){

                    var id_upd = $('#btn_enviar').data('id');
                    datos.append('id_upd',id_upd);
                    console.log(datos, id_upd);
                    $.ajax({
                        url:  "/catalogo/update/"+id_upd,
                        type: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (respuesta){
                            console.log(respuesta);
                            alertas('success',"Datos actualizados correctamente");
                            $('#btn_guardarProducto').prop('disabled',false);

                        },
                        error: function(msgError){
                            console.log(msgError);

                            var arreglo=msgError.responseText.split(';');
                            for (var i=0; i<arreglo.length;i++){
                                if(arreglo[i]!=='' && arreglo[i]!=="\""){
                                    alertas('error',arreglo[i]);
                                }
                            }
                            $('#btn_guardarProducto').prop('disabled',false);
                        }
                    });
                }
                $('#modalConfirmacion').modal('hide');
            }

            $(function(){
                $('table.data-table.sort').dataTable( {
                    "bPaginate": false,
                    "iDisplayLength": 500,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
                $('table.data-table.full').dataTable( {
                    "bPaginate": true,
                    "iDisplayLength": 500,
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
            $('#btn_guardarDescuento').prop('disabled',false);
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
