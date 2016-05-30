@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

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
    <div class="data-inv">
      <table id="list_p_" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Pedido</th>
            <th>Estatus inicial</th>
            <th>Estatus final</th>
            <th>Fecha</th>
          </tr>
        </thead>

      </table>
    </div>

  </div>
</div>


  <script>

  	         $.ajax({
                dataType: 'json',
                url: "/movimientos/verestatus",
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

               }, //end o

                'iDisplayLength': 50,

                "aaSorting": [[ 4, "desc" ]], 

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                              id = p[i].id,

                             tabla_a.fnAddData([
                                        p[i].usuario,
                                        p[i].num_pedido,
                                        '<span class="estatus_'+p[i].estatus_inicial+'"></span>',
                                        '<span class="estatus_'+p[i].estatus_final+'"></span>',
                                        p[i].created_at,
                                      ]);



                              } //End for



                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

                        $('.estatus_0').text('Pendiente');
                        $('.estatus_0').addClass('text-warning');
                        $('.estatus_1').text('Crédito');
                        $('.estatus_1').addClass('text-primary');
                        $('.estatus_2').text('Pagado');
                        $('.estatus_2').addClass('text-success');
                        $('.estatus_3').text('Cancelado');
                        $('.estatus_3').addClass('text-danger');
                      
                        llamarpaginaciondatatable();


                },//End success

                error: function () {
                    alert("failure");
                } //end error
            });


    $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });

      $(document).on('click', '#list_p__length', function(){
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });


    function llamarpaginaciondatatable(){
      $('.fancy a').addClass('cargarpaginacion');
    }


  </script>

@stop
