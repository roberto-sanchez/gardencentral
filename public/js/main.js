$(document).on('click', '#mostar-modal-catalogo', function(){


	//Listamos las categorias
	$.ajax({
		url:  "/productos/selectcategorias",
		type: "GET",
		success: function(c){
			 option = "";
              s = $('#select-producto-categoria');
									
			  option += '<option value="0">-- Seleccione --</option>';
              for(datos in c.categorias){

					option += '<option value="'+c.categorias[datos].id+'">'+c.categorias[datos].categoria+'</option>';
			}

			s.append(option);

		},
			
		error: function(){
			alert('failure');
		}
																
	});

  $('#modal-catalogo-productos').modal({
      show: 'false'
   }); 

});


$(document).on('change', '#select-producto-categoria', function(){

    contenedor = $('.contenedor-productos');
	contenedor.html('');

	$('.img-espera').hide();
    $('.div-seleccione-categoria').hide();
	$('.div-nohay-categoria').hide();

	id = $(this).val();

	if(id == 0){
		$('.img-espera').hide();
		$('.div-seleccione-categoria').show();
	    $('.div-nohay-categoria').hide();
	    $('#agregar-del-catalogo').hide();
	} else {

	 $.ajax({
		url:  "/productos/listarproductoscategoria",
		type: "GET",
		data: {id: id},

		beforeSend: function(){
            $('.img-espera').show();
        },

		success: function(p){

			if(p.producto== 0){
				$('.img-espera').hide();
				$('.div-seleccione-categoria').hide();
				$('.div-nohay-categoria').show();
				$('#agregar-del-catalogo').hide();
			} else {
				$('.img-espera').hide();
				$('.div-seleccione-categoria').hide();
				$('.div-nohay-categoria').hide();
				$('#agregar-del-catalogo').show();

			div = "";
									
              for(datos in p.producto){

		          p_t = p.producto[datos].tipo;

               if(p_t == 1){

               		if(p.producto[datos].iva0 == 0){

						div += '<tr class="contenedor">'+
								'<td class="imagen-producto" value="'+p.producto[datos].foto+'" data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="0%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
								  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto">'+
								'</td>'+
								'<td class="datos-producto">'+
								  '<span>Clave: '+p.producto[datos].clave+'</span>'+
								  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
								  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
								  '<span>Precio retail: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
								  /*'<span>Iva: 0%</span>'+*/
								  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
								  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="0%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
								  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
								  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
								 '</td>'+
							'</tr>';

               		} else {

               			div += '<tr class="contenedor">'+
								'<td class="imagen-producto" value="'+p.producto[datos].foto+'"  data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="16%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
								  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto">'+
								'</td>'+
								'<td class="datos-producto">'+
								   '<span>Clave: '+p.producto[datos].clave+'</span>'+
								  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
								  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
								  '<span>Precio retail: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
								  /*'<span>Iva: 16%</span>'+*/
								  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
								  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="16%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
								  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
								  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
								 '</td>'+
							'</tr>';

               		}


                   } else if(p_t == 2) {

                   	if(p.producto[datos].iva0 == 0){

	                     div += '<tr class="contenedor">'+
							'<td class="imagen-producto" value="'+p.producto[datos].foto+'" data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="0%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
							  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto" >'+
							'</td>'+
							'<td class="datos-producto">'+
							  '<span>Clave: '+p.producto[datos].clave+'</span>'+
							  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
							  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
							  '<span>Precio mayorista: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
							  /*'<span>Iva: 0%</span>'+*/
							  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
							  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="0%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
							  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
							  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
							 '</td>'+
						'</tr>';

               		} else {
               			desc_p = p.producto[datos].precio * p.producto[datos].descuento; 
               			preciototal = p.producto[datos].precio - desc_p;

               			div += '<tr class="contenedor">'+
							'<td class="imagen-producto" value="'+p.producto[datos].foto+'" data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="16%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
							  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto">'+
							'</td>'+
							'<td class="datos-producto">'+
							  '<span>Clave: '+p.producto[datos].clave+'</span>'+
							  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
							  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
							  '<span>Precio mayorista: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
							  /*'<span>Iva: 16%</span>'+*/
							  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
							  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="16%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
							  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
							  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
							 '</td>'+
						'</tr>';

               		}




               } else if(p_t == 3) {

                   	if(p.producto[datos].iva0 == 0){

	                     div += '<tr class="contenedor">'+
							'<td class="imagen-producto" value="'+p.producto[datos].foto+'" data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="0%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
							  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto" >'+
							'</td>'+
							'<td class="datos-producto">'+
							  '<span>Clave: '+p.producto[datos].clave+'</span>'+
							  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
							  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
							  '<span>Precio distribuidor: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
							  /*'<span>Iva: 0%</span>'+*/
							  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
							  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="0%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
							  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
							  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
							 '</td>'+
						'</tr>';

               		} else {
               			desc_p = p.producto[datos].precio * p.producto[datos].descuento; 
               			preciototal = p.producto[datos].precio - desc_p;

               			div += '<tr class="contenedor">'+
							'<td class="imagen-producto" value="'+p.producto[datos].foto+'" data-clave="'+p.producto[datos].clave+'" data-id="'+p.producto[datos].id+'" data-nombre="'+p.producto[datos].nombre+'" data-color="'+p.producto[datos].color+'" data-precio="'+p.producto[datos].precio+'" data-iva="16%" data-niva="'+p.producto[datos].iva0+'" data-disponibles="'+p.producto[datos].cantidad+'" data-tipo="'+p.producto[datos].tipo+'">'+
							  '<img src="/img/productos/'+p.producto[datos].foto+'" alt="Imagen del producto" class="imagen-del-producto">'+
							'</td>'+
							'<td class="datos-producto">'+
							  '<span>Clave: '+p.producto[datos].clave+'</span>'+
							  '<span>Producto: '+p.producto[datos].nombre+'</span>'+
							  /*'<span>Color: '+p.producto[datos].color+'</span>'+*/
							  '<span>Precio distribuidor: '+accounting.formatMoney(p.producto[datos].precio)+'</span>'+
							  /*'<span>Iva: 16%</span>'+*/
							  '<span>Disponibles: '+p.producto[datos].cantidad+'</span>'+
							  '<span class="text-primary txt-width" data-foto-p="'+p.producto[datos].foto+'" data-clave-p="'+p.producto[datos].clave+'" data-nombre-p="'+p.producto[datos].nombre+'" data-color-p="'+p.producto[datos].color+'" data-precio-p="'+accounting.formatMoney(p.producto[datos].precio)+'" data-iva-p="16%" data-disponibles-p="'+p.producto[datos].cantidad+'" title="Detalle del producto">Ver detalle</span>'+
							  '<span class="text-success txt-agregar-p">Cantidad: </span>'+
							  '<input type="number" min="1" class="form-control cantidaddeproductos" data-id="'+p.producto[datos].id+'" value="0">'+
							 '</td>'+
						'</tr>';

               		}




               }

					

			}


			contenedor .append(div);
			}

		},
			
		error: function(){
			alert('failure');
		}
																
	});

	}

});


//detalle del producto
$(document).on('click', '.txt-width', function(){

	 foto = $(this).attr('data-foto-p');
	 clave = $(this).attr('data-clave-p');
	 nombre = $(this).attr('data-nombre-p');
	 color = $(this).attr('data-color-p');
	 precio = $(this).attr('data-precio-p');
	 iva = $(this).attr('data-iva-p');
	 disponibles = $(this).attr('data-disponibles-p');

	 $('#img-detalle-p').prop('src', 'img/productos/' + foto); 

	 dato = "";

	 dato += '<span class="span-pro"><span class="text-info">Clave:</span> '+clave+'</span>'+
	 		 '<span class="span-pro"><span class="text-info">Producto:</span> '+nombre+'</span>'+
	 		 '<span class="span-pro"><span class="text-info">Color:</span> '+color+'</span>'+
	 		 '<span class="span-pro"><span class="text-info">Precio:</span> '+precio+'</span>'+
	 		 '<span class="span-pro"><span class="text-info">Iva:</span> '+iva+'</span>'+
	 		 '<span class="span-pro"><span class="text-info">Disponibles:</span> '+disponibles+'</span>';

	 $('.datos-detalle-pro').append(dato);

	 $('#modaldetalleproducto').modal({
	 	show:'false',
	 });

});


$(document).on('click', '#cerrar-detalle-pro', function(){

	$('#modaldetalleproducto').modal('hide');
	$('.datos-detalle-pro').html('');	

});

$(document).on('click', '#salir-catalogo-p', function(){
	$('#agregar-del-catalogo').hide();
	$('.contenedor-productos').html('');
	$('#select-producto-categoria').html('');
	$('.div-seleccione-categoria').show();
	$('.div-nohay-categoria').hide();

});

$(document).on('click', '.close', function(){
	$('#agregar-del-catalogo').hide();
	$('.contenedor-productos').html('');
	$('#select-producto-categoria').html('');
	$('.div-seleccione-categoria').show();
	$('.div-nohay-categoria').hide();

});


      $(document).on('click', '#agregar-del-catalogo', function(){

      	 $('.table-datos-producto tbody tr').each(function(){

      	 	clave = $(this).find("td[class*='imagen-producto']").attr('data-clave');
            foto = $(this).find("td[class*='imagen-producto']").attr('value');
            id = $(this).find("td[class*='imagen-producto']").attr('data-id');
            pro = $(this).find("td[class*='imagen-producto']").attr('data-nombre');
            color = $(this).find("td[class*='imagen-producto']").attr('data-color');
            precio = $(this).find("td[class*='imagen-producto']").attr('data-precio');
            tipo_precio = $(this).find("td[class*='imagen-producto']").attr('data-tipo');
            iva = $(this).find("td[class*='imagen-producto']").attr('data-iva');
            niva = $(this).find("td[class*='imagen-producto']").attr('data-niva');
            cant = $(this).find("input[class*='cantidaddeproductos']").val();
            disponibles = $(this).find("td[class*='imagen-producto']").attr('data-disponibles');

            if(cant <= 0){

            } else{

            	$('#modal-catalogo-productos').modal('hide');

			    //comprobamos si ya esta agregado el producto en el pedido para poder compara las cantidades
			    c_actual = $('#v_'+id).val();

			    if(c_actual == undefined){

			    if(disponibles < parseInt(cant)){
			      alertas('error'," "+clave+": Productos disponibles: "+disponibles+ "  " );

			      if(disponibles == 0){
				      //Limpiamos
	              	$('.contenedor-productos').html('');
					$('#select-producto-categoria').html('');
					$('.div-seleccione-categoria').show();
					$('.div-nohay-categoria').hide();
			      } else {
			        cant = disponibles;
			        agregarproductosalpedido(clave, foto, id, pro, color, precio, tipo_precio, iva, niva, cant, disponibles);
			      	
			      }


			    } else {

			        agregarproductosalpedido(clave, foto, id, pro, color, precio, tipo_precio, iva, niva, cant, disponibles);

			    }

			    } else {
			      cantidad_total_producto = parseInt(c_actual) + parseInt(cant);

			     if(disponibles < cantidad_total_producto){
			      alertas('error'," "+clave+": Productos disponibles: "+disponibles+ "  " );

			      if(disponibles == 0){

			      	//Limpiamos
	              	$('.contenedor-productos').html('');
					$('#select-producto-categoria').html('');
					$('.div-seleccione-categoria').show();
					$('.div-nohay-categoria').hide();
					$('#agregar-del-catalogo').hide();

			      } else {
			        cant = disponibles - c_actual;
			        agregarproductosalpedido(clave, foto, id, pro, color, precio, tipo_precio, iva, niva, cant, disponibles);

			      }


			    } else {

			        agregarproductosalpedido(clave, foto, id, pro, color, precio, tipo_precio, iva, niva, cant, disponibles);

			    }

			    }



           }

        });


      });



      function agregarproductosalpedido(clave, foto, id, pro, color, precio, tipo_precio, iva, niva, cant, disponibles){


            $('#modal-catalogo-productos').modal('hide');
            $('#t-pedidoc').show();

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
               d += '<td><div class="c-pa"><input id="v_'+id+'" type="number" class="form-control cant" data-id="'+accounting.formatMoney(precio, " ", "2", "")+'" value="'+cant+'"><button value="'+id+'" class="btn btn-primary actC btn_'+clave+'" data-id="'+cant+'" id="actC_'+id+'" data-disponibles="'+disponibles+'"><span class="glyphicon glyphicon-refresh"></span></button></div></td>';
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

              //Limpiamos
              	$('.contenedor-productos').html('');
				$('#select-producto-categoria').html('');
				$('.div-seleccione-categoria').show();
				$('.div-nohay-categoria').hide();



      } //end function


          //Actualizar cantidad
    $(document).on('click', '.actC', function(){
      valor = $(this).val(); //id
      disponibles = $(this).attr('data-disponibles'); //productos disponibles
      c = $('#v_'+valor).val(); //cantidad 
      p = $('#v_'+valor).attr('data-id'); //precio


      if(disponibles  < parseInt(c)){
      	alertas('error',"Productos disponibles: "+disponibles+ "  " );
      	$('#v_'+valor).attr('value', disponibles); 
      	$('#v_'+valor).val(disponibles); 
	    $('#actC_'+valor).attr('data-id', disponibles); 
	    actualizartotalproductos2(disponibles, p, valor);
      } else {

    	actualizartotalproductos(valor, c, p);

      } //end else


    });


    function actualizartotalproductos(valor, c, p){

	      $('#canti_'+valor).text(accounting.formatMoney(p * c));
	      v_actual = $('#canti_'+valor).attr('value', p * c);

	      $('#v_'+valor).attr('value', c); 

	      $('#actC_'+valor).attr('data-id', c); 

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
	           	iva_1 = $('#canti_'+idp).attr('value');
	           t_iva_ = parseFloat(c_a) + parseFloat(iva_1);
	          $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_, " ", "2", ""));
	          $('#t_t_iva').text(accounting.formatMoney(t_iva_));

	           }
	           


	    	});

	    	//cuando se termne de ejcutar el forech multiplicamos el iva por 0.16
	      t_iva_total = $('#t_t_iva').attr('value') * 0.16;
	       $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_total, " ", "2", ""));
	       $('#t_t_iva').text(accounting.formatMoney(t_iva_total));

	       //total
	       total_mas_iva = parseFloat($('#t_t_iva').attr('value')) + parseFloat($('#totalp-d-d').attr('value'));
	       $('#total_mas_iva').text(accounting.formatMoney(total_mas_iva));
	       $('#total_mas_iva').attr('data-pedido', accounting.formatMoney(total_mas_iva, " ", "2", "")); 
	   } //end function


	  function actualizartotalproductos2(disponibles, p, valor){

	      $('#canti_'+valor).text(accounting.formatMoney(p * disponibles));
	      v_actual = $('#canti_'+valor).attr('value', p * disponibles);
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
	           	iva_1 = $('#canti_'+idp).attr('value');
	           t_iva_ = parseFloat(c_a) + parseFloat(iva_1);
	          $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_, " ", "2", ""));
	          $('#t_t_iva').text(accounting.formatMoney(t_iva_));

	           }
	           


	    	});

	    	//cuando se termne de ejcutar el forech multiplicamos el iva por 0.16
	      t_iva_total = $('#t_t_iva').attr('value') * 0.16;
	       $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_total, " ", "2", ""));
	       $('#t_t_iva').text(accounting.formatMoney(t_iva_total));

	       //total
	       total_mas_iva = parseFloat($('#t_t_iva').attr('value')) + parseFloat($('#totalp-d-d').attr('value'));
	       $('#total_mas_iva').text(accounting.formatMoney(total_mas_iva));
	       $('#total_mas_iva').attr('data-pedido', accounting.formatMoney(total_mas_iva, " ", "2", "")); 
	   } //end function


    //Eliminar producto
    $(document).on('click', '#q-t', function(){
      id = $(this).val();
      $('#fila_'+id).remove();

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
           	iva_1 = $('#canti_'+idp).attr('value');
           t_iva_ = parseFloat(c_a) + parseFloat(iva_1);
          $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_, " ", "2", ""));
          $('#t_t_iva').text(accounting.formatMoney(t_iva_));

           }

           


    	});


    //cuando se termne de ejcutar el forech multiplicamos el iva por 0.16
      t_iva_total = $('#t_t_iva').attr('value') * 0.16;
       $('#t_t_iva').attr('value', accounting.formatMoney(t_iva_total, " ", "2", ""));
       $('#t_t_iva').text(accounting.formatMoney(t_iva_total));

       //total
       total_mas_iva = parseFloat($('#t_t_iva').attr('value')) + parseFloat($('#totalp-d-d').attr('value'));
       $('#total_mas_iva').text(accounting.formatMoney(total_mas_iva));
       $('#total_mas_iva').attr('data-pedido', accounting.formatMoney(total_mas_iva, " ", "2", ""));

           //comprobamos si hay mas productos en el pedido, en caso de que no ocultamos la tabla de los pedidos
           if($('.idpro').length == 0){
           		$(".bodycarrito").load(location.href+" .bodycarrito>*","");
				$('#t-pedidoc').hide();
			} else {

			}

    });

        //Vaciar pedido ----------
    $('#v-pedido').click(function(){

         $(".bodycarrito").load(location.href+" .bodycarrito>*","");
         $('#t-pedidoc').hide();
         $(".t-ext").load(location.href+" .t-ext>*","");
         $('.t-ext').hide();
         $('#add-extras').show();
         $('#add-extras-s').attr('data-id', 0);

  });





//Extras------------------------------------------------------------------------------
  // Agregar extras
  $(document).on('click', '#add-extras', function(){
    $('#modalextras').modal({
      show:'false',
    });
  });

   $(document).on('click', '#env-extras', function(){

   	extra = $('#txt-extra').val();

    $.ajax({
        type: "GET",
        url: "/productos/mostrarextra",
        success: function (e) {
               if(e == 'Vacio'){
               		alertas('error',"Actualmente no se pueden agregar extras." );
               		$('#txt-extra').val('');
               } else {

               	 $('#add-extras-s').attr('data-id', 1);
               	 $('#add-extras').hide();
               	 body = $('#b-extra');
               	 fila = "";

               	 fila += '<tr>'+
               	 				'<td class="text-clave">'+e.clave+'</td>'+
               	 				'<td class="text-contenido"><div id="tdextra" class="div-extra">'+extra+'</div></td>'+
               	 				'<td class="td-btn">'+
               	 					'<span class="edit-extra btn btn-xs btn-info glyphicon glyphicon-edit" data-clave="'+clave+'"></span>'+
               	 				'</td>'+
               	 				'<td>'+ 
               	 				   '<span class="quitarextra btn btn-xs btn-danger glyphicon glyphicon-remove"></span>'+
               	 				 '</td>'+
               	 		 '</tr>';

               	 	body.append(fila);
               	 	$('.t-ext').show();
               	 	$('#txt-extra').val('');

               }


        },

        error: function () {
            alert("failure");
        }
    });


  });

   //Editar extra
$(document).on('click', '.edit-extra', function(){


  extra = $('#tdextra').text();

   $('#txt-extra-edit').attr('value', extra);
   $('#txt-extra-edit').val(extra);
  
   $('#modalextraedit').modal({
      show:'false',
    });

$('#env-extras-actualizar').attr('value', clave);

});

$(document).on('click', '#env-extras-actualizar', function(){

  extra = $('#txt-extra-edit').val();

   $('#tdextra').text(extra);


});

//eliminar extra
$(document).on('click', '.quitarextra', function(){

  $(".t-ext").load(location.href+" .t-ext>*","");
  $('.t-ext').hide();
  $('#add-extras').show();
  $('#add-extras-s').attr('data-id', 0);


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


  $("#env-extras-actualizar").click(function () {

      if($("#txt-extra-edit").val().length == 0){
              $('.icon-area').addClass('glyphicon glyphicon-remove form-control-feedback');
              $('.area-extra').addClass('has-error has-feedback');
              return false;

      } else {
          return true;
      }
});

   $("#txt-extra-edit").focus(function(){
    $('.icon-area').removeClass('glyphicon glyphicon-remove form-control-feedback');
    $('.area-extra').removeClass('has-error has-feedback');

  });

  $(document).on('click', '#can-extras-edit', function(){
  $('.icon-area').removeClass('glyphicon glyphicon-remove form-control-feedback');
    $('.area-extra').removeClass('has-error has-feedback');


});

  



