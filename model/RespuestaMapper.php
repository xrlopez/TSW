<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Respuesta.php");

class RespuestaMapper {

 
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  public function findById($idRespuesta){
    $stmt = $this->db->prepare("SELECT * FROM respuestas WHERE respuestas.idRespuesta=? ");
    $stmt->execute(array($idRespuesta));
    $resp_db = $stmt->fetch(PDO::FETCH_ASSOC);

    if($resp_db != null) {
        return new Respuesta(
    $resp_db["idRespuesta"],
    $resp_db["idPregunta"],
    $resp_db["descripcion"],
    $resp_db["votosPositivos"],
    $resp_db["votosNegativos"],
    $resp_db["idUsuario"]
    );
    } else {
        return NULL;
      }   
   
  }
 
  public function save($respuesta) {
    $stmt = $this->db->prepare("INSERT INTO respuestas (idPregunta,descripcion,votosPositivos,votosNegativos,idUsuario)values (?,?,?,?,?)");
    $stmt->execute(array($respuesta->getPregunta(), $respuesta->getDescripcion(), 0, 0, $respuesta->getUsuario()));
  }

  public function findAllByPregunta($pregunta){  
    $stmt = $this->db->prepare("SELECT * FROM respuestas WHERE respuestas.idPregunta=? ORDER BY respuestas.votosPositivos DESC");
    $stmt->execute(array($pregunta));
    $resp_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $resps = array();
    
    foreach ($resp_db as $resp) {
      array_push($resps, new Respuesta($resp["idRespuesta"],$resp["idPregunta"], $resp["descripcion"], $resp["votosPositivos"], $resp["votosNegativos"], $resp["idUsuario"]));
    }   
  
    return $resps;
  }

  public function votarPositivo($respuesta){
    $stmt = $this->db->prepare("UPDATE respuestas set votosPositivos=(votosPositivos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }

  public function votarNegativo($respuesta){
    $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }
   
}