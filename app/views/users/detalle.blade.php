@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
{{ HTML::style('css/select2.min.css') }}
<style>

  .notas_a{
    width:70%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack:start;
  -webkit-justify-content:flex-start;
      -ms-flex-pack:start;
          justify-content:flex-start;
    margin-top:.2em;
  }

  .alert-n_d{
    display:none;
    margin-left:.8em;
  }

  .l_vaciar{
    cursor:pointer;
  }


</style>
@stop

@section('pedidos_user') @stop

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
          @if(count($direc))
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
            @else
              @foreach($cli as $c)
              <tr>
                <td>RFC: <span class="rfc">{{ $c->rfc }}</span> <span>• </span>Nombre: {{ $c->nombre_cliente }} {{ $c->paterno }} {{ $c->materno }} <span>• </span>Correo: {{ Auth::user()->email }} <span>• </span>N° cliente: {{ $c->numero_cliente }}</td>
              </tr>
              @endforeach
           @endif

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
                   <td>${{ number_format($item->precio, 2) }}</td>
                </tr>
                <tr>
                   @if($item->iva0 == 0)
                  <td>0%</td>
                  @else
                   <td>16%</td>
                  @endif
                </tr>
                <tr>
                   <td>Cantidad: {{ $item->cantidad }}/td>
                </tr>
                <tr>
                   <td>Total producto: {{ number_format($item->precio * $item->cantidad, 2) }}</td>
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
                      ${{ number_format($t, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Total:  </span>
                  </td>
                  <td>
                    ${{ number_format($total + $t, 2) }}
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
                <th>Iva</th>
                <th>Cantidad</th>
                <th>Pedimento</th>
                <th>Total producto</th>
              </tr>
              </thead>
                

              @foreach($producto as $item)
               <tr class="c-pedido">
                 <td>{{ $item->clave }}</td>
                 <td id="pro-d">{{ $item->nombre }}</td>
                 <td>{{ $item->color }}</td>
                 <td>${{ number_format($item->precio, 2) }}</td>
                 @if($item->iva0 == 0)
                  <td>0%</td>
                  @else
                   <td>16%</td>
                  @endif
                 <td>{{ $item->cantidad }}</td>
                 <td>{{ $item->num_pedimento }}</td>
                 <td>${{ number_format($item->precio * $item->cantidad, 2) }}</td>
               </tr>
              @endforeach
            </table>
             <table class=" table-striped table-condensed table-hover  total-pedidod">
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
                      ${{ number_format($t, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="text-info">Total:  </span>
                  </td>
                  <td>
                    ${{ number_format($total + $t, 2) }}
                  </td>
                </tr>
              </table>
            @if(count($direc))
             @else
                <div class="notas_a">
                   <div class="alert alert-desc">
                      <strong>Recoger sus productos en la tienda.</strong>
                   </div>
               </div>
             @endif
                <div class="list-n" style="margin-top: .5em"></div>
              
          </div>
        </div>
          @if(count($extra))
            <h3 class="text-info extra-detalle">Extras: </h3>
            <table class="table ta-extra">
             <thead>
               <th>Clave</th>
               <th>Producto</th>
               <th>Total</th>  
             </thead>
             <tbody id="body-extras">
               <tr>
                 @foreach($extra as $e)
                   <td>{{ $e->clave }}</td>
                   <td>{{ $e->descripcion }}</td>
                   <td class="text-warning">Pendiente</td>
                 @endforeach
               </tr>
             </tbody>
           </table>
          @else
          @endif

      <div class="bolque-b">
        <div>
          <div class="imprimirpdf">
            <a class="btn btn-default" href="{{ URL::to('productos/imprimirpedido',$iddom) }}" target="_blank" >Imprimir pedido en PDF</a>
          </div>
          <div id="generarcompra">
            <a href="{{ URL::to('users') }}" class="btn btn-info">
            <span class="glyphicon glyphicon-chevron-left"></span>
               Seguir comprando
            </a>

          </div>
        </div>

      </div>

  </section>
</div> <!-- Content users -->


<script>

  $(document).ready(function(){

     //Listar notas aclaratorias
    contenedor = $('.list-n');
            seccion = 'Detalle del pedido';
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

});

</script>


@stop
