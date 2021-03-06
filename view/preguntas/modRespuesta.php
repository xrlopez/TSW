<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 $currentuser = $view->getVariable("currentusername");
 $pregunta = $view->getVariable("pregunta");
 $errors = $view->getVariable("errors");
 $respuesta = $view->getVariable("respuesta");
 $imagenes = $view->getVariable("imagenes");
 
 $view->setVariable("title", "Preguntas");
 
?>
<div class="preguntas">
	<div class="question row">
		<div class="usuario col-xs-12 col-sm-12 col-md-12">
			<h1><img class="perfilP" src="imagenes/user_<?=$imagenes[$respuesta->getUsuario()]?>"><?= $respuesta->getUsuario() ?></h1>

			<h2><?=$pregunta->getTitulo()?></h2>
		</div>
		<div class="textoR col-xs-12 col-sm-12 col-md-12">
			<h2><?=$pregunta->getDescripcion()?></h2>
			<h4><?php $date = new DateTime($pregunta->getFecha());
						echo $date->format('Y-m-d');?></h4>
		</div>
		<div class="texto col-xs-12 col-sm-12 col-md-12">
				<?php if($pregunta->getCategoria()!=NULL) { foreach ($pregunta->getCategoria() as $categoria):
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
				 endforeach; }?>
			</div>
	</div>
	
</div>
<?php if($currentuser!=null){?>
	<div class="comentar" >
		<form action="index.php?controller=respuestas&amp;action=update" method="post" >
			<input type="hidden" name="pregunta" value="<?=$pregunta->getId()?>"/>
			<input type="hidden" name="respuesta" value="<?=$respuesta->getId()?>"/>
			<?= isset($errors["comentario"])?$errors["comentario"]:"" ?>
			<textarea name="descripcion" rows="7" cols="40" required><?= $respuesta->getDescripcion()?></textarea>
			<div class="botones_preguntar col-xs-12 col-sm-12 col-md-12">
				<input type="submit" name="submit" value="<?= i18n("Modify")?>" class="cancel"/>
				<input type="submit" name="submit" value="<?= i18n("Delete")?>" class="cancel"/>
				<input type="submit" name="submit" value="<?= i18n("Cancel")?>" class="cancel"/>
			</div>
		</form>
	</div>
<?php } ?>