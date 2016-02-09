<?php 

class Inventario extends Eloquent{
	protected $table = "inventario";

	public function producto(){
		return $this->belongsTo('Producto');
	}
}