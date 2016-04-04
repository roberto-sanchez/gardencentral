@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
<style>

#list_p_ tbody tr {
  font-size:.8em;
  text-align: center;
}

 /*---Fila de los extras--*/
  .fila_extras, .fila_total{
    display:none;
  }

  .im-pedido{
    margin-right:.2em;
  }

  .c-carga{
    display:none;
  }

  #env_pdf{
    background:rgba(0, 0, 0, 0.7);
  }
  
  .img-gif{
    width:100%;
    margin:0 auto;
    text-align:center;
    margin-top:5em;
  }


  .txt-sal{
    cursor:pointer;
    font-size:1.8em;
  }

  .txt-sal:hover{
    color:#64A9F7;
    text-decoration:underline;
  }


</style>
@stop

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('pedidos_user') @stop

@section('menu_users')
  @parent
@stop

@section('menu')

@stop

@section('content')
<div class="users">
  <section class="container">
    	<h1 class="text-center text-primary list-p"></h1>
      		<div class="content-ver">
				<div class="btn-group">
				  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				    Ver por
				    <span class="caret"></span>
				  </a>
				  <ul class="dropdown-menu">
				    <li><a class="v-pendiente" href="#">Pendientes</a></li>
				    <li><a class="v-proceso" href="#">Crédito</a></li>
				    <li><a class="v-pagado" href="#">Pagados</a></li>
				    <li><a class="v-cancelado" href="#">Cancelados</a></li>
				    <li><a class="v-todo" href="#">Todos</a></li>
				  </ul>
				</div>

      		</div>
           <div class="table-responsive t-agentes">
           		<table id="list_p_" class="table table-striped table-hover t-ag">
           			<thead class="c-agentes">
           				<tr>
           					<th>N° Pedido</th>
           					<th>N° Cliente</th> 
           					<th>Fecha de registro</th>
                    <th>Cliente</th>
                    <th>Razón social</th>
                    <th>Total pedido</th>
                    <th>Extras</th>
           					<th>Estatus</th>
           				</tr>
           			</thead>
           		<!--	<tbody id="datos_a"></tbody>-->
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
				  <li><a class="enlace-active" id="det-p" href="#">Detalle del pedido</a></li>
				  <li><a id="fotop" href="#">Detalle del cliente</a></li>
				  <li><a id="estatusp" href="#">Estatus</a></li>
          <span title="Enviar pdf" class="en-pedido"> / Enviar pdf</span>
          <a title="Ver pdf" class="im-pedido" target="_blank" href=""> Ver pdf</a>
			   </ol>
			 </div>
            <div class="table-pd">
            <!--Tabla oculta para dispositivos moviles-->
              <table class="table table-striped table-hover td-pedido">
                <thead class="c-pedidod">
                  <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Iva</th>
                    <th>Cantidad</th>
                    <th>Foto</th>
                    <th>Total producto</th>
                  </tr>
                </thead>
                <tbody id="d-dpedido" class="b-pedidod">

              	</tbody>
             </table>
             <!--Tabla visible para dispositivos moviles-->
             <table class="table table-striped table-hover td-pedidoxs">
                <tbody id="d-dpedidoxs" class="b-pedidodxs">

              	</tbody>
             </table>
             <div class="cont-dt">
               <table class=" table-striped table-condensed table-hover  total-pedido de-t">
                  <tr>
                    <td id="subtotalp">
                      <span class="text-info">Subtotal:  </span>
                    </td>
                    <td id="totalp">
                      <span class="sub-p"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Iva: </span>
                    </td>
                    <td>
                       <span class="sub-iva"></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <span class="text-info">Total:  </span>
                    </td>
                    <td>
                      <span class="total-p">
                    </td>
                  </tr>
                  <tr class="fila_extras">
                    <td class="to-extra-data">
                      <span class="text-info">Extras: </span>
                    </td>
                    <td>
                       <span class="to-extra"></span>
                    </td>
                  </tr>
                  <tr class="fila_total">
                    <td>
                      <span class="text-info">Gran Total: </span>
                    </td>
                    <td>
                       <span class="gran-to-extra"></span>
                    </td>
                  </tr>
                </table>
             </div>
            <!--  <div class="cont-dtxs">
                <table class=" table-striped table-condensed table-hover de-txs">
                   <tr>
                     <td id="subtotalp">
                       <span class="text-info">Subtotal:  </span>
                     </td>
                     <td id="totalp">
                       <span class="sub-p"></span>
                     </td>
                   </tr>
                   <tr>
                     <td>
                       <span class="text-info">Iva: </span>
                     </td>
                     <td>
                        <span class="sub-iva"></span>
                     </td>
                   </tr>
                   <tr>
                     <td>
                       <span class="text-info">Total:  </span>
                     </td>
                     <td>
                       <span class="total-p">
                     </td>
                   </tr>
                 </table>
              </div>-->
            <button class="btn btn-xs btn-primary add-ext" id="add-extras">Agregar extras</button>
            <h3 class="text-info ext-d">Extras: </h3>
            <table class="table ta-extra tab-extra">
             <thead>
               <th>Clave</th>
               <th>Producto</th>
               <th>Total</th> 
               <th>Editar</th> 
               <th>Eliminar</th>  
             </thead>
             <tbody id="body-extras"></tbody>
           </table>

           </div>
           <div class="table-cli">
              <table class="table cliente-pedido">
                <tbody id="cli-dpedido" class="cli-pedidod">
                <tr id="sindomi">
                  <td>RFC: <span class="c_rfc"></span> <span class="cir">• </span>Nombre: <span class="c_nombre"></span> <span class="cir">• </span>Correo: <span class="c_correo"></span> <span class="cir">• </span>N° cliente: <span class="c_numero"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>País: <span class="c_pais"> </span><span class="cir">• </span>Estado: <span class="c_estado"></span> <span class="cir">• </span>Municipio: <span class="c_municipio"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>Calle 1: <span class="c_calle1"></span> <span class="cir">• </span>Calle 2: <span class="c_calle2"></span> <span class="cir">• </span>Colonia: <span class="c_colonia"></span></td>
                </tr>
                <tr class="pc_domiclio">
                  <td>Delegacion: <span class="c_delegacion"></span> <span class="cir">• </span>CP: <span class="c_cp"></span> <span class="cir">• </span>Teléfono: <span class="c_telefono"></span></td>
                </tr>
              	<tr class="pc_domiclio onservaciones">
              		<td>
              			<div class="ob">Observaciones: <span class="c_observaciones"></span> </div>

              		</td>
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
            @if(Auth::user()->rol_id == 2)
              <a class="pendiente" data-id="0" href="#cambiarestatus" data-toggle="modal">Pendiente</a>
              <a class="cancelado" data-id="3" href="#cambiarestatus" data-toggle="modal">Cancelado</a>
              @else
                <a class="pendiente" data-id="0" href="#cambiarestatus" data-toggle="modal">Pendiente</a>
                <a class="proceso" data-id="1" href="#cambiarestatus" data-toggle="modal">Crédito</a>
                <a class="pagado" data-id="2" href="#cambiarestatus" data-toggle="modal">Pagado</a>
            @endif
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

        
                
        

    	<!--Modal para confirmar cambiar el estatus del pedido-->
    <div id="cambiarestatus" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
              Cambiar estatus.
             </h4>
          </div>
          <div class="modal-body confirmarpass">
            @if(Auth::user()->rol_id == 2)
            <h2 class="text-danger text-center c-status">¿Está seguro que desea cambiar el estatus del pedido?</h2>
            @else
            <h2 class="text-danger text-center c-status-c">¿Está seguro que desea cambiar el estatus del pedido?</h2>
              <div class=" input-group input-pass has-feedback">
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-lock"></span>
                </span>
                 {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña', "id" => 'campo-pass')) }}
                 <span class="add-gly"></span>
              </div>
              <div class="comparar-pass">
                <span class="text-success v-password" id="msgPassA">verificando...</span>
              </div>
            @endif

          </div>
          <div class="modal-footer modal-confirmar">

              <button id="no-p" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              @if(Auth::user()->rol_id == 2)
                <span id="" class="c-pass regist-c btn btn-primary confirm" data-dismiss="modal" >Si</span>
               @else
                  <span class="c-pass regist-c-conta regist-c disabled btn btn-primary confirm" data-dismiss="modal" ><span class="estado_i"></span>Si</span>
              @endif
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

  <!--Modal para agregar extras-->
        <div id="modalextras" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary text-center">
                  <span class="glyphicon glyphicon-plus"></span>
                  Agregar extras
                </h4>
              </div>
              <div class="modal-body body-extras">
                <div class="area-nota error-c">
                  <label class="text-info label-ext">Extras: </label>
                  <textarea id="txt-extra" class="form-control" rows="5"></textarea>
                  <span class="icon-c"></span>
                </div>
                <div class="t-pre">
                  <label class="text-info label-ext">Total: </label>
                  <div class="input-group has-feedback error-t">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-usd"></span>
                    </span>
                      <input type="number" class="form-control" id="p-total" placeholder="Precio total">
                      <span class="icon-t"></span>
                   </div>
                   @foreach($p as $extra)
                     <input type="text" class="hidden" id="inp-extras" value="{{ $extra->clave }}">
                   @endforeach
                </div>
              </div>
              <div class="modal-footer modal-confirmar">
                <button id="can-extras" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
                <button id="env-extras" class="btn btn-primary confirm" data-dismiss="modal">Agregar</button>
              </div>
            </div>
          </div>
        </div>


  <!--Modal para editar extras-->
        <div id="modalextrasedit" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-primary text-center">
                  <span class="glyphicon glyphicon-edit"></span>
                  Editar extras
                </h4>
              </div>
              <div class="modal-body body-extras">
                <div class="area-nota error-c">
                 <label class="text-info label-ext">Extras: </label>
                 <textarea id="txt-extraedit" class="form-control" rows="5"></textarea>
                 <span class="icon-c"></span>
                </div>
                <div class="t-pre">
                  <label class="text-info label-ext">Total: </label>
                  <div class="input-group has-feedback error-t">
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-usd"></span>
                    </span>
                      <input type="number" class="form-control" id="p-total-edit" placeholder="Precio total">
                      <span class="icon-t"></span>
                   </div>
                </div>
              </div>
              <div class="modal-footer modal-confirmar">
                <button id="can-act-extras" type="button" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
                <button id="act-extras" class="btn btn-primary confirm" data-dismiss="modal">Actualizar</button>
              </div>
            </div>
          </div>
        </div>

<!--Modal para elimanr extras-->
<div id="modaldeleteextra" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
              <span class="glyphicon glyphicon-trash"></span>
              Eliminar extra
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n text-danger text-center">¿Estás seguro que deseas eliminar este producto?</h3>
                
          </div>
          <div class="modal-footer modal-confirmar-pass">
              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
              <span id="de-ex" class="btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>

    
        <!--  Modal para confirmar enviar pdf  -->
<div id="confirm-e-email" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-nota">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-danger text-center">
            <span class="glyphicon glyphicon-envelope"></span>
              Enviar correo
             </h4>
          </div>
          <div class="modal-body">
            
          <h3 class="txt-delete-n txt-env-email text-danger text-center">¿Estás seguro que deseas enviar este pdf?</h3>
          <h3 class="txt-delete-n text-msj-email text-primary text-center">Para: <div class="correo-email"><input type="text" class="para-email form-control" disabled><button title="Editar correo" class="btn btn-primary edit-email"><span class=" glyphicon glyphicon-edit"></span></button></div></h3>
          <h3 class="txt-delete-n txt-asunto-email text-primary text-center">Asunto: </h3>
          <div class="area-msj-email">
            <textarea id="asunto-email" cols="10" rows="3" class="form-control"></textarea>
          </div>

                
          </div>
          <div class="modal-footer modal-confirmar-pass">

              <button id="no-email" class="btn btn-danger confirm" data-dismiss="modal">Cancelar</button>
              <span id="env-email" class="btn btn-primary confirm" data-dismiss="modal" >Enviar</span>
          </div>
        </div>
      </div>
    </div>

 <!-- Modal cuando se envia nuevamente el pdf -->
      <div id="env_pdf" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <div class="img-gif">
            <img class="img-proce" src="img/Cargandocc.gif" width="200px">
            <h1 class="text-info text-center txt-pro">Procesando..</h1>
            <h1 class="text-center text-info txt-msj">El pdf ha sido enviado correctamente.</h1>
            <h2 class="text-center text-info txt-sal">< Salir</h2>
          </div>
          <div class="modal-content c-carga">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>




{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/accounting.min.js') }}
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


    		$('.t-agentes').hide();
    		$('.content-ver').hide();

            

            $.ajax({
                dataType: 'json',
                url: "/pedidos/listarpedidos",
                success: function (p) {
                	if(p == 0){
                		$('.list-p').text('No tienes ningún pedido asignado.');
             			} else {
             			$('.list-p').text('Lista de pedidos.');
             			$('.t-agentes').show();
    		          $('.content-ver').show();
                }

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

                  "sInfo": "Mostrando del _START_ a _END_ (Total: _TOTAL_ resultados)", 
                  "sInfoFiltered": " - filtrados de _MAX_ registros", 
                  "sInfoEmpty": "No hay resultados de búsqueda", 
                  "sZeroRecords": "No hay registros a mostrar", 
                  "sProcessing": "Espere, por favor...", 
                  "sSearch": "Buscar:", 

               },

                "aaSorting": [[ 2, "desc" ]], 

                fnCreatedRow : function (nRow, aData, iDataIndex) {
                     $(nRow).addClass("fila_"+p[i].estatus);
                     $(nRow).attr('id', "tr_"+p[i].id);
                               
                },


                "sPaginationType": "simple_numbers",
                 "sPaginationType": "bootstrap",



            });


                    tabla_a.fnClearTable();
                    //console.log(p[0].f_cant);

                      for(var i = 0; i < p.length; i++) {

                              //t = p[i].total * 0.16;
                              total = p[i].total;

                                tabla_a.fnAddData([
                                       '<a id="c-estatus" class="'+p[i].estatus+' v_'+p[i].razon_social+'" data-id="'+p[i].id+'" value="'+p[i].razon_social+'" href="#modalpedido" data-toggle="modal" data-fecha="'+p[i].created_at+'">'+p[i].num_pedido+'</a>',
                                        p[i].numero_cliente,
                                        p[i].created_at,
                                        p[i].nombre_cliente+" "+p[i].paterno,
                                        '<span class="v_r_'+p[i].razon_social+'" value="'+p[i].razon_social+'">'+p[i].razon_social+'</span>',
                                        '<span id="idp_'+p[i].id+'" value="'+total+'" class="text-success">'+accounting.formatMoney(total)+'</span>',
                                        '<span id="e_'+p[i].id+'" class="extra_'+p[i].extra_pedido+' verificar-extra" data-extra="'+p[i].extra_pedido+'" data-id="'+p[i].id+'"></span>',
                                        '<span class="estatus_'+p[i].estatus+'"></span>',
                                      ]);



                            }



                        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
                        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

                        $('.v_').attr('value', 'Sin razón social');
                        $('.v_r_').text('Sin razón social');
                        $('.v_r_').addClass('text-info');

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

                        verextra();

                },
                error: function () {
                    alert("failure");
                }
            });




    
      $(document).on('click','.fancy > li, a',function(){
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

        $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social');
        $('.v_r_').addClass('text-info');

        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
        verextra();
      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

        $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social');
        $('.v_r_').addClass('text-info');

        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
        verextra();
      });

      $(document).on('click', '#list_p__length', function(){
        $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');
        $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

        $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social');
        $('.v_r_').addClass('text-info');

        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
        verextra();
      });

          

           $(document).on('click','#c-estatus', function(){
               p = $(this).text();
               f = $(this).attr('data-fecha');
               $('.d-pe').html('#'+p);
               $('.d-fe').html('Fecha: '+f);
	           	 id = $(this).attr('data-id');
               $('.im-pedido').attr('href', '/productos/imprimirpedido/'+id);
               $('#env-email').attr('data-pedido', id);
               $('#env-extras').attr('data-id', id);
	           	 razon = $(this).attr('value');
	           	 $('.c-pass').attr('id',razon);
               es_i = $(this).attr('class');
               total = $('#idp_'+id).text();
               ex = $('#ide_'+id).attr('class');
               t = $('#idp_'+id).attr('value');
               $('.c-pass').attr('data-total', total);
               $('.c-pass').attr('data-extra', ex);
               $('#de-ex').attr('data-pedido', id);
               $('.c-pass').attr('data-valor', t);
               $('.header-e').attr('id', es_i);
	           	 tabla_d = $('#d-dpedido');
		          $.ajax({
		            type: "POST", //metodo
		            url: "pedidos/infopedidos",
		            data: {id: id},
		            success: function (p) {
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

                     

                   if(p.ped[0].observaciones == " "){
                      $('.c_observaciones').text('No ay observaciones.');
                   } else {

                        $('.c_observaciones').text(p.ped[0].observaciones);
                   }
                  }

		                pro = "";
             		for(datos in p.pro){
                  f = (p.pro[datos].precio) * p.pro[datos].cantidad;

	                    pro += '<tr><td>'+p.pro[datos].clave+'</td>';
                      pro += '<td>'+p.pro[datos].nombre+'</td>';
                      pro += '<td>'+p.pro[datos].color+'</td>';
                      pro += '<td>'+accounting.formatMoney(p.pro[datos].precio)+'</td>';

                      if(p.pro[datos].iva0 == 0){
                       pro += '<td class="c-iva" data-iva="0">0%</td>';
                        
                      } else {
                        pro += '<td class="c-iva" data-iva="16">16%</td>';
                      }

                      pro += '<td>'+p.pro[datos].cantidad+'</td>';
                      pro += '<td><span class="img-p" id="'+p.pro[datos].nombre+'" data-id="'+p.pro[datos].foto+'" href="#verfotop" data-toggle="modal" alt="Foto del producto" title="Ver Foto del prodcto">Ver foto</span></td>';
                      pro += '<td class="t-pro" value="'+f+'">'+accounting.formatMoney(f)+'</td></tr>';
                    }

                 	tabla_d.append(pro);



          //Mostarr el subtotal, Iva y total
					resultado=0;
          totaliva=0;
					$('.td-pedido tbody tr').each(function(){
			            cant  = $(this).find("[class*='t-pro']").attr('value');
                  iv  = $(this).find("td[class*='c-iva']").attr('data-iva');

                  if(iv  == 0){

                  } else {
                    totaliva += parseFloat(cant) * 0.16;
                  }

			            resultado += parseFloat(cant);
                  //console.log(totaliva);
					        $('.sub-p').text(accounting.formatMoney(resultado));
                  $('.sub-iva').html(accounting.formatMoney(totaliva));

                });

				  	
            $('.total-p').html(accounting.formatMoney(resultado += totaliva));

		            },

		            error: function () {
		                alert('failure');
		            }
		        });



			/*	 tabla_dxs = $('#d-dpedidoxs');
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

		               if(p.ped[0].observaciones == " "){
		               		$('.c_observaciones').text('No ay observaciones.');
		               } else {

		                    $('.c_observaciones').text(p.ped[0].observaciones);
		               }


		                pro = "";
             		for(datos in p.pro){
                  des = p.pro[datos].precio * p.pro[datos].descuento;
                  e = accounting.formatMoney(p.pro[datos].precio - des);
                  f = (p.pro[datos].precio - des) * p.pro[datos].cantidad;
                  t = accounting.formatMoney(p.pro[datos].precio);

	                    pro += '<tr><td>Clave: '+p.pro[datos].clave+'</td></tr>';
	                    pro += '<tr><td>Nombre: '+p.pro[datos].nombre+'</td></tr>';
	                    pro += '<tr><td>Color: '+p.pro[datos].color+'</td></tr>';
	                    pro += '<tr><td>Precio: '+e+'</td></tr>';
	                    pro += '<tr><td>Piezas por paquete: '+p.pro[datos].piezas_paquete+'</td></tr>';
	                    pro += '<tr><td>Cantidad de paquetes: '+p.pro[datos].cantidad+'</td></tr>';
	                    pro += '<tr><td><span class="img-p" id="'+p.pro[datos].nombre+'" data-id="'+p.pro[datos].foto+'" href="#verfotop" data-toggle="modal" alt="Foto del producto" title="Ver Foto del prodcto">Ver foto</span></td></tr>';
	                    pro += '<td class="t-pro" value="'+f+'">'+accounting.formatMoney(f)+'</td></tr>';
                    }

                 	tabla_dxs.append(pro);


                 	//Mostarr el subtotal, Iva y total
        					resultado=0;
        					$('.td-pedido tbody tr').each(function(){
        			            cant  = $(this).find("[class*='t-pro']").attr('value');

        			            resultado += parseFloat(cant);
                          $('.sub-p').text(accounting.formatMoney(resultado));
        		            });

        					$('.sub-iva').html(accounting.formatMoney(iva = resultado * 0.16));
        					$('.total-p').html(accounting.formatMoney(resultado += iva));

		            },

		            error: function () {
		                alert('failure');
		            }
		        }); */


      });

          $('.txt-msj').hide();
          $('.txt-sal').hide();

          $(document).on('click','.en-pedido', function(){
            e = $('.c_correo').html();
            $('.para-email').val(e);
            $('#confirm-e-email').modal({
              show: 'false',
            });

          });


          //Reenviar pdf
          $(document).on('click','#env-email', function(){
              id = $(this).attr('data-pedido');
              e = $('.para-email').val();
              asunto = $('#asunto-email').val();
               $.ajax({
                      type: "GET",
                      url: "/productos/enviaremail/"+id,
                      data: {e: e, asunto: asunto},
                      beforeSend: function(){
                          $('#env_pdf').modal({
                                show:'false',
                              });
                      },
                      success: function( p ){
                              $('.txt-pro').hide();
                              $('.img-proce').hide();
                              $('.txt-msj').show();
                              $('.txt-sal').show();
                              $('#asunto-email').val(' ');
                              $('.para-email').attr('disabled', true);
                              
                           }

                   });

          });

          //Editar correo
          $(document).on('click','.edit-email', function(){
              $('.para-email').attr('disabled', false);
          });

          $(document).on('click','#no-email', function(){
            $('#asunto-email').val(' ');
            $('.para-email').attr('disabled', true);

          });

          $(document).on('click','.txt-sal', function(){
            $('#env_pdf').modal('hide');
            $('.txt-pro').show();
            $('.img-proce').show();
            $('.txt-msj').hide();
            $('.txt-sal').hide();

          });

            $(document).on('click', '#c-estatus', function(){
                idp = $(this).attr('data-id');
                $('#act-extras').attr('data-pedido', idp);
                  //Extras -----
                  $.ajax({
                      type: "GET",
                      url: "/pedidos/verextra",
                      data: {idp: idp},
                      success: function( e ){
                              if(e.n == 0){
                                $('.add-ext').show();
                              } else {

                                $('.tab-extra').show();
                                $('.ext-d').show();
                                body = $('#body-extras');
                                fila = "";
                                for(datos in e.extra){

                                  fila += '<tr id="ex_'+e.extra[datos].id+'"><td>'+e.extra[datos].clave+'</td>';
                                  fila += '<td id="desc_'+e.extra[datos].id+'">'+e.extra[datos].descripcion+'</td>';
                                  fila += '<td data-total="'+e.extra[datos].total+'" id="t_'+e.extra[datos].id+'" value="'+e.extra[datos].total+'" class="total_"></td>';
                                  fila += '<td><span id="edit-ext" value="'+e.extra[datos].id+'"  class="btn btn-info btn-xs glyphicon glyphicon-edit"></span></td>';
                                  fila += '<td><span id="delet-ext" value="'+e.extra[datos].id+'" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></span></td></tr>';
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
                                
                              

                              }

                           }

                   });

              });


		//Foto del producto
		$(document).on('click','.img-p',function(){
			foto = $(this).attr('data-id');
			nf = $(this).attr('id');
			$('.f-p-p').prop('src', '/img/productos/'+foto);
			$('.title-f').html(nf);
		});



		//Actualizaciones de contenidos de la pagina
		$(document).on('click', '#con-pd', function(){
       $('.select-e').slideUp(300);
			 $('.estatus-pe').hide(); 
			 $('.table-cli').hide();
			 $("#d-dpedido").html('');
       $('#det-p').addClass('enlace-active');
       $('#fotop').removeClass('enlace-active');
       $('#estatusp').removeClass('enlace-active');
       $('.table-pd').show();
       $('.tab-extra').hide();
       $('#body-extras').html('');
       $('.ext-d').hide();
       $('.add-ext').hide();
       $('.fila_extras').hide();
       $('.fila_total').hide();
       
       $('.sub-iva').html('');
       
		});

		$(document).on('click', '.close-mp', function(){
			$('.estatus-pe').hide();
			$('.table-cli').hide();
      $('.select-e').slideUp(300);
			$("#d-dpedido").html('');
      $('#det-p').addClass('enlace-active');
      $('#fotop').removeClass('enlace-active');
      $('#estatusp').removeClass('enlace-active');
      $('.table-pd').show();
      $('.tab-extra').hide();
      $('#body-extras').html('');
      $('.ext-d').hide();
      $('.add-ext').hide();
      $('.fila_extras').hide();
      $('.fila_total').hide();
      
      $('.sub-iva').html('');
      
		});



			$('#det-p').click(function(){
				$('#det-p').css('text-decoration', 'none');
				$('.table-pd').fadeIn(500);
				$('.table-cli').hide();
        $('#det-p').addClass('enlace-active');
        $('#fotop').removeClass('enlace-active');
        $('#estatusp').removeClass('enlace-active');
			});

			$('#fotop').click(function(){
				$('#fotop').css('text-decoration', 'none');
				$('.table-pd').hide();
				$('.table-cli').fadeIn(500);
        $('#fotop').addClass('enlace-active');
        $('#det-p').removeClass('enlace-active');
        $('#estatusp').removeClass('enlace-active');
			});



			$('#estatusp').click(function(){

          //Comprobamos elestaud del pedido
          if($('.estatus_a').attr('id') == 'estatus_0'){
             $('.pendiente').hide();
             $('.proceso').show();
             $('.pagado').show();
             $('.cancelado').show();
          } else if($('.estatus_a').attr('id') == 'estatus_1'){
             $('.proceso').hide();
             $('.pendiente').show();
             $('.pagado').show();
             $('.cancelado').show();
          } else if($('.estatus_a').attr('id') == 'estatus_2'){
             $('.pagado').hide();
             $('.pendiente').show();
             $('.proceso').show();
             $('.cancelado').show();
          } else if($('.estatus_a').attr('id') == 'estatus_3'){
             $('.cancelado').hide();
             $('.pendiente').show();
             $('.pagado').show();
             $('.proceso').show();
          }

				$('#estatusp').css('text-decoration', 'none');
				$('.estatus-pe').fadeToggle(500);
				$('.comen-t').hide();
				$('.es-t').hide();
        $('#estatusp').addClass('enlace-active');
        $('#det-p').removeClass('enlace-active');
        $('#fotop').removeClass('enlace-active');
			});


     $(document).on('click', '#c-estatus', function(){
     	id = $(this).attr('data-id');
     	estatus = $(this).attr('class');
      razon = $(this).attr('value');
     	$('.table-pd').show();
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
	            $('#estatus_1').text('Crédito');
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
    gly_ex = $('#e_'+id).attr('class');
    truco = 'trco_0';
    $('.c-pass').attr('data-truco', truco);
    $('.c-pass').attr('data-gly', gly_ex);
		$('.c-pass').attr('data-id',dataid);
    $('.c-pass').attr('value',id);
		$('.select-e').slideUp(300);
	});

	$('.proceso').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
    gly_ex = $('#e_'+id).attr('class');
    truco = 'trco_1';
    $('.c-pass').attr('data-truco', truco);
    $('.c-pass').attr('data-gly', gly_ex);
		$('.c-pass').attr('data-id',dataid);
    $('.c-pass').attr('value',id);
		$('.select-e').slideUp(300);
	});

	$('.pagado').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
    gly_ex = $('#e_'+id).attr('class');
    truco = 'trco_2';
    $('.c-pass').attr('data-truco', truco);
    $('.c-pass').attr('data-gly', gly_ex);
		$('.c-pass').attr('data-id',dataid);
    $('.c-pass').attr('value',id);
		$('.select-e').slideUp(300);
	});

	$('.cancelado').click(function(){
		dataid = $(this).attr('data-id');
		id = $(this).attr('id');
    gly_ex = $('#e_'+id).attr('class');
    truco = 'trco_3';
    $('.c-pass').attr('data-truco', truco);
    $('.c-pass').attr('data-gly', gly_ex);
		$('.c-pass').attr('data-id',dataid);
    $('.c-pass').attr('value',id);
		$('.select-e').slideUp(300);
	});


	$(document).on('click', '.conf-pd', function(){
		$('#confirmpass').modal({
         show: 'false'
      });  

	});



  /*Verificar la contraseña del user */
  $('#campo-pass').keyup( function(){
    if($('#campo-pass').val()!= ""){
         pass = $('#campo-pass').val().trim();

        $.ajax({
            type: "POST",
            url: "/contabilidad/verificarpassconta",
             data: {pass: pass },
             beforeSend: function(){
              $('#msgPassA').removeClass('v-password');
            },
            success: function( u ){
                 if (u == "No coinciden") {
                     $('.add-gly').addClass('glyphicon glyphicon-remove form-control-feedback');
                     $('.input-pass').addClass('has-error');
                     $('#msgPassA').removeClass('text-success');
                     $('#msgPassA').addClass('text-danger');
                     $('#msgPassA').html("Tu contraseña es incorrecta.");
                    } else {
                      $('.input-pass ').removeClass('has-error');
                      $('.add-gly').removeClass('glyphicon-remove');
                      $('.input-pass ').addClass('has-success');
                      $('.add-gly').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#msgPassA').addClass('v-password');
                      $('.c-pass').removeClass('disabled');
                }
                    

            }
        });
     }
}); 




$(document).on('click', '.c-pass', function(){
    estatus = $(this).attr('data-id');
    id = $(this).attr('value');
    razon = $(this).attr('id');
    total = $(this).attr('data-total');
    ex = $(this).attr('data-extra');
    gly = $(this).attr('data-gly');
    t = $(this).attr('data-valor');
    truco = $(this).attr('data-truco');
    $('.cancel-e').hide();
    $('.cancel-r').show();
    $('.cancel-r').attr('id',id);
    $('#campo-pass').val('');
    $('.input-pass').removeClass('has-success');
    $('.add-gly').removeClass('glyphicon-ok');


    $.ajax({
        type:'GET',
        url:'pedidos/cambiarestatus',
        data:{id: id, estatus: estatus},
        success: function(ed){

        if(truco == 'trco_0'){
          $('.pendiente').hide();
          $('.proceso').show();
          $('.pagado').show();
          $('.cancelado').show();
        } else if(truco == 'trco_1'){
          $('.proceso').hide();
          $('.pendiente').show();
          $('.pagado').show();
          $('.cancelado').show();
        } else if(truco == 'trco_2'){
          $('.pagado').hide();
          $('.pendiente').show();
          $('.proceso').show();
          $('.cancelado').show();
        } else if(truco == 'trco_3'){
          $('.cancelado').hide();
          $('.pendiente').show();
          $('.pagado').show();
          $('.proceso').show();
        }

        if(ed.estatus == 0){
          $('.estatus_a').text('Pendiente');
        } else if(ed.estatus == 1){
          $('.estatus_a').text('Crédito');
        } else if(ed.estatus == 2){
          $('.estatus_a').text('Pagado');
        } else if(ed.estatus == 3){
          $('.estatus_a').text('Cancelado');
        }

        //Bolvemos a construir la fila
        $('#tr_'+id).replaceWith('<tr class="fila_'+ed.estatus+'" id="tr_'+ed.id+'">'+
                '<td><a id="c-estatus" class="'+ed.estatus+'" data-id="'+ed.id+'" href="#modalpedido" data-toggle="modal">'+ed.num_pedido+'</a></td>'
                +'<td>'+ed.numero_cliente+'</td>'
                +'<td>'+ed.created_at+'</td>'
                +'<td>'+ed.nombre_cliente+' '+ed.paterno+'</td>'
                +'<td class="text-info">'+razon+'</td>'
                +'<td id="idp_'+ed.id+'" value="'+t+'" class="text-success">'+total+'</td>'
                +'<td><span id="e_'+ed.id+'" class="'+gly+'"></span></td>'
                +'<td><span class="estatus_'+ed.estatus+'"></span></td>'
                +'<tr/>');

                nuevacantidad(ed.id);

          //Le agregamos el texto del estatus
                $('.estatus_0').text('Pendiente');
                $('.estatus_0').addClass('text-warning');
                $('.estatus_1').text('Crédito');
                $('.estatus_1').addClass('text-primary');
                $('.estatus_2').text('Pagado');
                $('.estatus_2').addClass('text-success');
                $('.estatus_3').text('Cancelado');
                $('.estatus_3').addClass('text-danger');

            //Desactivamos nuevamente el boton
            $('.regist-c-conta').addClass('disabled');
            

        },
        error: function(){
          alert('failure');
        }

      });

  }); 


$(document).on('click', '.regist-c', function(){
    e_inicial = $('.header-e').attr('id');
    e_final = $(this).attr('data-id');

    idp = $(this).attr('value');

    $.ajax({
      type: 'POST',
      url: '/pedidos/registrarlog',
      data: {e_inicial: e_inicial, e_final: e_final, idp: idp},
      success: function(r){
        $('.header-e').attr('id', r);
   
      }, 
      error: function(){
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

      } else if($("#p-total").val().length == 0){
          $('.error-t').addClass('has-error has-feedback');
          $('.icon-t').addClass('glyphicon glyphicon-remove form-control-feedback');
          return false;

      }  else {
          return true;
      }
});

  $("#txt-extra").focus(function(){
    $('.error-c').removeClass('has-error has-feedback');
    $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');

  });

  $("#p-total").focus(function(){
    $('.error-t').removeClass('has-error has-feedback');
    $('.icon-t').removeClass('glyphicon glyphicon-remove form-control-feedback');

  });

$(document).on('click', '#can-extras', function(){
  $("#txt-extra").val('');
  $("#p-total").val('');
  $('.error-c').removeClass('has-error has-feedback');
  $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');
  $('.error-t').removeClass('has-error has-feedback');
  $('.icon-t').removeClass('glyphicon glyphicon-remove form-control-feedback');

});



  //Validaciones al editar un extra
  $("#act-extras").click(function () {

      if($("#txt-extraedit").val().length == 0){
              $('.error-c').addClass('has-error has-feedback');
              $('.icon-c').addClass('glyphicon glyphicon-remove form-control-feedback');
              return false;

      } else if($("#p-total-edit").val().length == 0){
          $('.error-t').addClass('has-error has-feedback');
          $('.icon-t').addClass('glyphicon glyphicon-remove form-control-feedback');
          return false;

      }  else {
          return true;
      }
});

  $("#txt-extraedit").focus(function(){
    $('.error-c').removeClass('has-error has-feedback');
    $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');

  });

  $("#p-total-edit").focus(function(){
    $('.error-t').removeClass('has-error has-feedback');
    $('.icon-t').removeClass('glyphicon glyphicon-remove form-control-feedback');

  });

$(document).on('click', '#can-act-extras', function(){
  $('.error-c').removeClass('has-error has-feedback');
  $('.icon-c').removeClass('glyphicon glyphicon-remove form-control-feedback');
  $('.error-t').removeClass('has-error has-feedback');
  $('.icon-t').removeClass('glyphicon glyphicon-remove form-control-feedback');

});



  // Agregar extras
  $(document).on('click', '#add-extras', function(){
    $('#modalextras').modal({
      show:'false',
    });
  });


$(document).on('click', '#env-extras', function(){
  pedidoid = $(this).attr('data-id');
  clave = $('#inp-extras').val();
  extra = $('#txt-extra').val();
  total = $('#p-total').val();


     $.ajax({
          type: "POST",
          url: "/pedidos/agregarextra",
          data: {pedidoid: pedidoid, clave: clave, extra: extra, total: total},
          success: function (e) {
              $('.add-ext').hide();
              ex = "";
              body = $('#body-extras');
              for(datos in e.new_ex){

                    ex += '<tr id="ex_'+e.new_ex[datos].id+'"><td>'+e.new_ex[datos].clave+'</td>';
                    ex += '<td id="desc_'+e.new_ex[datos].id+'">'+e.new_ex[datos].descripcion+'</td>';
                    ex += '<td data-total="'+e.new_ex[datos].total+'" id="t_'+e.new_ex[datos].id+'" value="'+e.new_ex[datos].total+'" class="total_"></td>';
                    ex += '<td><span id="edit-ext" value="'+e.new_ex[datos].id+'"  class="btn btn-info btn-xs glyphicon glyphicon-edit"></span></td>';
                    ex += '<td><span id="delet-ext" value="'+e.new_ex[datos].id+'" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></span></td></tr>';
                 }

                 $('#e_'+e.new_ex[datos].pedido_id).attr('class', 'extra_1 con-extra text-success glyphicon glyphicon-ok-circle');

                 $('.extra_1').addClass('con-extra text-success glyphicon glyphicon-ok-circle');

                 body.append(ex);

                 $('.extra_1').attr('data-extra', '1');

                 nuevacantidad(e.new_ex[datos].pedido_id);

                 $('.tab-extra').show();
                 $('.ext-d').show();

                 if($('#t_'+e.new_ex[datos].id).attr('value') == 0){
                      $('.total_').text('Pendiente');
                      $('.total_').addClass('text-warning');
                      $('.fila_extras').hide();
                      $('.fila_total').hide();
                    } else {
                      $('.fila_extras').show();
                      $('.fila_total').show();
                      $('.total_').text(accounting.formatMoney(e.new_ex[datos].total));
                      $('.total_').addClass('text-success');
                      $('.to-extra-data').attr('data-extra', e.new_ex[datos].total);
                      $('.to-extra').text(accounting.formatMoney(e.new_ex[datos].total));
                      t = $('#idp_'+e.new_ex[datos].pedido_id).attr('value');
                      e = $('.to-extra-data').attr('data-extra');
                      final = parseFloat(t) + parseFloat(e);
                      $('.gran-to-extra').text(accounting.formatMoney(final));
                    }

               // $('#ide_'+e.new_ex[datos].pedido_id).attr('class', 'con-extra text-success glyphicon glyphicon-ok-circle');

                $('#txt-extra').val('');
                $('#p-total').val('');

          },
          error: function () {
              alert('failure');
          }
      });


});



  //Editar extras
  $(document).on('click', '#edit-ext', function(){
    $('#modalextrasedit').modal({
      show:'false',
    });

    id = $(this).attr('value');
    $('#act-extras').attr('data-id', id);
    des = $('#desc_'+id).text();
    total = $('#t_'+id).attr('data-total');
    $('#txt-extraedit').val(des); 
    $('#p-total-edit').val(total);    

  });

  $(document).on('click', '#act-extras', function(){
    id = $(this).attr('data-id');
    des = $('#txt-extraedit').val(); 
    total = $('#p-total-edit').val(); 
    idp = $(this).attr('data-pedido');

     $.ajax({
          type: "POST",
          url: "/pedidos/actualizarextra",
          data: {id: id, des: des, total: total},
          success: function (e) {
              $('#desc_'+e.id).text(e.descripcion);
              $('#t_'+e.id).attr('data-total', total);
              $('#t_'+e.id).attr('value', total);
              $('#t_'+e.id).text(accounting.formatMoney(e.total));
              $('#t_'+e.id).addClass('text-success');

              if($('#t_'+e.id).attr('value') == 0){
                      $('.total_').text('Pendiente');
                      $('.total_').addClass('text-warning');
                      $('.fila_extras').hide();
                      $('.fila_total').hide();
                    } else {
                      $('.fila_extras').show();
                      $('.fila_total').show();
                      $('.total_').text(accounting.formatMoney(e.total));
                      $('.total_').addClass('text-success');
                      $('.to-extra-data').attr('data-extra', e.total);
                      $('.to-extra').text(accounting.formatMoney(e.total));
                      t = $('#idp_'+e.pedido_id).attr('value');
                      e = $('.to-extra-data').attr('data-extra');
                      final = parseFloat(t) + parseFloat(e);
                      $('.gran-to-extra').text(accounting.formatMoney(final));

                      nuevacantidad(idp);
                    }

              

          },
          error: function () {
              alert('failure');
          }
      });


 });


//Eliminar extra
$(document).on('click', '#delet-ext', function(){
  id  = $(this).attr('value');

  $('#modaldeleteextra').modal({
      show:'false',
    });

    $('#de-ex').attr('data-id', id);

});


$(document).on('click', '#de-ex', function(){
  id  = $(this).attr('data-id');
  idp = $(this).attr('data-pedido');

  $.ajax({
          type: "POST",
          url: "/pedidos/eliminarextra",
          data: {id: id, idp: idp},
          success: function (e) {

              $("#body-extras").load(location.href+" #body-extras>*","");
              $('.tab-extra').hide();
              $('.ext-d').hide();
              $('.add-ext').show();
              $('.fila_extras').hide();
              $('.fila_total').hide();

              $('#e_'+idp).attr('class', 'extra_0 sin-extra text-warning glyphicon glyphicon-ban-circle');
              $('.extra_0').addClass('sin-extra text-warning glyphicon glyphicon-ban-circle');

              $('.extra_0').attr('data-extra', '0');
               extraeliminado(idp);

          },
          error: function () {
              alert('failure');
          }
      });


});



});



  function verextra(){

    $('#list_p_ tbody tr').each(function(){
      idp = $(this).find("[class*='verificar-extra']").attr('data-id');
      extra  = $(this).find("[class*='verificar-extra']").attr('data-extra');

      if(extra == 0){

      } else {
        $.ajax({
          type: "GET",
          url: '/pedidos/sumarextra',
          data: {idp: idp},
          success: function(s){
              if(s.total == 0){

              } else {

              actual = $('#idp_'+s.pedido_id).attr('value');
              extra = s.total;
              nueva = parseFloat(actual) + parseFloat(extra);
              $('#idp_'+s.pedido_id).text(accounting.formatMoney(nueva));
                
              }
          },
          error: function(){
            alert('failure');
          }
        });
      }


  });

}


  function nuevacantidad(idp){

      if(extra == 0){

      } else {
        $.ajax({
          type: "GET",
          url: '/pedidos/sumarextra',
          data: {idp: idp},
          success: function(s){
              if(s.total == 0){

              } else {

              actual = $('#idp_'+s.pedido_id).attr('value');
              extra = s.total;
              nueva = parseFloat(actual) + parseFloat(extra);
              $('#idp_'+s.pedido_id).text(accounting.formatMoney(nueva));
                
              }
          },
          error: function(){
            alert('failure');
          }
        });
      }


}


function extraeliminado(idp){
        actual = $('#idp_'+idp).attr('value');
        $('#idp_'+idp).text(accounting.formatMoney(actual));

}





</script>


@stop
