@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
{{ HTML::style('css/select2.min.css') }}
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
<div class="content users ">
  <section class="container">
     @include('layouts/inc/estatus')

        <h1 class="text-primary text-center conf-pedido">Confirmación del pedido</h1>
         @foreach($pedido as $pedi)
        <h2 class="text-info text-center conf-num">       
            N° pedido: {{ $pedi ->num_pedido }}
        </h2>
        <h3 class="text-info text-center conf-date">       
            Fecha: {{ $pedi ->created_at }}
        </h3>
       @endforeach
        <div class="page">
                    <!--Tabla visible para dispositivos moviles-->
            <h2 class="text-info text-center hidden-xs">Datos del cliente</h2>
          <table class="table table-d-xs">
            <thead>
              <tr>
                <th></th>
              </tr>
            </thead>
            <tbody id="body-det">
            @foreach($direc as $d)
              <tr>
                <td>RFC: <span class="rfc">{{ $d->rfc }}</span> <span>• </span>Nombre: {{ $d->nombre_cliente }} {{ $d->paterno }} {{ $d->materno }} <span>• </span>Correo: {{ Auth::user()->email }} <span>• </span>N° cliente: {{ $d->numero_cliente }}</td>
              </tr>
              <tr>
                <td>País: {{ $d->pais }} <span>• </span>Estado: {{ $d->estados }} <span>• </span>Municipio: {{ $d->municipio }}</td>
              </tr>
              <tr>
                <td>Calle1: {{ $d->calle1 }} <span>• </span>Calle2: {{ $d->calle2 }} <span>• </span>Colonia: {{ $d->colonia }}</td>
              </tr>
              <tr>
                <td>Delegación: {{ $d->delegacion }} <span>• </span>CP: {{ $d->codigo_postal }} <span>• </span>Teléfono: {{ $d->numero }}</td>
              </tr>
              @endforeach
 
            </tbody>
          </table>

          <!--Tabla visible para dispositivops moviles-->
          <h2 class="text-info text-center datos-p-xs">Datos del pedido</h2>
            <table class="table table-striped table-condensed table-hover table-bordered table-detallexs">
                @foreach($producto as $item)
              <tbody>
                 <tr class="cabecera-xs">
                   <td>Clave: {{ $item->clave }}</td>
                </tr>
                <tr>
                   <td>Producto: {{ $item->nombre }}</td>
                </tr>
                <tr>
                   <td>Color: {{ $item->color }}</td>
                </tr>
                <tr>
                   <td>Precio: ${{ number_format($item->precio_venta, 2)}}</td>
                </tr>
                <tr>
                   <td>Piezas por paquete: {{ $item->piezas_paquete }}</td>
                </tr>
                <tr>
                   <td>Cantidad: {{ $item->quantity }}</td>
                </tr>
                <tr>
                   <td>Total producto: ${{ number_format($item->precio_venta * $item->quantity, 2) }}</td>
                </tr>
                 
              </tbody>
                @endforeach
            </table>
            <table class=" table-striped table-condensed table-hover  total-pedidoxs">
                <tr>
                  <td id="subtotalp">
                    <span class="text-info">Subtotal:  </span> 
                  </td>
                  <td id="totalp">
                    ${{ number_format($total, 2) }}
                  </td>
                </tr>
                <tr>
                  <td> 
                    <span class="text-info">Iva: </span> 
                  </td>
                  <td>
                      ${{ $iva = number_format($total * 0.16, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Total:  </span> 
                  </td>
                  <td>
                    ${{ number_format($total + $iva, 2) }}
                  </td>
                </tr>
              </table>

          <!--Tabla oculta para dispositivos moviles-->
          <div class="table-responsive table-o-xs">
            <table class="table table-striped table-condensed table-hover table-bordered table-detalle">
              <thead>
                <tr>
                <th>Clave</th>
                <th>Producto</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Piezas por paquete</th>
                <th>Cantidad</th>
                <th>Total producto</th>
              </tr>
              </thead>
              @foreach($producto as $item)
               <tr class="c-pedido">
                 <td>{{ $item->clave }}</td>
                 <td id="pro-d">{{ $item->nombre }}</td>
                 <td>{{ $item->color }}</td>
                 <td>${{ number_format($item->precio_venta, 2)}}</td>
                 <td>{{ $item->piezas_paquete }}</td>
                 <td>{{ $item->quantity }}</td>
                 <td>${{ number_format($item->precio_venta * $item->quantity, 2) }}</td>
               </tr>
              @endforeach
            </table>
             <table class=" table-striped table-condensed table-hover  total-pedido">
                <tr>
                  <td id="subtotalp">
                    <span class="text-info">Subtotal:  </span> 
                  </td>
                  <td id="totalp">
                    ${{ number_format($total, 2) }}
                  </td>
                </tr>
                <tr>
                  <td> 
                    <span class="text-info">Iva: </span> 
                  </td>
                  <td>
                      ${{ $iva = number_format($total * 0.16, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Total:  </span> 
                  </td>
                  <td>
                    ${{ number_format($total + $iva, 2) }}
                  </td>
                </tr>
              </table>
          </div>
        </div>

            
        <div class="imprimirpdf">
          <a class="btn btn-default" href="{{ URL::to('productos/imprimirpedido',$iddom) }}" target="_blank" >Imprimir pedido en PDF</a>
        </div>
        <div id="generarcompra">
          <a href="{{ URL::to('productos/trash') }}" class="btn btn-info">
          <span class="glyphicon glyphicon-chevron-left"></span>
             Seguir comprando
          </a>

        </div>


  </section>
</div> <!-- Content users -->


{{ HTML::script('js/principal.js') }}

<script type="text/javascript">
  $('.log-out').attr('id','cerrar');
  $('.log-out').attr('href',"#");

$('#cerrar').click(function(){
  
      $.ajax({
            type: "POST", //metodo
            url: "/productos/vaciar",
            success: function (v) {
                //Cerramos la sesion
                window.location.href = "/logout";

            },
            error: function () {
                alert('failure');
            }
        });
  

});
</script>



@stop
