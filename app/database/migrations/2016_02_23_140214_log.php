<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Log extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned();
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->integer('pedido_id')->unsigned();
			$table->foreign('pedido_id')->references('id')->on('pedido');
			$table->timestamps();
			$table->boolean('estatus_inicial',1);
			$table->boolean('estatus_final',1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('logs');
	}

}
