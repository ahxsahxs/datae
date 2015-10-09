<?php
include 'server/controllers/AlunoController.class.php';

$ciclo = $url->parametro(2);

$s = StatusController::getInstance()->find([],0); $status = array();
foreach($s as $st) $status[$st->nome] = $st->id;

$s = CicloController::getInstance()->find([],0); $ciclos = array();
foreach($s as $st) $ciclos[$st->nome] = $st->id;

$control = AlunoController::getInstance();
$total = $control->count([],0);
$concluidos = $control->count(array(
		'statusId'=>$status['CONCLUÍDO'],
		'cicloId'=>$ciclos[$ciclo]
),0);
$curso = $control->count(array(
		'statusId'=>$status['EM CURSO'],
		'cicloId'=>$ciclos[$ciclo]
),0);
$integralizados = $control->count(array(
		'statusId'=>$status['INTEGRALIZADO'],
		'cicloId'=>$ciclos[$ciclo]
),0);

?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
<script>
$(function(){
	var data = {
		labels: ['Concluidos','Em Curso','Integralizados','Total'],
		datasets: [
			{
				label: "Alunos que concluiram",
				fillColor: 'rgba(0,191,48,.7)',
				strokeColor: 'rgba(96,191,48,.7)',
				highlightFill: 'rgba(0,191,48,.9)',
				highlightStroke: 'rgba(96,191,48,.9)',
				data: [<?= 100*$concluidos/$total ?>,<?= 100*$curso/$total ?>,<?= 100*$integralizados/$total ?>,<?= 100*$total/$total ?>]
			}
		]
	}
	var ctx = document.getElementById('chart1').getContext('2d');
	var chart = new Chart(ctx).Bar(data);
});
</script>