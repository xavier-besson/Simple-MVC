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

class User {

	public $id;
	public $username;
	public $password;
	public $group;

	public static function forge($args = null) {
		return new static($args);
	}

	protected function __construct($args) {
		if (is_array($args)) {
			$this->id		 = $args['id'];
			$this->username	 = $args['username'];
			$this->password	 = $args['password'];
			$this->group	 = $args['group'];
		}
		else if(is_object($args)){
			$this->id		 = $args->id;
			$this->username	 = $args->username;
			$this->password	 = $args->password;
			$this->group	 = $args->group;
		}
	}

}
