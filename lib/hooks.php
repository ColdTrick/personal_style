<?php

	function personal_style_user_hover_menu($hook, $type, $return, $params) {
		$user = $params['entity'];

		if(elgg_is_logged_in()) {
			if (elgg_get_logged_in_user_guid() == $user->guid) {
				$url = "personal_style";
				$item = new ElggMenuItem('personal_style', elgg_echo('personal_style:profile:menu:linksownpage:style'), $url);
				$item->setSection('action');
				$return[] = $item;
			}
		}

		return $return;
	}