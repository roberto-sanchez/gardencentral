<?php 

class ExtraPedido extends Eloquent{
	protected $table = "extra_pedido";

	public function pedido(){
		return $this->belongsTo('Pedido');
	}

}