<?php

class Familia extends Eloquent{
	protected $table = "familia";

	public function productos(){
		return $this->hasMany('Producto');
	}

	public function descuentos(){
		return $this->hasMany('Descuento');
	}
}
