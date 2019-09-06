<?php
session_start();
require '../Config/Conexion.php';
switch ($_GET["op"]) {
    case 'agregarEvento':
        $tipoevento=$_POST["tipoevento"];
        $asistentes=$_POST["asistentes"];
        $fechaEntrega=$_POST["fechaentrega"];
        $categoria=$_POST["categoria"];
        if($categoria!=''){
            echo 'Entro';
            // $$evento=$_SESSION['evento'][0]['categoria']=$categoria;
        }
        $categoria='';
        // ini_set('date.time','America/Bogota');
        // $time = date('Y-m-d, H:i:s', time());
        // $usuario=$_SESSION["idusuario"];
        if(!isset($_SESSION['evento'])){
            $informacion=array(
              'tipoevento'=>$tipoevento,
              'categoria'=>$categoria,
              'fechaentrega'=>$fechaEntrega,
              'asistentes'=>$asistentes
            );
            $_SESSION['evento'][0]=$informacion;
          }
          if(isset($_SESSION['evento'])){
            header("Location: ../vistas/Usuario/Contratar.php");
          }
    break;
    case 'contratando':
        // ini_set('date.time','America/Bogota');
        // $fechareserva = date('Y-m-d, H:i:s', time());
        $idrestaurante=0;
        $idlicor=0;
        $idfotografia=0;
        $idsalon=0;
        $idanimacion=0;
        $idusuario=$_SESSION["idusuario"];
        $precioplato=0;
        $preciolicor=0;
        $preciofoto=0;
        $preciosalon=0;
        $precioanima=0;
        $opcion=0;
        $opcionservicio=0;
        foreach($_SESSION['carrito'] as $indice=>$producto){
            switch($producto['idempresa']){  
                case '4':
                    $idfotografia=$producto['idservicio'];
                    $preciofoto=$producto['precio'];
                break;
                case '5':
                    $idsalon=$producto['idservicio'];
                    $preciosalon=$producto['precio'];
                break;
                case '6':
                    $idanimacion=$producto['idservicio'];
                    $precioanima=$producto['precio'];
                break;
            }
        }
        $total=$precioplato+$preciolicor+$preciofoto+$preciosalon+$precioanima;
        foreach($_SESSION['evento'] as $indice=>$informacion){
            $idtipoevento=$informacion['tipoevento'];
            $fechaEntrega=$informacion['fechaentrega'];
            $asistentes=$informacion['asistentes'];
            ini_set('date.time','America/Bogota');
            $fechareserva = date('Y-m-d H:i:s', time());
        }

        if($idsalon!=0 && $idfotografia!=0 && $idanimacion==0){
            $opcion=1;
        }
        if($idsalon!=0 && $idfotografia==0 && $idanimacion==0){
            $opcion=2;
        }
        if($idsalon==0 && $idfotografia!=0 && $idanimacion==0){
            $opcion=3;
        }
        if($idsalon==0 && $idfotografia==0 && $idanimacion!=0){
            $opcion=4;
        }
        if($idsalon==0 && $idfotografia!=0 && $idanimacion!=0){
            $opcion=5;
        }
        if($idsalon!=0 && $idfotografia==0 && $idanimacion!=0){
            $opcion=6;
        }
        if($idsalon!=0 && $idfotografia!=0 && $idanimacion!=0){
            $opcion=7;
        }
        if($idsalon==0 && $idfotografia==0 && $idanimacion==0){
            $opcion=8;
        }
        if($idrestaurante!=0){
            $opcionservicio=1;
        }
        $tbevento=mysqli_query($conexion,"INSERT INTO evento(idusuario, idtipoevento, fechareserva, fechaentregahora, cantidadpersonas, precio, abono, saldo, codigo)
                                            VALUES ('$idusuario', '$idtipoevento', '$fechareserva', '$fechaEntrega', $asistentes, $total, 0, 0, 0)");

                                            
        $resul=$conexion->query("SELECT idevento as evento, fechareserva as fechareserva FROM evento WHERE fechareserva='$fechareserva' ");
        $key=$resul->fetch_assoc();
        $llave=$key["evento"];
        $insertar=$key["fechareserva"];

        if($fechareserva==$insertar){
            switch($opcion){
                case '1':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idsalon, preciosalon, idfotografia, preciofotografia, especificaciones) VALUES ($llave, $idsalon, $preciosalon, $idfotografia, $preciofoto, 'Ninguna')");
                break;
                case '2':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idsalon, preciosalon, especificaciones) VALUES ($llave, $idsalon, $preciosalon, 'Ninguna')");
                break;
                case '3':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idfotografia, preciofotografia, especificaciones) VALUES ($llave, $idfotografia, $preciofoto, 'Ninguna')");
                break;
                case '4':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idanimacion, precioanimacion, especificaciones) VALUES ($llave, $idanimacion, $precioanima, 'Ninguna')");
                break;
                case '5':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idfotografia, preciofotografia, idanimacion, precioanimacion, especificaciones) VALUES ($llave, $idfotografia, $preciofoto, $idanimacion, $precioanima, 'Ninguna')");
                break;
                case '6':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idsalon, preciosalon, idanimacion, precioanimacion, especificaciones) VALUES ($llave, $idsalon, $precioanima, $idanimacion, $precioanima, 'Ninguna')");
                break;
                case '7':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, idsalon, preciosalon, idfotografia, preciofotografia, idanimacion, precioanimacion, especificaciones) VALUES ($llave, $idsalon, $preciosalon, $idfotografia, $preciofoto, $idanimacion, $precioanima, 'Ninguna')");
                break;
                case '8':
                    $tbpedido=mysqli_query($conexion,"INSERT INTO pedido(idevento, especificaciones) VALUES ($llave, 'Ninguna')");
                break;
            }
        } 
        $resul=$conexion->query("SELECT	p.idpedido as pedido, e.fechareserva as reserva FROM pedido p, evento e WHERE p.idevento=e.idevento AND e.fechareserva='$fechareserva'");
        $key=$resul->fetch_assoc();
        $pedido=$key["pedido"];
        $evento=$key["reserva"];

        if($fechareserva==$evento){
            foreach($_SESSION['carrito'] as $indice=>$producto){
                $idempresa=$producto['idempresa'];
                switch($idempresa){
                    case '2':
                        $idrestaurante=$producto['idservicio'];
                        $precioplato=$_SESSION['evento'][0]['asistentes']*$producto['precio'];
                        $tbservicio=mysqli_query($conexion,"INSERT INTO servicio(idpedido, idempresa, idproducto, precio) VALUES ($pedido, $idempresa, $idrestaurante, $precioplato)");
                    break;
                    case '3':
                        $idlicor=$producto['idservicio'];
                        $botellas=round(($_SESSION['evento'][0]['asistentes']/6),0,PHP_ROUND_HALF_UP);
                        $preciolicor=$producto['precio']*$botellas;
                        $tbservicio=mysqli_query($conexion,"INSERT INTO servicio(idpedido, idempresa, idproducto, precio) VALUES ($pedido, $idempresa, $idlicor, $preciolicor)");
                    break;  
                }
            }
            if (!$tbservicio){
                echo "<script>alert('Error al Insertar servicio');window.location= '../vistas/Usuario/Shoppingcart.php'</script>";
            }else{
                echo "<script>alert('Evento guardado servicio');window.location= '../vistas/Usuario/Shoppingcart.php'</script>";
            }
        }
        if (!$tbpedido){
            echo "<script>alert('Error al Insertar');window.location= '../vistas/Usuario/Shoppingcart.php'</script>";
        }else{
            echo "<script>alert('Evento guardado');window.location= '../vistas/Usuario/Shoppingcart.php'</script>";
        }
    break;
    case 'insertar':
        $tipoevento=$_POST["tipoevento"];
        $asistentes=$_POST["asistentes"];
        $fechaentrega=$_POST["fechaentrega"];
        $restaurante=$_POST["restaurante"];
        $licor=$_POST["licor"];
        $fotografia=$_POST["fotografia"];
        $salon=$_POST["salon"];
        $animacion=$_POST["animacion"];
        echo $restaurante;
        echo $licor;
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>

