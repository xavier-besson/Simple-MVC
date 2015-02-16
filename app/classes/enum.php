<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of collection
 *
 * @author esl-xavierb
 */
class Enum {

	public static $data = array();

	public static function get_label($value) {
		if (isset(static::$data[$value])) {
			return static::$data[$value];
		}
		else {
			return null;
		}
	}

}
