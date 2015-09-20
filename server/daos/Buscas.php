<?php

$action = $_GET['action'];

switch ($action) {
	case 'busca':
		$buscas = $_POST['places'];

		foreach ($buscas as $controller => $on) {
			include_once("../controllers/{$controller}Controller.class.php");
			$classe = $controller.'Controller';
			$control = $classe::getInstance();
			$models = $control->find([],0); ?>

			<div>
				<h3><?= $controller ?>s</h3>
				<ul>
		<?php
				foreach ($models as $model) {
					$controller = lcfirst($controller);
					if(isset($model->nome)) $n = $model->nome;
					if(isset($model->identificador)) $n = $model->identificador;
					if(isset($model->etnia)) $n = $model->etnia;
					echo "<li><a href='$controller/view/".$model->id."'>$n</a></li>";
				}
		?>
				</ul>
			</div>
<?php   }

		break;
}