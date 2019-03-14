<?php

namespace CASHER\Lib;

class Template
{
	protected $_parts;
	protected $_actionView;
	protected $_data;


	public function __construct (array $parts) 
	{
		$this->_parts = $parts;
	}
	public function _setActionViewFile($actionViewPath)
	{
		$this->_actionView = $actionViewPath;
	}
	public function _setAppData($data)
	{
		$this->_data = $data;
	}
	private function theHeaderStart()
	{
		require_once(TPL_PATH . 'templateheaderstart.php');
	}
		private function theHeaderEnd()
	{
		require_once(TPL_PATH . 'templateheaderend.php');
	}
	private function theFooter()
	{
		require_once(TPL_PATH . 'footer.php');
	}
	private function theFooterEnd () 
	{
		require_once(TPL_PATH . 'templatefooterend.php');
	}
	private function theParts () 
	{
		if (is_array($this->_parts)) {
			if (array_key_exists('template', $this->_parts)) {
				extract($this->_data);
				$parts = $this->_parts['template'];
				foreach ($parts as $key => $path) {
					if ($key == ':view') {
						require_once $this->_actionView;
					} else {
						require_once $path;
					}
				}
			} else {
				trigger_error('Sorry, define the template blocks');
			}
		} else {
			trigger_error('Sorry, define the template parts');
		}
			
	}
	private function theHeaderFiles () 
	{
		if (is_array($this->_parts)) {
			if (array_key_exists('header_resources', $this->_parts) && !empty($this->_parts['header_resources'])) {
				$files = $this->_parts['header_resources'];
				// GENERATE CSS LINKS
				if (!empty($files)) {
					$css = $files['css'];
					foreach ($css as $name => $path) {
						echo '<link type="text/css" rel="stylesheet" href="' . $path . '">';
					}
				}
				// GENERATE JS SCRIPTS
				if (!empty($files)) {
					$js = $files['js'];
					foreach ($js as $name => $path) {
						echo '<script type="text/javascript" src="' . $path . '"></script>';;
					}
				}
			} else {
				trigger_error('Sorry, define the template blocks');
			}
		} else {
			trigger_error('Sorry, define the template parts');
		}	
	}
	private function theFooterFiles () 
	{
		if (is_array($this->_parts)) {
			if (array_key_exists('footer_resources', $this->_parts) && !empty($this->_parts['header_resources'])) {
				$files = $this->_parts['header_resources']['js'];
				foreach ($files as $name => $path) {
					echo '<script type="text/javascript" src="' . $path . '"></script>';
				}
			} else {
				trigger_error('Sorry, define the template blocks');
			}
		} else {
			trigger_error('Sorry, define the template parts');
		}	
	}
	public function renderApp()
	{
		
		$this->theHeaderStart();
		$this->theHeaderFiles ();
		$this->theHeaderEnd();
		$this->theParts();
		$this->theFooter();
		$this->theFooterfiles();
		$this->theFooterEnd();
	}
}