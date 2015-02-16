<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of role
 *
 * @author esl-xavierb
 */

namespace Enum\User;

class Role extends \Enum {

	const ADMIN	 = 1;
	const USER	 = 2;

	public static $data = array(
		self::ADMIN	 => 'Administrator',
		self::USER	 => 'User'
	);

}
