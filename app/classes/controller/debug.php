<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author esl-xavierb
 */

namespace Controller;

class Debug extends \Controller\Base {

	public function get_awrt369() {
		$users = \Model\User::find('all');
		var_dump($users);
	}

}
