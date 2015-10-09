<?php
$action = $_GET['action'];
$controller = ucfirst($_GET['controller']);
$page = $_GET['page'];
$termo = isset($_GET['termo'])? $_GET['termo'] : null;
switch ($action) {
	case 'busca':
		include_once "../controllers/".$controller."Controller.class.php";
		$classe = $controller.'Controller';
		$low = lcfirst($controller);
		if($low == 'situacao') $low = 'situacoes';
		$control = $classe::getInstance();

		$limit = $page ==1 ? "0, 10" : (($page-1)*10).", 10";
		
		
		$n = array();
		if($termo != '' && ($controller=='Usuario' || $controller=='Aluno')) $n["nome"] = $termo;
		else if($termo != '') $n["identificador"] = $termo;

		$total = $control->count([]);

		$models = $control->find($n,$limit," OR ", "like");
?>

		<div>
			<h3><?= $controller ?></h3>
<?php
			if(sizeof($models)==0) echo "<li>Não há registros nesta categoria</li>";
			foreach ($models as $model) {
				if(isset($model->nome)) $n = $model->nome;
				else if(isset($model->etnia)) $n = $model->etnia;
				else if(isset($model->identificador)) $n = $model->identificador; ?>
				<table>
					<tr>
						<td><?= $n ?></td>
						<td>
							<a href="api/<?= $controller ?>/delete/<?= $model->id ?>" class='del'><i class="fa fa-2x fa-trash-o"></i></a>
							<a href="<?= $low ?>/edit/<?= $model->id ?>"><i class="fa fa-2x fa-pencil"></i></a>
						</td>	
					</tr>
				</table>
			<?php
			}
?>
			<ul class="pagination">
				<li><a href="api/Buscas/busca/<?= $controller ?>/1">&larr;</a></li>
				<?php
				for ($i=1; $i <= ((int)($total/10))+1; $i++) { ?>
					<li><a href="api/Buscas/busca/<?= $controller ?>/<?= $i ?>"><?= $i ?></a></li>
				<?php }
				$j = ((int)($total/10))+1;
				?>
				<li><a href="api/Buscas/busca/<?= $controller ?>/<?= $j ?>">&rarr;</a></li>
			</ul>
		</div>
<?php
	break;
}