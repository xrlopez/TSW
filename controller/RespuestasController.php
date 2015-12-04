<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Respuesta.php");
require_once(__DIR__."/../model/RespuestaMapper.php");
require_once(__DIR__."/../model/PreguntaMapper.php");

require_once(__DIR__."/../controller/PreguntasController.php");
require_once(__DIR__."/../controller/BaseController.php");

class RespuestasController extends BaseController {
  
  private $userMapper;  
  private $respuestaMapper;
  private $preguntaMapper;
  
  public function __construct() {    
    parent::__construct();
    
    $this->userMapper = new UserMapper();
    $this->respuestaMapper = new RespuestaMapper();
    $this->preguntaMapper = new preguntaMapper();
	$this->preguntasController = new PreguntasController();
    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("welcome");     
  }

  public function responder(){
	$this->preguntasController->listados();
	if(isset($_POST["coment"])){
		if(strlen($_POST["coment"])<1){
	      	$errors["comentario"] = i18n("You can not comment without content");
	      	$this->view->setVariable("errors", $errors);	
		}else{
			$respuesta = new Respuesta();
			$respuesta->setPregunta($_POST["pregunta"]);
			$respuesta->setDescripcion($_POST["coment"]);
			$respuesta->setUsuario($_POST["usuario"]);
			$this->respuestaMapper->save($respuesta);
		}
		
			$idp =$_POST["pregunta"];
		    $preg = $this->preguntaMapper->findById($idp);
		    $resp = $this->respuestaMapper->findAllByPregunta($idp);
		    $this->view->setVariable("pregunta", $preg);
		    $this->view->setVariable("respuestas",$resp);
		    $this->view->render("preguntas", "pregunta");
  	}
  }

  	public function votar(){
		$this->preguntasController->listados();
  		$usuario = $this->userMapper->findById($_POST["usuario"]);
  		$respuesta = $this->respuestaMapper->findById($_POST["respuesta"]);
  		$voto = $this->respuestaMapper->getVotacionUser($usuario->getId(),$respuesta->getId());
	  	if(isset($_POST["positivo"])){
	  		if($voto==0){
	  			$this->respuestaMapper->modVotacion($respuesta,$usuario,$voto,"positivo");
	  		}else if($voto==1){
			      $this->view->setFlash(i18n("You have voted positively"));
	  		}else{
	  			$this->respuestaMapper->votarPositivo($respuesta,$usuario);

	  		}

	  	}else if(isset($_POST["negativo"])){
	  		if($voto==0){
			      $this->view->setFlash(i18n("You have voted negatively"));
	  		}else if($voto==1){
	  			$this->respuestaMapper->modVotacion($respuesta,$usuario,$voto,"negativo");
	  		}else{
	  			$this->respuestaMapper->votarNegativo($respuesta,$usuario);	
	  		}

	  	}

		$idp =$_POST["pregunta"];
	    $preg = $this->preguntaMapper->findById($idp);
	    $resp = $this->respuestaMapper->findAllByPregunta($idp);
	    $this->view->setVariable("usuario", $usuario);
	    $this->view->setVariable("pregunta", $preg);
	    $this->view->setVariable("respuestas",$resp);
	    $this->view->render("preguntas", "pregunta");
	}
  
}