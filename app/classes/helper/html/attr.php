<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of attr
 *
 * @author esl-xavierb
 */

namespace Helper\Html;

class Attr {
	
	public static function from_array($attrs){
		$return = '';
		
		foreach ($attrs as $key => $value) {
			$return .= $key;
			(! is_null($value)) && $return .= '="' . $value .'"';
			$return .= ' ';
		}
		
		return $return;
	}
	
}
