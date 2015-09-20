<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela modalidade
 * 
 * OBS: ele chama o controller de Modalidade e a classe que manipula sessões
 */
require_once '../controllers/ModalidadeController.class.php';
require_once '../classes/Session.class.php';
$session = new Session(true);

// verfica qual a ação a ser executada e qual o id a ser utlizado
$action = $_GET['action'];
if(isset($_GET['id'])) $id = $_GET['id'];
else if(isset($_POST['id'])) $id = $_POST['id'];


if(!$u = $session->getVars('usuario')) exit("É necessário fazer login");
if(($action =='insert' || $action =='edit' || $action =='delete') && $u['nivel']<2)
	exit("Você não possui privilégios para essa operação");



switch ($action){
	// caso a ação seja de inserir novo Modalidade
	case 'insert':
		// cria um controller de Modalidade
		$controlModalidade = ModalidadeController::getInstance();
		// cria um modelo de Modalidade com valores existentes no banco
		$modelModalidade = new ModalidadeModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		// para cada valor do array edita os valores do modelo do Modalidade
		foreach ($dados as $campo => $valor)
			$modelModalidade->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Modalidade
		if($erro = $modelModalidade->valida()){
			print(json_encode($erro));
		}else{
			if($controlModalidade->insert($modelModalidade)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Modalidade existente
	case 'edit':
		// cria um controller de Modalidade
		$controlModalidade = ModalidadeController::getInstance();
		// cria um modelo de Modalidade com valores existentes no banco
		$modelModalidade = $controlModalidade->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Modalidade
		foreach ($dados as $campo => $valor)
			$modelModalidade->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Modalidade
		if($erro = $modelModalidade->valida()){
			print(json_encode($erro));
		}else{
			if($controlModalidade->edit($modelModalidade)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Modalidade existente
	case 'delete':
		// cria um novo modelo de Modalidade
		$model = new ModalidadeModel();
		// cria um novo controller de Modalidade
		$control = ModalidadeController::getInstance();
		// define no modelo o id do Modalidade a ser deletado
		$model->setId($id);
		// deleta o Modalidade
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Modalidades existentes
	case 'list':
		// cria um novo controller de Modalidades
		$control = ModalidadeController::getInstance();
		// busca no banco informações de todos os Modalidades
		$modalidades = $control->find([],0);
		// para cada Modalidade crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($modalidades as $modalidade) {
			$model = $control->fill($modalidade->id);
			?>
			<tr>
				<td><?= $model->getId() ?></td>
				<td><?= $model->getNome() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Modalidades************* */ ?>

				<td>
					<a href="api/Modalidades/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="modalidades/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}