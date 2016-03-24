@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

<script>
  $(document).ready(function(){
    $('.movimientos').addClass('active');
    $('.t-movimientos').addClass('en-admin');
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
            <th>Clave</th>
            <th>Producto</th>
            <th>Pedimento</th>
            <th style="width: 200px">Cantidad actual</th>
            <!--<th>Motivo</th>-->
            <th>Editar</th>
          </tr>
        </thead>

      </table>
    </div>

  </div>
</div>


    <!--  Modal para confirmar actualizar nota  -->
<div id="editarmovi" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
            <span class="head-cl"></span>
             </h4>
          </div>
          <div class="modal-body body-add-n b-cant">
              <h4 class="text-info text-center tex-produ"></h4>
           <div class="form-group error-n">
                <label for="nota" class="text-primary">Cantidad actual: </label>
                <input type="number" class="form-control" id="n-cantidad-a" disabled>
            </div>
            
            
            <div class="form-group error-n">
                <label for="nota" class="text-primary">Cantidad nueva: </label>
               {{ Form::number('n-cantidad', null,  array('class' => 'form-control', 'id' => 'n-cantidad', 'placeholder' => 'Nueva cantidad')) }}
            </div>

            <div class="area-nota error-c">
              <label class="text-primary">Motivo: </label>
              <textarea class="form-control" rows="5" id="mot" placeholder="Motivo..."></textarea>
            </div>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="n-act" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="actualizar-cant" class="btn btn-primary confirm" data-dismiss="modal" >
                 Actualizar
                 <span class="glyphicon glyphicon-refresh"></span>
              </span>
          </div>
        </div>
      </div>
    </div>


  <script>


            $.ajax({
                dataType: 'json',
                url: "/movimientos/listarm",
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

                "aaSorting": [[ 2, "desc" ]], 

                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            }); //End data


                    tabla_a.fnClearTable();

                      for(var i = 0; i < p.length; i++) {
                              id = p[i].id,

                             tabla_a.fnAddData([
                                        p[i].clave,
                                        p[i].nombre,
                                        '<span class="hidden">'+p[i].created_at+'</span>' + p[i].num_pedimento,
                                        '<div class="cantidades">'+
                                          '<div class="actual-anterior">'+
                                            //'<h4 class="text-info txt-ac-ant">Actual</h4>'+
                                            '<span id="cant_a_'+p[i].id+'" class="spn-ac-ant">'+p[i].cantidad+'</span>'+
                                          '</div>'+
                                         // '<div class="nueva">'+
                                           // '<h4 class="text-info txt-nueva">Nueva</h4>'+
                                          //  '<span class="spn-nueva"></span>'+
                                          //'</div>'+
                                        '</div>',
                                        //'<span>Motivo</span>',
                                        '<span value="'+p[i].id+'" data-producto="'+p[i].producto_id+'" class="edit-mo btn btn-sm btn-primary glyphicon glyphicon-edit" data-clave="'+p[i].clave+'" data-nombre="'+p[i].nombre+'" data-pedimento="'+p[i].num_pedimento+'"></span>',
                                      ]);


                              /*  $.ajax({
                                    type: "GET",
                                    url: "/movimientos/verm",
                                    data: {id: id},
                                    success: function( e ){
                                          console.log(e);
                                          if(e.n == 0){ 
                                              console.log('No hay movimientos');
                                          } else {
                                            console.log('Si hay movimientos');
                                            
                                          }
 
                                         }

                                 });*/

                              } //End for



                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');
                      


                },//End success

                error: function () {
                    alert("failure");
                } //end error
            });


  //Editar movimient
  $(document).on('click', '.edit-mo', function(){
    $('#editarmovi').modal({
      show: 'false',
    });

    id = $(this).attr('value');
    idpro = $(this).attr('data-producto');
    $('#actualizar-cant').attr('data-id', idpro);
    clave = $(this).attr('data-clave');
    pro = $(this).attr('data-nombre');
    pedimento = $(this).attr('data-pedimento');
    $('#actualizar-cant').attr('data-pedimento', pedimento);
    cant_a_ = $('#cant_a_'+id).text();
    $('#n-cantidad-a').val(cant_a_);
    $('.head-cl').html(clave);
    $('.tex-produ').text(pro);
  });

$(document).on('click', '#actualizar-cant', function(){
    id = $(this).attr('data-id');
    pedimento = $(this).attr('data-pedimento');
    anterior = $('#n-cantidad-a').val();
    nueva = $('#n-cantidad').val();
    motivo = $('#mot').val();

    $.ajax({
      type: "POST",
      url: "/movimientos/nuevomovimiento",
      data: {id: id, pedimento: pedimento, anterior: anterior, nueva: nueva, motivo: motivo},
      success: function( m ){

            $('#cant_a_'+m.id).text(m.cantidad);

            $('#n-cantidad').val('');
            $('#mot').val('');
           }

   });


});

$(document).on('click', '#n-act', function(){
      $('#n-cantidad').val('');
      $('#mot').val('');
});

  </script>

@stop
