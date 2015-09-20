$(function(){
	$('#menuHeader a[href*="'+controller+'"]').addClass('active');
	// $('#formBusca').hover(function(){
	// 	$(this).children('input').show(400);
	// },function(){
	// 	$(this).children('input').hide(400);
	// });
	$('a.logout').click(function(evt){
		evt.preventDefault();
		$.post(
			$(this).attr('href'),
			{},
			function(ret){
				location.href=''
			}
		)
	});
});