@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('lib/bootstrap-notify/bootstrap-notify.css') }}
{{ HTML::style('css/bootstrap-select.min.css') }}
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
<script>
  $(document).ready(function(){
    $('.admin').addClass('active');
    $('.t-admin').addClass('en-admin');
    $('.dash').attr('id','');
  });
</script>
<style>

  .alerts-msjs{
    display:block;
  
  }


      .barrat div{
            font-size: 10px;
            background:#31708f;
            text-align:right;
            padding:3px;
            margin:1px;
            color:white;
          }

      svg {
          
      }

      text {
          font-family: helvetica;
          font-size: 14px;
          text-anchor: middle;
          fill:white;
      }

      .arc path {
        stroke: #fff;
      }

      .dialog-ped{
        width:70%;
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


      .totales-p-d{
        padding:1em;
        max-height:515px;
        overflow-y: scroll;
      }

      #cerrar-pe-de{
        width: 100px;
      }


</style>
@stop

@section('pedidos_user') @stop


@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row row-dashboard">

    <div class="cont-sidebar">
    
    <input type="text" id="fecha_dia" value="{{ date('Y-m-d') }}" class="hidden">
    <input type="text" id="fecha_mes" value="{{ date('Y-m') }}" class="hidden">
    <input type="text" id="fecha_anio" value="{{ date('Y') }}" class="hidden">

      <div class="content-pedidos">

        <div class="contenedor-selects">
          <div class="select-general">
            <select class="selectpicker form-control" name="select-totales" id="select-totales">
                <option value="1">Pedidos del día</option>
                <option value="2">Pedidos del mes</option>
                <option value="3">Pedidos por año</option>
                <option value="4">Pedidos por periodo</option>
            </select>
          </div>
          <div class="select-dia">
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' class="form-control" id='select-dia'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="select-mes">
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' class="form-control" id='select-mes'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="select-an">
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' class="form-control" id='select-an'>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
          </div>
          <div class="select-periodo">
            <div class="form-group div-inicio">
                <div class='input-group date' id='fechainicio'>
                    <input type='text' class="form-control entrega" id='fecha-inicio' >
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group div-fin">
                <div class='input-group date' id='fechafin'>
                    <input type='text' class="form-control entrega" id='fecha-fin' >
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>
        </div>

       <!--<select class="selectpicker form-control" name="proveedor" id="idproveedor" data-live-search="true" data-size="5">
       <option value="0" selected>-- Seleccione --</option>
        <option class="tienda" value="tienda">Recoger en tienda</option>
          <option value="domicilio">Enviar a domicilio</option>
       </select>-->

          <h2 class="txt-est-p text-primary">Estatus de los pedidos</h2>
        <div class="caja-p-t">
          <div class="caja-p">
              <h2 class="txt-total">Total de pedidos.</h2>
              <div class="caja-contenedor">
                <div class="cantidad-p cantidad-total">
                  <p id="total-p" class="pull-right text-error strong"></p>
                </div>
                <div class="text-p">
                  <p class="text-success txt-dinero txt-dinero-total"></p>
                  <a value="5" data-text="Total de pedidos" data-select="99" class="v_detalle" href="#">Ver detalle</a>
                </div>
              </div>
          </div>


          <div class="caja-p">
            <h2 class="txt-pagados">Pedidos pagados.</h2>
            <div class="caja-contenedor">
              <div class="cantidad-p cantidad-pagados">
                <p id="total-pagados" class="pull-right text-success strong"></p>
              </div>
              <div class="text-p">
                <p class="text-success txt-dinero txt-dinero-pagados"></p>
                <a value="2" data-text="Pedidos pagados" data-select="99" class="v_detalle" href="#">Ver detalle</a>
              </div>
            </div>
          </div>
  
        <div class="caja-p">
          <h2 class="txt-credito">Pedidos a crédito.</h2>
          <div class="caja-contenedor">
            <div class="cantidad-p cantidad-credito">
              <p id="total-proceso" class="pull-right text-primary strong"></p>
            </div>
            <div class="text-p">
              <p class="text-success txt-dinero txt-dinero-credito"></p>
              <a value="1" data-text="Pedidos a crédito" data-select="99" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>
        </div>

        </div>

        <div class="caja-p-e">

        <div class="caja-p">
          <h2 class="txt-pendientes">Pedidos pendientes.</h2>
          <div class="caja-contenedor">
            <div class="cantidad-p cantidad-pendientes">
              <p id="total-pendientes" class="pull-right text-warning strong"></p>
            </div>
            <div class="text-p">
              <p class="text-success txt-dinero txt-dinero-pendientes"></p>
              <a value="0" data-text="Pedidos pendientes" data-select="99" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>
        </div>

        <div class="caja-p">
          <h2 class="txt-cancelados">Pedidos cancelados.</h2>
          <div class="caja-contenedor">
            <div class="cantidad-p cantidad-cancelados">
              <p id="total-cancelados" class="pull-right text-danger strong"></p>
            </div>
            <div class="text-p">
              <p class="text-success txt-dinero txt-dinero-cancelados"></p>
              <a value="3" data-text="Pedidos cancelados" data-select="99" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>
        </div>
        <div class="caja-p caja-p-oculto">
          <h2 class="txt-cancelados"></h2>
          <div class="caja-contenedor">
            <div class="cantidad-p cantidad-cancelados">
              <p  class="pull-right text-danger strong"></p>
            </div>
            <div class="text-p">
            </div>
          </div>
        </div>
        </div>
      </div><!-- end content-pedidos -->
      
        <div class="sidebar caja-s-g">
            <div class="graficaBarras"></div>
            <div class="datos-g">
              <h3><span class="color color-d"></span>Del día</h3>
              <h3><span class="color color-pa"></span>Pagados</h3>
              <h3><span class="color color-c"></span>Crédito</h3>
              <h3><span class="color color-pe"></span>Pendientes</h3>
              <h3><span class="color color-ca"></span>Cancelados</h3>
            </div>
        </div>

      </div><!-- ENd cont-sidebar  -->

    <div class="seccion-inv">

        <div class="cont-text-i">
          <h2 class="text-primary">Inventario</h2>
          <ul class="nav nav-tabs">
              <li class="in-t active"><a id="i-total">Total</a></li>
              <li class="in-mas"><a id="i-mas">Productos con más inventario</a></li>
              <li class="in-menos"><a id="i-menos">Productos con menos inventario</a></li>
          </ul>
        </div>
          <div class="totales-inv"></div>
          <div class="inv-mas"></div>
          <div class="inv-menos"></div>


    </div><!-- End seccion-inv-->

  </div><!-- End row -->



</div>


</div>

<!--  Modal alertas de productos -->
<div id="m-alerts" data-backdrop="" class="modal modal-transparent fade" >
      <div class="modal-dialog">
        <div class="modal-content content-alerts">
          <div class="modal-body body-alerts">
              
          <div class="caja-alerts">
            <div class="pico">
              <img src="img/triangulo.png" >
            </div>
            <button class="btn-c btn btn-default">Cerrar</button>
            <h3 class="n-a"></h3>
            <div class="content-msjs">
              
            </div>
          </div>
                
          </div>
          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>

<!--  Modal para ver el detalle del producto del inventario -->
<div id="verdetalle_i" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content content-inventario">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 id="clave-i" class="modal-title text-info text-center"></h4>
          </div>
          <div class="modal-body body-totales-i">
            <h2 id="nombre-i" class="text-info text-center"></h2>

            <div class="totales-p"></div>
                
          </div>
          <div class="modal-footer modal-conf-estat">
              <button id="cerrar-m" type="button" class="btn btn-primary confirm" data-dismiss="modal">
                <span class="glyphicon glyphicon-chevron-left"></span>
              Cerrar
              </button>
          </div>
        </div>
      </div>
    </div>

<!--  Modal para el detalle de los totales de los pedidos-->
<div id="totalesmodal" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog dialog-ped">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 id="to-ped" class="modal-title text-info text-center"></h4>
          </div>
          <div class="modal-body">
            <div class="messages"></div>
            <div class="totales-p-d">
              <div class="totalespedidos">
              <table id="list_p_" class="table">
                <thead>
                  <tr>
                    <th>N° Pedido</th>
                    <th>Fecha de registro</th>
                    <th>Cliente</th>
                    <th>Total pedido</th>
                    <th>Agente</th>
                    <th>Extra</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
                
          </div>
          <div class="modal-footer modal-conf-estat">
              <button id="cerrar-pe-de" type="button" class="btn btn-primary confirm" data-dismiss="modal">
                <span class="glyphicon glyphicon-chevron-left"></span>
              Cerrar
              </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para confirmar asignar oh cambiar agente -->
    <div id="asig_n_a" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Asignar agente
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas asignarle este agente?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="no-asig" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="asig-agente" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


{{ HTML::script('js/accounting.min.js') }}
{{ HTML::script('js/select2.min.js') }}
<script>

$(document).ready(function(){
  cargarDatos();
  barras();
});


//Barra de los totales
function barras() {
  d3.json('pedidos/verbarras', function(err, data) {
        datos = data;
        for(i = 0; i < datos; i++){
 
        }
    
    var t_p = [i];  

        var x = d3.scale.linear() 
          .domain([0, d3.max(t_p)]) 
          .range([0, 200])


      d3.select('.barrat') 
        .selectAll('div')  
        .data(t_p)  
        .enter().append('div') 
        .style('width', function(a){ 
          return x(a) + 'px' 
        })

        .text(function(d){ 
          return d; 
        })


    });
}


 



//Grafica
var datos = [];

function cargarDatos() {
    //d3.json('js/datos.json', function(err, data) {
  d3.json('pedidos/vergrafica', function(err, data) {
        datos = data;
        graficar();
    });
}

function graficar() {
    var width = 300;
    var height = 300;

    var radius = Math.min(width, height) / 2;

    var color = d3.scale.ordinal()
        .range(["#31708f", "#3c763d", "#337ab7", "#FE9A2E", "red"]);

    var arc = d3.svg.arc()
        .outerRadius(radius - 10)
        .innerRadius(60);

    var pie = d3.layout.pie()
        .value(function(d) {
            return d.numero;
        });

    var svg = d3.select(".graficaBarras").append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
        

   var g = svg.selectAll(".arc")
        .data(pie(datos))
        .enter().append("g")
        .attr("class", "arc");

  g.append("path")
        .attr("d", arc)
        .style("fill", function(d) {
            return color(d.data.estatus);
        });

     g.append("text")
        .text(function(d) {
            return d.data.numero /*+ " (" + d.data.numero + ")"*/;
        })
        .attr("transform", function(d) {
            return "translate(" + arc.centroid(d) + "), rotate(" + angle(d) + ")";
        }) 

    function angle(d) {
        var a = (d.startAngle + d.endAngle) * 90 / Math.PI - 90;
        return a > 90 ? a - 180 : a;
    } 
}




//Alertas de productos con cantidad minima
  alerta_p = $('.content-msjs');

  $.ajax({
    type: "GET",
    url: "/pedidos/alertaproducto",
    success: function (a) {
      $('.num-a').text(a.t_alerts);
      if(a.t_alerts == 0){

        $('.n-a').text('No hay alertas');
        $('.content-msjs').hide();

      } else {

        $('.n-a').text('Nuevas alertas');

      }

      div = "";
      for(datos in a.alert){

              div += '<div class="c-msjs" id="div_'+a.alert[datos].id+'">'+
                '<div class="msj-icon">'+
                  '<span class="glyphicon glyphicon-envelope"></span>'+
                '</div>'+
                '<div class="txt-msj">'+
                  '<p>'+a.alert[datos].nombre+'<span class="text-info"> Stock actual: '+a.alert[datos].cantidad+'</span></p>'+
                  '<div class="txt-d">'+
                    '<small>'+a.alert[datos].created_at+'</small>'+
                    '<span class="borrar-alert" value="'+a.alert[datos].id+'">Borrar</span>'+
                  '</div>'+
                '</div>'+
              '</div>';
           }

          alerta_p.append(div); 

  },

  error: function () {
      alert("failure");
  }
  });


  $(document).on('click', '.borrar-alert', function(){
    id = $(this).attr('value');
  $.ajax({
    type: "GET",
    url: "/pedidos/borraralerta",
    data:{id: id},
    success: function (e) {
    $('#div_'+id).remove();

  },

  error: function () {
      alert("failure");
  }
  });
});
  
  

  $(document).on('click', '.m-alert', function(){
    $('#m-alerts').modal({
      show:'false',

    });
  });

  $(document).on('click', '.btn-c', function(){

    $('#m-alerts').modal('hide');


  });




  $('.inv-mas').hide();
  $('.inv-menos').hide();

  $(document).on('click','#i-mas', function(){
    $('.in-t').removeClass('active');
    $('.in-menos').removeClass('active');
    $('.in-mas').addClass('active');
    $('.totales-inv').hide();
    $('.inv-menos').hide();
    $('.inv-mas').fadeIn(500);
  });
  $(document).on('click','#i-menos', function(){
    $('.in-t').removeClass('active');
    $('.in-mas').removeClass('active');
    $('.in-menos').addClass('active');
    $('.totales-inv').hide();
    $('.inv-menos').fadeIn(500);
    $('.inv-mas').hide();
  });
  $(document).on('click','#i-total', function(){
    $('.in-t').addClass('active');
    $('.in-mas').removeClass('active');
    $('.in-menos').removeClass('active');
    $('.totales-inv').fadeIn(500);
    $('.inv-menos').hide();
    $('.inv-mas').hide();
  });

    x = 99;
    //numero de pedidos y dinero
    $.ajax({
        type: "POST",
        url: "/pedidos/vertotalespedidos",
        data:{x: x},
        success: function (d) {

            div = "", divMas = "", divMenos = "";
            $('#total-p').text(d.p);
            $('#total-dia').text(d.p_date);
            $('#total-pagados').text(d.p_pagados);
            $('#total-proceso').text(d.p_proceso);
            $('#total-pendientes').text(d.p_pendientes);
            $('#total-cancelados').text(d.p_cancelados);

            $('.txt-dinero-total').text(accounting.formatMoney(d.total_general));
            $('.txt-dinero-pagados').text(accounting.formatMoney(d.total_pagados));
            $('.txt-dinero-credito').text(accounting.formatMoney(d.total_credito));
            $('.txt-dinero-pendientes').text(accounting.formatMoney(d.total_pendientes));
            $('.txt-dinero-cancelados').text(accounting.formatMoney(d.total_cancelados));

            $('.v_detalle').attr('data-fecha', d.fecha);

            llamarfechas();
      },

      error: function () {
          alert("failure");
      }
      });


  $(function () {
        $('#select-dia').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: moment()
        });
    });

    $(function () {
        $('#select-mes').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM',
            defaultDate: moment()
        });
    });

      $(function () {
        $('#select-an').datetimepicker({
            viewMode: 'years',
            format: 'YYYY',
            defaultDate: moment()
        });
    });


  $(function () {
    $('#fecha-inicio').datetimepicker({
        format: 'YYYY-MM-DD'
    });
  });


  $(function () {
    $('#fecha-fin').datetimepicker({
         format: 'YYYY-MM-DD'
    });
  });



  function llamarfechas(){
  $("#select-dia").on("dp.change", function (e) {
    fecha = $(this).val();
    inicio = 0;
    mostrarpedidosporfecha(fecha, inicio);
  });


    $("#select-mes").on("dp.change", function (e) {
      fecha = $(this).val();
      inicio = 1;
      mostrarpedidosporfecha(fecha, inicio);
    });

    $("#select-an").on("dp.change", function (e) {
      fecha = $(this).val();
      inicio = 2;
      mostrarpedidosporfecha(fecha, inicio);
    });

    $("#fecha-inicio").on("dp.change", function (e) {
      fecha_inicio = $(this).val();
      inicio = 3;
      //mostrarpedidosporfecha(fecha, inicio);
      if($("#fecha-fin").val() == ''){

      } else {
        fecha_fin = $("#fecha-fin").val();
        mostrarpedidosporperiodo(fecha_inicio, fecha_fin, inicio);
      }

         
    });

    $("#fecha-fin").on("dp.change", function (e) {
      //alert($("#fecha-inicio").val());
      fecha_fin = $(this).val();
      inicio = 3;
      //mostrarpedidosporfecha(fecha, inicio);
      if($("#fecha-inicio").val() == ''){

      } else {
        fecha_inicio = $("#fecha-inicio").val();
        mostrarpedidosporperiodo(fecha_inicio, fecha_fin, inicio);
      }
         
    });
    
  } //end function




$(document).on('change', '#select-totales', function(){

  id = $(this).val();

  if(id == 1){
    $('.select-dia').show();
    $('.select-mes').hide();
    $('.select-an').hide();
    $('.div-inicio').hide();
    $('.div-fin').hide();
    fecha = $('#fecha_dia').val();
    $("#select-dia").val(fecha);
    inicio = 0;
    mostrarpedidosporfecha(fecha, inicio);

  } else if(id == 2){
    $('.select-dia').hide();
    $('.select-mes').show();
    $('.select-an').hide();
    $('.div-inicio').hide();
    $('.div-fin').hide();
    fecha = $('#fecha_mes').val();
    $("#select-mes").val(fecha);
    inicio = 1;
    mostrarpedidosporfecha(fecha, inicio);


  } else if(id == 3){
    $('.select-dia').hide();
    $('.select-mes').hide();
    $('.select-an').show();
    $('.div-inicio').hide();
    $('.div-fin').hide();
    fecha = $('#fecha_anio').val();
    $("#select-an").val(fecha);
    inicio = 2;
    mostrarpedidosporfecha(fecha, inicio);

  } else if(id == 4){
    $('.select-dia').hide();
    $('.select-mes').hide();
    $('.select-an').hide();
    $('.div-inicio').show();
    $('.div-fin').show();
  }

});

function mostrarpedidosporfecha(fecha, inicio){


  if(fecha.length > 12){

  } else {

    //numero de pedidos y dinero
    $.ajax({
        type: "POST",
        url: "/pedidos/vertotalespedidos",
        data:{fecha: fecha, inicio: inicio},
        success: function (d) {

          if(d == 'Vacio'){
            alertas('error',"La fecha elegida aun no llega.");
          } else {
            div = "", divMas = "", divMenos = "";
            $('#total-p').text(d.p);
            $('#total-dia').text(d.p_date);
            $('#total-pagados').text(d.p_pagados);
            $('#total-proceso').text(d.p_proceso);
            $('#total-pendientes').text(d.p_pendientes);
            $('#total-cancelados').text(d.p_cancelados);

            $('.txt-dinero-total').text(accounting.formatMoney(d.total_general));
            $('.txt-dinero-pagados').text(accounting.formatMoney(d.total_pagados));
            $('.txt-dinero-credito').text(accounting.formatMoney(d.total_credito));
            $('.txt-dinero-pendientes').text(accounting.formatMoney(d.total_pendientes));
            $('.txt-dinero-cancelados').text(accounting.formatMoney(d.total_cancelados));

            $('.v_detalle').attr('data-fecha', d.fecha);
            $('.v_detalle').attr('data-select', d.fecha_select);
            
          }


      },

      error: function () {
          alert("failure");
      }
      });

  }
}//end function

function mostrarpedidosporperiodo(fecha_inicio, fecha_fin, inicio){

  if(fecha_inicio > fecha_fin){
      alertas('error',"La fecha de inicio no puede ser mallor a la fecha de fin.");
  } else {

    $.ajax({
        type: "POST",
        url: "/pedidos/vertotalespedidosporperiodo",
        data:{inicio: inicio, fecha_inicio: fecha_inicio, fecha_fin: fecha_fin},
        success: function (d) {

          if(d == 'Vacio'){
            alertas('error',"La fecha elegida aun no llega.");
          } else {
            div = "", divMas = "", divMenos = "";
            $('#total-p').text(d.p);
            $('#total-dia').text(d.p_date);
            $('#total-pagados').text(d.p_pagados);
            $('#total-proceso').text(d.p_proceso);
            $('#total-pendientes').text(d.p_pendientes);
            $('#total-cancelados').text(d.p_cancelados);

            $('.txt-dinero-total').text(accounting.formatMoney(d.total_general));
            $('.txt-dinero-pagados').text(accounting.formatMoney(d.total_pagados));
            $('.txt-dinero-credito').text(accounting.formatMoney(d.total_credito));
            $('.txt-dinero-pendientes').text(accounting.formatMoney(d.total_pendientes));
            $('.txt-dinero-cancelados').text(accounting.formatMoney(d.total_cancelados));

            $('.v_detalle').attr('data-fecha', d.fecha_inicio);
            $('.v_detalle').attr('data-fechafin', d.fecha_fin);
            $('.v_detalle').attr('data-select', d.fecha_select);
            
          }


      },

      error: function () {
          alert("failure");
      }
      });

  }




}


//totales del inventario
invent = $('.totales-inv');
inventMas = $('.inv-mas');
inventMenos = $('.inv-menos');
$.ajax({
    type: "POST",
    url: "/pedidos/verpedidos",
    success: function (d) {

      div = "", divMas = "", divMenos = "";

      for(datos in d.i_total){

              div += '<div value='+d.i_total[datos].producto_id+' class="caja">'+
                        '<div class="cont-t">'+
                           '<h4 class="text-info total-inv">'+d.i_total[datos].cantidad+'</h4>'+
                           '<h3 class="clave-inv">'+d.i_total[datos].clave+'</h3>'+
                        '</div>'+
                    '</div>';
           }

          invent.append(div);

          for(datos in d.i_mas){

                  divMas += '<div value='+d.i_mas[datos].producto_id+' class="caja"><div class="cont-t"><h4 class="text-success total-inv">'+d.i_mas[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_mas[datos].clave+'</h3></div></div>';
               }

              inventMas.append(divMas);

              for(datos in d.i_menos){

                    divMenos += '<div value='+d.i_menos[datos].producto_id+' class="caja"><div class="cont-t"><h4 class="text-danger total-inv">'+d.i_menos[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_menos[datos].clave+'</h3></div></div>';
                   }

                  inventMenos.append(divMenos);

  },

  error: function () {
      alert("failure");
  }
  });

//Detalle de los totales
$(document).on('click', '.v_detalle', function(){
  estatus = $(this).attr('value');
  txt = $(this).attr('data-text');
  fecha = $(this).attr('data-fecha');
  fecha_fin = $(this).attr('data-fechafin');
  fecha_select = $(this).attr('data-select');

  $('#to-ped').text(txt);

      $('#totalesmodal').modal({
        show: 'false',
      });

              //Listar pedidos
            $.ajax({
                dataType: 'json',
                url: "/pedidos/detalletotales",
                data:{estatus: estatus, fecha: fecha, fecha_fin: fecha_fin, fecha_select: fecha_select},
                success: function (p) {

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

                  "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
                  "sInfoFiltered": " - filtrados de _MAX_ registros", 
                  "sInfoEmpty": "No hay resultados de búsqueda", 
                  "sZeroRecords": "No hay registros a mostrar", 
                  "sProcessing": "Espere, por favor...", 
                  "sSearch": "Buscar:", 

               },


                'iDisplayLength': 50,
                
                "aaSorting": [[ 1, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {

                             ida = p[i].agente_id, 
                             tabla_a.fnAddData([
                                        p[i].num_pedido,
                                        p[i].created_at,
                                        p[i].nombre_cliente+" "+p[i].paterno,
                                        '<span id="idp_'+p[i].id+'" class="text-success">'+accounting.formatMoney(p[i].total)+'</span>',
                                        '<div class="bloque_a">'+
                                          '<span id="ida_'+p[i].id+'" class="a_'+p[i].agente_id+' text-primary us_'+p[i].usuario+'"></span>'+
                                          '<span id="span_'+p[i].id+'" value="'+p[i].agente_id+'" data-id="'+p[i].id+'" class="cam_'+p[i].usuario+' text-danger asg-agente asig_'+p[i].agente_id+' ">Asignar</span>'+
                                          '<img id="gif-agente_'+p[i].id+'" class="cargando-gif" src="img/cargando.gif" width="50px">'+
                                          '<select id="s-agente_'+p[i].id+'" data-pedido="'+p[i].id+'" class="select_agente s_u_'+p[i].usuario+' form-control"></select>'+
                                        '</div>',
                                        '<span id="e_'+p[i].id+'" class="extra_'+p[i].extra_pedido+'"></span>',
                                       // '<span class="estatus_'+p[i].estatus+'"></span>',
                                      ]);

                            //$('.select_agente').select2();

                             $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
                             $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

                             llamarpaginaciondatatable();

                             if(ida == 0){

                                } else {
                                  //console.log(ida);
                                 $.ajax({
                                    type: "GET",
                                    url: "/consultas/listaagentes",
                                    data: {ida: ida},
                                    success: function( a ){
                                            campo = $('.a_'+a.agente[0].id);
                                            c = "";
                                            c += a.agente[0].usuario;
                                            campo.text(c);
                                            $('.asig_'+a.agente[0].id).text('Cambiar');
                                            $('.asig_'+a.agente[0].id).removeClass('text-danger');
                                            $('.asig_'+a.agente[0].id).addClass('text-primary');

                                            $(document).on('click','.cargarpaginacion', function(){
                                                  $('.fancy a').addClass('cargarpaginacion');
                                                  campo = $('.a_'+a.agente[0].id);
                                                  c = "";
                                                  c += a.agente[0].usuario;
                                                  campo.text(c);
                                                  $('.asig_'+a.agente[0].id).text('Cambiar');
                                                  $('.asig_'+a.agente[0].id).removeClass('text-danger');
                                                  $('.asig_'+a.agente[0].id).addClass('text-primary');

                                                }); 

                                                $(document).on('keyup', '#list_p__filter', function(){
                                                  campo = $('.a_'+a.agente[0].id);
                                                  c = "";
                                                  c += a.agente[0].usuario;
                                                  campo.text(c);
                                                  $('.asig_'+a.agente[0].id).text('Cambiar');
                                                  $('.asig_'+a.agente[0].id).removeClass('text-danger');
                                                  $('.asig_'+a.agente[0].id).addClass('text-primary');

                                                });

                                                $(document).on('click', '#list_p__length', function(){  
                                                    campo = $('.a_'+a.agente[0].id);
                                                    c = "";
                                                    c += a.agente[0].usuario;
                                                    campo.text(c);
                                                    $('.asig_'+a.agente[0].id).text('Cambiar');
                                                    $('.asig_'+a.agente[0].id).removeClass('text-danger');
                                                    $('.asig_'+a.agente[0].id).addClass('text-primary');
                                                });

                                                     

                                         }

                                 });
                                }




                              }




                        $('.a_0').text('No asignado');
                        $('.a_0').addClass('text-danger');


                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');



                },
                error: function () {
                    alert("failure");
                }
            });



});



    $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');
        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');

      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');
        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');
      });

      $(document).on('click', '#list_p__length', function(){
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');
        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');
      });



  //Cargar agentes
  $(document).on('click', '.asg-agente', function(){
    id_agente = $(this).attr('value');
    id = $(this).attr('data-id'); //id del pedido

 $.ajax({
    type: "GET",
    url: "/listapedidos/asignaragente",
    data: {id_agente: id_agente, id: id},

      //mientras enviamos el archivo
        beforeSend: function(){
            $('#gif-agente_'+id).show();
        },


    success: function (d) {
      $('#gif-agente_'+id).hide();
      $('#s-agente_'+id).show();
      //console.log(d.select[0].usuario);
      s = $('#s-agente_'+d.id);
      o = "";
      if(d.id_agente == 0){
        o +='<option value="" disabled selected>-- Seleccione --</option>';
        for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }
       s.append(o);

    } else {

         o +='<option value="" disabled selected>'+d.select.usuario+'</option>';
      for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }
       s.append(o);

    }


  },

  error: function () {
      alert("failure");
  }
  });

});



$(document).on('change', 'select.select_agente', function(){
      id = $(this).val(); //id del agente
      idp = $(this).attr('data-pedido'); //id del pedido

      $('#asig_n_a').modal({
        show:'false',
      });

      $('#asig-agente').attr('value', id);
      $('#asig-agente').attr('data-pedido', idp);

      $('#no-asig').click(function(){
        $('.select_agente').val($('.select_agente > option:first').val());
      });

});

$(document).on('click', '#asig-agente', function(){
  id_agente = $(this).attr('value');
  idp = $(this).attr('data-pedido');

   $.ajax({
    type: "GET",
    url: "/listapedidos/cambiaragente",
    data: {id_agente: id_agente, idp: idp},
    success: function (d) {

      $('.us_'+d.u[0].usuario).removeClass('text-danger');
      $('.us_'+d.u[0].usuario).addClass('text-primary');
      $('.us_'+d.u[0].usuario).text(d.agente[0].usuario);

      $('.cam_'+d.u[0].usuario).removeClass('text-danger');
      $('.cam_'+d.u[0].usuario).addClass('text-primary');
      $('.cam_'+d.u[0].usuario).text('Cambiar');

      //eliminamos la clase del span asigar
      $('.cam_'+d.u[0].usuario).removeClass('asg-agente');

      //le agregamos la nueva clase
      $('.cam_'+d.u[0].usuario).addClass('agentes-cargados');

      $('#s-agente_'+d.idp).hide();

      //remplazamos los datos del select
      $('#s-agente_'+d.idp).replaceWith('<select id="s-agente_'+d.idp+'" data-pedido="'+d.idp+'" class="select_agente s_u_'+d.u[0].usuario+' form-control">'+
        '</select>');

      s = $('.s_u_'+d.u[0].usuario);
      o = "";
      o +='<option value="" disabled selected>'+d.agente[0].usuario+'</option>';
      for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }

       s.append(o);


      
      


      //$(".select_agente").load(location.href+" .select_agente>*","");

      $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');
        $('.us_'+d.u[0].usuario).removeClass('text-danger');
        $('.us_'+d.u[0].usuario).addClass('text-primary');
        $('.us_'+d.u[0].usuario).text(d.agente[0].usuario);
        $('.cam_'+d.u[0].usuario).removeClass('text-danger');
        $('.cam_'+d.u[0].usuario).addClass('text-primary');
        $('.cam_'+d.u[0].usuario).text('Cambiar');
        $('.cam_'+d.u[0].usuario).removeClass('asg-agente');
        $('.cam_'+d.u[0].usuario).addClass('agentes-cargados');

        $('#s-agente_'+d.idp).replaceWith('<select id="s-agente_'+d.idp+'" data-pedido="'+d.idp+'" class="select_agente s_u_'+d.u[0].usuario+' form-control">'+
        '</select>');

      s = $('.s_u_'+d.u[0].usuario);
      o = "";
      o +='<option value="" disabled selected>'+d.agente[0].usuario+'</option>';
      for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }

       s.append(o);
      });

      $(document).on('keyup', '#list_p__filter', function(){
        $('.us_'+d.u[0].usuario).removeClass('text-danger');
        $('.us_'+d.u[0].usuario).addClass('text-primary');
        $('.us_'+d.u[0].usuario).text(d.agente[0].usuario);
        $('.cam_'+d.u[0].usuario).removeClass('text-danger');
        $('.cam_'+d.u[0].usuario).addClass('text-primary');
        $('.cam_'+d.u[0].usuario).text('Cambiar');
        $('.cam_'+d.u[0].usuario).removeClass('asg-agente');
        $('.cam_'+d.u[0].usuario).addClass('agentes-cargados');

        $('#s-agente_'+d.idp).replaceWith('<select id="s-agente_'+d.idp+'" data-pedido="'+d.idp+'" class="select_agente s_u_'+d.u[0].usuario+' form-control">'+
        '</select>');

      s = $('.s_u_'+d.u[0].usuario);
      o = "";
      o +='<option value="" disabled selected>'+d.agente[0].usuario+'</option>';
      for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }

       s.append(o);
      });

      $(document).on('click', '#list_p__length', function(){
        $('.us_'+d.u[0].usuario).removeClass('text-danger');
        $('.us_'+d.u[0].usuario).addClass('text-primary');
        $('.us_'+d.u[0].usuario).text(d.agente[0].usuario);
        $('.cam_'+d.u[0].usuario).removeClass('text-danger');
        $('.cam_'+d.u[0].usuario).addClass('text-primary');
        $('.cam_'+d.u[0].usuario).text('Cambiar');
        $('.cam_'+d.u[0].usuario).removeClass('asg-agente');
        $('.cam_'+d.u[0].usuario).addClass('agentes-cargados');

        $('#s-agente_'+d.idp).replaceWith('<select id="s-agente_'+d.idp+'" data-pedido="'+d.idp+'" class="select_agente s_u_'+d.u[0].usuario+' form-control">'+
        '</select>');

      s = $('.s_u_'+d.u[0].usuario);
      o = "";
      o +='<option value="" disabled selected>'+d.agente[0].usuario+'</option>';
      for(datos in d.agentes){
         o += '<option value="'+d.agentes[datos].id+'">'+d.agentes[datos].usuario+'</option>';
       }

       s.append(o);
      });


  },

  error: function () {
      alert("failure");
  }
  });

});




//mostrar select unicamente cuando se hayan actualizado los datos anteriormente
  $(document).on('click', '.agentes-cargados', function(){
    id = $(this).attr('data-id'); //id del pedido
    $('#s-agente_'+id).show();

});


//Detalle del producto del inventario
  $(document).on('click', '.caja', function(){
    id = $(this).attr('value');
    caja = $('.totales-p');
    clave = $('.clave-inv', this).text();
  $.ajax({
    type: "POST",
    url: "/pedidos/detallepedido",
    data: {id: id},
    success: function (d) {
      $('#clave-i').text(clave);

      if(d.i == 0){
        $('#nombre-i').text('Producto agotado');
      } else {
         $('#nombre-i').text(d.i[0].nombre);
          div = "";
          for(datos in d.i){

                  div += '<div class="caja-pedimento">'+
                  '<div class="cont-pedimento">'+
                  '<h4 class="text-info txt-total-inv">'+d.i[datos].cantidad+'</h4>'+
                  '<h3 class="num-pedimento">'+d.i[datos].num_pedimento+'</h3>'+
                  '<h3 class="text-info pedi-fecha">'+d.i[datos].created_at+'</h3>'+
                  '</div></div>';
               }

              caja.append(div); 
      }
  

  },

  error: function () {
      alert("failure");
  }
  });

    $('#verdetalle_i').modal({
      show: 'false',
    });
  });


$(document).on('click', '#cerrar-m', function(){
  $(".totales-p").load(location.href+" .totales-p>*","");
});


$(document).on('click', '#cerrar-pe-de', function(){
  $(".totalespedidos").load(location.href+" .totalespedidos>*","");
});


$(document).on('click', '.close', function(){
  $(".totales-p").load(location.href+" .totales-p>*","");
  $(".totalespedidos").load(location.href+" .totalespedidos>*","");
});

function llamarpaginaciondatatable(){
  $('.fancy a').addClass('cargarpaginacion');
}


</script>

@stop
