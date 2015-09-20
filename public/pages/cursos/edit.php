<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Edição de Cursos</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row">
			<div class="units-row c">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" placeholder="Identificação" has='identificador' class='required' value="<?= $curso->getIdentificador() ?>">
				</div>
			</div>
		</div>
		<div class="units-row">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-file-pdf-o"></i>
					</span>
					<input type="file" name="file" id="file" data-tools="upload" data-url="api/Cursos/doc/<?= $id ?>">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-university"></i>
					</span>
					<input type="text" placeholder="E-MEC" has='codigoEmec'  value="<?= $curso->getCodigoEmec() ?>">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-calendar"></i>
					</span>
					<input type="text" class='date' placeholder="dataCriacao" has='dataCriacao'  value="<?= $curso->getDataCriacao() ?>">
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
						foreach ($tipos as $tipo):
							$check = ($curso->getTipoId == $tipo->id)? 'selected' : '';
						?>
							<option value='<?=$tipo->id ?>' <?= $check ?>><?= $tipo->nome ?></option>;
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
						foreach ($modalidades as $modalidade):
							$check = ($curso->getModalidadeId == $tipo->id)? 'selected' : '';
						?>
							<option value='<?= $modalidade->id ?>' <?= $check ?>><?= $modalidade->nome ?></option>;
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