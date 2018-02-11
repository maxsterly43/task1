<?php
$connection = mysqli_connect(
	'host2.ru',
	'root',
	'jollyroger007',
	'test_db');
/**
 * проверка подключения к базе данных
 */
if (!$connection) { 
	echo "Код ошибки: ".mysqli_connect_error(); 
	exit; 
}
?>