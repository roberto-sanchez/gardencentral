<?php 

class Producto extends Eloquent{
	protected $table = "producto";

	public function detalles(){
		return $this->hasMany('EntradaDetalle');
	}

	public function productoPrecios(){
		return $this->hasMany('ProductoPrecio');
	}

	public function inventarios(){
		return $this->hasMany('Inventario');
	}

	public function pedidoDetalles(){
		return $this->hasMany('PedidoDetalle');
	}

	public function familia(){
		return $this->belongsTo('Familia');
	}

	public function importador(){
		return $this->belongsTo('Importador');
	}

	public function almacen(){
		return $this->belongsTo('Almacen');
	}

	public function unidadMedida(){
		return $this->belongsTo('UnidadMedida');
	}
}