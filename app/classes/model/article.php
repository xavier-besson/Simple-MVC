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

class Article extends \Model {

	protected static $table = 'article';
	public $id;
	public $name;
	public $link;
	public $quantity;
	public $unit_price;
	public $content;
	public $user;

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
	
	public function insert(){
		\Db::forge()->execute('INSERT INTO '
		. 'article ('
		. 'name, '
		. 'link, '
		. 'quantity, '
		. 'unit_price, '
		. 'content, '
		. 'user) VALUES ('
		. '"' . \Db::escapeStr($this->name) . '",'
		. '"' . \Db::escapeStr($this->link) . '",'
		. '"' . \Db::escapeStr($this->quantity) . '",'
		. '"' . \Db::escapeStr($this->unit_price) . '",'
		. '"' . \Db::escapeStr($this->content) . '",'
		. '"' . \Db::escapeStr($this->user) . '"'
		. ')');
	}

}
