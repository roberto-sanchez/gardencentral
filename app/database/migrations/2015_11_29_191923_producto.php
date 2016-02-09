<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Producto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('clave',45);
			$table->string('numero_articulo',100);
			$table->string('nombre');
			$table->string('ean_code',100);
			$table->string('color');
			$table->integer('numero_color');
			$table->integer('unidad_medida_id')->unsigned();
			$table->foreign('unidad_medida_id')->references('id')->on('unidad_medida');
			$table->integer('piezas_paquete');
			$table->string('dimensiones',100);
			$table->integer('piezas_pallet');
			$table->integer('total_piezas');
			$table->string('foto');
			$table->integer('importador_id')->unsigned();
			$table->foreign('importador_id')->references('id')->on('importador');
			$table->integer('almacen_id')->unsigned();
			$table->foreign('almacen_id')->references('id')->on('almacen');
			$table->integer('familia_id')->unsigned();
			$table->foreign('familia_id')->references('id')->on('familia');
			$table->boolean('estatus_web');
			$table->boolean('estatus');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('producto');
	}

}
