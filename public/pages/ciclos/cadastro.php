<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Cadastro de Ciclos de Matrícula</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row">
			<div class="units-row c">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" placeholder="Nome" has='nome' class='required'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-calendar"></i>
					</span>
					<input type="text" class='date' placeholder="Data de Ingresso" has='ingresso'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						Curso
					</span>
					<select class='nivel width-100' has='cursoId'>
						<?php
						foreach ($cursos as $curso): ?>
							<option value='<?= $curso->id ?>'><?= $curso->identificador ?></option>;
				  <?php endforeach;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="units-row">
			<div class="unit-100">
				<input type='submit' class="btn btn-outline btn-blue width-100" value='Cadastrar'>
			</div>
		</div>
	</form>
</div>


