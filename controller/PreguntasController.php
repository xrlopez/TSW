<?php

require_once(__DIR__."/../core/ViewManager.php");

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
  
    $preguntas = $this->preguntaMapper->findAll();
    $this->view->setVariable("preguntas", $preguntas);    
    
    $this->view->render("preguntas", "index");

  }

  public function pregunta(){
    $idpre = $_GET["id"];
    $pregunta = $this->preguntaMapper->findById($idpre);
    $respuestas = $this->respuestaMapper->findAllByPregunta($idpre);
    $this->view->setVariable("respuestas",$respuestas);
    $this->view->setVariable("pregunta", $pregunta); 
    $this->view->render("preguntas", "pregunta");

  }

  
}
