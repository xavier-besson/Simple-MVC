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

	protected static $key = '';

	public static function get($subkey = null) {
		return ($subkey === null ? $_SESSION[self::$key] : $_SESSION[self::$key][$subkey]);
	}

	public static function set($item) {
		$_SESSION[self::$key] = $item;
	}

	public static function destroy() {
		unset($_SESSION[self::$key]);
	}

	public static function exist() {
		return isset($_SESSION[self::$key]);
	}

}
