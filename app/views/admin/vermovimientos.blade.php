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
            <th style="width:200px">Producto</th>
            <th>Pedimento</th>
            <th style="width:150px">Cantidad anterior</th>
            <th style="width:150px">Cantidad nueva</th>
            <th style="width:200px">Motivo</th>
            <th style="width:200px">Fecha</th>
          </tr>
        </thead>

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

               }, //end o

                "aaSorting": [[ 6, "desc" ]], 

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                              id = p[i].id,

                             tabla_a.fnAddData([
                                        p[i].usuario,
                                        p[i].nombre,
                                        p[i].num_pedimento,
                                        p[i].cantidad_anterior,
                                        p[i].cantidad_nueva,
                                        p[i].comentarios,
                                        p[i].created_at,
                                      ]);



                              } //End for



                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');
                      


                },//End success

                error: function () {
                    alert("failure");
                } //end error
            });



  </script>

@stop
