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

class Market extends \Controller\Template {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Helper\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else {
			if (!$isAjax) {
				$this->css	 = array('market.css');
				$this->js	 = array('market.js');
			}
		}
	}

	public function get_index() {
		$this->response('market');
	}

	public function get_list() {
		$items	 = \Model\Articles::forge()->get_all();
		$users	 = \Model\Users::forge();

		// Add the user object
		foreach ($items as $key => $item) {
			$items[$key]->user = $users->get_by_key('id', $item->user);
			
			# Related user
			(!is_null($items[$key]->user)) && $items[$key]->user->password = null;
		}

		$this->response($items);
	}

}
