<?php
// file: model/User.php

require_once(__DIR__."/../core/ValidationException.php");

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
  private $email;
  private $passwd;
  
  /**
   * The constructor
   * 
   * @param string $username The name of the user
   * @param string $passwd The password of the user
   */
  public function __construct($username=NULL, $name=NULL, $email=NULL, $passwd=NULL) {
    $this->username = $username;
    $this->passwd = $passwd;    
  }
 
  public function getUsername() {
    return $this->username;
  }
 
  public function setUsername($username) {
    $this->username = $username;
  }

  public function getName() {
    return $this->name;
  }
 
  public function setName($name) {
    $this->name = $name;
  }
  
  public function getSurname() {
    return $this->surname;
  }
 
  public function setSurname($surname) {
    $this->surname = $surname;
  }
  
  public function getEmail() {
    return $this->email;
  }
 
  public function setEmail($email) {
    $this->email = $email;
  } 
  public function getPassword() {
    return $this->passwd;
  }  
    
  public function setPassword($passwd) {
    $this->passwd = $passwd;
  }
  
  /**
   * Checks if the current user instance is valid
   * for being registered in the database
   * 
   * @throws ValidationException if the instance is
   * not valid
   * 
   * @return void
   */  
  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->username) < 5) {
	$errors["username"] = "Username must be at least 5 characters length";
	
      }
      if (strlen($this->name) < 5) {
	$errors["name"] = "Name must be at least 5 characters length";	
      }
	  if (strlen($this->email) < 5) {
	$errors["email"] = "Password must be at least 5 characters length";	
      }
	  if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "Password must be at least 5 characters length";	
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "user is not valid");
      }
  } 
}