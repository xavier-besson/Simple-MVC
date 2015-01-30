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
		return self::get('group') == 1;
	}

	public static function isOwner($id) {
		return self::isAdmin() || self::isCurrent($id);
	}
	
	public static function isCurrent($id){
		return $id == self::get('id');
	}

//	public static function set($user) {
//		$_SESSION['user']				 = array();
//		$_SESSION['user']['id']			 = $user->id;
//		$_SESSION['user']['username']	 = $user->username;
//		$_SESSION['user']['group']		 = $user->group;
//	}
//	
//	public static function destroy(){
//		unset($_SESSION['user']);
//	}

}
