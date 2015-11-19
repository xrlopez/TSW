<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
			
			<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
			<title>
				<?php echo $cakeDescription ?>:
				<?php echo $this->fetch('title'); ?>
			</title>
			<?php

				echo $this->Html->css('style');

				echo $this->fetch('meta');
				echo $this->fetch('css');
				echo $this->fetch('script');
			?>
	</head>
	<body>
		<div id="container" class="container">
			<div id="header" class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<ul id="menu">
					  <li >
					  	<input type="search" id="busqueda" size="30" placeholder="buscar">
					  	<button type="submit" id="buttonBusqueda">buscar
					  	</button>
					  </li>
					  <li class="option"><a href="index.html">Preguntar</a></li>
					  <li class="option"><?php echo $this->Html->link("Iniciar sesion", array('action' => 'login')); ?></li>
					</ul> 
				</div>	
				<div id="logo" class="col-xs-12 col-sm-12 col-md-8">
					<img class="imgLogo" src="img/letras_sombreado.png" alt="logo" height="59" width="380">
				</div> 
			</div>
			<div class="row">
				<div id="main" class="col-xs-12 col-sm-12 col-md-8">
					<?php echo $this->Flash->render(); ?>

					<?php echo $this->fetch('content'); ?>
				</div>
				<div id="news" class="col-xs-12 col-sm-12 col-md-4">
					<ul class="colMas">						
						<li><h2>Preguntas mas votadas</h2></li>
						<li class="preg"><a href="pregunta.html">Soy una persona?</a></li>
						<li class="preg"><a href="pregunta.html">Cual es el sentido de la vida?</a></li>
						<li class="preg"><a href="pregunta.html">Que son los caminantes blancos?</a></li>
						<li class="preg"><a href="pregunta.html">A que esperas?</a></li>
						<li class="preg"><a href="pregunta.html">Quien vive ahi?</a></li>
						
					</ul>
					<ul class="colMas">
						<li><h2>Usuarios que mas votan</h2></li>
						<li class="preg"><a href="index.html">federico</a></li>
						<li class="preg"><a href="index.html">manuela</a></li>
						<li class="preg"><a href="index.html">mrRareza</a></li>
						<li class="preg"><a href="index.html">vampiro57</a></li>
						<li class="preg"><a href="index.html">facundo</a></li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>