jQuery(function($){
	
	$(document).ready(function() {
		
		if(!(cur_page_data.pagename == "home" || cur_page_data.pageid == 1)){
			$('.banner_inner_row').css('display','none');
			$('.banner_overlay').css('padding-bottom','2em');
		}
		
	});
	new WOW({ mobile: false }).init();
});
