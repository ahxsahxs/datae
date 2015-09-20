<?php
/*
 * Este é o arquivo index do site, durante a navegação o usuário não sai dele.
 * As páginas são chamadas de acordo com a URL, por exemplo:
 * 		A URL 'datae.com/usuarios/novo' irá incluir o arquivo 'Datae/public/pages/usuarios/novo'
 * 		A URL 'datae.com/alunos/editar/1' irá incluir o arquivo 'Datae/public/pages/alunos/editar'
 * 			e passará o valor '1' como um parâmetro na classe URL
 * 
 * São definidas duas constantes, RAIZ para guardar o diretório raiz do site,
 * e SITE para guadar a url do SITE
 */
define('RAIZ',$_SERVER['DOCUMENT_ROOT']);
define('SITE',$_SERVER['SERVER_NAME']);

// chama os arquivos das classes URL e Session
require 'server/classes/Url.class.php';
require 'server/classes/Session.class.php';

// cria uma nova sessão e instancia o controle de URL
$session = new Session(true);
$url = new Url();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			// procura o arquivo 'headHTML.php', se ele existir o inclui
			$uri = requirePage('server/helpers/headHTML.php');
			include_once $uri;

			
			// procura o cabeçalho arquivo que é obtido pela URL, se ele existir & se
			// já existir um usuáro logado, o inclui
			$uri = 'public/pages/'.$url->controller().'/head/'.$url->action().'.php';
			$uri = requirePage($uri,'head/');
			include_once $uri;

		 ?>
	</head>
	<body>
		<?php
			// procura o arquivo de cabeçalho, se ele existir o inclui
			$uri = requirePage('public/header.php');
			include_once $uri;
			
			// procura o corpo do arquivo que é obtido pela URL, se ele existir & se
			// já existir um usuáro logado, o inclui
			$uri = 'public/pages/'.$url->controller().'/'.$url->action().'.php';
			$uri = requirePage($uri);
			include_once $uri;
			
			// procura o arquivo de rodapé, se ele existir o inclui
			$uri = requirePage('public/footer.php');
			include_once $uri;
		?>
	</body>
</html>
