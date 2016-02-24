@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
<script>
  $(document).ready(function(){
    $('.admin').addClass('active');
    $('.t-admin').addClass('en-admin');
    $('.dash').attr('id','');
  });
</script>
@stop

@section('pedidos_user') @stop


@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row">

      <div class="cont-sidebar">
        <div class="sidebar caja-s">
            <div class="widget">
                <h2>Totales</h2>
                <ul class="cards list-group">
                    <li class="list-group-item">
                        <p class="text-info text-totalp" style=" line-height: 1em; margin-top: 0em">Total de pedidos.</p>
                        <p id="total-p" class="pull-right text-error strong"></p>
                        <span class="small line graph">5,3,9,6,5,9,7,3,5,2</span>
                        <p class="info">Site: 46.65% (-1.2%)</p>
                    </li>
                    <li class="list-group-item">
                        <p class="text-info text-totalp" style=" line-height: 1em; margin-top: 0em">Pedidos del día.</p>
                        <p id="total-dia" class="pull-right text-info strong"></p>
                        <span class="small line graph">3,4,5,6,5,6,5,4,5,2,4,5,6,2,3,2</span>
                        <p class="info">Site: 11,382 (1.5%)</p>
                    </li>
                    <li class="list-group-item">
                        <p class="text-success text-totalp" style=" line-height: 1em; margin-top: 0em">Pedidos pagados.</p>
                        <p id="total-pagados" class="pull-right text-success strong"></p>
                        <span class="small line graph">4,3,4,5,7,9,3,7,5,2,4,3,3,6,3,7</span>
                        <p class="info">Site: 2.3 (107.02%)</p>
                    </li>
                </ul>
            </div>
          </div>

        <div class="sidebar caja-s">
          <div class="widget">
              <h2>Estatus</h2>
              <ul class="cards list-group">
                  <li class="list-group-item">
                      <p class="text-primary text-totalp" style=" line-height: 1em; margin-top: 0em">Pedidos en proceso.</p>
                      <p id="total-proceso" class="pull-right text-primary strong"></p>
                      <span class="small line graph">5,3,9,6,5,9,7,3,5,2</span>
                      <p class="info">Site: 46.65% (-1.2%)</p>
                  </li>
                  <li class="list-group-item">
                      <p class="text-warning text-totalp" style=" line-height: 1em; margin-top: 0em">Pedidos pendientes.</p>
                      <p id="total-pendientes" class="pull-right text-warning strong"></p>
                      <span class="small line graph">3,4,5,6,5,6,5,4,5,2,4,5,6,2,3,2</span>
                      <p class="info">Site: 11,382 (1.5%)</p>
                  </li>
                  <li class="list-group-item">
                      <p class="text-danger text-totalp" style=" line-height: 1em; margin-top: 0em">Pedidos cancelados.</p>
                      <p id="total-cancelados" class="pull-right text-danger strong"></p>
                      <span class="small line graph">4,3,4,5,7,9,3,7,5,2,4,3,3,6,3,7</span>
                      <p class="info">Site: 2.3 (107.02%)</p>
                  </li>
              </ul>
          </div>
        </div>
      </div>

  <div class="cont-text-i">
      <h2 class="text-primary">Inventario</h2>
      <ul class="nav nav-tabs">
          <li class="in-t active"><a id="i-total">Total</a></li>
          <li class="in-mas"><a id="i-mas">Productos con más inventario</a></li>
          <li class="in-menos"><a id="i-menos">Productos con menos inventario</a></li>
      </ul>
  </div>
      <div class="totales-inv"></div>
      <div class="inv-mas"></div>
      <div class="inv-menos"></div>

  </div>



</div>


</div>
<script>
  $('.inv-mas').hide();
  $('.inv-menos').hide();

  $(document).on('click','#i-mas', function(){
    $('.in-t').removeClass('active');
    $('.in-menos').removeClass('active');
    $('.in-mas').addClass('active');
    $('.totales-inv').hide();
    $('.inv-menos').hide();
    $('.inv-mas').fadeIn(500);
  });
  $(document).on('click','#i-menos', function(){
    $('.in-t').removeClass('active');
    $('.in-mas').removeClass('active');
    $('.in-menos').addClass('active');
    $('.totales-inv').hide();
    $('.inv-menos').fadeIn(500);
    $('.inv-mas').hide();
  });
  $(document).on('click','#i-total', function(){
    $('.in-t').addClass('active');
    $('.in-mas').removeClass('active');
    $('.in-menos').removeClass('active');
    $('.totales-inv').fadeIn(500);
    $('.inv-menos').hide();
    $('.inv-mas').hide();
  });

invent = $('.totales-inv');
inventMas = $('.inv-mas');
inventMenos = $('.inv-menos');
$.ajax({
    type: "POST",
    url: "pedidos/verpedidos",
    success: function (d) {
      console.log(d);
      div = "", divMas = "", divMenos = "";
      $('#total-p').text(d.p);
      $('#total-dia').text(d.p_date);
      $('#total-pagados').text(d.p_pagados);
      $('#total-proceso').text(d.p_proceso);
      $('#total-pendientes').text(d.p_pendientes);
      $('#total-cancelados').text(d.p_cancelados);

      for(datos in d.i_total){

              div += '<div class="caja"><div class="cont-t"><h4 class="text-info total-inv">'+d.i_total[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_total[datos].clave+'</h3></div></div>';
           }

          invent.append(div);

          for(datos in d.i_mas){

                  divMas += '<div class="caja"><div class="cont-t"><h4 class="text-success total-inv">'+d.i_mas[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_mas[datos].clave+'</h3></div></div>';
               }

              inventMas.append(divMas);

              for(datos in d.i_menos){

                    divMenos += '<div class="caja"><div class="cont-t"><h4 class="text-danger total-inv">'+d.i_menos[datos].cantidad+'</h4><h3 class="clave-inv">'+d.i_menos[datos].clave+'</h3></div></div>';
                   }

                  inventMenos.append(divMenos);

  },

  error: function () {
      alert("failure");
  }
  });

</script>

@stop
