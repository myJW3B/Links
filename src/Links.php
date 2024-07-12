<?php

namespace JW3B\gui;

class Links {
	public $links;
	public $active_class;
	public $active_goes_on;


	public function __construct() {
	}

	/**
	 * link_up function
	 * @param array  $a = [
	 * 		'/index.php' => [
	 * 			'attr' => [
	 * 				'classe' => 'nav-links active some class',
	 * 				'data-bs-toggler' => 'tab',
	 * 				'id' => 'index-link',
	 * 			],
	 * 			'n' => 'text shown',
	 * 			'b4' => '<li class="nav-link">',
	 * 			'after' => '</li>'
	 * 		]
	 * ]
	 */
	public static function link_up($l_ary) {
		$links = '';
		foreach ($l_ary as $ary) {
			$attr_in = '';
			if (isset($ary['b4'])) {
				$links .= $ary['b4'];
			}
			if (isset($ary['attr']) && is_array($ary['attr'])) {
				foreach ($ary['attr'] as $at => $val) {
					$attr_in .= ' ' . $at . '="' . $val . '"';
				}
			}
			$links .= '<a href="' . $ary['url'] . '"' . $attr_in . '>' . $ary['n'] . '</a>';
			if (isset($ary['b4'])) {
				$links .= $ary['after'];
			}
		}
		return $links;
	}
	/**
	 * display function
	 *
	 * @param string $wrap_in='li'
	 * @param array $ary = [
	 * 		'li' => [ // the value of $wrap_in if found
	 * 			'class' => '',
	 * 			'attr' => ' some="val" // strings
	 * 		],
	 * 		'a' => [
	 * 			'class' => '',
	 * 			'attr' => ' some="val"' // strings
	 * 			'url' => '/',
	 * 			'label' => 'Home'
	 * 		]
	 * ]
	 *
	 * @return string
	 */
	public function display($wrap_in = 'li', $ary = []) {
		// it just displays the links inside the ul
		$ret = '';
		if (isset($this->links)) {
			foreach ($this->links as $k => $v) {
				$class = '';
				$attr = '';
				$after_link = '';
				$acls = '';
				$aattr = '';
				$_SERVER['REQUEST_URI'] = 'home';
				$add = $_SERVER['REQUEST_URI'] == str_replace('/', '', $k) ? $this->active_class : '';
				if ($wrap_in != '') {
					if (isset($ary[$wrap_in])) {
						$class .= $this->active_goes_on == $wrap_in ? $add : '';
						if (isset($ary[$wrap_in]['class'])) {
							$class .= $class == '' ? $ary[$wrap_in]['class'] : ' ' . $ary[$wrap_in]['class'];
						}
						if (isset($ary[$wrap_in]['attr'])) {
							$attr .= ' ' . $ary[$wrap_in]['attr'];
						}
					}
					$ret .= '<' . $wrap_in . ' class="' . $class . '"' . $attr . '>';
					$after_link = '</' . $wrap_in . '>';
				}
				$acls .= $this->active_goes_on == 'a' ? $add : '';
				if (isset($ary['a'])) {
					if (isset($ary['a']['class'])) {
						$acls .= $acls == '' ? $ary['a']['class'] : ' ' . $ary['a']['class'];
					}
					if (isset($ary['a']['attr'])) {
						$aattr .= ' ' . $ary['a']['attr'];
					}
				}
				$acls = $acls == '' ? '' : ' class="' . $acls . '"';
				$ret .= '<a href="' . $k . '"' . $acls . $aattr . '>' . $v . '</a>';
				$ret .= $after_link;
			}
		}
		return $ret;
	}

	public function find_attr($ary) {
		// lets go
	}
}
