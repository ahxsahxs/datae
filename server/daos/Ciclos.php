<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela ciclo
 * 
 * OBS: ele chama o controller de Ciclo e a classe que manipula sessões
 */
require_once '../controllers/CicloController.class.php';
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
	// caso a ação seja de inserir novo Ciclo
	case 'insert':
		// cria um controller de Ciclo
		$controlCiclo = CicloController::getInstance();
		// cria um modelo de Ciclo com valores existentes no banco
		$modelCiclo = new CicloModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		// para cada valor do array edita os valores do modelo do Ciclo
		foreach ($dados as $campo => $valor)
			$modelCiclo->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Ciclo
		if($erro = $modelCiclo->valida()){
			print(json_encode($erro));
		}else{
			print $controlCiclo->insert($modelCiclo);
		}
		
		break;

	// caso a ação seja de editar um Ciclo existente
	case 'edit':
		// cria um controller de Ciclo
		$controlCiclo = CicloController::getInstance();
		// cria um modelo de Ciclo com valores existentes no banco
		$modelCiclo = $controlCiclo->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Ciclo
		foreach ($dados as $campo => $valor)
			$modelCiclo->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Ciclo
		if($erro = $modelCiclo->valida()){
			print(json_encode($erro));
		}else{
			if($controlCiclo->edit($modelCiclo)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Ciclo existente
	case 'delete':
		// cria um novo modelo de Ciclo
		$model = new CicloModel();
		// cria um novo controller de Ciclo
		$control = CicloController::getInstance();
		// define no modelo o id do Ciclo a ser deletado
		$model->setId($id);
		// deleta o Ciclo
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Ciclos existentes
	case 'list':
		// cria um novo controller de Ciclos
		$control = CicloController::getInstance();
		// busca no banco informações de todos os Ciclos
		$ciclos = $control->find([],0);
		if($ciclos == false) exit();
		// para cada Ciclo crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($ciclos as $ciclo) {
			$model = $control->fill($ciclo->id);
			?>
			<tr>
				<td><?= $model->getNome() ?></td>
				<td><?= $model->getIngresso() ?></td>
				<td><?= $model->getCurso()->getIdentificador() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Ciclos************* */ ?>

				<td>
					<a href="api/Ciclos/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="ciclos/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}