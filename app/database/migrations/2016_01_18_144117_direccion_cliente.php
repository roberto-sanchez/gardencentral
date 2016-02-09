<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DireccionCliente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('direccion_cliente', function(Blueprint $table)
 		{
 			$table->increments('id');
 			$table->integer('cliente_id')->unsigned();
 			$table->foreign('cliente_id')->references('id')->on('cliente');
 			$table->integer('pais_id')->unsigned();
 			$table->foreign('pais_id')->references('id')->on('pais');
 			$table->integer('estado_id')->unsigned();
 			$table->foreign('estado_id')->references('id')->on('estado');
 			$table->integer('municipio_id')->unsigned();
 			$table->foreign('municipio_id')->references('id')->on('municipio');
 			$table->integer('telefono_cliente_id')->unsigned();
 			$table->foreign('telefono_cliente_id')->references('id')->on('telefono_cliente');
 			$table->string('calle1');
 			$table->string('calle2');
 			$table->string('colonia');
 			$table->string('delegacion');
 			$table->string('codigo_postal',10);
 			$table->string('tipo',50);
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
		Schema::drop('direccion_cliente');
	}

}
