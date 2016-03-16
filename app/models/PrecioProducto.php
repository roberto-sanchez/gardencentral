<?php
class PrecioProducto extends Eloquent{
	protected $table = "producto_precio";
	
	public function producto(){
		return $this->belongsTo('Producto');
	}
}