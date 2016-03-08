@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')


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
        <button href="#agregarnota" data-toggle="modal" class="btn btn-primary add-n">Agregar Nota</button>
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
              <select class="form-control" id="seccion">
                <option value="Pedidos">Pedidos</option>
                <option value="Detalle del pedido">Detalle del pedido</option>
                <option value="Términos y condiciones">Términos y condiciones</option>
              </select>
            </div>
            
            
            <div class="form-group error-n">
                <label for="nota" class="text-primary">Nota: </label>
               {{ Form::text('nota', null,  array('class' => 'form-control', 'id' => 'nota', 'placeholder' => 'Nombre de la nota')) }}
               <span class="icon-n"></span>
            </div>

            <div class="area-nota error-c">
              <label class="text-primary">Contenido: </label>
              <textarea class="form-control" rows="5" id="contenido" placeholder="Contenido de la nota..."></textarea>
              <span class="icon-c"></span>
            </div>
            
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="cancelar-n" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="save-nota" class="btn btn-primary confirm" data-dismiss="modal" >Guardar y publicar</span>
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
              <label for="seccionedit" class="text-primary">Sección: </label>
              <select class="form-control" id="seccionedit">
                <option value="Pedidos">Pedidos</option>
                <option value="Detalle del pedido">Detalle del pedido</option>
                <option value="Términos y condiciones">Términos y condiciones</option>
              </select>
            </div>
            

            <div class="form-group error-n">
                <label for="nota" class="text-primary">Nota: </label>
               {{ Form::text('nota', null,  array('class' => 'form-control', 'id' => 'notaedit')) }}
               <span class="icon-n"></span>
            </div>

            <div class="area-nota error-c">
              <label class="text-primary">Contenido: </label>
              <textarea class="form-control" rows="5" id="contenidoedit" placeholder="Contenido de la nota..."></textarea>
              <span class="icon-c"></span>
            </div>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="n-act" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="actualizar-nota" class="btn btn-primary confirm" data-dismiss="modal" >
                 Actualizar
                 <span class="glyphicon glyphicon-refresh"></span>
              </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal publicar nota -->
    <div id="publicar_n" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Publicar Nota
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas publicar esta nota?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="public-nota" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>

        <!-- Modal despublicar nota -->
    <div id="no-publicar" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Publicar Nota
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas desactivar esta nota?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="no-public-nota" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
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
                                        '<span class="acc"><span id="not_'+n[i].id +'" data-id="'+n[i].sección +'" class="usar-n btn btn-default usar_'+n[i].estatus+' " value="'+n[i].id+'"><span class=""></span></span><span class="editar-n btn btn-info" href="#actualizarnota" data-toggle="modal" value="'+n[i].id+'"><span class="glyphicon glyphicon-edit"></span></span>' + '<span href="#eliminarnota" data-toggle="modal" class="delete-n btn btn-danger" value="'+n[i].id+'"><span class="glyphicon glyphicon-trash"></span><span></span>'
                                        
                                      ]);


                              }

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

    $('.usar_1').addClass('glyphicon glyphicon-ok');
    $('.usar_1').addClass('btn-success');
    $('.usar_1').attr('title', 'Desactivar nota');
    $('.usar_1').removeClass('usar-n');
    $('.usar_1').addClass('no-usar');

    $('.usar_0').addClass('glyphicon glyphicon-off');
    $('.usar_0').addClass('btn-default');
    $('.usar_0').attr('title', 'Publicar esta nota');

        },
        error: function(){
          alert('failure');
        }
    });


    //Validaciones para las notas
    $("#save-nota").click(function () {

      if($("#seccion").val().length == 0){
              $('#seccion').addClass('has-error');
              return false;

      } else if($("#nota").val().length == 0){
              $('.error-n').addClass('has-error has-feedback');
              $('.icon-n').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      } else if($("#contenido").val().length == 0){
              $('.error-c').addClass('has-error has-feedback');
              $('.icon-c').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

    $("#nota").focus( function(){
        $('.error-n').removeClass('has-error has-feedback');
        $('.icon-n').removeClass('glyphicon glyphicon-remove form-control-feedback');
    });

    $("#contenido").focus(function(){
        $('.error-c').removeClass('has-error has-feedback');
        $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');
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

            $fila = "<tr id=tr_"+nota.c[0].id+">"+
                       "<td>"+nota.c[0].sección+"</td>"+
                       "<td>"+nota.c[0].nombre+"</td>"+
                       "<td><span class='hidden'>"+nota.c[0].created_at+"</span>"+nota.c[0].texto+"</td>"+
                       "<td><span class='acc'><span id='not_"+nota.c[0].id+"' data-id='"+nota.c[0].sección+"' class='no-usar btn-default usar_"+nota.c[0].estatus+" ' value="+nota.c[0].id+"><span class=''></span></span><span class='editar-n btn btn-info' href='#actualizarnota' data-toggle='modal' value="+nota.c[0].id+"><span class='glyphicon glyphicon-edit'></span></span><span href='#eliminarnota' data-toggle='modal' class='delete-n btn btn-danger' value="+nota.c[0].id+"><span class='glyphicon glyphicon-trash'></span><span></span></td>"+
                    "</tr>";

            $('tbody').prepend($fila);

            //Remplazamos los datos en la fila antigua
            $('#not_'+nota.o.id).removeClass('usar_1');
            $('#not_'+nota.o.id).removeClass('glyphicon glyphicon-ok');
            $('#not_'+nota.o.id).removeClass('btn-success');
            $('#not_'+nota.o.id).removeClass('no-usar');

            $('#not_'+nota.o.id).addClass('usar_0');
            $('#not_'+nota.o.id).addClass('glyphicon glyphicon-off');
            $('#not_'+nota.o.id).attr('title', 'Publicar esta nota');
            $('#not_'+nota.o.id).addClass('btn-default');
            $('#not_'+nota.o.id).addClass('usar-n');


             $('#nota').val(" ");
             $('#contenido').val(" ");

             $('.usar_1').addClass('glyphicon glyphicon-ok');
             $('.usar_1').addClass('btn btn-success');
             $('.usar_1').attr('title', 'Desactivar nota');

             $('.usar_0').addClass('glyphicon glyphicon-off');
             $('.usar_0').addClass('btn btn-default');
             $('.usar_0').attr('title', 'Publicar esta nota');

        },
        error: function(){
          alert('failure');
        }
      }); 

    });


    //Cancelar guardar nota  
    $(document).on('click', '#cancelar-n', function(){

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

        //Validaciones al actualizar las notas
    $("#actualizar-nota").click(function () {

      if($("#seccionedit").val().length == 0){
              return false;

      } else if($("#notaedit").val().length == 0){
              $('.error-n').addClass('has-error has-feedback');
              $('.icon-n').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      } else if($("#contenidoedit").val().length == 0){
              $('.error-c').addClass('has-error has-feedback');
              $('.icon-c').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      }  else {
          return true;
      }
});

    $("#notaedit").focus( function(){
        $('.error-n').removeClass('has-error has-feedback');
        $('.icon-n').removeClass('glyphicon glyphicon-remove form-control-feedback');
    });

    $("#contenidoedit").focus(function(){
        $('.error-c').removeClass('has-error has-feedback');
        $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');
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
                +'<td><span class="acc"><span id="not_'+a.id+'" data-id="'+a.sección+'" class="usar-n btn btn-default usar_'+a.estatus+' " href="#usarnota" data-toggle="modal" value="'+a.id+'"><span class=""></span></span><span class="editar-n btn btn-info" href="#actualizarnota" data-toggle="modal" value="'+a.id+'"><span class="glyphicon glyphicon-edit"></span></span>' + '<span href="#eliminarnota" data-toggle="modal" class="delete-n btn btn-danger" value="'+a.id+'"><span class="glyphicon glyphicon-trash"></span><span></span></td>'
                +'<tr/>'); 

             $('.usar_1').addClass('glyphicon glyphicon-ok');
             $('.usar_1').addClass('btn btn-success');
             $('.usar_1').attr('title', 'Desactivar nota');

             $('.usar_0').addClass('glyphicon glyphicon-off');
             $('.usar_0').addClass('btn btn-default');
             $('.usar_0').attr('title', 'Publicar esta nota');
            
        },
        error: function(){
          alert('failure');
        }
      });


      


    });
    
      //Publicar nota
      $(document).on('click', '.usar-n', function(){
        id = $(this).attr('value');
        seccion = $(this).attr('data-id');

        $('#public-nota').attr('value', id);
        $('#public-nota').attr('data-id', seccion);
        $('#publicar_n').modal({
          show: 'false',
        });
      });

      $(document).on('click', '#public-nota', function(){
          id = $(this).attr('value');
          seccion = $(this).attr('data-id');
          p = 1;

     $.ajax({
        url: '/notas/publicarnota',
        type: 'GET',
         data: {id: id, seccion: seccion, p: p},
        success: function(nota){

            //Actualizamos los datos
            $('#not_'+nota.c[0].id).removeClass('usar_0');
            $('#not_'+nota.c[0].id).removeClass('glyphicon glyphicon-off');
            $('#not_'+nota.c[0].id).removeClass('btn-default');
            $('#not_'+nota.c[0].id).removeClass('usar-n');

            $('#not_'+nota.c[0].id).addClass('usar_1');
            $('#not_'+nota.c[0].id).addClass('glyphicon glyphicon-ok');
            $('#not_'+nota.c[0].id).attr('title', 'Desactivar nota');
            $('#not_'+nota.c[0].id).addClass('btn-success');
            $('#not_'+nota.c[0].id).addClass('no-usar');

            //Remplazamos los datos en la fila antigua
            $('#not_'+nota.o.id).removeClass('usar_1');
            $('#not_'+nota.o.id).removeClass('glyphicon glyphicon-ok');
            $('#not_'+nota.o.id).removeClass('btn-success');
            $('#not_'+nota.o.id).removeClass('no-usar');

            $('#not_'+nota.o.id).addClass('usar_0');
            $('#not_'+nota.o.id).addClass('glyphicon glyphicon-off');
            $('#not_'+nota.o.id).attr('title', 'Publicar esta nota');
            $('#not_'+nota.o.id).addClass('btn-default');
            $('#not_'+nota.o.id).addClass('usar-n');
            
        },

        error: function(){
          alert('failure');
        }
      });

      });


      //Despublicar nota
      $(document).on('click', '.no-usar', function(){
        id = $(this).attr('value');

        $('#no-public-nota').attr('value', id);

        $('#no-publicar').modal({
          show: 'false',
        });
      });

      $(document).on('click', '#no-public-nota', function(){
        id = $(this).attr('value');
        p = 2;

      $.ajax({
        url: '/notas/publicarnota',
        type: 'GET',
         data: {id: id, p: p},
        success: function(nota){

            $('#not_'+nota.c[0].id).removeClass('usar_1');
            $('#not_'+nota.c[0].id).removeClass('glyphicon glyphicon-ok');
            $('#not_'+nota.c[0].id).removeClass('btn-success');
            $('#not_'+nota.c[0].id).removeClass('no-usar');

            $('#not_'+nota.c[0].id).addClass('usar_0');
            $('#not_'+nota.c[0].id).addClass('glyphicon glyphicon-off');
            $('#not_'+nota.c[0].id).attr('title', 'Publicar esta nota');
            $('#not_'+nota.c[0].id).addClass('btn-default');
            $('#not_'+nota.c[0].id).addClass('usar-n');

            
            
        },

        error: function(){
          alert('failure');
        }
      });

      });
    



  });




  </script>

@stop
