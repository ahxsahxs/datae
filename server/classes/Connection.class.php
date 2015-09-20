<?php
/*
 * Esta classe ("Connection") abre novas conexões com o banco de dados, utilizando a
 * classe PDO do PHP.
*/
class Connection{
	// a variável $entidade guarda a conexão com o banco
	static private $entidade;
	
	// o método getInstance verifica se já existe conexão com o banco, se sim ele 
	// retorna essa conexão, se não, ele cria uma nova.
	public static function getInstance(){
		try{
			// se não existir uma conexão crie uma
			if(self::$entidade == FALSE){
				// self::$entidade = new PDO("mysql:host=mysql.hostinger.com.br;dbname=u187097230_date",'u187097230_defau','bolinha17');
				self::$entidade = new PDO("mysql:host=localhost;dbname=datae2",'root','');
			}
			// retorne uma conexão
			return self::$entidade;
		}
		// se algo der errado imprima o erro na conexão
		catch (PDOException $ex){
			print $ex->getMessage();
		}
		
	}
}