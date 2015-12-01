
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

<div class="registrar row">
	<div class="formLogin col-xs-12 col-sm-12 col-md-12">
		<h2>Datos de usuario</h2>
		<div>
			<form id="form-aceptar" action="index.php?controller=users&amp;action=update" method="post" >
				<div class="registrarse">
					<h2>Usuario</h2><input type="text" name="usuario" id="usuario" readonly = "readonly" value="<?= $user->getId()?>"/>														
					<h2>Nombre</h2><input type="text" name="nombre" id="nombre" value="<?= $user->getNombre()?>"/>
					<h2>Apellidos</h2><input type="text" name="apellidos" id="apellidos" value="<?= $user->getApellidos()?>"/>
					<h2>Correo</h2><input type="text" name="correo" id="correo" value="<?= $user->getCorreo()?>"/>
					<h2>Contraseña actual</h2><input type="password" name="passActual" id="passActual" required/>
					<h2>Contraseña nueva</h2><input type="password" name="passNueva" id="passNueva"/>
					<h2>Repetir contraseña nueva</h2><input type="password" name="passNew" id="passNew"/>
				</div>
				<div class="botones">
					<button type="submit" id="modificar">Aceptar</button>
				</div>	
					
			</form>
			
		</div>
	</div>
</div>

















