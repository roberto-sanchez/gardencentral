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

    domxs = $('#dom_cxs');

            $.ajax({
                type: "GET",
                url: "/productos/listardomicilios",
                success: function (domi) {
                    d = "";
        //comprobamos si existen domicilios
        if (domi.direc.length) {


            for(datos in domi.direc){

                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td><div class="text-acc text-info">Acciones</div><span class="acc"><button title="Usar este domicilio" id="btn_Use" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-default usar-d"><span class="cambiar-g glyphicon glyphicon-off" ></span></button>';
                    d += '<button title="Editar domicilio" id="btn_Update" href="#updateadress" data-toggle="modal" data-id="'+domi.direc[datos].tipo+'" value="'+domi.direc[datos].id+'" class="update-ad btn btn-primary"><span class="glyphicon glyphicon-refresh" ></span></button>';
                    d += '<button href="#confirm-delete" title="Eliminar domicilio" id="btn_Delete" data-toggle="modal" data-id="btn_E'+domi.direc[datos].id+'" value="'+domi.direc[datos].id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove" ></span></button></span></td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>País: '+domi.direc[datos].pais+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Estado: '+domi.direc[datos].estados+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Municipio: '+domi.direc[datos].municipio+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Calle 1: '+domi.direc[datos].calle1+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Calle 2: '+domi.direc[datos].calle2+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Colonia: '+domi.direc[datos].colonia+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Delegación: '+domi.direc[datos].delegacion+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>CP: '+domi.direc[datos].codigo_postal+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Teléfono: '+domi.direc[datos].numero+'</td></tr>';
                    d += '<tr class="direcc_'+domi.direc[datos].id+'"><td>Domicilio: '+domi.direc[datos].tipo+'</td></tr>';
                 }
                domxs.append(d);
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



//Agregar extras
$(document).on('click', '#env-extras', function(){
  $('#add-extras').hide();
  $('#add-extras').attr('data-id', '1');

  extra = $('#txt-extra').val();
  extrafila = extra.length;

  clave = $('#inp-extras').val();
  body = $('#b-extra');
  fila = "";

  fila += ' <tr id="fila_'+extrafila+'">'+
            '<td class="text-clave">'+clave+'</td>'+
            '<td class="text-contenido" id="cam_'+extrafila+'">'+extra+'</td>'+
            '<td class="td-btn">'+
               '<span id="'+extrafila+'" class="edit-extra btn btn-xs btn-info glyphicon glyphicon-edit" value="'+extra+'"></span>'
            +'</td>'+
            '<td>'+
              '<span class="quitarextra btn btn-xs btn-danger glyphicon glyphicon-remove" value="'+extrafila+'"></span>'
            '</td>'+
           '</tr>';

  body.append(fila);

  $('.t-ext').show();

  $('#txt-extra').val('');


});


//Eliminar extra
$(document).on('click', '.quitarextra', function(){
  $('#add-extras').attr('data-id', '0');
  nombre = $(this).attr('value');
  $('#add-extras').show();
  $('.t-ext').hide();
  $('#fila_'+nombre).remove();


});

//Editar extra
$(document).on('click', '.edit-extra', function(){

  extra = $(this).attr('value');
  id = $(this).attr('id');
  
   $('#modalextraedit').modal({
      show:'false',
    });

   $('#txt-extra-edit').text(extra);

   $('#env-extras-act').attr('data-id', id);

});


$(document).on('click', '#env-extras-act', function(){
  extraedit = $('#txt-extra-edit').val();
  id = $(this).attr('data-id');
  $('#cam_'+id).text(extraedit);
});





});/*Function ready*/


