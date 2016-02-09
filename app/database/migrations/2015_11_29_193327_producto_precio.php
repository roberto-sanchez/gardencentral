<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductoPrecio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto_precio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->double('precio_compra');
			$table->double('precio_venta');
			$table->string('moneda');
			$table->timestamp('vigencia');
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
		Schema::drop('producto_precio');
	}

}
