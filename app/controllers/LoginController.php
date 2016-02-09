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

		elseif($rol == 2){
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


    //logout
	public function logOut()
	{
		Auth::logout();
		Session::flash('messageOK', ' Tu sesión ha sido cerrada ');
		return Redirect::to('login');
	}


}
