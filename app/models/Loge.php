<?php 

class Loge extends Eloquent{
	protected $table = "log";


	public function usuario(){
		return $this->belongsTo('Usuario');
	}

	public function pedido(){
		return $this->belongsTo('Pedido');
	}



}