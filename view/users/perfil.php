
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

<div class="registrar row">
<div class="formLogin col-xs-12 col-sm-12 col-md-12">
    <h2>Datos de usuario</h2>
	    <div>
		    <div class="registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
			    	Usuario:  
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getId()?>  
		    	</div>
	    	</div>
	    	<div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		Nombre:
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getNombre()?>  
		    	</div>
	    	</div>
			<div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		Apellidos:
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getApellidos()?>  
		    	</div>
	    	</div>
		    <div class="row registrarse">
		    	<div class="col-xs-4 col-sm-4 col-md-4 info">
		    		Correo:  
		    	</div>
		    	<div class="col-xs-8 col-sm-8 col-md-8">
			    	<?= $user->getCorreo()?>  
		    	</div>
		    </div>
			
	    </div>
		<div class="botones">
			<form class="form col-md-12" name="perfil" action="index.php?controller=users&amp;action=modificar" method="post">
				<button type="submit" id="perfil">Modificar</button>
			</form>
		</div>
	    
    </div>
</div>
