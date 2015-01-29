<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author esl-xavierb
 */
class Session {

	public static function get($key_path, $default = null) {
		$keys = explode('.', $key_path);
		$value = $default;
		$session = $_SESSION;
		foreach ($keys as $key) {
			if(isset($session[$key])){
				$session = $session[$key];
			}
			else{
				return $session = false;
			}
		}
		return $value;
//		if($_SESSION) {
//			
//		}
//		else {
//			return $default;
//		}
	}

}
