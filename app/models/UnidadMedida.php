<?php 

class UnidadMedida extends Eloquent{

	protected $table = "unidad_medida";

	public function productos(){
		return $this->hasMany('Producto');
	}
}