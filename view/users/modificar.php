
<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/User.php");
 require_once(__DIR__."/../../model/UserMapper.php");
 $view = ViewManager::getInstance();
 
 $errors = $view->getVariable("errors");
 $currentuser = $view->getVariable("currentusername");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Modificar");
 
 
?>

<div class="iniPreguntar row">
	<div class="formLogin col-xs-6 col-sm-6 col-md-6">
		<span class="titulo"><?= i18n("User")?></span>
		<div>
			<form enctype="multipart/form-data" id="form-aceptar" action="index.php?controller=users&amp;action=update" method="post" >
				<div class="registrarse">
					<h2><?= i18n("Username")?></h2><input type="text" name="usuario" id="usuario" readonly = "readonly" value="<?= $user->getId()?>" required/>														
					<h2><?= i18n("Name")?></h2><input type="text" name="nombre" id="nombre" value="<?= $user->getNombre()?>" required/>
					<h2><?= i18n("Last name")?></h2><input type="text" name="apellidos" id="apellidos" value="<?= $user->getApellidos()?>" required/>
					<h2><?= i18n("Email")?></h2><input type="text" name="correo" id="correo" value="<?= $user->getCorreo()?>" required/>
					<h2><?= i18n("Image")?></h2><input type="file" name="img" id="img" />
					<h2><?= i18n("Current password")?></h2><input type="password" name="passActual" id="passActual" required/><span class="error"><?= isset($errors["passActual"])?$errors["passActual"]:"" ?></span>
					<h2><?= i18n("New password")?></h2><input type="password" name="passNueva" id="passNueva"/><span class="error"><?= isset($errors["pass"])?$errors["pass"]:"" ?></span>
					<h2><?= i18n("Confirm password")?></h2><input type="password" name="passNew" id="passNew"/>
				</div>
				<div class="botones">
					<button type="submit" id="modificar"><?= i18n("Accept")?></button>
				</div>	
					
			</form>
			
		</div>
	</div>
	<div class="formLogin col-xs-6 col-sm-6 col-md-6">
		<img class="imagen" src="imagenes/user_<?= $user->getImagen()?>" alt="imagenUser" width="300px">
	</div>
</div>

















