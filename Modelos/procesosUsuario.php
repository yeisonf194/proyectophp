<?php
include '../config/Conexion.php';
session_start(); 
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
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>