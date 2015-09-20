<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" type="text/css" href="/public/pages/usuarios/head/style.css">

<script src="/server/helpers/validaForm.js"></script>
<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script>
$(function(){
	datep();
	$('#formCadastro input[has="telefone"]').mask('(00) 0000-0000');

	$('#formCadastro').submit(function(evt){
		evt.preventDefault();
		
		if(valida()){
			var data = geraData();
			$.post(
				'api/Usuarios/insert',
				{data: data},
				function(ret){
					if(ret==1)
						location.href = 'usuarios/list';
					else
						if(ret[0] == '{')
						ret = JSON.parse(ret);
						geraMsg(ret);
				}
			);
		}
	});
});
</script>