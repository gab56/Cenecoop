<?php
App::uses('AppModel', 'Model');

class Persona extends AppModel {
	
	// Validaciones de datos para la tabla personas
	
    public $validate = array(
        'cedula' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Numero de cédula requerido',
            ),
			'length' => array(
                'rule'    => array('minLength', '7'),
                'message' => 'Digite un numero de cedula valido'
            )
        ),
        'nombre' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nombre requerido'
            )
        ),
		'apellido1' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Primer apellido requerido'
            )
        ),
		'apellido2' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Segundo apellido requerido'
            )
        ),
		'telefono' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Numero de telefono requerido'
            )
        ),
		'nacionalidad' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nacionalidad requerida'
            )
        ),
		'edad' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Edad requerida'
            )
        ),
		'fechanacimiento' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Fecha de nacimiento requerida'
            )
        ),
        'genero' => array(
            'valid' => array(
                'rule' => array('inList', array('m', 'f')),
                'message' => 'Genero requerido',
                'allowEmpty' => false
            )
        ),
		'rol' => array(
            'valid' => array(
                'rule' => array('inList', array('Estudiante', 'Profesor', 'Administrador')),
                'allowEmpty' => false
            )
        )
    );
}