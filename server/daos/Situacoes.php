<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela Situacoes
 * 
 * OBS: ele chama o controller de Situacoes e a classe que manipula sessões
 */
require_once '../controllers/SituacaoController.class.php';
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
	// caso a ação seja de inserir novo Situacoes
	case 'insert':
		// cria um controller de Situacoes
		$controlSituacoes = SituacaoController::getInstance();
		// cria um modelo de Situacoes com valores existentes no banco
		$modelSituacoes = new SituacaoModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Situacoes
		foreach ($dados as $campo => $valor)
			$modelSituacoes->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Situacoes
		if($erro = $modelSituacoes->valida()){
			print(json_encode($erro));
		}else{
			if($controlSituacoes->insert($modelSituacoes)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Situacoes existente
	case 'edit':
		// cria um controller de Situacoes
		$controlSituacoes = SituacaoController::getInstance();
		// cria um modelo de Situacoes com valores existentes no banco
		$modelSituacoes = $controlSituacoes->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Situacoes
		foreach ($dados as $campo => $valor)
			$modelSituacoes->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Situacoes
		if($erro = $modelSituacoes->valida()){
			print(json_encode($erro));
		}else{
			if($controlSituacoes->edit($modelSituacoes)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Situacoes existente
	case 'delete':
		// cria um novo modelo de Situacoes
		$model = new SituacaoModel();
		// cria um novo controller de Situacoes
		$control = SituacaoController::getInstance();
		// define no modelo o id do Situacoes a ser deletado
		$model->setId($id);
		// deleta o Situacoes
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Situacoess existentes
	case 'list':
		// cria um novo controller de Situacoess
		$control = SituacaoController::getInstance();
		// busca no banco informações de todos os Situacoess
		$situacoes = $control->find([],0);
		if($situacoes == false) exit();
		// para cada Situacoes crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($situacoes as $situacao) {
			$model = $control->fill($situacao->id);
			?>
			<tr>
				<td><?= $model->getId() ?></td>
				<td><?= $model->getNome() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Situacoess************* */ ?>

				<td>
					<a href="api/Situacoes/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="situacoes/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}