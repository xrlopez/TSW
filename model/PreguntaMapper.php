<?php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/Pregunta.php");

class PreguntaMapper {

 
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }
 
  public function save($pregunta) {
    $stmt = $this->db->prepare("INSERT INTO preguntas (titulo,descripcion,fecha,idUsuario) values (?,?,?,?)");
    $stmt->execute(array($pregunta->getTitulo(), $pregunta->getDescripcion(), $pregunta->getFecha(), $pregunta->getUsuario()));
  }

  public function findAll(){  
    $stmt = $this->db->query("SELECT * FROM preguntas ORDER BY preguntas.fecha DESC");    
    $preg_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $pregs = array();
    
    foreach ($preg_db as $preg) {
      array_push($pregs, new Pregunta($preg["idPregunta"], $preg["titulo"], $preg["descripcion"], $preg["fecha"], $preg["idUsuario"]));
    }   
  
    return $pregs;
  }

  public function getPreguntas($inicio = 0, $limite = 5){
    $stmt = $this->db->prepare("SELECT * FROM preguntas ORDER BY preguntas.fecha DESC limit ?,?");  
    $stmt->execute(array($inicio,$limite));
    $preg_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $pregs = array();
    
    foreach ($preg_db as $preg) {
      array_push($pregs, new Pregunta($preg["idPregunta"], $preg["titulo"], $preg["descripcion"], $preg["fecha"], $preg["idUsuario"]));
    }   
  
    return $pregs;
  }

  public function getNumPreguntas(){
    $stmt = $this->db->query('SELECT count(*) as num FROM preguntas');
    $num_pregs = $stmt->fetch(PDO::FETCH_ASSOC);
    $num=$num_pregs["num"];
    return $num;
  }

  public function findById($pregunta){
    $stmt = $this->db->prepare("SELECT * FROM preguntas WHERE preguntas.idPregunta=?");
    $stmt->execute(array($pregunta));
    $pre = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($pre != null) {
        return new Pregunta(
    $pre["idPregunta"],
    $pre["titulo"],
    $pre["descripcion"],
    $pre["fecha"],
    $pre["idUsuario"]
    );
    } else {
        return NULL;
      }   
  } 
    
}