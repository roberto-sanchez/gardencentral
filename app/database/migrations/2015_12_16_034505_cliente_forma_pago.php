<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClienteFormaPago extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
public function up()
	{
		Schema::create('cliente_forma_pago', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cliente_id')->unsigned();
			$table->foreign('cliente_id')->references('id')->on('cliente');
			$table->integer('forma_pago_id')->unsigned();
			$table->foreign('forma_pago_id')->references('id')->on('forma_pago');
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
		Schema::create('cliente_forma_pago');
	}

}
