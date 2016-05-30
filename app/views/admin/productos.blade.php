@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('lib/bootstrap-notify/bootstrap-notify.css') }}
{{ HTML::style('css/bootstrap-select.min.css') }}
{{ HTML::style('lib/bootstrap-toggle/bootstrap-toggle.min.css') }}
{{ HTML::style('css/estilosGlobales.css') }}
{{ HTML::style('lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}

{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('lib/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js') }}
{{ HTML::script('lib/bootstrap-notify/bootstrap-notify.js') }}
{{ HTML::script('js/DataTables-1.9.4/media/js/jquery.dataTables.min.js') }}
{{ HTML::script('js/DataTables-1.9.4/media/js/jquery.dataTables.bootstrap.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
{{ HTML::Script('js/d3.min.js') }}
{{ HTML::script('js/i18n/defaults-es_CL.min.js') }}
{{ HTML::Script('lib/bootstrap-datetimepicker/moment.min.js') }}
{{ HTML::Script('lib/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('js/bootstrap-filestyle.min.js') }}
{{ HTML::script('lib/bootstrap-toggle/bootstrap-toggle.min.js') }}
    <style>
      .icon-nombre{
        line-height: 45px;
      }
    
     .img-gif{
      width:100%;
      margin:0 auto;
      text-align:center;
      margin-top:5em;
    }

    #modalprcesarproducto, #modalmostrarerrores{
      background:rgba(0, 0, 0, 0.8);
    }

      tbody tr td{
        font-size:.9em;
      }

      .checkbox-activ{
          width:152px;
        }

        .foto-product{
          color:#337ab7;
          font-size:.9em;
        }
    
      .glyphicon-remove{
        line-height: 20px;
      }

      .error-cargar-archivo{
        color: #a94442;
      }

      .formulario-archivo{
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
      }

      #ad-nuevo-archivo-productos{
        margin-left:.5em;
        margin-top:1.4em;
      }

    </style>
    <script>
        $(document).ready(function(){
            $('.catalogos').addClass('active');
            $('.t-catalogos').addClass('en-admin');
        });
    </script>
@stop

@section('pedidos_user') @stop

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row row-paginas">
    <h1 class="text-info text-center" style="margin-bottom:0">Catálogo Producto.</h1>

     <form enctype="multipart/form-data" class="formulario-archivo">
        <div id="browse-p" class="buscador-p error-buscador">
           <label class="txt-browse text-primary">Cargar archivo de producto</label>
           <input type="file" class="filestyle" data-buttonText="Buscar" data-buttonBefore="true" data-placeholder="Ningún archivo seleccionado" name="archivo_file" id="enviar_file">
        </div>
        <div>
          <button id="ad-nuevo-archivo-productos" class="btn btn-primary">Guardar</button>
        </div>
    </form>

    <div class="catalogo-producto">
        <button id="add-producto" class="btn btn-primary add-product" title="Agregar producto">
          <span class="glyphicon glyphicon-plus"></span>
        </button>
      <table id="list_p_" class="table">
        <thead>
          <tr>
            <th>Clave</th>
            <th>Producto</th>
            <th>Foto</th>
            <th>Color</th>
            <th>Familia</th>
            <th>Categoría</th>
            <th>Estatus</th>
            <th>Editar</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
</div>

<!--Alertas-->
<div class="notifications top-right" data-html="true"></div>


<!--  Modal agregar producto -->
<div id="agregarproducto" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-agregar-producto">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-plus"></span>
              Agregar producto
             </h4>
          </div>
          <div class="modal-body body-add-n body-add-p">

            <form enctype="multipart/form-data" class="formulario">
              
              <div class="d-p-1">
                <div class="form-group error-clave" style="margin-bottom:.3em">
                      <label for="clave" class="text-primary label-producto">Clave: </label>
                      <input type="text" name="clave-producto" id="clave-producto" class="form-control" >
                      <span class="icon-clave"></span>
                </div>
                <div class="form-group error-articulo" style="margin-bottom:.3em">
                      <label for="articulo" class="text-primary label-producto">N° Artículo: </label>
                      <input type="text" name="articulo" id="articulo" class="form-control" >
                      <span class="icon-articulo"></span>
                </div>
                <div class="form-group error-nombre" style="margin-bottom:.3em">
                      <label for="nombre" class="text-primary label-producto">Nombre: </label>
                      <input type="text" name="nombre" id="nombre" class="form-control" >
                      <span class="icon-nombre"></span>
                </div>
                <div class="form-group error-ean-code" style="margin-bottom:.3em">
                      <label for="ean-code" class="text-primary label-producto">Ean-code: </label>
                      <input type="text" name="ean-code" id="ean-code" class="form-control" >
                      <span class="icon-ean-code"></span>
                </div>
                <div class="form-group error-color" style="margin-bottom:.3em">
                      <label for="color" class="text-primary label-producto">Color: </label>
                      <input type="text" name="color" id="color" class="form-control" >
                      <span class="icon-color"></span>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-n-color" style="margin-bottom:.3em">
                      <label for="n-color" class="text-primary label-producto">N° de color: </label>
                      <input type="text" name="n-color" id="n-color" class="form-control" >
                      <span class="icon-n-color"></span>
                </div>
                <div class="form-group error-unidad" style="margin-bottom:.3em">
                      <label for="unidad" class="text-primary label-producto">Unidad de medida: </label>
                      <select name="unidad" id="unidad" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-dimensiones" style="margin-bottom:.3em">
                      <label for="dimensiones" class="text-primary label-producto">Dimensiones: </label>
                      <input type="text" name="dimensiones" id="dimensiones" class="form-control" >
                      <span class="icon-dimensiones"></span>
                </div>
                <div class="form-group error-cantidad" style="margin-bottom:.3em">
                      <label for="cantidad" class="text-primary label-producto">Cantidad minima: </label>
                      <input type="number" name="cantidad" id="cantidad" class="form-control" >
                      <span class="icon-cantidad"></span>
                </div>
                <div class="form-group error-piezas" style="margin-bottom:.3em">
                      <label for="piezas" class="text-primary label-producto">Piezas x paquete: </label>
                      <input type="number" name="piezas" id="piezas" class="form-control" >
                      <span class="icon-piezas"></span>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-pallet" style="margin-bottom:.3em">
                      <label for="pallet" class="text-primary label-producto">Piezas pallet: </label>
                      <input type="number" name="pallet" id="pallet" class="form-control" >
                      <span class="icon-pallet"></span>
                </div>
                <div class="form-group error-totalpiezas" style="margin-bottom:.3em">
                      <label for="totalpiezas" class="text-primary label-producto">Total de piezas: </label>
                      <input type="number" name="totalpiezas" id="totalpiezas" class="form-control" >
                      <span class="icon-totalpiezas"></span>
                </div>
                <div class="form-group error-importador" style="margin-bottom:.3em">
                      <label for="importador" class="text-primary label-producto">Importador: </label>
                      <select name="importador" id="importador" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-almacen" style="margin-bottom:.3em">
                      <label for="almacen" class="text-primary label-producto">Almacen: </label>
                      <select name="almacen" id="almacen" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-familia" style="margin-bottom:.3em">
                      <label for="familia" class="text-primary label-producto">Familia: </label>
                      <select name="familia" id="familia" class="form-control" style="width:198px"></select>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-categoria" style="margin-bottom:.3em">
                      <label for="categoria" class="text-primary label-producto">Categoría: </label>
                      <select name="categoria" id="categoria" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-foto" style="margin-bottom:.3em">
                      <label for="foto" class="text-primary label-producto">Foto: </label>
                      <input type="file" name="foto" id="foto" class="form-control foto-product" accept="image/*">
                      <span class="icon-foto"></span>
                </div>

                <div class="form-group error-estatus-web" style="margin-bottom:.3em">
                      <label for="estatus-web" class="text-primary label-producto">Estatus web: </label>
                      <div class="checkbox checkbox-activ">
                        <div class="txt-activ">
                            <input name="inp-estatus-web" id="inp-estatus-web" type="checkbox" checked data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                        </div>
                </div>
                <div class="form-group error-estatus" style="margin-bottom:.3em">
                      <label for="estatus" class="text-primary label-producto">Estatus: </label>
                      <div class="checkbox checkbox-activ">
                          <div class="txt-activ">
                            <input name="inp-estatus" id="inp-estatus" type="checkbox" checked data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                     </div>
                </div>
                <div class="form-group error-iva0" style="margin-bottom:.3em">
                      <label for="iva0" class="text-primary label-producto">Iva 0: </label>
                      <div class="checkbox checkbox-activ">
                        <div class="txt-activ">
                          <input name="inp-iva" id="inp-iva" type="checkbox" data-toggle="toggle" value="" data-on="Si" data-off="No" data-width="100">
                        </div>
                      </div>
                </div>
              </div>  

              <div class="content-add-p-d">
                  <button id="ad-nuevo-precio" class="btn btn-primary" title="Agregar precio">
                          <span class="glyphicon glyphicon-plus"></span>
                  </button>
            </div>
              <div class="datos1-precio-producto">
                        
                <div class="seccion_tabla">
                    
                      <div class="tabla-sucursal">
                          <table id="table-x-y" class="tabla_detallepro table-striped">
                          <div class="thead-detalle-pro">
                            <span class="txt-detalle-pro">Precios</span>
                          </div>
                          <thead class="thead-detallet">
                            <tr>
                              <th class="cabecero">Precio</th>
                              <th class="cabecero">Tipo precio</th>
                              <th class="cabecero">Moneda</th>
                              <th class="cabecero">Fecha de inicio</th>
                              <th class="cabecero">Fecha fin</th>
                              <th class="cabecero">Estatus</th>
                              <th class="cabecero">Eliminar</th>
                            </tr>                           
                          </thead>
                          <tbody id="body-precio-detalle"></tbody>
                        </table>
                      </div>

                    </div>

                      
              </div>    

                  <input type="text" name="valorunidad" id="valorunidad" class="hidden">
                  <input type="text" name="valorimportador" id="valorimportador" class="hidden">
                  <input type="text" name="valoralmacen" id="valoralmacen" class="hidden">
                  <input type="text" name="valorfamilia" id="valorfamilia" class="hidden">
                  <input type="text" name="valorcategoria" id="valorcategoria" class="hidden">

                  <input type="text" name="valor-inp-estatus-web" id="valor-inp-estatus-web" class="hidden">
                  <input type="text" name="valor-inp-estatus" id="valor-inp-estatus" class="hidden">
                  <input type="text" name="valor-inp-iva" id="valor-inp-iva" class="hidden">
            
                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-producto" type="button" class="btn btn-danger confirm boton-add-p" data-dismiss="modal">Cancelar</button>
              <span id="save-producto" class="btn btn-primary confirm boton-add-p" data-dismiss="modal" >Agregar</span>
          </div>
        </div>
      </div>
    </div>



    <!--  Modal para eliminar precio -->
<div id="modaleliminarprecio" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Eliminar precio
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar este precio?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-precio" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


  <!--  Modal editar producto  -->
<div id="agregarproductoedit" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-agregar-producto">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Editar producto
             </h4> 
          </div>
          <div class="modal-body body-add-n body-add-p">

            <form enctype="multipart/form-data" class="formulario-edit">
              
              <div class="d-p-1">
                <div class="form-group error-clave-edit" style="margin-bottom:.3em">
                      <label for="clave-edit" class="text-primary label-producto">Clave: </label>
                      <input type="text" name="clave-producto-edit" id="clave-producto-edit" class="form-control" >
                      <span class="icon-clave-edit"></span>
                </div>
                <div class="form-group error-articulo-edit" style="margin-bottom:.3em">
                      <label for="articulo-edit" class="text-primary label-producto">N° Artículo: </label>
                      <input type="text" name="articulo-edit" id="articulo-edit" class="form-control" >
                      <span class="icon-articulo-edit"></span>
                </div>
                <div class="form-group error-nombre-edit" style="margin-bottom:.3em">
                      <label for="nombre-edit" class="text-primary label-producto">Nombre: </label>
                      <input type="text" name="nombre-edit" id="nombre-edit" class="form-control" >
                      <span class="icon-nombre-edit"></span>
                </div>
                <div class="form-group error-ean-code-edit" style="margin-bottom:.3em">
                      <label for="ean-code-edit" class="text-primary label-producto">Ean-code: </label>
                      <input type="text" name="ean-code-edit" id="ean-code-edit" class="form-control" >
                      <span class="icon-ean-code-edit"></span>
                </div>
                <div class="form-group error-color-edit" style="margin-bottom:.3em">
                      <label for="color-edit" class="text-primary label-producto">Color: </label>
                      <input type="text" name="color-edit" id="color-edit" class="form-control" >
                      <span class="icon-color-edit"></span>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-n-color-edit" style="margin-bottom:.3em">
                      <label for="n-color-edit" class="text-primary label-producto">N° de color: </label>
                      <input type="text" name="n-color-edit" id="n-color-edit" class="form-control" >
                      <span class="icon-n-color-edit"></span>
                </div>
                <div class="form-group error-unidad-edit" style="margin-bottom:.3em">
                      <label for="unidad-edit" class="text-primary label-producto">Unidad de medida: </label>
                      <select name="unidad-edit" id="unidad-edit" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-dimensiones-edit" style="margin-bottom:.3em">
                      <label for="dimensiones-edit" class="text-primary label-producto">Dimensiones: </label>
                      <input type="text" name="dimensiones-edit" id="dimensiones-edit" class="form-control" >
                      <span class="icon-dimensiones-edit"></span>
                </div>
                <div class="form-group error-cantidad-edit" style="margin-bottom:.3em">
                      <label for="cantidad-edit" class="text-primary label-producto">Cantidad minima: </label>
                      <input type="number" name="cantidad-edit" id="cantidad-edit" class="form-control" >
                      <span class="icon-cantidad-edit"></span>
                </div>
                <div class="form-group error-piezas-edit" style="margin-bottom:.3em">
                      <label for="piezas-edit" class="text-primary label-producto">Piezas x paquete: </label>
                      <input type="number" name="piezas-edit" id="piezas-edit" class="form-control" >
                      <span class="icon-piezas-edit"></span>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-pallet-edit" style="margin-bottom:.3em">
                      <label for="pallet-edit" class="text-primary label-producto">Piezas pallet: </label>
                      <input type="number" name="pallet-edit" id="pallet-edit" class="form-control" >
                      <span class="icon-pallet-edit"></span>
                </div>
                <div class="form-group error-totalpiezas-edit" style="margin-bottom:.3em">
                      <label for="totalpiezas-edit" class="text-primary label-producto">Total de piezas: </label>
                      <input type="number" name="totalpiezas-edit" id="totalpiezas-edit" class="form-control" >
                      <span class="icon-totalpiezas-edit"></span>
                </div>
                <div class="form-group error-importador-edit" style="margin-bottom:.3em">
                      <label for="importador-edit" class="text-primary label-producto">Importador: </label>
                      <select name="importador-edit" id="importador-edit" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-almacen-edit" style="margin-bottom:.3em">
                      <label for="almacen-edit" class="text-primary label-producto">Almacen: </label>
                      <select name="almacen-edit" id="almacen-edit" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-familia-edit" style="margin-bottom:.3em">
                      <label for="familia-edit" class="text-primary label-producto">Familia: </label>
                      <select name="familia-edit" id="familia-edit" class="form-control" style="width:198px"></select>
                </div>
              </div> 

              <div class="d-p-1">
                <div class="form-group error-categoria-edit" style="margin-bottom:.3em">
                      <label for="categoria-edit" class="text-primary label-producto">Categoría: </label>
                      <select name="categoria-edit" id="categoria-edit" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-foto-edit" style="margin-bottom:.3em">
                      <label for="foto-edit" class="text-primary label-producto">Foto: </label>
                      <input type="file" name="foto-edit" id="foto-edit" class="form-control foto-product" accept="image/*">
                      <span class="icon-foto-edit"></span>
                </div>

                <div class="form-group error-estatus-web-edit" style="margin-bottom:.3em">
                      <label for="estatus-web-edit" class="text-primary label-producto">Estatus web: </label>
                      <div class="checkbox checkbox-activ">
                        <div class="txt-activ">
                            <input name="inp-estatus-web-edit" id="inp-estatus-web-edit" type="checkbox" data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                        </div>
                </div>
                <div class="form-group error-estatus-edit" style="margin-bottom:.3em">
                      <label for="estatus-edit" class="text-primary label-producto">Estatus: </label>
                      <div class="checkbox checkbox-activ">
                          <div class="txt-activ">
                            <input name="inp-estatus-edit" id="inp-estatus-edit" type="checkbox" data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                     </div>
                </div>
                <div class="form-group error-iva0-edit" style="margin-bottom:.3em">
                      <label for="iva0-edit" class="text-primary label-producto">Iva 0: </label>
                      <div class="checkbox checkbox-activ">
                        <div class="txt-activ">
                          <input name="inp-iva-edit" id="inp-iva-edit" type="checkbox" data-toggle="toggle" value="" data-on="Si" data-off="No" data-width="100">
                        </div>
                      </div>
                </div>
              </div>  

              <div class="content-add-p-d">
                  <button id="ad-nuevo-precio-edit" class="btn btn-primary" title="Agregar precio">
                          <span class="glyphicon glyphicon-plus"></span>
                  </button>
                  <input type="text" id="campo-con-id-producto" name="campo-con-id-producto" class="hidden">
            </div>
              <div class="datos1-precio-producto">
                        
                <div class="seccion_tabla">
                    
                      <div class="tabla-sucursal">
                          <table id="table-x-y" class="tabla_detallepro table-striped">
                          <div class="thead-detalle-pro">
                            <span class="txt-detalle-pro">Precios</span>
                          </div>
                          <thead class="thead-detallet">
                            <tr>
                              <th class="cabecero">Precio</th>
                              <th class="cabecero">Tipo precio</th>
                              <th class="cabecero">Moneda</th>
                              <th class="cabecero">Fecha de inicio</th>
                              <th class="cabecero">Fecha fin</th>
                              <th class="cabecero">Estatus</th>
                              <th class="cabecero">Editar</th>
                              <th class="cabecero">Eliminar</th>
                            </tr>                           
                          </thead>
                          <tbody id="body-precio-detalle-edit"></tbody>
                        </table>
                      </div>

                    </div>

                      
              </div>    

                  <input type="text" name="valorunidad-edit" id="valorunidad-edit" class="hidden">
                  <input type="text" name="valorimportador-edit" id="valorimportador-edit" class="hidden">
                  <input type="text" name="valoralmacen-edit" id="valoralmacen-edit" class="hidden">
                  <input type="text" name="valorfamilia-edit" id="valorfamilia-edit" class="hidden">
                  <input type="text" name="valorcategoria-edit" id="valorcategoria-edit" class="hidden">

                  <input type="text" name="valor-inp-estatus-web-edit" id="valor-inp-estatus-web-edit" class="hidden">
                  <input type="text" name="valor-inp-estatus-edit" id="valor-inp-estatus-edit" class="hidden">
                  <input type="text" name="valor-inp-iva-edit" id="valor-inp-iva-edit" class="hidden">
            
                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-producto-edit" type="button" class="btn btn-danger confirm boton-add-p" data-dismiss="modal">Cancelar</button>
              <span id="save-producto-edit" class="btn btn-primary confirm boton-add-p" data-dismiss="modal" >Actualizar</span>
          </div>
        </div>
      </div>
    </div>


    <!--  Modal para eliminar precios exxistentes -->
<div id="modaleliminarprecioedit" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Eliminar precio
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar este precio?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="noeliminar-precio-edit" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-precio-edit" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


      <!--  Modal para  agregar nuevo producto con archivo de texto -->
<div id="modalcargararchivo" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Agregar producto
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Agregar archivo de productos?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="no-cargar-archivo" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="cargar-archivo" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal para agregar los precios del producto  -->
  <div id="agregarprecio" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-precio-detalle">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-plus"></span>
              Agregar precio
             </h4>
          </div>
          <div class="modal-body body-add-n body-add-p">

            <form class="form-modal" action="">
              
              <div class="d-p-1-precio">
                <div class="form-group error-precio-producto" style="margin-bottom:.3em">
                      <label for="precio-producto" class="text-primary label-producto">Precio: </label>
                      <input type="number" name="precio-producto" id="precio-producto" class="form-control" >
                      <span class="icon-precio-producto"></span>
                </div>
                <div class="form-group error-tipo-precio" style="margin-bottom:.3em">
                      <label for="tipo-precio" class="text-primary label-producto">Tipo precio: </label>
                      <select name="tipo-precio" id="tipo-precio" class="form-control" style="width:198px">
                        <option value="-1">-- Seleccione --</option>
                        <option value="0">Compra</option>
                        <option value="1">Retail</option>
                        <option value="2">Mayorista</option>
                        <option value="3">Distribuidor</option>
                      </select>
                </div>
                <div class="form-group error-moneda" style="margin-bottom:.3em">
                      <label for="moneda" class="text-primary label-producto">Moneda: </label>
                      <select name="moneda" id="moneda" class="form-control" style="width:198px">
                        <option value="0">-- Seleccione --</option>
                        <option value="Pesos Mx">Pesos Mx</option>
                        <option value="Dolar">Dolar</option>
                        <option value="Otro">Otro</option>
                      </select>
                </div>
              </div> 



              <div class="d-p-1-precio">
                <div class="form-group error-fechainicio" style="margin-bottom:.3em">
                      <label for="fechainicio" class="text-primary label-producto">Fecha de inicio: </label>
                      <input type="text" name="fechainicio" id="fechainicio" class="form-control" >
                      <span class="icon-fechainicio"></span>
                </div>
                <div class="form-group error-fechafin" style="margin-bottom:.3em">
                      <label for="fechafin" class="text-primary label-producto">Fecha fin: </label>
                      <input type="text" name="fechafin" id="fechafin" class="form-control" >
                      <span class="icon-fechafin"></span>
                </div>

                <div class="form-group error-estatus-precio" style="margin-bottom:.3em" >
                      <label for="estatus-precio" class="text-primary label-producto">Estatus: </label>
                      <div class="checkbox checkbox-activ" style="width:198px">
                        <div class="txt-activ">
                            <input name="inp-estatus-precio" checked id="inp-estatus-precio" type="checkbox" data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                     </div>
                </div>
              </div>  
    
                <input type="text" id="valortipoprecio" class="hidden" value="">
                <input type="text" id="valormoneda" class="hidden" value="">
                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-precio-producto" type="button" class="btn btn-danger confirm boton-add-p" data-dismiss="modal">Cancelar</button>
              <span id="save-precio-producto" class="btn btn-primary confirm boton-add-p" data-dismiss="modal" >Agregar</span>
          </div>
        </div>
      </div>
    </div>


     <!-- Modal para editar los precios del producto  -->
  <div id="agregarprecioedit" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-precio-detalle">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Editar precio
             </h4>
          </div>
          <div class="modal-body body-add-n body-add-p">

            <form class="form-modal" action="">
              
              <div class="d-p-1-precio">
                <div class="form-group error-precio-producto-edit" style="margin-bottom:.3em">
                      <label for="precio-producto-edit" class="text-primary label-producto">Precio: </label>
                      <input type="number" name="precio-producto-edit" id="precio-producto-edit" class="form-control" >
                      <span class="icon-precio-producto-edit"></span>
                </div>
                <div class="form-group error-tipo-precio-edit" style="margin-bottom:.3em">
                      <label for="tipo-precio-edit" class="text-primary label-producto">Tipo precio: </label>
                      <select name="tipo-precio-edit" id="tipo-precio-edit" class="form-control" style="width:198px"></select>
                </div>
                <div class="form-group error-moneda-edit" style="margin-bottom:.3em">
                      <label for="moneda-edit" class="text-primary label-producto">Moneda: </label>
                      <select name="moneda-edit" id="moneda-edit" class="form-control" style="width:198px"></select>
                </div>
              </div> 

              <div class="d-p-1-precio">
                <div class="form-group error-fechainicio-edit" style="margin-bottom:.3em">
                      <label for="fechainicio-edit" class="text-primary label-producto">Fecha de inicio: </label>
                      <input type="text" name="fechainicio-edit" id="fechainicio-edit" class="form-control" >
                      <span class="icon-fechainicio-edit"></span>
                </div>
                <div class="form-group error-fechafin-edit" style="margin-bottom:.3em">
                      <label for="fechafin-edit" class="text-primary label-producto">Fecha fin: </label>
                      <input type="text" name="fechafin-edit" id="fechafin-edit" class="form-control" >
                      <span class="icon-fechafin-edit"></span>
                </div>

                <div class="form-group error-estatus-precio" style="margin-bottom:.3em" >
                      <label for="estatus-precio" class="text-primary label-producto">Estatus: </label>
                      <div class="checkbox checkbox-activ" style="width:198px">
                        <div class="txt-activ">
                            <input name="inp-estatus-precio-edit" checked id="inp-estatus-precio-edit" type="checkbox" data-toggle="toggle" value="" data-on="Activo" data-off="Inactivo" data-width="100">
                          </div>
                     </div>
                </div>
              </div>  
    
                <input type="text" id="valortipoprecio-edit" class="hidden" value="">
                <input type="text" id="valormoneda-edit" class="hidden" value="">
                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-precio-producto-edit" type="button" class="btn btn-danger confirm boton-add-p" data-dismiss="modal">Cancelar</button>
              <span id="save-precio-producto-edit" class="btn btn-primary confirm boton-add-p" data-dismiss="modal" >Actualizar</span>
          </div>
        </div>
      </div>
    </div>

      <div id="modalmostrarerrores" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-errores">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <h4 class="modal-title text-info text-center">
                Resultados
            </h4>
          </div>
          <div class="modal-body body-add-n body-add-p">

                <div>  
                  <span class="text-danger">
                    Errores encontrados: <span class="span-errores"></span>
                  </span>
                </div>
                <div class="error1">
                  <table class="table-errores">
                    <thead  class="thead-errores">
                      <tr>
                       <td>Linea</td>
                       <td>Descripción</td>
                       <td class="est-hid">clave</td>
                       <td class="est-hid">Estatus</td>
                      </tr>
                    </thead>
                    <tbody id="contenedor-errores-producto"></tbody>
                  </table>
                </div>

                <div>
                  <span class="text-success">
                    Agregados correctamente: <span class="span-agregados"></span>
                  </span>
                </div>
                <div class="agregados-correctamente">
                  <table class="table-agregados">
                    <thead  class="thead-agregados">
                      <tr>
                       <td>Clave</td>
                       <td>Producto</td>
                       <td>Estatus</td>
                      </tr>
                    </thead>
                    <tbody id="contenedor-agregados-producto"></tbody>
                  </table>
                </div>

                <div>
                  <span class="text-info">
                    Duplicados: <span class="span-duplicados"></span>
                  </span>
                </div>
                <div class="duplicados-prod">
                  <table class="table-duplicados">
                    <thead  class="thead-duplicados">
                      <tr>
                       <td>Clave</td>
                       <td>Producto</td>
                       <td>Estatus</td>
                      </tr>
                    </thead>
                    <tbody id="contenedor-duplicados-producto"></tbody>
                  </table>
                </div>
                          
            
                
          </div>
          <div class="modal-footer">
              <div class="text-sobrees" style="width:100%; text-align:center; margin-bottom:1em; font-size:1.2em">
                <span class="text-info text-center pregunta-productos">¿Deseas sobrescribir los productos duplicados?</span>
              </div>
              <button id="salir-modal" class="btn btn-danger confirm" style="margin-right:80%;" data-dismiss="modal">
                <span class="glyphicon glyphicon-chevron-left"></span>
                Salir
              </button>
              <div class="footer-productos-duplicados">
                <button id="cancelar-productos-duplicados" type="button" class="btn btn-danger confirm boton-add-p" data-dismiss="modal">No</button>
                <span id="agregar-duplicados" class="btn btn-primary confirm boton-add-p" data-dismiss="modal">Si</span>
              </div>
          </div>
        </div>
      </div>
    </div>

     <!-- Modal cuando se envia nuevamente el pdf -->
      <div id="modalprcesarproducto" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="img-gif">
            <img class="img-proce" src="/img/Cargandocc.gif" width="200px">
            <h1 class="text-info text-center txt-pro">Un momento por favor..</h1>
          </div>
        </div>
      </div>



  {{ HTML::script('js/accounting.min.js') }}

  <script>


  $(document).ready(function(){

    $(document).on('click', '#llamarmodal', function(){
      $('#modalmostrarerrores').modal({
        show:'false',
      });
    });

    $.ajax({
        url:'/productos/listarproductos',
        dataType: 'json',
        success: function(n){

          tabla_n = $('#list_p_').DataTable({
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

                  "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
                  "sInfoFiltered": " - filtrados de _MAX_ registros", 
                  "sInfoEmpty": "No hay resultados de búsqueda", 
                  "sZeroRecords": "No hay registros a mostrar", 
                  "sProcessing": "Espere, por favor...", 
                  "sSearch": "Buscar:", 

               },

               fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).attr('id', "fila_"+n[i].id);
                               
                },

                'iDisplayLength': 50,

                "aaSorting": [[ 0, "asc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < n.length; i++) {
                             tabla_n.fnAddData([
                                        '<span class="hidden">'+n[i].created_at+'</span>'+n[i].clave,
                                        n[i].nombre,
                                        '<span title="Ver foto del producto" class="pro-foto" id="'+n[i].foto+'" data-id="'+n[i].nombre+'">Ver Foto</span>',
                                        n[i].color,
                                        n[i].descripcion,
                                        n[i].categoria,
                                        '<span class="estatus_'+n[i].estatus+'"></span>',
                                        '<span title="Editar producto" class="editar-n btn btn-info" value="'+n[i].id+'"><span class="glyphicon glyphicon-edit"></span></span>'
                                        
                                      ]);


                              }

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

                        $('.estatus_0').text('Inactivo');
                        $('.estatus_0').addClass('text-danger');
                        $('.estatus_1').text('Activo');
                        $('.estatus_1').addClass('text-success');

                        llamarpaginaciondatatable();

                        eliminartodoslosregitros();



        },
        error: function(){
          alert('failure');
        }
    });


        //Ver foto del producto del pedido
    $(document).on('click', '.pro-foto', function(){

        foto = $(this).attr('id');
        nf = $(this).attr('data-id');
        $('.f-p-p').prop('src', '/img/productos/'+foto);
        $('.title-f').html(nf)

        $('#verfotop').modal({
                show: 'false'
         });

    });


    $(document).on('click', '#add-producto', function(){

      $('#agregarproducto').modal({
        show:'false',
      });

      //Listamos las unidades de medida
       $.ajax({
                url:  "/productos/selectmedidas",
                type: "GET",
                success: function(s){

                      option = "";
              select = $('#unidad');
                  
                              option += '<option value="0">-- Seleccione --</option>';
                               for(datos in s.medidas){

                                      option += '<option value="'+s.medidas[datos].id+'">'+s.medidas[datos].descripcion+'</option>';
                                }

                                select.append(option);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

             //Listamos las importadores
       $.ajax({
                url:  "/productos/selectimportadores",
                type: "GET",
                success: function(s){

                      option2 = "";
                      option = "";
                     select = $('#importador');
                  
                              option += '<option value="0">-- Seleccione --</option>';
                               for(datos in s.importador){

                                      option += '<option value="'+s.importador[datos].id+'">'+s.importador[datos].nombre+'</option>';
                                }

                                select.append(option);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

        //Listamos los almacenes
       $.ajax({
                url:  "/productos/selectalmacenes",
                type: "GET",
                success: function(s){

                      option2 = "";
                      option = "";
                     select = $('#almacen');
                  
                              option += '<option value="0">-- Seleccione --</option>';
                               for(datos in s.almacen){

                                      option += '<option value="'+s.almacen[datos].id+'">'+s.almacen[datos].nombre+'</option>';
                                }

                                select.append(option);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

            //Listamos las familias
       $.ajax({
                url:  "/productos/selectfamilias",
                type: "GET",
                success: function(s){

                      option2 = "";
                      option = "";
                     select = $('#familia');
                  
                              option += '<option value="0">-- Seleccione --</option>';
                               for(datos in s.familia){

                                      option += '<option value="'+s.familia[datos].id+'">'+s.familia[datos].descripcion+'</option>';
                                }

                                select.append(option);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

                   //Listamos las categorias
       $.ajax({
                url:  "/productos/selectcategorias",
                type: "GET",
                success: function(s){
                      option2 = "";
                      option = "";
                     select = $('#categoria');
                  
                              option += '<option value="0">-- Seleccione --</option>';
                               for(datos in s.categorias){

                                      option += '<option value="'+s.categorias[datos].id+'">'+s.categorias[datos].categoria+'</option>';
                                }

                                select.append(option);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });


    });

    
      $(function () {
        $('#fechainicio').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });

      $(function () {
        $('#fechafin').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });


   $(function () {
        $('#fechainicio-edit').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });

     $(function () {
        $('#fechafin-edit').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    });

    
    //Agregar precios al producto
    $(document).on('click', '#ad-nuevo-precio', function(){

      $('#agregarprecio').modal({
        show:'false',
      });

      $('#inp-estatus-precio').prop('checked', true);

      return false;

    });

    $(document).on('change', '#tipo-precio', function(){
        valor = $(this).val();
        $('#valortipoprecio').attr('value', valor);
    });

    $(document).on('change', '#moneda', function(){
       valor = $(this).val();
       $('#valormoneda').attr('value', valor);
    });

$(document).on('click', '#save-precio-producto', function(){
    //valores
    precio = $('#precio-producto').val();
    tipo_precio = $('#valortipoprecio').val();
    moneda = $('#valormoneda').val();
    fecha_inicio = $('#fechainicio').val();
    fecha_fin = $('#fechafin').val();

    //obtenemos los nombres
    nombre_tipo_precio = $('#tipo-precio option:selected').text();
    nombre_moneda = $('#moneda option:selected').text();

    if($('#inp-estatus-precio').prop("checked") == true){
          activo = 1;
          activo_nombre = "Activo";
      } else {
          activo = 0;
          activo_nombre = "Inactivo";
      }


        $('.tabla_detallepro tbody tr').each(function(){
            existe = $(this).find("[class*='td_precio']").attr('data-valor');
            if(existe == tipo_precio+activo){
              $('.'+tipo_precio+activo).attr('value', 0);
              $('.'+tipo_precio+activo).text('Inactivo');
            } else {
            }
    });



    body = $('#body-precio-detalle');
      
      nueva_fila = '<tr id="fila_'+precio+'_'+tipo_precio+'_'+moneda+'_'+fecha_inicio+'_'+fecha_fin+'">'+
                        '<td class="td_precio" data-valor="'+tipo_precio+activo+'" value="'+precio+'">'+accounting.formatMoney(precio)+'</td>'+
                        '<td class="td_tipo_precio" value="'+tipo_precio+'">'+nombre_tipo_precio+'</td>'+
                        '<td class="td_moneda" value="'+moneda+'">'+nombre_moneda+'</td>'+
                        '<td class="td_fecha_inicio" value="'+fecha_inicio+'">'+fecha_inicio+'</td>'+
                        '<td class="td_fecha_fin" value="'+fecha_fin+'">'+fecha_fin+'</td>'+
                        '<td class="'+tipo_precio+activo+' td_estatus" value="'+activo+'">'+activo_nombre+'</td>'+
                      '<td>'+
                        '<button class="btn btn-sm btn-danger eliminar-btn-detalle" value="'+precio+'_'+tipo_precio+'_'+moneda+'_'+fecha_inicio+'_'+fecha_fin+'" title="Eliminar">'+
                                    '<span class="glyphicon glyphicon-remove"></span>'+
                            '</button>'+
                      '</td>'+
                  '</tr>';
                    
                  body.prepend(nueva_fila);


    //Limpiamos
    $('#precio-producto').val('');
    $('#tipo-precio').prop('selectedIndex',0);
    $('#moneda').prop('selectedIndex',0);
    $('#fechainicio').val('');
    $('#fechafin').val('');
     $('#inp-estatus-precio').bootstrapToggle('on');

});


$(document).on('click', '#cancelar-precio-producto', function(){

        $('#precio-producto').val('');
        $('#tipo-precio').prop('selectedIndex',0);
        $('#moneda').prop('selectedIndex',0);
        $('#fechainicio').val('');
        $('#fechafin').val('');

        $('.error-precio-producto').removeClass('has-error has-feedback');
        $('.icon-precio-producto').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-tipo-precio').removeClass('has-error has-feedback');

        $('.error-moneda').removeClass('has-error has-feedback');

        $('.error-fechainicio').removeClass('has-error has-feedback');
        $('.icon-fechainicio').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-fechafin').removeClass('has-error has-feedback');
        $('.icon-fechafin').removeClass('glyphicon glyphicon-remove form-control-feedback');

         $('#inp-estatus-precio').bootstrapToggle('on');

});

  //quitar precio del producto
    $(document).on('click', '.eliminar-btn-detalle', function(){
      id = $(this).attr('value');
      
      $('#modaleliminarprecio').modal({
        show:'false',
      });
      
      $('#eliminar-precio').attr('value', id);
      
      return false;
  });


  $(document).on('click', '#eliminar-precio', function(){
      id = $(this).attr('value');
      $('#fila_'+id).remove();
  });

    $(document).on('change', '#unidad', function(){
        valor = $(this).val();
        $('#valorunidad').attr('value', valor);
    });

    $(document).on('change', '#importador', function(){
        valor = $(this).val();
        $('#valorimportador').attr('value', valor);
    });

    $(document).on('change', '#almacen', function(){
        valor = $(this).val();
        $('#valoralmacen').attr('value', valor);
    });

    $(document).on('change', '#familia', function(){
        valor = $(this).val();
        $('#valorfamilia').attr('value', valor);
    });

      $(document).on('change', '#categoria', function(){
        valor = $(this).val();
        $('#valorcategoria').attr('value', valor);
    });


    $(document).on('click', '#inp-estatus-web', function(){

      if($('#inp-estatus-web').prop("checked") == true){
         id = $(this).attr('value', '1');
         alert(id);
        } else {
            $(this).attr('value', '');
        }
        
    });

    //$('#inp-estatus-precio').bootstrapToggle('on');

    $(document).on('click', '#inp-estatus', function(){

      if($('#inp-estatus').prop("checked") == true){
         $(this).attr('value', '1');
        } else {
            $(this).attr('value', '');
        }
        
    });

    $(document).on('click', '#inp-iva', function(){

      if($('#inp-iva').prop("checked") == true){
         $(this).attr('value', '1');
        } else {
            $(this).attr('value', '');
        }

    });



    //Agregar producto
    $(document).on('click', '#save-producto', function(){


    if($('#inp-estatus-web').prop("checked") == true){
           $("#valor-inp-estatus-web").val(1);
      } else {
          $("#valor-inp-estatus-web").val(0);
      }

    if($('#inp-estatus').prop("checked") == true){
           $("#valor-inp-estatus").val(1);
      } else {
          $("#valor-inp-estatus").val(0);
      }

    if($('#inp-iva').prop("checked") == true){
           $("#valor-inp-iva").val(1);
      } else {
          $("#valor-inp-iva").val(0);
      }
      
    tabla_a = $('#list_p_ tbody');
    
    f = $(".formulario");

    formData = new FormData(f[0]);

        $.ajax({
                url:  "/productos/agregarnuevoproducto",
                type: "POST",
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false, 
                success: function(p){

                nueva_fila = '<tr id="fila_'+p.id+'">'+
                        '<td><span class="hidden">'+p.created_at+'</span>'+p.clave+'</td>'+
                        '<td>'+p.nombre+'</td>'+
                        '<td><span title="Ver foto del producto" class="pro-foto" id="'+p.foto+'" data-id="'+p.nombre+'">Ver Foto</span></td>'+
                        '<td>'+p.color+'</td>'+
                        '<td>'+p.descripcion+'</td>'+
                        '<td>'+p.categoria+'</td>'+
                        '<td><span class="estatus_'+p.estatus+'"></span></td>'+
                        '<td>'+
                         '<button class="btn btn-info editar-n" value="'+p.id+'" title="Editar producto">'+
                                  '<span class="glyphicon glyphicon-edit"></span>'+
                            '</button>'+
                      '</td>'+
                  '</tr>';
                    
                  tabla_a.prepend(nueva_fila);
                  

                  //llamamos a la funcion para registrar los precios
                  guardarprecios(p.id);

                  $('.estatus_0').text('Inactivo');
                  $('.estatus_0').addClass('text-danger');
                  $('.estatus_1').text('Activo');
                  $('.estatus_1').addClass('text-success');

                  //Limpiamos
                  $('#clave-producto').val('');
                  $('#articulo').val('');
                  $('#nombre').val('');
                  $('#ean-code').val('');
                  $('#color').val('');
                  $('#n-color').val('');
                  $('#dimensiones').val('');
                  $('#cantidad').val('');
                  $('#piezas').val('');
                  $('#pallet').val('');
                  $('#totalpiezas').val('');
                  $('#foto').val('');

                  $('#unidad').html('');
                  $('#importador').html('');
                  $('#almacen').html('');
                  $('#familia').html('');
                  $('#categoria').html('');

                  $('#inp-estatus-web').bootstrapToggle('on');
                  $('#inp-estatus').bootstrapToggle('on');
                  $('#inp-iva').bootstrapToggle('off');

                  $('#body-precio-detalle-edit').html('');
                              
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

    });


    //Cancelar guardar prducto  
    $(document).on('click', '#cancelar-producto', function(){

        $('#clave-producto').val('');
        $('#articulo').val('');
        $('#nombre').val('');
        $('#ean-code').val('');
        $('#color').val('');
        $('#n-color').val('');
        $('#dimensiones').val('');
        $('#cantidad').val('');
        $('#piezas').val('');
        $('#pallet').val('');
        $('#totalpiezas').val('');
        $('#foto').val('');

        $('#unidad').html('');
        $('#importador').html('');
        $('#almacen').html('');
        $('#familia').html('');
        $('#categoria').html('');

        $('#inp-estatus-web').bootstrapToggle('on');
        $('#inp-estatus').bootstrapToggle('on');
        $('#inp-iva').bootstrapToggle('off');

        $('.error-clave').removeClass('has-error has-feedback');
        $('.icon-clave').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-articulo').removeClass('has-error has-feedback');
        $('.icon-articulo').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-nombre').removeClass('has-error has-feedback');
        $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-ean-code').removeClass('has-error has-feedback');
        $('.icon-ean-code').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-color').removeClass('has-error has-feedback');
        $('.icon-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-n-color').removeClass('has-error has-feedback');
        $('.icon-n-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-unidad').removeClass('has-error has-feedback');

        $('.error-dimensiones').removeClass('has-error has-feedback');
        $('.icon-dimensiones').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-cantidad').removeClass('has-error has-feedback');
        $('.icon-cantidad').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-piezas').removeClass('has-error has-feedback');
        $('.icon-piezas').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-pallet').removeClass('has-error has-feedback');
        $('.icon-pallet').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-totalpiezas').removeClass('has-error has-feedback');
        $('.icon-totalpiezas').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-importador').removeClass('has-error has-feedback');
        $('.icon-importador').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-almacen').removeClass('has-error has-feedback');
        $('.icon-almacen').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-familia').removeClass('has-error has-feedback');
        $('.icon-familia').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-categoria').removeClass('has-error has-feedback');
        $('.icon-categoria').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-foto-label').removeClass('error-add-image');
        $('#foto').removeClass('error-add-image');

        $('#body-precio-detalle').html('');
        $('#body-precio-detalle-edit').html('');


    });


    // X
    $(document).on('click', '.close', function(){

        $('#clave-producto').val('');
        $('#articulo').val('');
        $('#nombre').val('');
        $('#ean-code').val('');
        $('#color').val('');
        $('#n-color').val('');
        $('#dimensiones').val('');
        $('#cantidad').val('');
        $('#piezas').val('');
        $('#pallet').val('');
        $('#totalpiezas').val('');
        $('#foto').val('');

        $('#unidad').html('');
        $('#importador').html('');
        $('#almacen').html('');
        $('#familia').html('');
        $('#categoria').html('');

        $('.error-clave').removeClass('has-error has-feedback');
        $('.icon-clave').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-articulo').removeClass('has-error has-feedback');
        $('.icon-articulo').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-nombre').removeClass('has-error has-feedback');
        $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-ean-code').removeClass('has-error has-feedback');
        $('.icon-ean-code').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-color').removeClass('has-error has-feedback');
        $('.icon-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-n-color').removeClass('has-error has-feedback');
        $('.icon-n-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-unidad').removeClass('has-error has-feedback');

        $('.error-dimensiones').removeClass('has-error has-feedback');
        $('.icon-dimensiones').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-cantidad').removeClass('has-error has-feedback');
        $('.icon-cantidad').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-piezas').removeClass('has-error has-feedback');
        $('.icon-piezas').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-pallet').removeClass('has-error has-feedback');
        $('.icon-pallet').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-totalpiezas').removeClass('has-error has-feedback');
        $('.icon-totalpiezas').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-importador').removeClass('has-error has-feedback');
        $('.icon-importador').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-almacen').removeClass('has-error has-feedback');
        $('.icon-almacen').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-familia').removeClass('has-error has-feedback');
        $('.icon-familia').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-categoria').removeClass('has-error has-feedback');
        $('.icon-categoria').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-foto-label').removeClass('error-add-image');
        $('#foto').removeClass('error-add-image');

        //Al editar
        $('.error-clave-edit').removeClass('has-error has-feedback');
        $('.icon-clave-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-articulo-edit').removeClass('has-error has-feedback');
        $('.icon-articulo-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-nombre-edit').removeClass('has-error has-feedback');
        $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-ean-code-edit').removeClass('has-error has-feedback');
        $('.icon-ean-code-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-color-edit').removeClass('has-error has-feedback');
        $('.icon-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-n-color-edit').removeClass('has-error has-feedback');
        $('.icon-n-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-dimensiones-edit').removeClass('has-error has-feedback');
        $('.icon-dimensiones-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-cantidad-edit').removeClass('has-error has-feedback');
        $('.icon-cantidad-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-piezas-edit').removeClass('has-error has-feedback');
        $('.icon-piezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-pallet-edit').removeClass('has-error has-feedback');
        $('.icon-pallet-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-totalpiezas-edit').removeClass('has-error has-feedback');
        $('.icon-totalpiezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('#body-precio-detalle-edit').html('');
        $('#body-precio-detalle').html('');

        $('#save-precio-producto').removeClass('save-precio-producto');

        $('#unidad-edit').html('');
        $('#importador-edit').html('');
        $('#almacen-edit').html('');
        $('#familia-edit').html('');
        $('#categoria-edit').html('');

    });


    function guardarprecios(id){

      var DATA = [];
    
      $('.tabla_detallepro tbody tr').each(function(){
                id_producto = id;
                precio  = $(this).find("td[class*='td_precio']").attr('value');
                tipo_precio = $(this).find("td[class*='td_tipo_precio']").attr('value');
                moneda  = $(this).find("td[class*='td_moneda']").attr('value');
                fecha_inicio  = $(this).find("td[class*='td_fecha_inicio']").attr('value');
                fecha_fin  = $(this).find("td[class*='td_fecha_fin']").attr('value');
                estatus = $(this).find("td[class*='td_estatus']").attr('value');

                datos = {id_producto, precio, tipo_precio, moneda, fecha_inicio, fecha_fin, estatus };

                DATA.push(datos);
        
        });

        if(DATA == ''){
          
        } else {
                
             aInfo = JSON.stringify(DATA);
          
                $.ajax({
                    url:  "/productos/agregarnuevoprecioalproducto",
                    type: "POST",
                    data:{aInfo: aInfo},
                    success: function(d){
                      
                      $('#body-precio-detalle').html('');
                    },
          
                    error: function(){
                      alert('failure');
                    }
                                    
              });
        }

    }



//Editar producto
$(document).on('click', '.editar-n', function(){
    id = $(this).attr('value');

    $('#save-precio-producto').addClass('save-precio-producto');
    
    $('#agregarproductoedit').modal({
      show:'false',
    });

      //Listamos los campos
        $.ajax({
                url:  "/productos/listarproductoedit",
                type: "GET",
                data:{id: id},
                success: function(e){
                  $('#clave-producto-edit').val(e.clave);
                  $('#articulo-edit').val(e.numero_articulo);
                  $('#clave-producto-edit').val(e.clave);
                  $('#nombre-edit').val(e.nombre);
                  $('#ean-code-edit').val(e.ean_code);
                  $('#color-edit').val(e.color);
                  $('#n-color-edit').val(e.numero_color);
                  $('#dimensiones-edit').val(e.dimensiones);
                  $('#cantidad-edit').val(e.cantidad_minima);
                  $('#piezas-edit').val(e.piezas_paquete);
                  $('#pallet-edit').val(e.piezas_pallet);
                  $('#totalpiezas-edit').val(e.total_piezas);
                  
                  $('#ad-nuevo-precio-edit').attr('value', e.id);
                  $('#campo-con-id-producto').attr('value', e.id);

                  activoweb = e.estatus_web;
                  if(activoweb == 1){
                      $('#inp-estatus-web-edit').bootstrapToggle('on');
                  } else {
                      $('#inp-estatus-web-edit').bootstrapToggle('off');
                  }

                  activo = e.estatus;
                  if(activo == 1){
                      $('#inp-estatus-edit').bootstrapToggle('on');
                  } else {
                      $('#inp-estatus-edit').bootstrapToggle('off');
                  }

                 iva = e.iva0;
                  if(iva == 0){
                      $('#inp-iva-edit').bootstrapToggle('on');
                  } else {
                      $('#inp-iva-edit').bootstrapToggle('off');
                  }

                  
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

        //Listamos las unidades de medida
       $.ajax({
                url:  "/productos/selectunidadesedit",
                type: "GET",
                data:{id: id},
                success: function(s){
                      option = "";
                      x = $('#unidad-edit');
                          
                           option += '<option value="'+s.u_a[0].id+'">'+s.u_a[0].descripcion+'</option>';
                      for(datos in s.unidad){

                            option += '<option value="'+s.unidad[datos].id+'">'+s.unidad[datos].descripcion+'</option>';
                      }

                      x.append(option);

                      $('#valorunidad-edit').attr('value', s.u_a[0].id);
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

    //Listamos los importadores
       $.ajax({
                url:  "/productos/selectimportadoredit",
                type: "GET",
                data:{id: id},
                success: function(s){
                      option = "";
                      x = $('#importador-edit');
                          
                           option += '<option value="'+s.i_a[0].id+'">'+s.i_a[0].nombre+'</option>';
                      for(datos in s.importador){

                            option += '<option value="'+s.importador[datos].id+'">'+s.importador[datos].nombre+'</option>';
                      }

                      x.append(option);

                      $('#valorimportador-edit').attr('value', s.i_a[0].id);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

     //Listamos los almacenes
       $.ajax({
                url:  "/productos/selectalmacenedit",
                type: "GET",
                data:{id: id},
                success: function(s){
                      option = "";
                      x = $('#almacen-edit');
                          
                           option += '<option value="'+s.a_a[0].id+'">'+s.a_a[0].nombre+'</option>';
                      for(datos in s.almacen){

                            option += '<option value="'+s.almacen[datos].id+'">'+s.almacen[datos].nombre+'</option>';
                      }

                      x.append(option);

                      $('#valoralmacen-edit').attr('value', s.a_a[0].id);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

         //Listamos las familias
       $.ajax({
                url:  "/productos/selectfamiliasedit",
                type: "GET",
                data:{id: id},
                success: function(s){
                      option = "";
                      x = $('#familia-edit');
                          
                           option += '<option value="'+s.f_a[0].id+'">'+s.f_a[0].descripcion+'</option>';
                      for(datos in s.familia){

                            option += '<option value="'+s.familia[datos].id+'">'+s.familia[datos].descripcion+'</option>';
                      }

                      x.append(option);

                      $('#valorfamilia-edit').attr('value', s.f_a[0].id);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

        //Listamos las categorias
       $.ajax({
                url:  "/productos/selectcategoriasedit",
                type: "GET",
                data:{id: id},
                success: function(s){
                      option = "";
                      x = $('#categoria-edit');
                          
                           option += '<option value="'+s.c_a[0].id+'">'+s.c_a[0].categoria+'</option>';
                      for(datos in s.categoria){

                            option += '<option value="'+s.categoria[datos].id+'">'+s.categoria[datos].categoria+'</option>';
                      }

                      x.append(option);

                      $('#valorcategoria-edit').attr('value', s.c_a[0].id);

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });


         //Listamos los precios del producto
       $.ajax({
                url:  "/productos/listarprecioseditar",
                type: "GET",
                data:{id: id},
                success: function(p){
                  if(p.p_d == ''){
                  
                } else {

                  body = $('#body-precio-detalle-edit');
                  fila = "";

                for(datos in p.p_d){
                                        

                  fila += '<tr class="tr_actual" id="fila_edit_'+p.p_d[datos].id+'">'+
                    '<td class="td_precio_actual" value="'+p.p_d[datos].precio+'">'+accounting.formatMoney(p.p_d[datos].precio)+'</td>'+
                    '<td class="td_tipo_precio_actual tipo_'+p.p_d[datos].tipo+'" value="'+p.p_d[datos].tipo+'"></td>'+
                    '<td class="td_moneda_actual" value="'+p.p_d[datos].moneda+'">'+p.p_d[datos].moneda+'</td>'+
                    '<td class="td_fecha_inicio_actual" value="'+p.p_d[datos].fecha_inicio+'">'+p.p_d[datos].fecha_inicio+'</td>'+
                    '<td class="td_fecha_fin_actual" value="'+p.p_d[datos].fecha_fin+'">'+p.p_d[datos].fecha_fin+'</td>'+
                    '<td id="esta_'+p.p_d[datos].id+'" class="td_estatus_actual estatus_'+p.p_d[datos].estatus+'" value="'+p.p_d[datos].estatus+'"></td>'+
                    '<td><span class="editar-d-a btn btn-sm btn-info" title="Editar" value="'+p.p_d[datos].id+'"><span class="glyphicon glyphicon-edit"></span></span></td>'+
                    '<td><span class="quitar-d-a btn btn-sm btn-danger" title="Eliminar" value="'+p.p_d[datos].id+'"><span class="glyphicon glyphicon-remove"></span></span></td>'+
                    '</tr>';


                }//end for

                body.append(fila);
                
                $('.estatus_0').text('Inactivo');
                $('.estatus_0').addClass('text-warning');
                $('.estatus_1').text('Activo');
                $('.estatus_1').addClass('text-primary');;

                $('.tipo_0').text('Compra');
                $('.tipo_1').text('Retail');
                $('.tipo_2').text('Mayorista');
                $('.tipo_3').text('Distribuidor');

              }

                },
      
                error: function(){
                  alert('failure');
                }
                                
          });





});
   
  

  });


  $(document).on('click', '#cancelar-producto-edit', function(){

        $('.error-clave-edit').removeClass('has-error has-feedback');
        $('.icon-clave-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-articulo-edit').removeClass('has-error has-feedback');
        $('.icon-articulo-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-nombre-edit').removeClass('has-error has-feedback');
        $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-ean-code-edit').removeClass('has-error has-feedback');
        $('.icon-ean-code-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-color-edit').removeClass('has-error has-feedback');
        $('.icon-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-n-color-edit').removeClass('has-error has-feedback');
        $('.icon-n-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-dimensiones-edit').removeClass('has-error has-feedback');
        $('.icon-dimensiones-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-cantidad-edit').removeClass('has-error has-feedback');
        $('.icon-cantidad-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-piezas-edit').removeClass('has-error has-feedback');
        $('.icon-piezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-pallet-edit').removeClass('has-error has-feedback');
        $('.icon-pallet-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('.error-totalpiezas-edit').removeClass('has-error has-feedback');
        $('.icon-totalpiezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

        $('#body-precio-detalle-edit').html('');
        $('#body-precio-detalle').html('');

        $('#save-precio-producto').removeClass('save-precio-producto');

        $('#unidad-edit').html('');
        $('#importador-edit').html('');
        $('#almacen-edit').html('');
        $('#familia-edit').html('');
        $('#categoria-edit').html('');
  });


    //Eliminar los precios ya agregados
    $(document).on('click', '.quitar-d-a', function(){
        id = $(this).attr('value');

      $('#modaleliminarprecioedit').modal({
        show:'false',
      });
      
      $('#eliminar-precio-edit').attr('value', id);
      $('#eliminar-precio-edit').addClass('delete-p-act');
     
  });

    $(document).on('click', '.delete-p-act', function(){
           id = $(this).attr('value');

              $.ajax({
                url:  "/productos/elimartarpreciodelproducto",
                type: "GET",
                data:{id: id},
                success: function(p){
                    
                      $('#fila_edit_'+id).remove();
                      $('#eliminar-precio-edit').removeClass('delete-p-act');
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });
      
     
  });

  $(document).on('click', '#noeliminar-precio-edit', function(){
         $('#eliminar-precio-edit').removeClass('delete-p-act');
  });

//Agregar nuevo precio al editar producto
  $(document).on('click', '#ad-nuevo-precio-edit', function(){
    id_p = $(this).attr('value');
    $('#save-precio-producto').attr('data-id', id_p);

    $('#agregarprecio').modal({
        show:'false',
      });


     $('#inp-estatus-precio').prop('checked', true);

    return false;

});

$(document).on('click', '.save-precio-producto', function(){
    //valores
    id = $(this).attr('data-id');
    precio = $('#precio-producto').val();
    tipo_precio = $('#valortipoprecio').val();
    moneda = $('#valormoneda').val();
    fecha_inicio = $('#fechainicio').val();
    fecha_fin = $('#fechafin').val();

    if($('#inp-estatus-precio').prop("checked") == true){
          activo = 1;
      } else {
          activo = 0;
      }

     /* $('.tabla_detallepro tbody tr').each(function(){

            existe = $(this).find("[class*='td_precio_actual']").attr('data-valor');

            if(existe == tipo_precio+activo){
              id = $('.td_precio_actual').attr('data-id');
              actualizarestatus(id);
            } else {
            }

      })*/


      $.ajax({
                url:  "/productos/agregarprecioaleditar",
                type: "GET",
             data:{id: id, precio: precio, tipo_precio: tipo_precio, moneda: moneda, fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, activo: activo},
              success: function(d){

                body_edit = $('#body-precio-detalle-edit');
                nueva_fila_edit = "";
                

                nueva_fila_edit += '<tr class="tr_actual" id="fila_edit_'+d.id+'">'+
                    '<td class="td_precio_actual" data-id="'+d.id+'" data-valor="'+d.tipo+d.estatus+'" value="'+d.precio+'">'+accounting.formatMoney(d.precio)+'</td>'+
                    '<td class="td_tipo_precio_actual tipo_'+d.tipo+'" value="'+d.tipo+'"></td>'+
                    '<td class="td_moneda_actual" value="'+d.moneda+'">'+d.moneda+'</td>'+
                    '<td class="td_fecha_inicio_actual" value="'+d.fecha_inicio+'">'+d.fecha_inicio+'</td>'+
                    '<td class="td_fecha_fin_actual" value="'+d.fecha_fin+'">'+d.fecha_fin+'</td>'+
                    '<td id="esta_'+d.id+'" class="td_estatus_actual estatus_'+d.estatus+'" value="'+d.estatus+'"></td>'+
                    '<td><span class="editar-d-a btn btn-sm btn-info" title="Editar" value="'+d.id+'"><span class="glyphicon glyphicon-edit"></span></span></td>'+
                    '<td><span class="quitar-d-a btn btn-sm btn-danger" title="Eliminar" value="'+d.id+'"><span class="glyphicon glyphicon-remove"></span></span></td>'+
                    '</tr>';
                        
                body_edit.prepend(nueva_fila_edit);

                $('.estatus_0').text('Inactivo');
                $('.estatus_0').addClass('text-warning');
                $('.estatus_1').text('Activo');
                $('.estatus_1').addClass('text-primary');;

                $('.tipo_0').text('Compra');
                $('.tipo_1').text('Retail');
                $('.tipo_2').text('Mayorista');
                $('.tipo_3').text('Distribuidor');
                
                
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });



});


  /******** Editar precio al editar *******************************/

  $(document).on('click', '.editar-d-a', function(){
      
    id_producto_precio = $(this).attr('value');
    id_producto = $('#ad-nuevo-precio-edit').attr('value');
    
    $('#save-precio-producto-edit').attr('value', id_producto_precio);
    $('#save-precio-producto-edit').attr('data-id', id_producto);
    
    $('#agregarprecioedit').modal({
      show:'false',
    });

    //datos
    $.ajax({
          url:  "/productos/listarpreciosedit",
          type: "GET",
          data:{id_producto_precio: id_producto_precio},
          success: function(e){

            $('#precio-producto-edit').val(e.precio);
            $('#fechainicio-edit').val(e.fecha_inicio);
            $('#fechafin-edit').val(e.fecha_fin);

            //tipo de precio
            tipo = e.tipo;

            $('#valortipoprecio-edit').attr('value', e.tipo);

            option = "";

            if(tipo == 0){


              option += '<option value="0" selected>Compra</option>'+
                        '<option value="1">Retail</option>'+
                        '<option value="2">Mayorista</option>'+
                        '<option value="3">Distribuidor</option>';


            } else if(tipo == 1){

               option += '<option value="0" selected>Compra</option>'+
                        '<option value="1" selected>Retail</option>'+
                        '<option value="2">Mayorista</option>'+
                        '<option value="3">Distribuidor</option>';

            } else if(tipo == 2){

              option += '<option value="0" selected>Compra</option>'+
                        '<option value="1">Retail</option>'+
                        '<option value="2" selected>Mayorista</option>'+
                        '<option value="3">Distribuidor</option>';

            } else if(tipo == 3){

              option += '<option value="0" selected>Compra</option>'+
                        '<option value="1">Retail</option>'+
                        '<option value="2">Mayorista</option>'+
                        '<option value="3" selected>Distribuidor</option>';

            }

          $('#tipo-precio-edit').append(option);

          //estatus
            estatus = e.estatus;
            if(estatus == 0){
                $('#inp-estatus-precio-edit').bootstrapToggle('off');
            } else {
                $('#inp-estatus-precio-edit').bootstrapToggle('on');
            }

          //moneda
            moneda = e.moneda;
            $('#valormoneda-edit').attr('value', e.moneda);

            optionmoneda = "";

            if(moneda  == 'Pesos Mx'){


              optionmoneda += '<option value="Pesos Mx" selected>Pesos Mx</option>'+
                              '<option value="Dolar">Dolar</option>'+
                              '<option value="Otro">Otro</option>';


            } else if(moneda  == 'Dolar'){

               optionmoneda += '<option value="Pesos Mx">Pesos Mx</option>'+
                              '<option value="Dolar" selected>Dolar</option>'+
                              '<option value="Otro">Otro</option>';

            } else if(moneda  == 'Otro'){

              optionmoneda += '<option value="Pesos Mx">Pesos Mx</option>'+
                              '<option value="Dolar">Dolar</option>'+
                              '<option value="Otro" selected>Otro</option>';

            } 

          $('#moneda-edit').append(optionmoneda);
          
        },

          error: function(){
            alert('failure');
          }
                          
  });

    

});

$(document).on('click', '#cancelar-precio-producto-edit', function(){
    $('#moneda-edit').html('');
    $('#tipo-precio-edit').html('');
});

$(document).on('change', '#tipo-precio-edit', function(){
    valor = $(this).val();
    $('#valortipoprecio-edit').attr('value', valor);
});

$(document).on('change', '#moneda-edit', function(){
   valor = $(this).val();
   $('#valormoneda-edit').attr('value', valor);
});

$(document).on('click', '#save-precio-producto-edit', function(){
    id_precio = $(this).attr('value');
    id_producto = $(this).attr('data-id');

    precio = $('#precio-producto-edit').val();
    tipo_precio = $('#valortipoprecio-edit').attr('value');
    moneda = $('#valormoneda-edit').val();
    fecha_inicio = $('#fechainicio-edit').val();
    fecha_fin = $('#fechafin-edit').val();

  if($('#inp-estatus-precio-edit').prop("checked") == true){
          activo = 1;
      } else {
          activo = 0;
      }


      $.ajax({
                url:  "/productos/actualizarproductoprecio",
                type: "GET",
             data:{id_precio: id_precio, id_producto: id_producto, precio: precio, tipo_precio: tipo_precio, moneda: moneda, fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, activo: activo},
              success: function(d){

                        $('#fila_edit_'+d.id).replaceWith('<tr class="tr_actual" id="fila_edit_'+d.id+'">'+
                            '<td class="td_precio_actual" value="'+d.precio+'">'+accounting.formatMoney(d.precio)+'</td>'+
                            '<td class="td_tipo_precio_actual tipo_'+d.tipo+'" value="'+d.tipo+'"></td>'+
                            '<td class="td_moneda_actual" value="'+d.moneda+'">'+d.moneda+'</td>'+
                            '<td class="td_fecha_inicio_actual" value="'+d.fecha_inicio+'">'+d.fecha_inicio+'</td>'+
                            '<td class="td_fecha_fin_actual" value="'+d.fecha_fin+'">'+d.fecha_fin+'</td>'+
                            '<td id="esta_'+d.id+'" class="td_estatus_actual estatus_'+d.estatus+'" value="'+d.estatus+'"></td>'+
                            '<td><span class="editar-d-a btn btn-sm btn-info" title="Editar" value="'+d.id+'"><span class="glyphicon glyphicon-edit"></span></span></td>'+
                            '<td><span class="quitar-d-a btn btn-sm btn-danger" title="Eliminar" value="'+d.id+'"><span class="glyphicon glyphicon-remove"></span></span></td>'+
                       '</tr>');


                      $('.estatus_0').text('Inactivo');
                      $('.estatus_0').addClass('text-warning');
                      $('.estatus_1').text('Activo');
                      $('.estatus_1').addClass('text-primary');;

                      $('.tipo_0').text('Compra');
                      $('.tipo_1').text('Retail');
                      $('.tipo_2').text('Mayorista');
                      $('.tipo_3').text('Distribuidor');

                      //limpiamos
                      $('#moneda-edit').html('');
                      $('#tipo-precio-edit').html('');
                
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });



});


function actualizarestatus(id){

        $.ajax({
                url:  "/productos/actualizarestatusprecio",
                type: "GET",
               data:{id: id},
              success: function(d){

                    $('#esta_'+d).attr('value', 0);
                    $('#esta_'+d).text('');
                    $('#esta_'+d).removeClass('text-primary');;
                    $('#esta_'+d).addClass('text-warning');

                
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

}



    $(document).on('change', '#unidad-edit', function(){
        valor = $(this).val();
        $('#valorunidad-edit').attr('value', valor);
    });

    $(document).on('change', '#importador-edit', function(){
        valor = $(this).val();
        $('#valorimportador-edit').attr('value', valor);
    });

    $(document).on('change', '#almacen-edit', function(){
        valor = $(this).val();
        $('#valoralmacen-edit').attr('value', valor);
    });

    $(document).on('change', '#familia-edit', function(){
        valor = $(this).val();
        $('#valorfamilia-edit').attr('value', valor);
    });

      $(document).on('change', '#categoria-edit', function(){
        valor = $(this).val();
        $('#valorcategoria-edit').attr('value', valor);
    });


    $(document).on('click', '#inp-estatus-web-edit', function(){

      if($('#inp-estatus-web-edit').prop("checked") == true){
         id = $(this).attr('value', '1');
         alert(id);
        } else {
            $(this).attr('value', '');
        }
        
    });

    //$('#inp-estatus-precio').bootstrapToggle('on');

    $(document).on('click', '#inp-estatus-edit', function(){

      if($('#inp-estatus-edit').prop("checked") == true){
         $(this).attr('value', '1');
        } else {
            $(this).attr('value', '');
        }
        
    });

    $(document).on('click', '#inp-iva-edit', function(){

      if($('#inp-iva-edit').prop("checked") == true){
         $(this).attr('value', '1');
        } else {
            $(this).attr('value', '');
        }

    });




$(document).on('click', '#save-producto-edit', function(){

      if($('#inp-estatus-web-edit').prop("checked") == true){
           $("#valor-inp-estatus-web-edit").val(1);
      } else {
          $("#valor-inp-estatus-web-edit").val(0);
      }

    if($('#inp-estatus-edit').prop("checked") == true){
           $("#valor-inp-estatus-edit").val(1);
      } else {
          $("#valor-inp-estatus-edit").val(0);
      }

    if($('#inp-iva-edit').prop("checked") == true){
           $("#valor-inp-iva-edit").val(1);
      } else {
          $("#valor-inp-iva-edit").val(0);
      }
      
    
    f = $(".formulario-edit");

    formData = new FormData(f[0]);

        $.ajax({
                url:  "/productos/actualizarproducto",
                type: "POST",
                data: formData,
                //necesario para subir archivos via ajax
                cache: false,
                contentType: false,
                processData: false, 
                success: function(p){

                  $('#fila_'+p.id).replaceWith('<tr id="fila_'+p.id+'">'+
                        '<td><span class="hidden">'+p.created_at+'</span>'+p.clave+'</td>'+
                        '<td>'+p.nombre+'</td>'+
                        '<td><span title="Ver foto del producto" class="pro-foto" id="'+p.foto+'" data-id="'+p.nombre+'">Ver Foto</span></td>'+
                        '<td>'+p.color+'</td>'+
                        '<td>'+p.descripcion+'</td>'+
                        '<td>'+p.categoria+'</td>'+
                        '<td><span class="estatus_'+p.estatus+'"></span></td>'+
                        '<td>'+
                         '<button class="btn btn-info editar-n" value="'+p.id+'" title="Editar producto">'+
                                  '<span class="glyphicon glyphicon-edit"></span>'+
                            '</button>'+
                      '</td>'+
                  '</tr>');
               
                  $('.estatus_0').text('Inactivo');
                  $('.estatus_0').addClass('text-danger');
                  $('.estatus_1').text('Activo');
                  $('.estatus_1').addClass('text-success');

                  $('#body-precio-detalle-edit').html('');

                  $('#unidad-edit').html('');
                  $('#importador-edit').html('');
                  $('#almacen-edit').html('');
                  $('#familia-edit').html('');
                  $('#categoria-edit').html('');
                              
                },
      
                error: function(){
                  alert('failure');
                }
                                
          });

});


//Cargar archivo de productos
$(document).on('click', '#ad-nuevo-archivo-productos', function(){
    $('#modalcargararchivo').modal({
      show:'false',
    });

    return false;
});

$(document).on('click', '#enviar_file', function(){
  $('.error-buscador').removeClass('has-error has-feedback');
  $('.txt-browse').removeClass('error-cargar-archivo'); 
});

$(document).on('click', '#cargar-archivo', function(){

    if($('#browse-p input[type=text]').val() == ''){
      $('.error-buscador').addClass('has-error has-feedback');
      $('.txt-browse').addClass('error-cargar-archivo'); 
    } else {

     f = $(".formulario-archivo");

     $(".error1").hide();
     $(".agregados-correctamente").hide();
     $(".duplicados-prod").hide();
     $('.footer-productos-duplicados').hide();
     $('.pregunta-productos').hide();

     formData = new FormData(f[0]);

        $('#modalprcesarproducto').modal({
          show:'false',
        });

        $.ajax({
            url: '/productos/agregarproductosarchivo',
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,

            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false, 
            //mientras enviamos el archivo
          /*  beforeSend: function(){
                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                showMessage(message)
            },*/
            //una vez finalizado correctamente
            success: function(p){

              $('#modalprcesarproducto').modal('hide');

              $('#modalmostrarerrores').modal({
                show:'false',
              });

              //cantidad de errores encontrados
              $('.span-errores').text(p.total_de_errores);

              if(p.total_de_errores > 0){
                $(".error1").show();
              }
              //cantidad de productos agregados
              $('.span-agregados').text(p.total_agregados);

              if(p.total_agregados > 0){
                $(".agregados-correctamente").show();
              }

              //cantidad de productos duplicados
              $('.span-duplicados').text(p.total_duplicados);

              if(p.total_duplicados > 0){
                $(".duplicados-prod").show();
                $('#cancelar-productos-duplicados').text('No');
                $('#salir-modal').hide();
                $('.footer-productos-duplicados').show();
                $('.pregunta-productos').show();
              }

            

                      //campos vacios
                      linea = "";
                      contenedor = $('#contenedor-errores-producto');
                  
                               for(datos in p.campos_vacios){

                                      linea += '<tr>'+
                                        '<td class="text-danger">'+p.campos_vacios[datos].linea+'</td>'+
                                        '<td class="text-danger">No se encontraron algunos campos.</td>'+
                                        '<td class="text-danger"></td>'+
                                        '<td class="text-danger"></td>'+
                                      '</tr>';
                                }

                                contenedor.append(linea);

                      //clave vacia
                      linea2 = "";
                      contenedor2 = $('#contenedor-errores-producto');
                  
                               for(datos in p.clave_vacia){

                                      linea2 += '<tr>'+
                                        '<td class="text-danger">'+p.clave_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">La clave esta vacia.</td>'+
                                      '</tr>';
                                }

                                contenedor2.append(linea2);

                    //numero de articulo vacio
                      linea3 = "";
                      contenedor3 = $('#contenedor-errores-producto');
                  
                               for(datos in p.numero_articulo_vacia){

                                      linea3 += '<tr>'+
                                        '<td class="text-danger">'+p.numero_articulo_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El número de articulo esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor3.append(linea3);

                  //nombre vacia
                      linea4 = "";
                      contenedor4 = $('#contenedor-errores-producto');
                  
                               for(datos in p.nombre_vacia){

                                      linea4 += '<tr>'+
                                        '<td class="text-danger">'+p.nombre_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El nombre del producto esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor4.append(linea4);

                  //ean_code vacia
                      linea5 = "";
                      contenedor5 = $('#contenedor-errores-producto');
                  
                               for(datos in p.ean_code_vacia){

                                      linea5 += '<tr>'+
                                        '<td class="text-danger">'+p.ean_code_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El ean code del producto esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor5.append(linea5);

                //color vacio
                      linea6 = "";
                      contenedor6 = $('#contenedor-errores-producto');
                  
                               for(datos in p.color_vacia){

                                      linea6 += '<tr>'+
                                        '<td class="text-danger">'+p.color_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El color del producto esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor6.append(linea6);

                    //numero de color vacio
                      linea7 = "";
                      contenedor7 = $('#contenedor-errores-producto');
                  
                               for(datos in p.ncolor_vacia){

                                      linea7 += '<tr>'+
                                        '<td class="text-danger">'+p.ncolor_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El numeró de color esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor7.append(linea7);

                    //piezas x paquete vacio
                      linea8 = "";
                      contenedor8 = $('#contenedor-errores-producto');
                  
                               for(datos in p.piezas_paquete_vacia){

                                      linea8 += '<tr>'+
                                        '<td class="text-danger">'+p.piezas_paquete_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El campo piezas x paquete esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor8.append(linea8);

                    //piezas x paquete no es un numero
                      linea9 = "";
                      contenedor9 = $('#contenedor-errores-producto');
                  
                               for(datos in p.piezas_paquete_nonumero){

                                      linea9 += '<tr>'+
                                        '<td class="text-danger">'+p.piezas_paquete_nonumero[datos].linea+'</td>'+
                                        '<td class="text-danger">El campo piezas x paquete no es un numeró.</td>'+
                                      '</tr>';
                                }

                                contenedor9.append(linea9);
//----------------------------------------------------------------------------------------------------
                    //dimensiones vacias
                      linea10 = "";
                      contenedor10 = $('#contenedor-errores-producto');
                  
                               for(datos in p.dimensiones_vacia){

                                      linea10 += '<tr>'+
                                        '<td class="text-danger">'+p.dimensiones_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El campo piezas x paquete esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor10.append(linea10);

                  //total de piezas vacias
                      linea11 = "";
                      contenedor11 = $('#contenedor-errores-producto');
                  
                               for(datos in p.total_piezas_vacia){

                                      linea11 += '<tr>'+
                                        '<td class="text-danger">'+p.total_piezas_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El campo total de piezas esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor11.append(linea11);

                  //foto vacia
                      linea12 = "";
                      contenedor12 = $('#contenedor-errores-producto');
                  
                               for(datos in p.foto_vacia){

                                      linea12 += '<tr>'+
                                        '<td class="text-danger">'+p.foto_vacia[datos].linea+'</td>'+
                                        '<td class="text-danger">El campo foto esta vacío.</td>'+
                                      '</tr>';
                                }

                                contenedor12.append(linea12);

                //cantidad minima no es un numero
                      linea13 = "";
                      contenedor13 = $('#contenedor-errores-producto');
                  
                               for(datos in p.cantidad_minima_nonumero){

                                      linea13 += '<tr>'+
                                        '<td class="text-danger">'+p.cantidad_minima_nonumero[datos].linea+'</td>'+
                                        '<td class="text-danger">La cantidad mínima no es un número.</td>'+
                                      '</tr>';
                                }

                                contenedor13.append(linea13);

                      //estatus web invalido
                      linea14 = "";
                      contenedor14 = $('#contenedor-errores-producto');
                  
                               for(datos in p.estatus_web_invalido){

                                      linea14 += '<tr>'+
                                        '<td class="text-danger">'+p.estatus_web_invalido[datos].linea+'</td>'+
                                        '<td class="text-danger">El estatus web es invalido.</td>'+
                                      '</tr>';
                                }

                                contenedor14.append(linea14);

                      //estatus invalido
                      linea15 = "";
                      contenedor15 = $('#contenedor-errores-producto');
                  
                               for(datos in p.estatus_invalido){

                                      linea15 += '<tr>'+
                                        '<td class="text-danger">'+p.estatus_invalido[datos].linea+'</td>'+
                                        '<td class="text-danger">El estatus es invalido.</td>'+
                                      '</tr>';
                                }

                                contenedor15.append(linea15);
            //--------------------------------------------------------------------------------------------------
                  //unidad de medida no existe
                      linea16 = "";
                      contenedor16 = $('#contenedor-errores-producto');
                  
                               for(datos in p.unidad_invalida){

                                      linea16 += '<tr>'+
                                        '<td class="text-danger">'+p.unidad_invalida[datos].linea+'</td>'+
                                        '<td class="text-danger">La unidad de medida no se encuentra en el catalogo.</td>'+
                                      '</tr>';
                                }

                                contenedor16.append(linea16);

                      //importador no existe
                      linea17 = "";
                      contenedor17 = $('#contenedor-errores-producto');
                  
                               for(datos in p.importador_invalida){

                                      linea17 += '<tr>'+
                                        '<td class="text-danger">'+p.importador_invalida[datos].linea+'</td>'+
                                        '<td class="text-danger">El importador no se encuentra en el catalogo.</td>'+
                                      '</tr>';
                                }

                                contenedor17.append(linea17);

                     //almacen no existe
                      linea18 = "";
                      contenedor18 = $('#contenedor-errores-producto');
                  
                               for(datos in p.almacen_invalida){

                                      linea18 += '<tr>'+
                                        '<td class="text-danger">'+p.almacen_invalida[datos].linea+'</td>'+
                                        '<td class="text-danger">El almacén no se encuentra en el catalogo.</td>'+
                                      '</tr>';
                                }

                                contenedor18.append(linea18);

                      //familia no existe
                      linea19 = "";
                      contenedor19 = $('#contenedor-errores-producto');
                  
                               for(datos in p.familia_invalida){

                                      linea19 += '<tr>'+
                                        '<td class="text-danger">'+p.familia_invalida[datos].linea+'</td>'+
                                        '<td class="text-danger">La familia no se encuentra en el catalogo.</td>'+
                                      '</tr>';
                                }

                                contenedor19.append(linea19);

                      //categoria no existe
                      linea20 = "";
                      contenedor20 = $('#contenedor-errores-producto');
                  
                               for(datos in p.categoria_invalida){

                                      linea20 += '<tr>'+
                                        '<td class="text-danger">'+p.categoria_invalida[datos].linea+'</td>'+
                                        '<td class="text-danger">La categoría no se encuentra en el catalogo.</td>'+
                                      '</tr>';
                                }

                                contenedor20.append(linea20);

              //producto precio ------------------------------------------------------------
              //producto precio no es numero
                      linea21 = "";
                      contenedor21 = $('#contenedor-errores-producto');
                  
                               for(datos in p.productoprecio_precio_nonumero){

                                      linea21 += '<tr>'+
                                        '<td class="text-danger">'+p.productoprecio_precio_nonumero[datos].linea+'</td>'+
                                        '<td class="text-danger">El precio del producto no es un número.</td>'+
                                      '</tr>';
                                }

                                contenedor21.append(linea21);

                  //el tipo delproduco precio no existe
                      linea22 = "";
                      contenedor22 = $('#contenedor-errores-producto');
                  
                               for(datos in p.productoprecio_tipo_invalido){

                                      linea22 += '<tr>'+
                                        '<td class="text-danger">'+p.productoprecio_tipo_invalido[datos].linea+'</td>'+
                                        '<td class="text-danger">El tipo de precio no se encuentra en el catálogo.</td>'+
                                      '</tr>';
                                }

                                contenedor22.append(linea22);

               //el tipo delproduco precio no existe
                      linea23 = "";
                      contenedor23 = $('#contenedor-errores-producto');
                  
                               for(datos in p.productoprecio_estatus_invalido){

                                      linea23 += '<tr>'+
                                        '<td class="text-danger">'+p.productoprecio_estatus_invalido[datos].linea+'</td>'+
                                        '<td class="text-danger">El estatus del precio del producto es invalido.</td>'+
                                      '</tr>';
                                }

                                contenedor23.append(linea23);


              //productos agregados correctamente
                      linea24 = "";
                      contenedor24 = $('#contenedor-agregados-producto');
                  
                               for(datos in p.productos_agregados){

                                      linea24 += '<tr>'+
                                        '<td class="text-success">'+p.productos_agregados[datos].clave+'</td>'+
                                        '<td class="text-success">'+p.productos_agregados[datos].nombre+'</td>'+
                                        '<td class="text-success estatus_agregado_'+p.productos_agregados[datos].estatus+'"></td>'+
                                      '</tr>';
                                }

                                contenedor24.append(linea24);

                        $('.estatus_agregado_0').text('Inactivo');
                        $('.estatus_agregado_1').text('Activo');

                   //productos duplicados
                      linea25 = "";
                      contenedor25 = $('#contenedor-duplicados-producto');
                  
                               for(datos in p.clave_repetida){

                                      $('#numero_filas').attr('data-numero', datos);

                                      linea25 += '<tr>'+
                                        '<td class="text-info text-datos" data-numero="'+datos+'" data-clave="'+p.clave_repetida[datos].clave+'" data-numeroarticulo="'+p.clave_repetida[datos].numero_articulo+'" data-nombre="'+p.clave_repetida[datos].nombre+'" data-eancode="'+p.clave_repetida[datos].ean_code+'" data-color="'+p.clave_repetida[datos].color+'" data-ncolor="'+p.clave_repetida[datos].numero_color+'" data-unidad="'+p.clave_repetida[datos].unidad_medida_id+'" data-piezaspaquete="'+p.clave_repetida[datos].piezas_paquete+'" data-dimensiones="'+p.clave_repetida[datos].dimensiones+'" data-piezaspallet="'+p.clave_repetida[datos].piezas_pallet+'" data-totalpiezas="'+p.clave_repetida[datos].total_piezas+'" data-foto="'+p.clave_repetida[datos].foto+'" data-importador="'+p.clave_repetida[datos].importador_id+'" data-almacen="'+p.clave_repetida[datos].almacen_id+'" data-familia="'+p.clave_repetida[datos].familia_id+'" data-categoria="'+p.clave_repetida[datos].categoria_id+'" data-iva0="'+p.clave_repetida[datos].iva0+'" data-cantidadminima="'+p.clave_repetida[datos].cantidad_minima+'" data-estatusweb="'+p.clave_repetida[datos].estatus_web+'" data-estatus="'+p.clave_repetida[datos].estatus+'">'+p.clave_repetida[datos].clave+'</td>'+
                                        '<td class="text-info">'+p.clave_repetida[datos].nombre+'</td>'+
                                        '<td class="text-info estatus_duplicado_'+p.clave_repetida[datos].estatus+'"></td>'+
                                      '</tr>';
                                }

                                contenedor25.append(linea25);

                      $('.estatus_duplicado_0').text('Inactivo');
                      $('.estatus_duplicado_1').text('Activo');
                

                      $(".catalogo-producto").load(location.href+" .catalogo-producto>*","");

            },

            error: function(){
                alert('failure');
            }
        });
    }//end else




});


$(document).on('click', '#cancelar-productos-duplicados', function(){

     $(".error1").hide();
     $(".agregados-correctamente").hide();
     $(".duplicados-prod").hide();
     $('#salir-modal').show();
     $('.footer-productos-duplicados').hide();
     $('.pregunta-productos').hide();
     $('#browse-p input[type=text]').val('');

     bolveralistar();

     //eliminamos todos los regitros mostrados
    eliminartodoslosregitros() 

    //limpiamos
    $('#contenedor-duplicados-producto').html('');
    $('#contenedor-errores-producto').html('');
    $('#contenedor-agregados-producto').html('');
    $('.span-duplicados').text('');
    $('.span-agregados').text('');
    $('.span-errores').text('');

});

$(document).on('click', '#salir-modal', function(){

     $(".error1").hide();
     $(".agregados-correctamente").hide();
     $(".duplicados-prod").hide();
     $('#salir-modal').show();
     $('.footer-productos-duplicados').hide();
     $('.pregunta-productos').hide();
     $('#browse-p input[type=text]').val('');

     bolveralistar();

     //eliminamos todos los regitros mostrados
     eliminartodoslosregitros()

         //limpiamos
    $('#contenedor-duplicados-producto').html('');
    $('#contenedor-errores-producto').html('');
    $('#contenedor-agregados-producto').html('');
    $('.span-duplicados').text('');
    $('.span-agregados').text('');
    $('.span-errores').text('');

});

$(document).on('click', '#agregar-duplicados', function(){

        $('#modalprcesarproducto').modal({
          show:'false',
        });


         var DATA = [];
         $('.duplicados-prod tbody tr').each(function(){

            clave = $(this).find("[class*='text-datos']").attr('data-clave');
            numeroarticulo = $(this).find("[class*='text-datos']").attr('data-numeroarticulo');
            nombre = $(this).find("[class*='text-datos']").attr('data-nombre');
            eancode = $(this).find("[class*='text-datos']").attr('data-eancode');
            color = $(this).find("[class*='text-datos']").attr('data-color');
            ncolor = $(this).find("[class*='text-datos']").attr('data-ncolor');
            unidad = $(this).find("[class*='text-datos']").attr('data-unidad');
            piezaspaquete = $(this).find("[class*='text-datos']").attr('data-piezaspaquete');
            dimensiones = $(this).find("[class*='text-datos']").attr('data-dimensiones');
            piezaspallet = $(this).find("[class*='text-datos']").attr('data-piezaspallet');
            totalpiezas = $(this).find("[class*='text-datos']").attr('data-totalpiezas');
            foto = $(this).find("[class*='text-datos']").attr('data-foto');
            importador = $(this).find("[class*='text-datos']").attr('data-importador');
            almacen = $(this).find("[class*='text-datos']").attr('data-almacen');
            familia = $(this).find("[class*='text-datos']").attr('data-familia');
            categoria = $(this).find("[class*='text-datos']").attr('data-categoria');
            iva0 = $(this).find("[class*='text-datos']").attr('data-iva0');
            cantidadminima = $(this).find("[class*='text-datos']").attr('data-cantidadminima');
            estatusweb = $(this).find("[class*='text-datos']").attr('data-estatusweb');
            estatus = $(this).find("[class*='text-datos']").attr('data-estatus');

            item = {clave, numeroarticulo, nombre, eancode, color, ncolor, unidad, dimensiones, piezaspaquete, piezaspallet, totalpiezas, foto, importador, almacen, familia, categoria, iva0, cantidadminima, estatusweb, estatus};

            DATA.push(item);


           })

          aInfo   = JSON.stringify(DATA);

        $.ajax({
            type: "POST", //metodo
            url: "/productos/actualizarproductosrepetidos",
            data: {aInfo: aInfo },

            success: function (x) {

                   $('#modalprcesarproducto').modal('hide');

                   $(".error1").hide();
                   $(".agregados-correctamente").hide();
                   $(".duplicados-prod").hide();
                   $('#salir-modal').show();
                   $('.footer-productos-duplicados').hide();
                   $('.pregunta-productos').hide();
                   $('#browse-p input[type=text]').val('');

                   bolveralistar();

                   eliminartodoslosregitros();

                       //limpiamos
                  $('#contenedor-duplicados-producto').html('');
                  $('#contenedor-errores-producto').html('');
                  $('#contenedor-agregados-producto').html('');
                  $('.span-duplicados').text('');
                  $('.span-agregados').text('');
                  $('.span-errores').text('');

               

            },
            error: function () {
                alert('failure');
            }
        });


}); 



function eliminartodoslosregitros(){
       //eliminamos todos los regitros mostrados
     $.ajax({
            type: "GET", //metodo
            url: "/productos/eliminartodoslosregitros",

            success: function (x) {

            },
            error: function () {
                alert('failure');
            }
        });
}




function bolveralistar(){

  $.ajax({
        url:'/productos/listarproductos',
        dataType: 'json',
        success: function(n){

          tabla_n = $('#list_p_').DataTable({
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

                  "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
                  "sInfoFiltered": " - filtrados de _MAX_ registros", 
                  "sInfoEmpty": "No hay resultados de búsqueda", 
                  "sZeroRecords": "No hay registros a mostrar", 
                  "sProcessing": "Espere, por favor...", 
                  "sSearch": "Buscar:", 

               },

               fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).attr('id', "fila_"+n[i].id);
                               
                },

                'iDisplayLength': 50,

                "aaSorting": [[ 0, "asc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < n.length; i++) {
                             tabla_n.fnAddData([
                                        '<span class="hidden">'+n[i].created_at+'</span>'+n[i].clave,
                                        n[i].nombre,
                                        '<span title="Ver foto del producto" class="pro-foto" id="'+n[i].foto+'" data-id="'+n[i].nombre+'">Ver Foto</span>',
                                        n[i].color,
                                        n[i].descripcion,
                                        n[i].categoria,
                                        '<span class="estatus_'+n[i].estatus+'"></span>',
                                        '<span title="Editar producto" class="editar-n btn btn-info" value="'+n[i].id+'"><span class="glyphicon glyphicon-edit"></span></span>'
                                        
                                      ]);


                              }

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

                        $('.estatus_0').text('Inactivo');
                        $('.estatus_0').addClass('text-danger');
                        $('.estatus_1').text('Activo');
                        $('.estatus_1').addClass('text-success');

                        llamarpaginaciondatatable();



        },
        error: function(){
          alert('failure');
        }
    });


}

     $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');
        $('.estatus_0').text('Inactivo');
        $('.estatus_0').addClass('text-danger');
        $('.estatus_1').text('Activo');
        $('.estatus_1').addClass('text-success');
      });        


      $(document).on('keyup', '#list_p__filter', function(){
            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');

      });

      $(document).on('click', '#list_p__length', function(){
            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');
      });

//-----------VALIDACIONES
    //Validaciones para las categorias
$("#save-producto").click(function () {

      if($("#clave-producto").val().length  == 0){
              $('.error-clave').addClass('has-error has-feedback');
                     $('.icon-clave').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto").click(function () {

      if($("#articulo").val().length  == 0){
              $('.error-articulo').addClass('has-error has-feedback');
                     $('.icon-articulo').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto").click(function () {

      if($("#nombre").val().length  == 0){
              $('.error-nombre').addClass('has-error has-feedback');
                     $('.icon-nombre').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#ean-code").val().length  == 0){
              $('.error-ean-code').addClass('has-error has-feedback');
                     $('.icon-ean-code').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#color").val().length  == 0){
              $('.error-color').addClass('has-error has-feedback');
                     $('.icon-color').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#n-color").val().length  == 0){
              $('.error-n-color').addClass('has-error has-feedback');
                     $('.icon-n-color').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#unidad").val() == 0){
               $('.error-unidad').addClass('has-error has-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#dimensiones").val().length  == 0){
              $('.error-dimensiones').addClass('has-error has-feedback');
              $('.icon-dimensiones').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#cantidad").val().length  == 0){
              $('.error-cantidad').addClass('has-error has-feedback');
                     $('.icon-cantidad').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto").click(function () {

      if($("#piezas").val().length  == 0){
              $('.error-piezas').addClass('has-error has-feedback');
                     $('.icon-piezas').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#pallet").val().length  == 0){
              $('.error-pallet').addClass('has-error has-feedback');
                     $('.icon-pallet').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#totalpiezas").val().length  == 0){
              $('.error-totalpiezas').addClass('has-error has-feedback');
                     $('.icon-totalpiezas').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#importador").val() == 0){
               $('.error-importador').addClass('has-error has-feedback');
               $('.icon-importador').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#almacen").val() == 0){
               $('.error-almacen').addClass('has-error has-feedback');
               $('.icon-almacen').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#familia").val() == 0){
               $('.error-familia').addClass('has-error has-feedback');
               $('.icon-familia').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto").click(function () {

      if($("#categoria").val() == 0){
               $('.error-categoria').addClass('has-error has-feedback');
               $('.icon-categoria').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto").click(function () {

      if($("#foto").val() == ''){
              $('.error-foto-label').addClass('error-add-image');
              $('#foto').addClass('error-add-image');
              return false;

      }  else {
          return true;
      }
});


//Focus--------------------------------------------------------------------------------------------------
$("#clave-producto").focus(function () {

        $('.error-clave').removeClass('has-error has-feedback');
        $('.icon-clave').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#articulo").focus(function () {

        $('.error-articulo').removeClass('has-error has-feedback');
        $('.icon-articulo').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#nombre").focus(function () {

          $('.error-nombre').removeClass('has-error has-feedback');
          $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#ean-code").focus(function () {

          $('.error-ean-code').removeClass('has-error has-feedback');
          $('.icon-ean-code').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#color").focus(function () {

            $('.error-color').removeClass('has-error has-feedback');
            $('.icon-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#n-color").focus(function () {

            $('.error-n-color').removeClass('has-error has-feedback');
            $('.icon-n-color').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#unidad").change(function () {

        $('.error-unidad').removeClass('has-error has-feedback');

});

$("#dimensiones").focus(function () {

              $('.error-dimensiones').removeClass('has-error has-feedback');
              $('.icon-dimensiones').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#cantidad").focus(function () {

            $('.error-cantidad').removeClass('has-error has-feedback');
            $('.icon-cantidad').removeClass('glyphicon glyphicon-remove form-control-feedback');
});


$("#piezas").focus(function () {

            $('.error-piezas').removeClass('has-error has-feedback');
            $('.icon-piezas').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#pallet").focus(function () {

              $('.error-pallet').removeClass('has-error has-feedback');
              $('.icon-pallet').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#totalpiezas").focus(function () {

            $('.error-totalpiezas').removeClass('has-error has-feedback');
            $('.icon-totalpiezas').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#importador").change(function () {

               $('.error-importador').removeClass('has-error has-feedback');
               $('.icon-importador').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#almacen").change(function () {

               $('.error-almacen').removeClass('has-error has-feedback');
               $('.icon-almacen').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#familia").change(function () {

               $('.error-familia').removeClass('has-error has-feedback');
               $('.icon-familia').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#categoria").change(function () {

               $('.error-categoria').removeClass('has-error has-feedback');
               $('.icon-categoria').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#foto").click(function () {

              $('.error-foto-label').removeClass('error-add-image');
              $('#foto').removeClass('error-add-image');

});



//VALIDACIONES AL AGREGAR LOS PRECIOS DE LOS PRODUCTOS ----------------------------------------
$("#save-precio-producto").click(function () {

      if($("#precio-producto").val().length  == 0){
              $('.error-precio-producto').addClass('has-error has-feedback');
              $('.icon-precio-producto').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-precio-producto").click(function () {

      if($("#tipo-precio").val() == -1){
              $('.error-tipo-precio').addClass('has-error has-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-precio-producto").click(function () {

      if($("#moneda").val() == 0){
              $('.error-moneda').addClass('has-error has-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-precio-producto").click(function () {

      if($("#fechainicio").val().length  == 0){
              $('.error-fechainicio').addClass('has-error has-feedback');
              $('.icon-fechainicio').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-precio-producto").click(function () {

      if($("#fechafin").val().length  == 0){
              $('.error-fechafin').addClass('has-error has-feedback');
              $('.icon-fechafin').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


//FOCUS-------------------------------------------------------------------------------------------
$("#precio-producto").focus(function () {

              $('.error-precio-producto').removeClass('has-error has-feedback');
              $('.icon-precio-producto').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#tipo-precio").change(function () {

              $('.error-tipo-precio').removeClass('has-error has-feedback');
});

$("#moneda").change(function () {

              $('.error-moneda').removeClass('has-error has-feedback');
});


$("#fechainicio").focus(function () {

              $('.error-fechainicio').removeClass('has-error has-feedback');
              $('.icon-fechainicio').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#fechafin").focus(function () {

              $('.error-fechafin').removeClass('has-error has-feedback');
              $('.icon-fechafin').removeClass('glyphicon glyphicon-remove form-control-feedback');

});



//-----------VALIDACIONES AL EDITAR
    //Validaciones para las categorias
$("#save-producto-edit").click(function () {

      if($("#clave-producto-edit").val().length  == 0){
              $('.error-clave-edit').addClass('has-error has-feedback');
                     $('.icon-clave-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto-edit").click(function () {

      if($("#articulo-edit").val().length  == 0){
              $('.error-articulo-edit').addClass('has-error has-feedback');
                     $('.icon-articulo-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto-edit").click(function () {

      if($("#nombre-edit").val().length  == 0){
              $('.error-nombre-edit').addClass('has-error has-feedback');
                     $('.icon-nombre-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#ean-code-edit").val().length  == 0){
              $('.error-ean-code-edit').addClass('has-error has-feedback');
                     $('.icon-ean-code-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#color-edit").val().length  == 0){
              $('.error-color-edit').addClass('has-error has-feedback');
                     $('.icon-color-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#n-color-edit").val().length  == 0){
              $('.error-n-color-edit').addClass('has-error has-feedback');
                     $('.icon-n-color-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto-edit").click(function () {

      if($("#dimensiones-edit").val().length  == 0){
              $('.error-dimensiones-edit').addClass('has-error has-feedback');
              $('.icon-dimensiones-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#cantidad-edit").val().length  == 0){
              $('.error-cantidad-edit').addClass('has-error has-feedback');
                     $('.icon-cantidad-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-producto-edit").click(function () {

      if($("#piezas-edit").val().length  == 0){
              $('.error-piezas-edit').addClass('has-error has-feedback');
                     $('.icon-piezas-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#pallet-edit").val().length  == 0){
              $('.error-pallet-edit').addClass('has-error has-feedback');
                     $('.icon-pallet-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-producto-edit").click(function () {

      if($("#totalpiezas-edit").val().length  == 0){
              $('.error-totalpiezas-edit').addClass('has-error has-feedback');
                     $('.icon-totalpiezas-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});




//Focus--------------------------------------------------------------------------------------------------
$("#clave-producto-edit").focus(function () {

        $('.error-clave-edit').removeClass('has-error has-feedback');
        $('.icon-clave-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#articulo-edit").focus(function () {

        $('.error-articulo-edit').removeClass('has-error has-feedback');
        $('.icon-articulo-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#nombre-edit").focus(function () {

          $('.error-nombre-edit').removeClass('has-error has-feedback');
          $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#ean-code-edit").focus(function () {

          $('.error-ean-code-edit').removeClass('has-error has-feedback');
          $('.icon-ean-code-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#color-edit").focus(function () {

            $('.error-color-edit').removeClass('has-error has-feedback');
            $('.icon-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#n-color-edit").focus(function () {

            $('.error-n-color-edit').removeClass('has-error has-feedback');
            $('.icon-n-color-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});



$("#dimensiones-edit").focus(function () {

              $('.error-dimensiones-edit').removeClass('has-error has-feedback');
              $('.icon-dimensiones-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#cantidad-edit").focus(function () {

            $('.error-cantidad-edit').removeClass('has-error has-feedback');
            $('.icon-cantidad-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');
});


$("#piezas-edit").focus(function () {

            $('.error-piezas-edit').removeClass('has-error has-feedback');
            $('.icon-piezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#pallet-edit").focus(function () {

              $('.error-pallet-edit').removeClass('has-error has-feedback');
              $('.icon-pallet-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');
});

$("#totalpiezas-edit").focus(function () {

            $('.error-totalpiezas-edit').removeClass('has-error has-feedback');
            $('.icon-totalpiezas-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');
});



//VALIDACIONES AL AGREGAR LOS PRECIOS DE LOS PRODUCTOS  AL EDITAR PRODUCTO----------------------------------------
$("#save-precio-producto-edit").click(function () {

      if($("#precio-producto-edit").val().length  == 0){
              $('.error-precio-producto-edit').addClass('has-error has-feedback');
              $('.icon-precio-producto-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


$("#save-precio-producto-edit").click(function () {

      if($("#fechainicio-edit").val().length  == 0){
              $('.error-fechainicio-edit').addClass('has-error has-feedback');
              $('.icon-fechainicio-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

$("#save-precio-producto-edit").click(function () {

      if($("#fechafin-edit").val().length  == 0){
              $('.error-fechafin-edit').addClass('has-error has-feedback');
              $('.icon-fechafin-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});


//FOCUS-------------------------------------------------------------------------------------------
$("#precio-producto-edit").focus(function () {

              $('.error-precio-producto-edit').removeClass('has-error has-feedback');
              $('.icon-precio-producto-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


$("#fechainicio-edit").focus(function () {

              $('.error-fechainicio-edit').removeClass('has-error has-feedback');
              $('.icon-fechainicio-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});

$("#fechafin-edit").focus(function () {

              $('.error-fechafin-edit').removeClass('has-error has-feedback');
              $('.icon-fechafin-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

});



//Funciones para los alerts
function alertas(tipo,mensaje){
    $('.top-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }

function llamarpaginaciondatatable(){
  $('.fancy a').addClass('cargarpaginacion');
}


  </script>

@stop
