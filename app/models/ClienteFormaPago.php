<?php 

class ClienteFormaPago extends Eloquent{
	protected $table = "cliente_forma_pago";

	public function cliente(){
		return $this->belongsTo('Cliente');
	}

	public function formaPago(){
		return $this->belongsTo('FormaPago');
	}
}

