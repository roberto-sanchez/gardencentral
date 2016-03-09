<?php 

class InventarioDetalle extends Eloquent{
	protected $table = "inventario_detalle";

	public function producto(){
		return $this->belongsTo('Producto');
	}
}