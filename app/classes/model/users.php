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

class Users extends \Model\Collection {

	protected $config_filename = 'users';

	public function exists($user) {
		$return = null;
		foreach ($this->items as $item) {
			if ($item->username == $user->username && $item->password == $user->password) {
				return $return = $item;
			}
		}
		return $return;
	}

}
