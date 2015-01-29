<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file
 *
 * @author esl-xavierb
 */

namespace Helper;

class File {

	/**
	 * Format a string in a filename
	 * @param string $str The string value to formate
	 * @return string Formatted string
	 */
	public static function generate_filename($str) {
		$str = strtolower($str);
		$str = \Helper\String::replace_diacritics($str);
		$str = str_replace(array(DIRECTORY_SEPARATOR, ' ', '..'), array('-', '_', '.'), $str);
		preg_replace('/[^0-9^a-z^_^.]/', '', $str);
				
		return $str;
	}

}
