@extends('layouts/principal')

@section('title')
<title>Garden Central Productos</title>
@show

@section('username')
  
@stop

@section('menu')
  
@stop

@section('content')
<div class="content users">
  <section class="container">
    @include('layouts/inc/estatus')
    <div class="row princip">
      <div class=" princip2 col-xs-8">
        <h1 class="est">Establezca su nueva contraseña</h1>

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

                <div>
                    {{ Form::submit('Cambiar contraseña', array('class' => 'btn btn-primary btn-block' )) }}
                </div>
            {{ Form::close() }}
     </div>
    </div>
  </section>
</div>
@stop

