<?php
/*
 * Este é controller específico para manejar a tabela usuario
*/

require_once 'Controller.class.php';
require_once $raiz.'/server/models/UsuarioModel.class.php';

class UsuarioController extends Controller{
	// a variável $instance guarda um Controller de Usuário
	private static $instance;

	// o construtor define que o nome da tabela é "usuario", e define quais
	// são os seus campos
	protected function __construct(){
		$this->tableName = "usuario";
		$this->campos = ['id','nome','login','senha','nivel','email'];
		$this->camposInsert = ['nome','login','senha','nivel','email'];
	}

	// o método getInstance() verfica se já existe um controller de Usuario,
	// se não existir cria um, e retorna ele.
	public static function getInstance(){
		if(self::$instance == FALSE)
			self::$instance = new UsuarioController();
		return self::$instance;
	}

	// 
	
	// o método autentica recebe um login e uma hash md5 de senha,
	// e então verifica se existe essa combinação no banco,
	// se existir cria uma sessão e define as variáveis 'login','nivel e 'nome'
	public function autentica($login,$senha){
		$user = $this->find(Array('login'=>$login,'senha'=>$senha));
		if($user){
			$user = $this->fill($user->id);
		}
		return $user;
	}

	// o método fill() recebe um identificador de um registro no banco,
	// e retorna um modelo com os valores existentes no banco
	public function fill($id){
		// cria um controller de Usuário
		$controlUsuario = self::getInstance();
		// procura os valores salvos no banco com este 'id'
		$dados = $controlUsuario->find(['id'=>$id],1);
		// cria um novo modelo de Usuário
		$model = new UsuarioModel();

		// para cada campo de usuario define o valor que está no banco
		foreach($this->campos as $coluna)
			$model->{'set'.ucfirst($coluna)}($dados->{$coluna});
		
		return $model;
	}
}