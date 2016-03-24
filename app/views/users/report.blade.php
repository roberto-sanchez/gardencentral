<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Garden Central</title>
  {{ HTML::style('css/pdf.css') }}
</head>
<body>


  <section class="pdf">
  <header>
    <div class="img-logo">
      <img src="img/euro3plast.png" width="250px" alt="logo">
    </div>
    <div class="titulo">
          @foreach($pedido as $ped)
            <h1>GARDENA IMPORTS S.A. DE C.V.</h1>
            <h2>N° pedido: {{ $ped->num_pedido }}</h2>
            <h3>Fecha: {{  $ped->created_at }}</h3>
          @endforeach
    </div>
       
    <div class="info">
      <h5><span class="euro3plast">euro3plast </span>spa <span>•</span> viale del lavoro, 45 <span>•</span> 36021 ponte di barbarano (vi)</h5>
      <h5>italy <span>•</span> t +39 0444 788200 <span>•</span> f +39 0444 788290</h5>
      <h5>cap. soc. € 3.000.000 int.vers. <span>•</span> reg. imp. VI n. 00331710244</h5>
      <h5>r.e.a. VI n. 125725 <span>•</span> pi/cf/vat (IT) 00331710244</h5>
      <h5>pec: euro3plast@pec.confindustriavicenza.it</h5>
      <h5>www.euro3plast.com <span>•</span> info@euro3plast.com</h5>
    </div>
  </header>

  <h2 class="text-c">Datos del cliente</h2>
  <table class="datos">
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>
      <tbody>
    @if(count($domi))
      @foreach($domi as $d)
        <tr>
          <td>RFC: <span class="rfc">{{ $d->rfc }}</span> <span>• </span>Nombre: {{ $d->nombre_cliente }} {{ $d->paterno }} {{ $d->materno }} <span>• </span>Correo: {{ Auth::user()->email }} <span>• </span>N° cliente: {{ $d->numero_cliente }}</td>
        </tr>
        <tr>
          <td>Pais: {{ $d->pais }} <span>• </span>Estado: {{ $d->estados }} <span>• </span>Municipio: {{ $d->municipio }}</td>
        </tr>
        <tr>
          <td>Calle1: {{ $d->calle1 }} <span>• </span>Calle2: {{ $d->calle2 }} <span>• </span>Colonia: {{ $d->colonia }}</td>
        </tr>
        <tr>
          <td>Delegacion: {{ $d->delegacion }} <span>• </span>CP: {{ $d->codigo_postal }} <span>• </span>Telefono: {{ $d->numero }}</td>
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


        <div id="content">

            <h2 class="text-c">Datos del pedido</h2>
            <table class="table">
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
              @foreach($pro as $item)
               <tbody>
                  <tr>
                   <td>{{ $item->clave }}</td>
                   <td>{{ $item->nombre }}</td>
                   <td>{{ $item->color }}</td>
                   <td>${{ number_format($item->precio, 2) }}</td>
                   <td>16%</td>
                   <td>{{ $item->cantidad }}</td>
                   <td>{{ $item->num_pedimento }}</td>
                   <td>${{ number_format($item->precio * $item->cantidad, 2) }}</td>
                  </tr>
               </tbody>
              @endforeach
            </table>
      <div class="div-total">
        <table class="t-total">
                <tr>
                  <td>
                    <span>Subtotal:  </span>
                  </td>
                  <td>
                    ${{ number_format($total, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Iva: </span>
                  </td>
                  <td>
                     <?php $iva = $total * 0.16 ?>
                      ${{ number_format($total * 0.16, 2) }}
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>Total:  </span>
                  </td>
                  <td>
                    ${{ number_format($total + $iva, 2) }}
                  </td>
                </tr>
              </table>
      </div>

    </div>


          @if(count($extra))
            <h3 class="text-extra">Extras: </h3>
            <table class="table t-extra">
             <thead>
               <tr>
                 <th>Clave</th>
                 <th>Producto</th>
                 <th>Total</th> 
               </tr> 
             </thead>
             <tbody id="body-extras">
               <tr>
                 @foreach($extra as $e)
                   <td>{{ $e->clave }}</td>
                   <td>{{ $e->descripcion }}</td>
                   @if($e->total == 0)
                    <td class="text-warning">Pendiente</td>
                  @else
                    <td class="text-warning">${{ number_format($e->total, 2) }}</td>
                  @endif
                 @endforeach
               </tr>
             </tbody>
           </table>
          @else
          @endif


   </section>


</body>
</html>
