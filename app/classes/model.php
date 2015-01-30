<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model
 *
 * @author esl-xavierb
 */
class Model {

	protected static $table	 = '';
	protected static $id_field	 = 'id';

	public static function forge($args = null) {
		return new static($args);
	}

	public function before() {
		is_null($this->_db) && $this->_db = \Db::forge();
	}

	public function delete() {
//		$this->_db->execute('DELETE FROM ' . $this->table . 'WHERE ' . $this->id_field . ' = "' . $this->{$this->id_field} . '"');
	}

	public static function find($args = null) {
		$db = \Db::forge();
		$result = null;

		if ($args === 'all') {
			$result = self::fetchAll($db->query('SELECT * FROM ' . static::$table));
		}
		else if (is_int($args)) {
			$result = self::fetch($db->query_single('SELECT * FROM ' . static::$table . ' WHERE ' . static::$id_field . ' = "' . $args . '"'));
		}
		
		unset($db);

		return $result;
	}

	protected static function fetch($result) {
		if (is_array($result)) {
			$item		 = self::forge();
			$classname	 = get_class($item);

			foreach ($result as $property => $value) {
				property_exists($classname, $property) && $item->{$property} = $value;
			}

			return $item;
		}
		else {
			return null;
		}
	}

	protected static function fetchAll($results) {
		if (is_array($results)) {
			$items = array();

			foreach ($results as $result) {
				$items[] = self::fetch($result);
			}

			return $items;
		}
		else {
			return null;
		}
	}

}
