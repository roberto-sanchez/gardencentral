<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuario extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuario';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');


	public function clientes(){
		return $this->hasMany('Cliente');
	}

	public function usuarioDetalles(){
		return $this->hasMany('UsuarioDetalle');
	}

	public function loges(){
		return $this->hasMany('Loge');
	}

	public function rol(){
		return $this->belongsTo('Rol');
	}


	/**
	 * Obtener el identificador único para el usuario.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}


	/**
	 * Obtener la contraseña para el usuario.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}


	/**
	 * Obtener el e-mail donde se envían recordatorios de contraseña.
	 *
	 * @return string
	 * 
	 */
	
	public function getReminderEmail()
	{
		return $this->email;
	}



}
