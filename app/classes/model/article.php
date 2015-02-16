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

	protected static $_table		 = 'article';
	protected static $_properties	 = array(
		'id'		 => array(
			'type' => 'INTEGER'
		),
		'name'		 => array(
			'type' => 'STRING'
		),
		'date'		 => array(
			'type' => 'INTEGER'
		),
		'status'		 => array(
			'type' => 'INTEGER'
		),
		'link'		 => array(
			'type' => 'STRING'
		),
		'quantity'	 => array(
			'type' => 'INTEGER'
		),
		'unit_price' => array(
			'type' => 'REAL'
		),
		'content'	 => array(
			'type' => 'STRING'
		),
		'user'		 => array(
			'type' => 'INTEGER'
		)
	);

}
