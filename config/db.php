<?php

require_once "config.php";

//соединяем с БД
$db = mysqli_connect(
		$config['db']['server'],
		$config['db']['username'],
		$config['db']['password'],
		$config['db']['name']
);

if($db==false){
	echo 'Не удалось подключиться к базе данных! <br>';
	echo mysqli_connect_error();
	exit();
}