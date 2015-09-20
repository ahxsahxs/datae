<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Cadastro de Cursos</h3>
		</div>
	</div>
	<form id='formCadastro' action="api/Cursos/insert" method='post'>
		<div class="units-row">
			<div class="units-row c">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" placeholder="Identificação" has='identificador' class='required'>
				</div>
			</div>
		</div>
		<div class="units-row">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-file-pdf-o"></i>
					</span>
					<input type="file" name="file" id="file" data-tools="upload" data-url="api/Cursos/doc">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-university"></i>
					</span>
					<input type="text" placeholder="E-MEC" has='codigoEmec'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-calendar"></i>
					</span>
					<input type="text" class='date' placeholder="dataCriacao" has='dataCriacao'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						Tipo de Curso
					</span>
					<select class='nivel width-100' id='nivel' has='tipoId'>
						<?php
						foreach ($tipos as $tipo): ?>
							<option value='<?=$tipo->id ?>'><?= $tipo->nome ?></option>;
				  <?php endforeach;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						Modalidade
					</span>
					<select class='nivel width-100' id='nivel' has='modalidadeId'>
						<?php
						foreach ($modalidades as $modalidade): ?>
							<option value='<?= $modalidade->id ?>'><?= $modalidade->nome ?></option>;
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


