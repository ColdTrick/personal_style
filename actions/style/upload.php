<?php 

	global $CONFIG;

	$user_guid = elgg_get_logged_in_user_guid();

	$wallpaper 	= get_input('personal_style_selected_wallpaper');
	$type 		= get_input('personal_style_selected_type', 'custom');
	$repeat 	= get_input('personal_style_display_type');

	if ((isset($_FILES['wallpaper'])) && (substr_count($_FILES['wallpaper']['type'],'image/'))) {	
		$new_filename = $CONFIG->dataroot . "personal_style_wallpapers/{$user_guid}.jpg";
		try {
			if(!file_exists($CONFIG->dataroot . "personal_style_wallpapers/")) {
				mkdir($CONFIG->dataroot . "personal_style_wallpapers/");
				chmod($CONFIG->dataroot . "personal_style_wallpapers/", 0755);
			}

			if(($file_handler = fopen($new_filename, "w+b")) === false) {
				$file_error = true;
			}

			$resized = get_resized_image_from_uploaded_file('wallpaper', 2000, 2000, $size_info['square'], $size_info['upscale']);
			if(($write = fwrite($file_handler, $resized)) === false) {
				$file_error = true;
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}

		if(!$file_error) {
			$wallpaper_user_settings = array(
				'wallpaper_type' => 'custom',
				'wallpaper_repeat' => $repeat
			);
			
			if(elgg_set_plugin_user_setting('wallpaper_settings', json_encode($wallpaper_user_settings), $user_guid, 'personal_style')) {
				system_message(elgg_echo('success'));
			}
		} else {
			register_error(elgg_echo('error'));
		}
	}

	forward(REFERER);