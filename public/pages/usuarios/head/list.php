<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script>
function delUser(){
	// Ao clicar no link de deletar Usuario
	$('#usersList tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		var dia = $("<div></div>");
		dia.html("<p></p>");
		dia.children('p').html('<span>Tem certeza que deseja excluir este usuário?</span>');
		dia.attr('title','Excluir usuario?');
		// crie um Dialog
		dia.dialog({
			resizable: false,
			height: 220,
			modal: true,
			buttons:{
				"Sim": function(){
					// requisição para o Dao para deletar o usuário
					$.get( link, {}, function(ret){
						if(ret==1)
							_reload()
						else
							var mes=$('<div></div>').html(ret).addClass('tools-message')
								.addClass('tools-message-red').appendTo('body')
								.message();
							setTimeout(function(){mes.remove()},2000);
					});
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		});
	});
}
function _reload(){
	$.post(
		'api/Usuarios/list',
		{},
		function(ret){
			$('#usersList tbody').html(ret);
			delUser();
		}
	);	
}
$(function(){
	_reload();
});
</script>