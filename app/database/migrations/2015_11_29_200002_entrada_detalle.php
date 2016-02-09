<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EntradaDetalle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entrada_detalle', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->integer('entrada_id')->unsigned();
			$table->foreign('entrada_id')->references('id')->on('entrada');
			$table->double('cantidad');
			$table->string('precio_compra');
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
		Schema::drop('entrada_detalle');
	}

}
