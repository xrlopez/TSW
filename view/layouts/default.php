<?php
 //file: view/layouts/default.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="images/icono.ico" type="image/x-icon" rel="icon"></link>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<title>Spurask</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>    
    <div id="container" class="container">
  		<div id="header" class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<?php if($currentuser == ""){ ?>
					<ul id="menu">
					  <li>
						<a class="home" href="index.php"><img src="images/home.png" alt="logo" height="25" width="25"></a>
					  </li>
					  <li >
						<form action="index.php?controller=users&amp;action=buscarInfo" method="post" >
							<input type="search" id="busqueda" name="busqueda" size="30" placeholder="<?= i18n("Search")?>">
							<button type="submit" name="submit" id="buttonBusqueda"><?= i18n("Search")?></button>
						</form>
					  </li>
					  <li class="option"><a href="index.php?controller=preguntas&amp;action=preguntar"><?= i18n("Ask")?></a></li>
					  <li class="option"><a href="index.php?controller=users&amp;action=login"><?= i18n("Log in")?></a></li>
					  <li class="flag"><a href="index.php?controller=language&amp;action=change&amp;lang=en"><img src="images/england_flag.png" alt="logo" ></a>
					  	<a href="index.php?controller=language&amp;action=change&amp;lang=es"><img src="images/bandera_espana.png" alt="logo"></a></li>
					</ul> 
				<?php }else{ ?>
					<ul id="menu">
					  <li>
						<a class="home" href="index.php"><img src="images/home.png" alt="logo" height="25" width="25"></a>
					  </li>
					  <li >
						<form id="form-aceptar" action="index.php?controller=users&amp;action=buscarInfo" method="post" >
							<input type="search" id="busqueda" name="busqueda" size="30" placeholder="<?= i18n("Search")?>">
							<button type="submit" name="submit" id="buttonBusqueda"><?= i18n("Search")?></button>
						</form>
					  </li>
					  <li class="option"><a href="index.php?controller=preguntas&amp;action=preguntar"><?= i18n("Ask")?></a></li>
					  <li class="option"><a href="index.php?controller=users&amp;action=perfil"><?= i18n("Profile")?></a></li>
					  <li class="option"><a href="index.php?controller=users&amp;action=logout"><?= i18n("Log out")?></a></li>
					  <li class="flag"><a href="index.php?controller=language&amp;action=change&amp;lang=en"><img src="images/england_flag.png" alt="logo" ></a></li>
					  <li class="flag"><a href="index.php?controller=language&amp;action=change&amp;lang=es"><img src="images/bandera_espana.png" alt="logo"></a></li>
					</ul> 
				<?php } ?>	
			</div>	
			<div id="logo" class="col-xs-12 col-sm-12 col-md-8">
				<img class="imgLogo" src="images/letras_sombreado.png" alt="logo" height="59" width="380">
			</div> 
		</div>
		<div class="row">
			<div id="main" class="col-xs-12 col-sm-12 col-md-8">
				<?= $view->popFlash() ?>
				<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>  
			</div>
			<div id="news" class="col-xs-12 col-sm-12 col-md-4">
				<ul class="colMas">						
					<li><h2><?= i18n("Top questions")?></h2></li>
					<li class="preg"><a href="pregunta.html">Soy una persona?</a></li>
					<li class="preg"><a href="pregunta.html">Cual es el sentido de la vida?</a></li>
					<li class="preg"><a href="pregunta.html">Que son los caminantes blancos?</a></li>
					<li class="preg"><a href="pregunta.html">A que esperas?</a></li>
					<li class="preg"><a href="pregunta.html">Quien vive ahi?</a></li>
					
				</ul>
				<ul class="colMas">
					<li><h2><?= i18n("Top users")?></h2></li>
					<li class="preg"><a href="perfil.html">federico</a></li>
					<li class="preg"><a href="perfil.html">manuela</a></li>
					<li class="preg"><a href="perfil.html">mrRareza</a></li>
					<li class="preg"><a href="perfil.html">vampiro57</a></li>
					<li class="preg"><a href="perfil.html">facundo</a></li>
				</ul>
			</div>
		</div>
    </div>
  </body>
</html>
