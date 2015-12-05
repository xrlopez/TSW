<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 

 $preguntas = $view->getVariable("preguntas");

 
 $preguntasUsuario = $view->getVariable("preguntasUsuario");
 
 $view->setVariable("title", "Preguntas");
 
?>
<?php foreach ($preguntasUsuario as $pregunta): ?>
	<div class="preguntas">
		<div class="pregunta row">
			<div class="usuario col-xs-6 col-sm-6 col-md-8">
					<h1><img class="perfilP" src="images/perfil.png"><?= $pregunta->getUsuario() ?></h1>
			</div>
			<div class="respuestas col-xs-6 col-sm-6 col-md-4">
					<h2><?= $pregunta->getnumRespuestas()?></h2>
					<h2><?= i18n("Answers")?></h2>
			</div>
			<div class="texto col-xs-12 col-sm-12 col-md-12">
				<a href="index.php?controller=preguntas&amp;action=pregunta&amp;id=<?= $pregunta->getId() ?>"><h2><?= $pregunta->getDescripcion() ?></h2></a>
				<h3><?php $date = new DateTime($pregunta->getFecha());
					echo $date->format('Y-m-d');?></h3>
			</div>
		</div>
	</div>
<?php endforeach; ?>
