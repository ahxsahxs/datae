<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src='/server/helpers/validaForm.js'></script>
<script>
function geraDialog(texto,titulo,botoes){
	var options = {
		resizable: false,
		height: 220,
		modal: true,
		buttons: botoes
	}
	var dia = $("<div></div>")
		.html("<p>"+texto+"</p>").attr('title',titulo)
		.dialog(options);
}
function delCurso(){
	$('#cursosList tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ location.reload() } );
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este curso?","Ecluir Curso",botoes)
		});
	});
}
function _reload(){
	$.post(
		'api/Cursos/list',
		{},
		function(ret){
			$('#cursosList tbody').html(ret);
			delCurso();
		}
	);
}
$(function(){
	_reload();
});
</script>