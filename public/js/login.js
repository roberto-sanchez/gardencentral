$(document).ready(function(){



if($('.sesion-f').length == 0){
    
} else {
    noexiste = [[ 'top', 'success',  "Tu sesión ha sido cerrada." ]];
    message = noexiste[Math.floor(Math.random() * noexiste.length)];

    $('.' + message[0]).notify({
        message: { text: message[2] },
        type: message[1]
    }).show();
}

// ------------------ Inicio de Sesion  -------------------- 

//Validamos el username y la contraseña del inicio de sesion
    $("#acceder").click(function () {  
     
    if( $("#username").val() == 0  )  {  
        $('.formUserName').addClass('has-error');  
        return false;  

    } else if($("#password").val() == 0){
            $('.formPassword').addClass('has-error');  
            return false;
      
    }  else {
        return true; 
    }
}); 


/*Verificar si el usuario existe */
  $('#username').keyup( function(){
    if($('#username').val()!= ""){   
         usuario = $('#username').val().trim();

        $.ajax({
            type: "POST",
            url: "productos/getLoginUser",
             data: {usuario: usuario },
            success: function( u ){
                d = u.usuario;
                id = u.id;
                $('#password').attr('data-id',id);
                 if (d === undefined) {
                     $('.spanUserName').addClass('glyphicon glyphicon-remove form-control-feedback');
                     $('.formUserName ').addClass('has-error');
                     $('#acceder').addClass('disabled');
                      $('#u-e').fadeIn(300);
                    } else {
                      $('.formUserName ').removeClass('has-error');
                      $('.spanUserName').removeClass('glyphicon-remove');
                      $('.formUserName ').addClass('has-success');
                      $('.spanUserName').addClass('glyphicon glyphicon-ok form-control-feedback');
                      $('#acceder').removeClass('disabled'); 
                      $('#u-e').fadeOut(300);
                }
                
              
            }
        });
     }
});

    //validamos la password
    $('.formPassword').keyup(function(){
        valor = $('#password').val();
        if(valor.indexOf(' ') >= 0){
            $('.spanPassword').show();
            $('.formPassword').addClass('has-error');
            $('.spanPassword').addClass('glyphicon glyphicon-remove form-control-feedback');
         }
          else if(valor.length <= 5 ){
            $('.spanPassword').show();
            $('.formPassword').addClass('has-error');
            $('.spanPassword').addClass('glyphicon glyphicon-remove form-control-feedback');    
         }
         else {
            $('.formPassword').removeClass('has-error');
            $('.spanPassword').removeClass('glyphicon-remove');
            $('.spanPassword').addClass('glyphicon glyphicon-ok form-control-feedback');
            $('.formPassword').addClass('has-success');

         }
    });

/*Verificar si la contraseña existe */
 /* $('#password').keyup( function(){
    if($('#password').val()!= ""){   
         idpass = $('#password').attr('data-id');
        pass = $('#password').val();
         console.log(idpass);
         //alert(pass);
        $.ajax({
            type: "POST",
            url: "productos/getLoginPass",
             data: {idpass: idpass, pass: pass },
            success: function( p ){
                console.log(p);
                vp = p.password;
                console.log(vp);
                //console.log(pass);
                                                
              
            }
        });
     }
});
 */

/*Si la sesion falla obtendremos el valor del username y realizaremos lo siguiente*/
 if($('#username').val().trim().length == 0){
    $('.formUserName').removeClass('has-error', 'has-feedback');
    $('.spanUserName').removeClass('glyphicon glyphicon-remove form-control-feedback');
    $('.formPassword').removeClass('has-error', 'has-feedback');
    $('.spanPassword').removeClass('glyphicon glyphicon-remove form-control-feedback');

 } else if($('#username').val().trim().length >= 1 && $('#username').val().trim().length <= 5){
    $('.formUserName').addClass('has-error', 'has-feedback');
    $('.spanUserName').addClass('glyphicon glyphicon-remove form-control-feedback');
} else {
    $('.formUserName').addClass('has-success', 'has-feedback');
    $('.spanUserName').addClass('glyphicon glyphicon-ok form-control-feedback');
    $('.formPassword').addClass('has-error', 'has-feedback');
    $('.spanPassword').addClass('glyphicon glyphicon-remove form-control-feedback');
}

$('#password').focus(function(){
 
    $('.formPassword').removeClass('has-error', 'has-feedback');
    $('.spanPassword').removeClass('glyphicon glyphicon-remove form-control-feedback');
   
});

/*-----Validamos el campo para restablecer la contraseña*/
/*Verificar disponibilidad de email y validamos el campo*/
  $('#restp').keyup( function(){
    if($('#restp').val()!= ""){   
         email = $('#restp').val();

        $.ajax({
            type: "POST",
            url: "productos/getVerificaremail",
             data: {email: email },
           beforeSend: function(){
              $('.email-r').removeClass('text-danger');
              $('.email-r').addClass('text-success');
              $('#msgREmail').html('verificando...');
            },
            success: function( m ){
                mail = m.email;
                     if (mail === undefined) {
                         $('.formREmail').removeClass('has-success');
                         $('.spanREmail').removeClass('glyphicon-ok');
                         $('.spanREmail').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.formREmail').addClass('has-error');
                         $('email-r').removeClass('text-success');
                         $('email-r').addClass('text-danger');
                         $('email-r').show();
                         $('#msgREmail').html("No esta registrado ese e-mail.");
                         $('.email-r').addClass('text-danger');
                         $('#rest-p').addClass('disabled');
                    } else {
                          $('.formREmail').removeClass('has-error');
                          $('.spanREmail').removeClass('glyphicon-remove');
                          $('.formREmail').addClass('has-success');
                          $('.spanREmail').addClass('glyphicon glyphicon-ok form-control-feedback');
                          $('email-r').removeClass('text-danger');
                          $('email-r').addClass('text-success');
                          $('email-r').hide();
                          $('#rest-p').removeClass('disabled');
                          $('#msgREmail').hide();
                   
                }
                
              
            }
        });
     }
});










//Validaciones para los campos del formularios
    $("#enviarregistro").click(function () {  
     
    if( $("#formRfc").val() <= 12  )  {  
        $('.formRfc').addClass('has-error');  
        return false;  

    } else if($("#formName").val() <= 3){
            $('.formName').addClass('has-error');  
            return false;
      
    }  else if($("#formLast").val() <= 3){
            $('.formLast').addClass('has-error');  
            return false;
      
    } else if($("#formUser").val().length <= 3){
            $('.formUser').addClass('has-error');  
            return false;

    } else if( $("#formEmail").val().length == 0 ){
            $('.formEmail').addClass('has-error');  
            return false;
      
    } else if($("#formPass1").val().length <= 5){
            $('.formPass1').addClass('has-error');  
            return false;
      
    } else if($("#formPass2").val().length <= 5){
            $('.formPass2').addClass('has-error');  
            return false;
      
    } else {
        return true; 
    }
}); 



//-----------Mostramos el contenido de persona moral
 $('.oculto').hide();

 $('.span').on('click', function(){
    $('.oculto').slideToggle(800);
 });



/*________ Formulario de registro __________*/

   //validaciones el rfc
   $('.formRfc').keyup(function(){
      //expresion para validar el rfc
      exprfc = /^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/;
      valor = $('#formRfc').val().trim();
      /* test es propio de js, lo que hace es validar con lo que le pongamos en los parentesis y con ! le indicamos que si no se cumple la condicion ejecute lo que este dentro del if y en caso de que si manda al else  */     
        if(!exprfc.test(valor.toUpperCase())){ //convertimos el rfc en mayusculas
            $('.formRfc').addClass('has-error');
            $('.spanRfc').addClass('glyphicon glyphicon-remove form-control-feedback');
            $('.spanRfcText').text("Introduce un rfc valido");
         } else {
            $('.formRfc').removeClass('has-error');
            $('.formRfc').addClass('has-success');
            $('.spanRfc').removeClass('glyphicon-remove');
            $('.spanRfc').addClass('glyphicon glyphicon-ok form-control-feedback');
            $('.spanRfcText').text('');
         }
   });
    

   //validaciones el nombre
   $('.formName').keyup(function(){
        valor = $('#formName').val(); 
		if(valor.length <= 2 || /^\s+$/.test(valor)){
         	$('.spanName').addClass('glyphicon glyphicon-remove form-control-feedback');
         	$('.formName').addClass('has-error');
			
         } else {
         	$('.formName').removeClass('has-error');
         	$('.formName').addClass('has-success');
         	$('.spanName').removeClass('glyphicon-remove');
         	$('.spanName').addClass('glyphicon glyphicon-ok form-control-feedback');
         }
   });
    

    //validamos el apellido paterno
    $('.formLast').keyup(function(){
        valor = $('#formLast').val();
        if(valor.length <= 2 || /^\s+$/.test(valor) ){
            $('.spanLast').addClass('glyphicon glyphicon-remove form-control-feedback');
            $('.formLast').addClass('has-error');
         } else {
            $('.formLast').removeClass('has-error');
            $('.formLast').addClass('has-success');
            $('.spanLast').removeClass('glyphicon-remove');
            $('.spanLast').addClass('glyphicon glyphicon-ok form-control-feedback');
         }
    });

      
    //validamos el apellido materno, este campo es opcional
    $('.formMat').keyup(function(){
        valor = $('#formMat').val();
        if(valor.length == 0 || /^\s+$/.test(valor) ){
            $('.spanMat').addClass('hidden');
            $('.formMat').addClass('has-success');
            $('.formMat').removeClass('has-warning');
            $('.spanMatText').text('');
         } else if(valor.length <= 2){
                $('.spanMat').removeClass('hidden');
                $('.formMat').removeClass('has-success');
                $('.formMat').removeClass('glyphicon-ok');
                $('.spanMat').addClass('glyphicon glyphicon-remove form-control-feedback');
                $('.formMat').addClass('has-warning');
                $('.spanMatText').text('Campo opcional');
          } else {
            $('.spanMat').removeClass('hidden');
            $('.spanMat').removeClass('glyphicon-remove');
            $('.formMat').removeClass('has-warning');
            $('.formMat').addClass('has-success');
            $('.spanMat').addClass('glyphicon glyphicon-ok form-control-feedback');
            $('.spanMatText').text('');
         }
    });


/*Verificar disponibilidad de usuario y validamos el campo*/
  $('#formUser').keyup( function(){
    if($('#formUser').val()!= ""){   
         user = $('#formUser').val();

        $.ajax({
            type: "POST",
            url: "productos/getVerificarUser",
             data: {user: user },
           beforeSend: function(){
              $('.email-v').removeClass('text-danger');
              $('.email-v').addClass('text-success');
              $('#msgUsuario').html('verificando...');
            },
            success: function( respuesta ){
                ver = respuesta.usuario;
                valor = $('#formUser').val();
                 if(valor.indexOf(' ') >= 0){
                    $('.formUser').removeClass('has-success');
                    $('.spanUser').removeClass('glyphicon-ok');
                    $('.spanUser').addClass('glyphicon glyphicon-remove form-control-feedback');
                    $('.formUser').addClass('has-error');     
                    $('.spanUserText').text('No puedes dejar espacios en blanco'); 
                    $('.spanUserText').show(); 
                    $('.user-v').hide();
                    $('#enviarregistro').addClass('disabled');
                 } else if(valor.length <= 3 ){
                        $('.formUser').removeClass('has-success');
                          $('.spanUser').removeClass('glyphicon-ok');
                        $('.spanUser').addClass('glyphicon glyphicon-remove form-control-feedback');
                        $('.formUser').addClass('has-error');
                        $('.spanUserText').text('Debe tener mas de 3 caracteres');
                        $('.user-v').hide();
                     } else if (ver === undefined) {
                          $('.formUser').removeClass('has-error');
                          $('.spanUser').removeClass('glyphicon-remove');
                          $('.formUser').addClass('has-success');
                          $('.spanUser').addClass('glyphicon glyphicon-ok form-control-feedback');
                          $('.spanUserText').hide();
                          $('.user-v').removeClass('text-danger');
                          $('.user-v').addClass('text-success');
                          $('.user-v').show();
                          $('#msgUsuario').html("Disponible.");
                          $('#enviarregistro').removeClass('disabled');
                    } else {
                     $('.spanUser').addClass('glyphicon glyphicon-remove form-control-feedback');
                     $('.formUser').addClass('has-error');
                     $('.user-v').removeClass('text-success');
                     $('.user-v').addClass('text-danger');
                     $('#msgUsuario').html("El nombre de usuario ya existe, elige otro.");
                     $('#enviarregistro').addClass('disabled');
                   
                }
                
              
            }
        });
     }
});


/*Verificar disponibilidad de email y validamos el campo*/
  $('#formEmail').keyup( function(){
    if($('#formEmail').val()!= ""){   
         email = $('#formEmail').val().trim();

        $.ajax({
            type: "POST",
            url: "productos/getVerificaremail",
             data: {email: email },
           beforeSend: function(){
              $('.email-v').removeClass('text-danger');
              $('.email-v').addClass('text-success');
              $('#msgEmail').html('verificando...');
            },
            success: function( m ){
                mail = m.email;
                 expr = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/; //expresion para validar el hotmail
                 valor = $('#formEmail').val();
                     if( !expr.test(valor) ){
                        $('.formEmail').removeClass('has-success');
                        $('.spanEmail').removeClass('glyphicon-ok');
                        $('.formEmail').addClass('has-error');
                        $('.spanEmail').addClass('glyphicon glyphicon-remove form-control-feedback');
                        $('.spanEmailText').text("Introduce una dirección de correo valida");
                        $('.email-v').hide();
                        $('#enviarregistro').addClass('disabled');
                     } else if(valor.length <= 3 ){
                        $('.formEmail').removeClass('has-success');
                        $('.spanEmail').removeClass('glyphicon-ok');
                        $('.spanEmail').addClass('glyphicon glyphicon-remove form-control-feedback');
                        $('.formEmail').addClass('has-error');
                        $('.user-v').hide();
                     } else if (mail === undefined) {
                          $('.formEmail').removeClass('has-error');
                          $('.spanEmail').removeClass('glyphicon-remove');
                          $('.formEmail').addClass('has-success');
                          $('.spanEmail').addClass('glyphicon glyphicon-ok form-control-feedback');
                          $('.spanEmailText').hide();
                          $('.email-v').removeClass('text-danger');
                          $('.email-v').addClass('text-success');
                          $('.email-v').show();
                          $('#msgEmail').html("Disponible.");
                          $('#enviarregistro').removeClass('disabled');
                    } else {

                         $('.formEmail').removeClass('has-success');
                         $('.spanEmail').removeClass('glyphicon-ok');
                         $('.spanEmail').addClass('glyphicon glyphicon-remove form-control-feedback');
                         $('.formEmail').addClass('has-error');
                         $('.email-v').removeClass('text-success');
                         $('.email-v').addClass('text-danger');
                         $('.email-v').show();
                         $('#msgEmail').html("El email ya existe, elige otro.");
                         $('#enviarregistro').addClass('disabled');
                   
                }
                
              
            }
        });
     }
});



   //Validamos el nombre comercial, este campo es opcional 
   $('.formComercial').keyup(function(){
        valor = $('#formComercial').val();
        if(valor.length == 0 || /^\s+$/.test(valor) ){
            $('.spanComercial').addClass('hidden');
            $('.formComercial').addClass('has-success');
            $('.formComercial').removeClass('has-warning');
            } else if(valor.length <= 2){
                $('.spanComercial').removeClass('hidden');
                $('.formComercial').removeClass('has-success');
                $('.formComercial').removeClass('glyphicon-ok');
                $('.spanComercial').addClass('glyphicon glyphicon-remove form-control-feedback');
                $('.formComercial').addClass('has-warning');
            } else {
                $('.spanComercial').removeClass('hidden');
                $('.spanComercial').removeClass('glyphicon-remove');
                $('.formComercial').removeClass('has-warning');
                $('.formComercial').addClass('has-success');
                $('.spanComercial').addClass('glyphicon glyphicon-ok form-control-feedback');
         }
    });

    
    //Validamos la razon social, este campo es opcional 
    $('.formSocial').keyup(function(){
        valor = $('#formSocial').val();
        if(valor.length == 0 || /^\s+$/.test(valor) ){
            $('.spanSocial').addClass('hidden');
            $('.formSocial').addClass('has-success');
            $('.formSocial').removeClass('has-warning');
         } else if(valor.length <= 2){
                $('.spanSocial').removeClass('hidden');
                $('.formSocial').removeClass('has-success');
                $('.formSocial').removeClass('glyphicon-ok');
                $('.spanSocial').addClass('glyphicon glyphicon-remove form-control-feedback');
                $('.formSocial').addClass('has-warning')
          } else {
            $('.spanSocial').removeClass('hidden');
            $('.spanSocial').removeClass('glyphicon-remove');
            $('.formSocial').removeClass('has-warning');
            $('.formSocial').addClass('has-success');
            $('.spanSocial').addClass('glyphicon glyphicon-ok form-control-feedback');
         }
    });


    //validamos la primer contraseña	 
    $('.formPass1').keyup(function(){
        valor1 = $('#formPass1').val();
        valor2 = $('#formPass2').val();
		if(valor1 != valor2 ){
			$('#enviarregistro').addClass('disabled');       
         }

		if(valor1.indexOf(' ') >= 0){
         	$('.formPass1').addClass('has-error');
         	$('.spanPass1').addClass('glyphicon glyphicon-remove form-control-feedback');
 			$('.spanPass1Text').text('No puedes dejar espacios en blanco');
         }
		  else if(valor1.length <= 5 ){
         	$('.formPass1').addClass('has-error');
         	$('.spanPass1').addClass('glyphicon glyphicon-remove form-control-feedback');
			$('.spanPass1Text').text('Debe tener mas de 5 caracteres');	
         } 

		 else {
		 	$('.formPass1').removeClass('has-error');
		 	$('.spanPass1').removeClass('glyphicon-remove');
		 	$('.spanPass1').addClass('glyphicon glyphicon-ok form-control-feedback');
         	$('.formPass1').addClass('has-success');
         	$('.spanPass1Text').text('');
         } 
    });

	//validamos la segunda contraseña
	$('.formPass2').keyup(function(){

        valor1 = $('#formPass1').val();
        valor2 = $('#formPass2').val();
		if(valor1 != valor2 ){
			$('.formPass2').addClass('has-error');
         	$('.spanPass2').addClass('glyphicon glyphicon-remove form-control-feedback');
			$('.spanPass2Text').text('Las contraseñas no coinciden');
			$('#enviarregistro').addClass('disabled');
         } else {
         	$('.formPass2').removeClass('has-error');
         	$('.spanPass2').removeClass('glyphicon-remove');
         	$('.spanPass2Text').removeClass('r_pass');
         	$('.spanPass2').addClass('glyphicon glyphicon-ok form-control-feedback');
         	$('.formPass2').addClass('has-success');
         	$('.spanPass2Text').text('');
         	$('#enviarregistro').removeClass('disabled');
     
         }
    });
   




});