<?php 

class DireccionProveedor extends Eloquent{
	protected $table = "direccion_proveedor";

	public function proveedor(){
		return $this->belongsTo('Proveedor');
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