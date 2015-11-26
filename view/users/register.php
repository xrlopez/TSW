<?php 
 //file: view/users/register.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
?>
<div class="registrar row">
	<form class="formLogin col-md-12" name="login" method="post" action="#">
		<div class="registrarse">
			<h2>Usuario</h2><input type="text" id="usuario"/>
			<h2>Nombre</h2><input type="text" id="usuario"/>
			<h2>Correo</h2><input type="text" id="usuario"/>
			<h2>Contrase&#241;a</h2><input type="password" id="contraseña"/>
			<h2>Confirmar contrase&#241;a</h2><input type="password" id="contraseña"/>
		</div>
		<div class="botones">
			<button type="submit" id="login">Registrarse</button>
		</div>
	</form>
</div>