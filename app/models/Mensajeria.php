<?php 

class Mensajeria extends Eloquent{
	protected $table = "mensajeria";

	public function pedido(){
		return $this->hasOne('Pedido');
	}
}