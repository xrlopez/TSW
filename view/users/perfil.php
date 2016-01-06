
<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
 require_once(__DIR__."/../../model/User.php");
 require_once(__DIR__."/../../model/UserMapper.php");
 $view = ViewManager::getInstance();
 
 $errors = $view->getVariable("errors");
 $currentuser = $view->getVariable("currentusername");
 $user = $view->getVariable("user");
  $view->setVariable("title", "Perfil");
 
 
?>

<div class="iniPreguntar row">
<div class="formLogin col-xs-6 col-sm-6 col-md-6">
    <span class="titulo"><?= i18n("User")?></span>
	    <div>
		    <div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
			    	<?= i18n("Username")?>:  
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getId()?>  
		    	</div>
	    	</div>
	    	<div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		<?= i18n("Name")?>:
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getNombre()?>  
		    	</div>
	    	</div>
			<div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		<?= i18n("Last name")?>:
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getApellidos()?>  
		    	</div>
	    	</div>
		    <div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		<?= i18n("Email")?>:  
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getCorreo()?>  
		    	</div>
		    </div>
			
	    </div>
		<div class="botones">
			<form class="form col-md-12" name="perfil" action="index.php?controller=users&amp;action=modificar" method="post">
				<button type="submit" id="perfil"><?= i18n("Modify")?></button>
			</form>
			<form id="form-eliminar" class="form col-md-12" action="index.php?controller=users&amp;action=eliminar" method="post">
				
				<p id="bot"><a href="#" onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('form-eliminar').submit()}"><?= i18n("Delete")?></a></p>
		 	</form>
		</div>
	    
    </div class="formLogin col-xs-6 col-sm-6 col-md-6">
		<img class="imagen" src="imagenes/user_<?= $user->getImagen()?>" alt="imagenUser" width="300px">
	<div>
	</div>
</div>
