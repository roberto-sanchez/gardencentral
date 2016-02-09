<?php 

class Estado extends Eloquent{
	protected $table = "estado";

	public function direcciones(){
		return $this->hasMany('Direccion');
	}

	public function municipios(){
		return $this->hasMany('Municipio');
	}

	public function pais(){
		return $this->belongsTo('Pais');
	}
}