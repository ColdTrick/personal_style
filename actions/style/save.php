<?php 

	gatekeeper();

	$user_guid = elgg_get_logged_in_user_guid();

	$wallpaper 	= get_input('personal_style_selected_wallpaper');
	$type 		= get_input('personal_style_selected_type', 'default');
	$repeat 	= get_input('personal_style_display_type');

	$wallpaper_user_settings = array(
		'wallpaper' => $wallpaper,
		'wallpaper_type' => $type,
		'wallpaper_repeat' => $repeat
	);

	if(elgg_set_plugin_user_setting('wallpaper_settings', json_encode($wallpaper_user_settings), $user_guid, 'personal_style')) {
		system_message(elgg_echo('personal_style:actions:save:success'));
	} else {
		system_message(elgg_echo('personal_style:actions:save:error:setting'));
	}

	forward(REFERER);