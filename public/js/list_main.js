$(document).on('click', '#con-pd-cli', function(){
  $(".totalespedidoscliente").load(location.href+" .totalespedidoscliente>*","");
});


$(document).ready(function(){
    //Listar domicilios
     dom = $('#dom_c');

            $.ajax({
                type: "GET",
                url: "/productos/listardomicilios",
                success: function (domi) {
                    d = "";
        //comprobamos si existen domicilios
        if (domi.direc.length) {


            for(datos in domi.direc){

                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td><button id="btn_Use" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-default usar-d"><span class="cambiar-g glyphicon glyphicon-off" ></span></button></td>';
                    d += '<td>'+domi.direc[datos].pais+'</td>';
                    d += '<td>'+domi.direc[datos].estados+'</td>';
                    d += '<td>'+domi.direc[datos].municipio+'</td>';
                    d += '<td>'+domi.direc[datos].calle1+'</td>';
                    d += '<td>'+domi.direc[datos].calle2+'</td>';
                    d += '<td>'+domi.direc[datos].colonia+'</td>';
                    d += '<td>'+domi.direc[datos].delegacion+'</td>';
                    d += '<td>'+domi.direc[datos].codigo_postal+'</td>';
                    d += '<td>'+domi.direc[datos].numero+'</td>';
                    d += '<td>'+domi.direc[datos].tipo+'</td>';
                    d += '<td><button id="btn_Update" href="#updateadress" data-toggle="modal" data-id="'+domi.direc[datos].tipo+'" value="'+domi.direc[datos].id+'" class="update-ad btn btn-primary"><span class="glyphicon glyphicon-refresh" ></span></button></td>';
                    d += '<td><button href="#confirm-delete" title="Eliminar domicilio" id="btn_Delete" data-toggle="modal" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove" ></span></button></td></tr>';
                 }
                dom.append(d);
                $('.exist-dom').hide();
                //Si no existe ningun domiclio ocultamos el panel
            } else {
                $('.p-address').hide();
                $('.m-domicilios').hide();
            }



        },

        error: function () {
            alert("failure");
        }
    });


    //Listar telefonos del usuario
         tabalatel = $('#list-tel');

            $.ajax({
                type: "GET",
                url: "/productos/listartelefonos",
                success: function (t) {
                    tel = "";
        //comprobamos si existen domicilios
        if (t.telefono.length) {


            for(datos in t.telefono){

                    tel += '<tr class="telefono"><td>'+t.telefono[datos].numero+'</td>';
                    tel += '<td>'+t.telefono[datos].tipo_tel+'</td>';
                    tel += '<td><span id="btn_Use" data-id="'+t.telefono[datos].id+'" value="'+t.telefono[datos].id+'" class="btn-add-id btn btn-default"><span class="cambiar-t glyphicon glyphicon-off" ></span></span></td></tr>';
                 }
                tabalatel.append(tel);
                $('.telcliente').hide();
                $('.otrotel-c').hide();
                $('.phone-c').removeClass('tel-celular');
                $('.phone-f').removeClass('tel-fijo');
                $('.phone-o').removeClass('tel-otro');
                $('#conf-p').attr('href','#confirmartel');
            } else {
                $('.telclienteotro').hide();
                $('.t-oculto').hide();
                $('.text-oculto').hide();
            }



        },

        error: function () {
            alert("failure");
        }
    });

     //Listar notas aclaratorias
    contenedor = $('.list-n');
            seccion = 'Pedidos';
          $.ajax({
                type: "GET",
                url: "/productos/listnotas",
                data:{seccion: seccion},
                success: function (n) {
                    no = "";
                    for(datos in n.nota){

                    no += '<li class="text-info"><span>'+n.nota[datos].texto+'</span></li>';
                 }
                
                   contenedor.append(no);

                   


        },

        error: function () {
            alert("failure");
        }
    });



    $('.logout').attr('class', 'l_vaciar');

    $(document).on('click', '.l_vaciar', function(){


      $.ajax({
            type: "POST",
            url: "/productos/vaciar",
            success: function (v) {
                //$('.panel-datos').hide();
                //$("#t-pedidoc").load(location.href+" #t-pedidoc>*","");
                window.location = window.location.href = '/logout';
            },
            error: function () {
                alert('failure');
            }
        });

    });


  //Validaciones al agregar un extra
  $("#env-extras").click(function () {

      if($("#txt-extra").val().length == 0){
              $('.error-c').addClass('has-error has-feedback');
              $('.icon-c').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      } else {
          return true;
      }
});

  $("#txt-extra").focus(function(){
    $('.error-c').removeClass('has-error has-feedback');
    $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');

  });


$(document).on('click', '#can-extras', function(){
  $("#txt-extra").val('');
  $('.error-c').removeClass('has-error has-feedback');
  $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');

});


  

  $(document).on('keyup', '#txt-extra', function(){
    extra = $('#txt-extra').val();
    $('#env-extras').attr('href', 'agregarextra/add/' + extra);
  });

  $(document).on('click', '.act-ext', function(){
    $('.icon-area').addClass('glyphicon glyphicon-remove form-control-feedback');
    $('.area-extra').addClass('has-error has-feedback');

  });

  $(document).on('keyup', '#txt-extra-edit', function(){
    $('#env-extras-act').removeClass('act-ext');
    $('.icon-area').removeClass('glyphicon glyphicon-remove form-control-feedback');
    $('.area-extra').removeClass('has-error has-feedback');
    extra = $('#txt-extra-edit').val();
    $('#env-extras-act').attr('href', 'extras/updateextra/' + extra);
  });





//Editar extra
$(document).on('click', '.edit-extra', function(){

  extra = $(this).attr('value');

  
   $('#modalextraedit').modal({
      show:'false',
    });

   $('#txt-extra-edit').text(extra);


});







});/*Function ready*/


