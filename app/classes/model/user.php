<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Article
 *
 * @author esl-xavierb
 */

namespace Model;

class User extends \Model {

	protected static $table = 'user';
	public $id;
	public $username;
	public $password;
	public $role;

	public static function forge($args = null) {
		return new static($args);
	}

	protected function __construct($args) {
		if (is_array($args)) {
			$this->id		 = $args['id'];
			$this->username	 = $args['username'];
			$this->password	 = $args['password'];
			$this->role		 = $args['role'];
		}
		else if (is_object($args)) {
			$this->id		 = $args->id;
			$this->username	 = $args->username;
			$this->password	 = $args->password;
			$this->role		 = $args->role;
		}
	}

	public function exist($username, $password) {
		$query = 'SELECT * '
		. 'FROM ' . $this->table . ' '
		. 'WHERE username="' . \Db::escapeStr($username) . '" '
		. 'AND password="' . \Db::escapeStr($password) . '" ';

		return self::fetch(\Db::forge()->query_single($query));
	}

}
