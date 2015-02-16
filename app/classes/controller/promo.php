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

class Promo extends \Controller\Base {

	public function before() {
		$isAjax = \Request::isAjax();
		if (!\Session\User::isLogged()) {
			$isAjax ? \Response::json(array('success' => false)) : \Response::redirect('login');
		}
	}

	public function get_index() {
		$cache_filename = CACHE_PATH . 'promo/list.html';
		$html = '';
		
		if (file_exists($cache_filename)) {
			$file_update = filemtime($cache_filename);
						
			$date1		 = new \DateTime();
			$date2		 = new \DateTime(date('Ymd', $file_update));

			$diff = $date2->diff($date1)->format("%d");

			if ($diff > 7) {
				$html = file_get_contents('http://www.coradrive.fr/amphion/tous-les-rayons/promo-et-offres/promo.html?parpage=40&type=grille');
				\Helper\File::save_to_file($cache_filename, $html);
			}
			else{
				$html = file_get_contents($cache_filename);
			}
		}
		else {
			$html = file_get_contents('http://www.coradrive.fr/amphion/tous-les-rayons/promo-et-offres/promo.html?parpage=40&type=grille');
			\Helper\File::save_to_file($cache_filename, $html);
		}

		echo $html;
	}

}
