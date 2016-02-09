<?php 

class EntradaDetalle extends Eloquent{
	protected $table = "entrada_detalle";

	public function entrada(){
		return $this->belongsTo('Entrada');
	}

	public function producto(){
		return $this->belongsTo('Producto');
	}
}