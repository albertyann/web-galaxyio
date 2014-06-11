$(function() {
	$('.flexslider').flexslider({    
		animation: "slide"  
	});


	$("#tabs li.tab section").hover(function(event) {
		var timeout = $(this).data("timeout");
		if (timeout) clearTimeout(timeout);
		if (event.type == 'mouseenter') {
			$(this).parent().siblings("li.tab").removeClass('hover');
			$(this).data("timeout", setTimeout($.proxy(function() {
				$(this).parent().addClass('hover');
				$(this).children("div").show();
			}, $(this)), 100));
		} else if (event.type == 'mouseleave') {
			$(this).data("timeout", setTimeout($.proxy(function() {
				$(this).parent().removeClass('hover');
				$(this).children("div").hide();
			}, $(this)), 100));
		}
	});

	$('div[dir="ltr"]').each(function(){
		if($(this).html().length == 0){
			$(this).html($(this).html() + '<br />');
		}
	})
});