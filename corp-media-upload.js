jQuery(document).ready(function($){
    $('body').on('click','input',function(e) {
		
		
		var idClicked=e.target.id;
        e.preventDefault();

		if(idClicked.indexOf("uploadBtn")!=-1){
			console.log(idClicked);
			var split=idClicked.split("-");
			
			console.log(id);
			if(idClicked.indexOf("quick_links")!=-1){
				//code for quick links
				var id=split.slice(0, split.length-1).join("-");
				var image = wp.media({ 
					title: 'Upload Image',
					// mutiple: true if you want to upload multiple files at once
					multiple: false
				}).open()
				.on('select', function(e){
					// This will return the selected image from the Media Uploader, the result is an object
					var uploaded_image = image.state().get('selection').first();
					// We convert uploaded_image to a JSON object to make accessing it easier
					// Output to the console uploaded_image
					console.log(uploaded_image);
					var image_url = uploaded_image.toJSON().url;
					// Let's assign the url value to the input field
					var iconId="input#"+id+"-icon";
					var saveBtn="input#"+id+"-savewidget";
					var prvImg="#"+id+"-previewImage";
					console.log(prvImg);
					$(iconId).val(image_url);
					$(saveBtn).prop('disabled',false);
					$(saveBtn).val('Save');
					$(prvImg).attr('src',image_url);
				});
			}

			if(idClicked.indexOf("featured_item")!=-1){
				//code for featured item
				var id=split.slice(0, split.length-1).join("-");
				var image = wp.media({ 
					title: 'Upload Image',
					// mutiple: true if you want to upload multiple files at once
					multiple: false
				}).open()
				.on('select', function(e){
					// This will return the selected image from the Media Uploader, the result is an object
					var uploaded_image = image.state().get('selection').first();
					// We convert uploaded_image to a JSON object to make accessing it easier
					// Output to the console uploaded_image
					var image_url = uploaded_image.toJSON().url;

					// Let's assign the url value to the input field
					var imageId="input#"+id+"-image";
					console.log(imageId);
					var saveBtn="input#"+id+"-savewidget";
					var prvImg="#"+id+"-previewImage";

					$(imageId).val(image_url);
					$(saveBtn).prop('disabled',false);
					$(saveBtn).val('Save');
					console.log(prvImg);
					$(prvImg).attr('src',image_url+"?xxx=987878787");
					
				});
			}
		}
    });
});


