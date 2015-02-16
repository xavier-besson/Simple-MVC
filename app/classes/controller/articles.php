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

class Articles extends \Controller\Template {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Session\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
		else {
			if (!$isAjax) {
				$this->css	 = array('articles.css');
				$this->js	 = array('articles.js');
			}
		}
	}

	public function get_index() {

		$users_tmp	 = \Model\User::find('all');
		$users		 = array();

		foreach ($users_tmp as $key => $user) {
			$users[$user->id] = $user->username;
		}

		$this->response('articles', array(
			'users'		 => $users,
			'user'		 => \Session\User::get(),
			'is_admin'	 => \Session\User::isAdmin()
		));
	}

	public function get_list() {
		$filter	 = array();
		$where	 = '';

		(isset($_GET['user'])) && array_push($filter, 'user = ' . $_GET['user'] . ' ');
		(isset($_GET['status'])) && array_push($filter, 'status = ' . $_GET['status'] . ' ');
		(count($filter) > 0) && $where = 'WHERE ' . join(' AND ', $filter);

		$articles = \Model\Article::find('all', $where);

		foreach ($articles as $key => $article) {
			# Related user

			$user = \Model\User::find($article->user);

			if (!is_null($user)) {
				$user->password			 = null;
				$articles[$key]->user	 = $user->to_array();
			}

			$articles[$key] = $articles[$key]->to_array();
		}

		$this->template = 'empty';
		$this->response('articles/list/content', array(
			'articles'	 => $articles,
			'is_admin'	 => \Session\User::isAdmin(),
			'user_id'	 => \Session\User::get('id')
		));
	}

}
