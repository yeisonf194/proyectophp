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
                header('Location: ../vistas/Administrador/Empresa/Index.php');
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
    case 'editarEvento':
        if(is_numeric(openssl_decrypt($_POST['evento'], COD, KEY))){
            $evento=openssl_decrypt($_POST['evento'], COD, KEY);
            $nombre=$_POST["nombre"];
            $categoria=$_POST["categoria"];
            $imagen=$_POST["imagen"];
            $edit="UPDATE tipoevento SET nombre = '$nombre', categoria = '$categoria', imagen = '$imagen' WHERE idtipoevento = '$evento'";
            $editar = mysqli_query($conexion, $edit);
        }
        if (!$editar){
            echo "<script>alert('Error');window.location= '../vistas/Administrador/Evento.php</script>";
        }else{
            header('Location: ../vistas/Administrador/Evento.php');
        }
    break;
    case 'condicion':
        $idtipoevento=$_POST["delete"];
        $consultando=$conexion->query("SELECT condicion as condicion FROM tipoevento WHERE idtipoevento=$idtipoevento");
        $consulta=$consultando->fetch_assoc();
        $activador=$consulta["condicion"];
        if($activador==1){
            $activador=0;
        }else{
            $activador=1;
        }
        $consulta="UPDATE tipoevento SET condicion = '$activador' WHERE idtipoevento = $idtipoevento";
        $delete = mysqli_query($conexion, $consulta);
        if (!$delete){
            echo "<script>alert('Error');window.location= '../vistas/Administrador/Evento.php'</script>";
        }else{
            header('Location: ../vistas/Administrador/Evento.php');
        }
    break;
    case 'agregarEvento':
        $nombre=$_POST["nombre"];
        $tipo=$_POST["tipo"];
        $imagen=$_POST['imagen'];
        
        
        //Insertando servicio
        $insertar="INSERT INTO tipoevento(nombre, categoria, condicion, imagen) 
                    VALUES ('$nombre', '$tipo', '1', '$imagen')";


        $resultado = mysqli_query($conexion, $insertar);
        if (!$resultado){
            echo "<script>alert('Error');window.location= '../vistas/Administrador/Evento.php'</script>";
        }else{
            echo "<script>alert('Evento Agregado');window.location= '../vistas/Administrador/Evento.php'</script>";
        }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>