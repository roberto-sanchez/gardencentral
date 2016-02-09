<?php 

class Cliente extends Eloquent{
	protected $table = "cliente";

	public function direccionClientes(){
		return $this->hasMany('DireccionCliente');
	}

	public function telefonoClientes(){
		return $this->hasMany('TelefonoCliente');
	}

	public function pedidos(){
		return $this->hasMany('Pedido');
	}

	
	public function clienteFormaPagos(){
		return $this->hasMany('ClienteFormaPago');
	}

	public function usuario(){
		return $this->belongsTo('Usuario');
	}

	public function nivelDescuento(){
		return $this->belongsTo('NivelDescuento');
	}




}

