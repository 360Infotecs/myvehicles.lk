$(document).ready(function($){
	images = new Array();
	$(document).on('change','.coverimage',function(){
		 files = this.files;
		 $.each( files, function(){
			 image = $(this)[0];
			 if (!!image.type.match(/image.*/)) {
	        	 var reader = new FileReader();
	             reader.readAsDataURL(image);
	             reader.onloadend = function(e) {
	            	img_src = e.target.result; 
					html = "<img class='img-thumbnail' style='width:300px;margin:20px;' src='"+img_src+"'>";
	            	$('#image_container').append( html );
					//$('#imgs').attr('src',img_src);
	             };
        	 } 
		});
	});
});