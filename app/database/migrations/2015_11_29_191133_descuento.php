<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Descuento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descuento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',100);
			$table->string('descuento',45);
			$table->timestamps();
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
		Schema::drop('descuento');
	}

}
