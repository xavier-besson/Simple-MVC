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
		if (!\Helper\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else {
			if (!$isAjax) {
				$this->css	 = array('user.css');
				$this->js	 = array('user.js');
			}
		}
	}

	public function get_profile() {
		$this->response('user');
	}

	public function get_index() {
		$response	 = array('success' => false);
		$user		 = \Model\Users::forge()->get_by_key('id', $_GET['id']);
		if (!is_null($user)) {
			if (\Helper\User::isOwner($user->id)) {
				$user->password	 = null;
				$response		 = $user;
			}
		}
		$this->response($response);
	}

	public function get_list() {
		$response = array('success' => false);

		if (\Helper\User::isAdmin()) {
			$response = \Model\Users::forge()->get_all();
		}

		$this->response($response);
	}

	public function post_save() {
		$success = false;
		$users	 = \Model\Users::forge();
		$id		 = $_POST['id'];

		if ($id == 0) {
			if (\Helper\User::isAdmin()) {
				$user = \Model\User::forge();

				$user->id		 = $user->get_max_value('id') + 1;
				$user->username	 = $_POST['username'];
				$user->password	 = $_POST['password'];
				$user->group	 = $_POST['group'];

				$success = true;

				$users->add($user);
			}
		}
		else {
			$user = $users->get_by_key('id', $id);
			if (!is_null($user)) {
				if (\Helper\User::isOwner($user->id)) {
					$user->username	 = $_POST['username'];
					$user->password	 = $_POST['password'];
					isset($_POST['group']) && $user->group	 = $_POST['group'];
					$success		 = true;

					$users->update('\Model\User', $user);

					\Helper\User::isCurrent($user->id) && \Helper\User::set($user);
				}
			}
		}

		$this->response(array('success' => $success));
	}

	public function get_delete() {
		$success	 = false;
		$id			 = $_GET['id'];
		$articles	 = \Model\Articles::forge();
		$article	 = $articles->get_by_key('id', $id);

		if (!is_null($article)) {
			if (\Helper\User::isOwner($article->user)) {
				$articles->delete($id);
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

}
