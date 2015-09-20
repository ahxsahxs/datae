<?php
/*
 * Esta classe ("Session") manipula as váriaveis de sessão no navegador
*/
class Session{
	// $nVars representa a quantidade de váriaveis na sessão, $id representa o
	// identificador da sessão
	private $nVars;
	private $id;	
	
	// o construtor da classe recebe dois parâmetros, o primeiro informa se é
	// necessário criar uma sessão, o segundo informa as váriaveis a ser criadas
	public function __construct($inicia = FALSE, $vars = NULL){
		if($inicia){
			$this->start();
			if($vars!=null){
				$this->setVars($vars);
			}
		}
	}
	
	// define o número de variáveis
	private function setNVars(){
		$this->nVars = sizeOf($_SESSION);
	}
	
	// cria uma variável na sessão
	private function setVar($var,$value){
		$_SESSION["$var"] = $value;
		$this->setNVars();
	}
	
	// destrói uma variável da sessão
	private function unsetVar($var){
		unset($_SESSION["$var"]);
		$this->setNVars();
	}
	
	// verifica se uma determinada váriavel existe, se existir retorna o valor dela
	private function getVar($var){
		if(isset($_SESSION["$var"]))
			return $_SESSION["$var"];
		else return NULL;
	}
	
	// inicia uma sessão
	public function start(){
		session_start();
		$this->id = session_id();
		$this->setNVars();
	}
	
	// recebe um array com uma lista de nomes e valores a ser inseridas na sessão, por
	// exemplo, passar o array [nome=>'Fulano',senha=>'123'] irá criar as váriaveis
	// $_SESSION[nome] e $_SESSION[senha]
	public function setVars($var,$value=''){
		if(is_array($var)){
			foreach($var as $nome=>$valor)
				$this->setVar($nome,$valor);
		}else $this->setVar($var,$value);
	}
	
	// Destrói uma lista de váriaveis da sessão
	public function unsetVars($var){
		if(is_array($var)){
			foreach($var as $nome)
				$this->unsetVar($nome);
		}else
			$this->unsetVar($var);
	}
	
	// retorna os valores de uma lista de váriaveis da sessão
	public function getVars($var){
		if(is_array($var)){
			$res = [];
			foreach($var as $nome)
				$res[] = $this->getVar($nome);
		}else
			$res = $this->getVar($var);
		return $res;
	}
	
	// retorna o número de variáveis criadas na sessão
	public function getNVars(){
		return $this->nVars;
	}
	
	// retorna o identificador da sessão
	public function getId(){
		return $this->id;
	}
	
	// exibe todas as variáveis definidas na sessão
	public function printAll(){
		print '<p>';
		foreach ($_SESSION as $nome=>$valor)
			print "$nome => $valor<br/>";
		print '</p>';
	}
	
	// encerra a sessão
	public function destroy($inicia=FALSE){
		session_unset();
		session_destroy();
		$this->setNVars();
		if($inicia) $this->start();
	}
}

function requirePage($page,$loc = ''){
	$f = explode('/', $page);
	if(
		$f[0] == 'server' && $f[1] == 'helpers' ||
		$f[0] == 'public' && $f[1] == 'header.php' ||
		$f[0] == 'public' && $f[1] == 'footer.php'

	){
		if(file_exists($page)) return $page;
	}else{
		if (!isset($_SESSION['usuario'])) return 'public/pages/index/'.$loc.'login.php';
		else if(file_exists($page)) return $page;
		else return 'public/pages/index/'.$loc.'404.php';
	}	
}