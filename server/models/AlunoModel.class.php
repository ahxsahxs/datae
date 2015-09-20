<?php
/*
 * Classe de representação da tabela aluno, com setters e getters
 * para suas váriaveis
 */
class AlunoModel{
	private $id;
	private $cpf;
	private $rg;
	private $dataNascimento;
	private $naturalidade;
	private $filiacaoPai;
	private $filiacaoMae;
	private $endereco;
	private $cidade;
	private $estado;
	private $pais;
	private $telefone;
	private $email;
	private $nome;
	private $cicloId;
	private $situacaoId;
	private $etniaId;
	private $ciclo;
	private $etnia;
	private $situacao;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCpf(){
		return $this->cpf;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function getRg(){
		return $this->rg;
	}

	public function setRg($rg){
		$this->rg = $rg;
	}

	public function getDataNascimento(){
		return $this->dataNascimento;
	}

	public function setDataNascimento($dataNascimento){
		$this->dataNascimento = $dataNascimento;
	}

	public function getNaturalidade(){
		return $this->naturalidade;
	}

	public function setNaturalidade($naturalidade){
		$this->naturalidade = $naturalidade;
	}

	public function getFiliacaoPai(){
		return $this->filiacaoPai;
	}

	public function setFiliacaoPai($filiacaoPai){
		$this->filiacaoPai = $filiacaoPai;
	}

	public function getFiliacaoMae(){
		return $this->filiacaoMae;
	}

	public function setFiliacaoMae($filiacaoMae){
		$this->filiacaoMae = $filiacaoMae;
	}

	public function getEndereco(){
		return $this->endereco;
	}

	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}

	public function getCidade(){
		return $this->cidade;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}

	public function getPais(){
		return $this->pais;
	}

	public function setPais($pais){
		$this->pais = $pais;
	}

	public function getTelefone(){
		return $this->telefone;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getCicloId(){
		return $this->cicloId;
	}

	public function setCicloId($cicloId){
		$this->cicloId = $cicloId;
	}

	public function getSituacaoId(){
		return $this->situacaoId;
	}

	public function setSituacaoId($situacaoId){
		$this->situacaoId = $situacaoId;
	}

	public function getEtniaId(){
		return $this->etniaId;
	}

	public function setEtniaId($etniaId){
		$this->etniaId = $etniaId;
	}

	public function getCiclo(){
		return $this->ciclo;
	}

	public function setCiclo($ciclo){
		$this->ciclo = $ciclo;
	}

	public function getEtnia(){
		return $this->etnia;
	}

	public function setEtnia($etnia){
		$this->etnia = $etnia;
	}

	public function getSituacao(){
		return $this->situacao;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}


	private function validaCampo($campo,$validacao,$restricao){
		if(!isset($this->{$campo})) return false;

		switch ($validacao) {
			case 'minLenght':
				if($this->{$campo} != '' && strlen($this->{$campo}) < $restricao)
					return false;
				else return true;
				break;
			
			case 'regex':
				if(preg_match($restricao, $this->{$campo})) return true;
				else return false;
			break;
		}
	}
	public function valida(){
		$erros = null;

		if($this->getCpf() != '' &&
			!preg_match("/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/", $this->getCpf()))
				$erros['cpf'] = "O campo CPF deve conter um dado válido";

		if($this->getRg() != '' && strlen($this->getRg()) < 5)
			$erros['rg'] = "O campo RG deve conter pelo menos 5 caracteres";

		if($this->getDataNascimento() != '' && !preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $this->getDataNascimento()))
			$erros['data'] = "O campo DATA DE NASCIMENTO deve conter um data válida";

		if($this->getNaturalidade() != '' && strlen($this->getNaturalidade()) < 5)
			$erros['naturalidade'] = "O campo NATURALIDADE deve conter pelo menos 5 caracteres";

		if($this->getFiliacaoMae() != '' && strlen($this->getFiliacaoMae()) < 5)
			$erros['filiacaoMae'] = "O campo FILIACAO MATERNA deve conter pelo menos 5 caracteres";

		if($this->getFiliacaoPai() != '' && strlen($this->getFiliacaoPai()) < 5)
			$erros['filiacaoPai'] = "O campo FILIACAO PATERNA deve conter pelo menos 5 caracteres";

		if($this->getEndereco() != '' && strlen($this->getEndereco()) < 5)
			$erros['endereco'] = "O campo ENDEREÇO deve conter pelo menos 5 caracteres";

		if($this->getCidade() != '' && strlen($this->getCidade()) < 5)
			$erros['cidade'] = "O campo CIDADE deve conter pelo menos 5 caracteres";

		if($this->getPais() != '' && strlen($this->getPais()) < 5)
			$erros['pais'] = "O campo PAIS deve conter pelo menos 5 caracteres";

		if($this->getTelefone() != '' && strlen($this->getTelefone()) < 5)
			$erros['telefone'] = "O campo TELEFONE deve conter pelo menos 5 caracteres";

		if($this->getNome() != '' && strlen($this->getNome()) < 5)
			$erros['nome'] = "O campo NOME deve conter pelo menos 5 caracteres";

		if($this->getEmail()!= '' && !filter_var($this->getEmail(),FILTER_VALIDATE_EMAIL))
			$erros['email'] = "O campo EMAIL deve conter um email valido";

		return $erros;
	}
}