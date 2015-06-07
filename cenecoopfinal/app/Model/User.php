<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	// Validaciones de datos para la tabla autenticacions
	public $primaryKey = 'username';
    public $validate = array(
        
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Correo requerido'
            )
        ),
		'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Contraseña requerida'
            )
        ),
		'cedula' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Número de cédula requerido'
            )
        )
    );
	
	public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}
}