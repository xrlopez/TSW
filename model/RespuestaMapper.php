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

  public function getVotacionUser($idUsuario,$idRespuesta){
    $stmt = $this->db->prepare("SELECT  * FROM votos WHERE votos.idRespuesta=? and votos.idUsuario=?");
    $stmt->execute(array($idRespuesta,$idUsuario));
    $resp_db = $stmt->fetch(PDO::FETCH_ASSOC);
    if($resp_db != null) {
        return $resp_db["votos"];
    } else {
        return NULL;
      } 
  }

  public function votarPositivo($respuesta,$usuario){
    $stmt = $this->db->prepare("INSERT INTO votos VALUES(?,?,1)");
    $stmt->execute(array($respuesta->getId(),$usuario->getId())); 
    $stmt = $this->db->prepare("UPDATE respuestas set votosPositivos=(votosPositivos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }

  public function votarNegativo($respuesta,$usuario){
    $stmt = $this->db->prepare("INSERT INTO votos VALUES(?,?,0)");
    $stmt->execute(array($respuesta->getId(),$usuario->getId())); 
    $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }

  public function modVotacion($respuesta,$usuario,$votos,$tipo){
      if($tipo=="positivo" && $votos==0){
          $stmt = $this->db->prepare("UPDATE votos set votos=1 where idRespuesta=? and idUsuario=?");
          $stmt->execute(array($respuesta->getId(),$usuario->getId())); 
          $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos - 1), votosPositivos=(votosPositivos+1) where idRespuesta=?");
          $stmt->execute(array($respuesta->getId())); 

      }else if($tipo=="negativo" && $votos==1){
          $stmt = $this->db->prepare("UPDATE votos set votos=0 where idRespuesta=? and idUsuario=?");
          $stmt->execute(array($respuesta->getId(),$usuario->getId())); 
          $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos + 1), votosPositivos=(votosPositivos-1) where idRespuesta=?");
          $stmt->execute(array($respuesta->getId())); 

      }
  }
   
}