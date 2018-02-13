<?php
$mysqli = new mysqli(
	'host2.ru',
	'root',
	'jollyroger007',
	'test_db');
/**
 * проверка подключения к базе данных
 */
if ($mysqli->connect_errno) { 
	echo "Connection error code: ".$mysqli->connect_errno; 
	exit; 
}
$mysqli->set_charset("utf8");
?>