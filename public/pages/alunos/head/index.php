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
function delStatus(){
	$('#tableStatus tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadStatus() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este Status?","Excluir Status",botoes);
	});
}




function reloadEtnias(link){
	if(link.substr(0,16) != "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#tableEtnias').html(ret);
			$('#tableEtnias .pagination a').click(function(evt){
				evt.preventDefault();
				reloadEtnias($(this).attr('href'));
			});
		}
	)
}
function reloadSituacoes(link){
	if(link.substr(0,16)!= "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#tableSituacoes').html(ret);
			$('#tableSituacoes .pagination a').click(function(evt){
				evt.preventDefault();
				reloadSituacoes($(this).attr('href'));
			});
		}
	)
}
function reloadStatus(link){
	if(link.substr(0,16)!= "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#tableStatus').html(ret);
			$('#tableStatus .pagination a').click(function(evt){
				evt.preventDefault();
				reloadStatus($(this).attr('href'));
			});
		}
	);
}
function reloadAlunos(link){
	if(link.substr(0,16)!= "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#tableAlunos').html(ret);
			$('#tableAlunos .pagination a').click(function(evt){
				evt.preventDefault();
				reloadAlunos($(this).attr('href'));
			});
		}
	)
}
$(function(){
	reloadEtnias('api/Buscas/busca/Etnia/1');
	reloadAlunos('api/Buscas/busca/Aluno/1');
	reloadSituacoes('api/Buscas/busca/Situacao/1');
	reloadStatus('api/Buscas/busca/Status/1');
});
</script>