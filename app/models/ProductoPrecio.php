<?php

class Precio extends Eloquent{
  protected $table = "producto_precio";

  public function producto(){
    return $this->belongsTo('Producto');
  }

}
