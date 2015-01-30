<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of app
 *
 * @author esl-xavierb
 */
class App {

	public static function init() {
		self::db_init();
	}

	private static function db_init() {
		$db = \Db::forge();

		if (!$db->exist()) {
			$db->execute("CREATE TABLE IF NOT EXISTS user "
			. "(id INTEGER PRIMARY KEY AUTOINCREMENT, "
			. "username STRING, "
			. "password STRING, "
			. "role INTEGER"
			. ")");

			$db->execute("CREATE TABLE IF NOT EXISTS article "
			. "(id INTEGER PRIMARY KEY AUTOINCREMENT, "
			. "user INTEGER, "
			. "name STRING, "
			. "link STRING, "
			. "quantity INTEGER, "
			. "unit_price REAL, "
			. "content TEXT,"
			. "FOREIGN KEY(user) REFERENCES user(id)"
			. ")");

			$db->execute("INSERT INTO user (username, password, role) VALUES ('admin', 'pwd', '1')");
		}
	}

}
