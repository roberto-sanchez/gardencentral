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


    <div class="col-md-4 sidebar">
        <div class="widget">
            <h2>Campaigns</h2>
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

      <div class="col-md-4 sidebar">
        <div class="widget">
            <h2>Campaigns</h2>
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
      <div class="col-md-4 sidebar">
        <div class="widget">
            <h2>Campaigns</h2>
            <ul class="cards list-group">
                <li class="list-group-item">
                    <p class="title" style=" line-height: 1em; margin-top: 0em">Bounce Rate</p>
                    <p class="pull-right text-error strong">58%</p>
                    <span class="small line graph">5,3,9,6,5,9,7,3,5,2</span>
                    <p class="info">Site: 46.65% (-1.2%)</p>
                </li>
                <li class="list-group-item">
                    <p class="title" style=" line-height: 1em; margin-top: 0em">Unique Visitors</p>
                    <p class="pull-right text-info strong">1,307</p>
                    <span class="small line graph">3,4,5,6,5,6,5,4,5,2,4,5,6,2,3,2</span>
                    <p class="info">Site: 11,382 (1.5%)</p>
                </li>
                <li class="list-group-item">
                    <p class="title" style=" line-height: 1em; margin-top: 0em">Pages Per Visit</p>
                    <p class="pull-right text-warning strong">3.27</p>
                    <span class="small line graph">4,3,4,5,7,9,3,7,5,2,4,3,3,6,3,7</span>
                    <p class="info">Site: 2.3 (107.02%)</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-12">
            <h2 class="text-primary">Total inventario.</h2>
            <div class="stats p-total">

            </div>
    </div>
    <div class="col-md-12">
            <h2 class="text-primary">Productos con más inventario.</h2>
            <div class="stats p-mas">

            </div>
    </div>

    <div class="col-md-12">
            <h2 class="text-primary">Productos con menos inventario.</h2>
            <div class="stats p-menos">

            </div>
    </div>

  </div>



</div>


</div>
<script>
invent = $('.p-total');
inventMas = $('.p-mas');
inventMenos = $('.p-menos');
$.ajax({
    type: "POST",
    url: "productos/verpedidos",
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

              div += '<div class="stat"><p class="main-detail text-warning" title="'+d.i_total[datos].nombre+'">'+d.i_total[datos].cantidad+'</p><p class="info" title="'+d.i_total[datos].nombre+'">'+d.i_total[datos].clave+'</p></div>';
           }

          invent.append(div);

          for(datos in d.i_mas){

                  divMas += '<div class="stat"><p class="main-detail text-warning" title="'+d.i_mas[datos].nombre+'">'+d.i_mas[datos].cantidad+'</p><p class="info" title="'+d.i_mas[datos].nombre+'">'+d.i_total[datos].clave+'</p></div>';
               }

              inventMas.append(divMas);

              for(datos in d.i_menos){

                      divMenos += '<div class="stat"><p class="main-detail text-warning" title="'+d.i_menos[datos].nombre+'">'+d.i_menos[datos].cantidad+'</p><p class="info" title="'+d.i_menos[datos].nombre+'">'+d.i_total[datos].clave+'</p></div>';
                   }

                  inventMenos.append(divMenos);

  },

  error: function () {
      alert("failure");
  }
  });

</script>

@stop
