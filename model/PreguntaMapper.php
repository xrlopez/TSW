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
    $stmt2 = $this->db->query("SELECT * FROM preguntas ORDER BY idPregunta DESC LIMIT 1");
    $pre = $stmt2->fetch(PDO::FETCH_ASSOC);
    if($pre != null) {
      return new Pregunta($pre["idPregunta"], $pre["titulo"], $pre["descripcion"], $pre["fecha"], $pre["idUsuario"]);
    }else{
      return null;
    }
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
  
  public function preguntasMV(){
	$stmt = $this->db->query("SELECT * FROM respuestas, preguntas WHERE preguntas.idPregunta = respuestas.idPregunta 
								GROUP BY respuestas.idPregunta ORDER BY votosPositivos DESC LIMIT 5");
    $pre = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $pre;
  }
  
  public function usuariosMP(){
	$stmt = $this->db->query("SELECT COUNT(*) AS total, idPregunta, titulo, descripcion, fecha, idUsuario FROM preguntas GROUP BY idUsuario ORDER BY total DESC LIMIT 5");
    $pre = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $pre;
  }
  
  public function preguntasUsuario($userid){
	$stmt = $this->db->prepare("SELECT * FROM preguntas WHERE idUsuario=?");
	$stmt->execute(array($userid));
    $pre = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	$pregs = array();
	  
	foreach($pre as $preg){
		array_push($pregs, new Pregunta($preg["idPregunta"], $preg["titulo"], $preg["descripcion"], $preg["fecha"], $preg["idUsuario"]));
	}
	return $pregs;  
  }

  public function preguntasByCategoria($categoria, $inicio = 0, $limite = 5){
      $stmt = $this->db->prepare("SELECT * FROM preguntas WHERE idPregunta IN (SELECT idPregunta FROM categorias WHERE nombre=?) limit ?,?");
      $stmt->execute(array($categoria,$inicio,$limite));
        $pre = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      $pregs = array();
        
      foreach($pre as $preg){
        array_push($pregs, new Pregunta($preg["idPregunta"], $preg["titulo"], $preg["descripcion"], $preg["fecha"], $preg["idUsuario"]));
      }
      return $pregs; 
  }

  public function getNumPreguntasCat($categoria){
    $stmt = $this->db->prepare('SELECT count(*) as num FROM preguntas WHERE idPregunta IN (SELECT idPregunta FROM categorias WHERE nombre=?)');
    $stmt->execute(array($categoria));
    $num_pregs = $stmt->fetch(PDO::FETCH_ASSOC);
    $num=$num_pregs["num"];
    return $num;
  }

  public function getCategoriasByPreg($idPreg){
    $stmt = $this->db->prepare("SELECT * FROM categorias WHERE idPregunta=?");
      $stmt->execute(array($idPreg));
        $catBd = $stmt->fetchAll(PDO::FETCH_ASSOC);
      
      $cat = array();
        
      foreach($catBd as $categoria){
        array_push($cat, $categoria["nombre"]);
      }
      return $cat;
  }

  public function categorizar($pregunta,$categorias){
    foreach ($categorias as $categoria) {
      $stmt = $this->db->prepare("INSERT INTO categorias VALUES(?,?)");
      $stmt->execute(array($categoria, $pregunta));
    }
  }
    
}