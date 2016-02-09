<?php 

class Proveedor extends Eloquent{
	protected $table = "proveedor";

	public function direccionProveedores(){
		return $this->hasMany('DireccionProveedor');
	}

	public function telefonoProveedores(){
		return $this->hasMany('TelefonoProveedor');
	}

	public function entradas(){
		return $this->hasMany('Entrada');
	}

	public function contactos(){
		return $this->hasMany('Contacto');
	}

	public function comercializador(){
		return $this->belongsTo('Comercializador');
	}
}