<?php
$this->Html->css('cake.generic') 
$this->Html->css('cake.special')
?>
<h1>Add Usuario</h1>
<?php
	echo $this->Form->create('Usuario');
	echo $this->Form->input('nombre');
	echo $this->Form->input('correo');
	echo $this->Form->input('contraseña', ['type' => 'password']);
	echo $this->Form->input('confirmar contraseña', ['type' => 'password']);
	echo $this->Form->end('Registrarse');
	
?>


<div class="inicio row">
	<div class="registrarse col-xs-12 col-sm-12 col-md-8">
		<h2>Nombre</h2><input type="text" id="usuario"/>
		<h2>Correo</h2><input type="text" id="usuario"/>
		<h2>Contraseña</h2><input type="password" id="contraseña"/>
		<h2>Confirmar contraseña</h2><input type="password" id="contraseña"/>
	</div>
	<div class="botones col-xs-12 col-sm-12 col-md-8">
		<button type="submit" id="login">Registrase</button>
	</div>
</div>
					