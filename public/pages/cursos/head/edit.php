<?php
	$id = $url->parametro(2);
	include 'server/controllers/CursoController.class.php';
	$tipos = TipoController::getInstance()->find([],0);
	$modalidades = ModalidadeController::getInstance()->find([],0);
	$control = CursoController::getInstance();
	$curso = $control->fill($id);
?>
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
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
				'api/Cursos/edit/<?= $id ?>',
				{data: data},
				function(ret){
					if(ret==1)
						location.href = 'cursos';
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