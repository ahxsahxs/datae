<!-- Aqui está o cabeçalho do arquivo index.php do site, com os links para os scripts
	e folhas de estilos necessários para a visualização das interfaces
-->
<base href="http://<?= SITE ?>">
<title>DataE</title>
<meta name='viewport' content='width=device-width, initial-scale=1' />
<meta charset='utf-8' />

<link rel="stylesheet" href="public/anexos/externo/fontawesome/css/font-awesome.min.css" />
<link rel="stylesheet" href="public/anexos/externo/kube/css/kube.min.css" />
<link rel="stylesheet" href="public/anexos/index.css" />

<script src='public/anexos/externo/jquery.min.js' type="text/javascript"></script>
<script src='public/anexos/externo/mask.min.js' type="text/javascript"></script>
<script src='public/anexos/externo/kube/js/kube.min.js' type="text/javascript"></script>
<script src='public/anexos/index.js' type="text/javascript"></script>
<script>
	var controller = "<?= $url->controller() ?>";
</script>