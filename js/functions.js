$(function() {
	

	
	$('.menuBar  ul li:last-child').addClass('last');
	$('.menuBar  ul li:first-child').addClass('first');
	$('.menuBar  a.nav-btn').click(function(){
		$(this).closest('.menuBar').find('ul').stop(true,true).slideToggle()
		
		$(this).find('span').toggleClass('active')
		return false;
	})
});
