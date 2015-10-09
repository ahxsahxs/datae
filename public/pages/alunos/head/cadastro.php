<?php
	include 'server/controllers/EtniaController.class.php';
	include 'server/controllers/SituacaoController.class.php';
	include 'server/controllers/CicloController.class.php';
	include 'server/controllers/StatusController.class.php';
	$etnias = EtniaController::getInstance()->find([],0);
	$situacoes = SituacaoController::getInstance()->find([],0);
	$ciclos = CicloController::getInstance()->find([],0);
	$status = StatusController::getInstance()->find([],0);
	
?>

<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" type="text/css" href="/public/pages/usuarios/head/style.css">

<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>

<script src='/public/anexos/externo/mask.min.js'></script>
<script src="/server/helpers/validaForm.js"></script>
<script>
$(function(){
	datep();
	$('.cpf').mask("999.999.999-99");
	$('#formCadastro').submit(function(evt){
		evt.preventDefault();
		
		if(valida()){
			var data = geraData();
			$.post(
				'api/Alunos/insert',
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