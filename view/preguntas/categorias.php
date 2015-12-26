<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 
?>
<div class="row">
		<?= isset($errors["general"])?$errors["general"]:"" ?>
		<h1 class="categorias"><?= i18n("Categories")?></h1>
		<div class="categorias col-xs-12 col-sm-12 col-md-5">
			<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=informatica">
			<p class="des"><?= i18n("Computing")?></p>
			</a>
		</div>
		<div class="categorias col-xs-12 col-sm-12 col-md-5">
			<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=ocio">
			<p class="des"><?= i18n("Leisure")?></p>
			</a>
		</div>
		<div class="categorias col-xs-12 col-sm-12 col-md-5">
			<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=salud">
			<p class="des"><?= i18n("Health")?></p>
			</a>
		</div>
		<div class="categorias col-xs-12 col-sm-12 col-md-5">
			<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=belleza">
			<p class="des"><?= i18n("Beauty")?></p>
			</a>
		</div>
		<div class="categorias col-xs-12 col-sm-12 col-md-5">
			<a href="index.php?controller=preguntas&amp;action=pregCatergorias&amp;categoria=animales">
			<p class="des"><?= i18n("Animals")?></p>
			</a>
		</div>
</div>