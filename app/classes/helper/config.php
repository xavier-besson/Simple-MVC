<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of static_map_style
 *
 * @author esl-xavierb
 */

namespace Helper;

class Config {

	const FOLDER_NAME	 = 'config';
	const FILE_FORMAT	 = 'json';

	protected $name;
	protected $values;

	public function __construct($name = '') {
		$this->name = $name;
		$this->_load();
	}

	private function _load() {
		$this->values = \Helper\File\Json::get_from_file(APP_PATH . self::FOLDER_NAME . '/' . $this->name . '.' . self::FILE_FORMAT);
	}
	
	public function get($path_key){
		$keys = explode('.', $path_key);
		$value = $this->values;
		foreach ($keys as $key) {
			$value = $value->{$key};
		}
		return $value;
	}
}
