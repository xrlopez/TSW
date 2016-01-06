
<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/Pregunta.php");
 require_once(__DIR__."/../../model/PreguntaMapper.php");
 $view = ViewManager::getInstance();
 
 $errors = $view->getVariable("errors");
 $currentuser = $view->getVariable("currentusername");
 //$user = $view->getVariable("user");
 //$view->setVariable("title", "Modificar");
 
 $pregunta = $view->getVariable("pregunta");
 
 
?>

<div class="iniPreguntar row">
	<?= isset($errors["general"])?$errors["general"]:"" ?>
	<span class="titulo"><?= i18n("Question")?></span>
	<form class="formLogin col-md-12" name="login" method="post" action="index.php?controller=preguntas&amp;action=update">
		<div class="iniciarPreg col-xs-12 col-sm-12 col-md-12">
			<input type="hidden" name="preguntaId" value="<?=$pregunta->getId()?>"/>
			<h2><?= i18n("Question")?></h2><input type="text" name="pregunta" id="pregunta" value="<?= $pregunta->getTitulo()?>" required/>
			<h2><?= i18n("Description")?></h2><textarea name="descripcion" rows="7" cols="50"><?= $pregunta->getDescripcion()?></textarea>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h2><?= i18n("Categories")?></h2>
			<?php if(in_array("informatica", $pregunta->getCategoria())){ ?>
				<p><input type="checkbox" name="categorias[]" value="informatica" checked="cheked"><?= i18n("Computing")?></i></p>
			<?php } else{ ?>
				<p><input type="checkbox" name="categorias[]" value="informatica"><?= i18n("Computing")?></i></p>
			<?php } if(in_array("ocio", $pregunta->getCategoria())){ ?>
				<p><input type="checkbox" name="categorias[]" value="ocio" checked="cheked"><?= i18n("Leisure")?></i></p>
			<?php } else{ ?>
				<p><input type="checkbox" name="categorias[]" value="ocio"><?= i18n("Leisure")?></i></p>
			<?php } if(in_array("salud", $pregunta->getCategoria())){ ?>
				<p><input type="checkbox" name="categorias[]" value="salud" checked="cheked"><?= i18n("Health")?></i></p>
			<?php } else{ ?>
				<p><input type="checkbox" name="categorias[]" value="ocio"><?= i18n("Health")?></i></p>
				<?php } if(in_array("belleza", $pregunta->getCategoria())){ ?>
				<p><input type="checkbox" name="categorias[]" value="belleza" checked="cheked"><?= i18n("Beauty")?></i></p>
			<?php } else{ ?>
				<p><input type="checkbox" name="categorias[]" value="belleza"><?= i18n("Beauty")?></i></p>
				<?php } if(in_array("animales", $pregunta->getCategoria())){ ?>
				<p><input type="checkbox" name="categorias[]" value="animales" checked="cheked"><?= i18n("Animals")?></i></p>
			<?php } else{ ?>
				<p><input type="checkbox" name="categorias[]" value="animales"><?= i18n("Animals")?></i></p>
			<?php } ?>

		</div>
		<div class="botones_preguntar col-xs-12 col-sm-12 col-md-12">
			 <input type="submit" name="submit" value="<?= i18n("Modify")?>" class="cancel"/>
			 <input type="submit" name="submit" value="<?= i18n("Delete")?>" class="cancel"/>
			 <input type="submit" name="submit" value="<?= i18n("Cancel")?>" class="cancel"/>
		</div>
	</form>
</div>