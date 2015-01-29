<?php

header('Content-Type: application/json');
require '../../bootstrap.php';

$route	 = explode('_', $_GET['action']);
$return	 = route_manager(ucfirst($route[0]), $route[1]);

echo json_encode($return);

function route_manager($controller, $action) {
	$controller_namespace = '\\Controller\\' . $controller;
	if (class_exists($controller_namespace)) {
		$controller	 = new $controller_namespace();
		$method		 = 'get_' . $action;
		if (method_exists($controller, $method)) {
			return $controller->{$method}();
		}
		else {
			return array(
				'success'	 => false,
				'message'	 => 'Method "' . $method . '" does\'nt exist in controller "' . $controller . '"'
			);
		}
	}
	else {
		return array(
			'success'	 => false,
			'message'	 => 'Controller "' . $controller . '" does\'nt exist'
		);
	}
}