<?php
namespace CASHER\Controllers;

class AbstractController
{
	protected $_controller;
	protected $_action;
	protected $_params;
	protected $_template;
    

    protected $data = [];
	public function notFoundAction ()
	{
		$this->_view();
	}

	public function setController($controller) {
		$this->_controller = $controller;
	}

	public function setAction($action) {
		$this->_action = $action;
	}

	public function setParams($params) {
		$this->_params = $params;
	}
	public function setTemplate($template) {
		$this->_template = $template;
	}
	protected function _view() {
		if ($this->_action == 'notFoundAction') {
			require_once VIEWS_PATH . 'notfound'. DS . 'notfound.view.php';
		} else {
			$view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
			if (file_exists($view)) {
				$this->_template->_setActionViewFile($view);
				$this->_template->_setAppData($this->data);
				$this->_template->renderApp();
				
			} else {
				require_once VIEWS_PATH . 'notfound'. DS . 'noview.view.php';
			}

		}
	}
}