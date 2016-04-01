<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    @yield('title')
    <meta name="description" content="">
    @section('scripts')
       @include('layouts/inc/head_common')
       @include('layouts/inc/footer_common')
    @show
  </head>
    
    <style>

        .nav-p{
            padding-bottom:2em;
            padding-right:10em;
        }

        .est{
            font-size:2em;
        }
        .form{
            width:50%;
            margin:0 auto;
        }

        .div-btn{
            width:35%;
            margin:0 auto;
        }

        .btn-c{
            width:100%;
        }

        .alerts{
            width:25%;
            margin:0 auto;
        }

    </style>


    
  <body>
  <!--<![endif]-->
    <!--Boton para dispositivos pequeños-->
    <div class="navbar navbar-inverse navbar-fixed-top nav-p">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="glyphicon glyphicon-th-list"></span>
          </button>
          <a class="navbar-brand" href="#">Garden Central</a>
        </div>
    </div>


<div class="users">
  <section class="container">

    <div class="t_condiciones">
    <div class="row princip">
      <div class=" princip2 col-xs-12">
            <div class="alerts">
                   @if(Session::has('messageOK'))
                      <div class="alert alert-success fade in">
                      <button class="close" data-dismiss="alert" type="button">
                          <span class="glyphicon glyphicon-remove" ></span>
                      </button>
                        {{ Session::get('messageOK') }}
                      </div>
                    @endif

                   @if(Session::has('messageDanger'))
                      <div class="alert alert-danger fade in">
                      <button class="close" data-dismiss="alert" type="button">
                          <span class="glyphicon glyphicon-remove"></span>
                      </button>
                        {{ Session::get('messageDanger') }}
                      </div>
                    @endif

            </div>
        <h1 class="est text-info text-center">Restablecer contraseña.</h1>
            <div class="form">
               {{ Form::open() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                 <h4 class="text-info">Ingresa tu dirección de correo electrónico</h4>
                 {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Email')) }}
                </div>
                <div class="form-group">
                 <h4 class="text-info">Ingresa tu nueva contraseña</h4>
                 {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña nueva')) }}
                </div>
                <div class="form-group">
                 <h4 class="text-info">Repite tu nueva contraseña</h4>
                 {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Repite tu nueva contraseña')) }}
                </div>

                <div class="div-btn">
                    {{ Form::submit('Cambiar contraseña', array('class' => 'btn-c btn btn-primary' )) }}
                </div>
              {{ Form::close() }}
            </div>
            
     </div>
    </div>

        
    </div>

  </section>
</div> <!-- Content users -->



   <footer>
      <hr>
      <p>
          &copy; Copyright: Todos los derechos reservados. Garden Central. 

      </p>
   </footer>




  <div class="notifications top-right" data-html="true"></div>



  </body>
</html>
