<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/RespuestaMapper.php");
 $view = ViewManager::getInstance();
 
 $currentuser = $view->getVariable("currentusername");
 $pregunta = $view->getVariable("pregunta");
 $respuestas = $view->getVariable("respuestas");
 
 
?>
<div class="iniPreguntar row">
	<form class="formLogin col-md-12" name="login" method="post" action="index.php?controller=preguntas&amp;action=preguntar">
		<div class="iniciarPreg col-xs-12 col-sm-12 col-md-12">
			<input type="hidden" name="usuario" value="<?= $currentuser?>"/>
			<h2>Pregunta</h2><input type="text" id="pregunta" name="pregunta" required/>
			<h2>Descripción</h2><textarea name="descripcion" rows="7" cols="50" required>Describe tu pregunta</textarea>
		</div>
		<div class="botones_preguntar col-xs-12 col-sm-12 col-md-12">
			<button type="submit" name="submit" id="login">Preguntar</button>
			<button type="submit" id="login">Cancelar</button>
		</div>
	</form>
</div>