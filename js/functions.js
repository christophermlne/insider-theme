$('document').ready(function() {

	$('.post-content img').removeAttr("width").removeAttr("height");

	$('.post-content a').each(function(index){

		var $tempVar = $(this).html();

		if ($tempVar.str().toLowerCase().indexOf("http") >= 0) {

			$('body').append(
				$(this).html() + "<br />"
			);

		};

		

	});

});