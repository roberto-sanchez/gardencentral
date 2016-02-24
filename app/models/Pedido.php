<?php 

class Pedido extends Eloquent{
	protected $table = "pedido";

	public function pedidoDetalles(){
		return $this->hasMany('PedidoDetalle');
	}

	public function loges(){
		return $this->hasMany('Loge');
	}


	public function cliente(){
		return $this->belongsTo('Cliente');
	}

	public function mensajeria(){
		return $this->belongsTo('Mensajeria');
	}

	public function direccionCliente(){
		return $this->belongsTo('DireccionCliente');
	}
}