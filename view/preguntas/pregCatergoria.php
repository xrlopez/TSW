<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 $numPreguntas = $view->getVariable("numPreguntas");
 $numPagina = $view->getVariable("num_pagina");
 $preguntas = $view->getVariable("preguntas");
 $categoria = $view->getVariable("categoria");
 $pregFin = $view->getVariable("fin");
 $pregInicio = $view->getVariable("inicio");
 $imagenes = $view->getVariable("imagenes");
 $paginas = ceil($numPreguntas/5);
 
 $view->setVariable("title", "Preguntas");
 
?>
<?php
	switch ($categoria) {
		    case "informatica":?>
				<h1 class="categorias"><?= i18n("Computing")?></h1><?php
				break;
			case "ocio":?>
				<h1 class="categorias"><?= i18n("Leisure")?></h1><?php
				break;
			case "salud":?>
				<h1 class="categorias"><?= i18n("Health")?></h1><?php
				break;
			case "belleza":?>
				<h1 class="categorias"><?= i18n("Beauty")?></h1><?php
				break;
			case "animales":?>
				<h1 class="categorias"><?= i18n("Animals")?></h1><?php
				break;
	}

?>
<?php foreach ($preguntas as $pregunta): ?>
	<div class="preguntas">
		<div class="pregunta row">
			<div class="usuario col-xs-6 col-sm-6 col-md-8">
					<h1><img class="perfilP" src="imagenes/user_<?=$imagenes[$pregunta->getUsuario()]?>"><?= $pregunta->getUsuario() ?></h1>
			</div>
			<div class="respuestas col-xs-6 col-sm-6 col-md-4">
					<h2><?= $pregunta->getnumRespuestas()?></h2>
					<h2><?= i18n("Answers")?></h2>
			</div>
			<div class="texto col-xs-12 col-sm-12 col-md-12">
				<a href="index.php?controller=preguntas&amp;action=pregunta&amp;id=<?= $pregunta->getId() ?>"><h2><?= $pregunta->getTitulo() ?></h2></a>
				<h3><?php $date = new DateTime($pregunta->getFecha());
						echo $date->format('Y-m-d');?></h3>
			</div>
			<?php if($pregunta->getCategoria()!=NULL) { ?>
			<div class="texto col-xs-12 col-sm-12 col-md-12">
				<?php foreach ($pregunta->getCategoria() as $categoria):
					switch ($categoria) {
						    case "informatica":?>
								<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=informatica" class="cat">
									<?= i18n("Computing")?></a><?php
								break;
							case "ocio":?>
								<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=ocio" class="cat">
									<?= i18n("Leisure")?></a><?php
								break;
							case "salud":?>
								<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=salud" class="cat">
									<?= i18n("Health")?></a><?php
								break;
							case "belleza":?>
								<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=belleza" class="cat"><?= i18n("Beauty")?></a><?php
								break;
							case "animales":?>
								<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=animales" class="cat">
									<?= i18n("Animals")?></a><?php
								break;
					}
				 endforeach; ?>
			</div>
			<?php } ?>
		</div>
	</div>
<?php endforeach; ?>
<div>
	<ul class="masP" title="paginacion" role="navegacion">

		<?php if ($numPagina == 1 ) { ?>
				<li class="optionPeqSin" title="anterior"><?= i18n("Previous")?></li>
		<?php }else { ?>
				<li class="optionPeq" title="anterior"><a href="index.php?controller=preguntas&amp;action=pageCat&amp;page=<?= $numPagina-1 ?>&amp;categoria=<?=$categoria ?>"><?= i18n("Previous")?></a>
		<?php } ?>
		
		<?php for ($i=1; $i < $paginas+1 ; $i++) { 
				if ($i == $numPagina) { ?>
					<li class="option_sele"><?php echo $i?></li>
				<?php }else{ ?>
					<li class="option"><a href="index.php?controller=preguntas&amp;action=pageCat&amp;page=<?= $i ?>&amp;categoria=<?=$categoria ?>"><?php echo $i?></a></li>
				<?php } ?>	
		<?php } ?>
		<?php if ($numPagina == $paginas ) { ?>
				<li class="optionPeqSin" title="siguiente"><?= i18n("Following")?></li>
		<?php }else { ?>
				<li class="optionPeq" title="siguiente"><a href="index.php?controller=preguntas&amp;action=pageCat&amp;page=<?= $numPagina+1 ?>&amp;categoria=<?=$categoria ?>"><?= i18n("Following")?></a>
		<?php } ?>
	</ul>
</div>