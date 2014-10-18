<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablasAlmacen extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articulos', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->text('articulo');
		    $tbl->string('unidad', 20);
		    $tbl->integer('rubro_id')->unsigned();
		    $tbl->timestamps();
		});
		
		Schema::create('entradas', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->date('fecha_entrada');
		    $tbl->integer('ref')->unsigned();
		    $tbl->string('ref_tipo', 10);
		    $tbl->date('ref_fecha');
		    $tbl->integer('urg_id')->unsigned();
		    $tbl->integer('proveedor_id')->unsigned();
		    $tbl->text('cmt');
		    $tbl->integer('usr_id')->unsigned();
		    $tbl->timestamps();
		});
		
		Schema::create('entradas_articulos', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('entrada_id')->unsigned();
		    $tbl->integer('articulo_id')->unsigned();
		    $tbl->decimal('cantidad', 15, 3)->unsigned();
		    $tbl->decimal('costo', 15, 3)->unsigned();
		    $tbl->tinyInteger('impuesto')->unsigned;
		    $tbl->timestamps();
		});
		
		Schema::create('salidas', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('entrada_id')->unsigned();
		    $tbl->date('fecha_salida');
		    $tbl->integer('urg_id')->unsigned();
		    $tbl->text('cmt');
		    $tbl->integer('usr_id')->unsigned();
		    $tbl->timestamps();
		});
		
		Schema::create('salidas_articulos', function($tbl)
		{
		    $tbl->increments('id');
		    $tbl->integer('salida_id')->unsigned();
		    $tbl->integer('articulo_id')->unsigned();
		    $tbl->decimal('cantidad', 15, 3)->unsigned();
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
		Schema::drop('articulos');
		Schema::drop('entradas');
		Schema::drop('entradas_articulos');
		Schema::drop('salidas');
		Schema::drop('salidas_articulos');
	}

}
