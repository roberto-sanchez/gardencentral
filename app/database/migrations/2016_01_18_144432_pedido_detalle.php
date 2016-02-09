<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PedidoDetalle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido_detalle', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pedido_id')->unsigned();
			$table->foreign('pedido_id')->references('id')->on('pedido');
			$table->integer('producto_id')->unsigned();
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->double('cantidad');
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
		Schema::drop('pedido_detalle');
	}

}
