function datep(classe){
	classe = classe || '#formCadastro .date';
	$(classe).datepicker({
		dateFormat: "yy-mm-dd",
		dayNames: ["Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado"],
		dayNamesMin: ["Dom","Seg","Ter","Qua","Qui","Sex","Sab"],
		dayNamesShort: ["Dom","Seg","Ter","Qua","Qui","Sex","Sab"],
		maxDate: 0,
		monthNames: ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],
		monthNamesShort: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],
		showAnim: "slideDown",
		changeMonth: true,
		changeYear: true
	});
}
function valida(classe){
	classe = classe || '#formCadastro .units-row.c input,#formCadastro select';
	var inputs = $(classe);
	var erro= false;
	for(var i=0; i<inputs.length;i++){
		inputs[i] = $(inputs[i]);
		if(!inputs[i].hasClass('required')) continue;
		if(inputs[i].val().length<5){
			erro = true;
			inputs[i].addClass('input-error');
		}else{
			inputs[i].removeClass('input-error');
		}
	}
	return !erro;
}
function geraData(classe){
	classe = classe || '#formCadastro .units-row.c input,#formCadastro select';
	var inputs = $(classe);
	for(var i=0; i<inputs.length;i++)
		inputs[i] = $(inputs[i]);
	var data='{';
	for(var i=0; i<inputs.length;i++){
		data+= '"'+inputs[i].attr('has')+'" : "' +inputs[i].val()+'"';
		if(i!=inputs.length-1) data+=', ';
	}
	data += '}';
	return data;
}
function geraMsg(texto,cor,titulo){
	cor = cor || 'red';
	if(typeof(texto) == 'string'){
		var mes = $("<div></div>").addClass('tools-message').addClass('tools-message-'+cor)
		.html(texto).appendTo('body').message();
	}else{
		var erros = Object.keys(texto).map(function(k) { return texto[k]; });
		var men = titulo || "Por favor confira os seguintes erros:<br/>";
		for(var i = 0; i<erros.length; i++){
			men += erros[i]+"<br/>";
		}
		var mes = $("<div></div>").addClass('tools-message').addClass('tools-message-'+cor)
		.html(men).appendTo('body').message();
	}
	
	setTimeout(function(){mes.remove()},6*1000);
}
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