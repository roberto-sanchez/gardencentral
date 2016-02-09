<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->double('cantidad');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::drop('inventario');
	}

}
