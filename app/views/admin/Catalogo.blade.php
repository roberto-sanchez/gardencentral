@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row contenido-principal">
      <div class="col-sm-12 main-content">
              @include('layouts/inc/estatus')
             
                      <h2>Catálogo {{$catalogo}}</h2>
                    
                      
                      <?php                           
                      
                      switch ($catalogo) {
                      	case 'Almacen':			
                      	    ?>

                      	<table id="tablaResult" class="table table-first-column-check">
                      		<thead>
	                          <tr>
    	                      	<th>Clave</th>
        	                    <th>Nombre</th>
            	                <th>Status</th>
                	            <th>Acción</th>
                    	      </tr>
                    	    </thead>	
                        	<tbody>
	                        	<form>
    	                     	<tr>

        	                 		<td><input type="text" id="clave_0" name="clave" required>	</td>
            	             		<td><input type="text" id="nombre_0" name="nombre" required> </td>
                	         		<td><input type="checkbox" id="status_0" name="status" value=1 checked="true"></td>
                	         		<input type="hidden" id="catalogo" value="{{$catalogo}}" name="catalogo">
                    	     		<td><button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0"> guardar </button></td>
                        	 	</tr>
                         		</form>
	                        
		                        @foreach($almacenes as $almacen)
		                        
                        	  {{Form::open() }}
        		                  <tr id="tr_{{$almacen->id}}">
		                          	
    	            	          	<td> <input type="text" name="clave_{{$almacen->id}}" value="{{$almacen->clave}}" id="clave_{{$almacen->id}}" disabled="disabled" required>  </td>
        	            	        <td> <input type="text" name="nombre_{{$almacen->id}}" value="{{$almacen->nombre}}" id="nombre_{{$almacen->id}}" disabled="disabled" required>	</td>
            	            	    <td> <input type="checkbox" name="status_{{$almacen->id}}" value="{{$almacen->estatus}}"  id="status_{{$almacen->id}}" disabled="disabled" <<?php  if ($almacen->estatus==1) {?> checked <?php } ?> > </td>
            	            	    
                	            	<td>
                	            		<button type="button" value="Modificar" id="btn_mod" data-id="{{$almacen->id}}" class="modificar">Mod</button>
                	            		<input type="hidden" id="campo_id{{$almacen->id}}" value="{{$almacen->id}}" name="campo_id" >
                	            		<button type="button" value="Actualizar" id="btn_actualizar_{{$almacen->id}}" disabled="disabled" data-id="{{$almacen->id}}" class="actualizar"> Act</button>
    		                        	<button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$almacen->id}}"> Eliminar</button>
                        		    </td>

        		                  </tr>
                            {{Form::close()}}                          
        		                @endforeach
                            
        		              </tbody>
                      	</table>
	                        
                        <?php
                      		break;

                      	case 'Cliente':	?>
                      		<table class="table table-first-column-check">
                      			<thead>
                      				<tr>
                      					<th>RFC</th>
                      					<th>Usuario_ID</th>
                      					<th>Agente_ID</th>
                      					<th>Nivel_Descuento</th>
                      					<th>Nombre</th>
                      					<th>Apellido Paterno</th>
                      					<th>Apellido Materno</th>
                      					<th>Nombre comercial</th>
                      					<th>Razón social</th>
                      					<th>Numero cliente</th>
                      				</tr>
                      			</thead>
                      			<tbody>                      			
	                      			{{ Form::open( )}}
    			                    <tr>
        			                	<td><input type="text" id="rfc_0" name="rfc" ></td>
            	    		        	<td><input type="text" id="usuario_id_0" name="usuario_id" ></td>
                	        			<td><input type="text" id="agente_id_0" name="agente_id" ></td>
                	        			<td><input type="text" id="nivel_descuento_0". name="nivel_descuento"></td>
                	        			<td><input type="text" id="nombre_0" name="nombre"></td>
                	        			<td><input type="text" id="paterno_0" name="paterno"></td>
                	        			<td><input type="text" id="materno_0" name="materno"></td>
                	        			<td><input type="text" id="nombre_comercial_0" name="nombre_comercial"></td>
                	        			<td><input type="text" id="razon_social_0" name="razon_social"></td>
                	        			<td><input type="text" id="numero_0" name="numero"></td>
                	        			<td><button type="button" id="btn_guardar" name="btn_guardar" value="Guardar" data-id="0"> guardar </button></td>
                        	 		</tr>
                         			{{Form::close()}}  			
                      				
                      			@foreach($clientes as $cliente)
                      				@foreach($usuario as $user)
	                      				<?php 
	                      				$id=$user->id;
	                      				if ($id==$cliente->usuario_id) {
	                      					$valor=$user->usuario; 
	                      				break;
	                      				}		?>
                      				@endforeach()	
                      			
                      			<form> 
                      				<tr id="tr_{{$cliente->id}}">
	                      				<td><input type="text" id="rfc_{{$cliente->id}}" name="rfc_{{$cliente->id}}" value="{{$cliente->rfc}} " disabled="disabled"></td>
            	    		        	<td><input type="text" id="usuario_id_{{$cliente->id}}" name="usuario_id_{{$cliente->id}}"  value="{{$valor}}" disabled="disabled"></td>
                	        			<td><input type="text" id="agente_id_{{$cliente->id}}" name="agente_id_{{$cliente->id}}" value="{{$cliente->agente_id}}" disabled="disabled"></td>
                	        			<td><input type="text" id="nivel_descuento_{{$cliente->id}}" name="nivel_descuento_{{$cliente->id}}" value="{{$cliente->nivel_descuento_id}}" disabled="disabled"></td>
                	        			<td><input type="text" id="nombre_{{$cliente->id}}" name="nombre_{{$cliente->id}}" value="{{$cliente->nombre}}" disabled="disabled"></td>
                	        			<td><input type="text" id="paterno_{{$cliente->id}}" name="paterno_{{$cliente->id}}" value="{{$cliente->paterno}}" disabled="disabled"></td>
                	        			<td><input type="text" id="materno_{{$cliente->id}}" name="materno_{{$cliente->id}}" value="{{$cliente->materno}}" disabled="disabled"></td>
                	        			<td><input type="text" id="nombre_comercial_{{$cliente->id}}" name="nombre_comercial_{{$cliente->id}}" value="{{$cliente->nombre_comercial}}" disabled="disabled"></td>
                	        			<td><input type="text" id="razon_social_{{$cliente->id}}" name="razon_social_{{$cliente->id}}" value="{{$cliente->razon_social}}" disabled="disabled"></td>
                	        			<td><input type="text" id="numero_{{$cliente->id}}" name="numero_{{$cliente->id}}" value="{{$cliente->numero_cliente}}" disabled="disabled"></td>
                	        			<td>
	                	        			
                                  <button type="button" value="Modificar" id="btn_mod" data-id="{{$cliente->id}}">Mod</button>
                                  <input type="hidden" id="campo_id{{$cliente->id}}" value="{{$cliente->id}}" name="campo_id" >
                                  <button type="button" value="Actualizar" id="btn_actualizar_{{$cliente->id}}" disabled="disabled" data-id="{{$cliente->id}}" > Act</button>
                                  <button type="button" id="btn_Eliminar" value="Eliminar" data-id="{{$cliente->id}}"> Eliminar</button>
	                	            </td>
                      				</tr>
                      			</form> 

                      			@endforeach()
                      			</tbody>
                      		</table>

                      	<?php
                      		break;
                      	case 'Comercializador':	?>
                      		<table class="table table-first-column-check">
                      			<thead>
                      				<tr>
                      					<th>Nombre</th>
                      				</tr>
                      			</thead>
                      			<tbody>
                      				@foreach($Comercializadores as $comercializador)
                      				<tr>
                      					<td><input type="text" id="nombre_{{$comercializador->id}}" name="nombre_{{$comercializador->id}}" value="{{$comercializador->nombre}}" disabled="disabled"></td>
                      				</tr>
                      				@endforeach
                      			</tbody>
                      		</table>

                      	<?php
                      		break;
                      	case 'Descuentos':			?>
                      		# code...
                      	<?php
                      		break;  
                      	default:
                      		# code...
                      		break;
                      }
                      ?>
                        
                      
                        
                     
        </div>
    </div>
</div>

<!--  Scripts        -->
<script type="text/javascript">
	$(document).ready(function () {
    var catalogo= '{{$catalogo}}';
	//Funcion para habilitar los campos para modificar Almacen
  	$(document).on('click', '.modificar', function(){
  		switch (catalogo){
        case 'Almacen':
    			$('#clave_'+$(this).data('id')).prop('disabled',false);
    			$('#nombre_'+$(this).data('id')).prop('disabled',false);
    			$('#status_'+$(this).data('id')).prop('disabled',false);
    			$('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
          break;

      }
    });

  	function confirmar(){
  		var respuesta=confirm('¿Estas seguro de guardar los datos? ');
  		return respuesta;
  	}

  	function confirmarEliminar(){
  		var respuesta= confirm('¿Estas seguro de eliminar este registro?');
  		return respuesta;
  	}
  	


    // Guardar datos
  	$(document).on('click','#btn_guardar', function(){
      $('#btn_guardar').prop('disabled',true);
      var msg="";
      var validar = true;
      switch (catalogo) {
        case 'Almacen':
          var estatus=null;
          if ($('#status_'+$(this).data('id')).is(':checked')) {
            estatus=1;
          }else{
            estatus=0;
          }
          
          if ($('#clave_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese la clave. \n';
            validar = false;
         
          }
          if ($('#nombre_'+$(this).data('id')).val()==="") {
            msg += 'Ingrese el nombre. \n';
            validar = false;
          };  
        break;

        case 'Cliente':
        /*  if ($('#rfc_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese la el RFC. \n';
            validar = false;
          }
           if ($('#usuario_id_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el usuario. \n';
            validar = false;
          }
          if ($('#agente_id_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el agente. \n';
            validar = false;
          }
          if ($('#nivel_descuento_id_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el descuento. \n';
            validar = false;
          }
          if ($('#nombre_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el nombre. \n';
            validar = false;
          }
          if ($('#paterno_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el apellido paterno. \n';
            validar = false;
          }
          if ($('#materno_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el apellido materno. \n';
            validar = false;
          }
          if ($('#nombre_comercial_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el nombre comercial. \n';
            validar = false;
          }
          if ($('#razon_social_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese razon social. \n';
            validar = false;
          }
          if ($('#numero_cliente_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese el numero. \n';
            validar = false;
          }*/
        break;

      }

      if(!validar){
        alert(msg);
        $('#btn_guardar').prop('disabled',false);
      }else{
        if(confirmar()){

          switch (catalogo){
      		  case 'Almacen':
              var datos={
          			
          			clave 	: $('#clave_'+$(this).data('id')).val(),
          			nombre  : $('#nombre_'+$(this).data('id')).val(),
          			estatus : estatus,
                catalogo: catalogo
          		};
              break;
            case 'Cliente':
              var datos = {
                rfc                 :   $('#rfc_'+$(this).data('id')).val(),
                usuario_id          :   $('#usuario_id_'+$(this).data('id')).val(),
                agente_id           :   $('#agente_id_'+$(this).data('id')).val(),
                nivel_descuento_id  :   $('#nivel_descuento_id_'+$(this).data('id')).val(),
                nombre              :   $('#nombre_'+$(this).data('id')).val(),
                paterno             :   $('#paterno_'+$(this).data('id')).val(),
                materno             :   $('#materno_'+$(this).data('id')).val(),
                nombre_comercial    :   $('#nombre_comercial_'+$(this).data('id')).val(),
                razon_social        :   $('#razon_social_'+$(this).data('id')).val(),
                numero_cliente      :   $('#numero_'+$(this).data('id')).val(),
                catalogo            :   catalogo
              };
              break;
          }

      		$.ajax({			
      			url: "/catalogo/create",
            type: "POST",
      			data: datos,
      			success: function(respuesta){
              console.log(respuesta);

              switch (catalogo){
                case 'Almacen':
                  if (respuesta.estatus==1) {var activar="checked"};
                  var fila = '<tr>' +
                                '<td> <input type="text" name="clave_'+respuesta.id+'" value="'+respuesta.clave + '" id="clave_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                '<td> <input type="text" name="nombre_'+respuesta.id+'" value="'+respuesta.nombre+'" id="nombre_'+respuesta.id+'" disabled="disabled" required>  </td>' +
                                '<td><input type="checkbox" name="status_'+respuesta.id+'" value="'+respuesta.estatus+'"  id="status_'+respuesta.id+'" disabled="disabled" '+ activar+' > </td>' +
                                '<td>'+
                                      '<button type="button" value="Modificar" id="btn_mod" data-id="'+respuesta.id+'">Mod</button>'+
                                      '<input type="hidden" id="elim_id" value="'+respuesta.id+'" name="elim_id" >'+
                                      '<button type="button" value="Actualizar" id="btn_actualizar_'+respuesta.id+'" disabled="disabled" data-id="'+respuesta.id+'" > Act</button>'+
                                      '<button type="button" id="btn_Eliminar" value="Eliminar" data-id="'+respuesta.id+'"> Eliminar</button>'+
                                    '</td>'+
                             '</tr>';


                 
                  $('#tablaResult').append(fila);
                  $('#clave_0').val('');
                  $('#nombre_0').val('');
                  
                  break;
                case 'Cliente':

                  break;


              }
              alert('Los datos se han almacenado correctamente...');
              $('#btn_guardar').prop('disabled',false);
              
      			},
      			error: function(msgError){
              console.log(msgError);
      				alert('Ocurrio un error al guardar');
      			}

      		});
        }
      }

  	});

    //          Eliminar
    $(document).on('click','#btn_Eliminar', function(){ 

      var id_Elim= $('#campo_id'+$(this).data('id')).val();
      //alert(id_Elim);
      $.ajax({
        url: "/catalogo/destroy/" + id_Elim,
        type: "DELETE",
        data: {catalogo: catalogo},
        success: function(){
          console.log();

          alert('Almacen eliminado');
          $('#tr_'+id_Elim).remove();
        },

        error: function(respuesta){
          console.log(respuesta);
          alert('no eliminado');
        }
      });

    });
    

      //-------------------------------  Actualizar --------------------------------//
    $(document).on('click','.actualizar', function(){
      $('#btn_actualizar_'+$(this).data('id')).prop('disabled',true);
      var msg="";
      var validar = true;
      switch (catalogo) {
        case 'Almacen':
          var estatus=null;
          if ($('#status_'+$(this).data('id')).is(':checked')) {
            estatus=1;
          }else{
            estatus=0;
          }
          
          if ($('#clave_'+$(this).data('id')).val() === ""){
            msg += 'Ingrese la clave. \n';
            validar = false;
         
          }
          if ($('#nombre_'+$(this).data('id')).val()==="") {
            msg += 'Ingrese el nombre. \n';
            validar = false;
          };  
        break;

        case 'Cliente':
          if ('#rfc_') {};
        break;

      }

      if(!validar){
        alert(msg);
        $('#btn_actualizar_'+$(this).data('id')).prop('disabled',false);
      }else{
        var id_upd= $('#campo_id'+$(this).data('id')).val();
        var datos={     // Almacen los datos para posteriormente enviarlos 
            
            clave   : $('#clave_'+$(this).data('id')).val(),
            nombre  : $('#nombre_'+$(this).data('id')).val(),
            estatus : estatus,
            catalogo: catalogo
          };

        $.ajax({
          url:  "/catalogo/update/"+id_upd,
          type: "PUT",
          data: datos,
          success: function (respuesta){
            console.log(respuesta);
            alert('Datos actualizados correctamente');

            switch (catalogo){
              case 'Almacen':
                if (respuesta.estatus==1) {var activar="checked"};
                $('#clave_'+respuesta.id).val(respuesta.clave);
                $('#nombre_'+respuesta.id).val(respuesta.nombre);
                $('#clave_'+respuesta.id).prop('disabled',true);
                $('#nombre_'+respuesta.id).prop('disabled',true);
                if (respuesta.estatus==1) { $('#status_'+respuesta.id).prop('checked',true); }else{ $('#status_'+respuesta.id).prop('checked',false); } 
                $('#status_'+respuesta.id).prop('disabled',true);
                $('#btn_actualizar_'+respuesta.id).prop('disabled',true);
                break;
            }

          },
          error: function(error){
            console.log(error);
          }

        });
      }

    });

  });
</script>
@stop

