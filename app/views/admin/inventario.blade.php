@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('scripts')
@parent
@include('layouts/inc/lib')
<script>
  $(document).ready(function(){
    $('.inventario').addClass('active');
    $('.t-inventario').addClass('en-admin');
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
    <div class="menu-p">
      <a href="{{ URL::to('consultas/excel') }}" class="btn btn-success">Exportar a Excel</a>
    </div>
    <div class="data-inv">
      <table id="totalInventario" class="table table-first-column-number data-table display full">
        <thead>
          <tr>
            <th>Id</th>
            <th>Clave</th>
            <th>Producto</th>
            <th>Cantidad</th>
          </tr>
        </thead>

          @foreach($inventario as $i)
          <tbody >
            <tr>
              <td>{{ $i->id }}</td>
              <td>{{ $i->clave }}</td>
              <td>{{ $i->nombre }}</td>
              <td>{{ $i->cantidad }}</td>
            </tr>
          </tbody>
          @endforeach()

      </table>
    </div>

  </div>
</div>
  <script>
  /* Funcion para el buscador y el pie de paginacion */
/*
  $(function(){
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
  });*/
  </script>

@stop
