@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

{{ Html::script('lib/ckeditor/ckeditor.js')  }}

<script>
  $(document).ready(function(){

    $('.paginas').addClass('active');
    $('.t-paginas').addClass('en-admin');


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

    <h1 class="text-info text-center">Lista de notas.</h1>

    <div class="data-notas">
        <button href="#agregarnota" data-toggle="modal" class="btn btn-success">Agregar Nota</button>
      <table id="list_p_" class="table">
        <thead>
          <tr>
            <th>Sección</th>
            <th>Nota</th>
            <th>Contenido</th>
            <th>Acciones</th>
          </tr>
        </thead>
      </table>
    </div>

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
            
            <div class="form-group">
                <label for="seccion" class="text-primary">Sección: </label>
               {{ Form::text('seccion', null,  array('class' => 'form-control', 'id' => 'seccion', 'placeholder' => 'Sección')) }}
            </div>

            
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
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar esta nota?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-nota" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
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
            

            <div class="form-group">
                <label for="seccion" class="text-primary">Sección: </label>
               {{ Form::text('seccion', null,  array('class' => 'form-control', 'id' => 'seccionedit')) }}
            </div>

            <div class="form-group">
                <label for="nota" class="text-primary">Nota: </label>
               {{ Form::text('nota', null,  array('class' => 'form-control', 'id' => 'notaedit')) }}
            </div>

            <div class="area-nota">
              <label class="text-primary">Contenido: </label>
              <textarea class="form-control" rows="5" id="contenidoedit" placeholder="Contenido de la nota..."></textarea>
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



  <script>

  $(document).ready(function(){

    $.ajax({
        url:'/notas/listarnotas',
        dataType: 'json',
        success: function(n){
          console.log(n);
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

               fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).attr('id', "tr_"+n[i].id);
                               
                },

                "aaSorting": [[ 2, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < n.length; i++) {
                             tabla_n.fnAddData([
                                        n[i].sección,
                                        n[i].nombre,
                                        '<span class="hidden">'+n[i].created_at+'</span>' + n[i].texto,
                                        '<span class="acc"><span class="editar-n btn btn-info" href="#actualizarnota" data-toggle="modal" value="'+n[i].id+'"><span class="glyphicon glyphicon-edit"></span></span>' + '<span href="#eliminarnota" data-toggle="modal" class="delete-n btn btn-danger" value="'+n[i].id+'"><span class="glyphicon glyphicon-trash"></span><span></span>'
                                        
                                      ]);


                              }

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');


        },
        error: function(){
          alert('failure');
        }
    });


    //Guardar nota
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

            $fila = "<tr id=tr_"+nota.id+">"+
                       "<td>"+nota.sección+"</td>"+
                       "<td>"+nota.nombre+"</td>"+
                       "<td><span class='hidden'>"+nota.created_at+"</span>"+nota.texto+"</td>"+
                       "<td><span class='acc'><span class='editar-n btn btn-info' href='#actualizarnota' data-toggle='modal' value="+nota.id+"><span class='glyphicon glyphicon-edit'></span></span><span href='#eliminarnota' data-toggle='modal' class='delete-n btn btn-danger' value="+nota.id+"><span class='glyphicon glyphicon-trash'></span><span></span></td>"+
                    "</tr>";

            $('tbody').prepend($fila);

             $('#seccion').val(" ");
             $('#nota').val(" ");
             $('#contenido').val(" ");

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

    //Eliminar nota
    $(document).on('click', '.delete-n', function(){
      id = $(this).attr('value');
      $('#eliminar-nota').attr('value', id);
    });
    
    
    $(document).on('click', '#eliminar-nota', function(){
      id = $(this).attr('value');

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

    //Ediar nota
    $(document).on('click', '.editar-n', function(){
      id = $(this).attr('value');
      $('#actualizar-nota').attr('value', id);
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

            $('#tr_'+id).replaceWith('<tr id="tr_'+a.id+'">'+
                '<td>'+a.sección+'</td>'
                +'<td>'+a.nombre+'</td>'
                +'<td><span class="hidden">'+a.created_at+'</span>'+a.texto+'</td>'
                +'<td><span class="acc"><span class="editar-n btn btn-info" href="#actualizarnota" data-toggle="modal" value="'+a.id+'"><span class="glyphicon glyphicon-edit"></span></span>' + '<span href="#eliminarnota" data-toggle="modal" class="delete-n btn btn-danger" value="'+a.id+'"><span class="glyphicon glyphicon-trash"></span><span></span></td>'
                +'<tr/>'); 
            
        },
        error: function(){
          alert('failure');
        }
      });
      


    });
    
    



  });


  </script>

@stop
