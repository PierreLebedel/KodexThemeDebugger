(function( $ ) {
	'use strict';

	// CRON debugger
	$(document).ready(function(){
		if( $('#cron_tasks_table .countdown').length ){
			var cronInterval = setInterval(function(){
				$('#cron_tasks_table .countdown').each(function(index, elem){
					if( !$(elem).hasClass('stopped') ){
						var val = parseInt($(elem).text());
						var newVal = val-1;
						if(newVal<=0){
							$(elem).addClass('stopped').text(kodex_theme_debugger.translate.next_page_load);
						}else{
							$(elem).text(newVal+' '+kodex_theme_debugger.translate.seconds_left);
						}
					}
				});
			}, 1000);
		}

	});
		
})( jQuery );
