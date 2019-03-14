<?php

namespace CASHER\Lib;

class FrontController
 {
 	const NFC = 'CASHER\Controllers\NotFoundController';
 	const NFA = 'notFoundAction';
 	
 	protected $_controller = 'index';
 	protected $_action = 'default';
 	protected $_params = array();

 	private $_template;

 	public function __construct(Template $template) {
 		$this->_template = $template;
 		$this->_parseURL();
 	}

 	private function _parseURL() {
		$url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
		if (isset($url[0]) && $url[0] != '') {
			$this->_controller 	= $url[0];
		}
		if (isset($url[1]) && $url[1] != '') {
			$this->_action 		= $url[1];
		}
		if (isset($url[2]) && $url[2] != '') {
			$this->_params 		= explode('/', $url[2]);
		}
		
 	}
 	public function dispach () {
 		$controllerClassName = 'CASHER\Controllers\\' . ucfirst($this->_controller) . 'Controller';
 		$actionName = $this->_action . 'Action';
        if (!class_exists($controllerClassName)) {
        	$controllerClassName = self::NFC;
        }
        $controller = new $controllerClassName();
        if (!method_exists($controller, $actionName)) {
        	$this->_action = $actionName = self::NFA;
        }
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->$actionName();
 	}
 }
