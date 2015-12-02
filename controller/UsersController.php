<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/PreguntasController.php");
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
	$this->preguntasController = new PreguntasController();
    $this->view->setLayout("welcome");
  }

  public function login() {
	$this->preguntasController->listados();
    if (isset($_POST["username"])){ // reaching via HTTP Post...
      //process login form    
      if ($this->userMapper->isValidUser($_POST["username"],$_POST["passwd"])) {
	       $_SESSION["currentuser"]=$_POST["username"];
	       $this->view->redirect("preguntas", "index");
         
      }else{
      	$errors = array();
      	$errors["general"] = i18n("<span id=\"error\">Unrecognized username or password</span>");
      	$this->view->setVariable("errors", $errors);
      }
    }       
    
    // render the view (/view/users/login.php)
    $this->view->render("users", "login");    
  }

   
   public function register() { 
    $this->preguntasController->listados();
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
        $errors["pass"] = i18n("Passwords must be equal");
        $this->view->setVariable("errors", $errors);
        $this->view->render("users", "register"); 
        return false;
      }
      try{   
        $user->checkIsValidForRegister(); 
		  
      	if (!$this->userMapper->usernameExists($_POST["usuario"])){
        	  $this->userMapper->save($user);
	          $this->view->setFlash(i18n("Registered user"));
	          $this->view->redirect("users", "login");
      } else {
        $errors = array();
        $errors["usuario"] = i18n("User already exists");
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
	$this->preguntasController->listados();
    if(isset($_POST['busqueda'])){
      $busqueda = $_POST['busqueda'];
      $result = $this->userMapper->buscarInfo($busqueda);
      $this->view->setVariable("informacion",$result);
      $this->view->render("users","info");
    }else{
      $result = $this->userMapper->buscarInfo(null);
      $this->view->setVariable("informacion",$result);
      $this->view->render("users","info");
    }
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

   public function perfil(){
	$this->preguntasController->listados();
    $currentuser = $this->view->getVariable("currentusername");
    $user = $this->userMapper->findById($currentuser);
    $this->view->setVariable("user", $user);
    $this->view->render("users", "perfil");
  }

  public function modificar(){
	$this->preguntasController->listados();
    $currentuser = $this->view->getVariable("currentusername");
    $user = $this->userMapper->findById($currentuser);
    $this->view->setVariable("user", $user);
    $this->view->render("users", "modificar");
  }

  public function eliminar(){
    $currentuser = $this->view->getVariable("currentusername");
    $user = $this->userMapper->findById($currentuser);
    
        
    // Does the post exist?
    if ($user == NULL) {
      throw new Exception(i18n("Username does not exist"));
    }
    
    // Delete the Jurado Popular object from the database
    $this->userMapper->delete($user);
   
    $this->view->setFlash(i18n("Deleted user"));
    session_unset();
    session_destroy();
    $this->view->redirect("preguntas", "index");
  }
  
  public function update(){
    $userid = $_REQUEST["usuario"];
    $user = $this->userMapper->findById($userid);

    $errors = array();
    if($this->userMapper->isValidUser($_POST["usuario"],$_POST["passActual"])){
        if (isset($_POST["usuario"])) {  
          $user->setNombre($_POST["nombre"]);
      $user->setApellidos($_POST["apellidos"]);
          $user->setCorreo($_POST["correo"]);

          if(!(strlen(trim($_POST["passNew"])) == 0)){
            if ($_POST["passNew"]==$_POST["passNueva"]) {
              $user->setPassword($_POST["passNueva"]);
            }
            else{
              $errors["pass"] = i18n("Passwords must be equal");
              $this->view->setVariable("errors", $errors);
              $this->view->setVariable("user", $user);
              $this->view->render("users", "modificar"); 
              return false;
            }
          }
          
            try{
              $this->userMapper->update($user);
              $this->view->setFlash(i18n("Modified user correctly"));
              $this->view->redirect("users", "perfil"); 
            }catch(ValidationException $ex) {
            $errors = $ex->getErrors();
            $this->view->setVariable("errors", $errors);
          } 
        }

    }
    else{
        $errors["passActual"] = i18n("Incorrect password");
        $this->view->setVariable("errors", $errors);
        $this->view->setVariable("user", $user);
        $this->view->render("users", "modificar"); 
      }
  }
  
}
