<?php 
 //file: view/users/register.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
?>
<div class="registrar row">
	<form enctype="multipart/form-data" class="formLogin col-md-12" name="register" action="index.php?controller=users&amp;action=register" method="post">
		<div class="registrarse">
			<h2><?= i18n("Username")?></h2><input type="text" name="usuario" id="usuario" required />
			<?= isset($errors["usuario"])?$errors["usuario"]:"" ?>
			<?= isset($errors["username"])?$errors["username"]:"" ?>
			<h2><?= i18n("Name")?></h2><input type="text" name="nombre" id="nombre" required/>
			<h2><?= i18n("Last name")?></h2><input type="text" name="apellidos" id="apellidos" required/>
			<h2><?= i18n("Email")?></h2><input type="email" name="correo" id="correo" required/>
			<h2><?= i18n("Image")?></h2><input type="file" name="img" id="imagen" required/>
			<h2><?= i18n("Password")?></h2><input type="password" name="pass" id="pass" required/><?= isset($errors["pass"])?$errors["pass"]:"" ?>
			<?= isset($errors["passwd"])?$errors["passwd"]:"" ?>
			<h2><?= i18n("Confirm password")?></h2><input type="password" name="repass" id="repass" required/>
		</div>
		<div class="botones">
			<button type="submit" id="register"><?= i18n("Sign up")?></button>
		</div>
	</form>
</div>