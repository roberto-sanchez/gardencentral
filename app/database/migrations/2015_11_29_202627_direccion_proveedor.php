
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DireccionProveedor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
 	{
 		Schema::create('direccion_proveedor', function(Blueprint $table)
 		{
 			$table->increments('id');
 			$table->integer('proveedor_id')->unsigned();
 			$table->foreign('proveedor_id')->references('id')->on('proveedor');
 			$table->integer('pais_id')->unsigned();
 			$table->foreign('pais_id')->references('id')->on('pais');
 			$table->integer('estado_id')->unsigned();
 			$table->foreign('estado_id')->references('id')->on('estado');
 			$table->integer('municipio_id')->unsigned();
 			$table->foreign('municipio_id')->references('id')->on('municipio');
 			$table->string('calle1');
 			$table->string('calle2');
 			$table->string('colonia');
 			$table->string('delegacion');
 			$table->string('codigo_postal',10);
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
 		Schema::drop('direccion_proveedor');
 	}


}
