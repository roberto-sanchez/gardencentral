@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
{{ HTML::style('css/calendario.css') }}
{{ HTML::script('js/calendario.js') }}
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
    <div class='notifications top-right'></div>
    <div class="contenedor_e">
      <div class="panel panel-default">

        <div class="panel-heading">Registro de entrada</div>
        <div class="panel-body panel-entrada">
          <form>
            <div class="form-add-entrada">
              <div class="inputE date form-group">
                 <label for="ejemplo_email_1">Fecha</label>
                 <input type="text" name="fecha" class="form-control" id="fecha">
              </div>
              <div class="inputE prov input-group infopago">
                <label>PROVEEDOR</label>
                 <select class="btn btn-default form-control" name="proveedor" id="idproveedor">
                 </select>
              </div>
              <div class="inputE fa form-group">
                 <label for="ejemplo_email_1">FACTURA</label>
                 <input type="text" class="form-control" id="factura">
              </div>
              <div class="inputE ffa form-group">
                 <label for="ejemplo_email_1">FECHA FACTURA</label>
                 <input type="text" name="fechaFactura" class="form-control" id="fechaFactura">
              </div>
            </div>
            <div class="obse-e">
              <label class=" text-info">OBSERVACIONES</label>
              <textarea id="obc" name="comentarios" id="coment" class="form-control" rows="2"></textarea>
            </div>
          </form>
        </div>
        <div class="panel-footer footer-entrada">
          {{ Form::open(['id'=>'searchE','method' => 'POST', 'class' => 'b-entrada input-group has-feedback']) }}

         {{ Form::text('input',null,array('class' => 'form-control', 'id' => 'clave','placeholder' => 'Clave del producto')) }}

              <button id="btn_search" type="submit" class="btn buscar input-group-addon">
                   Buscar
                   <span class="glyphicon glyphicon-search"></span>
             </button>

         {{ Form::close() }}
        </div>
    </div>

    <div id="productoPanel" class="panel">
        <div class="panel-heading">
          <h2 id="nombreProd" class="text-center text-info"></h2>
        </div>
        <div class="panel-body panel-producto">

              <img id="imagenProd" src="" alt="Imagen del producto" class="imagenproducto img-responsive img-circle" />

            <div class="datos">
               <h2 class="text-center text-primary txt-info">
                 Color: <span id="colorProd" class="text-info"></span>
                 <hr class="separador">
                 Precio: <span id="precioProd" class="text-info"></span>
                 <span class="claveProducto"></span>
                 <span class="productoId"></span>
                 <span class="precioHiden"></span>
               </h2>
             <!--  <buttom id="idProd" value="" class="btn btn-primary add-car">Añadir al carrito.</buttom> -->
            </div>

      </div>

      <div class="panel-footer footer-producto">
        <div id="agregarP" class="agregar-pedido input-group has-feedback">

           {{ Form::number('agregarproducto',null,array('class' => 'form-control', 'min' => '1', 'max' => '100', 'placeholder' => 'Cantidad', 'required', 'id' => 'prodE')) }}
          <span class="ingresar-p">
            <button id="addP" class="btn input-group-addon" title="Agregar">
              Agregar
               <span class="glyphicon glyphicon-plus"></span>
            </button>
          </span>
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
      <button class="btn btn-primary disabled" name="button" id="gE">Guardar entrada</button>
    </div>


  </div><!--  Secierra el contenedor-->

  </div>
</div>


{{ HTML::script('js/accounting.min.js') }}
  <script>
 selectp = $('#idproveedor');
  //Listar proveedores
  $.ajax({
      type: "POST",
      url: "/entradas/proveedores",
      success: function (prove) {
        idp = "";
                idp += '<option value="select" disabled selected>Seleccione</option>';
        for(datos in prove.proveedor){
                idp += '<option value="'+prove.proveedor[datos].id+'">'+prove.proveedor[datos].nombre+'</option>';
             }

             selectp.append(idp);


      },
      error: function (noexiste) {
          alert("failure");
      }
  });


$(document).ready(function(){

      $('#searchE').on('submit', function () {
          return false;
      });


      $('#btn_search').click(function () {
          if ($('#clave').val() == '' || $('#clave').val() == 'Clave del producto') {
          } else {
            $('#prodE').val('');
              $.ajax({
                  type: "POST",
                  url: "/entradas/buscar",
                  data: {clave: $('#clave').val()},
                  success: function (prod) {
                      ver = prod.id;
                      if (ver === undefined) {
                          $('#productoPanel').hide();


                          $('#noexiste').html(prod.indefinido);
                      } else {
                          $('#productoPanel').slideDown(1000);
                          $('.productoId').attr('id',prod.id);
                          $('.idProd').attr('id', 'product_' + prod.id);
                          $('.idProd2').attr('id', +prod.id);
                          $('.claveProducto').attr('id',prod.clave);
                          $('#nombreProd').html(prod.nombre);
                          $('#imagenProd').prop('src', '/img/productos/' + prod.foto); //la imagen
                          $('#colorProd').html(prod.color);
                          $('#precioProd').html(accounting.formatMoney(prod.precio_compra));
                          $('.precioHiden').attr('id', prod.precio_compra);
                      }

                  },
                  error: function (noexiste) {
                      alert("failure");
                  }
              });
          }

      });

    $(document).on('click','#addP', function(){
      $("#clave").val('');
      //$('#prodE').val('');
      cantidad =  $('#prodE').val();

      if(cantidad == ""){

      } else {
        idP = $('.productoId').attr('id');
        precio = $('.precioHiden').attr('id');
        clave = $('.claveProducto').attr('id');
         exixst = $('.clave_'+clave).attr('value');

         if(exixst == undefined){
           $('#productoPanel').hide();

           tablep = $('#nEntrada');
           $.ajax({
               type: "POST",
               url: "/entradas/addproducto",
               data: {clave: clave},
               success: function (addp) {
                 console.log(addp);
                 d = "";
                 if(addp.length){

                 } else {
                    $('#gE').removeClass('disabled');
                 }

                     for(datos in addp.resp){
                             d += '<tr class="clave_'+addp.resp[datos].clave+'" value="clave_'+addp.resp[datos].clave+'" id="fila_'+addp.resp[datos].id+'"><td>'+addp.resp[datos].clave+'</td>';
                             d += '<td class="idpro" value="'+addp.resp[datos].id+'">'+addp.resp[datos].nombre+'</td>';
                             d += '<td>'+addp.resp[datos].color+'</td>';
                             d += '<td class="p_c">'+accounting.formatMoney(addp.resp[datos].precio_compra)+'</td>';
                             d += '<td><div class="c-pa"><input id="v_'+addp.resp[datos].id+'" type="number" class="form-control cant" data-id="'+addp.resp[datos].precio_compra+'" value="'+cantidad+'"><button value="'+addp.resp[datos].id+'" class="btn btn-primary btn_'+addp.resp[datos].clave+'" data-id="'+cantidad+'" id="actC"><span class="glyphicon glyphicon-refresh"></span></button></div></td>';
                             d += '<td id="canti_'+addp.resp[datos].id+'">'+accounting.formatMoney(addp.resp[datos].precio_compra * cantidad)+'</td>';
                             d += '<td><button id="q-t" value="'+addp.resp[datos].id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></button></td>';
                          }

                          tablep.append(d);

               },
               error: function (noexiste) {
                   alert("failure");
               }
           });
         } else{
           sumar = $('#prodE').val();
           a = parseInt($('.btn_'+clave).attr('data-id'));
           console.log(a += parseInt(sumar));
           $('#productoPanel').hide();
           $('#v_'+idP).val(a);
           $('.btn_'+clave).attr('data-id',a);
           $('#canti_'+idP).text(accounting.formatMoney(precio * a));
         }


      }
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
    })

    //Validaciones para los campos del formularios
    $("#gE").click(function () {

    if($("#fecha").val().length == 0){
            $('.date').addClass('has-error');
            return false;

    } else if($('#idproveedor').val() == 0){
            $('.prov').addClass('has-error');
            return false;

    } else if($("#factura").val().length == 0){
            $('.fa').addClass('has-error');
            return false;

    } else if($("#fechaFactura").val().length == 0){
            $('.ffa').addClass('has-error');
            return false;

    } else {
        return true;
    }
});


    $(document).on('click', '#gE', function(){
      fecha = $('#fecha').val();
      proveedor = $('#idproveedor').val();
      factura = $('#factura').val();
      fechaFactura =    $('#fechaFactura').val();
      obc = $('#obc').val();


      var DATA = [];

        $('.t-p-entrada tbody tr').each(function(){
            idp = $(this).find("td[class*='idpro']").attr('value');
            cant  = $(this).find("input[class*='cant']").val();
            pc  = $(this).find("td[class*='p_c']").text();

            item = {idp, cant, pc};

            DATA.push(item);
        })

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        $.ajax({
            type: "POST", //metodo
            url: "/entradas/registrarentrada",
            data: {aInfo: aInfo, fecha: fecha, proveedor: proveedor, factura: factura, fechaFactura: fechaFactura, obc: obc },
            success: function (e) {
                console.log(e);
                noexiste = [[ 'top-right', 'success',  "Entrada guardada correctamente." ]];
                message = noexiste[Math.floor(Math.random() * noexiste.length)];
                $("#nEntrada").load(location.href+" #nEntrada>*","");                 
                $("#fecha").val('');
                $('#idproveedor').prop('selectedIndex',0);
                $("#factura").val('');
                $("#fechaFactura").val('');
                $("#obc").val('');
                $('.' + message[0]).notify({
                    message: { text: message[2] },
                    type: message[1]
                }).show();


            },
            error: function () {
                alert('failure');

            }
        });

    });



});



  </script>

@stop
