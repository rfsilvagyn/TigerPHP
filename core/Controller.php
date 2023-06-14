<?php
class Controller {

	protected $db;
	protected $dbradius;

	public function __construct() {
		global $config;
	}

	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

//	public function loadLibrary($lib){
//		if (file_exists('lib/'.$lib.'.php')) {
//			include 'lib/'.$lib.'.php';
//		}
//	}

}
