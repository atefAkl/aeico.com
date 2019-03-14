<?php
namespace CASHER\Lib;

trait FilterInput 
{
	public function filterInt ($input) {
		return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
	}

	public function filterFloat ($input) {
		return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
	}

	public function filterString ($input) {
		return htmlentities($input, ENT_NOQUOTES, 'UTF-8');
	}
}