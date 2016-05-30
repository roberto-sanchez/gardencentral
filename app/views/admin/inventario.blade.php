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
            <th>Clave</th>
            <th style="width: 250px!important">Producto</th>
            <th>Foto</th>
            <th>Pedimento</th>
            <th>Cantidad</th>
            <th>Fecha de registro</th>
          </tr>
        </thead>

      </table>
    </div>

  </div>
</div>

<!--Modal para ver la foto del producto-->
<div id="verfotop" class="modal fade">
<div class="modal-dialog">
  <div class="modal-content c-fotope">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title title-f text-info text-center">
      <span class="glyphicon glyphicon-picture"></span>

       </h4>
    </div>
    <div class="modal-body m-foto">
      <div class="v-foto">
          <img class="f-p-p" alt="Foto del producto">
      </div>
    </div>
    <div class="modal-footer f-foto modal-confirmar">

    </div>
  </div>
</div>
</div>

  <script>


            $.ajax({
                dataType: 'json',
                url: "/inventario/listarinventario",
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

                "aaSorting": [[ 0, "asc" ], [ 3, "asc" ]], 

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                             tabla_a.fnAddData([
                                        p[i].clave,
                                        p[i].nombre,
                                        '<span title="Ver foto del producto" class="pro-foto" id="'+p[i].foto+'" data-id="'+p[i].nombre+'">Ver Foto</span>',
                                        p[i].num_pedimento,
                                        p[i].cantidad,
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






  </script>

@stop
