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

class Profile extends \Controller\Template {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Session\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else {
			if (!$isAjax) {
				$this->js	 = array('profile.js');
			}
		}
	}

	public function get_index() {
		$this->response('profile', array(
			'user'		 => \Session\User::get(),
			'is_admin'	 => \Session\User::isAdmin()
		));
	}

	public function post_save() {
		$success = false;
		$id		 = intval($_POST['id']);
		if (\Session\User::isOwner($id)) {
			$user = \Model\User::find($id);

			if (!is_null($user)) {
				isset($_POST['username']) && $user->username = $_POST['username'];

				$user->save();
				$success = true;

				\Session\User::set($user->to_array());
			}
		}
		$this->response(array('success' => $success));
	}

	public function post_password() {
		$success = false;
		$message = '';
		$id		 = intval($_POST['id']);

		if (\Session\User::isOwner($id)) {
			$user = \Model\User::find($id);

			if (!is_null($user)) {
				if (parse_str($user->password) === parse_str($_POST['password-current'])) {
					$user->password = $_POST['password'];

					$user->save();
					$success = true;
				}
				else{
					$message = 'Your current password is wrong!';
				}
			}
		}

		$this->response(array(
			'success'	 => $success,
			'message'	 => $message
		));
	}

}
