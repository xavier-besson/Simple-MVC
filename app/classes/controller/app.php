<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of news
 *
 * @author esl-xavierb
 */

namespace Controller;

class App extends \Controller\Template {

	public function get_index(){
		\Response::redirect((\Session\User::isLogged() ? 'market' : 'login'));
	}
}
