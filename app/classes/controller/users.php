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

class Users extends \Controller\Template {

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
				$this->css	 = array('users.css');
				$this->js	 = array('users.js');
			}
		}
	}

	public function get_index() {
		$this->response('users', array(
			'user'		 => \Session\User::get(),
			'is_admin'	 => \Session\User::isAdmin()
		));
	}

	public function get_list() {
		$users = \Model\User::find('all');

		$this->template = 'empty';
		$this->response('users/list/content', array(
			'users' => $users
		));
	}
}
