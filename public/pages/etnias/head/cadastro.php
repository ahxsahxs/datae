<link rel="stylesheet" type="text/css" href="/public/pages/usuarios/head/style.css">

<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src="/server/helpers/validaForm.js"></script>
<script>
$(function(){
	datep();
	$('#formCadastro').submit(function(evt){
		evt.preventDefault();
		
		if(valida()){
			var data = geraData();
			$.post(
				'api/Etnias/insert',
				{data: data},
				function(ret){
					if(ret==1)
						location.href = 'alunos';
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