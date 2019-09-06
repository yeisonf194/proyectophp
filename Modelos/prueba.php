<?php
include '../Config/Conexion.php';
class Productos extends DB{


  function _construct(){parent::_construct();}


  public function get($id){
    $query = $this->connect()->prepare('SELECT * FROM servicio WHERE idservicio=:id');
    $query->execute(['id' => $id]);
    return [
      'id'      =>$row['idservicio'],
      'nombre'  =>$row['nombre'],
      'especificaciones'  =>$row['especificaciones'],
      'precio'  =>$row['precio'],
      'imagen'  =>$row['imagen']
    ];
  }


  public function getItemsByCategory($category){
    $query = $this->connect()->prepare('SELECT * FROM servicio WHERE idservicio=:cat');
    $query->execute(['cat' => $id]);
    $items=[];
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
      $item = [
        'id'  =>$row['idservicio'],
        'nombre'  =>$row['nombre'],
        'especificaciones'  =>$row['especificaciones'],
        'precio'  =>$row['precio'],
        'imagen'  =>$row['imagen']
      ];
      array_push($items,$item);
    }
    return $items;
    
  }


}
?>