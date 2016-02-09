<?php 

class UsuarioDetalle extends Eloquent{
	protected $table = "usuario_detalle";

	public function usuario(){
		return $this->belongsTo('Usuario');
	}
}