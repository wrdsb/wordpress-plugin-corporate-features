
jQuery(function($){
 
	// on upload button click
	$('body').on( 'click', '.misha-upl', function(e){
 
		e.preventDefault();

		var button = $(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : { type : 'image'},
			button: { text: 'Use this image'},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			button.html('<img style="height:auto; width:270px;" src="' + attachment.url + '">').next().val(attachment.id).next().show();
		}).open();
 
	});
 
	// on remove button click
	$('body').on('click', '.misha-rmv', function(e){
 
		e.preventDefault();
 
		var button = $(this);
		button.next().val(''); // emptying the hidden field
		button.hide().prev().html('Upload image');
	});

	// on upload Video button click
	$('body').on( 'click', '.video-upl', function(e){
 
		e.preventDefault();
 
		var button = $(this),
		custom_uploader = wp.media({
			title: 'Insert image',
			library : { type : 'video'},
			button: { text: 'Use this video'},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			button.html('<video controls style="height:auto; width:270px;"><source src="' + attachment.url + '"></video>').next().val(attachment.id).next().show();
		}).open();
 
	});
 
});