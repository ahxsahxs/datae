<?php
/*
 * Este arquivo contém o DAO para o manejo da tabela curso
 * 
 * OBS: ele chama o controller de Curso e a classe que manipula sessões
 */
require_once '../controllers/CursoController.class.php';
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
	// caso a ação seja de inserir novo Curso
	case 'insert':
		print_r($_POST);
		// cria um controller de Curso
		$controlCurso = CursoController::getInstance();
		// cria um modelo de Curso com valores existentes no banco
		$modelCurso = new CursoModel();

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Curso
		foreach ($dados as $campo => $valor)
			$modelCurso->{'set'.ucfirst($campo)}($valor);

		// edita os valores do banco para o Curso
		if($erro = $modelCurso->valida()){
			print(json_encode($erro));
		}else{
			if($controlCurso->insert($modelCurso)) print 1;
		}
		
		break;

	case 'doc':
		require_once "../classes/Upload.class.php";
		$file = new Upload($_FILES['file']);
		if($file->uploaded){
			$r = $_SERVER['DOCUMENT_ROOT'];

			$control = CursoController::getInstance();
			$model = new CursoModel();
			if(!isset($id))
				$id = $control->insert($model);

			$file->file_overwrite = true;
			$file->allowed = array('application/pdf','aplication/msword');
			$file->file_new_name_body = "docCurso".$id;
			$file->Process($r.'/public/uploads/');
			if($file->processed){
				$ret['msg'] = "Upload Concluido";
				$ret['id'] = $id;
				$model->setId($id);
				$model->setDocumentoAutorizacao($r.'/public/uploads/docCurso'.$id);
				$control->edit($model);
			}else{
				$ret['msg'] = $file->error;
				$ret['id'] = -1;
				$model->setId($id);
				$control->delete($model);
			}
		}
		$file->Clean();
		print json_encode($ret);
		break;

	case 'getDoc':
		require_once "../classes/Upload.class.php";
		$link = $_SERVER['DOCUMENT_ROOT'].'/public/uploads/docCurso'.$id.'.pdf';
		$file = new Upload($link);
		header("Content-type: ".$file->file_src_mime);
		echo $file->Process();
		break;

	// caso a ação seja de editar um Curso existente
	case 'edit':
		// cria um controller de Curso
		$controlCurso = CursoController::getInstance();
		// cria um modelo de Curso com valores existentes no banco
		$modelCurso = $controlCurso->fill($id);

		// captura o json passado por POST e o transforma em um array
		$dados = json_decode($_POST['data'],true);
		
		// para cada valor do array edita os valores do modelo do Curso
		foreach ($dados as $campo => $valor)
			$modelCurso->{'set'.ucfirst($campo)}($valor);
		
		// edita os valores do banco para o Curso
		if($erro = $modelCurso->valida()){
			print(json_encode($erro));
		}else{
			if($controlCurso->edit($modelCurso)) print 1;
		}
		
		break;

	// caso a ação seja de deletar um Curso existente
	case 'delete':
		// cria um novo modelo de Curso
		$model = new CursoModel();
		// cria um novo controller de Curso
		$control = CursoController::getInstance();
		// define no modelo o id do Curso a ser deletado
		$model->setId($id);
		// deleta o Curso
		print ($control->delete($model));
		break;

	// caso a ação seja de listar os Cursos existentes
	case 'list':
		// cria um novo controller de Cursos
		$control = CursoController::getInstance();
		// busca no banco informações de todos os Cursos
		$cursos = $control->find([],0);
		// para cada Curso crie um modelo usando o seu id e imprima seus valores em colunas de uma tabela
		foreach ($cursos as $curso) {
			$model = $control->fill($curso->id);
			?>
			<tr>
				<td><?= $model->getIdentificador() ?></td>
				<td><a href="api/Cursos/getDoc/<?= $model->getId() ?>">
					<i class="fa fa-2x fa-file-pdf-o"></i></a>
				</td>
				<td><?= $model->getCodigoEmec() ?></td>
				<td><?= $model->getModalidade()->getNome() ?></td>
				<td><?= $model->getTipo()->getNome() ?></td>
<?php /* *******Aqui vão os links para edição e exclusão de Cursos************* */ ?>

				<td>
					<a href="api/Cursos/delete/<?= $model->getId() ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
					<a href="cursos/edit/<?= $model->getId() ?>"><i class="fa fa-2x fa-pencil"></i></a>
				</td>
			</tr>
<?php 	}
}