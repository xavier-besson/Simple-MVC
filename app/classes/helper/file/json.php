<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Json
 *
 * @author esl-xavierb
 */

namespace Helper\File;

class Json {

	/**
	 * Return an object of the JSON file passed as parameter
	 * @param string $path the full path of the file
	 * @return Object An std_Object if no error occured, otherwise null
	 */
	public static function get_from_file($path) {
		try {
			$object = json_decode(file_get_contents($path));
			return $object;
		}
		catch (Exception $ex) {
			return null;
		}
	}

	public static function save_to_file($path, $content) {
		$handle = fopen($path, 'w');
		fwrite($handle, json_encode($content));
		fclose($handle);
	}

}
