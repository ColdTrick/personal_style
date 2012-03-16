<?php

	$wallpaper_user_settings = $vars["wallpaper_settings"];

	$wallpaper_base_dir = elgg_get_plugins_path() . 'personal_style/graphics/wallpapers/';
	$wallpaper_url_base = elgg_get_site_url() . 'mod/personal_style/graphics/wallpapers/';

	$wallpaper_list = array();

	if($handler = opendir($wallpaper_base_dir)) {
		while($filename = readdir($handler)) {
			if(!is_dir($wallpaper_base_dir . $filename)) {
				$wallpaper_list[] = $filename;
			}
		}
	}

	if(!$wallpaper_user_settings['wallpaper_repeat']) {
		$wallpaper_user_settings['wallpaper_repeat'] = 'repeat';
	}

	echo elgg_view('input/hidden', array('name' => 'personal_style_selected_wallpaper'));
	echo elgg_view('input/hidden', array('name' => 'personal_style_selected_type', 'value' => $wallpaper_user_settings['wallpaper_type']));

	echo elgg_view('input/radio', array('name' => 'personal_style_display_type',
										'id' => 'personal_style_display_type', 
										'value' => $wallpaper_user_settings['wallpaper_repeat'],
										'options' => array(	elgg_echo('personal_style:forms:style:wallpaper:repeat') => 'repeat',
															elgg_echo('personal_style:forms:style:wallpaper:no_repeat') => 'no_repeat'))) . '<br />';
	?>
	<a href="javascript: void(0);" class="personal_style_show_wallpapers"><?php echo elgg_echo('personal_style:forms:style:wallpaper:show_wallpapers'); ?></a>
	<div class="personal_style_wallpapers">
		<ol id="personal_style_wallpaper_selectable">
			<li class="ui-widget-content">
				<?php echo elgg_echo('personal_style:forms:style:wallpaper:no_wallpaper'); ?><br />
			</li>
			<?php 
			if($wallpaper_list)
			{
				foreach($wallpaper_list as $wallpaper)
				{
				?>
				<li class="ui-widget-content <?php echo (($wallpaper == $wallpaper_user_settings['wallpaper'])?'ui-selected':''); ?> default" rel="<?php echo $wallpaper; ?>">
					<?php echo $wallpaper?><br />
					<img src="<?php echo $wallpaper_url_base . $wallpaper; ?>" alt="<?php echo $wallpaper; ?>" />
				</li>
				<?php
				}
			}
			?>
			<li class="ui-widget-content personal_style_wallpapers_add <?php echo (($wallpaper_user_settings['wallpaper_type'] == 'custom')?'ui-selected':''); ?>">
				<a id="personal_style_fancybox_form" href="#personal_style_upload_wallpaper_form"><?php echo elgg_echo('personal_style:forms:style:wallpaper:upload_custom'); ?></a><br />
				<img src="<?php echo elgg_get_site_url(); ?>mod/personal_style/wallpaper.php?guid=<?php echo elgg_get_logged_in_user_guid(); ?>" alt="<?php echo $wallpaper; ?>" />
			</li>
		</ol>
		<div class="clearfix"></div>
	</div><br /><br />

	<?php echo elgg_view('input/submit', array('value' => elgg_echo('save')));