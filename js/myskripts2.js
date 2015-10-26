jQuery(document).ready(function() {

jQuery('#small a').click(function(eventObject) {
							 
	if(jQuery('#big img').attr('src') != jQuery(this).attr('href'))	
	{
	jQuery('#big img').hide().attr('src',jQuery(this).attr('href'));
	jQuery('#big img').load(function() {
			jQuery(this).fadeIn(2000);
			});
	};
	eventObject.preventDefault();
	
});


jQuery('#test').toggle(function(){
	jQuery('#gallery').slideDown(2000);
}, function(){
	jQuery('#gallery').slideUp(2000);
}

);

jQuery('#small a').click(function(){
jQuery('#small a').fadeTo(1, 1);	
jQuery(this).fadeTo(1, 0.5);							 
});



						   } );