<?php
class FormaDePago extends Eloquent{
	protected $table = "forma_pago";

	public function clientes(){
		return $this->hasMany('Cliente');
	}

}
