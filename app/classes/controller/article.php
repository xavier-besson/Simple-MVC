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
			$article->date		 = time();
			$article->status	 = \Enum\Article\Status::PENDING;
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
				}
			}
		}

		$this->response(array('success' => $success));
	}

	public function post_status() {
		$success = false;
		if (\Session\User::isAdmin()) {
			$id		 = intval($_POST['id']);
			$article = \Model\Article::find($id);

			if (!is_null($article)) {
				$article->status = $_POST['status'];
				
				$article->save();
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

	public function post_delete() {
		$success = false;
		$id		 = intval($_POST['id']);
		$article = \Model\Article::find($id);

		if (!is_null($article)) {
			if (\Session\User::isOwner($article->user)) {
				$article->delete();
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}
	
	public function post_cancel() {
		$success = false;
		$id		 = intval($_POST['id']);
		$article = \Model\Article::find($id);

		if (!is_null($article)) {
			if (\Session\User::isOwner($article->user)) {
				$article->status = \Enum\Article\Status::CANCELLED;
				
				$article->save();
				$success = true;
			}
		}
		$this->response(array('success' => $success));
	}

}
