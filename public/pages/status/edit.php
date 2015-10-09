<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Edição de Status</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row">
			<div class="units-row c">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" placeholder="Nome" has='nome' class='required' value="<?= $status->getNome() ?>">
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