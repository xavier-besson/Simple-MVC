<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of response
 *
 * @author esl-xavierb
 */
class Response {

	const JSON = 0;
	const HTML = 1;

	public static function redirect($route) {
		header('Location: ' . $route . '');
	}

	public static function json($content) {
		header('Content-Type: application/json');
		echo json_encode($content);
	}

}
