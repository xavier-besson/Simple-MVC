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
class Db {

	const CONF = 'db';

	private $_connector	 = null;
	private $_dbfile	 = null;

	public static function forge() {
		return new static();
	}

	protected function __construct() {
		$config			 = new \Helper\Config(self::CONF);
		$this->_dbfile	 = DATA_PATH . $config->get('name');
	}

	public function execute($query_string) {
		is_null($this->_connector) && $this->open_connection();
		if (!is_null($this->_connector)) {
			$this->_connector->exec($query_string);
			$this->close_connection();
		}
	}

	public function query($query_string, $type = null) {
		$return = null;
		is_null($this->_connector) && $this->open_connection();
		if (!is_null($this->_connector)) {
			$result = $this->_connector->query($query_string);
			if ($result !== false) {
				$array	 = array();
				while ($row	 = $result->fetchArray(SQLITE3_ASSOC)) {
					$array[] = $row;
				}
				$return = $array;
			}
			$this->close_connection();
		}
		return $return;
	}
	
	public function query_single($query_string, $type = null) {
		$return = null;
		is_null($this->_connector) && $this->open_connection();
		if (!is_null($this->_connector)) {
			$result = $this->_connector->querySingle($query_string, true);
			if (is_array($result)) {
				count($result) > 0 && $return = $result;
			}
			$this->close_connection();
		}
		return $return;
	}

	private function open_connection() {
		$this->_connector = new SQLite3($this->_dbfile);
	}

	private function close_connection() {
		$this->_connector->close();
		$this->_connector = null;
	}

	public static function escapeStr($str) {
		return SQLite3::escapeString($str);
	}

	public function exist() {
		return file_exists($this->_dbfile);
	}

}
