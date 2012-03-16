<div>
	<label><?php echo elgg_echo('wallpaper');?></label><br />
	<?php
	echo elgg_view('input/file', array(
		'name' => 'wallpaper'
	));
	
	echo elgg_view('input/radio', array('name' 		=> 'personal_style_display_type',
										'id' 		=> 'personal_style_display_type',
										'value' 	=> 'repeat',
										'options' 	=> array(	elgg_echo('personal_style:forms:style:wallpaper:repeat') => 'repeat',
																elgg_echo('personal_style:forms:style:wallpaper:no_repeat') => 'no_repeat'))) . '<br />';
	?>
</div>

<div class="elgg-foot">
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('upload'))); ?>
</div>