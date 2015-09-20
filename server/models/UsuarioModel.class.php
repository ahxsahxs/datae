<?php
/*
 * Classe de representação da tabela usuario, com setters e getters
 * para suas váriaveis
 */
class UsuarioModel{
	private $id;
	private $nome;
	private $login;
	private $senha;
	private $nivel;
	private $email;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getLogin(){
		return $this->login;
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function getSenha(){
		return $this->senha;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}

	public function getNivel(){
		return $this->nivel;
	}

	public function setNivel($nivel){
		$this->nivel = $nivel;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function valida(){
		$erros = null;
		if($this->getNome() == '' || strlen($this->getNome()) < 5)
			$erros['nome'] = "O campo NOME deve ter pelo menos 5 caracteres";
		if($this->getLogin() == '' || strlen($this->getLogin()) < 5)
			$erros['login'] = "O campo LOGIN deve ter pelo menos 5 caracteres";
		if($this->getSenha() == '' || strlen($this->getSenha()) < 5)
			$erros['senha'] = "O campo SENHA deve ter pelo menos 5 caracteres";
		if($this->getEmail()!= '' && !filter_var($this->getEmail(),FILTER_VALIDATE_EMAIL))
			$erros['email'] = "O campo EMAIL deve conter um email valido";
		return $erros;
	}
}