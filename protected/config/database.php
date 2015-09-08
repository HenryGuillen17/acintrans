<?php

// This is the database connection configuration.
return array(
	/*'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',*/
	// uncomment the following lines to use a MySQL database
	'connectionString' => 'mysql:host=localhost;dbname=acintran_perla_v1',
	'emulatePrepare' => true,
	'username' => 'root',
	'password' => '',
	'charset' => 'utf8',
	// Activar en caso de debug
	/*
	'enableProfiling' => true,
	'enableParamLogging' => true,
	*/
);