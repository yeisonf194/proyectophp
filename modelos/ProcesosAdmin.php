<?php
include '../config/Conexion.php';
session_start(); 
switch ($_GET["op"]) {
    case 'agregarEmpresa':
        $nombre=$_POST["nombre"];
        $nit=$_POST["nit"];
        $email=$_POST["email"];
        $telefono=$_POST["telefono"];
        $tipo=$_POST["tipo"];
        $clave=$_POST["clave"];
         //Ejecutanto insercion a la base de datos
        $insertar="INSERT INTO empresa(nombre, tipo, nit, telefono, correo, contrasenia) 
                    VALUES ('$nombre', '$tipo', '$nit', '$telefono', '$email', '$clave')";

        //Validando usuario existente
        $verificarUsuario=mysqli_query($conexion, "SELECT * FROM empresa WHERE email='$email'");
        if (mysqli_num_rows($verificarUsuario)>0){
            echo '<script>alert("Este correo ya se encuentra registrado")</script>';
            header('Location: ../vistas/agregarEmpresa.php');
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo '<script>alert("Error al agregar")</script>';
                header('Location: ../vistas/agregarEmpresa.php');
            }else{
                echo '<script>alert("Empresa registrada")</script>';
                header('Location: ../vistas/empresa.php');
            }
        }
    break;
    case 'ingreso':
        $usuario=$_POST["usuario"];
        $clave=$_POST["clave"];
        $validarusuario="SELECT nombre,rol FROM usuario WHERE email='$usuario' AND contrasenia='$clave'";
        $resultado=mysqli_query($conexion, $validarusuario);
        $fila=mysqli_num_rows($resultado);
        if($fila=$resultado->fetch_object()){
            $_SESSION["Nombre"]=$fila->nombre;
            $_SESSION["rol"]=$fila->rol; // el nombre de la variable es $_SESSION["nombre"], cuando quiera usarla se escribe.
            echo json_encode($fila);
        }else{
            echo'<script>alert("Error")</script>';
        }
        if(($_SESSION["rol"])=="cliente"){
            header('Location: ../vistas/indexUser.php');
        }else{
            header('Location: ../vistas/indexAdmin.php');
        }
    break;
    case 'agregarServicio':
        $nombre=$_POST["nombre"];
        $empresa=$_POST["empresa"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];

        //Insertando servicio
        $insertar="INSERT INTO servicio(nombre, idempresa, especificaciones, precio) 
                    VALUES ('$nombre', '$empresa', '$especificaciones', '$precio')";

        //Validando usuario existente
        $verificarServicio=mysqli_query($conexion, "SELECT * FROM servicio WHERE nombre='$nombre'");
        if (mysqli_num_rows($verificarServicio)>0){
            echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Administrador/Servicio/Agregar.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error');window.location= '../vistas/Administrador/Servicio/Agregar.php'</script>";
            }else{
                echo "<script>alert('Servicio Agregado');window.location= '../vistas/Administrador/Servicio/Index.php'</script>";
            }
        }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>