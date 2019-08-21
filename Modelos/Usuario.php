<?php
include '../config/Conexion.php';
session_start(); 
$restaurante;
switch ($_GET["op"]) {
    case 'addevent':
        $tipoevento=$_POST["tipoevento"];
        $asistentes=$_POST["asistentes"];
        $fechaEntrega=$_POST["fechaEntrega"];
        ini_set('date.time','America/Bogota');
        $time = date('Y-m-d, H:i:s', time());
        $usuario=$_SESSION["idusuario"];



         //Ejecutanto insercion a la base de datos
        $insertar="INSERT INTO evento(idusuario, idtipoevento, fechareserva, fechaentregahora, cantidadpersonas, precio, abono, saldo) 
                    VALUES ('$usuario', '$tipoevento', '$time', '$fechaEntrega', '$asistentes', 0, 0, 0)";

        //Validando usuario existente
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Usuario/Index.php'</script>";
            }else{
                header("Location: ../vistas/Usuario/Contratar.php");
            }
    break;
    case 'contratar':
        $tipoevento=$_POST["tipoevento"];
        $asistentes=$_POST["asistentes"];
        $fechaentrega=$_POST["fechaentrega"];
        $restaurante=$_POST["restaurante"];
        $licor=$_POST["licor"];
        $fotografia=$_POST["fotografia"];
        $salon=$_POST["salon"];
        $animacion=$_POST["animacion"];
        ini_set('date.time','America/Bogota');
        $fechareserva = date('Y-m-d, H:i:s', time());
        $usuario=$_SESSION["idusuario"];
        // $tiempoanima=_POST["tiempoanima"];
        $sumando="SELECT SUM((a.precio)+(f.precio)+(s.precio)) as total FROM animacion a, fotografia f, salon s WHERE f.idfotografia=$fotografia AND s.idsalon=$salon AND a.idanimacion=$animacion";
        $resul=$conexion->query($sumando);
        $totalsin=$resul->fetch_assoc();
        $totalsinservicio=$totalsin["total"];



        //Encontrando el precio del licor
        $licor="SELECT precio FROM servicio WHERE idservicio=$licor";
        $consultando=$conexion->query($licor);
        $precioli=$consultando->fetch_assoc();
        $preciobotella=$precioli["precio"];

        //Precio platos
        $restauran="SELECT precio FROM servicio WHERE idservicio=$restaurante";
        $ejecutando=$conexion->query($restauran);
        $plato=$ejecutando->fetch_assoc();
        $precioplato=$precioli["precio"];


        
        $botellas=$asistentes/6;
        $precioplatos=$asistentes*$precioplato;


        echo $precioplato;
        $preciolicor=$botellas*$preciobotella;
        $total=$totalsinservicio+$preciolicor;
        //Insertando en la tabla temporal
        // $consulta="INSERT INTO tbtemporal(idusuario, idtipoevento, idfotografia, idanimacion, idsalon, idrestaurante, idlicor, tiempoanima, infoanima, fechaentrega, cantidadpersonas, preciototal)
        //             VALUES('$usuario', '$tipoevento', '$fotografia', '$animacion', '$salon', '$restaurante', '$licor', '0', 'Ninguna', '$fechaentrega', '$asistentes', '$total')";
        // $resultado = mysqli_query($conexion, $consulta);
        // if (!$resultado){
        //     echo "<script>alert('Error');window.location= '../vistas/Usuario/Index.php'</script>";
        // }else{
        //     echo "<script>alert('Contratado');window.location= '../vistas/Usuario/Index.php'</script>";
        // }


    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>