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
	$imagenes = $this->preguntaMapper->getImagenes();
	if(isset($_POST["coment"])){
		if(strlen($_POST["coment"])<1){
	      	$errors["comentario"] = i18n("You can not comment without content");
	      	$this->view->setVariable("errors", $errors);	
		}else{
			$respuesta = new Respuesta();
			$respuesta->setPregunta($_POST["pregunta"]);
			$respuesta->setDescripcion($_POST["coment"]);
			$respuesta->setUsuario($_SESSION["currentuser"]);
			$this->respuestaMapper->save($respuesta);
		}
		
			$idp =$_POST["pregunta"];
		    $preg = $this->preguntaMapper->findById($idp);
		    $resp = $this->respuestaMapper->findAllByPregunta($idp);
		    $this->view->setVariable("pregunta", $preg);
		    $this->view->setVariable("respuestas",$resp);
			$this->view->setVariable("imagenes",$imagenes);
		    $this->view->render("preguntas", "pregunta");
  	}
  }

  	public function votar(){
		$this->preguntasController->listados();
		$imagenes = $this->preguntaMapper->getImagenes();
  		$usuario = $this->userMapper->findById($_SESSION["currentuser"]);
  		$respuesta = $this->respuestaMapper->findById($_POST["respuesta"]);
  		$voto = $this->respuestaMapper->getVotacionUser($_SESSION["currentuser"],$_POST["respuesta"]);
	  	if(isset($_POST["positivo"])){
	  		if($voto=="negativo"){
	  			$this->respuestaMapper->modVotacion($respuesta,$usuario,$voto,"positivo");
	  		}else if($voto=="positivo"){
	  			$this->respuestaMapper->eliminarVoto($respuesta,$usuario,$voto);
			    $this->view->setFlash(i18n("Your vote has been eliminated"));
	  		}else{
	  			$this->respuestaMapper->votarPositivo($respuesta,$usuario);
	  		}

	  	}else if(isset($_POST["negativo"])){
	  		if($voto=="negativo"){
	  			$this->respuestaMapper->eliminarVoto($respuesta,$usuario,$voto);
			    $this->view->setFlash(i18n("Your vote has been eliminated"));
	  		}else if($voto=="positivo"){
	  			$this->respuestaMapper->modVotacion($respuesta,$usuario,$voto,"negativo");
	  		}else{
	  			$this->respuestaMapper->votarNegativo($respuesta,$usuario);	
	  		}

	  	}

		$idp =$_POST["pregunta"];
	    $preg = $this->preguntaMapper->findById($idp);
	    $resp = $this->respuestaMapper->findAllByPregunta($idp);
	    $this->view->setVariable("pregunta", $preg);
	    $this->view->setVariable("respuestas",$resp);
		$this->view->setVariable("imagenes",$imagenes);
	    $this->view->render("preguntas", "pregunta");
	}
	
	public function modificar(){
		$this->preguntasController->listados();
		$imagenes = $this->preguntaMapper->getImagenes();
		if(isset($_POST["modificar"])){
		  $idpre = $_POST["pregunta"];
		  $pregunta = $this->preguntaMapper->findById($idpre);
		  $this->view->setVariable("pregunta", $pregunta);
		  $idres = $_POST["respuesta"];
		  $respuesta = $this->respuestaMapper->findById($idres);
		  $this->view->setVariable("respuesta", $respuesta);
		  $this->view->setVariable("imagenes", $imagenes);
		  $this->view->render("preguntas", "modRespuesta");
		}
	}
	
	public function update(){
		$this->preguntasController->listados();
		if(isset($_SESSION["currentuser"])){
		  if(isset($_POST["submit"])){
			if($_POST["submit"]==i18n("Modify")){
				$respuesta = new Respuesta();
				if(strlen($_POST["descripcion"])>1){
					$respuesta->setId($_POST["respuesta"]);
					$respuesta->setPregunta($_POST["pregunta"]);
					$respuesta->setDescripcion($_POST["descripcion"]);
					$respuesta->setUsuario($_SESSION["currentuser"]);
					$res = $this->respuestaMapper->update($respuesta);
					
					$this->view->redirect("preguntas", "index");
				} else{
					$errors["general"] = i18n("You can not comment with empty fields");
					$this->view->setVariable("errors", $errors);
					$this->view->render("preguntas", "modRespuesta");
				}
			} else if($_POST["submit"]==i18n("Delete")){
				$this->respuestaMapper->delete($_POST["respuesta"], $_POST["pregunta"]);
				$this->view->redirect("preguntas", "index");
			}
			else{
				$this->view->redirect("preguntas", "index");
			}
			
		  }else{
			  $this->view->render("preguntas", "pregunta");
		  }
		}else{
		  $this->view->setFlash(sprintf(i18n("To ask you have login")));
		  $this->view->render("users", "login");    
		}
	}
  
}