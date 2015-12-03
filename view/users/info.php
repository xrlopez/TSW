<?php 
 //file: view/users/register.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $informacion = $view->getVariable("informacion");
?>
<div class="infoBusqueda">
	<div class="informacion row">
		<h2><?= i18n("Search results")?></h2>
			<?php if($informacion==null){?>
				<p><?= i18n("No information has been found")?></p>
			<?php } ?>
			<?php foreach ($informacion as $info): ?>
				<p><a href="index.php?controller=preguntas&amp;action=pregunta&amp;id=<?= $info->getId() ?>"><?= $info->getTitulo()?></a></p>
			<?php endforeach; ?>
	</div>
</div>