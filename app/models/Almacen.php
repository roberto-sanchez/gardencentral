<?php 

class Almacen extends Eloquent{
	protected $table = "almacen";

	public function productos(){
		return $this->hasMany('Producto');
	}
}