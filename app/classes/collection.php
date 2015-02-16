<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of collection
 *
 * @author esl-xavierb
 */
class Collection {
	protected $array = array();
	
	protected function __construct($args){
		if(s_array($args)){
			$this->array = $args;
		}
	}
	
	public static function forge($args){
		return new static($args);
	}
	
}
