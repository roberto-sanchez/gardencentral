$(document).ready(function(){
    //Listar domicilios
     dom = $('#dom_c');

            $.ajax({
                type: "GET",
                url: "productos/listardomicilios",
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
                url: "productos/listardomicilios",
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
                url: "productos/listartelefonos",
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
          $.ajax({
                type: "GET",
                url: "/productos/listnotas",
                success: function (nota) {

                   if(nota.texto == undefined){

                   } else {
                

                   $('.alert-n_p').show();
                   $('#nota_pedidos').text(nota.texto);

                   }


        },

        error: function () {
            alert("failure");
        }
    });



});/*Function ready*/