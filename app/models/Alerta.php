<?php 

class Alerta extends Eloquent{
	protected $table = "alertas";

	public function producto(){
		return $this->belongsTo('Producto');
	}
}