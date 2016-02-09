<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NivelDescuento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		    
		Schema::create('nivel_descuento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descripcion',100);
			$table->string('descuento',100);
			$table->timestamps('fecha_registro');
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
		Schema::drop('nivel_descuento');
	}

}
