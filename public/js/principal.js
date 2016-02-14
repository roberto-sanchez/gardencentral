$(document).ready(function () {

    $('.cerrar-alert').click(function () {
        $('.mialert').hide();
        $('.msjdanger').text('');
    });

    $('.cerrar-alert2').click(function () {
        $('.mialert2').hide();
        $('.mialert3').hide();
    });

    $('#clave').focus(function () {
        $('#clave').attr('value', '');
    });
    $('#clave').blur(function () {
        $('#clave').attr('value', 'Clave del producto');
    });

    $('#searchForm').on('submit', function () {
        return false;
    });

    $('#btn_search').click(function () {
        if ($('#clave').val() == '' || $('#clave').val() == 'Clave del producto') {
            noexiste = [[ 'top', 'danger',  "Escribe la clave del producto." ]];
            message = noexiste[Math.floor(Math.random() * noexiste.length)];

            $('.' + message[0]).notify({
                message: { text: message[2] },
                type: message[1]
            }).show();
        } else {
            $.ajax({
                type: "POST",
                url: "productos/getProducto",
                data: {clave: $('#clave').val()},
                success: function (prod) {
                    ver = prod.id;
                    if (ver === undefined) {
                        $('#productoPanel').hide();

                        noexiste = [[ 'top', 'danger',  "El producto no existe." ]];
                        message = noexiste[Math.floor(Math.random() * noexiste.length)];

                        $('.' + message[0]).notify({
                            message: { text: message[2] },
                            type: message[1]
                        }).show();

                        $('#noexiste').html(prod.indefinido);
                    } else {
                        $('#productoPanel').slideDown(1000);
                        //$('#idProd').attr('value', prod.id );
                        //$('#idProd').attr('href', 'productos/datosdelpedido/' +prod.id );
                        $('.idProd').attr('id', 'product_' + prod.id);
                        $('.idProd2').attr('id', +prod.id);
                        // $('#claveProd').attr('href', 'productos/add/'+prod.clave );
                        $('.claveProd').attr('href', 'productos/add/' + prod.clave);
                        //$('#claveProd').attr('value', prod.clave );
                        $('#nombreProd').html(prod.nombre); //mostramos el nombre del producto
                        $('#imagenProd').prop('src', 'img/productos/' + prod.foto); //la imagen
                        $('#colorProd').html(prod.color); //el color
                        $('#piezasProd').html(prod.piezas_paquete);
                        $('#precioProd').html(accounting.formatMoney(prod.precio_venta));
                        $('.mialert').hide();
                        $('.mialert2').hide();
                        $('#noexiste').text('');
                    }

                },
                error: function (noexiste) {
                    alert("failure");
                }
            });
        }

    });


    /**
     * La function trim eliminar los espacios en blanco que esten al principio y al final del contenido del campo.
     * La funcion indexOf() verifica que el campo no solo este conformado por espacios
     */


/*
$(document).on('click', '.idProd2', function(){
    if($('.idProd').val() == 0){
        $('.claveProd').removeClass('btn-update-p');
        $('.mialert3').show();
        alert('esta vacio');
    } else {
        $('.claveProd').addClass('btn-update-p');
        $('.mialert3').hide();
        alert('No esta vacio');
    }
});
*//*
$(document).on('click', '.idProd2', function(){
   if($('.idProd').val() == 0){
    $('.claveProd').addClass('disabled');
       $('.claveProd').removeClass('btn-update-p');
        $('.claveProd').removeAttr('href');
    alert('XD');
    } else{
      alert('no esta vacio');
  }

});*/

    $('#agregarproducto').keypress(function (e) {
        $('.idProd2').removeClass('disabled');
    });

    $('.ingresar-p').click(function () {

        if ($('.idProd').val() == '') {

            noexiste = [[ 't', 'danger',  "Ingrese la cantidad de paquetes." ]];
                message = noexiste[Math.floor(Math.random() * noexiste.length)];

                $('.' + message[0]).notify({
                    message: { text: message[2] },
                    type: message[1]
                }).show();
            return false;

        }

    });

    $('.idProd').click(function () {

        if ($('.idProd').val() == '') {

        } else {

            $('.idProd2').removeClass('disabled');

        }

    });

//Sumar productos al pedido
$(".btn-update-sum").click(function (e) {
    idt = $(this).attr('id');
    valor = $('.cant_'+idt).val();

    /*Comprovamos si el producto es ingresado por
     *primera ves, osea si esta vacio.
    */
    if(valor == undefined){
        vacio = 0;
        e.preventDefault();
        parseInt(id = $(this).attr('id'));

        href = $(this).attr('href');
        quantity = $('#product_' + id).val();
         vacio += parseInt(quantity);
        window.location.href = href + "/" + vacio;
        //Si no esta vacio se le suma la cantidad ya existente
    } else{
        valorA = parseInt($('.cant_'+idt).val());
        e.preventDefault();
        parseInt(id = $(this).attr('id'));

        href = $(this).attr('href');
        quantity = $('#product_' + id).val();
        valorA += parseInt(quantity);
        window.location.href = href + "/" + valorA;
    }

    });


    //actualizamos la cantidad del producto
    $(".btn-update-p").click(function (e) {
        e.preventDefault();
        id = $(this).attr('id');
        href = $(this).attr('href');
        quantity = $('#product_' + id).val();
        window.location.href = href + "/" + quantity;
    });

    //actualizamos la cantidad del producto en movil
    $(".btn-update-pxs").click(function (e) {
        e.preventDefault();
        id = $(this).attr('id');
        href = $(this).attr('href');
        quantity = $('#productxs_' + id).val();
        window.location.href = href + "/" + quantity;
    });


    //Vaciar pedido ----------
    $('#v-pedido').click(function(){

      $.ajax({
            type: "POST",
            url: "/productos/vaciar",
            success: function (v) {
                //$('.panel-datos').hide();
                $("#t-pedidoc").load(location.href+" #t-pedidoc>*","");

            },
            error: function () {
                alert('failure');
            }
        });

  });

//Eliminar producto del carrito
    $(document).on('click', '.delete-p', function(){
      id = $(this).attr('value');
      clave = $(this).attr('data-id');

      $.ajax({
            type: "POST",
            url: "/productos/delete/"+clave,
            success: function (d) {
                $("#t-pedidoc").load(location.href+" #t-pedidoc>*","");

            },

            error: function () {
                alert('failure');
            }
        });

  });


//Ver foto del producto del pedido
$(document).on('click', '.verfotop', function(){
    foto = $(this).attr('id');
    nombre = $(this).attr('data-id');
    $('#fotopro').prop('src','img/productos/'+foto);
    $('.t-foto').text(nombre);
    $('#verfoto-p').modal({
            show: 'false'
     });


});



    // ---------- Editar el dimicilio -------------
    //Restablecemos el campo select, si el cliente decite no actualizar el dom
    $(document).on('click','#cancel-u', function(){
        $('#tipoedit').prop('selectedIndex',0);
    });

      //Cargar datos en el modal de editar domicilio
      $(document).on('click', '.update-ad', function(){
           uddom = $(this).val();
           tipodom = $(this).attr('data-id');
           $("#t-dom").val(tipodom);
           $('#iddom').val(uddom);
           $('#acttualizar-dom').attr('data-id',uddom);

           es = $('#listestados');
           mun = $('#select-muni');
           //$('#listestados').select2();

        $.ajax({
            type: "GET", //metodo
            url: "productos/editar/"+uddom,
            data: {uddom: uddom},
             success: function (dom) {

             /*Cargamos los datos correspondientes de cada input*/
                $('#select-p').html(dom[0].pais);
               $('#select-p').val("1");

               $('#select-est').html(dom[0].estados);
               $('#select-est').val(dom[0].id);

               $('#select-muni').html(dom[0].municipio);

               $('#calle1edit').val(dom[0].calle1);
               $('#calle2edit').val(dom[0].calle2);
               $('#coloniadit').val(dom[0].colonia);
               $('#delegacionedit').val(dom[0].delegacion);
               $('#cpedit').val(dom[0].codigo_postal);
               $('#teledit').val(dom[0].numero);

               $('#tipotel').val(dom[0].tipo_tel);
               $('#tipotel').text(dom[0].tipo_tel);

                if(dom[0].tipo_tel == 'Celular'){
                $('#otrotel').val('Fijo');
                $('#otrotel').text('Fijo');

                $('#otrotel2').val('Otro');
                $('#otrotel2').text('Otro');

               } else if(dom[0].tipo_tel == 'Fijo'){
                $('#otrotel').val('Celular');
                $('#otrotel').text('Celular');

                $('#otrotel2').val('Otro');
                $('#otrotel2').text('Otro');

               } else if(dom[0].tipo_tel == 'Otro'){
                $('#otrotel').val('Celular');
                $('#otrotel').text('Celular');

                $('#otrotel2').val('Fijo');
                $('#otrotel2').text('Fijo');
               }


               //Accedemos al id del estado
               f = "";

               for(datos in dom.muni){
                f += dom.muni[datos].id;
             }

             mun.val(f);

           /*----Cargamos todos los estados--------*/
             e = "";

             for(datos in dom.estado){
                e += '<option value="'+dom.estado[datos].id+'">'+dom.estado[datos].estados+'</option>';
             }

             es.append(e);
            },

            error: function () {
                alert("failure");
            }
          });


        });


    //Cargar municipios de el estado a editar
    $("#listestados").change(function (event) {

        id = $("#listestados").val();
        mu = $('#municipioedit');
        $.ajax({
            type: "GET",
            url: "productos/estado/"+id,

          }).done(function (muni) {
            $('#municipioedit').html('');
            $('#municipioedit').append($('<option></option>').text('Seleccione un municipio').val(''));
            $.each(muni, function (i) {
                m = "";

             for(datos in muni.municipio){
                m += '<option value="'+muni.municipio[datos].id+'">'+muni.municipio[datos].municipio+'</option>';
             }

             mu.append(m);
            });

        });

    });


//Validaciones para el formulario de editar domicilio
  $("#acttualizar-dom").click(function () {


   expr = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;

   if($("#calle1edit").val().length <= 3){
            $('.calle1edit').addClass('has-error');
            return false;

    } else if($("#calle2edit").val().length <= 3){
            $('.calle2edit').addClass('has-error');
            return false;

    } else if($("#coloniadit").val().length <= 3){
            $('.coloniadit').addClass('has-error');
            return false;

    } else if($("#delegacionedit").val().length <= 3){
            $('.delegacionedit').addClass('has-error');
            return false;

    } else if(!expr.test($("#cpedit").val())){
            $('.cpedit').addClass('has-error');
            return false;

    }  else if($("#teledit").val().length <= 8){
            $('.teledit').addClass('has-error');
            return false;

    } /* else if($(".requerido").val().length <= 8){
            $('.tel1').addClass('has-error');
            return false;

    }*/ else {
        return true;
    }
});

 //validamos el telefono
       $('#teledit').keyup(function(){
        valor = $('#teledit').val();
        if(valor.length  <= 8 || /^\s+$/.test(valor)){
            $('.teledit').addClass('has-error');

         } else {
            $('.teledit').removeClass('has-error');

         }
    });


    //validamos la calle 1
    $('#calle1edit').keyup(function(){
        valor = $('#calle1edit').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.calle1edit').addClass('has-error');

         } else {
            $('.calle1edit').removeClass('has-error');

         }
    });

     //validamos la calle 2
    $('#calle2edit').keyup(function(){
        valor = $('#calle2edit').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.calle2edit').addClass('has-error');

         } else {
            $('.calle2edit').removeClass('has-error');

         }
    });

    //validamos la colonia
    $('#coloniadit').keyup(function(){
        valor = $('#coloniadit').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.coloniadit').addClass('has-error');

         } else {
            $('.coloniadit').removeClass('has-error');

         }
    });

        //validamos la delegacion
    $('#delegacionedit').keyup(function(){
        valor = $('#delegacionedit').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.delegacionedit').addClass('has-error');

         } else {
            $('.delegacionedit').removeClass('has-error');

         }
    });

    //Validamos el codigo postal
    $('#cpedit').keyup(function(){
      expr = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/; //expresion para validar el CP
      valor = $('#cpedit').val();
        if( !expr.test(valor) ){
            $('.cpedit').addClass('has-error');
         } else {
            $('.cpedit').removeClass('has-error');
         }
    });






/*Verificar disponibilidaddeñ telefono*/
 /*$('#teledit').keyup( function(){
    if($('#teledit').val() != ""){

         tel = $('#teledit').val().trim();
         //alert(pass);
        $.ajax({
            type: "POST",
            url: "productos/getVerificarTel",
             data: {tel: tel },
            success: function( t ){
                vt = t.numero;
                   if (vt === undefined) {
                      $('.tel1').removeClass('has-error');
                      $('.spanTel').removeClass('glyphicon-remove');
                      $('.tel1').addClass('has-success');
                      $('.spanTel').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#conf-p').removeClass('disabled');
                      $('.msgTeledit').html("");
                    } else {
                         $('.tel1').removeClass('has-success');
                         $('.spanTel').removeClass('glyphicon-ok');
                         $('.spanTel').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.tel1').addClass('has-error');
                         $('.msgTeledit').html("El teléfono ya existe, elige otro.");
                         $('#conf-p').addClass('disabled');
                }


            }
        });
     }
});
*/



    //Actualizar domicilio

  $(document).on('click','#acttualizar-dom', function(){


     pais = $('#paisedit').val();
   //  alert(pais);
     estado = $('#listestados').val();
    // alert(estado);
      municipio =  $('#municipioedit').val();
    //  alert(municipio);
      calle1 = $('#calle1edit').val();
    //  alert(calle1);
       calle2 = $('#calle2edit').val();
     //  alert(calle2);
       colonia = $('#coloniadit').val();
      // alert(colonia);
      delegacion =  $('#delegacionedit').val();
    //  alert(delegacion);
      cp =  $('#cpedit').val();
     // alert(cp);
      tel =  $('#teledit').val();
    //  alert(tel);
      tipodom = $('#t-dom').val();
    //  alert(tipodom);
      tipotel = $('#tipoedit').val();
     // alert(tipotel);
     id = $('#iddom').val();
   //  alert(id );

       $.ajax({
          url:  "productos/actualizar",
          type: "POST",
          data:{pais: pais, estado: estado, municipio: municipio, calle1: calle1, calle2: calle2, colonia: colonia, delegacion: delegacion, cp: cp, tel: tel, tipodom: tipodom, tipotel: tipotel, id: id},
          success: function (d){
            //$('.direcc_'+id).remove();

           //Creamos la fila y remplazamos los datos con los registros actualizados
            $('.direcc_'+id).replaceWith('<tr>'+
               '<td><button id="btn_Use" data-id="btn_E'+d.id+'" value="'+d.id+'" class="btn btn-default usar-d"><span class="cambiar-g glyphicon glyphicon-off" ></span></button></td>'
                +'<td>'+d.pais+'</td>'
                +'<td>'+d.estados+'</td>'
                +'<td>'+d.municipio+'</td>'
                +'<td>'+d.calle1+'</td>'
                +'<td>'+d.calle2+'</td>'
                +'<td>'+d.colonia+'</td>'
                +'<td>'+d.delegacion+'</td>'
                +'<td>'+d.codigo_postal+'</td>'
                +'<td>'+d.numero+'</td>'
                +'<td>'+d.tipo+'</td>'
                +'<td><button id="btn_Update" href="#updateadress" data-toggle="modal" data-id="'+d.tipo+'" value="'+d.id+'" class="update-ad btn btn-primary"><span class="glyphicon glyphicon-refresh" ></span></button></td>'
                +'<td><button href="#confirm-delete" title="Eliminar domicilio" id="btn_Delete" data-toggle="modal" data-id="btn_E'+d.id+'" value="'+d.id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove" ></span></button></td>'


                +'<tr/>');



          },
          error: function(){
            alert('failure');
          }

        });



    });




    //comprobamos que el cliente seleccione la forma de pago
    if($('.formapago').val() == null){
        $('.text-exito').hide();
        $('.text-pago').show();
        $('.confirm-p').addClass('disabled');
        $('.confirm-d').addClass('disabled');
        $('.c-no').hide();
        $('.c-pe').show();
        $('.regis-exixts-t').addClass('disabled');

    } else {
        $('.regis-exixts-t').removeClass('disabled');
        //$('.confirm-d').removeClass('disabled');
        //$('.text-pago').hide();
        //$('.text-exito').show();
        $('.confirm-p').removeClass('disabled');
    }

    $('.formapago').click(function(){
        id = $(this).val();
        forma = $('#text_'+id).text();
        $('.f-p').attr('value',id);
        $('.f-t').attr('value',forma);

      /*  if($('.formapago').val() != null){
            $('.confirm-p').removeClass('disabled');
            $('.confirm-d').removeClass('disabled');
             $('.regis-exixts-t').removeClass('disabled');
            $('.text-exito').show();
            $('.text-pago').hide();
            $('.text-selectdom').hide();
            $('.c-no').show();
            $('.c-pe').hide();
    } */

    });

        //comprobamos que se seleccione la forma de pago al generar el pedido
        $('#conf-p1').click(function(){
            if($('.formapago').val() != null){
                $('.confirm-d').removeClass('disabled');
                $('.text-exito').show();
                $('.text-pago').hide();
            }
        });



        $('#veri').click(function(){
        $.ajax({
            type: "POST",
            url: "productos/getVerificar",
          //  data: "nick="+$('#formUser').val(),
           /* beforeSend: function(){
              $('#msgUsuario').html('<img src="loader.gif"/> verificando');
            }, */
            success: function( respuesta ){
            /*  if(respuesta == '1')
                $('#msgUsuario').html("Disponible");
              else
                $('#msgUsuario').html("No Disponible"); */
            }
        });
    });




    //Eliminar domicilio
  $(document).on('click','#btn_Delete', function(){


    idd = $(this).val();
    $('#eliminar-address').attr('data-id',idd);

    $('#eliminar-address').click(function(){
        id = $(this).attr('data-id');

        $.ajax({
        url: "productos/eliminardomicilio",
        type: "DELETE",
        data: {idd: idd},
        success: function(di){ dom_c
          $('.direcc_'+id).remove();
        },

        error: function(){
          alert("failure");
        }
      });


    });

});

  $('.btn-conf-1').hide();

  $('#gen-c').click(function(){
     noexiste = [[ 'top-right', 'danger',  "Elige un domicilio!" ]];
    message = noexiste[Math.floor(Math.random() * noexiste.length)];

    $('.' + message[0]).notify({
        message: { text: message[2] },
        type: message[1]
    }).show();

  });

  $('.cerrar-divalert').click(function(){
    $('.mialert4').hide();
  });

   //Usar un domicilio existente
  $(document).on('click','.usar-d', function(){
        $('#gen-c').hide();
        $('.btn-conf-1').removeClass('disabled');
        $('.text-selectdom').hide();
        $('.regis-exixts-t').hide();
        $('#conf-p').addClass('hidden');
        $('#conf-p1').show();
        $('#conf-p').removeClass('ge-p');
        //$('.text-exito').show();
        //$('.text-pago').show();
        //$('.confirm-d').addClass('disabled');
        //$('.confirm-p').addClass('disabled');
       //Restablecer el campo select de la forma de pago
       // $('#formapago').prop('selectedIndex',0);
        $('.c-no').hide();
        $('.c-pe').show();

        //eliminamos las clases en los botones que no hacemos clic
        $('.usar-d').removeClass('btn-default');
        $('.usar-d').removeClass('btn-success');

        //eliminamos las clases en los span que no hacemos clic
        $('.cambiar-g').removeClass('glyphicon-ok');
        $('.cambiar-g').addClass('glyphicon-off');

        //Agregamos las clases en losspanq ue hacemos click
        $('.cambiar-g', this).addClass('glyphicon-ok');
        $('.cambiar-g', this).removeClass('glyphicon-off');

        //agregamos las clases en los botones que hacemos click
        $(this, '.usar-d').removeClass('btn-default');
        $(this, '.usar-d').addClass('btn-success');

        $('.domfiscal').hide(500);
        $('#checkfiscal').removeAttr('checked');
        $('#checkpersonal').removeAttr('checked');
        $('#checkpersonal').prop('disabled', false);
        $('#checkfiscal').prop('disabled', false);
        $('.domentrega1').removeClass('domentrega');
        $('.domentrega2').removeClass('domentrega');

        //Elegir un domicilio existente
        $('.confirm-p').hide();//ocultamos el btn si el cliente elgi un dom existente
        $('.confirm-d').show(); //mostramos el otro btn

        //obtenemos el valor del boton en el que hacemos click
        iddom = $(this).val();

        $('.confirm-d').attr('id', iddom);
        //$('.confirm-d').attr('href', 'productos/datosdelpedido/' + iddom);
        //alert($(this).val());  .fila_dom

    });



    //domicilio de entrega
    $('#checkdomicilio').click(function () {
        //$('.confirm-p').addClass('disabled');
       //Restablecer el campo select de la forma de pago
        //$('#formapago').prop('selectedIndex',0);
        $('.c-no').hide();
        $('.c-pe').show();

        $('.panel-entrega').slideToggle(1000);
        $('.text-selectdom').show();
    });

    $('#checkfiscal').click(function () {
        $('#gen-c').hide();
        $('.btn-conf-1').addClass('disabled');
        $('.text-selectdom').hide();
        $('#conf-p').removeClass('hidden');
        $('#conf-p1').hide();
        $('#conf-p').addClass('ge-p');
        //$('.confirm-p').addClass('disabled');
       //Restablecer el campo select de la forma de pago
        //$('#formapago').prop('selectedIndex',0);
        $('.c-no').hide();
        $('.c-pe').show();


        $('.usar-d').removeClass('btn-success');
        $('.cambiar-g').removeClass('glyphicon-ok');
        $('.cambiar-g').addClass('glyphicon-off');

        $('.confirm-p').show();
        $('.confirm-d').hide();
        $('.regis-exixts-t').hide();

        $('.domfiscal').hide(500);
        $('#domfiscal').show(1000);
        $('.domentrega1').addClass('domentrega');
        $('.domentrega2').removeClass('domentrega');
        $('#checkpersonal').removeAttr('checked');
        $('#checkfiscal').prop('disabled', true); //desactivmos el campo
        $('#checkpersonal').removeAttr('disabled');
        $('#formulario_entrega')[0].reset(); //restablecemos el form
        //comprobamos si existe el id #select2-estado-container, en caso de q si exista, mostrara lo siguiente
        if ($('#select2-estado-container').length) {
            //restablecemos los valores del select estado
            $('#estado').html('Debe seleccionar un país');
            $('#select2-estado-container').html('');
            $('#select2-estado-container').append($('<option></option>').text('Debe seleccionar un país'));
            //restablecemos los valores del select municipio
            $('#municipio').html('Debe seleccionar un estado');
            $('#select2-municipio-container').html('');
            $('#select2-municipio-container').append($('<option></option>').text('Debe seleccionar un estado'));
        }

        //si elegimos domicilio fiscal agregamos el value  al input domicilio
        $('.d-domicilio').val("Fiscal");

    });

    $('#checkpersonal').click(function () {
        $('#gen-c').hide();
        $('.btn-conf-1').addClass('disabled');
        $('.text-selectdom').hide();
        $('#conf-p').removeClass('hidden');
        $('#conf-p1').hide();
       //$('.confirm-p').addClass('disabled');
       //Restablecer el campo select de la forma de pago
        //$('#formapago').prop('selectedIndex',0);
        $('.c-no').hide();
        $('.c-pe').show();


        $('.usar-d').removeClass('btn-success');
        $('.cambiar-g').removeClass('glyphicon-ok');
        $('.cambiar-g').addClass('glyphicon-off');
        $('.confirm-p').show();
        $('.confirm-d').hide();
        $('.regis-exixts-t').hide();

        $('#domfiscal').hide(500);
        $('.domfiscal').show(1000);
        $('.domentrega2').addClass('domentrega');
        $('.domentrega1').removeClass('domentrega');
        $('#checkfiscal').removeAttr('checked');
        $('#checkpersonal').prop('disabled', true);
        $('#checkfiscal').removeAttr('disabled');
        $('#formulario_entrega')[0].reset(); //restablecemos el form
        //comprobamos si existe el id #select2-estado-container, en caso de q si exista, mostrara lo siguiente
        if ($('#select2-estado-container').length) {
            //restablecemos los valores del select estado
            $('#estado').html('Debe seleccionar un país');
            $('#select2-estado-container').html('');
            $('#select2-estado-container').append($('<option></option>').text('Debe seleccionar un país'));
            //restablecemos los valores del select municipio
            $('#municipio').html('Debe seleccionar un estado');
            $('#select2-municipio-container').html('');
            $('#select2-municipio-container').append($('<option></option>').text('Debe seleccionar un estado'));
        }

        //si elegimos otro domicilio agregamos el value  al input domicilio
        $('.d-domicilio').val("Otro");
    });



    //Al iniciar mandamos consultar todos los paises que se mantienen en nuestra base de datos atravez de la ruta paises
    $.getJSON('paises', function (pais) {
        $('#pais').html('');
        $('#pais').append($('<option></option>').text('Seleccione un país').val(''));
        $.each(pais, function (i) {
            $('#pais').append("<option value=\"" + pais[i].id + "\">" + pais[i].pais + "<\/option>");
        });

    });

    //El metodo Change nos permite realizar una acción al momento que estamos interactuando con el elemento con ID pais
    $("#pais").change(function (event) {
        $.ajax({
            url: 'estados',
            type: 'POST',
            data: 'pais=' + $("#pais option:selected").val(),
        }).done(function (estado) {
            $('#estado').html('');
            $('#estado').append($('<option></option>').text('Seleccione un estado').val(''));
            $.each(estado, function (i) {
                $('#estado').append("<option value=\"" + estado[i].id + "\">" + estado[i].estados + "<\/option>");
            });
            $('#estado').select2();
        });
    });
    //cuando seleccionamos el estado nos carga los dichos municipios del estado
    $("#estado").change(function (event) {
        $.ajax({
            url: 'municipios',
            type: 'POST',
            data: 'estado=' + $("#estado option:selected").val(),
        }).done(function (municipio) {
            $('#municipio').html('');
            $('#municipio').append($('<option></option>').text('Seleccione un municipio').val(''));
            $.each(municipio, function (i) {
                $('#municipio').append("<option value=\"" + municipio[i].id + "\">" + municipio[i].municipio + "<\/option>");
            });
            $('#municipio').select2();
        });
    });




     //Usar un telefono existente
     $(document).on('click','.btn-add-id', function(){
        $('#conf-p').attr('href','#confirmarpedido');
        $('.phone-f').removeClass('tel-fijo');
        $('.phone-c').removeClass('tel-celular');
        $('.phone-o').removeClass('tel-otro');

        id = $(this).attr('data-id');
        //$('#formapago').prop('selectedIndex',0);
        //$('.confirm-p').addClass('disabled');
         $('.text-selectdom').hide();
         //$('.text-exito').show();
         //$('.text-pago').hide();
        $('.c-no').hide();
        $('.c-pe').show();
        $('#conf-p').removeClass('disabled');

        $('.t1').removeClass('tel1');
        $('.t1').removeClass('has-error');
        $('.tel-celular').removeClass('requerido');

        $('.tel2').removeClass('tel1');
        $('.tel2').removeClass('has-error');
        $('.t2').removeClass('requerido');

        $('.tel3').removeClass('tel1');
        $('.tel3').removeClass('has-error');
        $('.t3').removeClass('requerido');

        $('.otrotel-c').slideUp(500);
        $('.confirm-p').hide();
        $('.confirm-d').hide();
        $('.regis-exixts-t').show();
        $('.regis-exixts-t').attr('id',id);

        //eliminamos las clases en los botones que no hacemos clic
        $('.btn-add-id').removeClass('btn-default');
        $('.btn-add-id').removeClass('btn-success');

        //eliminamos las clases en los span que no hacemos clic
        $('.cambiar-t').removeClass('glyphicon-ok');
        $('.cambiar-t').addClass('glyphicon-off');

        //Agregamos las clases en losspanq ue hacemos click
        $('.cambiar-t', this).addClass('glyphicon-ok');
        $('.cambiar-t', this).removeClass('glyphicon-off');

        //agregamos las clases en los botones que hacemos click
        $(this, '.btn-add-id').removeClass('btn-default');
        $(this, '.btn-add-id').addClass('btn-success');



    });




    //Elegir un telefono
    $('.tel-celular').focus(function () {
        $('.tel-fijo').attr('data-id', '');
        $('.tel-otro').attr('data-id', '');
        $('.msgTelfijo').hide();
        $('.msgTelotro').hide();
        $('.msgTelcel').show();
        $('.msgTelcel').html("");

        $('.tel2').removeClass('tel1');
        $('.tel2').removeClass('has-error');
        $('.t2').removeClass('requerido');
        $('.tel2').removeClass('has-success');

        $('.tel3').removeClass('tel1');
        $('.tel3').removeClass('has-error');
        $('.t3').removeClass('requerido');
        $('.tel3').removeClass('has-success');

        $('.t1').addClass('tel1');
        $('.tel-celular').addClass('requerido');

        $('.tel-fijo').val(" ");
        $('.tel-fijo').attr("name", " ");
        $('.tel-fijo').addClass('tel-d');
        $('.tel-otro').val(" ");
        $('.tel-otro').attr("name", " ");
        $('.tel-otro').addClass('tel-d');

        $('.tel-fijo').attr('id', '');
        $('.tel-otro').attr('id', '');
        $('.tel-celular').attr('id', 'phone');
        $('.tel-celular').attr("name", "tel");
        $('.tel-celular').removeClass('tel-d');

        $('.t-tipo').val('Celular');
    });


    $('.tel-fijo').focus(function () {
        $('.tel-otro').attr('data-id', '');
        $('.tel-celular').attr('data-id', '');
        $('.tel-fijo').attr('data-id', 'idtel');
        $('.msgTel').attr('id','msgTel');
        $('.msgTelfijo').show();
        $('.msgTelotro').hide();
        $('.msgTelcel').hide();
        $('.msgTelfijo').html("");

        $('.t1').removeClass('tel1');
        $('.t1').removeClass('has-error');
        $('.tel-celular').removeClass('requerido');
        $('.t1').removeClass('has-success');

        $('.tel3').removeClass('tel1');
        $('.tel3').removeClass('has-error');
        $('.tel3').removeClass('has-success');
        $('.t3').removeClass('requerido');

        $('.tel2').addClass('tel1');
        $('.t2').addClass('requerido');

        $('.tel-celular').val(" ");
        $('.tel-celular').attr("name", " ");
        $('.tel-celular').addClass('tel-d');
        $('.tel-otro').val(" ");
        $('.tel-otro').attr("name", " ");
        $('.tel-otro').addClass('tel-d');

        $('.tel-celular').attr('id', '');
        $('.tel-otro').attr('id', '');
        $('.tel-fijo').attr('id', 'phone');
        $('.tel-fijo').attr("name", "tel");
        $('.tel-fijo').removeClass('tel-d');
        $('.t-tipo').val('Fijo');
    });


    $('.tel-otro').focus(function () {
        $('.tel-fijo').attr('data-id', '');
        $('.tel-celular').attr('data-id', '');
        $('.tel-otro').attr('data-id', 'idtel');
        $('.msgTel').attr('id','msgTel');
        $('.msgTelcel').hide();
        $('.msgTelfijo').hide();
        $('.msgTelotro').show();
        $('.msgTelotro').html("");


        $('.t1').removeClass('tel1');
        $('.t1').removeClass('has-error');
        $('.t1').removeClass('has-success');
        $('.tel-celular').removeClass('requerido');

        $('.tel2').removeClass('tel1');
        $('.tel2').removeClass('has-error');
        $('.tel2').removeClass('has-success');
        $('.t2').removeClass('requerido');

        $('.tel3').addClass('tel1');
        $('.t3').addClass('requerido');

        $('.tel-celular').val(" ");
        $('.tel-celular').attr("name", " ");
        $('.tel-celular').addClass('tel-d');
        $('.tel-fijo').val(" ");
        $('.tel-fijo').attr("name", " ");
        $('.tel-fijo').addClass('tel-d');

        $('.tel-fijo').attr('id', '');
        $('.tel-celular').attr('id', '');
        $('.tel-otro').attr('id', 'phone');
        $('.tel-otro').attr("name", "tel");
        $('.tel-otro').removeClass('tel-d');
        $('.t-tipo').val('Otro');
    });


    //$('.t-otro').hide();
    $('#add-tel').hide();

    $('#add-tel').click(function () {
        $('#add-tel').hide();
        $('.t-otro').show();
        $('.s-p').hide();
    });

    $('.t-quitar').click(function () {
        $('#add-tel').show();
        $('.t-otro').hide();
        $('#conf-p').removeClass('disabled');
        $('.msgTelotro').html("");
        $('.tel-otro').val('');
        $('.tel1').removeClass('has-success');
        $('.tel1').removeClass('has-error');
    });



    //Validaciones para los campos del formularios
    $(".ge-p").click(function () {

           if($('.formapago').val() != null){
                $('.confirm-p').removeClass('disabled');
                $('.regis-exixts-t').removeClass('disabled');
                $('.text-exito').show();
                $('.text-pago').hide();
            }



        $('.text-selectdom').hide();
        expr = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;

    if($("#pais").val() == 0)  {
        $('.pais').addClass('has-error');
        return false;

    } else if($("#estado").val() == 0){
            $('.estado').addClass('has-error');
            return false;

    }  else if($("#municipio").val() == 0){
            $('.municipio').addClass('has-error');
            return false;

    } else if($("#calle1").val().length <= 3){
            $('.calle1').addClass('has-error');
            return false;

    } else if($("#calle2").val().length <= 3){
            $('.calle2').addClass('has-error');
            return false;

    } else if($("#colonia").val().length <= 3){
            $('.colonia').addClass('has-error');
            return false;

    } else if($("#delegacion").val().length <= 3){
            $('.delegacion').addClass('has-error');
            return false;

    } else if(!expr.test($("#cp").val())){
            $('.cp').addClass('has-error');
            return false;

    } else if($(".tel-celular").val() <= 8){
            $('.tel1').addClass('has-error');
            return false;

    } else if($(".tel-fijo").val() <= 8){
            $('.tel1').addClass('has-error');
            return false;
    } else if($(".tel-otro").val() <= 8){
            $('.tel1').addClass('has-error');
            return false;

    } else {
        return true;
    }
});


/**
 *
 * Funcion trim() elimina los espacios en blanco del input
 *
 */
/*
$(".ge-p").click(function () {

   else if($(".tel-celular").val().length <= 8){
            $('.tel1').addClass('has-error');
            return false;

    } else if($(".tel-fijo").val().length <= 8){
            $('.tel1').addClass('has-error');
            return false;
    } else if($(".tel-otro").val().length <= 8){
            $('.tel1').addClass('has-error');
            return false;

    }

});
*/

$('.phone-c').focus(function(){
    $('.phone-c').addClass('tel-celular');
    $('.phone-f').removeClass('tel-fijo');
    $('.phone-o').removeClass('tel-otro');
});

$('.phone-f').focus(function(){
    $('.phone-f').addClass('tel-fijo');
    $('.phone-c').removeClass('tel-celular');
    $('.phone-o').removeClass('tel-otro');
});

$('.phone-o').focus(function(){
    $('.phone-o').addClass('tel-otro');
    $('.phone-f').removeClass('tel-fijo');
    $('.phone-c').removeClass('tel-celular');
});

/*Verificar disponibilidad de los telefonos del cliente*/
 $('.tel-celular').keyup( function(){
    if($('.tel-celular').val() != ""){

         tel = $('.phone-c').val().trim();
         //alert(pass);
        $.ajax({
            type: "POST",
            url: "productos/getVerificarTel",
             data: {tel: tel },
            success: function( t ){
                vt = t.numero;
                   if (vt === undefined) {
                      $('.tel1').removeClass('has-error');
                      $('.spanTel').removeClass('glyphicon-remove');
                      $('.tel1').addClass('has-success');
                      $('.spanTel').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#conf-p').removeClass('disabled');
                      $('.msgTelcel').html("");
                    } else {
                         $('.tel1').removeClass('has-success');
                         $('.spanTel').removeClass('glyphicon-ok');
                         $('.spanTel').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.tel1').addClass('has-error');
                         $('.msgTelcel').html("El teléfono ya existe, elige otro.");
                         $('#conf-p').addClass('disabled');
                }


            }
        });
     }
});

 $('.tel-fijo').keyup( function(){
    if($('.tel-fijo').val()!= ""){

         tel = $('.phone-f').val().trim();
         //alert(pass);
       $.ajax({
            type: "POST",
            url: "productos/getVerificarTel",
             data: {tel: tel },
            success: function( t ){
                vt = t.numero;
                   if (vt === undefined) {
                      $('.tel1').removeClass('has-error');
                      $('.spanTel').removeClass('glyphicon-remove');
                      $('.tel1').addClass('has-success');
                      $('.spanTel').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#conf-p').removeClass('disabled');
                      $('.msgTelfijo').html("");
                    } else {
                         $('.tel1').removeClass('has-success');
                         $('.spanTel').removeClass('glyphicon-ok');
                         $('.spanTel').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.tel1').addClass('has-error');
                         $('.msgTelfijo').html("El teléfono ya existe, elige otro.");
                        $('#conf-p').addClass('disabled');
                }


            }
        });
     }
});

 $('.tel-otro').keyup( function(){
    if($('.tel-otro').val()!= ""){

         tel = $('.phone-o').val().trim();
         //alert(pass);
       $.ajax({
            type: "POST",
            url: "productos/getVerificarTel",
             data: {tel: tel },
            success: function( t ){
                vt = t.numero;
                   if (vt === undefined) {
                      $('.tel1').removeClass('has-error');
                      $('.spanTel').removeClass('glyphicon-remove');
                      $('.tel1').addClass('has-success');
                      $('.spanTel').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#conf-p').removeClass('disabled');
                      $('.msgTelotro').html("");
                    } else {
                         $('.tel1').removeClass('has-success');
                         $('.spanTel').removeClass('glyphicon-ok');
                         $('.spanTel').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.tel1').addClass('has-error');
                         $('.msgTelotro').html("El teléfono ya existe, elige otro.");
                         $('#conf-p').addClass('disabled');
                }


            }
        });
     }
});





    //validamos el elefono+
       $('.tel1').keyup(function(){
        valor = $('.requerido').val();
        if(valor  <= 8 || /^\s+$/.test(valor)){
            $('.tel1').addClass('has-error');

         } else {
            $('.tel1').removeClass('has-error');
            $('.tel1').addClass('has-success');

         }
    });

        $('.tel2').keyup(function(){
        valor = $('.requerido').val();
        if(valor <= 8 || /^\s+$/.test(valor)){
            $('.tel2').addClass('has-error');

         } else {
            $('.tel2').removeClass('has-error');
            $('.tel2').addClass('has-success');

         }
    });


    $('.tel3').keyup(function(){
        valor = $('.requerido').val();
        if(valor <= 8 || /^\s+$/.test(valor)){
            $('.tel3').addClass('has-error');

         } else {
            $('.tel3').removeClass('has-error');
            $('.tel3').addClass('has-success');

         }
    });


    //validamos la calle 1
    $('.calle1').keyup(function(){
        valor = $('#calle1').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.calle1').addClass('has-error');

         } else {
            $('.calle1').removeClass('has-error');
            $('.calle1').addClass('has-success');

         }
    });

     //validamos la calle 2
    $('.calle2').keyup(function(){
        valor = $('#calle2').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.calle2').addClass('has-error');

         } else {
            $('.calle2').removeClass('has-error');
            $('.calle2').addClass('has-success');

         }
    });

    //validamos la colonia
    $('.colonia').keyup(function(){
        valor = $('#colonia').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.colonia').addClass('has-error');

         } else {
            $('.colonia').removeClass('has-error');
            $('.colonia').addClass('has-success');

         }
    });

        //validamos la delegacion
    $('.delegacion').keyup(function(){
        valor = $('#delegacion').val();
        if(valor.length <= 3 || /^\s+$/.test(valor) ){
            $('.delegacion').addClass('has-error');

         } else {
            $('.delegacion').removeClass('has-error');
            $('.delegacion').addClass('has-success');

         }
    });

    //Validamos el codigo postal
    $('.cp').keyup(function(){
      expr = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/; //expresion para validar el CP
      valor = $('#cp').val();
        if( !expr.test(valor) ){
            $('.cp').addClass('has-error');
         } else {
            $('.cp').removeClass('has-error');
            $('.cp').addClass('has-success');
         }
    });


    //Agregar otro telefono
    $('.telclienteotro').click(function(){

        //$('#regispedido').removeClass('disabled');
        $('#conf-p').attr('href','#confirmarpedido');
        $('.phone-c').addClass('tel-celular');
        $('.t1').addClass('tel1');
        $('.tel-celular').addClass('requerido');

        $('.phone-c').addClass('tel-celular');
        $('.phone-f').addClass('tel-fijo');
        $('.phone-o').addClass('tel-otro');

        $('.otrotel-c').slideToggle(500);
        $('.btn-add-id').removeClass('btn-success');
        $('.cambiar-t').removeClass('glyphicon-ok');
        $('.cambiar-t').addClass('glyphicon-off');
        $('.btn-add-id').addClass('btn-default');

        $('.confirm-p').show();
        $('.confirm-d').hide();
        $('.regis-exixts-t').hide();
    });

    $('.regis-exixts-t').hide();





//Registrar un pedido co un domicilio existente
    $('.confirm-d').click(function(){
        //Array principal donde estarán los datos de los productos
        var DATA = [];

        //recorremos cada TR para obtener el id del producto y el td de la cantidad
        $('.tcarrito tbody tr').each(function(){
            idp = $(this).attr('id');
            cant  = $(this).find("input[class*='cant']").val();

            //declaramos un array para guardar estos datos
            item = {idp, cant};

            // hacemos un .push() para agregarlos a nuestro array principal "DATA".
            DATA.push(item);
        })

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        id = $(this).attr('id');

        formapago = $('#formapago').val();
        msjeria = $('#pago').val();

        $.ajax({
            type: "POST", //metodo
            url: "productos/pedidoexistente/"+id,
            data: {aInfo: aInfo, formapago: formapago, msjeria: msjeria},
            success: function (iddom) {

                //redirigimosa¿ al detalle del pedido y le pasamos el id del domi
                window.location.href = 'productos/datosdelpedido/' + iddom;

            },
            error: function () {
                alert('failure');

            }
        });
    });

//Registrar un pedido co un telefono existente
   $(document).on('click', '.regis-exixts-t', function(){
        //Array principal donde estarán los datos de los productos
        var DATA = [];

        //recorremos cada TR para obtener el id del producto y el td de la cantidad
        $('.tcarrito tbody tr').each(function(){
            idp = $(this).attr('id');
            cant  = $(this).find("input[class*='cant']").val();

            //declaramos un array para guardar estos datos
            item = {idp, cant};

            // hacemos un .push() para agregarlos a nuestro array principal "DATA".
            DATA.push(item);
        })

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        id = $(this).attr('id');
        pais = $('#pais').val();
        estado = $('#estado').val();
        municipio = $('#municipio').val();
        calle1 = $('#calle1').val();
        calle2 = $('#calle2').val();
        colonia = $('#colonia').val();
        delegacion = $('#delegacion').val();
        cp = $('#cp').val();
        tipodom = $('.d-domicilio').val();
        formapago = $('#formapago').val();
        msjeria = $('#pago').val();
        coment = $('#coment').val();

       $.ajax({
            type: "POST", //metodo
            url: "productos/nuevopedido/"+id,
            data: {aInfo: aInfo, pais: pais, estado: estado, municipio: municipio, calle1: calle1, calle2: calle2, colonia: colonia, delegacion: delegacion, cp: cp, tipodom: tipodom, formapago: formapago, msjeria: msjeria, coment: coment},
            success: function (iddom) {

                //redirigimosa¿ al detalle del pedido y le pasamos el id del domi
                window.location.href = 'productos/datosdelpedido/' + iddom;

            },
            error: function () {
                alert('failure');
            }
        });
    });



    //Registrar nuevo pedido
    $(document).on('click','#regispedido', function(){
        //Array principal donde estarán los datos de los productos
        var DATA = [];

        //recorremos cada TR para obtener el id del producto y el td de la cantidad
        $('.tcarrito tbody tr').each(function(){
            idp = $(this).attr('id');
            cant  = $(this).find("input[class*='cant']").val();

            //declaramos un array para guardar estos datos
            item = {idp, cant};

            // hacemos un .push() para agregarlos a nuestro array principal "DATA".
            DATA.push(item);
        })

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        id = 0;
        //obtenemos los valores de los campos del form
        pais = $('#pais').val();
        estado = $('#estado').val();
        municipio = $('#municipio').val();
        calle1 = $('#calle1').val();
        calle2 = $('#calle2').val();
        colonia = $('#colonia').val();
        delegacion = $('#delegacion').val();
        cp = $('#cp').val();
        tipodom = $('.d-domicilio').val();
        tel = $('.requerido').val();
        tipotel = $('.t-tipo').val();
        formapago = $('#formapago').val();
        msjeria = $('#pago').val();
        coment = $('#coment').val();



        $.ajax({
            type: "POST", //metodo
            url: "productos/nuevopedido/"+id,
            data: {aInfo: aInfo, pais: pais, estado: estado, municipio: municipio, calle1: calle1, calle2: calle2, colonia: colonia, delegacion: delegacion, cp: cp, tipodom: tipodom, tel: tel, tipotel: tipotel, formapago: formapago, msjeria: msjeria, coment: coment},
            success: function (iddom) {

                //redirigimosa¿ al detalle del pedido y le pasamos el id del domi
                window.location.href = 'productos/datosdelpedido/' + iddom;

            },
            error: function () {
                alert('failure');
            }
        });


    });


//Imprimir pedido
    /*     $('#im-p').click(function(){

     iddom = $('#im-p').val();

     alert(iddom);

     window.location.href='productos/imprimirpedido/'+iddom;


     });


     */



}); //cerramos la funcion jquery principal
