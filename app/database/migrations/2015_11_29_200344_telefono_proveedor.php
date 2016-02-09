<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TelefonoProveedor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('telefono_proveedor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('proveedor_id')->unsigned();
			$table->foreign('proveedor_id')->references('id')->on('proveedor');
			$table->string('numero',20);
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
		Schema::drop('telefono_proveedor');
	}

}
