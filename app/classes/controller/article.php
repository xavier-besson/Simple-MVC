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

class Article extends \Controller\Template {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Session\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
	}

	public function get_index() {
		$response	 = array('success' => false);
		$article	 = \Model\Article::find(intval($_GET['id']));
		if (!is_null($article)) {
			if (\Session\User::isOwner($article->user)) {
				$response = $article->to_array();
			}
		}
		$this->response($response);
	}

	public function get_list() {
		$articles = \Model\Article::find('all');

		foreach ($articles as $key => $article) {
			# Related user
			$user			 = \Model\User::find($article->user);
			(!is_null($user)) && $user->password	 = null;

			$articles[$key]->user	 = $user->to_array();
			$articles[$key]			 = $articles[$key]->to_array();
		}
		$this->response($articles);
	}

	public function post_save() {
		$success = false;
		$id		 = intval($_POST['id']);

		if ($id == 0) {
			$article			 = \Model\Article::forge();
			$article->name		 = $_POST['name'];
			$article->link		 = $_POST['link'];
			$article->quantity	 = $_POST['quantity'];
			$article->unit_price = $_POST['unit_price'];
			$article->content	 = $_POST['content'];
			$article->user		 = \Session\User::get('id');
			$article->save();
			$success			 = true;
		}
		else {
			$article = \Model\Article::find($id);

			if (!is_null($article)) {
				if (\Session\User::isOwner($article->user)) {
					$article->name		 = $_POST['name'];
					$article->link		 = $_POST['link'];
					$article->quantity	 = $_POST['quantity'];
					$article->unit_price = $_POST['unit_price'];
					$article->content	 = $_POST['content'];
					$article->save();
					$success			 = true;

					$articles->update($article);
				}
			}
		}

		$this->response(array('success' => $success));
	}

	public function get_delete() {
		$success	 = false;
		$id			 = intval($_GET['id']);
		$article	 = \Model\Article::find($id);

		if (!is_null($article)) {
			if (\Session\User::isOwner($article->user)) {
				$article->delete();
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

}
