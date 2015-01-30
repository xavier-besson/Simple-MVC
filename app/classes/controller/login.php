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
		if (\Session\User::isLogged()) {
			\Response::redirect('market');
		}
		else {
			$this->response('login');
		}
	}

	public function post_index() {
		$user = \Model\User::forge()->exist($_POST['username'], $_POST['password']);

		if (!is_null($user)) {
			\Session\User::set((array) $user);

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
		\Session\User::destroy();
		$this->response(array('success' => true));
	}

}
