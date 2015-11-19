
<h1>Blog posts</h1>
<p><?php echo $this->Html->link("Add Usuario", array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?php echo $usuario['Usuario']['idUsuario']; ?></td>
        <td>
			<?php echo $this->Html->link(
				$usuario['Usuario']['idUsuario'],
				array('action' => 'view', $usuario['Usuario']['idUsuario'])
			); ?>
		</td>
		<td>
			<?php
                echo $this->Usuario->usuarioLink(
                    'Delete',
                    array('action' => 'delete', $usuario['Usuario']['idUsuario']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $usuario['Usuario']['idUsuario'])
                );
            ?>
        </td>
        <td>
            <?php echo $usuario['Usuario']['correo']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>