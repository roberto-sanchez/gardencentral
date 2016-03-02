@extends('layouts/principal')

@section('title')
<title>Garden Central</title>
@show

@section('scripts')
@parent
<style>

	.u-oculto{
		visibility:hidden;
	}

	#terminos_c{
		display:none;
	}

	.text-t{
		width:60%;
		margin:0 auto;
		text-align:center;
	}

</style>
@stop

@section('username')
<span class="glyphicon glyphicon-user u-oculto"></span>
<strong class="u-oculto"> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('menu_users')
  
@stop

@section('menu')

@stop

@section('content')
<div class="users">
  <section class="container">

  	<div class="t_condiciones">
  		<h1 class="text-info text-center">Términos y condiciones</h1>
  		<h2 class="text-info text-center" id="desc"></h2>
  		<div class="text-t">
  		  <p id="c-ter"></p>	
  		</div>
  		
  	</div>

  </section>
</div> <!-- Content users -->


<script>

	$(document).ready(function(){

		$.ajax({
			type: 'GET',
			url: '/productos/verterminos',
			success: function(t){
				$('#desc').text(t.descripción);
				$('#c-ter').html(t.texto);
			},	
			error: function(){
				alert('failure');
			}
		});

	});

</script>


@stop
