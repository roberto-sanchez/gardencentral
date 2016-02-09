<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Proveedor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comercializador_id')->unsigned();
			$table->foreign('comercializador_id')->references('id')->on('comercializador');
			$table->string('nombre');
			$table->string('nombre_comercial');
			$table->string('razon_social');
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
		Schema::create('proveedor');
	}

}
