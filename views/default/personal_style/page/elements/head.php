<?php

	if($user = elgg_get_logged_in_user_entity()) {
		if($wallpaper_settings = elgg_get_plugin_user_setting("wallpaper_settings", $user->getGUID(), "personal_style")) {
			$wallpaper_settings = json_decode($wallpaper_settings, true);

			if($wallpaper_settings['wallpaper_type'] == 'default') {
				$wallpaper_url = elgg_get_site_url() . "mod/personal_style/graphics/wallpapers/" . $wallpaper_settings['wallpaper'];
			} else {
				$wallpaper_url = elgg_get_site_url() . "mod/personal_style/wallpaper.php?guid=" . $user->getGUID() . '&ts=' . time();
			}

			echo "<style type='text/css' media='screen'>\n";
			echo "body {\n";
			echo "background-image: url(" . $wallpaper_url . ");\n";

			if($wallpaper_settings['wallpaper_repeat'] == 'repeat') {
				echo "background-position:  top left;\n";
				echo "background-repeat: repeat;\n";
			} else {
				echo "background-size: 100% auto;\n";
				echo "background-repeat: no-repeat;\n";
			}

			echo "background-attachment: fixed;\n";
			echo "}\n";
			echo "</style>\n";
		}
	}