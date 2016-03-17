<?php
class PrecioProducto extends Eloquent{
	protected $table = "producto_precio";

	public function pedidoDetalles(){
		return $this->hasMany('PedidoDetalle');
	}
	
	public function producto(){
		return $this->belongsTo('Producto');
	}
}