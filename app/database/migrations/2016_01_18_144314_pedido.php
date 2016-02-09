<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pedido extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cliente_id')->unsigned();
			$table->foreign('cliente_id')->references('id')->on('cliente');
			$table->integer('mensajeria_id')->unsigned();
			$table->foreign('mensajeria_id')->references('id')->on('mensajeria');
			$table->integer('direccion_cliente_id')->unsigned();
			$table->foreign('direccion_cliente_id')->references('id')->on('direccion_cliente');
			$table->integer('forma_pago_id')->unsigned();
			$table->foreign('forma_pago_id')->references('id')->on('forma_pago');
			$table->string('num_pedido');
			$table->timestamps();
			$table->timestamp('fecha_entrega');
			$table->text('observaciones');
			$table->boolean('estatus',4);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pedido');
	}

}
