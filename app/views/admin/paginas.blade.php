@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')

{{ Html::script('lib/ckeditor/ckeditor.js')  }}

<script>
  $(document).ready(function(){

    $('.paginas').addClass('active');
    $('.t-paginas').addClass('en-admin');


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
  <div class="row row-paginas">


	<input type="text" id="desc">
	<textarea cols="80" id="text" name="editor1" rows="10"></textarea>


	<script type="text/javascript">
	  CKEDITOR.replace ( "desc");
	  //CKEDITOR.replace ("text");
	</script>


  </div>
</div>





  <script>



  </script>

@stop
