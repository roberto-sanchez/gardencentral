@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
{{ Html::Script('js/d3.min.js') }}
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
    

      <div class="content-pedidos">

          <h2 class="txt-est-p text-primary">Estatus de los pedidos</h2>
        <div class="caja-p-t">
          <div class="caja-p">
            <div class="cantidad-p cantidad-total">
              <p id="total-p" class="pull-right text-error strong"></p>
            </div>
            <div class="text-p">
              <h2 class="txt-total">Total de pedidos.</h2>
              <a value="5" data-text="Total de pedidos" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>

          <div class="caja-p">
            <div class="cantidad-p cantidad-dia">
              <p id="total-dia" class="pull-right text-info strong"></p>
            </div>
            <div class="text-p">
              <h2 class="txt-dia">Pedidos del día.</h2>
              <a value="4" data-text="Pedidos del día" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>

          <div class="caja-p">
            <div class="cantidad-p cantidad-pagados">
              <p id="total-pagados" class="pull-right text-success strong"></p>
            </div>
            <div class="text-p">
              <h2 class="txt-pagados">Pedidos pagados.</h2>
              <a value="2" data-text="Pedidos pagados" class="v_detalle" href="#">Ver detalle</a>
            </div>
          </div>
        </div>

        <div class="caja-p-e">
          <div class="caja-p">
          <div class="cantidad-p cantidad-credito">
            <p id="total-proceso" class="pull-right text-primary strong"></p>
          </div>
          <div class="text-p">
            <h2 class="txt-credito">Pedidos a crédito.</h2>
            <a value="1" data-text="Pedidos a crédito" class="v_detalle" href="#">Ver detalle</a>
          </div>
        </div>

        <div class="caja-p">
          <div class="cantidad-p cantidad-pendientes">
            <p id="total-pendientes" class="pull-right text-warning strong"></p>
          </div>
          <div class="text-p">
            <h2 class="txt-pendientes">Pedidos pendientes.</h2>
            <a value="0" data-text="Pedidos pendientes" class="v_detalle" href="#">Ver detalle</a>
          </div>
        </div>

        <div class="caja-p">
          <div class="cantidad-p cantidad-cancelados">
            <p id="total-cancelados" class="pull-right text-danger strong"></p>
          </div>
          <div class="text-p">
            <h2 class="txt-cancelados">Pedidos cancelados.</h2>
            <a value="3" data-text="Pedidos cancelados" class="v_detalle" href="#">Ver detalle</a>
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


{{ HTML::script('js/accounting.min.js') }}
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


/*
function graficar() {
    var width = 300;
    var height = 300;

    var radius = Math.min(width, height) / 2;

    var color = d3.scale.ordinal()
        .range(["red", "aqua", "CornflowerBlue", "DarkGoldenRod", "Yellow", "DarkMagenta", "DarkRed", "GreenYellow", "HotPink", "Peru", "Tomato", "Teal", "Salmon"]);

    var arc = d3.svg.arc()
        .outerRadius(radius - 10)
        .innerRadius(0);

    var pie = d3.layout.pie()
        .value(function(d) {
            return d.dato;
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
            return color(d.data.nombre);
        });

    g.append("text")
        .text(function(d) {
            return d.data.nombre + " (" + d.data.dato + ")";
        })
        .attr("transform", function(d) {
            return "translate(" + arc.centroid(d) + "), rotate(" + angle(d) + ")";
        })

    function angle(d) {
        var a = (d.startAngle + d.endAngle) * 90 / Math.PI - 90;
        return a > 90 ? a - 180 : a;
    }


}

*/


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

invent = $('.totales-inv');
inventMas = $('.inv-mas');
inventMenos = $('.inv-menos');
$.ajax({
    type: "POST",
    url: "/pedidos/verpedidos",
    success: function (d) {
      div = "", divMas = "", divMenos = "";
      $('#total-p').text(d.p);
      $('#total-dia').text(d.p_date);
      $('#total-pagados').text(d.p_pagados);
      $('#total-proceso').text(d.p_proceso);
      $('#total-pendientes').text(d.p_pendientes);
      $('#total-cancelados').text(d.p_cancelados);

      for(datos in d.i_total){

              div += '<div value='+d.i_total[datos].producto_id+' class="caja"><div class="cont-t"><h4 class="text-info total-inv">'+d.i_total[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_total[datos].clave+'</h3></div></div>';
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
  $('#to-ped').text(txt);

      $('#totalesmodal').modal({
        show: 'false',
      });

              //Listar pedidos
            $.ajax({
                dataType: 'json',
                url: "/pedidos/detalletotales",
                data:{estatus: estatus},
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

                "aaSorting": [[ 1, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                            t = p[i].total * 0.16;
                            total = p[i].total + t;

                             ida = p[i].agente_id, 
                             tabla_a.fnAddData([
                                        p[i].num_pedido,
                                        p[i].created_at,
                                        p[i].nombre_cliente+" "+p[i].paterno,
                                        '<span id="idp_'+p[i].id+'" class="text-success">'+accounting.formatMoney(total)+'</span>',
                                        '<span id="ida_'+p[i].id+'" class="a_'+p[i].agente_id+' text-primary"></span>',
                                        '<span id="e_'+p[i].id+'" class="extra_'+p[i].extra_pedido+'"></span>',
                                       // '<span class="estatus_'+p[i].estatus+'"></span>',
                                      ]);

                             $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
                             $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');


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

                                            $(document).on('click','.fancy > li, a',function(){
                                                  campo = $('.a_'+a.agente[0].id);
                                                  c = "";
                                                  c += a.agente[0].usuario;
                                                  campo.text(c);

                                                }); 

                                                $(document).on('keyup', '#list_p__filter', function(){
                                                  campo = $('.a_'+a.agente[0].id);
                                                  c = "";
                                                  c += a.agente[0].usuario;
                                                  campo.text(c);

                                                });

                                                $(document).on('click', '#list_p__length', function(){  
                                                    campo = $('.a_'+a.agente[0].id);
                                                    c = "";
                                                    c += a.agente[0].usuario;
                                                    campo.text(c);
                                                });

                                                     

                                         }

                                 });
                                }




                              }




                        $('.a_0').text('No asignado');
                        $('.a_0').addClass('text-danger');

                       /* $('.a_0').text('No asignado');
                        $('.a_0').addClass('text-danger');
                        $('.estatus_0').text('Pendiente');
                        $('.estatus_0').addClass('text-warning');
                        $('.estatus_1').text('Crédito');
                        $('.estatus_1').addClass('text-primary');
                        $('.estatus_2').text('Pagado');
                        $('.estatus_2').addClass('text-success');
                        $('.estatus_3').text('Cancelado');
                        $('.estatus_3').addClass('text-danger');*/

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');



                },
                error: function () {
                    alert("failure");
                }
            });



});



       $(document).on('click','.fancy > li, a',function(){
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




//Detalle del producto del inventario
  $(document).on('click', '.caja', function(){
    id = $(this).attr('value');
    caja = $('.totales-p');
  $.ajax({
    type: "POST",
    url: "/pedidos/detallepedido",
    data: {id: id},
    success: function (d) {
      console.log(d);
      $('#clave-i').text(d.i[0].clave);
      $('#nombre-i').text(d.i[0].nombre);;
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


</script>

@stop
