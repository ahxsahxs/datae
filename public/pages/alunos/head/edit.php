<?php
	$id = $url->parametro(2);
	include_once 'server/controllers/AlunoController.class.php';
	include_once 'server/controllers/SituacaoController.class.php';
	include_once 'server/controllers/EtniaController.class.php';
	include_once 'server/controllers/CicloController.class.php';
	
	$aluno = AlunoController::getInstance()->fill($id);
	$situacoes = SituacaoController::getInstance()->find([],0);
	$ciclos = CicloController::getInstance()->find([],0);
	$etnias = EtniaController::getInstance()->find([],0);
?>
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" type="text/css" href="/public/pages/usuarios/head/style.css">

<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<script src='/public/anexos/externo/cidades-estados.js'></script>
<script src="/server/helpers/validaForm.js"></script>
<script>
$(function(){
	datep();
	$('.cpf').mask("999.999.999-99");
	new dgCidadesEstados({
		estado: $('.estado').get(0),
		cidade: $('.cidade').get(0),
		estadoVal: '<?= $aluno->getEstado() ?>',
		cidadeVal: '<?= $aluno->getCidade() ?>',
	});
	$('#formCadastro').submit(function(evt){
		evt.preventDefault();
		
		if(valida()){
			var data = geraData();
			$.post(
				'api/Alunos/edit/<?= $id ?>',
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