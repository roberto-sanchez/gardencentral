<?php 

class Comercializador extends Eloquent{
	protected $table = "comercializador";

	public function proveedores(){
		return $this->hasMany('Proveedor');
	}
}