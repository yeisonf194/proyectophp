<?php
include '../Config/Conexion.php';
session_start(); 
switch ($_GET["op"]) {
    case 'registrar':
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $email=$_POST["email"];
        $telefono=$_POST["telefono"];
        $tipodocumento=$_POST["tipodocumento"];
        $documento=$_POST["documento"];
        $contrasenia=$_POST["contrasenia"];
        $passAgain=$_POST["passAgain"];
         //Ejecutanto insercion a la base de datos
        $insertar="INSERT INTO usuario(rol, nombre, apellido, tipodocumento, documento, telefono, email, contrasenia) 
                    VALUES ('cliente' ,'$nombre', '$apellido', '$tipodocumento', '$documento', '$telefono', '$email', '$contrasenia')";

        //Validando usuario existente
        $verificarUsuario=mysqli_query($conexion, "SELECT * FROM usuario WHERE email='$email'");
        if (mysqli_num_rows($verificarUsuario)>0){
            echo "<script>alert('Este correo ya se encuentra registrado');window.location= '../vistas/Usuario/Registro.php'</script>";
        }else{
            $resultado = mysqli_query($conexion, $insertar);
            if (!$resultado){
                echo "<script>alert('Error al registrarse');window.location= '../vistas/Usuario/Registro.php'</script>";
            }else{
                echo "<script>alert('Usuario registrado');window.location= '../vistas/Shared/Login.php'</script>";
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
            header('Location: ../vistas/Usuario/Index.php');
        }else{
            header('Location: ../vistas/Administrador/Index.php');
        }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>