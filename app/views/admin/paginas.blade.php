@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

{{ Html::style('lib/editor.css')  }}
{{ Html::script('lib/editor.js')  }}
{{ Html::style('lib/font-awesome-4.5.0/css/font-awesome.min.css')  }}

<style>

  #list_p__filter{
    display:none;
  }

  #list_p__length{
    display:none;
  }

  .breadcrumb{
    background:white;
    margin-top:.2em;
    margin-bottom:.2em;
  }

  .breadcrumb a{
    cursor:pointer;
  }

    /*--Modal imagen*/
#InsertImage .modal-body{
  overflow:hidden;
}


/*--Modal tablas*/
#InsertTable #tblForm{
  width:80%;
  margin:0 auto;
}

#tblAlign{
  margin-left:0;
}

#inputText{
  margin: 1.7em 1em 0 1em;
}



</style>

<script>
  $(document).ready(function(){

    $('.paginas').addClass('active');
    $('.t-paginas').addClass('en-admin');

    //Editor
    $("#gContenido").Editor();


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
        <h1 class="text-info text-center">Términos y condiciones.</h1>

        <section class="g-contenidos">
          <article class="contenidos">
              <div class="form-group form-terminos">
                <label for="terminos" class="text-primary">Descripción: </label>
               {{ Form::text('terminos', null,  array('class' => 'form-control', 'id' => 'terminos')) }}
            </div>
            <div class="form-group">
              <label for="gContenido" id="txtgContenido" class="text-primary">Contenido: </label>
              <textarea id="gContenido"></textarea> 
             </div>
             <button id="save-contenido" class="btn btn-primary g-contenido">Guardar y publicar</button>
             <button id="limpiar-contenido" class="btn btn-danger">Limpiar</button>
          </article>
          <article class="estatus-contenidos">
            <table id="list_p_" class="table-estatus-c">
              <thead>
                <tr>
                  <th></th>
                </tr>
              </thead>
            </table>
          </article>
        </section>

  </div>
</div>

<!--Alertas-->
<div class="notifications top-right" data-html="true"></div>

    <!--  Modal para confirmar guardar Terminos y condiciones  -->
<div id="guardart" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Guardar términos y condiciones
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas guardar este contenido?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="guardar-t" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


        <!--  Modal para publicar Terminos y condiciones  -->
<div id="publicart" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Publicar términos y condiciones
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Desea publicar este contenido?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="publicar-t" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>



    <!--  Modal para confirmar eliminar Terminos y condiciones  -->
<div id="eliminart" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              Eliminar términos y condiciones
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar este contenido?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="eliminar-t" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>

        <!--  Modal para actualizar Terminos y condiciones  -->
<div id="edit-t" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
             <span class="glyphicon glyphicon-edit"></span>
              Actualizar términos y condiciones
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas actualizar este contenido?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="act-t" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>

  <script>

  $(document).ready(function(){

    $(document).on('click', '.head-t', function(){
      $(".content-t").slideUp();
      if(!$(this).next().is(":visible")){
            $(this).next().slideDown();
          }
    });


    //Listar terminos y condiciones
      $.ajax({
        url:'/paginas/listarterminos',
        dataType: 'json',
        success: function(t){
          console.log(t);
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
                     $(nRow).attr('id', "tr_"+t[i].id);
                               
                },


                "aaSorting": [[ 0, "desc" ]], 


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });

            tabla_n.fnClearTable();
         
                      for(var i = 0; i < t.length; i++) {
                             tabla_n.fnAddData([
                                        '<span class="hidden">'+t[i].created_at+'</span><div class="head-t">'+t[i].descripción+'</div><div class="content-t"><ol class="breadcrumb"><li><a class="usar-p p_'+t[i].estatus+' " value="'+t[i].id+'">Publicar</a></li><li><a class="edit-p" value="'+t[i].id+'">Editar</a></li><li><a class="delete-t estatus_'+t[i].estatus+' " value="'+t[i].id+'">Eliminar</a></li></ol>'+t[i].texto+'</div>',
                                                                            
                                        
                                      ]);


                              }

                              $('.estatus_1').removeClass('delete-t');
                              $('.estatus_1').addClass('c-activo'); 
                              $('.p_1').removeClass('usar-p');

        },
        error: function(){
          alert('failure');
        }
    });


        $(document).on('click', '.c-activo', function(){
          alertas('error',"No puedes eliminar un contenido activo.");
        });

        $(document).on('click', '.p_1', function(){
           alertas('error',"Ya esta publicado.");
        });


        //Validaciones para los campos del editor de contenidos
    $("#save-contenido").click(function () {

      if($("#terminos").val().length == 0){
              alertas('error',"Agrega la descripción");
              return false;

      } else if($(".Editor-editor").html().length == 0){
              alertas('error',"Agrega el contenido");
              return false;

      }  else {
          return true;
      }
});


   


    //Guardar contenido
    $(document).on('click', '#save-contenido', function(){
      $('#guardart').modal({
        show: 'false',
      });

    });
    
    $(document).on('click', '#guardar-t', function(){
      desc = $('#terminos').val();
      contenido = $('.Editor-editor').html();
      $.ajax({
        url:'/paginas/savepagina',
        type: 'POST',
        data: {desc: desc, contenido: contenido},
        success: function(t){
          console.log(t);

          /*-__Listamos tambien el viejo contenido__-*/

          $fila = "<tr id=tr_"+t.id+">"+ 
                       "<td><span class='hidden'>"+t.created_at+"</span><div class='head-t'>"+t.descripción+"<span class='ac-estatus estatus_"+t.estatus+" '></span></div><div class='content-t'><ol class='breadcrumb'><li><a value="+t.id+" class='usar-p p_"+t.estatus+" ' >Publicar</a></li><li><a class='edit-p' value="+t.id+" >Editar</a></li><li><a class='delete-t estatus_"+t.estatus+" ' value="+t.id+">Eliminar</a></li></ol>"+t.texto+"</div></td>"+
                    "</tr>";

            $('tbody').prepend($fila);

            $('#terminos').val(' ');
            $('.Editor-editor').html(' ');
          
            $('.estatus_1').removeClass('delete-t');
            $('.estatus_1').addClass('c-activo'); 
            $('.p_1').removeClass('usar-p');

            $('.estatus_0').addClass('delete-t');  
            $('.estatus_0').removeClass('c-activo'); 
            $('.p_0').addClass('usar-p');
        },
        error: function(){
          alert('failure');
        }
    });

    });

    //Eliminar contenido
    $(document).on('click', '.delete-t', function(){
      id = $(this).attr('value');
      
      $('#eliminar-t').attr('value', id);

      $("#eliminart").modal({
        show: 'false',
      });

    });

    //Confirmar la eliminacion
    $(document).on('click', '#eliminar-t', function(){
      id = $(this).attr('value');

      $.ajax({
        type: 'GET',
        url: '/paginas/eliminarpagina',
        data:{id: id},
        success: function(d){
          $('#tr_'+id).remove();
        },
        error: function(){
          alert('failure');
        }
      });

    });

    //Editar pagina
    $(document).on('click', '.edit-p', function(){
      id = $(this).attr('value');
      $('.g-contenido').attr('value', id);
      $.ajax({
        type: 'GET',
        url: '/paginas/editarpagina',
        data: {id: id},
        success: function(e){
          $('#terminos').val(e.descripción);
          $('.Editor-editor').html(e.texto);
          $('.g-contenido').text('Actualizar y publicar');
          $('.g-contenido').attr('id', 'actualizar_c');
        }
      });

    });

    //Verificamos que los campos no esten vacios
    $("#actualizar_c").click(function () {

        if($("#terminos").val().length == 0){
                alertas('error',"Agrega la descripción");
                return false;

        } else if($(".Editor-editor").html().length == 0){
              alertas('error',"Agrega el contenido");
              return false;

      }  else {
            return true;
        }
   });

    //Llamar al modal
    $(document).on('click', '#actualizar_c', function(){
      id = $(this).attr('value');

      $('#act-t').attr('value', id);

      $('#edit-t').modal({
        show: 'false',
      });


    });

    //Confirmar actualizar pagina
    $(document).on('click', '#act-t', function(){
      id = $(this).attr('value');
      desc = $('#terminos').val();
      contenido = $('.Editor-editor').html();

      $.ajax({
        type: 'POST',
        url: '/paginas/actualizarpagina',
        data: {id: id, desc: desc, contenido: contenido },
        success: function(a){
          console.log(a);

          $('#tr_'+a.id).replaceWith('<tr id="tr_'+a.id+'">'+
                "<td><span class='hidden'>"+a.created_at+"</span><div class='head-t'>"+a.descripción+"<span class='ac-estatus estatus_"+a.estatus+" '></span></div><div class='content-t'><ol class='breadcrumb'><li><a value="+a.id+" class='usar-p'>Publicar</a></li><li><a class='edit-p' value="+a.id+" >Editar</a></li><li><a class='delete-t estatus_"+a.estatus+" ' value="+a.id+">Eliminar</a></li></ol>"+a.texto+"</div></td>"
                +'<tr/>');

         $('#terminos').val(' ');
         $('.Editor-editor').html(' ');

        $('.g-contenido').text('Guardar y publicar');
        $('.g-contenido').attr('id', 'save-contenido');

       // $('.estatus_1').removeClass('delete-t');


        }

      });

    });

    //Limpiar contenido del editor de contenidos
    $(document).on('click', '#limpiar-contenido', function(){

         $('#terminos').val(' ');
         $('.Editor-editor').html(' ');

        $('.g-contenido').text('Guardar y publicar');
        $('.g-contenido').attr('id', 'save-contenido');

    });

    //Usar un contenido existente
    $(document).on('click', '.usar-p', function(){
      id = $(this).attr('value');
      $('#publicar-t').attr('value', id);
      $('#publicart').modal({
        show:'false',
      });
    });

   $(document).on('click', '#publicar-t', function(){
    id = $(this).attr('value');

      $.ajax({
        type: 'POST',
        url: '/paginas/usarpagina',
        data: {id: id, },
        success: function(a){
          console.log(a);

          $('#tr_'+a.id).replaceWith('<tr id="tr_'+a.id+'">'+
                "<td><span class='hidden'>"+a.created_at+"</span><div class='head-t'>"+a.descripción+"<span class='ac-estatus estatus_"+a.estatus+" '></span></div><div class='content-t'><ol class='breadcrumb'><li><a value="+a.id+" class='usar-p'>Publicar</a></li><li><a class='edit-p' value="+a.id+" >Editar</a></li><li><a class='delete-t estatus_"+a.estatus+" ' value="+a.id+">Eliminar</a></li></ol>"+a.texto+"</div></td>"
                +'<tr/>');


        //$('.estatus_1').removeClass('delete-t');


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




  </script>

@stop
