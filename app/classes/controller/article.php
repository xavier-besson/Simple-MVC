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
		if (!\Helper\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
	}

	public function get_index() {
		$response	 = array('success' => false);
		$article	 = \Model\Articles::forge()->get_by_key('id', $_GET['id']);
		if (!is_null($article)) {
			if (\Helper\User::isOwner($article->user)) {
				$response = $article;
			}
		}
		$this->response($response);
	}

	public function post_save() {
		$success	 = false;
		$articles	 = \Model\Articles::forge();
		$id			 = $_POST['id'];

		if ($id == 0) {
			$article = \Model\Article::forge();

			$article->id		 = $articles->get_max_value('id') + 1;
			$article->name		 = $_POST['name'];
			$article->link		 = $_POST['link'];
			$article->quantity	 = $_POST['quantity'];
			$article->unit_price = $_POST['unit_price'];
			$article->content	 = $_POST['content'];
			$article->user		 = \Helper\User::get('id');

			$success = true;

			$articles->add($article);
		}
		else {
			$article = $articles->get_by_key('id', $id);
			if (!is_null($article)) {
				if (\Helper\User::isOwner($article->user)) {
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
			if (\Helper\User::isOwner($article->user)) {
				$articles->delete($id);
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

}
