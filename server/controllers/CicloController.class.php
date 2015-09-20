<?php
/*
 * Este é controller específico para manejar a tabela ciclo
*/

require_once 'Controller.class.php';
require_once 'CursoController.class.php';
require_once $raiz.'/server/models/CicloModel.class.php';

class CicloController extends Controller{
	// a variável $instance guarda um Controller de Ciclo
	private static $instance;

	// o construtor define que o nome da tabela é "ciclo", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "ciclo";
		$this->campos = ['id','nome','ingresso','cursoId'];
		$this->camposInsert = ['nome','ingresso','cursoId'];
	}

	// o método getInstance() verfica se já existe um controller de Ciclo,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new CicloController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Ciclo
		$controlUsuario = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $controlUsuario->find(['id'=>$id]);
		// cria um novo modelo de Ciclo
		$model = new CicloModel();

		// para cada campo de  define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});

		$curso = CursoController::getInstance()->fill($model->getCursoId());
		$model->setCurso($curso);
		
		return $model;
	}
}