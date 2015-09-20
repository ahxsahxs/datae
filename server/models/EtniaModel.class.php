<?php
/*
 * Classe de representação da tabela etnia, com setters e getters
 * para suas váriaveis
 */
class EtniaModel{
	private $id;
	private $etnia;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getEtnia(){
		return $this->etnia;
	}

	public function setEtnia($etnia){
		$this->etnia = $etnia;
	}

	public function valida(){
		$erros = null;
		if(strlen($this->getEtnia()) < 5)
			$erros['etnia'] = "O campo etnia deve conter pelo menos 5 caracteres";
		return $erros;
	}
}