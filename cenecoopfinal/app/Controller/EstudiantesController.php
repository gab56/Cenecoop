<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class EstudiantesController extends AppController {
	
	// Codifica URL
	function encode( $url ) {
        return preg_replace(array('/\+/', '/\//'), array('-', '_'), base64_encode($url));
    }
 
	//Decodifica URL
    function decode( $url ) {
        return base64_decode(preg_replace(array('/-/', '/_/'), array('+', '/'), $url));
    }
	
	// Agrega un estudiante a la base de datos
	public function agregar() {
			
		if ($this->request->is('post')) {
			
			$this->Estudiante->create();
			
			// Obtiene la cedula que enviada por URL
			$cedula = $this->passedArgs['cedula'];
			//$cedula = $this->request->params['named']['cedula']; //Alternativa
			
			// Decodifica la cedula
			$result = $this->decode( $cedula );
			
			// Desencripta la cedula
			$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
			$decrypt = Security::decrypt($result, $key);
			
			// Agrega cedula a $this->request->data
			$this->request->data['Estudiante']['cedula'] = $decrypt;
			
			//Guarda los datos del formulario en la tabla
			if ( $this->Estudiante->save( $this->request->data ) ) {
				
				$this->Session->setFlash(__('The user has been saved'));
                
				// Cedula
				$cedula = $this->data['Estudiante']['cedula'];
				
				// Encripta la cedula
				$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
				$encrypt = Security::encrypt( $cedula, $key );
				
				// Codifica la encripción para enviarla por URL
				$result = $this->encode( $encrypt );
				
				// Redireciona al tercer formulario de registro de estudiante
				return $this->redirect(array('controller' => 'users', 'action' => 'agregar', 'cedula' => $result));
            }
			else{
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
        }
    }
}