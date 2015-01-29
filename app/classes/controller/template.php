<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author esl-xavierb
 */

namespace Controller;

class Template extends \Controller\Base {

	public $template = 'template';
	public $view	 = '_404';
	public $title	 = '';
	protected $css	 = array();
	protected $js	 = array();

	public function get_css() {
		if (count($this->css) > 0) {
			return
			'<link rel="stylesheet" href="/assets/css/' .
			implode('"><link rel="stylesheet" href="/assets/css/', $this->css) .
			'">';
		}
		else {
			return '';
		}
	}

	public function get_js() {
		if (count($this->js) > 0) {
			return
			'<script src="/assets/js/' .
			implode('"></script><script src="/assets/js/', $this->js) .
			'"></script>';
		}
		else {
			return '';
		}
	}

	public function response($content = null, $data = array()) {
		if (is_array($content) || is_object($content)) {
			\Response::json($content);
		}
		else {
			(!is_null($content)) && $this->view = $content;

			extract(
			array_merge($data, array(
				'title'	 => $this->title,
				'css'	 => $this->get_css(),
				'js'	 => $this->get_js(),
				'view'	 => $this->view
			)));

			ob_start();
			require_once VIEW_PATH . $this->template . '.php';
			echo ob_get_clean();
		}
	}

}
