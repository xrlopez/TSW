<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Respuesta.php");

class RespuestaMapper {

 
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
 
  public function save($respuesta) {
    $stmt = $this->db->prepare("INSERT INTO respuestas values (?,?,?,?,?,?");
    $stmt->execute(array($respuesta->getId(), $respuesta->getPregunta(), $respuesta->getDescripcion(), $respuesta->getPositivos(), $respuesta->getNegativos(), $respuesta->getUsuario()));
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
   
}