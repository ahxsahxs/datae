<?php
/*
 * Este é controller específico para manejar a tabela curso
*/

require_once 'Controller.class.php';
require_once 'ModalidadeController.class.php';
require_once 'TipoController.class.php';
require_once $raiz.'/server/models/CursoModel.class.php';

class CursoController extends Controller{
	// a variável $instance guarda um Controller de Curso
	private static $instance;

	// o construtor define que o nome da tabela é "curso", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "curso";
		$this->campos = ['id','identificador','documentoAutorizacao','codigoEmec','dataCriacao','modalidadeId','tipoId'];
		$this->camposInsert = ['identificador','modalidadeId','tipoId','codigoEmec','dataCriacao'];
	}

	// o método getInstance() verfica se já existe um controller de Curso,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new CursoController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Curso
		$controlUsuario = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $controlUsuario->find(['id'=>$id]);
		if($dados == false) return false;
		// cria um novo modelo de Curso
		$model = new CursoModel();

		// para cada campo de  define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});

		if($model->getModalidadeId()!=null && $model->getTipoId()!= null){
				$modalidade = ModalidadeController::getInstance()->fill($model->getModalidadeId());
				$tipo = TipoController::getInstance()->fill($model->getTipoId());
		
				$model->setModalidade($modalidade);
				$model->setTipo($tipo);
			}
		
		return $model;
	}
}