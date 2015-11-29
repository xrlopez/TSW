<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Respuesta.php");
require_once(__DIR__."/../model/RespuestaMapper.php");
require_once(__DIR__."/../model/PreguntaMapper.php");

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

    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("welcome");     
  }

  public function responder(){
	if(isset($_POST["coment"])){
		$respuesta = new Respuesta();
		$respuesta->setPregunta($_POST["pregunta"]);
		$respuesta->setDescripcion($_POST["coment"]);
		$respuesta->setUsuario($_POST["usuario"]);
		$this->respuestaMapper->save($respuesta);

		$idp =$_POST["pregunta"];
	    $preg = $this->preguntaMapper->findById($idp);
	    $resp = $this->respuestaMapper->findAllByPregunta($idp);
	    $this->view->setVariable("pregunta", $preg);
	    $this->view->setVariable("respuestas",$resp);
	    $this->view->render("preguntas", "pregunta");
  	}
  }

  	public function votar(){
	  	if(isset($_POST["positivo"])){
	  		$respuesta = $this->respuestaMapper->findById($_POST["respuesta"]);
	  		$this->respuestaMapper->votarPositivo($respuesta);
	  	}else if(isset($_POST["negativo"])){
	  		$respuesta = $this->respuestaMapper->findById($_POST["respuesta"]);
	  		$this->respuestaMapper->votarNegativo($respuesta);
	  		}  

		$idp =$_POST["pregunta"];
	    $preg = $this->preguntaMapper->findById($idp);
	    $resp = $this->respuestaMapper->findAllByPregunta($idp);
	    $this->view->setVariable("pregunta", $preg);
	    $this->view->setVariable("respuestas",$resp);
	    $this->view->render("preguntas", "pregunta");
	}
  
}