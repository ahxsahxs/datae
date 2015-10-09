function _submit(){
	inputs = $('input[name="places[]"]');
	arr = [];
	var termo = $('input#q').val();
	$.each(inputs,function(key,val){
		if($(val).prop('checked')){
			arr.push(val.value);
			switch(val.value){
				case "Usuario":
					reloadUsers("api/Buscas/busca/Usuario/1/"+termo);
					break;
				case "Curso":
					reloadCursos("api/Buscas/busca/Curso/1/"+termo);
					break;
				case "Ciclo":
					reloadCiclos("api/Buscas/busca/Ciclo/1/"+termo);
					break;
				case "Aluno":
					reloadAlunos("api/Buscas/busca/Aluno/1/"+termo);
					break;
			}
		}
	});
}

function reloadUsers(link){
	if(link.substr(0,16) != "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#users').html(ret);
			$('#users .pagination a').click(function(evt){
				evt.preventDefault();
				reloadUsers($(this).attr('href')+'/'+$('#q').val());
			});
		}
	)
}
function reloadCursos(link){
	if(link.substr(0,16)!= "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#cursos').html(ret);
			$('#cursos .pagination a').click(function(evt){
				evt.preventDefault();
				reloadCursos($(this).attr('href')+'/'+$('#q').val());
			});
		}
	)
}
function reloadCiclos(link){
	if(link.substr(0,16)!= "api/Buscas/busca" ) return false;
	$.get(
		link,
		{},
		function(ret){
			$('#ciclos').html(ret);
			$('#ciclos .pagination a').click(function(evt){
				evt.preventDefault();
				reloadCiclos($(this).attr('href')+'/'+$('#q').val());
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
			$('#alunos').html(ret);
			$('#alunos .pagination a').click(function(evt){
				evt.preventDefault();
				reloadAlunos($(this).attr('href')+'/'+$('#q').val());
			});
		}
	)
}
$(function(){
	$('#menuBusca').submit(function(evt){
		evt.preventDefault();
		_submit();
	});	
});