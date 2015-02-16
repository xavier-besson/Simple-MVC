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

	protected static $_table				 = '';
	protected static $_id					 = 'id';
	protected static $_id_auto_incremente	 = true;
	protected static $_properties			 = array();
	private $_data							 = array();

	public static function forge($args = null) {
		return new static($args);
	}

	protected function __construct($args) {
		$properties = null;
		if (is_object($args)) {
			$properties = get_object_vars($args);
		}
		else if (is_array($args)) {
			$properties = $args;
		}

		if (is_array($properties)) {
			foreach ($properties as $key => $value) {
				$this->{$key} = $value;
			}
		}
	}

	public function __get($name) {
		return (isset($this->_data[$name]) ? $this->_data[$name] : null);
	}

	public function __set($name, $value) {
		array_key_exists($name, static::$_properties) && $this->_data[$name] = $value;
	}

	public function to_array() {
		return $this->_data;
	}

	public function delete() {
		$db = \Db::forge();
		$db->execute('DELETE FROM ' . static::$_table . ' WHERE ' . static::$_id . ' = ' . \Db::format_type($this->{static::$_id}, static::$_properties[static::$_id]['type']) . '');
		unset($db);
	}

	public function save() {
		$db	 = \Db::forge();
		$id	 = $this->{static::$_id};

		$query	 = '';
		$row	 = array_keys(static::$_properties);

		# Remove id from $row if auto incremente
		if (static::$_id_auto_incremente === true) {
			if (($key = array_search(static::$_id, $row)) !== false) {
				unset($row[$key]);
			}
		}

		if ($id == 0 || is_null($id)) {
			$query = $this->_get_insert_query($row);
		}
		else {
			$query = $this->_get_update_query($row);
		}
		$db->execute($query);
		unset($db);
	}

	private function _get_insert_query($row) {
		$query = 'INSERT INTO '
		. '' . static::$_table . ' ('
		. join(',', $row)
		. ') VALUES ('
		. join(',', array_map(function($value) {
			return '' . \Db::format_type($this->{$value}, static::$_properties[$value]['type']) . '';
		}, $row))
		. ')';

		return $query;
	}

	private function _get_update_query($row) {
		# Construct query
		$query = 'UPDATE '
		. '' . static::$_table . ' '
		. 'SET '
		. join(',', array_map(function($value) {
			return $value . ' = ' . \Db::format_type($this->{$value}, static::$_properties[$value]['type']) . '';
		}, $row))
		. ' WHERE ' . static::$_id . ' = ' . $this->{static::$_id} . '';
		return $query;
	}

	public static function find($args = null, $addon = null) {
		$db		 = \Db::forge();
		$result	 = null;
		$query = '';

		if ($args === 'all') {
			$query = 'SELECT * FROM ' . static::$_table;
			(!is_null($addon)) && $query .= ' ' . $addon;
			
			$result = static::fetchAll($db->query($query));
		}
		else if (is_int($args)) {
			$result = static::fetch($db->query_single('SELECT * FROM ' . static::$_table . ' WHERE ' . static::$_id . ' = ' . \Db::format_type($args, static::$_properties[static::$_id]['type']) . ''));
		}

		unset($db);

		return $result;
	}

	protected static function fetch($result) {
		if (is_array($result)) {
			$item = static::forge();

			foreach ($result as $property => $value) {
				$item->{$property} = $value;
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
				$items[] = static::fetch($result);
			}

			return $items;
		}
		else {
			return null;
		}
	}

}
