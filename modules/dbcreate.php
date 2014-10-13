<?php
	require_once('db.func.php');

	$filename = isset($argv[1])? $argv[1] : false;
	dbCreate( $filename );

