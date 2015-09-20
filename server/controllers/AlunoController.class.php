<?php
/*
 * Este é controller específico para manejar a tabela aluno
*/

require_once 'Controller.class.php';
require_once 'SituacaoController.class.php';
require_once 'EtniaController.class.php';
require_once 'CicloController.class.php';
require_once $raiz.'/server/models/AlunoModel.class.php';

class AlunoController extends Controller{
	// a variável $instance guarda um Controller de Aluno
	private static $instance;

	// o construtor define que o nome da tabela é "aluno", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "aluno";
		$this->campos = ['id','cpf','rg','dataNascimento','naturalidade','filiacaoPai','filiacaoMae',
			'endereco','cidade','estado','pais','telefone','email','nome','cicloId','situacaoId','etniaId'];
		$this->camposInsert = ['cpf','rg','nome','dataNascimento','email','cicloId','etniaId','situacaoId'];
	}

	// o método getInstance() verfica se já existe um controller de Aluno,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new AlunoController();
		return self::$instance;
	}
		
	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		$control = self::getInstance();
		$dados = $control->find(['id'=>$id]);
		$model = new AlunoModel();

		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});
		
		$ciclo = CicloController::getInstance()->fill($model->getCicloId());
		$etnia = EtniaController::getInstance()->fill($model->getEtniaId());
		$situacao = SituacaoController::getInstance()->fill($model->getSituacaoId());

		$model->setCiclo($ciclo);
		$model->setEtnia($etnia);
		$model->setSituacao($situacao);

		return $model;
	}
}