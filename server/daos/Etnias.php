<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela Etnia
 * 
 * OBS: ele chama o controller de Etnia e a classe que manipula sessões
 */
require_once '../controllers/EtniaController.class.php';
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
	// caso a ação seja de inserir novo Etnia
	case 'insert':
		// cria um controller de Etnia
		$controlEtnia = EtniaController::getInstance();
		// cria um modelo de Etnia com valores existentes no banco
		$modelEtnia = new EtniaModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Etnia
		foreach ($dados as $campo => $valor)
			$modelEtnia->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Etnia
		if($erro = $modelEtnia->valida()){
			print(json_encode($erro));
		}else{
			if($controlEtnia->insert($modelEtnia)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Etnia existente
	case 'edit':
		// cria um controller de Etnia
		$controlEtnia = EtniaController::getInstance();
		// cria um modelo de Etnia com valores existentes no banco
		$modelEtnia = $controlEtnia->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Etnia
		foreach ($dados as $campo => $valor)
			$modelEtnia->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Etnia
		if($erro = $modelEtnia->valida()){
			print(json_encode($erro));
		}else{
			if($controlEtnia->edit($modelEtnia)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Etnia existente
	case 'delete':
		// cria um novo modelo de Etnia
		$model = new EtniaModel();
		// cria um novo controller de Etnia
		$control = EtniaController::getInstance();
		// define no modelo o id do Etnia a ser deletado
		$model->setId($id);
		// deleta o Etnia
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Etnias existentes
	case 'list':
		// cria um novo controller de Etnias
		$control = EtniaController::getInstance();
		// busca no banco informações de todos os Etnias
		$Etnias = $control->find([],0);
		if($Etnias == false) exit();
		// para cada Etnia crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($Etnias as $Etnia) {
			$model = $control->fill($Etnia->id);
			?>
			<tr>
				<td><?= $model->getId() ?></td>
				<td><?= $model->getEtnia() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Etnias************* */ ?>

				<td>
					<a href="api/Etnias/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="etnias/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}