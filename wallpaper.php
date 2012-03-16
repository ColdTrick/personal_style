<?php

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

	global $CONFIG;

	$guid = get_input('guid', elgg_get_logged_in_user_guid());

	$success = false;

	$filehandler = new ElggFile();
	$filehandler->owner_guid = $plane->owner_guid;
	$filehandler->setFilename("personal_style_wallpapers/" . $guid . ".jpg");

	$success = false;
	if ($filehandler->open("read")) {
		if ($contents = $filehandler->read($filehandler->size())) {
			$success = true;
		}
	}

	if (!$success) {
		$location = $CONFIG->dataroot . "personal_style_wallpapers/{$guid}.jpg";
		$contents = file_get_contents($location);
	}

	if($contents) {
		header("Content-type: image/jpeg");
		header('Expires: ' . date('r',time() + 864000));
		header("Pragma: public");
		header("Cache-Control: must-revalidate");
		header("Content-Length: " . strlen($contents));
		echo $contents;
	}