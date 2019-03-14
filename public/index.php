<?php
namespace CASHER;
use CASHER\Lib\FrontController;
use CASHER\Lib\Template;

!defined('DS') ? define('DS', DIRECTORY_SEPARATOR) : null; 
require_once '..' . DS . 'app' . DS . 'config' . DS .  'config.php';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';
$templateParts = require_once '..' . DS . 'app' . DS . 'config' . DS .  'template.php';
$template = new Template($templateParts);

$frontController = new FrontController($template);
$frontController->dispach();
?>
