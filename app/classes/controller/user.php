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

class User extends \Controller\Template {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Session\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else if (!\Session\User::isAdmin()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else {
			if (!$isAjax) {
				$this->css	 = array('user.css');
				$this->js	 = array('user.js');
			}
		}
	}

	public function get_index() {
		$response	 = array('success' => false);
		$user		 = \Model\User::find(intval($_GET['id']));
		if (!is_null($user)) {
			$user->password	 = null;
			$response		 = $user->to_array();
		}
		$this->response($response);
	}

	public function post_delete() {
		$success = false;
		$id		 = intval($_POST['id']);
		$user	 = \Model\User::find($id);

		if (!is_null($user)) {
			$user->delete();
			$success = true;
		}
		$this->response(array('success' => $success));
	}

	public function post_save() {
		$success = false;
		$id		 = intval($_POST['id']);

		if ($id == 0) {
			$user = \Model\User::forge();

			isset($_POST['username']) && $user->username	 = $_POST['username'];
			isset($_POST['role']) && $user->role		 = $_POST['role'];
			isset($_POST['password']) && $user->password	 = $_POST['password'];

			$user->save();
			$success = true;
		}
		else {
			$user = \Model\User::find($id);

			if (!is_null($user)) {
				isset($_POST['username']) && $user->username	 = $_POST['username'];
				isset($_POST['role']) && $user->role		 = $_POST['role'];
				isset($_POST['password']) && $user->password	 = $_POST['password'];

				$user->save();
				$success = true;
				
				if(\Session\User::get('id') === $user->id){
					\Session\User::set($user->to_array());
				}
			}
		}
		$this->response(array('success' => $success));
	}

	public function post_password() {
		$success = false;
		$id		 = intval($_POST['id']);

		$user = \Model\User::find($id);

		if (!is_null($user)) {
			$user->password = $_POST['password'];

			$user->save();
			$success = true;
		}

		$this->response(array('success' => $success));
	}

}
