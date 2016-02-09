<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Municipio extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('municipio', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('estado_id')->unsigned();
			$table->foreign('estado_id')->references('id')->on('estado');
			$table->string('municipio');
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
		Schema::drop('municipio');
	}

}
