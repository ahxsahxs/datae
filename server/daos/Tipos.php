<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela Tipo
 * 
 * OBS: ele chama o controller de Tipo e a classe que manipula sessões
 */
require_once '../controllers/TipoController.class.php';
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
	// caso a ação seja de inserir novo Tipo
	case 'insert':
		// cria um controller de Tipo
		$controlTipo = TipoController::getInstance();
		// cria um modelo de Tipo com valores existentes no banco
		$modelTipo = new TipoModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Tipo
		foreach ($dados as $campo => $valor)
			$modelTipo->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Tipo
		if($erro = $modelTipo->valida()){
			print(json_encode($erro));
		}else{
			if($controlTipo->insert($modelTipo)) print 1;
		}
		
		break;

	// caso a ação seja de editar um Tipo existente
	case 'edit':
		// cria um controller de Tipo
		$controlTipo = TipoController::getInstance();
		// cria um modelo de Tipo com valores existentes no banco
		$modelTipo = $controlTipo->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Tipo
		foreach ($dados as $campo => $valor)
			$modelTipo->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Tipo
		if($erro = $modelTipo->valida()){
			print(json_encode($erro));
		}else{
			if($controlTipo->edit($modelTipo)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Tipo existente
	case 'delete':
		// cria um novo modelo de Tipo
		$model = new TipoModel();
		// cria um novo controller de Tipo
		$control = TipoController::getInstance();
		// define no modelo o id do Tipo a ser deletado
		$model->setId($id);
		// deleta o Tipo
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Tipos existentes
	case 'list':
		// cria um novo controller de Tipos
		$control = TipoController::getInstance();
		// busca no banco informações de todos os Tipos
		$tipos = $control->find([],0);
		if($tipos == false) exit();
		// para cada Tipo crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($tipos as $tipo) {
			$model = $control->fill($tipo->id);
			?>
			<tr>
				<td><?= $model->getId() ?></td>
				<td><?= $model->getNome() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Tipos************* */ ?>

				<td>
					<a href="api/Tipos/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="tipos/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}