<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela Status
 * 
 * OBS: ele chama o controller de Status e a classe que manipula sessões
 */
require_once '../controllers/StatusController.class.php';
require_once '../classes/Session.class.php';
$session = new Session(true);

// verfica qual a ação a ser executada e qual o id a ser utlizado
$action = $_GET['action'];
if(isset($_GET['id'])) $id = $_GET['id'];
else if(isset($_POST['id'])) $id = $_POST['id'];

if(!$u = $session->getVars('usuario')) exit("É necessário fazer login");
if(($action =='insert' || $action =='edit' || $action =='delete') && $u['nivel']>2)
	exit("Você não possui privilégios para essa operação");

switch ($action){
	// caso a ação seja de inserir novo Status
	case 'insert':
		// cria um controller de Status
		$controlStatus = StatusController::getInstance();
		// cria um modelo de Status com valores existentes no banco
		$modelStatus = new StatusModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		// para cada valor do array edita os valores do modelo do Status
		foreach ($dados as $campo => $valor) {
			$modelStatus->{'set'.ucfirst($campo)}($valor);
		}
		// edita os valores do banco para o Status
		if($erro = $modelStatus->valida()){
			print(json_encode($erro));
		}else{
			if($controlStatus->insert($modelStatus)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Status existente
	case 'edit':
		// cria um controller de Status
		$controlStatus = StatusController::getInstance();
		// cria um modelo de Status com valores existentes no banco
		$modelStatus = $controlStatus->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Status
		foreach ($dados as $campo => $valor)
			$modelStatus->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Status
		if($erro = $modelStatus->valida()){
			print(json_encode($erro));
		}else{
			if($controlStatus->edit($modelStatus)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Status existente
	case 'delete':
		// cria um novo modelo de Status
		$model = new StatusModel();
		// cria um novo controller de Status
		$control = StatusController::getInstance();
		// define no modelo o id do Status a ser deletado
		$model->setId($id);
		// deleta o Status
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Statuss existentes
	case 'list':
		// cria um novo controller de Statuss
		$control = StatusController::getInstance();
		// busca no banco informações de todos os Statuss
		$status = $control->find([],0);
		if($status == false) exit();
		// para cada Status crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($status as $status) {
			$model = $control->fill($status->id);
			?>
			<tr>
				<td><?= $model->getId() ?></td>
				<td><?= $model->getNome() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Statuss************* */ ?>

				<td>
					<a href="api/Status/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="status/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}