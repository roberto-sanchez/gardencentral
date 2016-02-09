<?php

class UsersController extends \BaseController {

        //Traemos el contenido de los paises
/*  public function getIndex(){
    //$user = DB::table('usuario')->get();
    //return View::make('users/index',$user);
    return View::make('users/index')
            ->with('productoprecios', Precio::with('producto')->get());
  }  */


  public function getIndex() {
    
   // if(Auth::check()){ //bloqueo de acceso
      /*$rol = Auth::user()->rol_id;
      if($rol == 1){
      //return View::make('users/index');
      return "No eres cliente";
      } elseif($rol == 2){
      return Redirect::to('agentes');
      } else{
      return Redirect::to('admin');
      } */
   //}
}


  //Verificar disponibilidad de usuario y email
  public function getVerificar(){
   // $clave = Input::get('usuario');
    $resp = DB::table('usuario') 
            ->where('id', 3)->first(); 

        return Response::json($resp);
  }


  // metodo para agregar al usuario (Cliente)
    public function postCreate() {

      $mensajeError='';

      $validator=Validator::make
      (
        [
          'rfc' => Input::get('rfc'),
          'nombre' => Input::get('name'),
          'paterno' => Input::get('last_name'),
          'usuario' => Input::get('username'),
          'email' => Input::get('email'),
          'password' => Input::get('password')
        ],

        [
          'rfc' => 'required|min:13|max:13',
          'nombre' => 'required|min:3|max:30',
          'paterno' => 'required|min:3',
          'usuario' => 'required|unique:usuario',
          'email' => 'required|unique:usuario|email',
          'password' => 'required|min:6'
        ]
      );

      if($validator->fails()) {
        //verificamos que los campos requeridos no esten vacios, en caso de q si manda el msj de error
        if($validator->messages()!='') {
          $mensajeError.='Completa correctamente los campos que se te piden. <br/>';
        }
          //Verificamos que el username sea unico
          if($validator->messages()->first('usuario')) {
          $mensajeError.='El nombre de usuario ya existe, elige otro. <br/>';
        }
          //Verificamos que el email sea unico
        if($validator->messages()->first('email')) {
          $mensajeError.='El email ya existe, elige otro. <br/>';
        }


      }
        

      //Validamos que las contraseñas sean identicas
      if(Input::get('password')!=Input::get('rpassword'))
      {
        $mensajeError.='Las contraseñas no coinciden';
      } 

      //Si la variable mensaje es diferente a vacio mandamos los msjs
      if($mensajeError!='')
      {
        Session::flash('messageDanger', $mensajeError);
         return Redirect::to('/');
      }

      //si todo es correcto guardamos
    //insertamos los datos a la tabla users si todo esta correcto
      $user = new Usuario;
      $user->id = Input::get('id');
      $user->rol_id = Input::get('level');
      $user->usuario = Input::get('username');
      $password = Input::get('password');
      $user->password = Hash::make($password);
      $user->email = Input::get('email');
      $user->save();

      //insertamos en la tabla clientes
      $cliente = new Cliente;
      $cliente->usuario()->associate($cliente);
      $cliente->rfc = Input::get('rfc');
      $cliente->usuario_id = $user['id'];
      $cliente->nivel_descuento_id = "1";
      $cliente->nombre_cliente = Input::get('name');
      $cliente->paterno = Input::get('last_name');
      $cliente->materno = Input::get('materno');
      $cliente->nombre_comercial = Input::get('comercial');
      $cliente->razon_social = Input::get('social');
      $cliente->numero_cliente = date('Y').date('m').date("d").date('G').date('i').date('s').$user->id;
      $cliente->save(); 

      Session::flash('messageOK', ' Usuario creado exitosamente ');
      //redirigimos a usurios
      return Redirect::to('/');

  }


/*  public function getEstado(){

    $dato = DB::table('estado') 
            ->join('municipio', 'estado.id', '=', 'municipio.estado_id')
            ->where($dato)->first(); //donde la clave recivida del form es igual a la clave del producto
            return Response::json($resp);
 }
*/



  public function postCambiarpass() {

    //almacenamos el contenido del formulario con el metodo all
    $input = Input::all();

    try {
      if(Auth::attempt(array('usuario' => Auth::user()->usuario, 'password' => $input['password0'])))
      {
        if($input['password1'] == $input['password2'])
        {
          Auth::user()->password = Hash::make($input['password1']);
          Auth::user()->update();
        } else {
          Session::flash('messageDangerp', 'Las contraseñas no coinciden.');

          return Redirect::back();
        }

      } else {
        Session::flash('messageDangerp', 'Tu contraseña actual es incorrecta.');

        return Redirect::back();
      }

    } catch (Exception $e) {

      return Redirect::back();
    }

    Session::flash('messageOKp', 'Contraseña cambiada con éxito.');

    return Redirect::back();
  }






}
