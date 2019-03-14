<?php
!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null;
define('APP_PATH', realpath(dirname(__FILE__)) . DS . '..'  );
define('VIEWS_PATH', APP_PATH . DS . 'views' . DS);
define('TPL_PATH', APP_PATH . DS . 'templates' . DS);
define('CSS', '/assets/css/');
define('JS', '/assets/js/');

defined('DATABASE_HOST_NAME')   ? null : define('DATABASE_HOST_NAME', 'www.casher.com');
defined('DATABASE_USER_NAME')   ? null : define('DATABASE_USER_NAME', 'root');
defined('DATABASE_PASSWORD')    ? null : define('DATABASE_PASSWORD', 'AAmophasa2002@gmail.comAA');
defined('DATABASE_DB_NAME')     ? null : define('DATABASE_DB_NAME', 'casher');
defined('DATABASE_PORT_NUMBER') ? null : define('DATABASE_PORT_NUMBER', '3306');
defined('DATABASE_CONN_DRIVER') ? null : define('DATABASE_CONN_DRIVER', 1);