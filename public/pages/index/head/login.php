<script src='/server/helpers/validaForm.js'></script>
<script>
$(function(){
	$('#formLogin .btnLogin').click(function(){
		var login = $('#formLogin .login').val();
		var senha = $('#formLogin .senha').val();
		$.post(
			'api/Usuarios/login',
			{login:login, senha:senha},
			function(data){
				if(data==1){
					location.href='usuarios/list'
				}else{
					geraMsg(data);
				}
			}
		)
	});
});
</script>