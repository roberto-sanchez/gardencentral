<?php 

class NivelDescuento extends Eloquent{
	protected $table = "nivel_descuento";

	public function clientes(){
		return $this->hasMany('Cliente');
	}
}