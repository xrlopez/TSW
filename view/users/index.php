<?php 

 
 require_once(__DIR__."/../../core/ViewManager.php");
require_once(__DIR__."/../../model/UserMapper.php");
 $view = ViewManager::getInstance();
 
 $users = $view->getVariable("users");
 
 $view->setVariable("title", "Users");
 
?>

<div class="informacion col-xs-12 col-sm-12 col-md-12">
		<h2>Informacion del usuario</h2>
		<?= isset($errors["general"])?$errors["general"]:"" ?>
		<?php foreach ($users as $user): ?>
			<p><?= $user->getId()?></p>
		<?php endforeach; ?>
</div>