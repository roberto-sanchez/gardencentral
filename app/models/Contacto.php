<?php 

class Contacto extends Eloquent{
	protected $table = "contacto";

	public function proveedor(){
		return $this->belongsTo('Proveedor');
	}
}