$(document).ready(function () {

        //Listar pedidos del cliente
    $('.totales-p-dclie').hide();
    pedido_c = $("#pedido_cliente");
    $(document).on('click','#p_cliente', function(){
          $.ajax({
            dataType: 'json',
            url: '/productos/listarpedidos',
            success: function(l){
                if(l == 0){
                    $('.t-p-clientes').text('No tienes ningún pedido.');
                  } else {
                    $('.totales-p-dclie').show();

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

                        "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ pedidos)", 
                        "sInfoFiltered": " - filtrados de _MAX_ registros", 
                        "sInfoEmpty": "No hay resultados de búsqueda", 
                        "sZeroRecords": "No hay registros a mostrar", 
                        "sProcessing": "Espere, por favor...", 
                        "sSearch": "Buscar:", 

                     },

                      "aaSorting": [[ 1, "desc" ]], 

                      "sPaginationType": "simple_numbers",
                       "sPaginationType": "bootstrap",



                  });



                  tabla_a.fnClearTable();

                      for(var i = 0; i < l.length; i++) {

                            total = l[i].total;

                             tabla_a.fnAddData([
                                       '<a id="c-estatus" class="'+l[i].num_pedido+'" data-id="'+l[i].id+'" value="'+l[i].created_at+'" href="#detallepedidocliente" data-toggle="modal">'+l[i].num_pedido+'</a>',
                                        l[i].created_at,
                                        l[i].nombre,
                                        '<span id="idp_'+l[i].id+'" value="'+total+'" class="estatus_'+l[i].estatus+'"</span>',
                                      ]);


                              }


                        $('.estatus_0').text('Pendiente');
                        $('.estatus_0').addClass('text-warning');
                        $('.estatus_1').text('Crédito');
                        $('.estatus_1').addClass('text-primary');
                        $('.estatus_2').text('Pagado');
                        $('.estatus_2').addClass('text-success');
                        $('.estatus_3').text('Cancelado');
                        $('.estatus_3').addClass('text-danger');

                        $('.dataTables_paginate .prev a').text('Anterior');
                        $('.dataTables_paginate .next a').text('Siguiente');

                        llamarpaginaciondatatable();


                }
            },

            error: function(){
              alert('failure');
            }
          });
    });

      //Reinicializamos la data table
 /*   $(document).on('click', '.c-p-cli', function(){
      $('#list_p_').DataTable().fnDestroy();
    });

    $(document).on('click', '.close-mp', function(){
      $('#list_p_').DataTable().fnDestroy();
    });*/

     $(document).on('click','.cargarpaginacion', function(){
        $('.fancy a').addClass('cargarpaginacion');

        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');

      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });




    //Detalle del pedido del cliente
    $(document).on('click', '#c-estatus', function(){
          $('.table-detail').show();
          $('#fotop').removeClass('enlace-active');
          $('#det-p').addClass('enlace-active');
          id = $(this).attr('data-id');
          num = $(this).attr('class');
          fe = $(this).attr('value');
          $('.n-pe').text('Pedido #'+num);
          $('.n-fe').text('Fecha: '+fe);
    });

    function llamarpaginaciondatatable(){
      $('.fancy a').addClass('cargarpaginacion');
    }


    $('.content-datos').hide();

      //Detalle del pedido del cliente
    $(document).on('click', '#c-estatus', function(){

          id = $(this).attr('data-id');
          $('.im-pedido').attr('href', 'productos/imprimirpedido/'+id);
          num = $(this).attr('class');
          fe = $(this).attr('value');
          $('.n-pedd').text('Pedido #'+num);
          $('.n-peee').text('Fecha: '+fe);

              t_deatelle = $('#detail-dp');
              $.ajax({
                type: "POST", //metodo
                url: "/productos/detalledelpedido",
                data: {id: id},
                success: function (p) {
                  $('.contenedor-img-detalle').hide();
                  $('.content-datos').show();

                  if(p.t == 'tienda'){
                      $('#sindomi').addClass('sindomi');
                      $('.pc_domiclio').hide();
                      $('.c_rfc').html(p.domi[0].rfc);
                      $('.c_nombre').html(p.domi[0].nombre_cliente+" "+p.domi[0].paterno+" "+p.domi[0].materno);
                      $('.c_correo').html(p.domi[0].email);
                      $('.c_numero').html(p.domi[0].numero_cliente);
                  } else {
                     $('#sindomi').removeClass('sindomi');
                     $('.pc_domiclio').show();
                     $('.c_rfc').html(p.domi[0].rfc);
                     $('.c_nombre').html(p.domi[0].nombre_cliente+" "+p.domi[0].paterno+" "+p.domi[0].materno);
                     $('.c_correo').html(p.domi[0].email);
                     $('.c_numero').html(p.domi[0].numero_cliente);

                     $('.c_pais').html(p.domi[0].pais);
                     $('.c_estado').html(p.domi[0].estados);
                     $('.c_municipio').html(p.domi[0].municipio);

                     $('.c_calle1').html(p.domi[0].calle1);
                     $('.c_calle2').html(p.domi[0].calle2);
                     $('.c_colonia').html(p.domi[0].colonia);

                     $('.c_delegacion').html(p.domi[0].delegacion);
                     $('.c_cp').html(p.domi[0].codigo_postal);
                     $('.c_telefono').html(p.domi[0].numero);

                     $('.d-pe').html('#'+p.ped[0].num_pedido);
                     $('.d-fe').html('Fecha: '+p.ped[0].created_at);

                   if(p.ped[0].observaciones == " "){
                      $('.c_observaciones').text('No ay observaciones.');
                   } else {

                        $('.c_observaciones').text(p.ped[0].observaciones);
                   }
                  }
                  
                  idp = p.ped[0].id;
                pro = "";
                for(datos in p.pro){
                 // des = p.pro[datos].precio * p.pro[datos].descuento;
                 // e = accounting.formatMoney(p.pro[datos].precio - des);
                  f = (p.pro[datos].precio) * p.pro[datos].cantidad;
                 // t = accounting.formatMoney(p.pro[datos].precio);
                      pro += '<tr><td>'+p.pro[datos].clave+'</td>';
                      pro += '<td>'+p.pro[datos].nombre+'</td>';
                      pro += '<td>'+p.pro[datos].color+'</td>';
                      pro += '<td>'+accounting.formatMoney(p.pro[datos].precio)+'</td>';

                      if(p.pro[datos].iva0 == 0){
                       pro += '<td class="c-iva" data-iva="0">0%</td>';
                        
                      } else {
                        pro += '<td class="c-iva" data-iva="16">16%</td>';
                      }

                      pro += '<td id="cant_'+p.pro[datos].pedido_id+'">'+p.pro[datos].cantidad+'</td>';
                      pro += '<td>'+p.pro[datos].num_pedimento+'</td>';
                      pro += '<td><span class="img-p" id="'+p.pro[datos].nombre+'" data-id="'+p.pro[datos].foto+'" href="#verfotop" data-toggle="modal" alt="Foto del producto" title="Ver Foto del prodcto">Ver foto</span></td>';
                      pro += '<td class="t-pro" value="'+f+'">'+accounting.formatMoney(f)+'</td></tr>';

                    }

                  t_deatelle.append(pro);


                  resultado=0;
                  totaliva=0;
                  $('.detail-t tbody tr').each(function(){
                          cant  = $(this).find("[class*='t-pro']").attr('value');
                          iv  = $(this).find("td[class*='c-iva']").attr('data-iva');

                          if(iv  == 0){

                          } else {
                            totaliva += parseFloat(cant) * 0.16;
                          }
                          

                          resultado += parseFloat(cant);
                          $('.sub-p').text(accounting.formatMoney(resultado));

                        });

                   $('.sub-iva').html(accounting.formatMoney(totaliva));
                   $('.total-p').html(accounting.formatMoney(resultado += totaliva));


                },

                error: function(){
                  alert('failure');
                }
           });
   
       });


    $(document).on('click', '#c-estatus', function(){
      idp = $(this).attr('data-id');

      //Extras
        $.ajax({
          type: "GET",
          url: "/pedidos/verextra",
          data: {idp: idp},
          success: function( e ){
                    if(e.n == 0){

                  } else {
                    $('.tab-extra').show();
                    body = $('#body-extras');
                    fila = "";
                    for(datos in e.extra){

                      fila += '<tr><td>'+e.extra[datos].clave+'</td>';
                      fila += '<td>'+e.extra[datos].descripcion+'</td>';
                      fila += '<td class="total_'+e.extra[datos].total+'" data-total="'+e.extra[datos].total+'" id="t_'+e.extra[datos].id+'" value="'+e.extra[datos].total+'" class="total_">'+accounting.formatMoney(e.extra[datos].total)+'</td></tr>';
                      //fila += '<td class="total_'+e.extra[datos].total+'">'+accounting.formatMoney(e.extra[datos].total)+'</td></tr>';
                    }

                    body.append(fila);

                    if($('#t_'+e.extra[datos].id).attr('value') == 0){
                            $('.total_').text('Pendiente');
                            $('.total_').addClass('text-warning');
                            $('.fila_extras').hide();
                            $('.fila_total').hide();
                            //$('.t-extra')
                          } else {
                            $('.fila_extras').show();
                            $('.fila_total').show();
                            $('.total_').text(accounting.formatMoney(e.extra[datos].total));
                            $('.total_').addClass('text-success');
                            $('.to-extra-data').attr('data-extra', e.extra[datos].total);
                            $('.to-extra').text(accounting.formatMoney(e.extra[datos].total));

                            t = $('#idp_'+e.extra[datos].pedido_id).attr('value');
                            e = $('.to-extra-data').attr('data-extra');
                            final = parseFloat(t) + parseFloat(e);
                            $('.gran-to-extra').text(accounting.formatMoney(final));
                          }
                    
                  $('.total_0').text('Pendiente');
                  $('.total_0').addClass('text-warning');

                  }

               }

       });


    });



    $('.table-cli').hide();

      //Foto del producto
    $(document).on('click','.img-p',function(){
      foto = $(this).attr('data-id');
      nf = $(this).attr('id');
      $('.f-p-p').prop('src', 'img/productos/'+foto);
      $('.title-f').html(nf);
    });


    $('#det-p').click(function(){
        $('#det-p').css('text-decoration', 'none');
        $('.table-detail').fadeIn(500);
        $('.table-cli').hide();
        $('#det-p').addClass('enlace-active');
        $('#fotop').removeClass('enlace-active');
        $('#estatusp').removeClass('enlace-active');
      });

      $('#fotop').click(function(){
        $('#fotop').css('text-decoration', 'none');
        $('.table-detail').hide();
        $('.table-cli').fadeIn(500);
        $('#fotop').addClass('enlace-active');
        $('#det-p').removeClass('enlace-active');
        $('#estatusp').removeClass('enlace-active');
      });


      //Actualizaciones de contenidos de la pagina
    $(document).on('click', '#con-pd', function(){
         $("#detail-dp").html('');
         $('.tab-extra').hide();
         $('#body-extras').html('');
         $('.table-cli').hide();
         $('.fila_extras').hide();
         $('.fila_total').hide();
         $('.contenedor-img-detalle').show();
         $('.content-datos').hide();

    });

    $(document).on('click', '.close-mp', function(){
        $("#detail-dp").html('');
         $('.tab-extra').hide();
         $('#body-extras').html('');
         $('.table-cli').hide();
         $('.fila_extras').hide();
         $('.fila_total').hide();
         $('.contenedor-img-detalle').show();
         $('.content-datos').hide();
    });



    $('.cerrar-alert').click(function () {
        $('.mialert').hide();
        $('.msjdanger').text('');
    });

    $('.cerrar-alert2').click(function () {
        $('.mialert2').hide();
        $('.mialert3').hide();
    });

    $(document).on('focus', '#clave', function () {
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
            alertas('error',"Escribe la clave del producto.");
        } else {
            $.ajax({
                type: "POST",
                url: "productos/getProducto",
                data: {clave: $('#clave').val()},
                success: function (prod) {

                    ver = prod.producto.indefinido;
                    if(ver === 'vacio'){
                        alertas('error',"El producto no existe.");
                        $('#productoPanel').hide();
                    } else {

                              $('#productoPanel').slideDown(1000);
                              $('.idProd').attr('id', 'product_' + prod.producto[0].id);
                              $('.idProd2').attr('id', +prod.producto[0].id);
                              $('#nombreProd').text(prod.producto[0].nombre);
                              $('#nombreProd').attr('data-clave', prod.producto[0].clave);
                              $('#nombreProd').attr('data-id', prod.producto[0].id);
                              $('#nombreProd').attr('data-tipo', prod.producto[0].tipo);
                              $('#imagenProd').prop('src', 'img/productos/' + prod.producto[0].foto); 
                              $('#imagenProd').attr('data-foto', prod.producto[0].foto); 
                              $('#colorProd').html(prod.producto[0].color); 
                              $('#piezasProd').html(prod.producto[0].piezas_paquete);
                              $('#precioProd').html(accounting.formatMoney(prod.producto[0].precio));
                              $('#descPrecio').attr('data-precio',accounting.formatMoney(prod.producto[0].precio, " ", "2", ""));
                              $('#t_iva_').attr('data-iva', prod.producto[0].iva0);

                              iva = prod.producto[0].iva0;

                              if(iva == 0){
                                $('#t_iva_').html('0%');
                              } else {
                                $('#t_iva_').html('16%');
                              }

                              $('#dispoProd').html(prod.producto[0].cantidad);
                              $('#total_p').attr('value', prod.producto[0].cantidad);
       
                           
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


$(document).on('click', '#enviar-producto', function(){

  cantidad = $('.idProd').val();

  if(cantidad == 0){
      alertas('error',"Ingrese la cantidad de productos." );
  } else {

    id = $('#nombreProd').attr('data-id');
    //comprobamos si ya esta agregado el producto en el pedido para poder compara las cantidades
    c_actual = $('#v_'+id).val();
    cantidad_elegida = $('.idProd').val();

    if(c_actual == undefined){

    if($('#dispoProd').text() < parseInt(cantidad_elegida)){
      alertas('error',"Productos disponibles: "+$('#dispoProd').text() + "  " );

    } else {

        agregardatosalpedido();

    }

    } else {
      cantidad_total_producto = parseInt(c_actual) + parseInt(cantidad_elegida);

      if($('#dispoProd').text() < cantidad_total_producto){
      alertas('error',"Productos disponibles: "+$('#dispoProd').text() + "  " );

    } else {

        agregardatosalpedido();

    }

    }




  }

});


function agregardatosalpedido(){

    $('#t-pedidoc').show();

    $('#productoPanel').hide();
    clave = $('#nombreProd').attr('data-clave');
    foto = $('#imagenProd').attr('data-foto');
    id = $('#nombreProd').attr('data-id');
    pro = $('#nombreProd').text();
    color = $('#colorProd').text();
    precio = $('#descPrecio').attr('data-precio');
    tipo_precio = $('#nombreProd').attr('data-tipo');
    iva = $('#t_iva_').text();
    niva = $('#t_iva_').attr('data-iva');
    cant = $('.idProd').val();
    disponibles = $('#dispoProd').text();



            tablep = $('#nEntrada');
              d= "";

              if($('#v_'+id).length){

                cant_actual = $('#v_'+id).val(); //cantidad actual del producto en el pedido

                resultado= (parseFloat(cant_actual) + parseFloat(cant)); //sumamos la actual con la nueva q eligio el cliente

                $('#v_'+id).attr('value', resultado); //le asignamos la nueva cantidad al producto del pedido
                $('#v_'+id).val(resultado);
                $('#actC_'+id).attr('data-id', resultado);

                $('#canti_'+id).attr('value', accounting.formatMoney(resultado * precio, " ", "2", ""));
                $('#canti_'+id).text(accounting.formatMoney(resultado * precio));

                $('#totalp-d-d').attr('value', 0);
                $('#t_t_iva').attr('value', 0);
                $('.tcarrido-productos tbody tr').each(function(){

                   total_nueva = $(this).find("td[class*='cantidadelproducto']").attr('value');

                   total_actual = $('#totalp-d-d').attr('value');

                   idp = $(this).find("td[class*='idpro']").attr('value');

                   totalnuevo = parseFloat(total_actual) + parseFloat(total_nueva);

                   $('#totalp-d-d').attr('value', accounting.formatMoney(totalnuevo, " ", "2", ""));
                   $('#totalp-d-d').text(accounting.formatMoney(totalnuevo));

                    //iva
                  iva = $(this).find("td[class*='v_iva']").attr('value');
                   if(iva == 0){

                      if($('#t_t_iva').attr('value') == 0){

                       $('#t_t_iva').text(accounting.formatMoney(0));
                         $('#t_t_iva').attr('value', 0);

                      } else {

                      }

                   } else {

                    c_a = $('#t_t_iva').attr('value');
                    //alert(c_a);
                    iva_1 = $('#canti_'+idp).attr('value');
                   //alert(iva_1);
                   t_iva_ = parseFloat(c_a) + parseFloat(iva_1);
                  $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_, " ", "2", ""));
                  $('#t_t_iva').text(accounting.formatMoney(t_iva_));

                   }
                   


              });

              //cuando se termne de ejcutar el forech multiplicamos el iva por 0.16
                  t_iva_total = $('#t_t_iva').attr('value') * 0.16;
                   $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_total, " ", "2", ""));
                   $('#t_t_iva').text(accounting.formatMoney(t_iva_total));


              } else {

               d += '<tr class="clave_'+clave+'" value="clave_'+clave+'" id="fila_'+id+'"><td class="clavepro" data-id="'+id+'">'+clave+'</td>';
               d += '<td class="idpro" value="'+id+'">'+pro+'</td>';
               d += '<td class="tipo_precio" value="'+tipo_precio+'">'+color+'</td>';
               d += '<td class="p_c" value="'+accounting.formatMoney(precio, " ", "2", "")+'">'+accounting.formatMoney(precio)+'</td>';
               d += '<td class="v_iva" value="'+niva+'">'+iva+'</td>';
               d += '<td><div class="c-pa"><input id="v_'+id+'" type="number" class="form-control cant" data-id="'+accounting.formatMoney(precio, " ", "2", "")+'" value="'+cant+'"><button value="'+id+'" class="btn btn-primary actC btn_'+clave+'" data-id="'+cant+'" data-disponibles="'+disponibles+'" id="actC_'+id+'"><span class="glyphicon glyphicon-refresh"></span></button></div></td>';
               d += '<td><span class="verfotop" id="'+foto+'" data-id="'+pro+'" alt="Foto del producto">Ver Foto</span></td>';
               d += '<td id="canti_'+id+'" class="cantidadelproducto" value="'+accounting.formatMoney(precio * cant, " ", "2", "")+'">'+accounting.formatMoney(precio * cant)+'</td>';
               d += '<td><button id="q-t" value="'+id+'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></button></td>';
                        

              tablep.prepend(d);

              if($('#totalp-d-d').attr('value') == 0){
                $('#totalp-d-d').text(accounting.formatMoney(precio * cant));
                $('#totalp-d-d').attr('value', accounting.formatMoney(precio * cant, " ", "2", ""));

                 //iva
                  if(niva == 0){
                        if($('#t_t_iva').attr('value') == 0){

                       $('#t_t_iva').text(accounting.formatMoney(0));
                         $('#t_t_iva').attr('value', 0);

                      } else {

                      }
                   } else {
                    $('#t_t_iva').attr('value', '');
                    t_p_ = $('#totalp-d-d').attr('value');
                    iva_total = t_p_ * 0.16;
                    $('#t_t_iva').text(accounting.formatMoney(iva_total));
                    $('#t_t_iva').attr('value', accounting.formatMoney(iva_total, " ", "2", ""));

                   }

              } else {

                $('#totalp-d-d').attr('value', 0);
                $('#t_t_iva').attr('value', 0);
                $('.tcarrido-productos tbody tr').each(function(){

                   total_nueva = $(this).find("td[class*='cantidadelproducto']").attr('value');

                   total_actual = $('#totalp-d-d').attr('value');

                   idp = $(this).find("td[class*='idpro']").attr('value');

                   totalnuevo = parseFloat(total_actual) + parseFloat(total_nueva);

                   $('#totalp-d-d').attr('value', accounting.formatMoney(totalnuevo, " ", "2", ""));
                   $('#totalp-d-d').text(accounting.formatMoney(totalnuevo));

                   //iva
                  iva = $(this).find("td[class*='v_iva']").attr('value');
                   if(iva == 0){

                      if($('#t_t_iva').attr('value') == 0){

                       $('#t_t_iva').text(accounting.formatMoney(0));
                         $('#t_t_iva').attr('value', 0);

                      } else {

                      }

                   } else {

                    c_a = $('#t_t_iva').attr('value');
                    //alert(c_a);
                    iva_1 = $('#canti_'+idp).attr('value');
                   //alert(iva_1);
                   t_iva_ = parseFloat(c_a) + parseFloat(iva_1);
                  $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_, " ", "2", ""));
                  $('#t_t_iva').text(accounting.formatMoney(t_iva_));

                   }
                   


              });

                //cuando se termne de ejcutar el forech multiplicamos el iva por 0.16
                  t_iva_total = $('#t_t_iva').attr('value') * 0.16;
                   $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_total, " ", "2", ""));
                   $('#t_t_iva').text(accounting.formatMoney(t_iva_total));


              }

              

              } //end else

              //total
               total_mas_iva = parseFloat($('#t_t_iva').attr('value')) + parseFloat($('#totalp-d-d').attr('value'));
               $('#total_mas_iva').text(accounting.formatMoney(total_mas_iva));
               $('#total_mas_iva').attr('data-pedido', accounting.formatMoney(total_mas_iva, " ", "2", ""));

               //limpiamos
               $('.idProd').val('');
                $('#clave').val('');


        }//end function



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


      //SEleccionar el tipo de envio
      $('select.selectTipo').on('change',function(){
          tipo = $(this).val();
          if(tipo == 'domicilio'){
            $('.txt-costos').show();
            $('.g-tipo').attr('id', 'g-tipo');
            $('#g-tipo').hide();
            $('.selecTipoEnvio').show(500);
            $('#inpEnvio').val('1');  
            $('#generar-tienda').show(300);
            $('.alert-pago').removeClass('alert-v');
          } else if(tipo == 'tienda'){
            $('.txt-costos').hide();
            $('#inpEnvio').val('0');
            $('.g-tipo').attr('id', 'generar-tienda');
            $('.selecTipoEnvio').hide(500);
            $('#generar-tienda').show();
            $('.alert-pago').addClass('alert-v');
            $('.panel-entrega').hide();
            $('#checkdomicilio').removeAttr('checked');
            $('#checkfiscal').removeAttr('checked');
            $('#checkpersonal').removeAttr('checked');
            $('#checkpersonal').removeAttr('disabled');
            $('#checkfiscal').removeAttr('disabled');
            $('#domfiscal').hide();

            $('.usar-d').removeClass('btn-success');
            $('.cambiar-g').removeClass('glyphicon-ok');
            $('.cambiar-g').addClass('glyphicon-off');
          }    
      });



    //comprobamos que el cliente seleccione la forma de pago
    if($('#formapago').val() == null){
        $('.text-pago').show();
        $('.confirm-p').addClass('disabled');

    } else {
        $('.confirm-p').removeClass('disabled');
    }


    $('#formapago').on('change',function(){
        id = $(this).val();
        forma = $('#text_'+id).text();
        $('.f-p').attr('value',id);
        $('.f-t').attr('value',forma);

    });


    //$('.selectTipo > option[value="tienda"]').attr('selected', 'selected');


      //Generar pedido para recoger en la tienda
      $(document).on('click', '#generar-tienda', function(){
           if($('#formapago').val() != null){
             $('#confirmpedido').modal({
              show:'false',
             });
          } else {
            
            alertas('error',"Seleccione la forma de pago.");

          }

      });

   
        //generar pedido con domicilio existente
        $('#conf-p1').click(function(){
            if($('#formapago').val() != null){
                //$('.confirm-d').removeClass('disabled');
                //$('.text-exito').show();
                //$('.text-pago').hide();
            $('#confirmarpedido').modal({
              show:'false',
             });
            } else {
              alertas('error',"Seleccione la forma de pago.");
            }
        });


  $('.btn-conf-1').hide();

  $('#gen-c').click(function(){


    alertab('error',"Elige un domicilio!");


  });


  $('#conf-p').click(function(){

    if($('#formapago').val() == null){

    alertas('error',"Seleccione la forma de pago.");
    return false;

    }


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





    //Actualizar domicilio

  $(document).on('click','#acttualizar-dom', function(){


     pais = $('#paisedit').val();
     estado = $('#listestados').val();
     municipio =  $('#municipioedit').val();
     calle1 = $('#calle1edit').val();
     calle2 = $('#calle2edit').val();
     colonia = $('#coloniadit').val();
     delegacion =  $('#delegacionedit').val();
     cp =  $('#cpedit').val();
     tel =  $('#teledit').val();
     tipodom = $('#t-dom').val();
     tipotel = $('#tipoedit').val();
     id = $('#iddom').val();


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

    if($("#calle1").val().length <= 3){
            $('.calle1').addClass('has-error');
            alertas('error',"Agregue la calle.");
            return false;

    } else if($("#calle2").val().length <= 3){
            $('.calle2').addClass('has-error');
            alertas('error',"Agregue la segunda calle.");
            return false;

    } else if($("#colonia").val().length <= 3){
            $('.colonia').addClass('has-error');
            alertas('error',"Agregue la colonia.");
            return false;

    } else if(!expr.test($("#cp").val())){
            $('.cp').addClass('has-error');
            alertas('error',"Agregue el codigo postal.");
            return false;

    } if($("#pais").val() == 0)  {
        $('.pais').addClass('has-error');
        alertas('error',"Seleccione un país.");
        return false;

    } else if($("#estado").val() == 0){
            $('.estado').addClass('has-error');
            alertas('error',"Seleccione un estado.");
            return false;

    }  else if($("#municipio").val() == 0){
            $('.municipio').addClass('has-error');
            alertas('error',"Seleccione un municipio.");
            return false;

    } else if($(".tel-celular").val() <= 8){
            $('.tel1').addClass('has-error');
            alertas('error',"Agregue un teléfono.");
            return false;

    } else if($(".tel-fijo").val() <= 8){
            $('.tel1').addClass('has-error');
            alertas('error',"Agregue un teléfono.");
            return false;
    } else if($(".tel-otro").val() <= 8){
            $('.tel1').addClass('has-error');
            alertas('error',"Agregue un teléfono.");
            return false;

    } else {
        return true;
    }
});



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
        if(valor.length == 3 || /^\s+$/.test(valor) ){
            $('.colonia').addClass('has-error');

         } else {
            $('.colonia').removeClass('has-error');
            $('.colonia').addClass('has-success');

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


    $('#pais').on('change', function(){
        $('.pais').removeClass('has-error');
        $('.pais').addClass('has-success');
    });

    $('#estado').on('change', function(){
        $('.estado').removeClass('has-error');
        $('.estado').addClass('has-success');
    });

    $('#municipio').on('change', function(){
        $('.municipio').removeClass('has-error');
        $('.municipio').addClass('has-success');
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




//Registrar un pedido sin domicilio
$('#p-s-dom').click(function(){
  cotizar = $('#inpEnvio').val();
  formapago = $('#formapago').val();
  msjeria = $('#pago').val();
  r_extra = $('#add-extras-s').attr('data-id');
  total = $('.total-ped').attr('data-pedido');

   var DATA = [];

        $('.tcarrito tbody tr').each(function(){
            idp = $(this).find("[class*='clavepro']").attr('data-id');
            clave  = $(this).find("[class*='clavepro']").text();
            cant  = $(this).find("input[class*='cant']").val();
            tipoprecio  = $(this).find("td[class*='tipo_precio']").attr('value');
            preciop  = $(this).find("td[class*='p_c']").attr('value');

            item = {idp, clave, cant, tipoprecio, preciop};

            DATA.push(item);
        })

        aInfo   = JSON.stringify(DATA);

        //Extras
        var DATA2 = [];

            claveextra  = $('.text-clave').text();
            contenido  = $('#tdextra').text();
            extra = {claveextra, contenido};
            DATA2.push(extra);
            nExtra = JSON.stringify(DATA2);

        
       $.ajax({
            type: "POST",
            url: "/productos/pedidoexistente/"+id,
            data: {aInfo: aInfo, nExtra: nExtra, formapago: formapago, msjeria: msjeria, cotizar: cotizar, r_extra: r_extra, total: total},

          beforeSend: function(){
                  $('#env_p').modal({
                        show:'false',
                      });
              },

            success: function (iddom) {
                enviaragente(iddom);

            },

            error: function () {
                alert('failure');

            }
        });
     
});




//Registrar un pedido con un domicilio existente
    $('.confirm-d').click(function(){
        //Array principal donde estarán los datos de los productos
        var DATA = [];

        //recorremos cada TR para obtener el id del producto y el td de la cantidad
        $('.tcarrito tbody tr').each(function(){
            idp = $(this).find("[class*='clavepro']").attr('data-id');
            clave  = $(this).find("[class*='clavepro']").text();
            cant  = $(this).find("input[class*='cant']").val();
            tipoprecio  = $(this).find("td[class*='tipo_precio']").attr('value');
            preciop  = $(this).find("td[class*='p_c']").attr('value');

            item = {idp, clave, cant, tipoprecio, preciop};

            DATA.push(item);
        })

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

         //Extras
        var DATA2 = [];
        
            claveextra  = $('.text-clave').text();
            contenido  = $('#tdextra').text();
            extra = {claveextra, contenido};
            DATA2.push(extra);
            nExtra = JSON.stringify(DATA2);

        //id de la direccion
        id = $(this).attr('id');

        //datos generales
        cotizar = $('#inpEnvio').val();
        formapago = $('#formapago').val();
        msjeria = $('#pago').val();
        r_extra = $('#add-extras-s').attr('data-id');
        total = $('.total-ped').attr('data-pedido');



        $.ajax({
            type: "POST", //metodo
            url: "/productos/pedidoexistentedomicilio/"+id,
            data: {aInfo: aInfo, nExtra: nExtra, formapago: formapago, msjeria: msjeria, cotizar: cotizar, r_extra: r_extra, total: total},
            beforeSend: function(){
                  $('#env_p').modal({
                        show:'false',
                      });
              },

            success: function (iddom) {

                enviaragente(iddom);

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
            idp = $(this).find("[class*='clavepro']").attr('data-id');
            clave  = $(this).find("[class*='clavepro']").text();
            cant  = $(this).find("input[class*='cant']").val();
            tipoprecio  = $(this).find("td[class*='tipo_precio']").attr('value');
            preciop  = $(this).find("td[class*='p_c']").attr('value');

            //declaramos un array para guardar estos datos
            item = {idp, clave, cant, tipoprecio, preciop};

            // hacemos un .push() para agregarlos a nuestro array principal "DATA".
            DATA.push(item);
        })


        //Extras
        var DATA2 = [];
        
            claveextra  = $('.text-clave').text();
            contenido  = $('#tdextra').text();
            extra = {claveextra, contenido};
            DATA2.push(extra);
            nExtra = JSON.stringify(DATA2);

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        //id del telefono
        id = $(this).attr('id');

        //datos generales
        cotizar = $('#inpEnvio').val();
        formapago = $('#formapago').val();
        msjeria = $('#pago').val();
        r_extra = $('#add-extras-s').attr('data-id');
        total = $('.total-ped').attr('data-pedido');

        //Datos del formulario
        pais = $('#pais').val();
        estado = $('#estado').val();
        municipio = $('#municipio').val();
        calle1 = $('#calle1').val();
        calle2 = $('#calle2').val();
        colonia = $('#colonia').val();
        delegacion = $('#delegacion').val();
        cp = $('#cp').val();
        tipodom = $('.d-domicilio').val();
        coment = $('#coment').val();


       $.ajax({
            type: "POST", //metodo
            url: "/productos/nuevopedido/"+id,
            data: {aInfo: aInfo, nExtra: nExtra, cotizar: cotizar, pais: pais, estado: estado, municipio: municipio, calle1: calle1, calle2: calle2, colonia: colonia, delegacion: delegacion, cp: cp, tipodom: tipodom, formapago: formapago, msjeria: msjeria, coment: coment, r_extra: r_extra, total: total},

            beforeSend: function(){
                  $('#env_p').modal({
                        show:'false',
                      });
              },

            success: function (iddom) {

                //redirigimosa¿ al detalle del pedido y le pasamos el id del domi
                //window.location.href = 'productos/datosdelpedido/' + iddom;
                enviaragente(iddom);

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
            idp = $(this).find("[class*='clavepro']").attr('data-id');
            clave  = $(this).find("[class*='clavepro']").text();
            cant  = $(this).find("input[class*='cant']").val();
            tipoprecio  = $(this).find("td[class*='tipo_precio']").attr('value');
            preciop  = $(this).find("td[class*='p_c']").attr('value');

            //declaramos un array para guardar estos datos
            item = {idp, clave, cant, tipoprecio, preciop};

            // hacemos un .push() para agregarlos a nuestro array principal "DATA".
            DATA.push(item);
        })

        //Extras
        var DATA2 = [];
        
            claveextra  = $('.text-clave').text();
            contenido  = $('#tdextra').text();
            extra = {claveextra, contenido};
            DATA2.push(extra);
            nExtra = JSON.stringify(DATA2);

        //convertiremos el array en json para evitar cualquier incidente con compativilidades.
        aInfo   = JSON.stringify(DATA);

        id = 0;
        //alert(id);

        //datos generales
        cotizar = $('#inpEnvio').val();
        formapago = $('#formapago').val();
        msjeria = $('#pago').val();
        r_extra = $('#add-extras-s').attr('data-id');
        total = $('.total-ped').attr('data-pedido');

        //Datos del formulario
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
        coment = $('#coment').val();



        $.ajax({
            type: "POST", //metodo
            url: "/productos/nuevopedido/"+id,
            data: {aInfo: aInfo, nExtra: nExtra, cotizar: cotizar, pais: pais, estado: estado, municipio: municipio, calle1: calle1, calle2: calle2, colonia: colonia, delegacion: delegacion, cp: cp, tipodom: tipodom, tel: tel, tipotel: tipotel, formapago: formapago, msjeria: msjeria, coment: coment, r_extra: r_extra, total: total},

            beforeSend: function(){
                  $('#env_p').modal({
                        show:'false',
                      });
              },

            success: function (iddom) {

               enviaragente(iddom);

            },
            error: function () {
                alert('failure');
            }
        });


    });



}); //cerramos la funcion jquery principal

function enviaragente(iddom){
    $.ajax({

            type: "POST", 
            url: "productos/enviaragente/"+iddom,

            success: function (iddom) {
                //console.log(iddom);
                //redirigimosa¿ al detalle del pedido y le pasamos el id del domi
                window.location.href = 'productos/datosdelpedido/' + iddom;

            },
            error: function () {
                alert('failure');
            }
        });
}


function alertas(tipo,mensaje){
    $('.top-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }


function alertab(tipo,mensaje){
    $('.bottom-right').notify({
      message: {text: decodeURIComponent(mensaje)},
      type: tipo
    }).show();
  }


//alertas('error',"Seleccione la forma de pago.");