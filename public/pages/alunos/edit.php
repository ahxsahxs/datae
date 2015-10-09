<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Edição de registro de Alunos</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<fieldset>
			<legend>Dados Pessoais</legend>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
						<span class="input-prepend"><i class="fa fa-2x fa-user"></i></span>
						<input type="text" placeholder="Nome" has="nome" value='<?= $aluno->getNome() ?>'>
					</div>
				</div>
			</div>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
						<span class="input-prepend">CPF</span>
						<input type="text" placeholder="CPF" class="cpf" has="cpf" value='<?= $aluno->getCpf() ?>'>
					</div>
				</div>
			</div>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
							<span class="input-prepend">RG</span>
						<input type="text" placeholder="RG" class='rg' has="rg" value='<?= $aluno->getRg() ?>'>
					</div>
				</div>
			</div>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
						<span class="input-prepend"><i class="fa fa-2x fa-calendar"></i></span>
						<input type="text" placeholder="Data de Nascimento" class='date' has="dataNascimento" value='<?= $aluno->getDataNascimento() ?>'>
					</div>
				</div>
			</div>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
						<span class="input-prepend"><i class="fa fa-2x fa-envelope"></i></span>
						<input type="text" placeholder="Email" has="email" value='<?= $aluno->getEmail() ?>'>
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend>Endereçamento</legend>
			<div class="units-row c">
				<div class="unit-100">
					<div class="input-groups">
						<span class="input-prepend">Endereço</span>
						<input type="text" placeholder="Endereço" has="endereco" value='<?= $aluno->getEndereco() ?>'>
					</div>
				</div>
			</div>
			<div class="units-row c units-padding">
				<div class="unit-20">
					<div class="input-groups">
						<span class="input-prepend">País</span>
						<select class='nivel pais' has='pais'>
							<option value="Brasil">Brasil</option>
						</select>
					</div>
				</div>
				<div class="unit-30">
					<div class="input-groups">
						<span class="input-prepend">Estado</span>
						<select class='nivel estado' has='estado'></select>
					</div>
				</div>
				<div class="unit-50">
					<div class="input-groups centered">
						<span class="input-prepend">Cidade</span>
						<select class='nivel cidade' has='cidade'></select>
					</div>
				</div>
			</div>
		</fieldset>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">Ciclo de Matrícula</span>
					<select class='nivel width-100' has='cicloId'>
						<?php
						foreach ($ciclos as $ciclo):
							$check = ($ciclo->id == $aluno->getCicloId()) ? 'selected' : '';
						?>
							<option <?= $check ?> value='<?= $ciclo->id ?>'><?= $ciclo->nome ?></option>;
				  <?php endforeach;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">Etnia</span>
					<select class='nivel width-100' has='etniaId'>
						<?php
						foreach ($etnias as $etnia):
							$check = ($etnia->id == $aluno->getEtniaId()) ? 'selected' : '';
						?>
							<option value='<?= $etnia->id ?>'><?= $etnia->etnia ?></option>;
				  <?php endforeach;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">Situação Socioeconômica</span>
					<select class='nivel width-100' has='situacaoId'>
						<?php
						foreach ($situacoes as $situacao):
							$check = ($situacao->id == $aluno->getSituacaoId()) ? 'selected' : '';
						?>
							<option value='<?= $situacao->id ?>'><?= $situacao->nome ?></option>;
				  <?php endforeach;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">Status</span>
					<select class='nivel width-100' has='statusId'>
						<?php
						foreach ($status as $status):
							$check = ($status->id == $aluno->getStatusId()) ? 'selected' : '';
						?>
							<option value='<?= $status->id ?>'><?= $status->nome ?></option>;
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