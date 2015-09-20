<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src='/server/helpers/validaForm.js'></script>
<script>
function delCiclo(){
	$('#tableCiclos tbody a.del').click(function(evt){
		evt.preventDefault();
		var link = $(this).attr('href');
		botoes = {
				"Sim": function(){
					$.get( link, {}, function(ret){ reloadCiclos(); } );
					$(this).dialog('close');
				},
				"Não": function(){
					$(this).dialog('close');
				}
			}
		geraDialog("Tem certeza que deseja excluir este ciclo?","Excluir Ciclo",botoes);
	});
}
function reloadCiclos(){
	$.post(
		'api/Ciclos/list',
		{},
		function(ret){
			$('#tableCiclos tbody').html(ret);
			delCiclo();
		}
	);
}
$(function(){
	reloadCiclos();
});
</script>