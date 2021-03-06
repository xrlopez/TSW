<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/Pregunta.php");
require_once(__DIR__."/../model/PreguntaMapper.php");
require_once(__DIR__."/../model/RespuestaMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class UsersController
 * 
 * Controller to login, logout and user registration
 * 
 * @author lipido <lipido@gmail.com>
 */
class PreguntasController extends BaseController {
  
  /**
   * Reference to the UserMapper to interact
   * with the database
   * 
   * @var UserMapper
   */  
  private $userMapper;  
  private $preguntaMapper;   
  private $respuestaMapper;
  
  public function __construct() {    
    parent::__construct();
    
    $this->userMapper = new UserMapper();
    $this->preguntaMapper = new PreguntaMapper();
    $this->respuestaMapper = new RespuestaMapper();

    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("welcome");     
  }

  public function index(){
	$this->listados();
    $preguntas = $this->preguntaMapper->getPreguntas();
    $numPreguntas = $this->preguntaMapper->getNumPreguntas();
	$imagenes = $this->preguntaMapper->getImagenes();
	
    $this->view->setVariable("num_pagina", 1);
    if (5 < $numPreguntas ) {
      $fin = 5;
    }else{
      $fin = $numPreguntas;
    }
    $this->view->setVariable("inicio", 1);
    $this->view->setVariable("fin", $fin);
    $this->view->setVariable("preguntas", $preguntas);  
    $this->view->setVariable("numPreguntas", $numPreguntas);
	$this->view->setVariable("imagenes", $imagenes);
    $this->view->render("preguntas", "index");

  }

  public function page()
    {
	  $this->listados();
	  $imagenes = $this->preguntaMapper->getImagenes();
      $numPage = $_GET['page'];

      $inicio = $numPage*5-4;
      $preguntas = $this->preguntaMapper->getPreguntas($inicio-1,5);
      $numPreguntas = $this->preguntaMapper->getNumPreguntas();
      $fin = $numPage*5;
      if ($fin > $numPreguntas['num'] ) {
        $fin = $numPreguntas['num'];
      }
      $this->view->setVariable("inicio", $inicio);
      $this->view->setVariable("fin", $fin);
      $this->view->setVariable("num_pagina", $numPage);
      $this->view->setVariable("numPreguntas", $numPreguntas);
      $this->view->setVariable("preguntas", $preguntas);
	  $this->view->setVariable("imagenes", $imagenes);
      $this->view->render("preguntas", "index"); 
    }

  public function pregunta(){
	$this->listados();
    if(isset($_GET["id"])){
      $idpre = $_GET["id"];
      $pregunta = $this->preguntaMapper->findById($idpre);
      $respuestas = $this->respuestaMapper->findAllByPregunta($idpre);
	  $imagenes = $this->preguntaMapper->getImagenes();
      $this->view->setVariable("respuestas",$respuestas);
      $this->view->setVariable("pregunta", $pregunta);
	  $this->view->setVariable("imagenes", $imagenes);
      $this->view->render("preguntas", "pregunta");
    }
  }

  public function categorias(){
    $this->listados();
    $this->view->render("preguntas", "categorias");
  }

  public function preguntar(){
  $this->listados();
    if(isset($_SESSION["currentuser"])){
      if(isset($_POST["submit"])){
    if($_POST["submit"]==i18n("Ask")){
      $pregunta = new Pregunta();
      if((strlen($_POST["pregunta"])>1) && (strlen($_POST["descripcion"])>1)){
        $pregunta->setTitulo($_POST["pregunta"]);
        $pregunta->setDescripcion($_POST["descripcion"]);
        $time = time();
        $pregunta->setFecha(date("Y-m-d H:i:s", $time));
        $pregunta->setUsuario($_SESSION["currentuser"]);
        $preg = $this->preguntaMapper->save($pregunta);
        if(isset($_POST["categorias"])) {
            $this->preguntaMapper->categorizar($preg->getId(),$_POST["categorias"]);
        }
        $this->view->redirect("preguntas", "index");
      } else{
        $errors["general"] = i18n("You can not ask with empty fields");
        $this->view->setVariable("errors", $errors);
        $this->view->render("preguntas", "preguntar");
      }
    } else{
      $this->view->redirect("preguntas", "index");
    }
        
      }else{
          $this->view->render("preguntas", "preguntar");
      }
    }else{
      $this->view->setFlash(sprintf(i18n("To ask you have login")));
      $this->view->render("users", "login");    
    }
  }
  
  public function listados(){
	   $preguntasMV = $this->preguntaMapper->preguntasMV();
	   $this->view->setVariable("preguntasMV", $preguntasMV);
	   $usuariosMP = $this->preguntaMapper->usuariosMP();
	   $this->view->setVariable("usuariosMP", $usuariosMP);
  }

  
  public function usuariosMP(){
	  
	$this->listados();
    if(isset($_GET["id"])){
      $iduser = $_GET["id"];
      $preguntasUsuario = $this->preguntaMapper->preguntasUsuario($iduser);
	  $numPreguntas = $this->preguntaMapper->getNumPreguntas();
	  $imagenes = $this->preguntaMapper->getImagenes();
	  
	  $this->view->setVariable("num_pagina", 1);
	  if (5 < $numPreguntas ) {
		$fin = 5;
      }else{
		$fin = $numPreguntas;
      }
      $this->view->setVariable("inicio", 1);
      $this->view->setVariable("fin", $fin);
	  $this->view->setVariable("preguntasUsuario", $preguntasUsuario);	  
      $this->view->setVariable("numPreguntas", $numPreguntas);
	  $this->view->setVariable("imagenes", $imagenes);
      $this->view->render("preguntas", "usuariosMP");
    }
  }

  public function pregCatergorias(){
    $this->listados();
    $categoria = $_GET["categoria"];
    $preguntas = $this->preguntaMapper->preguntasByCategoria($categoria);
    $numPreguntas = $this->preguntaMapper->getNumPreguntasCat($categoria);
	$imagenes = $this->preguntaMapper->getImagenes();
	
    $this->view->setVariable("num_pagina", 1);
    if (5 < $numPreguntas ) {
      $fin = 5;
    }else{
      $fin = $numPreguntas;
    }
    $this->view->setVariable("inicio", 1);
    $this->view->setVariable("fin", $fin);
    $this->view->setVariable("preguntas", $preguntas);  
    $this->view->setVariable("numPreguntas", $numPreguntas);
    $this->view->setVariable("categoria",$categoria);
	 $this->view->setVariable("imagenes",$imagenes);
    $this->view->render("preguntas", "pregCatergoria");
  }

  public function pageCat()
    {
    $this->listados();
    $categoria=$_GET['categoria'];
      $numPage = $_GET['page'];

      $inicio = $numPage*5-4;
      $preguntas = $this->preguntaMapper->preguntasByCategoria($categoria,$inicio-1,5);
      $numPreguntas = $this->preguntaMapper->getNumPreguntasCat($categoria);
      $fin = $numPage*5;
      if ($fin > $numPreguntas['num'] ) {
        $fin = $numPreguntas['num'];
      }
      $this->view->setVariable("inicio", $inicio);
      $this->view->setVariable("fin", $fin);
      $this->view->setVariable("num_pagina", $numPage);
      $this->view->setVariable("numPreguntas", $numPreguntas);
      $this->view->setVariable("preguntas", $preguntas);
      $this->view->setVariable("categoria",$categoria);
      $this->view->render("preguntas", "pregCatergoria");
    }
	
	public function modificar(){
		$this->listados();
		if(isset($_POST["id"])){
		  $idpre = $_POST["id"];
		  $pregunta = $this->preguntaMapper->findById($idpre);
		  $this->view->setVariable("pregunta", $pregunta);
		  $this->view->render("preguntas", "modificar");
		}
	}
	
	public function update(){
		$this->listados();
		if(isset($_SESSION["currentuser"])){
		  if(isset($_POST["submit"])){
			if($_POST["submit"]==i18n("Modify")){
				$pregunta = new Pregunta();
				if((strlen($_POST["pregunta"])>1) && (strlen($_POST["descripcion"])>1)){
					$pregunta->setId($_POST["preguntaId"]);
					$pregunta->setTitulo($_POST["pregunta"]);
					$pregunta->setDescripcion($_POST["descripcion"]);
					$time = time();
					$pregunta->setFecha(date("Y-m-d H:i:s", $time));
					$pregunta->setUsuario($_SESSION["currentuser"]);
					$preg = $this->preguntaMapper->update($pregunta);
					if(isset($_POST["categorias"])) {
						$this->preguntaMapper->modCategorias($preg->getId(),$_POST["categorias"]);
					}
					$this->view->redirect("preguntas", "index");
				} else{
					$errors["general"] = i18n("You can not ask with empty fields");
					$this->view->setVariable("errors", $errors);
					$this->view->render("preguntas", "preguntar");
				}
			} else if($_POST["submit"]==i18n("Delete")){
				$this->preguntaMapper->delete($_POST["preguntaId"]);
				$this->view->redirect("preguntas", "index");
			}
			else{
				$this->view->redirect("preguntas", "index");
			}
			
		  }else{
			  $this->view->render("preguntas", "preguntar");
		  }
		}else{
		  $this->view->setFlash(sprintf(i18n("To ask you have login")));
		  $this->view->render("users", "login");    
		}
	}
  
}