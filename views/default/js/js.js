$(function()
{
	var selected_wallpaper;
	$('#personal_style_wallpaper_selectable').selectable({
		stop: function(e, ui) {
			$(".ui-selected:first", this).each(function() {
				$(this).siblings().removeClass("ui-selected");
				var refreshVal = $(this).attr("value");
			});
		}
	});

	$('#personal_style_wallpaper_selectable').bind('selectableselected', function(event, ui) {		
		selected_wallpaper = personal_style_get_selected_background();
		display_type = $('input[name="personal_style_display_type"]:checked').val();

		personal_style_set_background(selected_wallpaper, display_type, 'default');
	});
	
	$('input[name="personal_style_display_type"]').change(function() {
		selected_wallpaper = personal_style_get_selected_background();
		display_type = $('input[name="personal_style_display_type"]:checked').val();

		personal_style_set_background(selected_wallpaper, display_type);
	});

	$('.personal_style_show_wallpapers').click(function() {
		$('.personal_style_wallpapers').toggle();
	});

	$('.personal_style_wallpapers_add').click(function() {
		$('input[name="personal_style_selected_type"]').val('custom');
	});

	$('#personal_style_fancybox_form').fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
	});
});

function personal_style_get_selected_background() {
	selected_items = $('.ui-selected');		
	selected_wallpaper = selected_items.attr('rel');

	return selected_wallpaper;
}

function personal_style_set_background(wallpaper, display_type, type) {
	$(document.body).attr('style', '')

	if(wallpaper != undefined) {
		$(document.body).css("background-image", "url(" + elgg.get_site_url() + "mod/personal_style/graphics/wallpapers/" + wallpaper + ")")
						.css("background-attachment", "fixed");

		if(type == undefined) {
			type = 'default';
		}
	} else if(display_type == 'default') {
		$(document.body).css("background", "none")
		type = '';
	}

	if(display_type == 'repeat') {
		$(document.body).css("background-repeat", "repeat")
						.css("background-position", "top left")
						.css("background-size", "auto");
	} else if(display_type == 'no_repeat') {
		$(document.body).css("background-repeat", "no_repeat")
						.css("background-size", "100% auto");
	}

	$('input[name="personal_style_selected_type"]').val(type);
	$('input[name="personal_style_selected_wallpaper"]').val(wallpaper);
}