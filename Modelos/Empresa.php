<?php
include '../config/Conexion.php';
session_start(); 
switch ($_GET["op"]) {
    case 'ingresoEmpresa':
        $usuario=$_POST["usuario"];
        $clave=$_POST["clave"];
        $validarusuario="SELECT nombre, tipo, idempresa FROM empresa WHERE correo='$usuario' AND contrasenia='$clave'";
        $resultado=mysqli_query($conexion, $validarusuario);
        $fila=mysqli_num_rows($resultado);
        if($fila=$resultado->fetch_object()){
            $_SESSION["tipo"]=$fila->tipo;
            $_SESSION["idempresa"]=$fila->idempresa;
            header('Location: ../vistas/Empresa/Index.php');
            echo json_encode($fila);
        }else{
            echo "Fallo";
            // echo "<script>alert('Datos Incorrectos');window.location= '../vistas/Empresa/Login.php'</script>";
        }
    break;
    case 'agregarServicio':
        $nombre=$_POST["nombre"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];
        $idempresa=$_SESSION["idempresa"];


        //Insertando servicio
        $insertar="INSERT INTO servicio(nombre, idempresa, especificaciones, precio) 
                    VALUES ('$nombre', '$idempresa', '$especificaciones', '$precio')";

        //Validando usuario existente
        $verificarServicio=mysqli_query($conexion, "SELECT * FROM servicio WHERE nombre='$nombre'");
        if (mysqli_num_rows($verificarServicio)>0){
            echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
            }else{
                echo "<script>alert('Servicio Agregado');window.location= '../vistas/Empresa/producto/Index.php'</script>";
            }
        }
    break;
    case 'agregafoto':
        $nombre=$_POST["nombre"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];
        $idempresa=$_SESSION["idempresa"];


        //Insertando servicio
        $insertar="INSERT INTO fotografia(nombre, idempresa, especificaciones, precio) 
                    VALUES ('$nombre', '$idempresa', '$especificaciones', '$precio')";

        //Validando usuario existente
        $verificarServicio=mysqli_query($conexion, "SELECT * FROM fotografia WHERE nombre='$nombre'");
        if (mysqli_num_rows($verificarServicio)>0){
            echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
            }else{
                echo "<script>alert('Servicio Agregado');window.location= '../vistas/Empresa/producto/Index.php'</script>";
            }
        }
    break;
    case 'agregaclub':
        $nombre=$_POST["nombre"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];
        $idempresa=$_SESSION["idempresa"];


        //Insertando servicio
        $insertar="INSERT INTO salon(nombre, idempresa, especificaciones, precio) 
                    VALUES ('$nombre', '$idempresa', '$especificaciones', '$precio')";

        //Validando usuario existente
        $verificarServicio=mysqli_query($conexion, "SELECT * FROM salon WHERE nombre='$nombre'");
        if (mysqli_num_rows($verificarServicio)>0){
            echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
            }else{
                echo "<script>alert('Servicio Agregado');window.location= '../vistas/Empresa/producto/Index.php'</script>";
            }
        }
    break;
    case 'agregaanimacion':
        $nombre=$_POST["nombre"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];
        $idempresa=$_SESSION["idempresa"];
        echo $nombre;
        echo $especificaciones;
        echo $precio;
        echo $idempresa;
        //Insertando servicio
        $insertar="INSERT INTO animacion(nombre, idempresa, especificaciones, precio) 
                    VALUES ('$nombre', '$idempresa', '$especificaciones', '$precio')";

        //Validando usuario existente
        $verificarServicio=mysqli_query($conexion, "SELECT * FROM animacion WHERE nombre='$nombre'");
        if (mysqli_num_rows($verificarServicio)>0){
            echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Empresa/producto/agregar.php'</script>";
            }else{
                echo "<script>alert('Servicio Agregado');window.location= '../vistas/Empresa/producto/Index.php'</script>";
            }
        }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Empresa/Login.php");
    break;
}

?>