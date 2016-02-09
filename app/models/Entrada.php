<?php 

class Entrada extends Eloquent{
	protected $table = "entrada";

	public function detalles(){
		return $this->hasMany('EntradaDetalle');
	} 
	
	public function proveedor(){
		return $this->belongsTo('Proveedor');
	}

}