<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 $preguntas = $view->getVariable("preguntas");
 
 $view->setVariable("title", "Preguntas");
 
?>
<?php foreach ($preguntas as $pregunta): ?>
	<div class="preguntas">
		<div class="pregunta row">
			<div class="usuario col-xs-6 col-sm-6 col-md-8">
				<a href="#">
					<h1><img class="perfilP" src="images/perfil.png"><?= $pregunta->getUsuario() ?></h1>
				</a>
			</div>
			<div class="respuestas col-xs-6 col-sm-6 col-md-4">
					<h2><?= $pregunta->getnumRespuestas()?></h2>
					<h2>respuestas</h2>
			</div>
			<div class="texto col-xs-12 col-sm-12 col-md-12">
				<a href="index.php?controller=preguntas&amp;action=pregunta&amp;id=<?= $pregunta->getId() ?>"><h2><?= $pregunta->getDescripcion() ?></h2></a>
				<h3><?= $pregunta->getFecha() ?></h3>
			</div>
		</div>
	</div>
<?php endforeach; ?>