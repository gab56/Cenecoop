<?php
App::uses('AppModel', 'Model');

class Estudiante extends AppModel {
	
	// Validaciones de datos para la tabla estudiantes
	
    public $validate = array(
        'cedula' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Numero de cédula requerido'
            )
        ),
        'nivelacademico' => array(
            'valid' => array(
                'rule' => array('inList', array('Ninguno','Primaria incompleta', 'Primaria completa', 'Secundaria incompleta', 'Secundaria completa', 'Tecnica incompleta', 'Tecnica completa', 'Universitaria incompleta', 'Universitaria completa', 'No indica')),
                'message' => 'Nivel academico requerido',
                'allowEmpty' => false
            )
        ),
        'provincia' => array(
            'valid' => array(
                'rule' => array('inList', array('San Jose', 'Alajuela', 'Cartago', 'Heredia', 'Limon', 'Guanacaste', 'Puntarenas')),
                'message' => 'Provincia requerida',
                'allowEmpty' => false
            )
        ),
		'canton' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Cantón requerido'
            )
        ),
		'region' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Región requerida'
            )
        ),
		'ocupacion' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Nivel academico requerido'
            )
        )
    );
}