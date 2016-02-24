<?php

class LoginController extends \BaseController {

	public function __construct()
	{

		$this->afterFilter('auth');  //bloqueo de acceso

	}

		public function showLogin() {

		// Verificamos que el usuario esté autenticado
		if (Auth::check()) {

			// Si está autenticado lo mandamos al admin.
			//return Redirect::to('admin');
		}

		// Si no esta autentificado nos debuelve al login
		return View::make('login');
	}

		//verificamos los datos del usuario, en caso de que este autenticado
		public function postLogin() {

		// Guardamos en un arreglo los datos del usuario.
		$userdata = [
			'usuario' => Input::get('username'),
			'password' => Input::get('password')
		];

		/* Accedemos al rol del usuario
	 * 1 - Cliente
	 * 2 - Agente
	 * 3 - Administrador
	 */

	// Validamos los datos
	 if (Auth::attempt($userdata)) {

		 //accedemos al nivel del usuario
 		 $rol = Auth::user()->rol_id;

		 if($rol == 3) //si ingresa el admin, mostrara todo el contenido del admin
	{
		 //return View::make('admin/index');
		 return Redirect::to('admin');

	 }

		elseif($rol == 2 || $rol == 4 ){
	 //Aqui redireccionare a las vistas del agente
	 return Redirect::to('agentes');
	}
	else{

	 return Redirect::to('users');

  	}

}

		Session::flash('messageDanger', ' Tu contraseña es incorrecta ');
		//return Redirect::to('login');
		return View::make('login', Input::all());
	}



	 //Verificar inicio de sesion
  public function getLoginUser(){
   $user = Input::get('usuario');

    $resp = DB::table('usuario')
            ->select('id', 'usuario')
            ->where('usuario', $user)->first();

    if(count($resp)==0){
        return Response::json($resp);

    } else {

        return Response::json($resp);
    }

  }

  public function getLoginPass(){
  	$iduser = Input::get('idpass');
    
    $p = DB::table('usuario')
		    		->where('id', $iduser)->pluck('password');


   if (Hash::check(Input::get('pass'), $p)) {

			    $b = "coinciden";

			} else {

				$b = "No coinciden";
				
			}

		 return Response::json($b);

  }



   //Verificar disponibilidad de usuario y email
  public function getVerificarUser(){
   $user = Input::get('user');

    $resp = DB::table('usuario')
            ->select('usuario')
            ->where('usuario', $user)->first();

    if(count($resp)==0){

        return Response::json($resp);

    } else {

        return Response::json($resp);
    }


  }




    //logout
	public function logOut() {
		Auth::logout();
		Session::flash('messageE', 'f');
		return Redirect::to('login');
	}



}
