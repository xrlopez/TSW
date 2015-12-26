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
    $stmt = $this->db->prepare("SELECT  * FROM votos WHERE idUsuario=? and idRespuesta=?");
    $stmt->execute(array($idUsuario, $idRespuesta));
    $resp_db = $stmt->fetch(PDO::FETCH_ASSOC);
    if($resp_db != null) {
        return $resp_db["voto"];
    } else {
        return NULL;
      } 
  }

  public function votarPositivo($respuesta,$usuario){
    $stmt = $this->db->prepare("INSERT INTO votos (idRespuesta, idUsuario, voto)  VALUES(?,?,?)");
    $stmt->execute(array($respuesta->getId(),$usuario->getId(),"positivo")); 
    $stmt = $this->db->prepare("UPDATE respuestas set votosPositivos=(votosPositivos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }

  public function votarNegativo($respuesta,$usuario){
    $stmt = $this->db->prepare("INSERT INTO votos VALUES(?,?,?)");
    $stmt->execute(array($respuesta->getId(),$usuario->getId(),"negativo")); 
    $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos + 1) where idRespuesta=?");
    $stmt->execute(array($respuesta->getId())); 
  }

  public function eliminarVoto($respuesta,$usuario,$tipo){
    $stmt = $this->db->prepare("DELETE FROM votos WHERE idRespuesta=? and idUsuario=?");
    $stmt->execute(array($respuesta->getId(),$usuario->getId())); 
    if($tipo=="negativo"){
      $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos - 1) where idRespuesta=?");
      $stmt->execute(array($respuesta->getId())); 
    }else if($tipo=="positivo"){
      $stmt = $this->db->prepare("UPDATE respuestas set votosPositivos=(votosPositivos-1) where idRespuesta=?");
      $stmt->execute(array($respuesta->getId())); 
    }   
  }

  public function modVotacion($respuesta,$usuario,$votos,$tipo){
      if($tipo=="positivo" && $votos=="negativo"){
          $stmt = $this->db->prepare("UPDATE votos set voto=? where idRespuesta=? and idUsuario=?");
          $stmt->execute(array("positivo",$respuesta->getId(),$usuario->getId())); 
          $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos - 1), votosPositivos=(votosPositivos+1) where idRespuesta=?");
          $stmt->execute(array($respuesta->getId())); 

      }else if($tipo=="negativo" && $votos=="positivo"){
          $stmt = $this->db->prepare("UPDATE votos set voto=? where idRespuesta=? and idUsuario=?");
          $stmt->execute(array("negativo",$respuesta->getId(),$usuario->getId())); 
          $stmt = $this->db->prepare("UPDATE respuestas set votosNegativos=(votosNegativos + 1), votosPositivos=(votosPositivos-1) where idRespuesta=?");
          $stmt->execute(array($respuesta->getId())); 

      }
  }
   
}