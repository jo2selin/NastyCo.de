// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();


$(".likePost").click(function(){
	var id_liked = this.getAttribute('data-id');
	var url_liked = 'addlike/' + id_liked;
	console.log(id_liked);
	console.log(url_liked);
	$.ajax({
		  url: url_liked,
		  method: "POST",
		  data: { id : id_liked },
		  cache: false
	})
	.done(function( html ) {
			console.log('succes');
	    	$( ".identification" ).append( '<div data-alert class="flash-notice">Vote comptabilisé <a href="#" class="close">&times;</a></div>' );
	})
});
