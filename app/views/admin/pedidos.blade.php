@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
@stop


@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row">
    <h1 class="b"></h1>
    <div class="data-inv">
      <table id="table-pedido" class="table table-first-column-number data-table display full">
        <thead>
          <tr>
            <th>Cliente</th>
            <th>N° Cliente</th>
            <th>N° Pedido</th>
            <th>Fecha de registro</th>
            <th>Agente</th>
            <th>Estatus</th>
          </tr>
        </thead>
        <tbody id="totalPedido">
        </tbody>

      </table>
    </div>

  </div>
</div>

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
          <div class="table-pd">
          <!--Tabla oculta para dispositivos moviles-->
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
              </table>
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

{{ HTML::script('js/accounting.min.js') }}
  <script>

$(document).ready(function(){
  //Listar telefonos del usuario
     tablepedido = $('#totalPedido');


        $.ajax({
            type: "GET",
            url: "/consultas/listapedidos",
            success: function (p) {
              tp = "";
              ta = "";
    //comprobamos si existen domicilios
        for(datos in p.pedidos){

                tp += '<tr><td>'+p.pedidos[datos].nombre_cliente+'</td>';
                tp += '<td><a id="c-estatus" class="'+p.pedidos[datos].estatus+'" data-id="'+p.pedidos[datos].id+'" value="'+p.pedidos[datos].numero_cliente+'" href="#modalpedido" data-toggle="modal">'+p.pedidos[datos].num_pedido+'</a></td>';
                tp += '<td>'+p.pedidos[datos].numero_cliente+'</td>';
                tp += '<td>'+p.pedidos[datos].created_at+'</td>';
                if(p.pedidos[datos].agente_id == 0){
                  tp += '<td class="text-danger">No asignado</td>';

                } else {

                  tp += '<td>'+p.pedidos[datos].agente_id+'</td>';
                }
                tp += '<td><span class="estatus_'+p.pedidos[datos].estatus+'"></span></td></tr>';
             }
            tablepedido.append(tp);
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

 num = $(this).attr('value');
 $('.conf-pd').attr('value',num);

 tabla_d = $('#d-dpedido');
$.ajax({
  type: "POST", //metodo
  url: "/consultas/dpedidos",
  data: {id: id},
  success: function (p) {
      $('.d-pe').html('#'+p.ped[0].num_pedido);
      $('.d-fe').html('Fecha: '+p.ped[0].created_at);

      pro = "";
  for(datos in p.pro){
    e = accounting.formatMoney(p.pro[datos].precio_venta);
    t = accounting.formatMoney(p.pro[datos].precio_venta);

        pro += '<tr><td>'+p.pro[datos].clave+'</td>';
        pro += '<td>'+p.pro[datos].nombre+'</td>';
        pro += '<td>'+p.pro[datos].color+'</td>';
        pro += '<td>'+e+'</td>';
        pro += '<td>'+p.pro[datos].piezas_paquete+'</td>';
        pro += '<td>'+p.pro[datos].cantidad+'</td>';
        pro += '<td><span class="img-p" id="'+p.pro[datos].nombre+'" data-id="'+p.pro[datos].foto+'" href="#verfotop" data-toggle="modal" alt="Foto del producto" title="Ver Foto del prodcto">Ver foto</span></td>';
        pro += '<td class="t-pro" value="'+p.pro[datos].precio_venta * p.pro[datos].cantidad+'">'+accounting.formatMoney(p.pro[datos].precio_venta * p.pro[datos].cantidad)+'</td></tr>';
      }

    tabla_d.append(pro);


    //Mostarr el subtotal, Iva y total
resultado=0;
$('.td-pedido tbody tr').each(function(){
    cant  = $(this).find("[class*='t-pro']").attr('value');

    resultado += parseInt(cant);

  });

$('.sub-p').html(accounting.formatMoney(resultado));
$('.sub-iva').html(accounting.formatMoney(iva = resultado * 0.16));
$('.total-p').html(accounting.formatMoney(resultado += iva));

  },

  error: function () {
      alert('failure');
  }
});


});

//Actualizaciones de contenidos de la pagina
$(document).on('click', '#con-pd', function(){

     $("#d-dpedido").load(location.href+" #d-dpedido>*","");

});

$(document).on('click', '.close-mp', function(){
  $("#d-dpedido").load(location.href+" #d-dpedido>*","");

});








});


/*  $(function(){
     $('table.data-table.sort').dataTable( {
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
      });
     $('table.data-table.full').dataTable( {
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true,
          "sPaginationType": "full_numbers",
          "sDom": '<""f>t<"F"lp>',
          "sPaginationType": "bootstrap"
      });
  }); */
  </script>

@stop
