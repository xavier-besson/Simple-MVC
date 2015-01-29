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

namespace Helper;

class User {

	public static function isLogged() {
		return isset($_SESSION['user']);
	}

	public static function isAdmin() {
		return self::get('group') == 1;
	}

	public static function isOwner($id) {
		return self::isAdmin() || self::isCurrent($id);
	}
	
	public static function isCurrent($id){
		return $id == self::get('id');
	}

	public static function get($key = null) {
		return ($key === null ? $_SESSION['user'] : $_SESSION['user'][$key]);
	}

	public static function set($user) {
		$_SESSION['user']				 = array();
		$_SESSION['user']['id']			 = $user->id;
		$_SESSION['user']['username']	 = $user->username;
		$_SESSION['user']['group']		 = $user->group;
	}

}
