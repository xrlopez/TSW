<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class User
 * 
 * Represents a User in the blog
 * 
 * @author lipido <lipido@gmail.com>
 */
class User {

  private $username;
  private $name;
  private $surname;
  private $email;
  private $image;
  private $passwd;
  
  /**
   * The constructor
   * 
   * @param string $username The name of the user
   * @param string $passwd The password of the user
   */
  public function __construct($username=NULL, $name=NULL, $surname=NULL, $email=NULL, $image=NULL, $passwd=NULL) {
     $this->username = $username;
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
	$this->image = $image;
    $this->passwd = $passwd;    
  }
 
  public function getId() {
    return $this->username;
  }
 
  public function setId($username) {
    $this->username = $username;
  }

  public function getNombre() {
    return $this->name;
  }
 
  public function setNombre($name) {
    $this->name = $name;
  }
  
  public function getApellidos() {
    return $this->surname;
  }
 
  public function setApellidos($surname) {
    $this->surname = $surname;
  }
  
  public function getCorreo() {
    return $this->email;
  }
 
  public function setImagen($image) {
    $this->image = $image;
  } 
  
  public function getImagen() {
    return $this->image;
  }
 
  public function setCorreo($email) {
    $this->email = $email;
  } 
  
  public function getPassword() {
    return $this->passwd;
  }  
    
  public function setPassword($passwd) {
    $this->passwd = $passwd;
  }

  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->username) < 5) {
      $errors["username"] = i18n("Username must be at least 5 characters length");
          }
        if (strlen($this->passwd) < 5) {
      $errors["passwd"] = i18n("Password must be at least 5 characters length");  
          }
          if (sizeof($errors)>0){
      throw new ValidationException($errors, "user is not valid");
          }
  } 
  
  
}