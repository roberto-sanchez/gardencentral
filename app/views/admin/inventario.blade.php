@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

<script>
  $(document).ready(function(){
    $('.inventario').addClass('active');
    $('.t-inventario').addClass('en-admin');
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
  <div class="row row-inv">
    <div class="menu-p">
      <a href="{{ URL::to('consultas/excel') }}" class="btn btn-success">Exportar a Excel</a>
    </div>
    <div class="data-inv">
      <table id="list_p_" class="table table-condensed table-hover">
        <thead>
          <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Producto</th>
            <th>Cantidad</th>
          </tr>
        </thead>

      </table>
    </div>

  </div>
</div>
  <script>


            $.ajax({
                dataType: 'json',
                url: "/inventario/listarinventario",
                success: function (p) {
                  console.log(p);

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

                "aaSorting": [[ 3, "asc" ]], 

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                             tabla_a.fnAddData([
                                        p[i].id,
                                        p[i].clave,
                                        p[i].nombre,
                                        p[i].cantidad,
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
