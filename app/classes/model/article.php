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

	protected static $_table = 'article';
	protected $_properties	 = array(
		'id',
		'name',
		'link',
		'quantity',
		'unit_price',
		'content',
		'user'
	);
}
