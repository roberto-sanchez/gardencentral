<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cliente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cliente', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('rfc',13);
			$table->integer('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->integer('agente_id')->unsigned();
			$table->integer('nivel_descuento_id')->unsigned();
			$table->foreign('nivel_descuento_id')->references('id')->on('nivel_descuento');
			$table->string('nombre_cliente');
			$table->string('paterno');
			$table->string('materno');
			$table->string('nombre_comercial');
			$table->string('razon_social');
			$table->string('numero_cliente');
			$table->string('correo');
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
		Schema::drop('cliente');
	}

}
