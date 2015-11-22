<?php

require_once(__DIR__."/../core/ValidationException.php");
class Respuesta {

  private $idRespuesta;
  private $idPregunta;
  private $descripcion;
  private $votPositivos;
  private $votNegativos;
  private $idUsuario;
  
  public function __construct($idRespuesta=NULL,$idPregunta=NULL,$descripcion=NULL,$votPositivos=NULL,$votNegativos=NULL, $idUsuario=NULL) {
    $this->idRespuesta = $idRespuesta;
    $this->idPregunta = $idPregunta;
    $this->descripcion = $descripcion;
    $this->votPositivos = $votPositivos;
    $this->votNegativos = $votNegativos;
    $this->idUsuario =$idUsuario;
  }

  public function getId(){
    return $this->idRespuesta;
  }

  public function setId($idRespuesta){
    $this->idRespuesta=$idRespuesta;
  }
  
  public function getPregunta(){
    return $this->idPregunta;
  }

  public function setPregunta($idPregunta){
    $this->idPregunta=$idPregunta;
  }

  public function getDescripcion(){
    return $this->descripcion;
  }

  public function setDescripcion($descripcion){
    $this->descripcion=$descripcion;
  }

  public function getPositivos(){
    return $this->votPositivos;
  }

  public function setPositivos($votPositivos){
    $this->votPositivos=$votPositivos;
  }

  public function getNegativos(){
    return $this->votNegativos;
  }

  public function setNegativos($votNegativos){
    $this->votNegativos=$votNegativos;
  }
  
  public function getUsuario(){
    return $this->idUsuario;
  }

  public function setUsuario($idUsuario){
    $this->idUsuario=$idUsuario;
  }

  public function checkIsValidForRegister() {
      $errors = array();
      if ($this->idRespuesta == NULL ) {
  $errors["idRespuesta"] = "El id es obligatorio";
      }
      if ($this->idPregunta == NULL ) {
  $errors["idPregunta"] = "El id de la pregunta es obligatorio";
      }
      if ($this->descripcion == NULL ) {
  $errors["descripcion"] = "La descripcion es obligatoria";
      }
      if ($this->idUsuario == NULL ) {
  $errors["idUsuario"] = "El id del usuario es obligatorio";
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "user is not valid");
      }
  } 
}