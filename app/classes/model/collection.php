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

namespace Model;

class Collection {

	public $items;
	protected $config_filename	 = '';
	private $_data_filename		 = '';

	protected function __construct() {
		$config = new \Helper\Config($this->config_filename);

		$this->_data_filename = APP_PATH . $config->get('data_filename');
		$this->load_data();
	}

	public static function forge() {
		return new static();
	}

	public function add($item) {
		array_push($this->items, \Helper\Object::get_stdclass_from_object($item));
		$this->save();
		return $this;
	}

	public function update($namespace, $item_to_update) {
		foreach ($this->items as $item) {
			if ($item->id == $item_to_update->id) {
				$item = $namespace::forge($item_to_update);
			}
		}
		$this->save();
	}

	public function delete($id) {
		$new = array();

		foreach ($this->items as $item) {
			if ($item->id != $id) {
				$new[] = $item;
			}
		}
		$this->items = $new;
		$this->save();
		return $this;
	}

	public function save() {
		\Helper\File\Json::save_to_file($this->_data_filename, $this->items);
		return $this;
	}

	public function get_all() {
		return $this->items;
	}

	public function get_by_key($key, $value) {
		$return = null;
		foreach ($this->items as $item) {
			if ($item->{$key} == $value) {
				return $return = $item;
			}
		}
		return $return;
	}

	public function get_max_value($key) {
		$max = 0;
		foreach ($this->items as $item) {
			if ($item->{$key} > $max) {
				$max = $item->{$key};
			}
		}
		return $max;
	}

	protected function load_data() {
		// Create file if not exist
		if (!file_exists($this->_data_filename)) {
			$handle = fopen($this->_data_filename, "w");
			fwrite($handle, '[]');
			fclose($handle);
			while (!file_exists($this->_data_filename)) {
				sleep(1);
			}
		}

		// Get object form data
		$this->items = \Helper\File\Json::get_from_file($this->_data_filename);
		if (is_null($this->items)) {
			$this->items = array();
		}
	}

}
