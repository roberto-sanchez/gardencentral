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

      /*DataTables de las notas*/
    #t-notas_length{
      display:none;
    }

    #t-notas_filter{
      float:left;
      margin-left:7px;
    }

    #t-notas_filter label input{
      margin-left:0;
      border-radius: 3px;
    }

    #t-notas_info{
      display:none;
    }

    .dataTables_paginate{
      margin-top:0;
      width:100%;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
    }

    ul.fancy{
      margin:0 auto;
    }

    ul.fancy li{
      font-size:.7em;
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
              <a href="#">Ver detalle</a>
            </div>
          </div>

          <div class="caja-p">
            <div class="cantidad-p cantidad-dia">
              <p id="total-dia" class="pull-right text-info strong"></p>
            </div>
            <div class="text-p">
              <h2 class="txt-dia">Pedidos del día.</h2>
              <a href="#">Ver detalle</a>
            </div>
          </div>

          <div class="caja-p">
            <div class="cantidad-p cantidad-pagados">
              <p id="total-pagados" class="pull-right text-success strong"></p>
            </div>
            <div class="text-p">
              <h2 class="txt-pagados">Pedidos pagados.</h2>
              <a href="#">Ver detalle</a>
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
            <a href="#">Ver detalle</a>
          </div>
        </div>

        <div class="caja-p">
          <div class="cantidad-p cantidad-pendientes">
            <p id="total-pendientes" class="pull-right text-warning strong"></p>
          </div>
          <div class="text-p">
            <h2 class="txt-pendientes">Pedidos pendientes.</h2>
            <a href="#">Ver detalle</a>
          </div>
        </div>

        <div class="caja-p">
          <div class="cantidad-p cantidad-cancelados">
            <p id="total-cancelados" class="pull-right text-danger strong"></p>
          </div>
          <div class="text-p">
            <h2 class="txt-cancelados">Pedidos cancelados.</h2>
            <a href="#">Ver detalle</a>
          </div>
        </div>
        </div>
      </div>
      
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

      </div>

    <div class="seccion-inv">

      <div class="seccion1-inv">
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
      </div><!--End seccion1-inv-->

      <div class="seccion2-notas">
        <table id="t-notas">
          <thead id="head-notas">
            <tr>
              <th><span href="#agregarnota" data-toggle="modal" title="Agregar nota" class="glyphicon glyphicon-edit add-nota"></span></th>
              <th><h2 class="text-center">Notas</h2></th>
            </tr>
          </thead>        
        </table>
      </div><!--End seccion2-notas-->

    </div><!-- End seccion-inv-->

  </div><!-- End row -->



</div>


</div>

<!--  Modal agregar nota  -->
<div id="agregarnota" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Agregar Nota
             </h4>
          </div>
          <div class="modal-body body-add-n">   
               {{ Form::text('seccion', 'Dashboard', array('class' => 'hidden', 'id' => 'seccion')) }}
            <div class="form-group">
                <label for="nota" class="text-primary">Nota: </label>
               {{ Form::text('nota', null,  array('class' => 'form-control', 'id' => 'nota', 'placeholder' => 'Nombre de la nota')) }}
            </div>
            <div class="area-nota">
              <label class="text-primary">Contenido: </label>
              <textarea class="form-control" rows="5" id="contenido" placeholder="Contenido de la nota..."></textarea>
            </div>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-n" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="save-nota" class="btn btn-primary confirm" data-dismiss="modal" >Guardar Nota</span>
          </div>
        </div>
      </div>
    </div>


        <!--  Modal para confirmar actualizar nota  -->
<div id="actualizarnota" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Editar nota
             </h4>
          </div>
          <div class="modal-body body-add-n">
            
               {{ Form::text('seccion', 'Dashboard', array('class' => 'hidden', 'id' => 'seccionedit')) }}

            <div class="form-group">
                <label for="nota" class="text-primary">Nota: </label>
               {{ Form::text('nota', null,  array('class' => 'form-control', 'id' => 'notaedit', 'placeholder' => 'Nombre de la nota')) }}
            </div>

            <div class="area-nota">
              <label class="text-primary">Contenido: </label>
              <textarea class="form-control" rows="5" id="contenidoedit" placeholder="Contenido de la nota..."></textarea>
            </div>

            <div class="d-nota">
              <button id="delet-n" class="btn btn-danger" title="Eliminar Nota">
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="actualizar-nota" class="btn btn-primary confirm" data-dismiss="modal" >
                 Actualizar
                 <span class="glyphicon glyphicon-refresh"></span>
              </span>
          </div>
        </div>
      </div>
    </div>


        <!--  Modal para confirmar eliminar nota  -->
<div id="eliminarnota" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Eliminar Nota
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="text-danger text-center txt-delete-n">¿Estás seguro que deseas eliminar esta nota?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-nota" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>




<script>

$(document).ready(function(){
  cargarDatos();
  barras();
});


//Barra de los totales
function barras() {
  d3.json('pedidos/verbarras', function(err, data) {
        datos = data;
        console.log(datos);
        for(i = 0; i < datos; i++){
          console.log(i);
        }
        console.log('Numero' + datos);
    
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
        console.log(datos);
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
          console.log( d.numero);
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
    url: "pedidos/verpedidos",
    success: function (d) {
      console.log(d);
      div = "", divMas = "", divMenos = "";
      $('#total-p').text(d.p);
      $('#total-dia').text(d.p_date);
      $('#total-pagados').text(d.p_pagados);
      $('#total-proceso').text(d.p_proceso);
      $('#total-pendientes').text(d.p_pendientes);
      $('#total-cancelados').text(d.p_cancelados);

      for(datos in d.i_total){

              div += '<div class="caja"><div class="cont-t"><h4 class="text-info total-inv">'+d.i_total[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_total[datos].clave+'</h3></div></div>';
           }

          invent.append(div);

          for(datos in d.i_mas){

                  divMas += '<div class="caja"><div class="cont-t"><h4 class="text-success total-inv">'+d.i_mas[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_mas[datos].clave+'</h3></div></div>';
               }

              inventMas.append(divMas);

              for(datos in d.i_menos){

                    divMenos += '<div class="caja"><div class="cont-t"><h4 class="text-danger total-inv">'+d.i_menos[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_menos[datos].clave+'</h3></div></div>';
                   }

                  inventMenos.append(divMenos);

  },

  error: function () {
      alert("failure");
  }
  });

  seccion = 'Dashboard';

  //Listar notas
      $.ajax({
        url:'/notas/listnotas',
        dataType: 'json',
        data: {seccion: seccion},
        success: function(n){
          console.log(n);
          tabla_n = $('#t-notas').DataTable({
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
                     $(nRow).attr('id', "tr_"+n[i].id);
                     $(nRow).attr('class', "nota_fila");
                               
                },

                "aaSorting": [[ 1, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < n.length; i++) {
                             tabla_n.fnAddData([
                                      '<span></span>',
                                      '<span class="hidden">'+n[i].created_at+'</span>' + '<a id="edit-nota" title="Detalle de la nota" value="'+n[i].id+'"  href="#actualizarnota" data-toggle="modal">'+n[i].nombre+'</a>',
                                    ]);

                              }
                        $('.dataTables_paginate .prev a').text(' ');
                        $('.dataTables_paginate .prev a').addClass('glyphicon glyphicon-chevron-left');
                        $('.dataTables_paginate .next a').text(' ');
                        $('.dataTables_paginate .next a').addClass('glyphicon glyphicon-chevron-right');


        },
        error: function(){
          alert('failure');
        }
    });
  

    //Guardar nueva nota
    $(document).on('click', '#save-nota', function(){
      seccion = $('#seccion').val();
      nota = $('#nota').val();
      contenido = $('#contenido').val();

      $.ajax({
        url: '/notas/agregarnota',
        type: 'POST',
        data: {seccion: seccion, nota: nota, contenido: contenido},
        success: function(nota){
            console.log(nota);

            $('.add-nota').attr('id','r-add');

            $fila = "<tr id=tr_"+nota.id+" class='nota_fila'>"+
                       "<td><span></span></td>"+
                       "<td><span class='hidden'>"+nota.created_at+"</span><a id='edit-nota' title='Detalle de la nota' value="+nota.id+" href='#actualizarnota' data-toggle='modal'>"+nota.nombre+"</a></td>"+
                    "</tr>";

            $('tbody').prepend($fila);

             $('#nota').val(" ");
             $('#contenido').val(" ");

            //recargamos
             $(document).on('click','.fancy > li, a',function(){

              $fila = "<tr id=tr_"+nota.id+" class='nota_fila'>"+
                       "<td><span></span></td>"+
                       "<td><span class='hidden'>"+nota.created_at+"</span><a id='edit-nota' title='Detalle de la nota' value="+nota.id+" href='#actualizarnota' data-toggle='modal'>"+nota.nombre+"</a></td>"+
                    "</tr>";

                    $('tbody').prepend($fila);
            });

            //Recargamos tambien si se decide agregar nueva nota
            $(document).on('click', '#r-add', function(){
                $fila = "<tr id=tr_"+nota.id+" class='nota_fila'>"+
                       "<td><span></span></td>"+
                       "<td><span class='hidden'>"+nota.created_at+"</span><a id='edit-nota' title='Detalle de la nota' value="+nota.id+" href='#actualizarnota' data-toggle='modal'>"+nota.nombre+"</a></td>"+
                    "</tr>";

                    $('tbody').prepend($fila);
            });


        },
        error: function(){
          alert('failure');
        }
      });

    });

    //Cancelar guardar nota  
    $(document).on('click', '#cancelar-n', function(){

             $('#seccion').val(" ");
             $('#nota').val(" ");
             $('#contenido').val(" ");

    });


    //Editar nota
    $(document).on('click', '#edit-nota', function(){
      id = $(this).attr('value');
      $('#actualizar-nota').attr('value', id);
      $('#delet-n').attr('value', id);
      $.ajax({
        url: '/notas/editarnota',
        type: 'GET',
        data: {id: id},
        success: function(e){
            $('#seccionedit').val(e.sección);
            $('#notaedit').val(e.nombre);
            $('#contenidoedit').val(e.texto);
            
        },
        error: function(){
          alert('failure');
        }
      });
    });

    //Actualizar nota
    $(document).on('click', '#actualizar-nota', function(){
      id = $(this).attr('value');

      seccion = $('#seccionedit').val();
      nota = $('#notaedit').val();
      contenido = $('#contenidoedit').val();

      $.ajax({
        url: '/notas/actualizarnota',
        type: 'GET',
         data: {id: id, seccion: seccion, nota: nota, contenido: contenido},
        success: function(a){

            $('#tr_'+id).replaceWith('<tr id="tr_'+a.id+'" class="nota_fila">'+
                '<td><span></span></td>'
                +'<td><span class="hidden">'+a.created_at+'</span><a id="edit-nota" title="Detalle de la nota" value='+a.id+' href="#actualizarnota" data-toggle="modal">'+a.nombre+'</a></td>'
                +'<tr/>'); 


            $(document).on('click','.fancy > li, a',function(){

              $('#tr_'+id).replaceWith('<tr id="tr_'+a.id+'" class="nota_fila">'+
                '<td><span></span></td>'
                +'<td><span class="hidden">'+a.created_at+'</span><a id="edit-nota" title="Detalle de la nota" value='+a.id+' href="#actualizarnota" data-toggle="modal">'+a.nombre+'</a></td>'
                +'<tr/>'); 
            }); 
                  
        },
        error: function(){
          alert('failure');
        }
      });
      


    });


    //Eliminar nota
    $(document).on('click', '#delet-n', function(){
      id = $(this).attr('value');
      $('#eliminar-nota').attr('value', id);

      $('#eliminarnota').modal({
          show: 'false'
      }); 

    });

    //Confirm delete nota
    $(document).on('click', '#eliminar-nota', function(){
      id = $(this).attr('value');

      //Ocultamos el modal
      $('#actualizarnota').modal('hide');

      $.ajax({
        url: '/notas/eliminarnota',
        type: 'GET',
        data: {id: id},
        success: function(e){
            $('#tr_'+id).remove();
        },
        error: function(){
          alert('failure');
        }
      });
    });


</script>

@stop
