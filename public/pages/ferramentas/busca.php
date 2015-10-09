<div class="units-container">
	<div class="units-row">
		<div class="unit-80 centered">
			<h3 class="text-centered">Busca</h3>
		</div>
	</div>
	<div class="units-row units-padding">
		<div class="unit-20">
			<form action="api/Buscas/busca" id='menuBusca' method="post">
				<h4>Onde deseja realizar a consulta?</h4>
				<ul id='places'>
					<li>
						<label for="">
							<input checked type="checkbox" name='places[]' value="Usuario"><span>Usuários</span>
						</label>
					</li>
					<li>
						<label for="">
							<input checked type="checkbox" name='places[]' value="Curso"><span>Cursos</span>
						</label>
					</li>
					<li>
						<label for="">
							<input checked type="checkbox" name='places[]' value="Ciclo"><span>Ciclos de Matrícula</span>
						</label>
					</li>
					<li>
						<label for="">
							<input checked type="checkbox" name='places[]' value="Aluno"><span>Alunos</span>
						</label>
					</li>
				</ul>
				<hr>
				<h4>Termos de pesquisa:</h4>
				<input type="text" id='q' />
				<hr>
				<button class="btn btn-blue width-100">Consultar</button>
			</form>
		</div>
		<div class="unit-80" id='resultado'>
			<div id="users"></div>
			<div id="cursos"></div>
			<div id="ciclos"></div>
			<div id="alunos"></div>
		</div>
	</div>
</div>