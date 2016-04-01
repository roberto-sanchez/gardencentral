 @foreach($pedido as $ped)
    <p>N° pedido: {{ $ped->num_pedido }}</p>
    <p>Fecha: {{  $ped->created_at }}</p>
 @endforeach
