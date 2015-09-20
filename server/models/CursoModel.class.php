<?php
/*
 * Classe de representação da tabela curso, com setters e getters
 * para suas váriaveis
 */
class CursoModel{
	private $id;
	private $identificador = null;
    private $documentoAutorizacao = null;
    private $codigoEmec = null;
    private $dataCriacao = null;
    private $modalidadeId = null;
    private $tipoId = null;
    private $modalidade = null;
    private $tipo;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getIdentificador(){
		return $this->identificador;
	}

	public function setIdentificador($identificador){
		$this->identificador = $identificador;
	}

	public function getDocumentoAutorizacao(){
		return $this->documentoAutorizacao;
	}

	public function setDocumentoAutorizacao($documentoAutorizacao){
		$this->documentoAutorizacao = $documentoAutorizacao;
	}

	public function getCodigoEmec(){
		return $this->codigoEmec;
	}

	public function setCodigoEmec($codigoEmec){
		$this->codigoEmec = $codigoEmec;
	}

	public function getModalidadeId(){
		return $this->modalidadeId;
	}

	public function setModalidadeId($modalidadeId){
		$this->modalidadeId = $modalidadeId;
	}

	public function getTipoId(){
		return $this->tipoId;
	}

	public function setTipoId($tipoId){
		$this->tipoId = $tipoId;
	}

	public function getModalidade(){
		return $this->modalidade;
	}

	public function setModalidade($modalidade){
		$this->modalidade = $modalidade;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

    public function getDataCriacao(){
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao){
        $this->dataCriacao = $dataCriacao;
    }

    public function valida(){
    	$erros = null;
		if($this->getIdentificador() == '' || strlen($this->getIdentificador()) < 5)
			$erros['identificador'] = "O campo IDENTIFIÇÃO deve ter pelo menos 5 caracteres";
		// if(file_exists($this->getDocumentoAutorizacao()))
		// 	$erros['documento'] = "O documento de autorizacao não existe";
		// if(preg_match('/^([0-9]{4})$/', $this->getDataCriacao()))
		// 	$erros['data'] = "O campo DATA DE CRIAÇÃO deve conter um ano";
		return $erros;
    }
}