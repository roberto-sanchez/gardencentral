<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entrada extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entrada', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('proveedor_id')->unsigned();
			$table->foreign('proveedor_id')->references('id')->on('proveedor');
			$table->timestamp('fecha_registro');
			$table->timestamp('fecha_entrada');
			$table->string('factura');
			$table->timestamp('fecha_factura');
			$table->text('observaciones');
			$table->boolean('estatus');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entrada');
	}

}
