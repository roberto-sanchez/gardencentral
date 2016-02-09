<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioDetalle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario_detalle', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->string('nombre');
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
		Schema::drop('usuario_detalle');
	}

}
