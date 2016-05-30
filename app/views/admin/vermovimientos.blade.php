@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

<style>
  .mostrartotaldif{
    font-weight: normal;
    font-size:.8em;
    text-align: right;
  }
  .mostrar_total{
    border-right:1px solid #cfcfd6;
  }
</style>

<script>
  $(document).ready(function(){
    $('.pedidos').addClass('active');
    $('.t-pedidos').addClass('en-admin');
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
  <div class="row row-inv row-mov">
    <div class="menu-p">
      <a href="{{ URL::to('consultas/exportarexcel') }}" class="btn btn-success">Exportar a Excel</a>
    </div>
    <div class="data-inv">
      <table id="list_p_" class="table table-condensed table-hover table-movimientos">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Clave</th>
            <th style="width:200px">Producto</th>
            <th>Pedimento</th>
            <th style="width:100px">Cantidad anterior</th>
            <th style="width:100px">Cantidad nueva</th>
            <th style="width:150px">Diferencia</th>
            <th style="width:200px">Motivo</th>
            <th style="width:200px">Fecha</th>
          </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th ></th>
                <th class="mostrartotaldif mostrar_agregados text-primary">Agregados: <span id="aqui-agregados" value="0"></span></th>
                <th class="mostrartotaldif mostrar_eliminados text-danger">Eliminados: <span id="aqui-eliminados" value="0"></span></th>
                <th class="mostrartotaldif mostrar_total text-success">Total: <span id="aqui-total" value="0"></span> </th>
            </tr>
        </tfoot>

      </table>
    </div>

  </div>
</div>


  <script>

  	         $.ajax({
                dataType: 'json',
                url: "/movimientos/vermovimientos",
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

                "aaSorting": [[ 1, "asc" ], [ 3, "asc" ]], 

                fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).addClass("fila_"+p[i].signo);
                               
                },

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                              id = p[i].id,

                             tabla_a.fnAddData([
                                        p[i].usuario,
                                        p[i].clave,
                                        p[i].nombre,
                                        p[i].num_pedimento,
                                        p[i].cantidad_anterior,
                                        p[i].cantidad_nueva,
                                        '<span value="'+p[i].diferencia+'" class="total_diferencia diferencia_'+p[i].signo+'"> <span class="signo_'+p[i].signo+'"></span>'+ p[i].diferencia+'</span>',
                                        p[i].comentarios,
                                        p[i].created_at,
                                      ]);



                              } //End for

                        $('.signo_menos').text('-');
                        $('.signo_mas').text('+');

                        $('.diferencia_menos').addClass('text-warning');
                        $('.diferencia_mas').addClass('text-primary');




                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');
                        
                        $('#aqui-eliminados').attr('value', 0);
                        $('#aqui-eliminados').text('0');
                        totalmenosproductos();

                        $('#aqui-agregados').attr('value', 0);
                        $('#aqui-agregados').text('0');
                        totalmeasproductos();

                        $('#aqui-total').attr('value', 0);
                        $('#aqui-total').text('0');
                        totalproductos();

                        llamarpaginaciondatatable();

                },//End success

                error: function () {
                    alert("failure");
                } //end error
            });

        $(document).on('click','.cargarpaginacion', function(){

           $('.fancy a').addClass('cargarpaginacion');

            $('.signo_menos').text('-');
            $('.signo_mas').text('+');

            $('.diferencia_menos').addClass('text-warning');
            $('.diferencia_mas').addClass('text-primary');

            $('#aqui-eliminados').attr('value', 0);
            $('#aqui-eliminados').text('0');
            totalmenosproductos();

            $('#aqui-agregados').attr('value', 0);
            $('#aqui-agregados').text('0');
            totalmeasproductos();

            $('#aqui-total').attr('value', 0);
            $('#aqui-total').text('0');
            totalproductos();
      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
          $('.signo_menos').text('-');
          $('.signo_mas').text('+');

          $('.diferencia_menos').addClass('text-warning');
          $('.diferencia_mas').addClass('text-primary');

          $('#aqui-eliminados').attr('value', 0);
          $('#aqui-eliminados').text('0');
          totalmenosproductos();

          $('#aqui-agregados').attr('value', 0);
          $('#aqui-agregados').text('0');
          totalmeasproductos();

          $('#aqui-total').attr('value', 0);
          $('#aqui-total').text('0');
          totalproductos();

      });

      $(document).on('change', '#list_p__length', function(){
            $('.signo_menos').text('-');
            $('.signo_mas').text('+');

            $('.diferencia_menos').addClass('text-warning');
            $('.diferencia_mas').addClass('text-primary');

            $('#aqui-eliminados').attr('value', 0);
            $('#aqui-eliminados').text('0');
            totalmenosproductos();

            $('#aqui-agregados').attr('value', 0);
            $('#aqui-agregados').text('0');
            totalmeasproductos();

            $('#aqui-total').attr('value', 0);
            $('#aqui-total').text('0');
            totalproductos();
      });



function totalmenosproductos(){

  $(".table-movimientos tbody tr.fila_menos").each(function(){
            diferencia = $(this).find("[class*='diferencia_menos']").attr('value');
            valoreliminados = $('#aqui-eliminados').attr('value');
            sumar = parseFloat(diferencia) + parseFloat(valoreliminados);
            $('#aqui-eliminados').attr('value', sumar);
            $('#aqui-eliminados').text(sumar);
    });


}

function totalmeasproductos(){

  $(".table-movimientos tbody tr.fila_mas").each(function(){
            diferencia = $(this).find("[class*='diferencia_mas']").attr('value');
            valoreliminados = $('#aqui-agregados').attr('value');
            sumar = parseFloat(diferencia) + parseFloat(valoreliminados);
            $('#aqui-agregados').attr('value', sumar);
            $('#aqui-agregados').text(sumar);
    });


}

function totalproductos(){

  $(".table-movimientos tbody tr").each(function(){
            diferencia = $(this).find("[class*='total_diferencia']").attr('value');
            valoreliminados = $('#aqui-total').attr('value');
            sumar = parseFloat(diferencia) + parseFloat(valoreliminados);
            $('#aqui-total').attr('value', sumar);
            $('#aqui-total').text(sumar);
    });


}


function llamarpaginaciondatatable(){
  $('.fancy a').addClass('cargarpaginacion');
}


  </script>

@stop
