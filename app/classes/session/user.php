<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author esl-xavierb
 */

namespace Session;

class User extends \Session {

	protected static $key = 'user';
	
	public static function isLogged() {
		return self::exist();
	}

	public static function isAdmin() {
		return self::get('role') == 1;
	}

	public static function isOwner($id) {
		return self::isAdmin() || self::isCurrent($id);
	}
	
	public static function isCurrent($id){
		return $id == self::get('id');
	}
}
