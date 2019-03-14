<?php
namespace CASHER\Lib;

/**
 *  
 */
class AutoLoad
{
	
	public static function autoload($className)
	{
		$className = str_replace('\\', '/', APP_PATH . strtolower(str_replace('CASHER', '', $className . '.php')));
		if(file_exists($className)) {
			require_once($className);
		} 
	}
}

spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');