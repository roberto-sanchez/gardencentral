<?php 

class Importador extends Eloquent{
	protected $table = "importador";

	public function productos(){
		return $this->hasMany('Producto');
	}
}