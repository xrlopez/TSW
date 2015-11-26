<?php 
 //file: view/users/login.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Iniciar Sesion");
 $errors = $view->getVariable("errors");
?>


<div class="row iniciarS">
	<div class="inicio col-xs-12 col-sm-12 col-md-12">
		<?= isset($errors["general"])?$errors["general"]:"" ?>
		<form class="formLogin col-md-12" name="login" action="index.php?controller=users&amp;action=login" method="POST">
			<div class="iniciar_sesion">
				<h2>Nombre</h2><input type="text" id="username"/>
				<h2>Contrase&#241;a</h2><input type="password" id="passwd"/>
			</div>
			<div class="botones">
				<a href="index.php?controller=users&amp;action=register">Registrarse</a>
				<button type="submit" id="login">Iniciar sesion</button>
			</div>
		</form>
	</div>
</div>