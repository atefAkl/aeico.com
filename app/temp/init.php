<?php 
//APP PATHs
define("APP_ROOT", realpath(dirname(__FILE__)));
define("DS", DIRECTORY_SEPARATOR);
define("ADMIN_PATH", APP_ROOT . DS . 'admin');
define("INC_PATH", ADMIN_PATH . DS . 'includes');
define("LIB_PATH", INC_PATH . DS . 'lib');


// Connect Setting
$dsn = "mysql://hostname=localhost; dbname=mealsdb";
$user = "root";
$pass = 'AAmophasa2002@gmail.comAA';
$option = array (
    PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
try {

    $connect = new PDO($dsn, $user, $pass, $option);
    //echo 'connected';
}
catch (PDOException $e) {
    echo "Failed" . $e->getMessage();
}
$s = 10;

// APP ROUTs
