<?php

require_once("..\LogIn\LogInModel.php");
require_once("..\LogIn\LogInView.php");

class LogInController {
	private $view;
	private $model;

	public function __construct() {
		$this->model = new LogInModel();
		$this->view = new LogInView($this->model);
	}

	public function doControll(){

		return $this->view->showLogIn();
	}
}