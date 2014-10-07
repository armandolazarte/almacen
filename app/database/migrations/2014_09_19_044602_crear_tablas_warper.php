<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablasWarper extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('urg', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->string('urg', 30)->unique();
		    $tbl->string('d_urg');
		    $tbl->timestamps();
		});
		
		Schema::create('proveedores', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('proveedor_id')->unique()->unsigned();
		    $tbl->string('d_proveedor');
		    $tbl->string('rfc', 15);
		    $tbl->timestamps();
		});
		
		Schema::create('oc', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('oc')->unique()->unsigned();
		    $tbl->date('fecha_oc');
		    $tbl->integer('req')->unsigned();
		    $tbl->string('db_origen', 10);
		    $tbl->integer('proveedor_id')->unsigned();
		    $tbl->integer('urg_id');
		    $tbl->string('estatus', 20);
		    $tbl->timestamps();
		});
		
		Schema::create('oc_articulos', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('oc_id')->unsigned();
		    $tbl->integer('articulo_id')->unsigned();
		    $tbl->integer('art_id')->unsigned();
		    $tbl->text('esp');
		    $tbl->decimal('cantidad', 15, 3)->unsigned();
		    $tbl->decimal('costo', 15, 3)->unsigned();
		    $tbl->tinyInteger('impuesto')->unsigned;
		    $tbl->string('unidad', 12);
		    $tbl->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('urg');
		Schema::drop('proveedores');
		Schema::drop('oc');
		Schema::drop('oc_articulos');
	}

}
