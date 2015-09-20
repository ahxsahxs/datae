<link rel="stylesheet" href="public/head/style.css">
<script>
function postLinks(){
	$('a.post').click(function(evt){
		evt.preventDefault();
		$.post(
			$(this).attr('href'),
			{},
			function(ret){
				$('#conteudo').html(ret);
			}
		);
	});
	$('a.logout').click(function(evt){
		evt.preventDefault();
		$.post(
			$(this).attr('href'),
			{},
			function(data){
				location.href = '/usuarios';
			}
		);
	});
}
$(function(){
	postLinks();
});
</script>
<div class="units-container extra-m-t">
	<div class="units-row units-split">
		<div class="unit-70 width-60" id='conteudo'></div>
		<div class="unit-20 unit-push-right text-centered" id='userInfo'>
			<h5>Seja bem vindo <span style='color: #CCC'><?= $session->getVars('nome') ?></span></h5>
			<span ><a href="api/Usuarios/logout" class='logout'>Sair</a></span>
		</div>
	</div>
</div>