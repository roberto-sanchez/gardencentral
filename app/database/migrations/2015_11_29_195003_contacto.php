<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contacto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('proveedor_id')->unsigned();
			$table->foreign('proveedor_id')->references('id')->on('proveedor');
			$table->string('nombre');
			$table->string('correo');
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
		Schema::drop('contacto');
	}

}
