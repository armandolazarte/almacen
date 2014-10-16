<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		'almacen' => array(
			'driver'    => 'mysql',
			'host'      => 'samuelmg-almacen-1026762',
			'database'  => 'almacen',
			'username'  => 'almausr',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		'sgf14' => array(
			'driver'    => 'mysql',
			'host'      => 'samuelmg-almacen-1026762',
			'database'  => 'sgf14',
			'username'  => 'gama',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),
		
		'sgf_benef' => array(
			'driver'    => 'mysql',
			'host'      => 'samuelmg-almacen-1026762',
			'database'  => 'sgf_benef',
			'username'  => 'gama',
			'password'  => '',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),

);
