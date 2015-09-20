<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src='/server/helpers/validaForm.js'></script>
<script>
function delCurso(){
	$('#tableCursos tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadCursos() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este curso?","Excluir Curso",botoes);
	});
}
function delTipo(){
	$('#tableTipos tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadTipos() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este tipo de curso?","Excluir Tipo",botoes);
	});
}
function delModalidade(){
	$('#tableModalidades tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadModalidades() } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir esta modalidade de curso?","Excluir Modalidade",botoes);
	});
}
function reloadCursos(){
	$.post(
		'api/Cursos/list',
		{},
		function(ret){
			$('#tableCursos tbody').html(ret);
			delCurso();
		}
	);
}
function reloadModalidades(){
	$.post(
		'api/Modalidades/list',
		{},
		function(ret){
			$('#tableModalidades tbody').html(ret);
			delModalidade();
		}
	);
}
function reloadTipos(){
	$.post(
		'api/Tipos/list',
		{},
		function(ret){
			$('#tableTipos tbody').html(ret);
			delTipo();
		}
	);
}
$(function(){
	reloadTipos();
	reloadCursos();
	reloadModalidades();
});
</script>