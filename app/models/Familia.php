<?php

class Familia extends Eloquent{
	protected $table = "familia";

	public function productos(){
		return $this->hasMany('Producto');
	}

	public function descuento(){
		return $this->belongsTo('Descuento');
	}
}
