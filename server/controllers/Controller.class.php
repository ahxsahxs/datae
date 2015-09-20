<?php
/*
 * Um controller é um arquivo que faz utiliza a conexão com o banco
 * Esta classe ("Controller") representa um controller genérico, que pode inserir,
 * deletar, editar e buscar informações no banco.

OBS: a variável $raiz é definida aqui para que possa ser acessível em qualquer arquivos
que chame este.
*/

$raiz= $_SERVER['DOCUMENT_ROOT'];
require_once $raiz."/server/classes/Connection.class.php";
class Controller{
	// variáveis para guardar o nome da tabela, os campos que ela possui e quais campos
	// são utilizados fazer o primeiro registro no banco.
	protected $tableName;
	protected $campos;
	protected $camposInsert;
	
	// Cria uma string com o comando SQL que será utilizado
	protected function geraSQL($acao,$valores,$limit=1,$incl=' AND ',$type='='){
		$acao = strtolower($acao);
		$sql = '';
		switch ($acao){
			case 'insert':
				// se $acao == 'insert': $sql = "INSERT INTO $nomeTabela(coluna) VALUES(:coluna)"
				$sql = 'INSERT INTO '.($this->tableName).'(';
				foreach ($valores as $valor){
					if($valor == 'id')continue;
					$sql .= $valor.',';
				}
				$sql = substr($sql,0,-1).') VALUES(';
				foreach ($valores as $valor){
					if($valor == 'id')continue;
					$sql .= ':'.$valor.',';
				}
				$sql = substr($sql, 0, -1).')';
				break;
			case 'edit':
				// se $acao == 'edit': $sql = "UPDATE $nomeTabela SET coluna = :coluna WHERE id = :id"
				$sql = 'UPDATE '.($this->tableName).' SET ';
				foreach($valores as $coluna){
					if($coluna=='id') continue;
					$sql .= $coluna.'= :'.$coluna.',';
				}
				$sql = substr($sql, 0, -1).' WHERE id= :id';
				break;
			case 'delete':
				// se $acao == 'delete' $sql = "DELETE FROM $nomeTabela WHERE id = :id"
				$sql = 'DELETE FROM '.$this->tableName.' WHERE id= :id';
				break;
			case 'find':
				// se $acao == 'select' $sql = "SELECT * FROM $nomeTabela WHERE coluna =/LIKE :coluna"
				$sql = "SELECT * FROM ".$this->tableName." WHERE ";
				foreach($valores as $coluna=>$valor){
					$sql .= $coluna.' '.$type.' :'.$coluna.$incl;
				}
				$sql .= ' 1';
				if($limit>0) $sql.= ' LIMIT '. $limit;
				break;
		}
		return $sql;
	}

	// cria um novo registro no banco
	public function insert($model){
		$campos = $this->camposInsert;
		// cria um comando INSERT com os as colunas definidas em $camposInsert
		$sql = $this->geraSQL('insert', $campos);
		try {
			// cria uma instancia do banco e prepara um comando
			$pdo = Connection::getInstance()->prepare($sql);

			$vals = null;
			// define os valores de cada coluna
			foreach($campos as $valor)
				$vals[":$valor"] = $model->{'get'.ucfirst($valor)}();
			// executa o comando
			$pdo->execute($vals);

			// se houver erros retorne o texto do erro, caso contrário retorne o id que foi inserido
			if($pdo->errorInfo()[2] != false){
				return $pdo->errorInfo()[2];
			}else {
				return Connection::getInstance()->lastInsertId();
			}
		}catch (PDOException $ex){
			print $ex->getMessage();
		}
	}
	
	// faz uma busca no banco
	public function find($colunas,$limit=1,$incl = ' AND ',$type='='){
		// se o não for informado em quais colunas deseja fazer a consulta, retorne FALSO
		if(!is_array($colunas)) return false;

		// cria um comando sql para fazer a busca
		$sql = $this->geraSQL('find', $colunas,$limit,$incl,$type);

		// cria uma instancia do banco e prepara um comando
		$pdo = Connection::getInstance()->prepare($sql);

		// define os valores de cada coluna
		foreach($colunas as $coluna=>$valor)
			$pdo->bindValue(":{$coluna}",$valor);

		// executa o comando
		$pdo->execute();
		
		// retorna os valores obtidos na consulta
		if($limit==1) $resultado = $pdo->fetch(PDO::FETCH_OBJ);
		else $resultado = $pdo->fetchAll(PDO::FETCH_OBJ);
		
		return $resultado;
	}

	// recebe um modelo que representa um registro do banco, e deleta este registro
	public function delete($model){
		// define que o comando só utilizará o 'id' do registro
		$valores = ['id'];

		// cria um comando sql para fazer a exclusão
		$sql = $this->geraSQL('delete', $valores);

		// cria uma instancia do banco e prepara um comando		
		$pdo = Connection::getInstance()->prepare($sql);

		// define os valores de cada coluna
		foreach($valores as $valor)
			$pdo->bindValue(":$valor",$model->{'get'.ucfirst($valor)}());

		// executa o comando, se der certo retorna TRUE, se não, retorna FALSE
		return $pdo->execute();
	}

	// recebe um modelo que representa um registro do banco, e edita o registro que
	// possuir aquele 'id'
	public function edit($model){
		// define que o comando utilizará todos os campos do registro
		$valores = $this->campos;

		// cria um comando sql para fazer o UPDATE
		$sql = $this->geraSQL('edit', $valores);

		// cria uma instancia do banco e prepara um comando
		$pdo = Connection::getInstance()->prepare($sql);
		
		// define os valores de cada coluna
		foreach($valores as $valor)
			$pdo->bindValue(":$valor",$model->{'get'.ucfirst($valor)}());
		
		// executa o comando, se der certo retorna TRUE, se não, retorna FALSE
		return $pdo->execute();
	}

}