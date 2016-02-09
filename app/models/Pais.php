<?php 

class Pais extends Eloquent{

	protected $table = "pais";

	public function direcciones(){
		return $this->hasMany('Direccion');
	}

	public function estados(){
		return $this->hasMany('Estado');
	} 
}