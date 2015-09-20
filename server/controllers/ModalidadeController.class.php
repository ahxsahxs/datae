<?php
/*
 * Este é controller específico para manejar a tabela modalidade
*/

require_once 'Controller.class.php';
require_once $raiz.'/server/models/ModalidadeModel.class.php';

class ModalidadeController extends Controller{
	// a variável $instance guarda um Controller de Modalidade
	private static $instance;

	// o construtor define que o nome da tabela é "modalidade", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "modalidade";
		$this->campos = ['id','nome'];
		$this->camposInsert = ['nome'];
	}

	// o método getInstance() verfica se já existe um controller de Modalidade,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new ModalidadeController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Modalidade
		$controlModalidade = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $controlModalidade->find(['id'=>$id]);
		// cria um novo modelo de Modalidade
		$model = new ModalidadeModel();
		
		// para cada campo de  define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});
		
		return $model;
	}
}