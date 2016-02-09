@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent

@stop

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('menu_users')
  @parent
@stop

@section('menu')

@stop

@section('content')
<div class="users">
  <section class="container">
     @include('layouts/inc/estatus')
     @include('layouts/inc/alerts')
    	<h1 class="text-center text-primary list-p">Lista de pedidos</h1>
      		<div class="content-ver">
				<div class="btn-group">
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				    Ver por
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
				    <li><a class="v-pendiente" href="#">Pendientes</a></li>
				    <li><a class="v-proceso" href="#">En proceso</a></li>
				    <li><a class="v-pagado" href="#">Pagados</a></li>
				    <li><a class="v-cancelado" href="#">Cancelados</a></li>
				    <li><a class="v-todo" href="#">Todos</a></li>
				  </ul>
				</div>
      			
      		</div>
           <div class="table-responsive t-agentes">
           		<table class="table table-striped table-hover t-ag">
           			<thead class="c-agentes">
           				<tr>
           					<th>N° Pedido</th>
           					<th>N° Cliente</th>
           					<th>Fecha de registro</th>
           					<th>Estatus</th>
           				</tr>
           			</thead>
           			<tbody id="datos_a">

           			</tbody>
           		</table>
           </div>

 </section>
</div> <!-- Content users -->

	<!--Modal para cambiar el estatus del pedido-->
    <div id="modalpedido" class=" modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog m-detalle">
        <div class="modal-content content-p">
          <div class="modal-header header-detalle">
            <button type="button" class="close close-mp" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center d-pe"></h4>
           <h4 class="modal-title text-center d-fe"></h4>
          </div>
          <div class="modal-body content-datos">
          	<div class="cont-btn">
          	   <span class="btnmenu-pedido btn">
          		<span class="glyphicon glyphicon-th-list"></span>
          	   </span>
          	</div>
            <div class="d-detallep">
			 <div class="content-navp">
			 	<ol class="breadcrumb navegacion-p">
				  <li><a id="det-p" href="#">Detalle del pedido</a></li>
				  <li><a id="fotop" href="#">Detalle del cliente</a></li>
				  <li><a id="coment" href="#">Observaciones</a></li>
				  <li><a id="totalp" href="#">Total</a></li>
				  <li><a id="estatusp" href="#">Estatus</a></li>
			   </ol>
			 </div>
            <div class="table-responsive table-pd">
              <table class="table table-striped table-hover td-pedido">
                <thead class="c-pedidod">
                  <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Piezas por paquete</th>
                    <th>Cantidad de paquetes</th>
                    <th>Foto</th>
                    <th>Total producto</th>
                  </tr>
                </thead>
                <tbody id="d-dpedido" class="b-pedidod">
                 	
              	</tbody>
             </table>
           </div>
           <div class="table-responsive table-cli">
              <table class="table cliente-pedido">
                <tbody id="cli-dpedido" class="cli-pedidod">
                 	<tr>
                  <td>RFC: <span class="c_rfc"></span> <span class="cir">• </span>Nombre: <span class="c_nombre"></span> <span class="cir">• </span>Correo: <span class="c_correo"></span> <span class="cir">• </span>N° cliente: <span class="c_numero"></span></td>
                </tr>
                <tr>
                  <td>País: <span class="c_pais"> </span><span class="cir">• </span>Estado: <span class="c_estado"></span> <span class="cir">• </span>Municipio: <span class="c_municipio"></span></td>
                </tr>
                <tr>
                  <td>Calle 1: <span class="c_calle1"></span> <span class="cir">• </span>Calle 2: <span class="c_calle2"></span> <span class="cir">• </span>Colonia: <span class="c_colonia"></span></td>
                </tr>
                <tr>
                  <td>Delegacion: <span class="c_delegacion"></span> <span class="cir">• </span>CP: <span class="c_cp"></span> <span class="cir">• </span>Teléfono: <span class="c_telefono"></span></td>
                </tr>
              	</tbody>
             </table>
           </div>
            </div>
            <div class="estatus-pe">
            	<div class="content-est">
            		<h3 class="text-info text-center">Estatus del pedido</h3>
					<div class="header-e">
					<h3 class="estatus_a"></h3>
					</div>
		
					<div class="select-e">
						<a class="pendiente" data-id="0" href="#cambiarestatus" data-toggle="modal">Pendiente</a>
						<a class="proceso" data-id="1" href="#cambiarestatus" data-toggle="modal">En proceso</a>
						<a class="pagado" data-id="2" href="#cambiarestatus" data-toggle="modal">Pagado</a>
						<a class="cancelado" data-id="3" href="#cambiarestatus" data-toggle="modal">Cancelado</a>
					</div>
					
				</div>
            </div>
            <div class="es-t">
            	<div class="content-est-t">            	      
					<div>
					<h2 class="text-info text-center text-t-p">Total pedido:</h2>
            		<table class="table-t-p table">
            			<tr>           				
            				<td>Subtotal: <span class="sub-p"></span></td>
            			</tr>
            			<tr>
            				<td>Iva: <span class="sub-iva"></span></td>
            			</tr>
            			<tr>
            				<td>Total: <span class="total-p"></span></td>
            			</tr>
            		</table>
					</div>
				</div>
            </div>
            <div class="comen-t">
            	<div class="content-est-t"> 
					<div class="coment">
            		    <h2 class="text-info text-o text-center">Observaciones</h2>           	      
	            		<h3 class="text-center text-coment">Aqui hay muchos comentarios</h3>
					</div>
				</div>
            </div>
          </div>
          <div class="modal-footer modal-conf-estat">

              <span id="con-pd" class="sa-p btn btn-primary" data-dismiss="modal" >
                <span class="glyphicon glyphicon-chevron-left"></span>
                 Cerrar
              </span> 
          </div> 
        </div>
      </div>
    </div> 

    	<!--Modal para cambiar el estatus del pedido-->
    <div id="cambiarestatus" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
              Cambiar estatus.
             </h4>
          </div>
          <div class="modal-body">
            <h2 class="text-danger text-center c-status">¿Está seguro que desea cambiar el estatus del pedido?</h2>
          <span class="label label-danger esta center"></span>
          </div>
          <div class="modal-footer modal-confirmar">

              <span id="" class="conf-pd btn btn-primary confirm" data-dismiss="modal" >Si</span> 
              <button id="no-p" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
          </div> 
        </div>
      </div>
    </div> 

       	<!--Modal para ver la foto del pedido-->
    <div id="verfotop" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content c-fotope">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title title-f text-info text-center">
            <span class="glyphicon glyphicon-picture"></span>
              
             </h4>
          </div>
          <div class="modal-body m-foto">
            <div class="v-foto">
                <img class="f-p-p" alt="Foto del producto">
            </div>
          </div>
          <div class="modal-footer f-foto modal-confirmar">
              
          </div> 
        </div>
      </div>
    </div> 




{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/accounting.min.js') }}
{{ HTML::script('js/principal.js') }}
<script>
	$(document).ready(function(){



		$('.btnmenu-pedido').click(function(){
			$('.content-navp').slideToggle(500);
		});

		//$('.content-datos').hide();
		$('.cancel-r').hide();
		$('.es-t').hide();
		$('.estatus-pe').hide();
		$('#confrim-e').hide();
		$('.comen-t').hide();

		$('.ver-list').hide();
		$('.table-cli').hide();

		$('.g-v').click(function(){
			$('.ver-list').slideToggle(500);
		});

		$('.v-pendiente').click(function(){
			id = $(this).attr('id');
			$('.fila_0').show();
			$('.fila_1').hide();
			$('.fila_2').hide();
			$('.fila_3').hide();
			$('.ver-list').slideUp(500);

		});

		$('.v-proceso').click(function(){
			id = $(this).attr('id');
			$('.fila_1').show();
			$('.fila_0').hide();
			$('.fila_2').hide();
			$('.fila_3').hide();
			$('.ver-list').slideUp(500);
		});

		$('.v-pagado').click(function(){
			id = $(this).attr('id');
			$('.fila_2').show();
			$('.fila_0').hide();
			$('.fila_1').hide();
			$('.fila_3').hide();
			$('.ver-list').slideUp(500);
		});

		$('.v-cancelado').click(function(){
			id = $(this).attr('id');
			$('.fila_3').show();
			$('.fila_0').hide();
			$('.fila_1').hide();
			$('.fila_2').hide();
			$('.ver-list').slideUp(500);
		});

		$('.v-todo').click(function(){
			id = $(this).attr('id');
			$('.fila_3').show();
			$('.fila_0').show();
			$('.fila_1').show();
			$('.fila_2').show();
			$('.ver-list').slideUp(500);
		});


            tabla_a = $('#datos_a');
            $.ajax({
                type: "GET",
                url: "pedidos/listarpedidos", 
                success: function (p) {
             		pe = "";
             		for(datos in p.pedido){
                    pe += '<tr class="fila_'+p.pedido[datos].estatus+'" id="tr_'+p.pedido[datos].id+'"><td><a id="c-estatus" class="'+p.pedido[datos].estatus+'" data-id="'+p.pedido[datos].id+'" value="'+p.pedido[datos].numero_cliente+'" href="#modalpedido" data-toggle="modal">'+p.pedido[datos].num_pedido+'</a></td>';
                    pe += '<td>'+p.pedido[datos].numero_cliente+'</td>';
                    pe += '<td>'+p.pedido[datos].created_at+'</td>';


                    pe += '<td><span class="estatus_'+p.pedido[datos].estatus+'"></span></td></tr>';
                    }

                 	tabla_a.append(pe);

                 	
                 		$('.estatus_0').text('Pendiente');
                 		$('.estatus_0').addClass('text-warning');
                 		$('.estatus_1').text('En proceso');
                 		$('.estatus_1').addClass('text-primary');
			            $('.estatus_2').text('Pagado');
			            $('.estatus_2').addClass('text-success');
			            $('.estatus_3').text('Cancelado');
			            $('.estatus_3').addClass('text-danger');
                  
                },
                error: function () {
                    alert("failure");
                }
            });

           $(document).on('click','#c-estatus', function(){
	           	 id = $(this).attr('data-id');
	           	 //idfila = $('#tr_'+id).attr('id');
	           	 //alert(idfila);
	           	 num = $(this).attr('value');
	           	 $('.conf-pd').attr('value',num);
	           	
	           	 tabla_d = $('#d-dpedido');
		          $.ajax({
		            type: "POST", //metodo
		            url: "pedidos/infopedidos",
		            data: {id: id},
		            success: function (p) {
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

		               $('.text-coment').text(p.ped[0].observaciones);

		                pro = "";
             		for(datos in p.pro){
	                    pro += '<tr><td>'+p.pro[datos].clave+'</td>';
	                    pro += '<td>'+p.pro[datos].nombre+'</td>';
	                    pro += '<td>'+p.pro[datos].color+'</td>';
	                    pro += '<td>'+p.pro[datos].precio_venta+'</td>';
	                    pro += '<td>'+p.pro[datos].piezas_paquete+'</td>';
	                    pro += '<td>'+p.pro[datos].cantidad+'</td>';
	                    pro += '<td><span class="img-p" id="'+p.pro[datos].nombre+'" data-id="'+p.pro[datos].foto+'" href="#verfotop" data-toggle="modal" alt="Foto del producto" title="Ver Foto del prodcto">Ver foto</span></td>';
	                    pro += '<td class="t-pro">'+p.pro[datos].precio_venta * p.pro[datos].cantidad+'</td></tr>';
                    }

                 	tabla_d.append(pro);
                 	//$('.content-datos').slideDown(300);

		            },
		            error: function () {
		                alert('failure');
		            }
		        }); 

           });

		//Foto del producto
		$(document).on('click','.img-p',function(){
			foto = $(this).attr('data-id');
			nf = $(this).attr('id');
			$('.f-p-p').prop('src', 'img/productos/'+foto);
			$('.title-f').html(nf);
		});

		//Mostarr el tsubtotal, Iva y total
		$(document).on('click','#totalp', function(){
			resultado=0;
			$('.td-pedido tbody tr').each(function(){
	            cant  = $(this).find("[class*='t-pro']").html();

	            resultado += parseInt(cant);

          });

			$('.sub-p').html(accounting.formatMoney(resultado));
			$('.sub-iva').html(accounting.formatMoney(iva = resultado * 0.16));
			$('.total-p').html(accounting.formatMoney(resultado += iva));


		});

		//Actualizaciones de contenidos de la pagina
		$(document).on('click', '#con-pd', function(){
				//Actualizamos la tabla detalle del pedido
			   $("#d-dpedido").load(location.href+" #d-dpedido>*","");
			   //10000  milisegundos
		});

		$(document).on('click', '.close-mp', function(){
			$("#d-dpedido").load(location.href+" #d-dpedido>*","");
		});


		    		
			$('#det-p').click(function(){
				$('#det-p').css('text-decoration', 'none');
				$('.table-pd').fadeIn(500);
				$('.table-cli').hide();
			});

			$('#fotop').click(function(){
				$('#fotop').css('text-decoration', 'none');
				$('.table-pd').hide();
				$('.table-cli').fadeIn(500);
			});

			$('#coment').click(function(){
				$('#coment').css('text-decoration', 'none');
				$('.estatus-pe').hide();
				$('.es-t').hide();
				$('.comen-t').fadeToggle(500);
				$('#estatusp').fadeIn();
				$('.select-e').slideUp();
			});

			$('#totalp').click(function(){
				$('#totalp').css('text-decoration', 'none');
				$('.estatus-pe').hide();
				$('.comen-t').hide();
				$('.es-t').fadeToggle(500);
				$('#estatusp').fadeIn();
				$('.select-e').slideUp();
			});

			$('#estatusp').click(function(){
				$('#estatusp').css('text-decoration', 'none');
				$('.estatus-pe').fadeToggle(500);
				$('.comen-t').hide();
				$('.es-t').hide();
			});
        
    /*     	console.log($('#estado').attr('data-id'));

           if($('.estatus').text() == 0){
             	console.log('el valor es cero');
             	$('.estatus').addClass('text-primary');
             } else {
             	console.log('1');
             } */
     $(document).on('click', '#c-estatus', function(){
     	id = $(this).attr('data-id');
     	estatus = $(this).attr('class');
     	$('.cancel-r').attr('data-id',estatus);

     	$.ajax({
     		type:'GET',
     		url:'pedidos/verestatus',
     		data:{id: id},
     		success: function(e){
     			$('.estatus_a').attr('id','estatus_'+e.estatus);
     			$('.estatus_a').attr('data-id',e.id);
     			$('.pendiente').attr('id',e.id);
     			$('.proceso').attr('id',e.id);
     			$('.pagado').attr('id',e.id);
     			$('.cancelado').attr('id',e.id);
	            $('#estatus_0').text('Pendiente');
	            $('#estatus_1').text('En proceso');
	            $('#estatus_2').text('Pagado');
	            $('#estatus_3').text('Cancelado');

     		},
     		error: function(){
     			alert('failure');
     		}

     	});


     });


     $('.cancel-e').click(function(){
     	$('.select-e').slideUp(500);
     });

     $('#no-p').click(function(){
     	$('.select-e').slideUp(500);
     });
        
     $(document).on('click','#est-p', function(){
		estado = $(this).val();
	});

	$('.header-e').click(function(){
		$('.select-e').slideToggle(500);
	});


	$('.pendiente').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
		$('.conf-pd').attr('data-id',dataid);
		$('.conf-pd').attr('id',id);
		$('.select-e').slideUp(300);
	});

	$('.proceso').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
		$('.conf-pd').attr('data-id',dataid);
		$('.conf-pd').attr('id',id);
		$('.select-e').slideUp(300);
	});

	$('.pagado').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
		$('.conf-pd').attr('data-id',dataid);
		$('.conf-pd').attr('id',id);
		$('.select-e').slideUp(300);
	});

	$('.cancelado').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
		$('.conf-pd').attr('data-id',dataid);
		$('.conf-pd').attr('id',id);
		$('.select-e').slideUp(300);
	});


	$(document).on('click', '.conf-pd', function(){
		estatus = $(this).attr('data-id');
		id = $(this).attr('id');
		$('.cancel-e').hide();
		$('.cancel-r').show();
		$('.cancel-r').attr('id',id);
		num = $(this).attr('value');
		//$('#tr_'+id).fadeOut(1000);
		//$("#tr_"+id).load(location.href+" #tr_>*"+id,"");
		

		$.ajax({
     		type:'GET',
     		url:'pedidos/cambiarestatus',
     		data:{id: id, estatus: estatus},
     		success: function(ed){
     		//Cambiamos el estatus del boton
     		if(ed.estatus == 0){
     			$('.estatus_a').text('Pendiente');
     		} else if(ed.estatus == 1){
     			$('.estatus_a').text('En proceso');
     		} else if(ed.estatus == 2){
     			$('.estatus_a').text('Pagado');
     		} else if(ed.estatus == 3){
     			$('.estatus_a').text('Cancelado');
     		} 
     		//Bolvemos a construir la fila
     		$('#tr_'+id).replaceWith('<tr class="fila_'+ed.estatus+'" id="tr_'+ed.id+'">'+
                '<td><a id="c-estatus" class="'+ed.estatus+'" data-id="'+ed.id+'" href="#modalpedido" data-toggle="modal">'+ed.num_pedido+'</a></td>'
                +'<td>'+num+'</td>'
                +'<td>'+ed.created_at+'</td>'
                +'<td><span class="estatus_'+ed.estatus+'"></span></td>'
                +'<tr/>');

 					//Le agregamos el texto del estatus
 		            $('.estatus_0').text('Pendiente');
             		$('.estatus_0').addClass('text-warning');
             		$('.estatus_1').text('En proceso');
             		$('.estatus_1').addClass('text-primary');
		            $('.estatus_2').text('Pagado');
		            $('.estatus_2').addClass('text-success');
		            $('.estatus_3').text('Cancelado');
		            $('.estatus_3').addClass('text-danger');
     		
     		},
     		error: function(){
     			alert('failure');
     		}

     	});

	});





	});

















</script>


@stop

