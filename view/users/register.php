<?php 
 //file: view/users/register.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
?>
<div class="registrar row">
	<form class="formLogin col-md-12" name="register" action="index.php?controller=users&amp;action=register" method="post">
		<div class="registrarse">
			<h2>Usuario</h2><input type="text" name="usuario" id="usuario"/>
			<h2>Nombre</h2><input type="text" name="nombre" id="nombre"/>
			<h2>Apellidos</h2><input type="text" name="apellidos" id="apellidos"/>
			<h2>Correo</h2><input type="text" name="correo" id="correo"/>
			<h2>Contraseña</h2><input type="password" name="pass" id="pass"/>
			<h2>Confirmar contraseña</h2><input type="password" name="repass" id="repass"/>
		</div>
		<div class="botones">
			<button type="submit" id="register">Registrarse</button>
		</div>
	</form>
</div>