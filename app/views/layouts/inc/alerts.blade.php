 <!--Alerts personalizados-->

   <!--Alerta de error-->
    @if(Session::has('messageDangerp'))
      <div class="alert alert-error mialertp">
        <button class="close" data-dismiss="alert">
            <span class="glyphicon glyphicon-remove cerrar-alert"></span>
        </button>
           {{ Session::get('messageDangerp') }}
      </div> 
    @endif

       <!--Alerta de exito-->
    @if(Session::has('messageOKp'))
      <div class="alert alert-success mialertp">
        <button class="close" data-dismiss="alert">
            <span class="glyphicon glyphicon-remove cerrar-alert"></span>
        </button>
           {{ Session::get('messageOKp') }}
      </div> 
    @endif

  <!--Alertas para el buscador-->
  <div class="alert alert-error mialert">
    <button class="close">
        <span class="glyphicon glyphicon-remove cerrar-alert"></span>
    </button>
       <span class="msjdanger"></span>
  </div> 

  <div class="alert alert-error mialert2">
    <button class="close">
        <span class="glyphicon glyphicon-remove cerrar-alert2"></span>
    </button>
      <span id="noexiste"></span>
  </div>
