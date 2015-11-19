<h1>Edit Usuario</h1>
<?php
echo $this->Form->create('Usuario');
echo $this->Form->input('nombre');
echo $this->Form->input('correo', array('rows' => '3'));
echo $this->Form->input('idUsuario', array('type' => 'hidden'));
echo $this->Form->end('Save Usuario');
?>