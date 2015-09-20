<?php
/*
 * Classe de representação da tabela tipo, com setters e getters
 * para suas váriaveis
 */
class TipoModel{
	private $id;
	private $nome;

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

	public function valida(){
		$erros = null;
		if(strlen($this->getNome()) < 5)
			$erros['nome'] = "O campo NOME deve conter pelo menos 5 caracteres";
		return $erros;
	}
}