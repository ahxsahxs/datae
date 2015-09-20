<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela aluno
 * 
 * OBS: ele chama o controller de Aluno e a classe que manipula sessões
 */
require_once '../controllers/AlunoController.class.php';
require_once '../classes/Session.class.php';

// verfica qual a ação a ser executada e qual o id a ser utlizado
$action = $_GET['action'];
if(isset($_GET['id'])) $id = $_GET['id'];
else if(isset($_POST['id'])) $id = $_POST['id'];

switch ($action){
	// caso a ação seja de inserir novo Aluno
	case 'insert':
		$controlAluno = AlunoController::getInstance();
		$modelAluno = new AlunoModel();

		$dados = json_decode($_POST['data'],true);
		
		foreach ($dados as $campo => $valor)
			$modelAluno->{'set'.ucfirst($campo)}($valor);


		if($erro = $modelAluno->valida()){
			print(json_encode($erro));
		}else{
			if($controlAluno->insert($modelAluno)) print 1;
		}

		break;
	// caso a ação seja de editar um Aluno existente
	case 'edit':
		$controlAluno = AlunoController::getInstance();
		$modelAluno = $controlAluno->fill($id);

		$dados = json_decode($_POST['data'],true);
		
		foreach ($dados as $campo => $valor)
			$modelAluno->{'set'.ucfirst($campo)}($valor);
		
		if($erro = $modelAluno->valida()){
			print(json_encode($erro));
		}else{
			if($controlAluno->edit($modelAluno)) print 1;
		}
		break;
	// caso a ação seja de deletar um Aluno existente
	case 'delete':
		// cria um novo modelo de Aluno
		$model = new AlunoModel();
		// cria um novo controller de Aluno
		$control = AlunoController::getInstance();
		// define no modelo o id do aluno a ser deletado
		$model->setId($id);
		// deleta o aluno
		print ($control->delete($model));
		break;
	// caso a ação seja de listar os Alunos existentes
	case 'list':
		// cria um novo controller de alunos
		$control = AlunoController::getInstance();
		// busca no banco informações de todos os alunos
		$alunos = $control->find([],0);
		// para cada aluno crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($alunos as $aluno) {
			$model = $control->fill($aluno->id);
			?>
			<tr>
				<td><?= $model->getNome() ?></td>
				<td><?= $model->getEmail() ?></td>
				<td><?= $model->getTelefone() ?></td>
				<td><?= $model->getCidade() ?></td>
				<td><?= $model->getSituacao()->getNome() ?></td>
				<td><?= $model->getEtnia()->getEtnia() ?></td>
				
<?php /* *******Aqui vão os links para edição e exclusão de alunos************* */ ?>

				<td>
					<a href="api/Alunos/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="alunos/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}