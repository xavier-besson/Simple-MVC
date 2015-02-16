<?php

# Debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

# Session
session_start();

# Const
define('APP_PATH', __DIR__ . '/app/');
define('VIEW_PATH', APP_PATH . 'view/');
define('CLASS_PATH', APP_PATH . 'classes/');
define('DATA_PATH', APP_PATH . 'data/');
define('CACHE_PATH', APP_PATH . 'cache/');

# Autoload
function __autoload($class) {
	$parts		 = explode('\\', strtolower($class));
	$filename	 = CLASS_PATH . join(DIRECTORY_SEPARATOR, $parts) . '.php';
	if (file_exists($filename)) {
		require_once $filename;
	}
}

# App init
\App::init();

# Router, call controller method needed
\Router::run();
