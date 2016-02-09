<?php 

class TelefonoCliente extends Eloquent{
	protected $table = "telefono_cliente";

	public function direccionClientes(){
		return $this->hasMany('DireccionCliente');
	}

	public function cliente(){
		return $this->belongsTo('Cliente');
	}
}