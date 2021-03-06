<?php
	include 'server/controllers/ModalidadeController.class.php';
	include 'server/controllers/TipoController.class.php';
	$tipos = TipoController::getInstance()->find([],0);
	$modalidades = ModalidadeController::getInstance()->find([],0);
?>

<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.min.css">
<link rel="stylesheet" href="/public/anexos/externo/jquery-ui/jquery-ui.theme.min.css">
<link rel="stylesheet" href="/public/pages/usuarios/head/style.css">

<script src='/public/anexos/externo/jquery-ui/jquery-ui.min.js'></script>
<!-- <script src='/public/anexos/externo/jquery.form.min.js'></script> -->
<script src="/server/helpers/validaForm.js"></script>
<script>
id = -1;
$(function(){
	datep();

	$('#formCadastro').submit(function(evt){
		evt.preventDefault();
		
		if(valida()){
			var data = geraData();
			if(id != -1) var link = 'api/Cursos/edit/'+id;
			else var link = 'api/Cursos/insert';
			$.post(
				link,
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
	$("#file").on('success.tools.upload',function(ret){
		geraMsg(ret.msg,'green',' ');
		location.href = 'cursos/edit/'+ret.id;
	});
});
</script>