@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
    <style>
      .icon-nombre{
        line-height: 45px;
      }
    </style>
    <script>
        $(document).ready(function(){
            $('.catalogos').addClass('active');
            $('.t-catalogos').addClass('en-admin');
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
  <div class="row row-paginas">

    <h1 class="text-info text-center">Catálogo Categorías.</h1>

    <div class="data-notas">
        <button id="add-categoria" class="btn btn-primary add-n" title="Agregar categoría">
          <span class="glyphicon glyphicon-plus"></span>
        </button>
      <table id="list_p_" class="table">
        <thead>
          <tr>
            <th>Categoría</th>
            <th>Estatus</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
      </table>
    </div>

  </div>
</div>


<!--Alertas-->
<div class="notifications top-right" data-html="true"></div>


<!--  Modal agregar categoria  -->
<div id="agregarcategoria" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-plus"></span>
              Agregar Categoría
             </h4>
          </div>
          <div class="modal-body body-add-n">

            <form class="form-modal" action="">
                              
                <div class="form-group error-nombre">
                      <label for="nombre" class="text-primary">Nombre: </label>
                      <input type="text" name="nombre" id="nombre" class="form-control" >
                      <span class="icon-nombre"></span>
                </div>

              <label for="estatus" class="text-primary">Estatus: </label>
              <div class="checkbox checkbox-activ">
                     <span class="text-primary">Activo</span>
                    <div class="txt-activ">
                      <input id="inp-check" type="checkbox" value="">
                    </div>
              </div>

                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-categoria" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="save-categoria" class="btn btn-primary confirm" data-dismiss="modal" >Agregar</span>
          </div>
        </div>
      </div>
    </div>


    <!--  Modal para confirmar eliminar categoria -->
<div id="eliminarcategoria" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Eliminar Categoría
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar esta cateoría?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-categoria" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


    <!--  Modal para editar categoria -->
<div id="modal-edit-categoria" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
            <span class="glyphicon glyphicon-edit"></span>
              Editar Categoría
             </h4>
          </div>
          <div class="modal-body body-add-n">

            <form class="form-modal" action="">
                              
                <div class="form-group error-nombre-edit">
                      <label for="nombre-edit" class="text-primary">Nombre: </label>
                      <input type="text" name="nombre-edit" id="nombre-edit" class="form-control" >
                      <span class="icon-nombre-edit"></span>
                </div>

              <label for="estatus" class="text-primary">Estatus: </label>
              <div class="checkbox checkbox-activ">
                     <span class="text-primary">Activo</span>
                    <div class="txt-activ">
                      <input id="inp-check-edit" type="checkbox" value="">
                    </div>
              </div>

                           
            </form>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-categoria-edit" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="save-categoria-edit" class="btn btn-primary confirm" data-dismiss="modal" >Actualizar</span>
          </div>
        </div>
      </div>
    </div>






  <script>

  $(document).ready(function(){

    $.ajax({
        url:'/categorias/listarcategorias',
        dataType: 'json',
        success: function(n){

          tabla_n = $('#list_p_').DataTable({
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

               fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).attr('id', "fila_"+n[i].id);
                               
                },

                "aaSorting": [[ 0, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < n.length; i++) {
                             tabla_n.fnAddData([
                                        '<span class="hidden">'+n[i].created_at+'</span>'+n[i].categoria,
                                        '<span class="estatus_'+n[i].estatus+'"></span>',
                                        '<span title="Editar categoría" class="editar-n btn btn-info" value="'+n[i].id+'"><span class="glyphicon glyphicon-edit"></span></span>', 
                                        '<span title="Eliminar categoría" class="delete-n btn btn-danger" value="'+n[i].id+'"><span class="glyphicon glyphicon-trash"></span><span></span>'
                                        
                                      ]);


                              }

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

                        $('.estatus_0').text('Inactivo');
                        $('.estatus_0').addClass('text-danger');
                        $('.estatus_1').text('Activo');
                        $('.estatus_1').addClass('text-success');

                        llamarpaginaciondatatable();



        },
        error: function(){
          alert('failure');
        }
    });

     $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');
        $('.estatus_0').text('Inactivo');
        $('.estatus_0').addClass('text-danger');
        $('.estatus_1').text('Activo');
        $('.estatus_1').addClass('text-success');
      });        


      $(document).on('keyup', '#list_p__filter', function(){
            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');

      });

      $(document).on('click', '#list_p__length', function(){
            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');
      });


    //Validaciones para las categorias
    $("#save-categoria").click(function () {

     if($("#nombre").val().length == 0){
              $('.error-nombre').addClass('has-error has-feedback');
              $('.icon-nombre').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

    $("#nombre").focus( function(){
        $('.error-nombre').removeClass('has-error has-feedback');
        $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');
    });

    //Agregar categoria
    $(document).on('click', '#add-categoria', function(){

      $('#agregarcategoria').modal({
        show:'false',
      });

    });


    //Agregar categoria
    $(document).on('click', '#save-categoria', function(){
      nombre = $('#nombre').val();

    if($('#inp-check').prop("checked") == true){
          activo = 1;
    } else {
        activo = 0;
    }

      $.ajax({
        url: '/categorias/agregarcategoria',
        type: 'POST',
        data: {nombre: nombre, activo: activo},
        success: function(c){

            fila = "<tr id=fila_"+c.id+">"+
                       "<td><span class='hidden'>"+c.created_at+"</span>"+c.categoria+"</td>"+
                       "<td><span class='estatus_"+c.estatus+"'></span></td>"+
                       "<td><span title='Editar categoría' class='editar-n btn btn-info' value='"+c.id+"'><span class='glyphicon glyphicon-edit'></span></span></td>"+
                       "<td><span title='Eliminar categoría' class='delete-n btn btn-danger' value='"+c.id+"'><span class='glyphicon glyphicon-trash'></span></span></td>"+
                    "</tr>";

            $('tbody').prepend(fila);

            //Limiapmos
             $('#nombre').val(" ");
             $('#inp-check').prop("checked", false);

            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');

        },
        error: function(){
          alert('failure');
        }
      }); 

    });


    //Cancelar guardar nota  
    $(document).on('click', '#cancelar-categoria', function(){

      $('.error-nombre').removeClass('has-error has-feedback');
      $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');

    });


    // X
    $(document).on('click', '.close', function(){

      $('.error-nombre').removeClass('has-error has-feedback');
      $('.icon-nombre').removeClass('glyphicon glyphicon-remove form-control-feedback');
      $('.error-nombre-edit').removeClass('has-error has-feedback');
      $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

    });


    //Eliminar  categoria
    $(document).on('click', '.delete-n', function(){
      id = $(this).attr('value');
      $('#eliminar-categoria').attr('value', id);

      $('#eliminarcategoria').modal({
        show:'false',
      });

    });
    
    
    $(document).on('click', '#eliminar-categoria', function(){
      id = $(this).attr('value');

      $.ajax({
        url: '/categorias/eliminarcategoria',
        type: 'GET',
        data: {id: id},
        success: function(e){

              if(e.p == 'Existe'){
                     alertas("error","La Categoría "+e.categoria.categoria+" esta en uso.");
                  } else {
                   // alertas("success","Categoría eliminada correctamente");
                     $('#fila_'+e).remove();
                  }

        },
        error: function(){
          alert('failure');
        }
      });


    });

    //Ediar categoria
    $(document).on('click', '.editar-n', function(){
      id = $(this).attr('value');
      $('#save-categoria-edit').attr('value', id);
      $.ajax({
        url: '/categorias/editarcategoria',
        type: 'GET',
        data: {id: id},
        success: function(e){
            $('#nombre-edit').val(e.categoria);

            activo = e.estatus;
            if(activo == 1){
              $('#inp-check-edit').prop("checked", true);
              $('#inp-check-edit').attr('value', '1');
            } else {
              $('#inp-check-edit').prop("checked", false);
              $('#inp-check-edit').attr('value', '0');
            }
            
        },
        error: function(){
          alert('failure');
        }


      });

        $('#modal-edit-categoria').modal({
           show: 'false',
         });

    });

        //Validaciones al actualizar categoria
    $("#save-categoria-edit").click(function () {

    if($("#nombre-edit").val().length == 0){
              $('.error-nombre-edit').addClass('has-error has-feedback');
              $('.icon-nombre-edit').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

    $("#nombre-edit").focus( function(){
        $('.error-nombre-edit').removeClass('has-error has-feedback');
        $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');
    });


    $(document).on('click', '#cancelar-categoria-edit', function(){

      $('.error-nombre-edit').removeClass('has-error has-feedback');
      $('.icon-nombre-edit').removeClass('glyphicon glyphicon-remove form-control-feedback');

    });



    $(document).on('click', '#inp-check-edit', function(){
      if($(this).prop("checked") == true){
        $('#inp-check-edit').attr('value', '1');
      } else {
        $('#inp-check-edit').attr('value', '0');
      }
    });

    //Actualizar nota
    $(document).on('click', '#save-categoria-edit', function(){

      id = $(this).attr('value');
      nombre = $('#nombre-edit').val();
      activo = $('#inp-check-edit').val();

      $.ajax({
        url: '/categorias/actualizarcategoria',
        type: 'GET',
         data: {id: id, nombre: nombre, activo: activo},
        success: function(a){
            $('#fila_'+id).replaceWith('<tr id="fila_'+a.id+'">'+
                '<td><span class="hidden">'+a.created_at+'</span>'+a.categoria+'</td>'
                +'<td><span class="estatus_'+a.estatus+'"></span></td>'
                +'<td><span title="Editar categoría" class="editar-n btn btn-info" value="'+a.id+'"><span class="glyphicon glyphicon-edit"></span></span></td>'
                +'<td><span title="Eliminar categoría" class="delete-n btn btn-danger" value="'+a.id+'"><span class="glyphicon glyphicon-trash"></span></span></td>'
                +'<tr/>'); 


            $('.estatus_0').text('Inactivo');
            $('.estatus_0').addClass('text-danger');
            $('.estatus_1').text('Activo');
            $('.estatus_1').addClass('text-success');
            
        },
        error: function(){
          alert('failure');
        }
      });


      


    });
    
      



  });

//Funciones para los alerts
function alertas(tipo,mensaje){
    $('.top-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }

function llamarpaginaciondatatable(){
  $('.fancy a').addClass('cargarpaginacion');
}


  </script>

@stop
