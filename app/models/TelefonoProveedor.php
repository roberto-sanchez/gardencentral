<?php 

class TelefonoProveedor extends Eloquent{
	protected $table = "telefono_proveedor";

	public function proveedor(){
		return $this->belongsTo('Proveedor');
	}
}