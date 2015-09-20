<?php
/*
 * Este é controller específico para manejar a tabela situacao
*/

require_once 'Controller.class.php';
require_once $raiz.'/server/models/SituacaoModel.class.php';

class SituacaoController extends Controller{
	// a variável $instance guarda um Controller de Situacao
	private static $instance;

	// o construtor define que o nome da tabela é "situacao", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "situacao";
		$this->campos = ['id','nome'];
		$this->camposInsert = ['nome'];
	}

	// o método getInstance() verfica se já existe um controller de Situacao,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new SituacaoController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Situacao
		$controlUsuario = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $controlUsuario->find(['id'=>$id]);
		// cria um novo modelo de Situacao
		$model = new SituacaoModel();

		// para cada campo de  define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});
		
		return $model;
	}
}