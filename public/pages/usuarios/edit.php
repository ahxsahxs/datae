<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Edição de Usuários</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input placeholder="Nome" has='nome' value="<?= $user->getNome() ?>" type='text'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input placeholder="Login" has='login' value="<?= $user->getLogin() ?>" type='text'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-envelope"></i>
					</span>
					<input type="text" class="senha" placeholder="Email" has='email'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						Nível
					</span>
					<select class='nivel width-100' id='nivel' has='nivel'>
						<?php
						$i = 1; $tipos = ['Administrador','Coordenador','Usuário externo'];
						foreach ($tipos as $tipo) {
							$check = '';
							if($i == $user->getNivel()) $check = 'selected';
							echo "<option $check value='$i'>$tipo</option>";
							$i++;
						}
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