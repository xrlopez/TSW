<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 $currentuser = $view->getVariable("currentusername");
 $pregunta = $view->getVariable("pregunta");
 $respuestas = $view->getVariable("respuestas");
 
 $view->setVariable("title", "Preguntas");
 
?>
<div class="preguntas">
	<div class="question row">
		<div class="usuario col-xs-12 col-sm-12 col-md-12">
			<a href="#"><h1><img class="perfilP" src="images/perfil.png"><?=$pregunta->getUsuario()?></h1></a>

			<h2><?=$pregunta->getTitulo()?></h2>
		</div>
		<div class="textoR col-xs-12 col-sm-12 col-md-12">
			<h2><?=$pregunta->getDescripcion()?></h2>
			<h4><?=$pregunta->getFecha()?></h4>
		</div>
	</div>
	
</div>
<?php if($currentuser!=null){?>
	<div class="comentar" >
		<form action="index.php?controller=respuestas&amp;action=responder" method="post" >
			<input type="hidden" name="pregunta" value="<?=$pregunta->getId()?>"/>
			<input type="hidden" name="usuario" value="<?=$currentuser?>"/>
			<textarea name="coment" rows="7" cols="40">Escribe tu respuesta</textarea>
			<button type="submit" id="buttonComent">responder</button>
		</form>
	</div>
<?php }else{?>
	<div class="sinRegistrar" >
		<a href="index.php?controller=users&amp;action=login">Para comentar y votar tienes que iniciar sesion</a>
	</div>
<?php }?>

<?php foreach ($respuestas as $respuesta): ?>
	<div class="comentarios row">
		<div class="comentario col-xs-8 col-sm-8 col-md-8">
			<h4><?=$respuesta->getUsuario()?></h4>
			<h2><?=$respuesta->getDescripcion()?></h2>
		</div>
		<div class="numComentario col-xs-4 col-sm-4 col-md-4">
			<?php if($currentuser!=null){?>
				<form id="form-aceptar" action="index.php?controller=respuestas&amp;action=votar" method="post" >
					<input type="hidden" name="pregunta" value="<?=$pregunta->getId()?>"/>
					<input type="hidden" name="respuesta" value="<?=$respuesta->getId()?>"/>
					<button type="submit" class="votar" name="positivo"><?=$respuesta->getPositivos()?> <img src="images/like.png"/></button>
					<button type="submit" class="votar" name="negativo"><?=$respuesta->getNegativos()?><img src="images/nolike.png"/></button>
				</form>
			<?php }else{?>
				<button type="submit" class="votar" name="positivo"><?=$respuesta->getPositivos()?> <img src="images/like.png"/></button>
				<button type="submit" class="votar" name="negativo"><?=$respuesta->getNegativos()?><img src="images/nolike.png"/></button>
			<?php }?>
		</div>
	</div>
<?php endforeach; ?>