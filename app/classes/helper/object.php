<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of object
 *
 * @author esl-xavierb
 */

namespace Helper;

class Object {
	
	/**
	 * Return an object of type $class with data from $stdclass
	 * @param type $class    The class of the returned object
	 * @param type $stdclass The stdClass source data
	 * @return Object The object of type $class
	 */
	public static function get_object_from_stdclass($class, $stdclass) {
		$object = new $class();
		foreach ($stdclass as $key => $value) {
			# If property exists
			if (property_exists($class, $key)) {
				# If property is an object
				if (is_object($value)) {
					$object->{$key} = self::get_object_from_stdclass(get_class($object->{$key}), $value);
				}
				# If property is an other type
				else {
					$object->{$key} = $value;
				}
			}
		}
		return $object;
	}
	
	/**
	 * Return an array of object of a specify class
	 * @param array $arr_object    Array of objects
	 * @param string $object_class Class name of the objects
	 * @return array The array with hinting object
	 */
	public static function get_array_of_objects($arr_object, $object_class){
		$arr = array();
		if (is_array($arr_object)) {
			foreach ($arr_object as $object) {
				if (is_object($object)) {
					if (is_a($object, $object_class)) {
						array_push($arr, $object);
					}
					else {
						array_push($arr, \Helper\Object::get_object_from_stdclass($object_class, $object));
					}
				}
			}
		}
		return $arr;
	}
	
	public static function get_stdclass_from_object($object){
		return (object)(array)$object;
	}
}
