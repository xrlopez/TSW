<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Pregunta.php");


/**
 * Class UserMapper
 *
 * Database interface for User entities
 * 
 * @author lipido <lipido@gmail.com>
 */
class UserMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a User into the database
   * 
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return void
   */      
  public function save($user) {
    $stmt = $this->db->prepare("INSERT INTO usuarios values (?,?,?,?,?)");
    $stmt->execute(array($user->getUsername(), $user->getName(), $user->getSurname(), $user->getEmail(), $user->getPassword()));
  }
  
  /**
   * Checks if a given username is already in the database
   * 
   * @param string $username the username to check
   * @return boolean true if the username exists, false otherwise
   */
  public function usernameExists($username) {
    $stmt = $this->db->prepare("SELECT count(idUsuario) FROM usuarios where idUsuario=?");
    $stmt->execute(array($username));
    
    if ($stmt->fetchColumn() > 0) {   
      return true;
    } 
  }
  
  /**
   * Checks if a given pair of username/password exists in the database
   * 
   * @param string $username the username
   * @param string $passwd the password
   * @return boolean true the username/passwrod exists, false otherwise.
   */
  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(idUsuario) FROM usuarios where idUsuario=? and password=?");
    $stmt->execute(array($username, $passwd));
    
    if ($stmt->fetchColumn() > 0) {
      return true;        
    }
  }

  public function buscarInfo($busqueda){
    
    $stmt = $this->db->prepare("SELECT * FROM preguntas WHERE (titulo LIKE ? OR descripcion LIKE ?)");
    $stmt->execute(array("%$busqueda%","%$busqueda%"));  
    $pregs = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $bus = array();
    foreach ($pregs as $preg) {
      array_push($bus, new Pregunta($preg["idPregunta"], $preg["titulo"], $preg["descripcion"], $preg["fecha"], $preg["idUsuario"]));
    }    
    return $bus;
  }
   
}