$(function(){
	$('#menuBusca').ajaxForm({
		success: function(ret){
			$('#resultado').html(ret);
		}
	});
});