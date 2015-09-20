<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src='/server/helpers/validaForm.js'></script>
<script>
function delAluno(){
	$('#tableAlunos tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadAlunos() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este Aluno?","Excluir Aluno",botoes);
	});
}
function delEtnia(){
	$('#tableEtnias tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadEtnias() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir esta etnia?","Excluir Etnia",botoes);
	});
}
function delSituacao(){
	$('#tableSituacoes tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadSituacoes() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir esta Situacao Socioeconomica?","Excluir Situacao",botoes);
	});
}
function reloadAlunos(){
	$.post(
		'api/Alunos/list',
		{},
		function(ret){
			$('#tableAlunos tbody').html(ret);
			delAluno();
		}
	);
}
function reloadSituacoes(){
	$.post(
		'api/Situacoes/list',
		{},
		function(ret){
			$('#tableSituacoes tbody').html(ret);
			delSituacao();
		}
	);
}
function reloadEtnias(){
	$.post(
		'api/Etnias/list',
		{},
		function(ret){
			$('#tableEtnias tbody').html(ret);
			delEtnia();
		}
	);
}
$(function(){
	reloadEtnias();
	reloadAlunos();
	reloadSituacoes();
});
</script>