<?php
/*
 * Classe de representação da tabela ciclo, com setters e getters
 * para suas váriaveis
 */
class CicloModel{
	private $id;
	private $nome;
	private $ingresso;
	private $cursoId;
	private $curso;

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

	public function getIngresso(){
		return $this->ingresso;
	}

	public function setIngresso($ingresso){
		$this->ingresso = $ingresso;
	}

	public function getCursoId(){
		return $this->cursoId;
	}

	public function setCursoId($cursoId){
		$this->cursoId = $cursoId;
	}

	public function getCurso(){
		return $this->curso;
	}

	public function setCurso($curso){
		$this->curso = $curso;
	}


	public function valida(){
    	$erros = null;
		if($this->getNome() == '' || strlen($this->getNome()) < 5)
			$erros['identificador'] = "O campo NOME deve ter pelo menos 5 caracteres";
		if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $this->getIngresso()))
			$erros['ingresso'] = "O campo INGRESSO deve conter uma data válida";
		return $erros;
    }
}