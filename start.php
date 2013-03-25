<?php

	include(dirname(__FILE__) . '/lib/hooks.php');

	function personal_style_init() {
		$js_root = 'mod/personal_style/views/default/js/';
		elgg_register_js('personal_style_js', $js_root . 'js.js');

		$css_root = 'mod/personal_style/views/default/css/';
		elgg_register_css('personal_style_css', $css_root . 'site.css');

		elgg_extend_view('css/elgg', 'personal_style/css/site');

		if(elgg_get_context() != 'admin') {
			elgg_extend_view('page/elements/head', 'personal_style/page/elements/head');
		}

		elgg_register_plugin_hook_handler('register', 'menu:user_hover', 'personal_style_user_hover_menu');

		elgg_register_page_handler('personal_style', 'personal_style_page_handler');

		elgg_register_action('style/save', dirname(__FILE__) . '/actions/style/save.php');
		elgg_register_action('style/upload', dirname(__FILE__) . '/actions/style/upload.php');
	}

	function personal_style_pagesetup() {
		global $CONFIG;

		if(elgg_is_logged_in()) {
			$context = elgg_get_context();

			if($context == 'profile') {
				elgg_register_menu_item(elgg_echo('personal_style:menu:style'), $CONFIG->wwwroot . 'pg/personal_style/');
			}
		}
	}

	function personal_style_page_handler($page) {
		include(dirname(__FILE__) . '/pages/style.php');
		return true;
	}

	elgg_register_event_handler('init', 'system', 'personal_style_init');
	elgg_register_event_handler('pagesetup', 'system', 'personal_style_pagesetup');