<?php
/*
 * Este é controller específico para manejar a tabela etnia
*/

require_once 'Controller.class.php';
require_once $raiz.'/server/models/EtniaModel.class.php';

class EtniaController extends Controller{
	// a variável $instance guarda um Controller de Etnia
	private static $instance;

	// o construtor define que o nome da tabela é "etnia", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "etnia";
		$this->campos = ['id','etnia'];
		$this->camposInsert = ['etnia'];
	}

	// o método getInstance() verfica se já existe um controller de Etnia,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new EtniaController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Tipo
		$control = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $control->find(['id'=>$id]);
		if($dados == false) return false;
		// cria um novo modelo de 
		$model = new EtniaModel();

		// para cada campo de  define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});
		
		return $model;
	}
}