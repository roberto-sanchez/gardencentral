<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estado extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estado', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pais_id')->unsigned();
			$table->foreign('pais_id')->references('id')->on('pais');
			$table->string('estados');
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
		Schema::drop('estado');
	}

}
