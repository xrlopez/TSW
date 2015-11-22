<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/RespuestaMapper.php");
class Pregunta {

  private $idPregunta;
  private $titulo;
  private $descripcion;
  private $fecha;
  private $idUsuario;
  private $numRespuestas;
  private $respuetaMapper;
  
  public function __construct($idPregunta=NULL,$titulo=NULL,$descripcion=NULL,$fecha=NULL,$idUsuario=NULL) {
    $this->idPregunta = $idPregunta;
    $this->titulo = $titulo;
    $this->descripcion = $descripcion;
    $this->fecha = $fecha;
    $this->idUsuario =$idUsuario;
    $this->respuetaMapper = new RespuestaMapper();
    $this->numRespuestas = count($this->respuetaMapper->findAllByPregunta($idPregunta));
  }

  public function getId(){
    return $this->idPregunta;
  }

  public function setId($idPregunta){
    $this->idPregunta=$idPregunta;
  }
  
  public function getTitulo(){
    return $this->titulo;
  }

  public function setTitulo($titulo){
    $this->titulo=$titulo;
  }

  public function getDescripcion(){
    return $this->descripcion;
  }

  public function setDescripcion($descripcion){
    $this->descripcion=$descripcion;
  }

  public function getFecha(){
    return $this->fecha;
  }

  public function setFecha($fecha){
    $this->fecha=$fecha;
  }
  
  public function getUsuario(){
    return $this->idUsuario;
  }

  public function setUsuario($idUsuario){
    $this->idUsuario=$idUsuario;
  }
  
  public function getnumRespuestas(){
    return $this->numRespuestas;
  }

  public function setnumRespuestas($numRespuestas){
    $this->numRespuestas=$numRespuestas;
  }


  public function checkIsValidForRegister() {
      $errors = array();
      if ($this->idPregunta == NULL ) {
  $errors["idPregunta"] = "El id es obligatorio";
      }
      if ($this->titulo == NULL ) {
  $errors["titulo"] = "El titulo es obligatorio";
      }
      if ($this->descripcion == NULL ) {
  $errors["descripcion"] = "La descripcion es obligatoria";
      }
      if ($this->fecha == NULL ) {
  $errors["fecha"] = "La fecha es obligatoria";
      }
      if ($this->idUsuario == NULL ) {
  $errors["idUsuario"] = "El id del usuario es obligatorio";
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "user is not valid");
      }
  } 
}