<?php

require_once('db.conf.php');

/**
* @return  Db connection or false
**/
function dbConnect()
{
	return mysql_connect(db_host,db_user,db_pass); 
}//end func


/**
* Close Db connection
* @return  true or false
**/
function dbClose($conn)
{
	if ($conn) return mysql_close($conn);
}//end func


/**
* Create database from dump sql-file
* @param  string filename of database dump
**/
function dbCreate($name,$mode=false)
{
	if(!$name) exit('Usage: php dbcreate.php dump.sql');
	if (!file_exists($name))exit( 'file "' . $name . '" not exists!');
	$f = fopen( $name, "r" );
	if ( !$f )exit("Can not open file $name"); 
	
	$dump = '';
	
	while( !feof($f) )
	{
		$line = fgets($f, 4096 );
		if ( $line{0} == '-' && $line{1} == '-' ) continue;
		if ( ($line == '' ) ) continue;
		$dump .= $line;
	}
	//echo $dump;
	
	$commands = explode(";\n",$dump);
	$conn = dbConnect();
	if (!$conn) exit('Error open db'); 
	
	$dbDrop = mysql_query( 'DROP DATABASE IF EXISTS ' . db_name );
	if ( !$dbDrop ) exit( 'can not drop db' );
	$dbCreate = mysql_query( 'CREATE DATABASE ' . db_name );
	if ( !$dbCreate ) exit( 'can not create db' );
	$dbSelect = mysql_query( 'USE ' . db_name );
	if ( !$dbSelect ) exit('can not use db');
	foreach($commands as $command )
	{
		$command = trim( $command );
		if ( $command != '' ) 
			if ( !dbQuery( $command, $conn )) echo mysql_error($conn);
	}
	dbClose($conn);
	if ( $mode ) 
	{
		header('Location: lab1.php');
		return true;
	}
	
	echo 'Done';
	exit();
}//end func

/**
* Execute SQL query
* @param $sql string SQL query
* @param $conn Db connection
* @return  object result or true or false
**/
function dbQuery( $sql, $conn = false )
{
	if ( !$conn ) $conn = dbConnect();
	if( !$conn ) return false;
	else mysql_query( 'USE '.db_name );
	//echo $sql;
    $res = mysql_query( $sql, $conn ) or die(mysql_error());
	return $res;
}//end func


/**
* Get tables in Db as array
* @return  array of tables name or empty array
**/
function dbGetTablesList()
{
	$res = dbQuery( 'SHOW TABLES' );
	$tables = array();
	if (!$res) return $tables;
	
	while( $row = mysql_fetch_assoc($res))
	{
		$tables[] = $row['Tables_in_'.db_name];
	}
	return $tables;
}//end func


/**
* Get data from tables
* @param array $tables 
* @return  array
**/
function dbGetTables($tables)
{
	$data = array();
	if (is_array($tables) && count($tables))
	{
		foreach( $tables as $table )
		{
			$firstRow = true;
			$data[$table]['name'] = $table;
			$res = dbQuery('SELECT * FROM '.$table);
			if ( $res )
			{
				while( $row = mysql_fetch_assoc($res) )
				{
					if ( $firstRow )
					{
						$data[$table]['header'] = array_keys($row);
						$firstRow = false;
					}
					$data[$table]['data'][] = $row;
				}
			}
		}
		return $data;
	}
	return false;
}//end func


/**
* Get result of query
* @param $sql string SQL query 
* @return  array or true or false
**/
function dbGetQueryResult($sql)
{
	$res = dbQuery($sql);
	$data = array();
	if ( $res === false || $res === true ) return $res;
	$count = 0;
	while( $row = mysql_fetch_assoc( $res ) )
	{
		foreach ( $row as $col_name => $col_val )
		{
			$data[$count][$col_name] = $col_val;
		}
		$count++;
	}
	return $data;
}//end func

/**
* Get list sql dump files
* @param $dir string directory 
* @return  array of filenames
**/
function getDumpfilesList($dir='.')
{
	$files = @scandir($dir);
	$list = array();
	if ( $files === false ) return $list;
	
	foreach( $files as $file )
	{
		if ( is_file( $file ) && $file != '.' && $file != '..' )
			if ( substr( $file, strrpos( $file, '.') ) == '.sql' )
				$list[] = $file;
	}
	return $list;
}