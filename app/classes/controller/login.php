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

class Login extends \Controller\Template {

	public function before() {
		$this->css	 = array('login.css');
		$this->js	 = array('login.js');
	}

	public function get_index() {
		if (\Helper\User::isLogged()) {
			\Response::redirect('market');
		}
		else {
			$this->response('login');
		}
	}

	public function post_index() {
		$users = \Model\Users::forge();
		$user = $users->exists(\Model\User::forge(array(
			'id'		 => null,
			'username'	 => $_POST['username'],
			'password'	 => $_POST['password'],
			'group'		 => 0
		)));

		if (!is_null($user)) {
			\Helper\User::set($user);

			$this->response(array('success' => true));
		}
		else {
			$this->response(array(
				'success'	 => false,
				'title'		 => 'Login error',
				'message'	 => 'This user doesn\'t exist, check your Username / Password'
			));
		}
	}

	public function delete_index() {
		unset($_SESSION['user']['id']);
		unset($_SESSION['user']['username']);
		unset($_SESSION['user']['group']);
		unset($_SESSION['user']);

		$this->response(array('success' => true));
	}

}
