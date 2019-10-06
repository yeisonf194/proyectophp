<?php
$mensaje="";
$_SESSION['eventos'][0]['asistentes'];
if(isset($_POST['btnAccion'])){
  $button=$_POST['btnAccion'];
  switch($button){
    case 'Agregar':
      if(is_numeric(openssl_decrypt($_POST['idservicio'], COD, KEY))){
        $idservicio=openssl_decrypt($_POST['idservicio'], COD, KEY);
        $mensaje.="Ok id correcto</br>";
      }else{
        $mensaje.="Ups...id incorrecto</br>";
      }
      if(is_numeric(openssl_decrypt($_POST['idempresa'], COD, KEY))){
        $idempresa=openssl_decrypt($_POST['idempresa'], COD, KEY);
        $mensaje.="Ok idempresa correcto</br>";
      }else{
        $mensaje.="Ups...idempresa incorrecto</br>";
      }
      if(is_string(openssl_decrypt($_POST['nombre'], COD, KEY))){
        $nombre=openssl_decrypt($_POST['nombre'], COD, KEY);
        $mensaje.="Ok nombre correcto</br>";
      }else{
        $mensaje.="Ups...nombre incorrecto</br>";
      }
      if(is_string(openssl_decrypt($_POST['imagen'], COD, KEY))){
        $imagen=openssl_decrypt($_POST['imagen'], COD, KEY);
        $mensaje.="Ok nombre correcto</br>";
      }else{
        $mensaje.="Ups...nombre incorrecto</br>";
      }
      if(is_string(openssl_decrypt($_POST['especificaciones'], COD, KEY))){
        $especificaciones=openssl_decrypt($_POST['especificaciones'], COD, KEY);
        $mensaje.="Ok especificaciones correcto</br>";
      }else{
        $mensaje.="Ups...especificaciones incorrecto</br>";
      }
      if(is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))){
        $precio=openssl_decrypt($_POST['precio'], COD, KEY);
        $mensaje.="Ok precio correcto</br>";
      }else{
        $mensaje.="Ups...precio incorrecto</br>";
      }
      if(!isset($_SESSION['carrito'])){
        $producto=array(
          'idservicio'=>$idservicio,
          'imagen'=>$imagen,
          'especificaciones'=>$especificaciones,
          'idempresa'=>$idempresa,
          'nombre'=>$nombre,
          'precio'=>$precio
        );
        $_SESSION['carrito'][0]=$producto;
      }else{
        $numeroProductos=count($_SESSION['carrito']);
        $producto=array(
          'idservicio'=>$idservicio,
          'imagen'=>$imagen,
          'especificaciones'=>$especificaciones,
          'idempresa'=>$idempresa,
          'nombre'=>$nombre,
          'precio'=>$precio
        ); 
        $_SESSION['carrito'][$numeroProductos]=$producto;
      }
      $mensaje=print_r($_SESSION['carrito'], true);
    break;
    case 'eliminar':
      if(is_numeric(openssl_decrypt($_POST['id'], COD, KEY))){
        $idservicio=openssl_decrypt($_POST['id'], COD, KEY);
        if(is_numeric(openssl_decrypt($_POST['empresa'],COD,KEY))){
          $empresa=openssl_decrypt($_POST['empresa'], COD, KEY);
          foreach($_SESSION['carrito'] as $indice=>$producto){
            if($producto['idempresa']==$empresa){
              if($producto['idservicio']==$idservicio){
                $mensaje='Producto '.$producto['nombre'].' Eliminado';
                unset($_SESSION['carrito'][$indice]);
              }
            }
          }
        }
      }else{
        $mensaje.="Ups...id incorrecto</br>";
      }
    break;
  }
}
// else{
//   if(isset($_GET["op"])){
//     switch($_GET["op"]){
//       case 'tipoevento':
//         $tipoevento=$_POST['tipoEvento'];
//         $fechaEntrega=$_POST['fechaentrega'];
//         $asistente=$_POST['invitados'];
//         if(!isset($_SESSION['evento'])){
//           $datos=array(
//             'tipoevento'=>$tipoevento,
//             'fecha'=>$fechaEntrega,
//             'asistentes'=>$asistente
//           );
//           $_SESSION['evento'][0]=$datos;
//           header('Location: ../vistas/Usuario/Contratar.php');
//         }
//       break;
//     }
//   }
// }
?>