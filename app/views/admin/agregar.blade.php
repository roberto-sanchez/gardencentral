@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
{{ HTML::style('css/bootstrap-select.min.css') }}
{{ HTML::style('css/bootstrap-datepicker.min.css') }}
{{ HTML::script('js/bootstrap-filestyle.min.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
{{ HTML::script('js/i18n/defaults-es_CL.min.js') }}
{{ HTML::script('js/bootstrap-datepicker.min.js') }}
<script>
  $(document).ready(function(){
    $('.addentrada').addClass('active');
    $('.t-addentrada').addClass('en-admin');

    $("#fecha").datepicker({
				changeMonth:true,
				changeYear:true,
			});

      $("#fechaFactura").datepicker({
          changeMonth:true,
          changeYear:true,
        });


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
  <!--<a href="{{ URL::to('consultas/listp') }}">Ver Listado</a>-->
  <div class="row">
    <div class="contenedor_e">
      <div class="panel panel-default">

        <div class="panel-heading">Registro de entrada</div>
        <div class="panel-body panel-entrada">
          <form enctype="multipart/form-data" class="formulario">
            <div class="form-add-entrada">
              <div class="inputE date form-group">
                 <label for="ejemplo_email_1">Fecha</label>
                 <input type="text" name="fecha" class="form-control fecha">
              </div>
              <div class="inputE prov input-group infopago">
                <label>PROVEEDOR</label>
                 <select class="selectpicker form-control" name="proveedor" id="idproveedor" data-live-search="true" data-size="5">
                 @foreach($proveedor as $prov)
                  <option value="{{ $prov->id }}" data-tokens="{{ $prov->nombre }}">{{ $prov->nombre }}</option>
                 @endforeach
                 </select>
              </div>
              <div class="inputE fa form-group">
                 <label for="ejemplo_email_1">FACTURA</label>
                 <input type="text" class="form-control" name="factura" id="factura">
              </div>
              <div class="inputE ffa form-group">
                 <label for="ejemplo_email_1">FECHA FACTURA</label>
                 
                 <input type="text" name="fechaFactura" class="form-control fechaFactura">
              </div>
            </div>
              <div class="form-add-s">
                  <div class="inputP npe form-group">
                   <label for="numero_p">Numero de pedimento</label>
                   <input type="text" name="numeroPedimento" class="form-control" id="numeroPedimento">
                </div>
                <div class="obse-e">
                  <label class=" text-info">OBSERVACIONES</label>
                  <textarea id="obc" name="obc" id="coment" class="form-control" rows="2"></textarea>
                </div>
              </div>
        </div>
        <div class="panel-footer footer-entrada">
            <div id="browse-p">
              <label class="txt-browse text-primary">Cargar archivo de productos</label>
              <input type="file" class="filestyle" data-buttonText="Buscar" data-buttonBefore="true" data-placeholder="Ningún archivo seleccionado" name="archivo_file" id="enviar_file">
            </div>
            <div>
          </form>
              <button id="add-p" class="btn btn-default">Agregar productos</button>
            </div>
        </div>
    </div>

    <table class="t-p-entrada">
      <div class="headP">Productos</div>
      <thead>
        <tr>
          <th>Clave</th>
          <th>Producto</th>
          <th>Color</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total producto</th>
          <th>Quitar</th>
        </tr>
      </thead>
      <tbody id="nEntrada"></tbody>
    </table>
    <div class="AgregarE">
      <button class="btn btn-danger" name="button" id="Li">Limpiar</button>
      <button class="btn btn-primary enviar_e disabled" name="button" id="gE">Guardar entrada</button>
    </div>


  </div><!--  Secierra el contenedor-->


  </div>
</div>

<!--    Modal para confirmar guardar entrada   -->
<div id="guardarentrada" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Guardar Entrada
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas guardar esta entrada?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span class="btn btn-primary confirm guardarentrada" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>

<!--Modal para agregar productos-->
  <div id="agregar-p" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog modal-products">
        <div class="modal-content content-products">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
              Agregar productos
            </h4>
          </div>
          <div class="modal-body body-totales-i">
            <h2 id="nombre-i" class="text-info text-center"></h2>

            <div class="totales-p">
              <table class="t-products">
                <tbody id="cont-products"></tbody>
              </table>
            </div>
                
          </div>
          <div class="modal-footer foot-env">

              <button id="c-env" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
               <span id="env-pro" class="btn btn-primary" data-dismiss="modal" >Enviar</span>
          </div>
        </div>
      </div>
    </div>

{{ HTML::script('js/accounting.min.js') }}
  <script>

$(document).ready(function(){


      $('.fecha').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true
        });

      $('.fechaFactura').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true
        });

      $(document).on('click', '#add-p', function(){
        $('#agregar-p').modal({
          show:'false',
        });
        caja = $('#cont-products');
            $.ajax({
                  type: "POST",
                  url: "/entradas/listproducto",
                  data: {clave: $('#clave').val()},
                  success: function (p) {
                    console.log(p);
                    div = "";
                    for(datos in p.producto){

                      div += ' <tr>'+
                        '<td class="text-info txt-n-pro">'+p.producto[datos].clave+'</td>'+
                        '<td class="text-info txt-n-id">'+p.producto[datos].id+'</td>'+
                        '<td class="txt-nom">'+p.producto[datos].nombre+'</td>'+
                        '<td class="txt-col">'+p.producto[datos].color+'</td>'+
                        '<td class="txt-pre">'+p.producto[datos].precio+'</td>'+
                        '<td><div class="c-paxs c-cant">'+
                           '<span class="btn btn-success btn-total">'+p.producto[datos].cantidad+'</span>'+
                          '<input id="cant-pro" type="number" class="form-control cant-p" value="0">'+
                        '</div></td>'+
                       '</tr>';

                         }

                    caja.append(div); 
                  },
                  error: function () {
                      alert("failure");
                  }
              });     

      });


      $(document).on('click', '#c-env', function(){

        $("#cont-products").load(location.href+" #cont-products>*","");

      });


      $(document).on('click', '#env-pro', function(){

        $("#cont-products").load(location.href+" #cont-products>*","");

         var DATA = [];

        $('.t-products tbody tr').each(function(){
            clavepro = $(this).find("td[class*='txt-n-pro']").text();
            id = $(this).find("td[class*='txt-n-id']").text();
            pro = $(this).find("td[class*='txt-nom']").text();
            color = $(this).find("td[class*='txt-col']").text();
            precio = $(this).find("td[class*='txt-pre']").text();
            cant = $(this).find("input[class*='cant-p']").val();

            item = {clavepro, pro, color, precio};

            DATA.push(item);

            if(cant <= 0){

            } else{

              tablep = $('#nEntrada');
              d= "";

               d += '<tr class="clave_'+clavepro+'" value="clave_'+clavepro+'" id="fila_'+id+'"><td class="clavepro" >'+clavepro+'</td>';
               d += '<td class="idpro" value="'+id+'">'+pro+'</td>';
               d += '<td>'+color+'</td>';
               d += '<td class="p_c">'+accounting.formatMoney(precio)+'</td>';
               d += '<td><div class="c-pa"><input id="v_'+id+'" type="number" class="form-control cant" data-id="'+precio+'" value="'+cant+'"><button value="'+id+'" class="btn btn-primary btn_'+clavepro+'" data-id="'+cant+'" id="actC"><span class="glyphicon glyphicon-refresh"></span></button></div></td>';
               d += '<td id="canti_'+id+'">'+accounting.formatMoney(precio * cant)+'</td>';
               d += '<td><button id="q-t" value="'+id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></button></td>';
                        

              tablep.append(d);

              //Limpiamos el buscador de textos
              $('#browse-p input[type=text]').val('');
            }

            $('#gE').removeClass('disabled');


        })

      });



    //Actualizar cantidad
    $(document).on('click', '#actC', function(){
      valor = $(this).val();
      c = $('#v_'+valor).val();
      p = $('#v_'+valor).attr('data-id');
      $('#canti_'+valor).text(accounting.formatMoney(p * c));

    });

    //Eliminar producto
    $(document).on('click', '#q-t', function(){
      id = $(this).val();
      $('#fila_'+id).remove();
    });

    //Limpiar pedido
    $(document).on('click', '#Li', function(){
      $("#nEntrada").load(location.href+" #nEntrada>*","");
    });


    //Validaciones para los campos del formularios
    $("#gE").click(function () {

    if($(".fecha").val().length == 0){
            $('.date').addClass('has-error');
            return false;

    } else if($('#idproveedor').val() == 0){
            $('.prov').addClass('has-error');
            return false;

    } else if($("#factura").val().length == 0){
            $('.fa').addClass('has-error');
            return false;

    } else if($(".fechaFactura").val().length == 0){
            $('.ffa').addClass('has-error');
            return false;

    } else {
        return true;
    }
});

    $("#enviar_f").click(function () {

    if($(".fecha").val().length == 0){
            $('.date').addClass('has-error');
            return false;

    } else if($('#idproveedor').val() == 0){
            $('.prov').addClass('has-error');
            return false;

    } else if($("#factura").val().length == 0){
            $('.fa').addClass('has-error');
            return false;

    } else if($(".fechaFactura").val().length == 0){
            $('.ffa').addClass('has-error');
            return false;

    }  else {
        return true;
    }
});

    $(document).on('click', '#gE', function(){
      $('.guardarentrada').attr('id', 'guardar-entrada');
      $('#guardarentrada').modal({
        show: 'false',
      });
    });

    $(document).on('click', '#guardar-entrada', function(){
      fecha = $('.fecha').val();
      proveedor = $('#idproveedor').val();
      factura = $('#factura').val();
      fechaFactura = $('.fechaFactura').val();
      numeroPedimento = $('#numeroPedimento').val();
      obc = $('#obc').val();
      tipo = 1;

      var DATA = [];

        $('.t-p-entrada tbody tr').each(function(){
            clavepro = $(this).find("td[class*='clavepro']").text();
            idp = $(this).find("td[class*='idpro']").attr('value');
            cant  = $(this).find("input[class*='cant']").val();
            pc  = $(this).find("td[class*='p_c']").text();
            item = {clavepro, idp, cant, pc};

            DATA.push(item);

        })

        aInfo   = JSON.stringify(DATA);

        $.ajax({
            type: "POST", //metodo
            url: "/entradas/registrarentrada",
            data: {aInfo: aInfo, fecha: fecha, proveedor: proveedor, factura: factura, fechaFactura: fechaFactura, numeroPedimento: numeroPedimento, obc: obc, tipo: tipo },
            success: function (e) {
                console.log(e);
                alertas('success',"Entrada guardada correctamente.");
                $("#nEntrada").load(location.href+" #nEntrada>*","");                 
                $(".fecha").val('');
                $('#idproveedor').prop('selectedIndex',0);
                $("#factura").val('');
                $(".fechaFactura").val('');
                $('#numeroPedimento').val('');
                $("#obc").val('');
                $('#browse-p input[type=text]').val('');


            },
            error: function () {
                alert('failure');

            }
        }); 

    });  


    $(document).on('click', '#enviar_file', function(){ 
      $('.enviar_e').attr('id', 'enviar_f');
      $('.enviar_e').addClass('enviar_f');
      $('.enviar_e').removeClass('disabled');
      $("#nEntrada").load(location.href+" #nEntrada>*","");
      $('#productoPanel').hide();
      $("#clave").val('');
    });

    $(document).on('click', '#enviar_f', function(){
        $('.guardarentrada').attr('id', 'registrar-entrada');
        $('#guardarentrada').modal({
          show: 'false',
        });
    });

   
     $(document).on('click', '#registrar-entrada', function(){
          
        //información del formulario
         formData = new FormData($(".formulario")[0]);

        //hacemos la petición ajax
       $.ajax({
            url: '/entradas/registrarentrada',
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
            success: function(data){
                console.log(data);
                if(data == 'indefinido'){
                    alertas('error',"Error, el archivo introducido no es válido.");
                } else {

                  if(data == 'error'){
                      alertas('error',"Error, la clave está vacía o no existe.");
                  } else {

                  alertas('success',"Entrada guardada correctamente.");
                  $("#nEntrada").load(location.href+" #nEntrada>*","");                 
                  $(".fecha").val('');
                  $('#idproveedor').prop('selectedIndex',0);
                  $("#factura").val('');
                  $(".fechaFactura").val('');
                  $('#numeroPedimento').val('');
                  $("#obc").val('');
                  $('#browse-p input[type=text]').val('');

                  }

                }
            },

            error: function(){
                alert('failure');
            }
        });
    });


});


//Funciones para los alerts
function alertas(tipo,mensaje){
    $('.top-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }



  </script>

@stop
