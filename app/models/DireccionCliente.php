<?php 

class DireccionCliente extends Eloquent{
	protected $table = "direccion_cliente";

	public function pedidos(){
		return $this->hasMany('Pedido');
	}

	public function cliente(){
		return $this->belongsTo('Cliente');
	}

	public function telefonoCliente(){
		return $this->belongsTo('telefono_cliente');
	}

	public function pais(){
		return $this->belongsTo('Pais');
	}

	public function estado(){
		return $this->belongsTo('Estado');
	}

	public function municipio(){
		return $this->belongsTo('Municipio');
	}


}