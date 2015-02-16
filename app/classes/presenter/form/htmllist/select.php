<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of collection
 *
 * @author esl-xavierb
 */

namespace Presenter\Form\Htmllist;

class Select extends \Presenter\Form\Htmllist {

	public static function render($data, $selected, $attrs, $prepend = []) {
		$html = '<select ' . \Helper\Html\Attr::from_array($attrs) . '>';
		if (!is_null($prepend)) {
			foreach ($prepend as $key => $value) {
				$html .= '<option value="' . $key . '"' . ($key === $selected ? ' selected' : '') . '>' . $value . '</option>';
			}
		}
		foreach ($data as $key => $value) {
			$html .= '<option value="' . $key . '"' . ($key === $selected ? ' selected' : '') . '>' . $value . '</option>';
		}
		$html .= '</select>';

		echo $html;
	}

}
