<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of router
 *
 * @author esl-xavierb
 */
class Router {

	public static function run() {
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

}
