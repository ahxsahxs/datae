<div class="units-container width-60 centered">
	<div class="units-row">
		<div class="unit-100">
			<h3>Cadastro de Usuários</h3>
		</div>
	</div>
	<form id='formCadastro' action="">
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" class="nome" placeholder="Nome" has='nome' class='required'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-user"></i>
					</span>
					<input type="text" placeholder="Login" has='login' class='required'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-lock"></i>
					</span>
					<input type="password" placeholder="Senha" has='senha' class='required'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						<i class="fa fa-2x fa-envelope"></i>
					</span>
					<input type="text" placeholder="Email" has='email'>
				</div>
			</div>
		</div>
		<div class="units-row c">
			<div class="unit-100">
				<div class="input-groups">
					<span class="input-prepend">
						Nível
					</span>
					<select class='width-100' id='nivel' has='nivel'>
						<?php
						$i = 1; $tipos = ['Administrador','Coordenador','Usuário externo'];
						foreach ($tipos as $tipo) {
							echo "<option value='$i'>$tipo</option>";
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


