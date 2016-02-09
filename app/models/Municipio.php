<?php 

class Municipio extends Eloquent{
	protected $table = "municipio";

	public function direcciones(){
		return $this->hasMany('Direccion');
	}

	public function estado(){
		return $this->belongsTo('Estado');
	}
}