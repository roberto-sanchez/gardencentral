<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Iniciar Sesión</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/login.css') }}
    {{ HTML::style('lib/bootstrap-notify/bootstrap-notify.css') }}  
    {{ HTML::script('js/jquery.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('lib/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js') }}
    {{ HTML::script('lib/bootstrap-notify/bootstrap-notify.js') }}
    {{ HTML::script('js/login.js') }}
  </head>

  <body>
    <div class="panel panel-regis">
        <h2 data-toggle="modal" data-target="#ModalAgregar">Registrarse</h2>
    </div>
        <div class="cont-sesion">
            <div class='notifications top sess-f'></div>
        </div>
        <div id="container">
        <!--       Alertas       -->
        @include('layouts/inc/estatus')  
            <div id="loginbox">

                 <!-- 1.- Rut del formulario, por el metodo post  -->
                {{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'form-signin', 'role' => 'form']) }}
    				       <h2>Iniciar Sesión</h2>
                  <div class="alinear">
                    <div class=" formUserName input-group inp1 has-feedback">
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-user"></span>
                        </span>                        
                          <input type="text" name="username" value="{{ $username or '' }}" class="form-control" id="username" placeholder="Usuario", 'required'>
                        <span class="spanUserName"></span>
                    </div>
                  <div class="input-group formPassword has-feedback">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                      {{ Form::password('password',array('class' => 'form-control', 'id' => 'password', 'data-id' => '' ,'placeholder' => 'Contraseña', 'required')) }}
                      <span class="spanPassword"></span>
                 </div>
                 <span id="u-e" class="text-danger">El usuario no existe.</span>
                </div>
                    <a href="#" data-toggle="modal" data-target="#restpass">¿Olvidaste tu contraseña?</a>
                    <div class="form-actions">
                       {{ Form::submit('Acceder', array('class' => 'btn btn-block btn-primary', 'id' => 'acceder')) }}
                    </div>
                {{ Form::close() }}
                </div>

                 @if(Session::has('messageE'))
                    <span>
                        <span class="sesion-f"></span>
                      {{ Session::get('messageE') }}
                    </span>
                @endif

            <!--      Modal para agregar un nuevo usuario    -->
				   <div class="modal fade" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="ModalAgregar" aria-hidden="true">
                 <div class="modal-dialog">
                   <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                       <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-plus"></span>  Registrarse</h4>
                     </div>
                     <div class="modal-body">


               <!--
               * Nota: no puede mandar los tatos con laravel, por eso la etiqueta
               * de apertura esta con html...  :(
               -->
              <form id="formulario_registros" role="form" action="users/create" method="post">
              <div class="none form-group formRfc has-feedback">
                   {{ Form::label('RFC') }}
                   {{ Form::text('rfc',null, array('class' => 'form-control', 'placeholder' => 'RFC (13 caracteres)', 'id' => 'formRfc')) }}
                   <span class=" spanRfc help-block" ></span>
                   <span class=" spanRfcText" ></span>
                 </div>
                 <div class="none form-group formName has-feedback">
                   {{ Form::label('Nombre') }}
                   {{ Form::text('name',null, array('class' => 'form-control', 'placeholder' => 'Nombre', 'id' => 'formName')) }}
                   <span class=" spanName help-block" ></span>
                 </div>                  <hr class="hr">
                 <div class="ap">
                   <div class="none form-group formLast has-feedback">
                     {{ Form::label('Apellido Paterno') }}
                     {{ Form::text('last_name',null, array('class' => 'form-control', 'placeholder' => 'Apellido Paterno', 'id' => 'formLast')) }}
                     <span class=" spanLast help-block" ></span>
                   </div>
                   <div class="none form-group formMat has-feedback">
                     {{ Form::label('Apellido Materno') }}
                     {{ Form::text('materno',null, array('class' => 'form-control', 'placeholder' => 'Apellido Materno (Opcional)', 'id' => 'formMat')) }}
                     <span class=" spanMat help-block" ></span>
                     <span class=" spanMatText" ></span>
                   </div>
                 </div>
                 <div class="none form-group formUser has-feedback">
                   {{ Form::label('Usuario') }}
                   {{ Form::text('username',null, array('class' => 'form-control', 'placeholder' => 'Usuario', 'id' => 'formUser')) }}
                   <span class=" spanUser help-block" ></span>
                   <span class=" spanUserText" ></span>
                    <span class="user-v" id="msgUsuario"></span>
                 </div>
                 <div class="none form-group formEmail has-feedback">
                   {{ Form::label('Email') }}
                   {{ Form::text('email',null, array('class' => 'form-control', 'placeholder' => 'ejemplo@dominio.com', 'id' => 'formEmail')) }}
                   <span class=" spanEmail help-block" ></span>
                   <span class=" spanEmailText" ></span>
                   <span class="email-v" id="msgEmail"></span>
                 </div>
                 <hr class="hr">
                   <div class="radio">
                    <input type="checkbox" name="moral" class="span" id="checkmoral" value="moral">
                    <label for="checkmoral" class="spancolor">
                        Persona Moral <span>(Opcional)</span>
                    </label>
                      <div class="oculto">
                          <div class="none radio1 formComercial form-group has-feedback">
                             {{ Form::label('Nombre Comercial') }}
                             {{ Form::text('comercial',null, array('class' => 'form-control', 'placeholder' => 'Nombre Comercial','id' => 'formComercial')) }}
                             <span class=" spanComercial help-block" ></span>
                          </div>
                          <div class="none formSocial radio2 form-group has-feedback">
                             {{ Form::label('Razon Social') }}
                             {{ Form::text('social',null, array('class' => 'form-control', 'placeholder' => 'Razon Social','id' => 'formSocial')) }}
                             <span class=" spanSocial help-block" ></span>
                          </div>
                      </div>
                  </div>
                 <hr class="hr">
                 <div class="fo">
                   <div class="none form-group formPass1 has-feedback">
                     {{ Form::label('Contraseña') }}
                     {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Contraseña', 'id' => 'formPass1')) }}
                     <span class=" spanPass1 help-block" ></span>
                     <span class=" spanPass1Text" ></span>
                   </div>
                   <div class="none form-group formPass2 has-feedback">
                     {{ Form::label('Repite la contraseña') }}
                     {{ Form::password('rpassword', array('class' => 'form-control', 'placeholder' => 'Repite la contraseña', 'id' => 'formPass2')) }}
                     <span class=" spanPass2 help-block" ></span>
                     <span class="r_pass spanPass2Text" ></span>
                   </div>
                  </div>
                   <select name="level" class="form-control btnoculto">
                     <option value="1" selected></option>
                   </select>
                   {{ Form::text('numcliente',null, array('class' => 'hidden')) }}
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancelar</button>
                       {{ Form::submit('Registrarme',array('class' => 'btn btn-primary ', 'id' => 'enviarregistro')) }}
                      {{ Form::close() }}
                     </div>
                   </div>
                 </div>
               </div>
               <!-- End Modal -->

               <!-- Modal para restablecer contraseña -->
              <div id="restpass" class="modal fade">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h2 class="modal-title text-danger title-rpass"><span class="glyphicon glyphicon-lock"></span> Restablecer tu contraseña</h2>
                          </div>
                          <div class="modal-body modal-r">
                             {{ Form::open(array('url' => 'password/remind')) }}
                               <h4 class="text-info title-ingres">Ingresa tu dirección de correo electrónico</h4>

                            <div class="form-group formREmail has-feedback">
                                  {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required','id' => 'restp')) }}
                                  <span class=" spanREmail help-block" ></span>
                                  <h4 class="email-r" id="msgREmail"></h4>
                              </div>

                          </div>
                          <div class="modal-footer modal-rest">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                              {{ Form::submit('Enviar', array('class' => 'btn btn-primary','id' => 'rest-p')) }}
                            {{ Form::close() }}
                          </div>
                      </div>
                  </div>
              </div>


        </div>

       
</body>
</html>
