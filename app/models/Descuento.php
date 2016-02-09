<?php 

class Descuentos extends Eloquent{
	protected $table = "descuento";

	public function familias(){
		return $this->hasMany('Familia');
	}
}