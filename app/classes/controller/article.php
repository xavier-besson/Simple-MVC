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
		$article	 = \Model\Articles::forge()->get_by_key('id', $_GET['id']);
		if (!is_null($article)) {
			if (\Session\User::isOwner($article->user)) {
				$response = $article;
			}
		}
		$this->response($response);
	}

	public function get_list() {
		$articles = \Model\Article::find('all');
		foreach ($articles as $key => $article) {
			$articles[$key]->user = \Model\User::find($article->user);

			# Related user
			(!is_null($articles[$key]->user)) && $articles[$key]->user->password = null;
		}
		$this->response($articles);
	}

	public function post_save() {
		$success = false;
		$id		 = $_POST['id'];

		if ($id == 0) {
			$article			 = \Model\Article::forge();
			$article->name		 = $_POST['name'];
			$article->link		 = $_POST['link'];
			$article->quantity	 = $_POST['quantity'];
			$article->unit_price = $_POST['unit_price'];
			$article->content	 = $_POST['content'];
			$article->user		 = \Session\User::get('id');
			$article->insert();
			$success			 = true;
		}
		else {
			$article = $articles->get_by_key('id', $id);
			if (!is_null($article)) {
				if (\Session\User::isOwner($article->user)) {
					$article->name		 = $_POST['name'];
					$article->link		 = $_POST['link'];
					$article->quantity	 = $_POST['quantity'];
					$article->unit_price = $_POST['unit_price'];
					$article->content	 = $_POST['content'];

					$success = true;

					$articles->update($article);
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
			if (\Session\User::isOwner($article->user)) {
				$articles->delete($id);
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

}
