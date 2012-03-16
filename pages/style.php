<?php 

	$user_guid = elgg_get_logged_in_user_guid();

	elgg_load_css('personal_style_css');
	elgg_load_js('personal_style_js');

	elgg_set_context("profile");
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

	$title = elgg_echo('personal_style:style:title');

	$params = array(
		'title' => $title
	);

	elgg_push_breadcrumb(elgg_echo('profile'));
	elgg_push_breadcrumb($title);

	$wallpaper_user_settings = elgg_get_plugin_user_setting('wallpaper_settings', $user_guid, 'personal_style');

	$wallpaper_user_settings = json_decode($wallpaper_user_settings, true);

	$params['content']  = elgg_view_form('style/save', array(), array('wallpaper_settings' => $wallpaper_user_settings));
	$params['content']  .= '<div style="display: none;"><div id="personal_style_upload_wallpaper_form">' . elgg_view_form('style/upload', array('enctype' => 'multipart/form-data')) . '</div></div>';

	$body = elgg_view_layout('one_sidebar', $params);

	echo elgg_view_page($title, $body);

	return true;