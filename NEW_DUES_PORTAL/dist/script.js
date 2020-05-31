$(document).ready(function(){ 
	var touch 	= $('#resp-menu');
	var menu 	= $('.menu');
        var section     = $('.main-agile');
	$(touch).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
                section.toggle();
	});
	
	$(window).resize(function(){
		var w = $(window).width();
		if(w > 767 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
});