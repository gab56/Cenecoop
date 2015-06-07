<?php
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class UsersController extends AppController {

	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");
	
	

function reset($token=null){
	//$this->layout="Login";
	$this->User->recursive=-1;
	if(!empty($token)){
		$u=$this->User->findBytokenhash($token);
		if($u){
			$this->User->id=$u['User']['id'];
			if(!empty($this->data)){
				$this->User->data=$this->data;
				$this->User->data['User']['username']=$u['User']['username'];
				$new_hash=sha1($u['User']['username'].rand(0,100));//created token
				$this->User->data['User']['tokenhash']=$new_hash;
				if($this->User->validates(array('fieldList'=>array('password','password_confirm')))){
					if($this->User->save($this->User->data))
					{
						$this->Session->setFlash('Password Has been Updated');
						$this->redirect(array('controller'=>'users','action'=>'login'));
					}

				}
				else{
					$this->set('errors',$this->User->invalidFields());
				}
			}
		}
		else
		{
			$this->Session->setFlash('Token Corrupted,,Please Retry.the reset link work only for once.');
		}
	}
	else{
		$this->redirect('/');
	}
}

function forgetpw(){
	//$this->layout="signup";
	$this->User->recursive=-1;
	if(!empty($this->data))
	{
		if(empty($this->data['User']['email']))
		{
			$this->Session->setFlash('Please Provide Your Email Adress that You used to Register with Us');
		}
		else{
			$email=$this->data['User']['email'];
			$fu=$this->User->find('first',array('conditions'=>array('User.username'=>$email)));
			if($fu){
				//debug($fu);
				if(true)
				{
					$key = Security::hash(String::uuid(),'sha512',true);
					$hash=sha1($fu['User']['username'].rand(0,100));
					$url = Router::url( array('controller'=>'users','action'=>'reset'), true ).'/'.$key.'#'.$hash;
					$ms=$url;
					$ms=wordwrap($ms,1000);
					//debug($url);
					$fu['User']['tokenhash']=$key;
					$this->User->id=$fu['User']['username'];
					if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){

						//============Email================//
						/* SMTP Options */
						$this->Email->smtpOptions = array(
						'port'=>465,
						'timeout'=>'45',
						'host' => 'ssl://smtp.gmail.com',
						'username'=>'pruebacenecoop@gmail.com',
						'password'=>'ECCIcenecoop2015');
						
						
						$this->Email->delivery = 'smtp';
						$this->Email->template = 'resetpw';
						$this->Email->from    = 'pruebaCenecoop@gmail';
						$this->Email->to      = $fu['User']['username'];
						$this->Email->subject = 'Reestablecer contraseña de Cenecoop';
						$this->Email->sendAs = 'both';
						$this->set('ms', $ms);
						$this->Email->send();
						$this->set('smtp_errors', $this->Email->smtpError);
						$this->Session->setFlash(__('Check Your Email To Reset your password', true));

			//============EndEmail=============//
					}
					else{
						$this->Session->setFlash("Error Generating Reset link");
					}
				}
				else{
					$this->Session->setFlash('This Account is not Active yet.Check Your mail to activate it');
				}
			}
			else{
				$this->Session->setFlash('Email does Not Exist');
			}
		} 
	}
}
	
	
	
	
	
	
	
	
	
	// Verifica si las contraseñas coinciden
	function confirmPassword(){
		return $this->request->data['User']['password'] == $this->request->data['User']['repassword'];
	}
	
	// Codifica URL
	function encode( $url ) {
        return preg_replace(array('/\+/', '/\//'), array('-', '_'), base64_encode($url));
    }
 
	//Decodifica URL
    function decode( $url ) {
        return base64_decode(preg_replace(array('/-/', '/_/'), array('+', '/'), $url));
    }
	
	
	// Agrega datos de autenticacion a la base de datos
	public function agregar() {
			
		if ($this->request->is('post')) {
			
			if( $this->confirmPassword() ){
			
				$this->User->create();
			
				// Obtiene la cedula que enviada por URL
				$cedula = $this->passedArgs['cedula'];
				//$cedula = $this->request->params['named']['cedula']; //Alternativa
			
				// Decodifica la cedula
				$result = $this->decode( $cedula );
				
				// Desencripta la cedula
				$key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
				$decrypt = Security::decrypt($result, $key);
			
				// Agrega cedula a $this->request->data
				$this->request->data['User']['cedula'] = $decrypt;
			
				//Guarda los datos del formulario en la tabla
				if ( $this->User->save( $this->request->data ) ) {
					$this->Session->setFlash(__('The user has been saved'));
					//return $this->redirect(array('action' => 'index'));
				}
				else{
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			else{
				$this->Session->setFlash(__('Las contraseñas no coinciden.'));
				unset($this->request->data['User']['password']);
				unset($this->request->data['User']['repassword']);
			}
        }
    }
	
	public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }
	
	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('agregar','agregarEstudiante', 'login','forgetpw','resetpw');
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

    public function despuesLogin() {
        $this->Session->setFlash(__('SE HA LOGEADO SATISFACTORIAMENTE'));
    }

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

    public function despuesLogout() {
        $this->Session->setFlash(__('SE HA DESLOGEADO SATISFACTORIAMENTE'));
    }
}