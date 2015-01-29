<?php

session_start();

// Error displaying
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

// Application constant
define('APP_PATH', __DIR__ . '/app/');
define('VIEW_PATH', APP_PATH . 'view/');
define('CLASS_PATH', APP_PATH . 'classes/');
define('DATA_PATH', APP_PATH . 'data/');

route_manager();

// Autoload
function __autoload($class) {
	$parts		 = explode('\\', strtolower($class));
	$filename	 = CLASS_PATH . join(DIRECTORY_SEPARATOR, $parts) . '.php';
	if (file_exists($filename)) {
		require_once $filename;
	}
}

// Route manager
function route_manager() {
	$route = explode('/', isset($_GET['route']) ? $_GET['route'] : '');

	if (count($route) == 1) {
		if ($route[0] == '') {
			$route[0] = 'app';
		}
		$route[] = 'index';
	}

	$controller = new \Controller\Template();

	$controller_namespace = '\\Controller\\' . ucfirst($route[0]);
	if (class_exists($controller_namespace)) {
		$controller	 = new $controller_namespace();
		$method		 = strtolower($_SERVER['REQUEST_METHOD']) . '_' . $route[1];
		if (method_exists($controller, $method)) {
			method_exists($controller, 'before') && $controller->before();
			$controller->{$method}();
			method_exists($controller, 'after') && $controller->after();
		}
	}
}
