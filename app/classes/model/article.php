<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of Article
 *
 * @author esl-xavierb
 */

namespace Model;

class Article {

	public $id;
	public $name;
	public $link;
	public $quantity;
	public $unit_price;
	public $content;
	public $user;

	public static function forge($args = null) {
		return new static($args);
	}

	protected function __construct($args) {
		if (is_array($args)) {
			$this->id			 = $args['id'];
			$this->name			 = $args['name'];
			$this->link			 = $args['link'];
			$this->quantity		 = $args['quantity'];
			$this->unit_price	 = $args['unit_price'];
			$this->content		 = $args['content'];
			$this->user			 = $args['user'];
		}
		else if (is_object($args)) {
			$this->id			 = $args->id;
			$this->name			 = $args->name;
			$this->link			 = $args->link;
			$this->quantity		 = $args->quantity;
			$this->unit_price	 = $args->unit_price;
			$this->content		 = $args->content;
			$this->user			 = $args->user;
		}
	}

}
