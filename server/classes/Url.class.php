<?php
/*
 * Esta classe ("Url") manipula a url passada ao navegador para criar variáveis,
 * por exemplo, utilizar a url "datae.com/usuarios/novo", irá definir a variável
 * $controller com o valor 'usuarios' e a variável $action com o valor 'novo'
*/
class Url
{
	protected $url = array();
    protected $controller;
    protected $action;

    // o construtor chama a função decode(), que define os valores passados pela URL
    public function __construct(){
        $this->decode();
	}

    // captura a URL utilizada (amarzenda em $_GET[r]) e separa utilizando a '/'
    public function decode(){
    	if(isset($_GET['r']))
    		$this->url = explode('/', $_GET['r']);
    	else
    		$this->url = array('');
    }

    // recebe um número indicando qual parametro da url está sendo procurado, se existir
    // retorna o valor dele
    public function parametro( $key ){
        if(array_key_exists($key, $this->url)){
        	return $this->url[$key];
        } else {
            return false;
        }
    }

    // se NÃO existir um valor no primeiro parametro da URL, define ele como 'index', e
    // retorna o valor
    public function controller(){
    	if($this->url[0] == null)
    		$this->controller = 'index';
    	else
    		$this->controller = $this->url[0];
    	
    	if(is_string($this->controller)){
    		return $this->controller;
    	}else return 'index';
    }

    // se NÃO existir um valor no segundo parametro da URL, define ele como 'index', e
    // retorna o valor
    public function action(){
    	if(isset($this->url[1]) && is_string($this->url[1]) && strlen($this->url[1])!=0){
    		$this->action = $this->url[1];
    	}else{
    		$this->action = 'index';
    	}
        
        return $this->action;
    }
}