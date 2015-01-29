<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of folder
 *
 * @author esl-xavierb
 */

namespace Helper;

class Folder {

	/**
	 * Create a new folder
	 * @param string $path The folder path
	 * @throws Exception If an error occured during the creation
	 */
	public static function create($path) {
		if (!file_exists($path)) {
			try {
				mkdir($path, 0777, true);
			}
			catch (Exception $ex) {
				throw $ex;
			}
		}
	}

	/**
	 * Erase the folder content
	 * @param string $path The folder path
	 * @throws Exception If an error occured
	 */
	public static function clean($path) {
		try {
			$files = glob($path . '*');
			foreach ($files as $file) {
				if (is_file($file)) {
					unlink($file);
				}
			}
		}
		catch (Exception $ex) {
			throw $ex;
		}
	}
}
