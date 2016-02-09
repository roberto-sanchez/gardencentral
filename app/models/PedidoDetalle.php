<?php 

class PedidoDetalle extends Eloquent{
	protected $table = "pedido_detalle";

	public function pedido(){
		return $this->belongsTo('Pedido');
	}

	public function producto(){
		return $this->belongsTo('Producto');
	}
}