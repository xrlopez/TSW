<?php class Usuario extends AppModel{
	public $validate = array(
        'nombre' => array(
            'rule' => 'notBlank'
        ),
        'correo' => array(
            'rule' => 'notBlank'
        )
    );
}
?>