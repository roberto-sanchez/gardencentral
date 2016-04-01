<?php

class RemindersController extends Controller {


	/**
	 * Manejar una petición POST para recordar a un usuario de su contraseña.
	 * 1.- store password
 	 * @return Response
	 */
	
	public function postRemind() {
		
		switch ($response = Password::remind(Input::only('email'), function($message){
			$message->subject('Restablecer contraseña.');

		})){

			case Password::INVALID_USER:
				Session::flash('messageDanger', 'El e-mail no existe.');
				return Redirect::back();

			case Password::REMINDER_SENT:
				Session::flash('messageOK', 'Se ha enviado un mensaje de confirmación a tu dirección de e-mail.');
				return Redirect::back();
		}
	}




	/**
	 * 2.- show password.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 *  3.- update password
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				Session::flash('messageDanger', 'Las contraseñas no coinciden.');
				return Redirect::back();
			case Password::INVALID_TOKEN:

			case Password::INVALID_USER:
				Session::flash('messageDanger', 'El e-mail no existe.');
				return Redirect::back();

			case Password::PASSWORD_RESET:
				Session::flash('messageOK', 'Contraseña cambiada con éxito.');
				return Redirect::to('/');
		}
	}

}
