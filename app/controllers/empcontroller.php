<?php

namespace CASHER\Controllers;

use CASHER\Models\EmpModel;
use CASHER\Lib\FilterInput ;
use CASHER\Lib\Helper ;
class EmpController extends AbstractController
{
	use FilterInput ;
	use Helper;
	
	public function defaultAction()
	{
		
		$this->data['emps'] = EmpModel::getAll();		

		$this->_view();
	}
	public function addAction()
	{	
		if (isset($_POST['save'])) {
			$emp = new EmpModel();
			$emp->name = $this->filterString($_POST['name']);
			$emp->age = $this->filterInt($_POST['age']);
			$emp->address = $this->filterString($_POST['address']);
			$emp->salary = $this->filterFloat($_POST['salary']);
			$emp->tax = $this->filterFloat($_POST['tax']);
			if ($emp->save()) {
				$this->redirect('/emp/');
			}
		}	
		$this->_view();
	}

		public function editAction()
	{	
		$id = $this->filterInt($this->_params[0]);
		$emp = $this->data['emp'] = EmpModel::getByPK($id);
		if ($emp === null) {
			$this->redirect('/emp/');
		}
		if (isset($_POST['save'])) {
			$emp = new EmpModel();
			$emp->id = $id;
			$emp->name = $this->filterString($_POST['name']);
			$emp->age = $this->filterInt($_POST['age']);
			$emp->address = $this->filterString($_POST['address']);
			$emp->salary = $this->filterFloat($_POST['salary']);
			$emp->tax = $this->filterFloat($_POST['tax']);
			if ($emp->save()) {
				$this->redirect('/emp/');
			}
		}	
		$this->_view();
	}

			public function deleteAction()
	{	
		$id = $this->filterInt($this->_params[0]);
		$emp = EmpModel::getByPK($id);
		if ($emp === null) {
			$this->redirect('/emp/');
		}
		if ($emp->delete()) {
			$this->redirect('/emp/');
		}

		$this->_view();
	}
}