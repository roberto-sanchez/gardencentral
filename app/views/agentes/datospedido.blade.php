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
<div class="content users">
  <section class="container">
     @include('layouts/inc/estatus')
     @include('layouts/inc/alerts')
    <div class="row princip">
    	<h2 class="detalle_p text-center text-primary">
    	   Detalle del pedido
    	   @foreach($pedido as $pe)
    	   		<span class="num_p">#{{ $pe->num_pedido }}</span>
    	   @endforeach
    	 </h2>
      <div class=" princip2 col-xs-8">

      		<div class="table-responsive t-dpedido table-carrito ">
              <table class="table table-striped table-condensed table-hover table-bordered tcarrito">
                <thead>
                  <tr class="cabecerapedido">
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Piezas por paquete</th>
                    <th>Cantidad de paquetes</th>
                    <th>Foto</th>
                    <th>Total producto</th>
                  </tr>
                </thead>
                <tbody>
                 	@foreach($producto as $p)
                 		<tr>
                 			<td>
                 				{{ $p->nombre }}
                 			</td>
                 			<td>
                 				{{ $p->color }}
                 			</td>
                 			<td>
                 				{{ $p->precio_compra }}
                 			</td>
                 			<td>
                 				{{ $p->piezas_paquete }}
                 			</td>
                 			<td>
                 				
                 			</td>
                 			<td>
                 				
                 			</td>
                 			<td>
                 				
                 			</td>
                 		</tr>
                  @endforeach
              	</tbody>
             </table>
           </div>
			<div class="p-estado">
				<h2 class="text-info">Estado del pedido</h2>
			</div>
           <div class="es">

           	 <div id="regresar">
	          <a href="{{ URL::to('agentes') }}" class="btn btn-info">
	          <span class="glyphicon glyphicon-chevron-left"></span>
	             Regresar
	          </a>
             </div>

		 
        <!--     <div id="estatus" class="input-group infopago">
               <select id="est-p"  class="btn btn-primary form-control " name="estatus">
               	<li>
                   <a value="0">Pendiente</a>      
                </li>
                <li>
                   <a value="1">En proceso</a>
                </li>
                   <option value="2">Pagado</option>
                   <option value="3">Cancelado</option>
                   <option value="4">Devuelto</option>
               </select>
            </div>-->
				<div class="content-est">
				  @foreach($pedido as $pe)
					<div class="header-e">
						<h3 id="estatus_{{ $pe->estatus }}"></h3>
					</div>
				  @endforeach
					<div class="select-e">
						<a id="pendiente" data-id="0" href="#cambiarestatus" data-toggle="modal">Pendiente</a>
						<a id="proceso" data-id="1" href="#cambiarestatus" data-toggle="modal">En proceso</a>
						<a id="pagado" data-id="2" href="#cambiarestatus" data-toggle="modal">Pagado</a>
						<a id="cancelado" data-id="3" href="#cambiarestatus" data-toggle="modal">Cancelado</a>
					</div>
					
				</div>

          </div>

        </div>
           
      </div>
    </div>
 </section>
</div> <!-- Content users -->


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
            <h2 class="text-danger text-center">¿Está seguro que desea cambiar el estatus del pedido?</h2>
          <span class="label label-danger esta center"></span>
          </div>
          <div class="modal-footer modal-confirmar">

              <span id="confrim-e" class="btn btn-primary confirm" data-dismiss="modal" >Si</span> 
              <button type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
          </div> 
        </div>
      </div>
    </div> 



{{ HTML::script('js/select2.min.js') }}
{{ HTML::script('js/accounting.min.js') }}

<script>
	$(document).ready(function(){

	$(document).on('click','#est-p', function(){
		estado = $(this).val();
		console.log(estado);
	});

	$('.header-e').click(function(){
		$('.select-e').slideToggle(500);
	});


	$('#estatus_0').text('Pendiente');


	$('#pendiente').click(function(){
		id = $(this).attr('data-id');
		$('#confrim-e').attr('data-id',id);
	});

	$('#proceso').click(function(){
		id = $(this).attr('data-id');
		$('#confrim-e').attr('data-id',id);
	});

	$('#pagado').click(function(){
		id = $(this).attr('data-id');
		$('#confrim-e').attr('data-id',id);
	});

	$('#cancelado').click(function(){
		id = $(this).attr('data-id');
		$('#confrim-e').attr('data-id',id);
	});

	$(document).on('click','#confrim-e', function(){
		id = $(this).attr('data-id');
		alert(id);
		$('.select-e').slideUp(500);


	      $.ajax({
            type: "GET",
            url: "pedidos/cambiarestatus", 
            success: function (e) {
            	console.log(e);
              
            },

            error: function () {
                alert("failure");
            }
        });


	});



});










</script>


@stop

