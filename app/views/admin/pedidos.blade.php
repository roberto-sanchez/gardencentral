@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
<script>
  $(document).ready(function(){
    $('.pedidos').addClass('active');
    $('.t-pedidos').addClass('en-admin');
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
  <!--<a href="{{ URL::to('consultas/listp') }}">Ver Listado</a>-->
  <div class="row row-pedidos">
    <div class="menu-p">
      <a href="{{ URL::to('consultas/exportarexcel') }}" class="btn btn-success">Exportar a Excel</a>
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

    <div class="data-pedidos">
      <table id="list_p_" class="table table-first-column-number data-table display full">
        <thead>
          <tr>
            <th>N° Pedido</th>
            <th>N° Cliente</th>
            <th>Fecha de registro</th>
            <th>Cliente</th>
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



    <div id="modalpedido" class=" modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog m-detalle">
        <div class="modal-content content-p">
          <div class="modal-header header-detalle">
            <button type="button" class="close close-mp" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title text-center n-pedd"></h2>
           <h2 class="modal-title text-center n-peee"></h2>
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
         </ol>
       </div>
            <div class="table-pd">
            <!--Tabla oculta para dispositivos moviles-->
              <table class="table table-striped table-hover td-pedido-a">
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
                </table>
             </div>
              <div class="cont-dtxs">
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
              </div>
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
            <a class="pendiente" data-id="0" href="#cambiarestatus" data-toggle="modal">Pendiente</a>
            <a class="proceso" data-id="1" href="#cambiarestatus" data-toggle="modal">Crédito</a>
            <a class="pagado" data-id="2" href="#cambiarestatus" data-toggle="modal">Pagado</a>
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

      <!--Modal para confirmar cambiar el estatus del pedido-->
    <div id="cambiarestatus" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-info text-center">
              Cambiar estatus.
             </h4>
          </div>
          <div class="modal-body confirmarpass">
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
          </div>
          <div class="modal-footer modal-confirmar">

              <button id="no-p" type="button" class="btn btn-danger confirm" data-dismiss="modal">No</button>
               <span id="c-pass" class="disabled regist-c btn btn-primary confirm" data-dismiss="modal" >Si</span>
          </div>
        </div>
      </div>
    </div>


{{ HTML::script('js/accounting.min.js') }}
  <script>

$(document).ready(function(){
  //Ver pedidos por
  $('.v-pendiente').click(function(){
    $('.fila_0').show();
    $('.fila_1').hide();
    $('.fila_2').hide();
    $('.fila_3').hide();
    $('.ver-list').slideUp(500);


  });

  $('.v-proceso').click(function(){
    $('.fila_1').show();
    $('.fila_0').hide();
    $('.fila_2').hide();
    $('.fila_3').hide();
    $('.ver-list').slideUp(500);
  });

  $('.v-pagado').click(function(){
    $('.fila_2').show();
    $('.fila_0').hide();
    $('.fila_1').hide();
    $('.fila_3').hide();
    $('.ver-list').slideUp(500);
  });

  $('.v-cancelado').click(function(){
    $('.fila_3').show();
    $('.fila_0').hide();
    $('.fila_1').hide();
    $('.fila_2').hide();
    $('.ver-list').slideUp(500);
  });

  $('.v-todo').click(function(){
    $('.fila_3').show();
    $('.fila_0').show();
    $('.fila_1').show();
    $('.fila_2').show();
    $('.ver-list').slideUp(500);
  });



  //Listar pedidos
              $.ajax({
                dataType: 'json',
                url: "/consultas/listapedidos",
                success: function (p) {
                console.log(p);
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

                      for(var i = 0; i < p.length; i++) {
                             tabla_a.fnAddData([
                                       '<a id="c-estatus" class="'+p[i].estatus+' v_'+p[i].razon_social+'" data-id="'+p[i].id+'" value="'+p[i].razon_social+'" href="#modalpedido" data-toggle="modal">'+p[i].num_pedido+'</a>',
                                        p[i].numero_cliente,
                                        p[i].created_at,
                                        p[i].nombre_cliente+" "+p[i].paterno,
                                        '<span class="a_'+p[i].agente_id+'">'+p[i].agente_id+'</span>',
                                        '<span class="estatus_'+p[i].estatus+'"></span>',
                                      ]);


                              }

                       /* $('.v_').attr('value', 'Sin razón social');
                        $('.v_r_').text('Sin razón social');
                        $('.v_r_').addClass('text-info'); */

                        $('.a_0').text('No asignado');
                        $('.a_0').addClass('text-danger');
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



                },
                error: function () {
                    alert("failure");
                }
            });



      $(document).on('click','.fancy > li, a',function(){
       /* $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social');
        $('.v_r_').addClass('text-info'); */

        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });        
      

      $(document).on('keyup', '#list_p__filter', function(){
       /* $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social'); 
        $('.v_r_').addClass('text-info');*/
        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });

      $(document).on('click', '#list_p__length', function(){
       /* $('.v_').attr('value', 'Sin razón social');
        $('.v_r_').text('Sin razón social');
        $('.v_r_').addClass('text-info'); */
        $('.a_0').text('No asignado');
        $('.a_0').addClass('text-danger');
        $('.estatus_0').text('Pendiente');
        $('.estatus_0').addClass('text-warning');
        $('.estatus_1').text('Crédito');
        $('.estatus_1').addClass('text-primary');
        $('.estatus_2').text('Pagado');
        $('.estatus_2').addClass('text-success');
        $('.estatus_3').text('Cancelado');
        $('.estatus_3').addClass('text-danger');
      });






$(document).on('click','#c-estatus', function(){
  id = $(this).attr('data-id');




num = $(this).text();
fe = $(this).attr('value');
$('.n-pedd').text('Pedido #'+num);
$('.n-peee').text('Fecha: '+fe);


 tabla_d = $('#d-dpedido');
$.ajax({
  type: "POST", //metodo
  url: "/consultas/dpedidos",
  data: {id: id},
  success: function (p) {
    console.log(p);
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

         $('.d-pe').html('#'+p.ped[0].num_pedido);
         $('.d-fe').html('Fecha: '+p.ped[0].created_at);

       if(p.ped[0].observaciones == " "){
          $('.c_observaciones').text('No ay observaciones.');
       } else {

            $('.c_observaciones').text(p.ped[0].observaciones);
       }
      }

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
$('.td-pedido-a tbody tr').each(function(){
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


     $(document).on('click', '#c-estatus', function(){
      id = $(this).attr('data-id');
      estatus = $(this).attr('class');
      $('.table-pd').show();
      $('.cancel-r').attr('data-id',estatus);

      es_i = $(this).attr('class');
      $('.header-e').attr('id', es_i);

      $.ajax({
        type:'GET',
        url:'/consultas/verestatusadmin',
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

  $('.header-e').click(function(){
    $('.select-e').slideToggle(500);
  });


  $('.pendiente').click(function(){
    dataid = $(this).attr('data-id');
    id = $(this).attr('id');
    $('#c-pass').attr('data-id',dataid);
    $('#c-pass').attr('value',id);
    $('.select-e').slideUp(300);
  });

  $('.proceso').click(function(){
    dataid = $(this).attr('data-id');
    id = $(this).attr('id');
    $('#c-pass').attr('data-id',dataid);
    $('#c-pass').attr('value',id);
    $('.select-e').slideUp(300);
  });

  $('.pagado').click(function(){
    dataid = $(this).attr('data-id');
    id = $(this).attr('id');
    $('#c-pass').attr('data-id',dataid);
    $('#c-pass').attr('value',id);
    $('.select-e').slideUp(300);
  });

  $('.cancelado').click(function(){
    dataid = $(this).attr('data-id');
    id = $(this).attr('id');
    $('#c-pass').attr('data-id',dataid);
    $('#c-pass').attr('value',id);
    $('.select-e').slideUp(300);
  });


//Actualizaciones de contenidos de la pagina
    $(document).on('click', '#con-pd', function(){
       $('.select-e').slideUp(300);
       $('.estatus-pe').hide();
       $('.table-cli').hide();
       $("#d-dpedido").load(location.href+" #d-dpedido>*","");
       $('#det-p').addClass('enlace-active');
       $('#fotop').removeClass('enlace-active');
       $('#estatusp').removeClass('enlace-active');
       $('.table-pd').show();
    });

$(document).on('click', '.close-mp', function(){
     $('.select-e').slideUp(300);
     $('.estatus-pe').hide();
     $('.table-cli').hide();
     $("#d-dpedido").load(location.href+" #d-dpedido>*","");

});


//Foto del producto
$(document).on('click','.img-p',function(){
  foto = $(this).attr('data-id');
  nf = $(this).attr('id');
  $('.f-p-p').prop('src', '/img/productos/'+foto);
  $('.title-f').html(nf);
});


  $('.table-cli').hide();
  $('.estatus-pe').hide();

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
    $('#estatusp').css('text-decoration', 'none');
    $('.estatus-pe').fadeToggle(500);
    $('.comen-t').hide();
    $('.es-t').hide();
    $('#estatusp').addClass('enlace-active');
    $('#det-p').removeClass('enlace-active');
    $('#fotop').removeClass('enlace-active');
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
            url: "/consultas/verificarpassadmin",
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
                      $('#c-pass').removeClass('disabled');
                }
                    

            }
        });
     }
}); 




  $(document).on('click', '#c-pass', function(){
    estatus = $(this).attr('data-id');
    id = $(this).attr('value');
    $('#campo-pass').val('');
    $('.input-pass').removeClass('has-success');
    $('.add-gly').removeClass('glyphicon-ok');
    $.ajax({
        type:'GET',
        url: "/consultas/cambiarestatusadmin",
        data:{id: id, estatus: estatus},
        success: function(ed){
          console.log(ed);
        //Cambiamos el estatus del boton 
        if(ed.estatus == 0){
          $('.estatus_a').text('Pendiente');
        } else if(ed.estatus == 1){
          $('.estatus_a').text('Crédito');
        } else if(ed.estatus == 2){
          $('.estatus_a').text('Pagado');
        }
        //Bolvemos a construir la fila
        $('#tr_'+id).replaceWith('<tr class="fila_'+ed.estatus+'" id="tr_'+ed.id+'">'+
                '<td><a id="c-estatus" class="'+ed.estatus+'" data-id="'+ed.id+'" href="#modalpedido" data-toggle="modal">'+ed.num_pedido+'</a></td>'
                +'<td>'+ed.numero_cliente+'</td>'
                +'<td>'+ed.created_at+'</td>'
                +'<td>'+ed.nombre_cliente+' '+ed.paterno+'</td>'
                +'<td>'+ed.agente_id+'</td>'
                +'<td><span class="estatus_'+ed.estatus+'"></span></td>'
                +'<tr/>');

          //Le agregamos el texto del estatus
                $('.estatus_0').text('Pendiente');
                $('.estatus_0').addClass('text-warning');
                $('.estatus_1').text('Crédito');
                $('.estatus_1').addClass('text-primary');
                $('.estatus_2').text('Pagado');
                $('.estatus_2').addClass('text-success');

                $('#c-pass').addClass('disabled');

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







});


  </script>

@stop
