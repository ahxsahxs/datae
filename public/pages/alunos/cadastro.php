<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Cadastro de Alunos</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend"><i class="fa fa-2x fa-user"></i></span>
					<input type="text" placeholder="Nome" has="nome">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">CPF</span>
					<input type="text" placeholder="CPF" class="cpf" has="cpf">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">RG</span>
					<input type="text" placeholder="RG" class='rg' has="rg">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend"><i class="fa fa-2x fa-calendar"></i></span>
					<input type="text" placeholder="Data de Nascimento" class='date' has="dataNascimento">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend"><i class="fa fa-2x fa-envelope"></i></span>
					<input type="text" placeholder="Email" has="email">
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">Ciclo de Matrícula</span>
					<select class='nivel width-100' has='cicloId'>
						<?php
						foreach ($ciclos as $ciclo): ?>
							<option value='<?= $ciclo->id ?>'><?= $ciclo->nome ?></option>;
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
						foreach ($etnias as $etnia): ?>
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
						foreach ($situacoes as $situacao): ?>
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
						foreach ($status as $statu): ?>
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


