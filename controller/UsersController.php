<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class UsersController
 * 
 * Controller to login, logout and user registration
 * 
 * @author lipido <lipido@gmail.com>
 */
class UsersController extends BaseController {
  
  /**
   * Reference to the UserMapper to interact
   * with the database
   * 
   * @var UserMapper
   */  
  private $userMapper;    
  
  public function __construct() {    
    parent::__construct();
    
    $this->userMapper = new UserMapper();

    // Users controller operates in a "welcome" layout
    // different to the "default" layout where the internal
    // menu is displayed
    $this->view->setLayout("welcome");     
  }

  public function login() {
    if (isset($_POST["username"])){ // reaching via HTTP Post...
      //process login form    
      if ($this->userMapper->isValidUser($_POST["username"],$_POST["passwd"])) {
	       $_SESSION["currentuser"]=$_POST["username"];
	       $this->view->redirect("preguntas", "index");
         
      }else{
      	$errors = array();
      	$errors["general"] = "<span id=\"error\">El usuario o la contraseña no es correcta</span>";
      	$this->view->setVariable("errors", $errors);
      }
    }       
    
    // render the view (/view/users/login.php)
    $this->view->render("users", "login");    
  }

   
   public function register() { 
    //$this->view->render("users", "register");
	$user = new User();

	if (isset($_POST["usuario"])){ 
      $user->setUsername($_POST["usuario"]);
      $user->setName($_POST["nombre"]);
	  $user->setSurname($_POST["apellidos"]);
      $user->setEmail($_POST["correo"]);

      if ($_POST["pass"]==$_POST["repass"]) {
        $user->setPassword($_POST["pass"]);
      }
      else{
        $errors["pass"] = "Las contraseñas tienen que ser iguales";
        $this->view->setVariable("errors", $errors);
        $this->view->render("users", "register"); 
        return false;
      }
    
      try{
	      $user->checkIsValidForRegister();    
		  
      	if (!$this->userMapper->usernameExists($_POST["usuario"])){
        	  $this->userMapper->save($user);
	          $this->view->setFlash("Usuario ".$user->getUsername()." registrado.");
	          $this->view->redirect("users", "login");
  } else {
	  $errors = array();
	  $errors["usuario"] = "El usuario ya existe";
	  $this->view->setVariable("errors", $errors);
	}
      }catch(ValidationException $ex) {
      	$errors = $ex->getErrors();
      	$this->view->setVariable("errors", $errors);
      }
    }
    
    $this->view->render("users", "register");
    
  }

  public function buscarInfo(){
    $busqueda = $_POST['busqueda'];
    $result = $this->userMapper->buscarInfo($busqueda);
    $this->view->setVariable("informacion",$result);
    $this->view->render("users","info");
  }

 /**
   * Action to logout
   * 
   * This action should be called via GET
   * 
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>users/login (via redirect)</li>
   * </ul>
   *
   * @return void
   */
  public function logout() {
    session_destroy();
    
    // perform a redirection. More or less: 
    // header("Location: index.php?controller=users&action=login")
    // die();
    $this->view->redirect("preguntas", "index");
   
  }
  
}
