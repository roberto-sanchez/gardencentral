<?php 

class Descuentos extends Eloquent{
	protected $table = "descuento";

	public function familia(){
		return $this->belongsTo('Familia');
	}
}