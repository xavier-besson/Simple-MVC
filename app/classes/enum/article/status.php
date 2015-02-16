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

namespace Enum\Article;

class Status extends \Enum {

	const PENDING		 = 1;
	const PROCESSING	 = 2;
	const COMPLETED	 = 3;
	const DECLINED	 = 4;
	const CANCELLED	 = 5;

	public static $data = array(
		self::PENDING	 => 'Pending',
		self::PROCESSING => 'Processing',
		self::COMPLETED	 => 'Completed',
		self::DECLINED	 => 'Declined',
		self::CANCELLED	 => 'Cancelled'
	);

}
