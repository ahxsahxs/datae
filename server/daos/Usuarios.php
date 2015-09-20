<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela usuario
 * 
 * OBS: ele chama o controller de Usuario e a classe que manipula sessões
 */
require_once '../controllers/UsuarioController.class.php';
require_once '../classes/Session.class.php';
$session = new Session(true);

// verfica qual a ação a ser executada e qual o id a ser utlizado
$action = $_GET['action'];
if(isset($_GET['id'])) $id = $_GET['id'];
else if(isset($_POST['id'])) $id = $_POST['id'];

if($action != 'login'){
	if(!$u = $session->getVars('usuario')) exit("É necessário fazer login");
	if(($action =='insert' || $action =='edit' || $action =='delete') && $u['nivel']>=2)
		exit("Você não possui privilégios para essa operação");
}


switch ($action){
	// caso a ação seja de inserir novo Usuario
	case 'insert':
		// cria um controller de Usuario
		$controlUsuario = UsuarioController::getInstance();
		// cria um modelo de usuario com valores existentes no banco
		$modelUsuario = new UsuarioModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		$dados['senha'] = md5($dados['senha']);
		// para cada valor do array edita os valores do modelo do Usuario
		foreach ($dados as $campo => $valor)
			$modelUsuario->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Usuario
		if($erro = $modelUsuario->valida()){
			print(json_encode($erro));
		}else{
			if($controlUsuario->insert($modelUsuario)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Usuario existente
	case 'edit':
		// cria um controller de Usuario
		$controlUsuario = UsuarioController::getInstance();
		// cria um modelo de usuario com valores existentes no banco
		$modelUsuario = $controlUsuario->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Usuario
		foreach ($dados as $campo => $valor)
			$modelUsuario->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Usuario
		if($erro = $modelUsuario->valida()){
			print(json_encode($erro));
		}else{
			if($controlUsuario->edit($modelUsuario)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Usuario existente
	case 'delete':
		// cria um novo modelo de Usuario
		$model = new UsuarioModel();
		// cria um novo controller de Usuario
		$control = UsuarioController::getInstance();
		// define no modelo o id do usuario a ser deletado
		$model->setId($id);
		// deleta o usuario
		print ($control->delete($model));

		if($session->getVars('usuario')['id'] == $id) $session->destroy();
		break;

	case 'login':
		$login = $_POST['login']; $senha = md5($_POST['senha']);
		$controlUsuario = UsuarioController::getInstance();
		$user = $controlUsuario->autentica($login,$senha);
		if($user){
			$session->setVars(
				['usuario' => [
					'id'=>$user->getId(),
				 	'login'=>$user->getLogin(),
				 	'nome'=>$user->getNome(),
				 	'nivel'=>$user->getNivel()]
				]
			);
			print 1;
		}
		else print("Por favor, verifique suas credenciais e tente novamente");
		break;
	case 'logout':
		$session->destroy();
		break;
	// caso a ação seja de listar os Usuarios existentes
	case 'list':
		// cria um novo controller de usuarios
		$control = UsuarioController::getInstance();
		// busca no banco informações de todos os usuarios
		$usuarios = $control->find([],0);
		// para cada usuario crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($usuarios as $usuario) {
			$model = $control->fill($usuario->id);
			?>
			<tr>
				<td><?= $model->getNome() ?></td>
				<td><?= $model->getLogin() ?></td>
				<td><?= $model->getEmail() ?></td>
				<td><?= $model->getNivel() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de usuarios************* */ ?>

				<td>
					<a href="api/Usuarios/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="usuarios/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}