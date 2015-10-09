<!-- Cabeçalho do site -->

<header class="" id='header'>
	<div class="capa">
		<div class="container">
			<div class="logo unit-20 centered text-centered">
				<h4 class='end'>DataE</h4>
			</div>
			<div class="width-50 centered text-centered">
				<span class='desc'>DataE, sistema de Gerenciamento e Análise Estatística</span>
			</div>
		</div>
		<?php if($session->getVars('usuario')): ?>
		<div class="units-row">
			<nav id="menuHeader" class='navbar navbar-pills pills-blue unit-80'>
				<ul>
					<li><a href="usuarios/list">Usuários</a></li>
					<li><a href="cursos">Cursos</a></li>
					<li><a href="ciclos">Ciclos de Matrícula</a></li>
					<li><a href="alunos">Alunos</a></li>
					<li><a href="ferramentas/importar">Relatórios</a></li>
					<li>
						<form id='formBusca' action="ferramentas/busca" method="post">
							<input type="text" name='q' class="left">
							<button class="right"><i class="fa fa-2x fa-search"></i></button>
						</form>
					</li>
				</ul>
			</nav>
			<div class='unit-20'>
				<div>Seja bem vindo(a) <h4><?= $session->getVars('usuario')['nome'] ?></h4></div>
				<a href="api/Usuarios/logout" class='logout text-centered'>Sair</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</header>