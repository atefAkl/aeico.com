<?php
$dsn = "mysql://hostname=localhost; dbname=mealsdb";
$user = "root";
$pass = 'AAmophasa2002@gmail.comAA';
$option = array (
    PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try {

    $connect = new PDO($dsn, $user, $pass, $option);
    echo 'connected';
}
catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
