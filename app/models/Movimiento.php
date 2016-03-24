<?php 

class Movimiento extends Eloquent{
	protected $table = "movimientos";

	public function producto(){
		return $this->belongsTo('Producto');
	}

	public function usuario(){
		return $this->belongsTo('Usuario');
	}

}