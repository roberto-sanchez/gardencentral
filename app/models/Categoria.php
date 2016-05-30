<?php 

class Categoria extends Eloquent{
	protected $table = "categoria";

	public function productos(){
		return $this->hasMany('Producto');
	}
}