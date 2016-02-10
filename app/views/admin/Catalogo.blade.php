@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')

<div class="content">
  <div class="row contenido-principal">
      <div class="titulo_catalogo" >
         <h2>Catálogo    {{$catalogo }} {{}} </h2>
      </div>
      <div class="col-md-12 main-content" id="catalogo_principal" class="panel-body">
              @include('layouts/inc/estatus')
                      <?php                           
                      switch ($catalogo) {
                        case 'Almacen':      ?>
                            <div class="table-responsive">
                            <table id="tablaResult" class="table table-first-column-check data-table display full table-condensed">
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
                                    <td><input type="checkbox" id="status_0" name="status" value=1 checked="true" class="checkbox"></td>
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
                                      <td> <input type="checkbox" name="status_{{$almacen->id}}" value="{{$almacen->estatus}}"  id="status_{{$almacen->id}}" disabled="disabled" <<?php  if ($almacen->estatus==1) {?> checked <?php } ?> class="form-check"> </td>
                                      
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
                            <button type="button" value="Nuevo" id="nuevo" class="editar btn btn-primary" data-info=''><span class="glyphicon glyphicon-">NUEVO</span></button>
                          </div>
                          <div class="table-responsive">
                          <table class="table table-first-column-check data-table display full table-condensed" id="tablaResult">
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
                            
                            <form class="form-group"> 
                              <tr id="tr_{{$cliente->id}}">
                                <td><input type="text" id="rfc_{{$cliente->id}}"  value="{{$cliente->rfc}} " disabled="disabled"   class="form-control input-xlarge"></td>
                                <td><input type="text" id="usuario_id_{{$cliente->id}}"  value="{{$cliente->usuario}}" disabled="disabled" class="form-control"></td>
                                <td><input type="text" id="agente_id_{{$cliente->id}}"  value="{{$cliente->agente}}" disabled="disabled" class="form-control"></td>
                                <td><input type="text" id="numero_cliente_{{$cliente->id}}"  value="{{$cliente->numero_cliente}}" disabled="disabled" class="form-control"></td>
                                <td style="width: 150px; height: 25px; ">
                                  <button type="button" value="Modificar" id="editarCliente" data-id="{{$cliente->id}}" class="editar btn btn-primary" data-info='{{json_encode($cliente,JSON_HEX_APOS)}}'><span class="glyphicon glyphicon-edit"></span></button>
                                <!--  <input type="hidden" id="campo_id{{$cliente->id}}" value="{{$cliente->id}}" name="campo_id" >
                                  <button type="button" value="Actualizar" id="btn_actualizar_{{$cliente->id}}" disabled="disabled" data-id="{{$cliente->id}}" > Act</button> -->
                                  <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$cliente->id}}" data-cat="Cliente" data-info="{{$cliente->idUsuario}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>
                                </td>
                              </tr>
                            </form> 

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
                                        <input type="hidden" id="tipoMov_0" value="Guardar" name="">
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
                                <tr>
                                  <td>
                                     <p>NO HAY DATOS PARA MOSTRAR</p>
                                  </td>
                               
                                </tr>
                                @endforelse
                            </tbody>
                          </table>

                        <?php
                          break;
                        case 'NivelDescuento':      ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th>Descripcion</th>
                                <th>Decuento</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="descripcion_0"  value="" ></td>
                                    <td><input type="text" id="descuento_0"  value="" ></td>
                                    <td>
                                        <input type="hidden" id="tipoMov_0" value="Guardar" name="">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" class="enviarG"> guardar </button>
                                    </td>
                                  </tr>
                                </form>
                               @forelse($descuentos as $descuento)

                                <tr id="tr_{{$descuento->id}}">
                                  <td><input type="text" id="descripcion_{{$descuento->id}}" name="descripcion_{{$descuento->id}}" value="{{$descuento->descripcion}}" disabled="disabled"></td>
                                  <td><input type="text" id="descuento_{{$descuento->id}}" name="descuento_{{$descuento->id}}" value="{{$descuento->descuento}}" disabled="disabled"></td>
                                  <td>
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$descuento->id}}" class="modificar">Mod</button>
                                    <input type="hidden" id="catalogo_{{$descuento->id}}" value="NivelDescuento">
                                    <input type="hidden" id="campo_id{{$descuento->id}}" value="{{$descuento->id}}" name="" >
                                    <input type="hidden" id="tipoMov_{{$descuento->id}}" value="Actualizar"  >
                                    <button type="button" value="Actualizar" id="btn_actualizar_{{$descuento->id}}" disabled="disabled" data-id="{{$descuento->id}}" class="enviarG"> Act</button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$descuento->id}}"> Eliminar</button>
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

                      
                           <?php 
                          break; 

                        case 'FormaPago':  ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th>Descripcion</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="nombre_0" name="nombre_0" value="" ></td>

                                    <td>
                                        <input type="hidden" id="tipoMov_0" value="Guardar" name="">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" class="enviarG"> guardar </button>
                                    </td>
                                  </tr>
                                </form>
                               
                            </tbody>
                          </table>

                        <?php
                          break; 


                        case 'UnidadMedida':  ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th>Descripcion</th>
                                <th>Estatus</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="descripcion_0" name="descripcion_0" value="" ></td>
                                    <td><input type="checkbox" id="estatus_0" name="status" value=1 checked="true"></td>

                                    <td>
                                        <input type="hidden" id="tipoMov_0" value="Guardar" name="">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" class="enviarG"> guardar </button>
                                    </td>
                                  </tr>
                                </form>
                                  @forelse($unidadMedida as $uMedida)

                                <tr id="tr_{{$uMedida->id}}">
                                  <td><input type="text" id="descripcion_{{$uMedida->id}}"  value="{{$uMedida->descripcion}}" disabled="disabled"></td>
                                  <td> <input type="checkbox"  value="{{$uMedida->estatus}}"  id="estatus_{{$uMedida->id}}" disabled="disabled" <<?php  if ($uMedida->estatus==1) {?> checked <?php } ?> > </td>
                                  <td>
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$uMedida->id}}" class="modificar">Mod</button>
                                    <input type="hidden" id="campo_id{{$uMedida->id}}" value="{{$uMedida->id}}" name="" >
                                    <input type="hidden" id="tipoMov_{{$uMedida->id}}" value="Actualizar"  >
                                    <button type="button" value="Actualizar" id="btn_actualizar_{{$uMedida->id}}" disabled="disabled" data-id="{{$uMedida->id}}" class="enviarG"> Act</button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$uMedida->id}}"> Eliminar</button>
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

                        <?php
                          break; 

                        case 'Rol':  ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="nombre_0" value="" ></td>
                                    <td>
                                        <input type="hidden" id="tipoMov_0" value="Guardar" name="">
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" class="enviarG"> guardar </button>
                                    </td>
                                  </tr>
                                </form>
                                  @forelse($rol as $rol)

                                <tr id="tr_{{$rol->id}}">
                                  <td><input type="text" id="nombre_{{$rol->id}}"  value="{{$rol->nombre}}" disabled="disabled"></td>
                                  
                                  <td>
                                    <button type="button" value="Modificar" id="btn_mod" data-id="{{$rol->id}}" class="modificar">Mod</button>
                                    <input type="hidden" id="campo_id{{$rol->id}}" value="{{$rol->id}}" name="" >
                                    <input type="hidden" id="tipoMov_{{$rol->id}}" value="Actualizar"  >
                                    <button type="button" value="Actualizar" id="btn_actualizar_{{$rol->id}}" disabled="disabled" data-id="{{$rol->id}}" class="enviarG"> Act</button>
                                    <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$rol->id}}"> Eliminar</button>
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

                        <?php
                          break; 

                        case 'Proveedor': ?>
                            <table class="table table-first-column-check" id="tablaResult">
                              <thead>
                                <tr>
                                  <th >Nombre</th>
                                  <th>Nombre comercial</th>
                                  <th>Razon social</th>
                                  <th>Estatus</th>
                                  <th>Comercializador</th>
                                  <th>Accion</th>
                                </tr>
                              </thead>
                              <tbody>   
                                 @forelse($proveedor as $proveedor)

                                  <tr id="tr_{{$proveedor->id}}">
                                    <td><input type="text" id="nombre_{{$proveedor->id}}"  value="{{$proveedor->nombre}}" disabled="disabled" class="form-control"></td>
                                    <td><input type="text" id="nombre_comercial_{{$proveedor->id}}"  value="{{$proveedor->nombre_comercial}}" disabled="disabled" class="form-control"></td>
                                    <td><input type="text" id="razon_social_{{$proveedor->id}}"  value="{{$proveedor->razon_social}}" disabled="disabled" class="form-control"></td>
                                    <td><input type="checkbox" id="status_0" name="status" value=1 checked="true"></td>
                                    <td><input type="text" id="comercializador_{{$proveedor->id}}"  value="{{$proveedor->comercializador}}" disabled="disabled" class="form-control"></td>
                                    <td>
                                      <button type="button" value="Modificar" id="btn_mod" data-id="{{$proveedor->id}}" class="modificar">Mod</button>
                                      <input type="hidden" id="campo_id{{$proveedor->id}}" value="{{$proveedor->id}}" name="" >
                                      <input type="hidden" id="tipoMov_{{$proveedor->id}}" value="Actualizar"  >
                                      <button type="button" value="Actualizar" id="btn_actualizar_{{$proveedor->id}}" disabled="disabled" data-id="{{$proveedor->id}}" class="enviarG"> Act</button>
                                      <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$proveedor->id}}"> Eliminar</button>
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

                          <?php
                          break;
                        case 'Pais': ?>
                          <table class="table table-first-column-check" id="tablaResult">
                            <thead>
                              <tr>
                                <th style="width: 200px;">Pais</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                                <form>
                                  <tr>
                                    <td><input type="text" id="pais_0" name="pais_0" value="" class="form-control"></td>
                                    <td>
                                      <!--  <input type="hidden" id="tipoMov_0" value="Guardar" name=""> -->
                                        <button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0" data-cat="Pais" class="enviarG btn btn-success"> <span class="glyphicon glyphicon-">OK</span> </button>
                                    </td>
                                  </tr>
                                </form>
                                @forelse($pais as $pais)
                                <form>
                                <tr id="tr_{{$pais->id}}">
                                  <td><input type="text" id="pais_{{$pais->id}}" name="nombre_{{$pais->id}}" value="{{$pais->nombre}}" disabled="disabled" class="form-control"></td>
                                  <td>
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

                        <?php
                          break;
                        default:
                          # code...
                          break;
                      }
                      ?>
                        
                      
                        
                     
        </div>
      <div id="contenido_esp" class="panel-body" style="display: none">
        <div>
          <a href="/catalogo/{{$catalogo}}" type="button" class="btn-link"> REGRESAR </a>
        </div>
        <div id="detalles">
          <form class="add" id="addform">
            
          </form>
        </div>
        <div class="fancy-tab-container " id="tab">
             
        </div>
        
       
          
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

        case 'NivelDescuento':
            $('#descripcion_'+$(this).data('id')).prop('disabled',false);
            $('#descuento_'+$(this).data('id')).prop('disabled',false);
            $('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
          break;

        case 'UnidadMedida':
            $('#descripcion_'+$(this).data('id')).prop('disabled',false);
            $('#estatus_'+$(this).data('id')).prop('disabled',false);
            $('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
          break;

         case 'Rol':
            $('#nombre_'+$(this).data('id')).prop('disabled',false);
            $('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
          break;

         case 'TelefonoCliente':
            $('#telefono_'+$(this).data('id')).prop('disabled',false);
            $('#tipo_'+$(this).data('id')).prop('disabled',false);
            $('#estatusTel_'+$(this).data('id')).prop('disabled',false);
            $('#btn_guardar_'+$(this).data('id')).prop('disabled',false);
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
                
                if ($('#clave_'+$(this).data('id')).val() === ""){
                  msg += 'Ingrese la clave. \n';
                  validar = false;
               
                }
                if ($('#nombre_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese el nombre. \n';
                  validar = false;
                };  
              break;

              case 'Cliente':
                  if ($('#nombre_'+$(this).data('id')).val() === ""){
                  msg += 'Ingrese el nombre. \n';
                  validar = false;
                  }
                  if ($('#paterno_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese el apellido paterno. \n';
                    validar = false;
                  }
                  if ($('#materno_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese el apellido materno. \n';
                    validar = false;
                  }
                  if ($('#rfc_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese la el RFC. \n';
                    validar = false;
                  }
                  if ($('#nombre_comercial_'+$(this).data('id')).val() === ""){
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

                  if ($('#agenteCliente_'+$(this).data('id')).val() === "-1"){
                    msg += 'Seleccione un agente. \n';
                    validar = false;
                  }
                  if ($('#descuento_'+$(this).data('id')).val() === "-1"){
                    msg += 'Seleccione un descuento. \n';
                    validar = false;
                  }
                  if ($('#usuario_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese el usuario. \n';
                    validar = false;
                  }
                  if ($(this).data('info')==="Guardar"){
                    if ($('#password_'+$(this).data('id')).val() === ""){
                      msg += 'Ingrese la contraseña. \n';
                      validar = false;
                    }
                  }
                  if ($('#email_'+$(this).data('id')).val() === ""){
                    msg += 'Ingrese el email. \n';
                    validar = false;
                  }
                
              break;
            case 'Comercializador':
                if ($('#nombre_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese el nombre. \n';
                  validar = false;
                };  
                break;

            case 'NivelDescuento':
                if ($('#descripcion_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese la descripcion. \n';
                  validar = false;
                };  
                if ($('#descuento_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese el descuento. \n';
                  validar = false;
                };  
              break;

            case 'UnidadMedida':
                if ($('#descripcion_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese la descripcion. \n';
                  validar = false;
                };  
                var estatus=null;
                if ($('#estatus_'+$(this).data('id')).is(':checked')) {
                  estatus=1;
                }else{
                  estatus=0;
                }                 
              break;

            case 'Rol':
                if ($('#nombre_'+$(this).data('id')).val()==="") {
                  msg += 'Ingrese el nombre. \n';
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
                if ($('#telefono_'+$(this).data('id')).val() === ""){
                  msg += 'Ingrese el telefono. \n';
                  validar = false;
               
                }
                if ($('#tipo_'+$(this).data('id')).val()==="-1") {
                  msg += 'Seleccione el tipo de telefono. \n';
                  validar = false;
                };  

              break;

            case 'DireccionCliente':
                if ($('#pais').val() === ""){
                    msg += 'Seleccione un pais. \n';
                    validar = false;
                  }
                if ($('#estado').val() === ""){
                    msg += 'Seleccione un estado. \n';
                    validar = false;
                  }
                if ($('#municipio').val() === ""){
                    msg += 'Seleccione un municipio. \n';
                    validar = false;
                  }
                if ($('#calle1').val() === ""){
                    msg += 'Ingrese el nombre de la calle. \n';
                    validar = false;
                  }
                if ($('#colonia').val() === ""){
                    msg += 'Ingrese la colonia. \n';
                    validar = false;
                  }
                if ($('#delegacion').val() === ""){
                    msg += 'Ingrese la delegación. \n';
                    validar = false;
                  }
                if ($('#cp').val() === ""){
                    msg += 'Ingrese el Código Postal. \n';
                    validar = false;
                  }
                if ($('#tipoDir').val() === ""){
                    msg += 'Seleccione el tipo de domicilio. \n';
                    validar = false;
                  }
              break;

            default:
              
              break;

        }

        if(!validar){//------- PREGUNTA SI LAS VALIDACIONES SON INCORRECTAS MUESTRA UNA ADVERTENCIA CON LOS ERRORES ------------------//
          alert(msg);
          $(this).prop('disabled',false);
        }else {  //-- SI LAS VALIDACIONES SON CORRECTAS SE PROCEDE A RECOGER LOS DATOS A ENVIAR ---//
          if(confirmar()){

            switch (catalogo){ //--- SIWTCH PARA RECOGER LOS VALORES DEPENDIENDO DE EL ALMACEN DEL QUE SE TRATE  ---//

              case 'Almacen':
                var datos={
                    
                    clave   : $('#clave_'+$(this).data('id')).val(),
                    nombre  : $('#nombre_'+$(this).data('id')).val(),
                    estatus : estatus,
                    catalogo: catalogo,
                    tipoMov : $(this).val(),
                    id_upd  : $(this).data('id')
                };
                //alert('datos cargados: \n ' +datos['clave']+'\n ' +datos['nombre']+'\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
                break;

              case 'Cliente':
                  var datos = {
                    nombre              :   $('#nombre_'+$(this).data('id')).val(),
                    paterno             :   $('#paterno_'+$(this).data('id')).val(),
                    materno             :   $('#materno_'+$(this).data('id')).val(),
                    rfc                 :   $('#rfc_'+$(this).data('id')).val(),
                    nombre_comercial    :   $('#nombre_comercial_'+$(this).data('id')).val(),
                    razon_social        :   $('#razon_social_'+$(this).data('id')).val(),
                    //numeroCliente       :   $('#numeroCliente_'+$(this).data('id')).val(),
                    agente_id           :   $('#agenteCliente_'+$(this).data('id')).val(),
                    nivel_descuento_id  :   $('#descuento_'+$(this).data('id')).val(),
                    usuario             :   $('#usuario_'+$(this).data('id')).val(),
                    usuario_id             :   $('#usuario_id_'+$(this).data('id')).val(),
                    contraseña          :   $('#password_'+$(this).data('id')).val(),
                    email               :   $('#email_'+$(this).data('id')).val(),
                    catalogo            :   catalogo,
                    tipoMov             :   $(this).val(),
                    id_upd              :   $(this).data('id')
                  };
                  //alert('datos cargados: \n ' +datos['nombre']+'\n ' +datos['paterno']+'\n ' +datos['materno']+ '\n ' +datos['rfc']+'\n ' +datos['nombre_comercial']+'\n ' +datos['razon_social']+'\n ' +datos['agente_id']+ '\n ' +datos['nivel_descuento_id']+ '\n ' +datos['usuario']+ '\n '+datos['usuario_id']+ '\n ' +datos['contraseña']+ '\n ' +datos['email']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']);
                  break;

              case 'Comercializador':
                  var datos = {
                      nombre  : $('#nombre_'+$(this).data('id')).val(),
                      catalogo: catalogo,
                      tipoMov : $(this).val(),
                      id_upd  : $(this).data('id')
                  };
                  break;

              case 'Descuentos':
                  var datos = {
                      descripcion   : $('#descripcion_'+$(this).data('id')).val(),
                      descuento     : $('#descuento_'+$(this).data('id')).val(),
                      catalogo      : catalogo,
                      tipoMov       : $('#tipoMov_'+$(this).data('id')).val()
                  }
                break;

              case 'UnidadMedida':
                  var datos={
                      
                      descripcion   : $('#descripcion_'+$(this).data('id')).val(),
                      estatus       : estatus,
                      catalogo      : catalogo,
                      tipoMov       : $('#tipoMov_'+$(this).data('id')).val(),
                      id_upd        : $('#campo_id'+$(this).data('id')).val()
                  };
                break;

              case 'Rol':
                  var datos = {
                      nombre  : $('#nombre_'+$(this).data('id')).val(),
                      catalogo: catalogo,
                      tipoMov : $('#tipoMov_'+$(this).data('id')).val()
                  }
                break;

              case 'TelefonoCliente':
                  var datos={
                    
                    numero    : $('#telefono_'+$(this).data('id')).val(),
                    tipo      : $('#tipo_'+$(this).data('id')).val(),
                    cliente_id: $('#id_Cliente').val(),
                    estatus   : estatus,
                    catalogo  : catalogo,
                    tipoMov   : $(this).val(),
                    id_upd    : $(this).data('id')
                  };
                 // alert('datos cargados: \n ' +datos['numero']+'\n ' +datos['tipo']+'\n ' +datos['cliente_id']+ '\n ' +datos['estatus']+ '\n ' +datos['catalogo']+ '\n ' +datos['tipoMov']+ '\n ' +datos['id_upd'])
                break;
              case 'DireccionCliente':
                  
                  var datos={
                    
                    pais      : $('#pais').val(),
                    estado      : $('#estado').val(),
                    municipio      : $('#municipio').val(),
                    calle1      : $('#calle1').val(),
                    calle2      : $('#calle2').val(),
                    colonia      : $('#colonia').val(),
                    delegacion      : $('#delegacion').val(),
                    cp      : $('#cp').val(),
                    tipoDir :  $('#tipoDir').val(),
                    estatus : (($('#estatusDirCliente').is(':checked')) ? '1' : '0'),
                  //tipo      : $('#tipo').val(),
                    cliente_id: $('#id_Cliente').val(),
                  //  estatus   : estatus,
                    catalogo  : catalogo,
                    tipoMov   : $(this).val(),
                    id_upd    : $(this).data('id')
                  };
                break;

              default:
                break;

            }
            //alert($(this).val());
            if ($(this).val()==="Guardar") {
               // alert($(this).val());
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
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar">Mod</button>'+
                                            '<input type="hidden" id="catalogo_'+respuesta.id+'" value="Almacen"  >'+
                                            '<input type="hidden" id="campo_id'+respuesta.id+'" value="'+respuesta.id+'" name="campo_id" >'+
                                            '<input type="hidden" id="tipoMov_'+respuesta.id+'" value="Actualizar" name="" >'+
                                            '<button type="button" value="Actualizar" id="btn_actualizar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG"> Act</button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'"> Eliminar</button>'+
                                          '</td>'+
                                   '</tr>';
                        $('#tablaResult').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                        $('#clave_0').val('');
                        $('#nombre_0').val('');
                        
                        break;
                      
                      case 'Cliente':
                          vistaDetalles(respuesta,'Actualizar');
                          $("#contenido_esp").show();

                          break;

                      case 'TelefonoCliente':
                          var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td class="col-md-1"> <input type="text" value="'+respuesta.numero + '" id="telefono_'+respuesta.id+'" disabled="disabled" required class="form-control col-md-1">  </td>' +
                                      '<td class="col-md-1"> <input type="text" value="'+respuesta.tipo + '" id="tipo_'+respuesta.id+'" disabled="disabled" required class="form-control col-md-1">  </td>' +
                                      '<td ><input type="checkbox" value="'+respuesta.estatus+'"  id="estatusTel_'+respuesta.id+'" disabled="disabled" '+(respuesta.estatus===1 ? 'checked':'') +' > </td>' +
                                      '<td class="col-md-1">'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-cat="TelefonoCliente" data-id="'+respuesta.id+'" class="modificar">Mod</button>'+
                                            //'<input type="hidden" id="campo_id'+respuesta.id+'" value="'+respuesta.id+'" name="campo_id" >'+
                                            //'<input type="hidden" id="tipoMov_'+respuesta.id+'" value="Actualizar" name="" >'+
                                            '<button type="button" value="Actualizar" id="btn_guardar_'+respuesta.id+'" disabled="disabled" data-cat="TelefonoCliente" data-id="'+respuesta.id+'" class="enviarG"> Act</button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'" data-cat="TelefonoCliente" > Eliminar</button>'+
                                          '</td>'+
                                   '</tr>';
                          $('#tbodyCliente').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                          $('#telefono_0').val('');
                          $('#tipo_0').val('');
                          $('#btn_guardarTel').prop('disabled',false);
                        break;

                      case 'DireccionCliente':
                          var trDir = '<tr id="trDir_'+respuesta.idDir+'">'+
                                            '<form class="form-group" >'+
                                             '<td >'+respuesta.pais+'</td>'+ 
                                             '<td >'+respuesta.estados+'</td>'+ 
                                             '<td >'+respuesta.municipio+'</td>'+ 
                                             '<td >'+respuesta.delegacion+'</td>'+ 
                                             '<td >'+respuesta.colonia+'</td>'+ 
                                             '<td >'+respuesta.calle1+'</td>'+ 
                                             '<td >'+respuesta.calle2+'</td>'+ 
                                             '<td >'+respuesta.codigo_postal+'</td>'+ 
                                             '<td >'+respuesta.tipo+'</td>'+ 
                                             '<td id="tdDir_'+respuesta.idDir+'">'+respuesta.estatus+'</td>'+ 
                                             '<td >'+
                                              //'<button type="button" value="Modificar" id="btn_mod" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" data-info="'+direccion+'" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                              '<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" value="Modificar" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></a>'+
                                          //    '<input type="hidden" id="campo_id" value="" name="" >'+
                                           //   '<input type="hidden" id="tipoMov_" value="Actualizar"  >'+
                                           //   '<button type="button" value="Actualizar" id="btn_guardar_'+direccion.idDir+'" disabled="disabled" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" class="enviarG"> Act</button>'+
                                            //  '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.idDir+'" data-cat="DireccionCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                           
                                           '</form>'+
                                           '</tr>';
                                  $('#tbodyClienteDir').append(trDir);
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
                                        '<td> <input type="text" name="descripcion_'+respuesta.id+'" value="'+respuesta.descripcion+'" id="descripcion_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                        '<td> <input type="text" name="descuento_'+respuesta.id+'" value="'+respuesta.descuento_+'" id="descuento_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                      '<td>'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar">Mod</button>'+
                                            '<input type="hidden" id="campo_id'+respuesta.id+'" value="'+respuesta.id+'" name="campo_id" >'+
                                            '<input type="hidden" id="tipoMov_'+respuesta.id+'" value="Actualizar" name="tipoMov" >'+
                                            '<button type="button" value="Actualizar" id="btn_actualizar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG"> Act</button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'"> Eliminar</button>'+
                                          '</td>'+
                                      '</tr>';
                          $('#tablaResult').append(fila);
                          $('#descripcion_0').val('');
                          $('#descuento_0').val('');
                        break;

                      case 'UnidadMedida':
                        if (respuesta.estatus==1) {var activar="checked"};
                        var fila = '<tr id="tr_'+respuesta.id+'">' +
                                      '<td> <input type="text" value="'+respuesta.descripcion + '" id="descripcion_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                      '<td><input type="checkbox" value="'+respuesta.estatus+'"  id="estatus_'+respuesta.id+'" disabled="disabled" '+ activar+' > </td>' +
                                      '<td>'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar">Mod</button>'+
                                            '<input type="hidden" id="campo_id'+respuesta.id+'" value="'+respuesta.id+'" name="campo_id" >'+
                                            '<input type="hidden" id="tipoMov_'+respuesta.id+'" value="Actualizar" name="" >'+
                                            '<button type="button" value="Actualizar" id="btn_actualizar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG"> Act</button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'"> Eliminar</button>'+
                                          '</td>'+
                                   '</tr>';
                        $('#tablaResult').append(fila);  //--- AGREGA LOS DATOS EN UN NUEVO <tr> AL FINAL DE LA TABLA  ---//
                        $('#descripcion_0').val('');
                        
                        
                        break;
                      
                      case 'Rol':
                          var fila =  '<tr id="tr_'+respuesta.id+'">' +
                                        '<td> <input type="text" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                      '<td>'+
                                            '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'" class="modificar">Mod</button>'+
                                            '<input type="hidden" id="campo_id'+respuesta.id+'" value="'+respuesta.id+'" name="campo_id" >'+
                                            '<input type="hidden" id="tipoMov_'+respuesta.id+'" value="Actualizar" name="tipoMov" >'+
                                            '<button type="button" value="Actualizar" id="btn_actualizar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" class="enviarG"> Act</button>'+
                                            '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'"> Eliminar</button>'+
                                          '</td>'+
                                      '</tr>';
                          $('#tablaResult').append(fila);
                          $('#nombre_0').val('');
                        break;

                    }
                    alert('Los datos se han almacenado correctamente...');
                    $('#btn_guardar').prop('disabled',false);
                    
                  },
                  error: function(msgError){
                    console.log(msgError.responseJSON);
                    alert(msgError.responseJSON);
                    $('#btn_guardar').prop('disabled',false);
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
                      alert('Datos actualizados correctamente');

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
                            vistaDetalles(respuesta,'Actualizar');
                          $("#contenido_esp").show();    
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
                            $('#descripcion_'+respuesta.id).val(respuesta.descripcion);
                            $('#descuento_'+respuesta.id).val(respuesta.descuento);
                            $('#descripcion_'+respuesta.id).prop('disabled',true);
                            $('#descuento'+respuesta.id).prop('disabled',true);
                            $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                          break;

                        case 'UnidadMedida':
                            $('#descripcion_'+respuesta.id).val(respuesta.descripcion);
                            $('#descripcion_'+respuesta.id).prop('disabled',true);
                            if (respuesta.estatus==1) { $('#estatus_'+respuesta.id).prop('checked',true); }else{ $('#estatus_'+respuesta.id).prop('checked',false); } 
                            $('#estatus_'+respuesta.id).prop('disabled',true);
                            $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                          break;

                        case 'Rol':
                            $('#nombre_'+respuesta.id).val(respuesta.nombre);
                            $('#nombre_'+respuesta.id).prop('disabled',true);
                            $('#btn_guardar_'+respuesta.id).prop('disabled',true);
                          break;

                        case 'DireccionCliente':
                          var trDir = ''+
                                            '<form class="form-group" >'+
                                             '<td >'+respuesta.pais+'</td>'+ 
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
                                              //'<button type="button" value="Modificar" id="btn_mod" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" data-info="'+direccion+'" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                              '<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" value="Modificar" data-info=\''+JSON.stringify(respuesta)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></a>'+
                                          //    '<input type="hidden" id="campo_id" value="" name="" >'+
                                           //   '<input type="hidden" id="tipoMov_" value="Actualizar"  >'+
                                           //   '<button type="button" value="Actualizar" id="btn_guardar_'+direccion.idDir+'" disabled="disabled" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" class="enviarG"> Act</button>'+
                                           //   '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.idDir+'" data-cat="DireccionCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                           
                                           '</form>';
                                           
                                  //$('#trDir_'+respuesta.idDir).destroy();
                                  $('#trDir_'+respuesta.idDir).html(trDir);
                                  $('#myModal').modal('hide');
                        break;

                      }

                    },
                    error: function(error){
                      console.log(error);
                      alert(error.responseJSON);
                      $(this).prop('disabled',false);
                      $('#btn_guardar_'+id_upd).prop('disabled',false);
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
              alert('Datos eliminados');
              
              switch (catalogo){
                  case 'DireccionCliente':
                      $('#estatusDir_'+id_Elim).prop('checked',(datos.estatus===1 ? 'checked' : ''));
                    break;

                  default:
                    $('#tr_'+id_Elim).remove();
                    break;
              }
            },
            error: function(respuesta){
              console.log(respuesta);
              alert('no eliminado \n ' + respuesta.responseText);
            }
          });
        }
    });

//::::::::::::::::::---     FUNCION PARA MOSTRAR LA FORMA EDITAR  ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
    $(document).on('click', '#editarCliente', function () {
           // $("#catalogo_principal").hide();
            $("#catalogo_principal").empty();
            var obj = $(this).data('info');

            vistaDetalles(obj,'Actualizar');
            $("#contenido_esp").show();
            
        });

//:::::::::::::::::::-----  FUNCION PARA MOSTRAR LA FORMA NUEVO   ----::::::::::::::::::::::::::::::::::::::::::::::::::::://
    $(document).on('click','#nuevo',function(){
          $("#catalogo_principal").empty();
            var obj =null;

            vistaDetalles(obj,'Guardar');
            $("#contenido_esp").show();
    });
//:::::::::::::::::::----- FUNCION PARA EL CONTENIDO DE LOS TAB  ----:::::::::::::::::::::::::::::::::::::::::::::::::::::://
    function vistaDetalles(obj,tipoMovimiento){
        switch (catalogo){
                case 'Cliente':
                    var cont= '<div class="row">'+
                                '<div class="form-group col-md-3">'+
                                  '<label> NOMBRE:  </label>'+
                                  '<input type="text" id="nombre_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.nombre_cliente)+'" class="form-control"></td>'+
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> PATERNO:  </label>'+
                                  '<input type="text" id="paterno_'+(obj === null ? 0 : obj.id)+'" value="'+(obj === null ? '' : obj.paterno)+'" class="form-control"></td></p>'+
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> MATERNO:  </label>'+
                                  '<p><input type="text" id="materno_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.materno)+'" class="form-control">'+
                                '</div>'+
                               '</div>'+
                              '<div class="row">'+
                                '<div class="form-group col-md-3">'+
                                  '<label> RCF:  </label>'+
                                  '<input type="text" id="rfc_'+(obj === null ? '0' : obj.id)+'"  value="'+(obj === null ? '' : obj.rfc)+'" class="form-control">'+
                                '</div>'+
                                '<div class="form-group col-md-3" >'+
                                  '<label> NOMBRE COMERCIAL:  </label>'+
                                  '<input type="text" id="nombre_comercial_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.nombre_comercial)+'" class="form-control"></td>'+
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> RAZON SOCIAL:  </label>'+
                                  '<input type="text" id="razon_social_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.razon_social)+'" class="form-control"></td>  </p> '+
                                '</div>'+
                              '</div>'+
                              '<div class="row">'+
                                '<div class="form-group col-md-3">'+
                                  '<label> NUMERO DE CLIENTE:  </label>'+
                                  '<input type="text" id="numeroCliente_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.numero_cliente)+'" class="form-control" disabled></td>  </p> '+
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> AGENTE:  </label><br>'+
                                '<select id="agenteCliente_'+(obj === null ? '0' : obj.id)+'" name="" class="form-control input-default" value="" required>' +
                                // (obj === null ? '<option value="-1">--Selecione un agente--</option>'  : '<option value="0">'+obj.agente+'</option>')+
                                '</select>' +
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> DESCUENTO:  </label><br>'+
                                  '<select id="descuento_'+(obj === null ? '0' : obj.id)+'" name="" class="form-control input-default" value="" required>' +
                                //  (obj === null ? '<option value="-1">--Selecione descuento--</option>'  : '<option value="0">'+obj.descripcion+'</option>')+
                                  '</select>' +
                                '</div>'+
                              '</div>'+  
                              '<div class="row">'+
                                '<div class="form-group col-md-3">'+
                                  '<label> USUARIO:  </label>'+
                                  '<input type="text" id="usuario_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.usuario)+'" class="form-control" ></td>'+
                                  '<input type="hidden" id="usuario_id_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.idUsuario)+'" name="">'+  
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  //'<label> PASSWORD:  </label>'+
                                  (obj===null ? '<label> PASSWORD:  </label>':'<button type="button" class="btn-link" id="nuevaPass" data-id="'+obj.id+'">NUEVA PASSWORD</button>')+   
                                  '<input type="text" id="password_'+(obj === null ? '0' : obj.id)+'" value="" placeholder="Unicamente nueva contraseña" class="form-control" '+(obj===null ? '':'disabled')+'></td>'+
                                  
                                '</div>'+
                                '<div class="form-group col-md-3">'+
                                  '<label> EMAIL:  </label>'+
                                  '<input type="text" id="email_'+(obj === null ? '0' : obj.id)+'" value="'+(obj === null ? '' : obj.email)+'" class="form-control" ></td>'+
                                '</div>'+
                              '</div>'+
                              '<div class="row">'+
                                '<div class="form-action col-sm-offset-10">'+     
                                 // '<input type="hidden" id="tipoMov_'+(obj === null ? '0' : obj.id)+'" value="'+tipoMovimiento+'" name="">'+
                                 // '<input type="hidden" id="catalogo_'+(obj === null ? '0' : obj.id)+'" value="Cliente"  >'+                               
                                  '<button type="button" id="btn_guardar" name="btn_guardar" value="'+tipoMovimiento+'" data-id="'+(obj === null ? '0' : obj.id)+'" data-info="" data-cat="Cliente" class="enviarG"> guardar </button></td>'+
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
                                  $('#descuento_'+(obj === null ? '0' : obj.id)).append(descuento);
                              });

                    var widget = '<ul id="myTab" class="nav nav-tabs two-tabs fancy">'+
                                    '<li class="active"><a href="#telefono" data-toggle="tab">Telefono</a></li>'+
                                    '<li><a href="#direccion" data-toggle="tab">Direccion</a></li>'+
                                  '</ul>'+
                                  '<div class="tab-content">'+
                                    '<div class="tab-pane fade in active table-responsive" id="telefono">'+
                                      '<table id="telCliente" class="table table-first-column-number ">'+
                                       ' <thead >'+
                                          '<tr>'+
                                            '<th class="">Numero</th>'+
                                            '<th class="">Tipo</th>'+
                                            '<th class="">Status</th>'+
                                            '<th class=""></th>'+
                                          '</tr>'+
                                        '</thead>'+
                                        '<tbody id="tbodyCliente">'+
                                           '<form class="form-group">' +
                                           '<tr id="tr_0">'+
                                            '<td class="controls"><input type="text" id="telefono_0"  value="" class="input-xlarge form-control" '+(obj === null ? 'disabled' : '')+'> </td>'+
                                            '<td class="">'+
                                              '<select id="tipo_0" name="" class="input-xlarge form-control   options " value="" required>' +
                                                '<option value="-1">Seleccione el tipo</option>'+
                                                '<option value="Celular">Celular</option>'+
                                                '<option value="Fijo">Fijo</option>'+
                                                '<option value="Otro">Otro</option>'+
                                              '</select>' +
                                           // '<input type="text" id="tipo_0"  value="" class="form-control col-md-1" '+(obj === null ? 'disabled' : '')+'>
                                            '</td>'+
                                            '<td><input type="checkbox" id="estatusTel_0"  value="1"   checked disabled></td>'+
                                           
                                            '<td class="">'+
                                                '<input type="hidden" id="id_Cliente" value="'+(obj === null ? '' : obj.id)+'" name="">'+
                                               // '<input type="hidden" id="catalogo_t0" value="TelefonoCliente"  >'+
                                                '<button type="button" id="btn_guardarTel" name="btn_guardar" value="Guardar" data-id="0" data-cat="TelefonoCliente" class="enviarG  btn btn-success" '+(obj === null ? 'disabled' : '')+'>OK</button>'+
                                             '</td>'+
                                           '</tr>'+
                                            '</form>'+
                                           
                                        '</tbody>'+
                                      '</table>'+
                                    '</div>'+

                                    '<div class="tab-pane fade table-responsive" id="direccion">'+
                                      '<table id="dirCliente" class="table table-first-column-check">'+
                                       ' <thead>'+
                                          '<th><h3>Pais</h3></th>'+
                                          '<th><h3>Estado</h3></th>'+
                                          '<th><h3>municipio</h3></th>'+
                                          '<th><h3>Delegacion</h3></th>'+
                                          '<th><h3>Colonia</h3></th>'+
                                          '<th><h3>Calle 1</h3></th>'+
                                          '<th><h3>Calle 2</h3></th>'+
                                          '<th><h3>C.P.</h3></th>'+
                                          '<th><h3>Tipo</h3></th>'+
                                          '<th><h3>estatus</h3></th>'+
                                          '<th>'+
                                            '<a href="#myModal" role="button" class="btn btn-warning" data-toggle="modal" value="Guardar" id="editDirCliente"><span class="glyphicon glyphicon-open"></span></a>'+
                                          '</th>'+
                                        '</thead>'+
                                        '<tbody id="tbodyClienteDir">'+
                                           
                                        '</tbody>'+
                                      '</table>'+
                                    '</div>'+
                                    
                                //   <!-- Modal para direciones-->
                                        '<div id="myModal" class="modal fade" tabindex="-1"  data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >'+
                                          '<div class="modal-dialog" >'+
                                              '<div class="modal-content">'+
                                                  '<div class="modal-header">'+
                                                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
                                                     '<h3>DIRECCION</h3>'+
                                                  '</div>'+
                                                  '<form action="" method="" accept-charset="utf-8">'+
                                                  '<div class="modal-body">'+                                                     
                                                          '<div class="pais input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">País</span>'+
                                                            '</span>'+
                                                              '<select class="form-control options pais" id="pais" data-option="" name="pais" required=""></select>'+
                                                          '</div><br>'+
                                                          '<div class="estado input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">Estado</span>'+
                                                            '</span>'+
                                                              '<select class="form-control options" id="estado" name="estado" required="">'+
                                                              '</select>'+
                                                          '</div><br>'+
                                                          '<div class="municipio input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">Municipio</span>'+
                                                            '</span>'+
                                                              '<select class="form-control" id="municipio" name="municipio" required="">'+
                                                              '</select>'+
                                                          '</div><br>'+                                                          
                                                        '<div class="calle1 input-group">'+
                                                          '<span class="input-group-addon">'+
                                                            '<span class="text-info">Calle 1</span>'+
                                                          '</span>'+
                                                            '<input class="form-control" placeholder="Calle 1" required="required" id="calle1" name="calle1" type="text">'+
                                                        '</div><br>'+
                                                        '<div class="calle2 input-group">'+
                                                          '<span class="input-group-addon">'+
                                                            '<span class="text-info">Calle 2</span>'+
                                                          '</span>'+
                                                            '<input class="form-control" placeholder="Calle 2" required="required" id="calle2" name="calle2" type="text">'+
                                                        '</div><br>'+
                                                        '<div class="colonia input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">Colonia</span>'+
                                                            '</span>'+
                                                              '<input class="form-control" placeholder="Colonia" required="required" id="colonia" name="colonia" type="text">'+
                                                         '</div><br>'+
                                                         '<div class="delegacion input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">Delegación</span>'+
                                                            '</span>'+
                                                            '<input class="form-control" placeholder="Delegación" id="delegacion" name="delegacion" type="text">'+
                                                         '</div><br>'+
                                                         '<div class="cp input-group">'+
                                                            '<span class="input-group-addon">'+
                                                              '<span class="text-info">Codigo Postal</span>'+
                                                            '</span>'+
                                                            '<input class="form-control" placeholder="Codigo postal" required="required" id="cp" name="cp" type="text">'+
                                                         '</div><br>'+
                                                         '<div class="col-sm-12 form-group" style="display: block;">'+
                                                            '<div class="col-sm-6  input-group">'+
                                                                '<span class="input-group-addon" >'+
                                                                  '<span class="text-info">Tipo</span>'+
                                                                '</span>'+
                                                                '<select class="form-control " id="tipoDir" name="" required="">'+
                                                                  '<option value="">Seleccione tipo de domicilio</option>'+
                                                                  '<option value="Fiscal">Domicilio Fiscal</option>'+
                                                                  '<option value="Otro">Otro</option>'+
                                                                '</select>'+
                                                            '</div>'+
                                                            '<div class=" input-group" >'+
                                                              '<span class="input-group-addon" >'+
                                                                '<span class="text-info">ESTATUS:  </span>'+
                                                              '</span>'+
                                                              '<input type="checkbox" value="" id="estatusDirCliente" class="form-control">'+
                                                            '</div>'+
                                                         '</div><br>'+                                             
                                                  '</div>'+
                                                  '<div class="modal-footer" id="modalFooterDir">'+
                                                  '</div>'+
                                                  '</form>'+
                                              '</div>'+
                                          '</div>'+

                                        '</div>'+
                                    
                                   '</div>';
                    
                    
                    $('#tab').html(widget);
                    if (obj) { //:::::--- EN CASO DE SER UN CLIENTE YA REGISTRADO PROCEDE A CONSULTAR TODOS LOS DATOS EXISTENTES ---:::::\\
                      datos=obtenerElementos('tabCliente',obj.id);
                      datos.done(function(respuesta){
                                  console.log(respuesta);
                                  var trTel="";
                                  $.each(respuesta['telefonoCliente'], function(index, telefono){
                                      console.log(telefono);
                                      trTel += '<tr id="tr_'+telefono.idTel+'">'+
                                            '<form class="form-group" >'+
                                             '<td class="">'+
                                             '<input type="text" id="telefono_'+telefono.idTel+'"  value="'+telefono.numero+'" class="form-control col-md-1" disabled>'+
                                             '</td>'+ 
                                             '<td class="">'+
                                               '<select id="tipo_'+telefono.idTel+'" name="" class="form-control options " value="" required disabled>' +
                                                  '<option value="'+telefono.tipo+'">'+telefono.tipo+'</option>'+
                                                  (telefono.tipo==="Celular" ? '' : '<option value="Celular">Celular</option>' )+
                                                  (telefono.tipo==="Fijo" ? '' : '<option value="Fijo">Fijo</option>' )+
                                                  (telefono.tipo==="Otro" ? '' : '<option value="Otro">Otro</option>' )+
                                                  
                                                '</select>' +
                                             //'<input type="text" id="tipo_'+telefono.idTel+'"  value="'+telefono.tipo+'" class="form-control col-md-1" disabled>
                                             '</td>'+ 
                                             '<td class=""><input type="checkbox" id="estatusTel_'+telefono.idTel+'"  value="'+telefono.estatus+'" '+(telefono.estatus=== 1 ? 'checked':'')+ ' disabled></td>'+
                                             '<td class="">'+
                                              '<button type="button" value="Modificar" id="btn_mod" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="modificar btn btn-primary" ><span class="glyphicon glyphicon-edit"></span></button>'+
                                            //  '<input type="hidden" id="campo_id" value="" name="" >'+
                                            //  '<input type="hidden" id="tipoMov_" value="Actualizar"  >'+
                                              '<button type="button" value="Actualizar" id="btn_guardar_'+telefono.idTel+'" disabled="disabled" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="enviarG btn btn-success" ><span class="glyphicon glyphicon-">OK</span></button>'+
                                              '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+telefono.idTel+'" data-cat="TelefonoCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                           
                                           '</form>'+
                                           '</tr>';
                                    });
                                  $('#tbodyCliente').append(trTel);
                                  var trDir="";
                                  $.each(respuesta['dirCliente'], function(index, direccion){
                                      console.log(direccion);
                                     
                                      trDir += '<tr id="trDir_'+direccion.idDir+'">'+
                                            '<form class="form-group" >'+
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
                                              //'<button type="button" value="Modificar" id="btn_mod" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" data-info="'+direccion+'" class="modificar btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button>'+
                                              '<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal" value="Modificar" data-info=\''+JSON.stringify(direccion)+'\' id="editDirCliente"><span class="glyphicon glyphicon-edit"></span></a>'+
                                          //    '<input type="hidden" id="campo_id" value="" name="" >'+
                                           //   '<input type="hidden" id="tipoMov_" value="Actualizar"  >'+
                                           //   '<button type="button" value="Actualizar" id="btn_guardar_'+direccion.idDir+'" disabled="disabled" data-id="'+direccion.idDir+'" data-cat="TelefonoCliente" class="enviarG"> Act</button>'+
                                           //   '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+direccion.idDir+'" data-cat="DireccionCliente" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>'+
                                            '</td>'+
                                           
                                           '</form>'+
                                           '</tr>';
                                          
                                    });
                                  $('#tbodyClienteDir').append(trDir);
                              });
                         
                    }
                    

                    console.log(obj);
                  break;
          }

        $(document).on('click','#editDirCliente', function(){ //:::::-- FUNCION PARA ABRIR EL MODAL PARA UN INGRESAR O EDITAR UNA NUEVA DIRECCION DE CLIENTE
                        var datos = $(this).data('info');
                        var options = "";
                        var accion= $(this).val();
                        var footerDir = '<input type="hidden" id="id_Cliente" value="'+((!datos) ? '0' : datos.idCliente)+'" name="">'+
                                        '<button type="button" id="btn_guardarDir" name="btn_guardar" value="'+((!datos) ? 'Guardar' : 'Actualizar')+'" data-id="'+((!datos) ? '0' : datos.idDir)+'" data-cat="DireccionCliente" class="enviarG  btn btn-success" >OK</button>';
                        $('#modalFooterDir').html(footerDir);
                        $('#calle1').val(((!datos) ? '' : datos.calle1));
                        $('#calle2').val(((!datos) ? '' : datos.calle2));
                        $('#colonia').val(((!datos) ? '' : datos.colonia));
                        $('#delegacion').val(((!datos) ? '' : datos.delegacion));
                        $('#cp').val(((!datos) ? '' : datos.codigo_postal));
                        $('#tipoDir').val(((!datos) ? '' : datos.tipo));
                        $('#estatusDirCliente').prop('checked',((!datos) ? 'checked' : (datos.estatus===1 ? 'checked' : '')));
                        if(!datos){
                          options = '<option value="">Seleccione un país</option>'
                          $('#estado').html('<option value="">Seleccione primero un pais</option>');
                          $('#municipio').html('<option value="">Seleccione primero un estado</option>');

                        }else{
                          var estados = obtenerElementos('Estados',datos.idPais);
                          var opEstados="";
                          estados.done(function(respuesta){
                            $.each(respuesta,function(index,estado){
                              opEstados += '<option value="'+estado.idEstado+'">'+estado.estados+'</option>';
                            });
                            $('#estado').html(opEstados);
                            $('#estado').val(datos.idEstado);
                          });
                          var municipios = obtenerElementos('Municipios',datos.idEstado);
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
                        var pais=obtenerElementos('Pais',null);
                        pais.done(function(respuesta){
                          
                          $.each(respuesta,function(index,pais){
                            options += '<option value="'+pais.idPais+'">'+pais.pais+'</option>';
                          });
                          $('#pais').html(options);
                          $('#pais').val(((!datos) ? '' : datos.idPais));
                        });
    }); 
    }

    

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
