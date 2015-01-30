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
		$user		 = \Model\Users::find(intval($_GET['id']));
		if (!is_null($user)) {
			if (\Session\User::isOwner($user->id)) {
				$user->password	 = null;
				$response		 = $user->to_array();
			}
		}
		$this->response($response);
	}

	public function get_list() {
		$response = array('success' => false);

		if (\Session\User::isAdmin()) {
			$response = array_map(function($item) {
				return $item->to_array();
			}, \Model\Users::find('all'));
		}

		$this->response($response);
	}
}
