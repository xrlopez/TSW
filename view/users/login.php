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
		<form class="formLogin col-md-12" name="login" action="index.php?controller=users&amp;action=login" method="post">
			<div class="iniciar_sesion">
				<h2><?= i18n("Username")?></h2><input type="text" id="username" name="username" required/>
				<h2><?= i18n("Password")?></h2><input type="password" id="passwd" name="passwd" required/>
			</div>
			<div class="botones">
				<a href="index.php?controller=users&amp;action=register"><?= i18n("Sign up")?></a>
				<button type="submit" id="login"><?= i18n("Log in")?></button>
			</div>
		</form>
	</div>
</div>