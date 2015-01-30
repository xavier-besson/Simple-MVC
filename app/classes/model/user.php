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

	protected static $_table = 'user';
	
	protected $_properties = array(
		'id',
		'username',
		'password',
		'role'
	);
	
	public function exist($username, $password) {
		$query = 'SELECT * '
		. 'FROM ' . self::$_table . ' '
		. 'WHERE username="' . \Db::escapeStr($username) . '" '
		. 'AND password="' . \Db::escapeStr($password) . '" ';
		
		return self::fetch(\Db::forge()->query_single($query));
	}

}
