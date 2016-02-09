<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Familia extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('familia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('descuento_id')->unsigned();
			$table->foreign('descuento_id')->references('id')->on('descuento');
			$table->string('descripcion',200);
			$table->string('factor_descuento',100);
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
		Schema::drop('familia');
	}

}
