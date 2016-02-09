<?php 

class Rol extends Eloquent{
	protected $table = "rol";

	public function usuarios(){
		return $this->hasMany('Usuario');
	}
}