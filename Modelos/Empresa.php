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
            echo "<script>alert('Datos Incorrectos');window.location= '../vistas/Empresa/Login.php'</script>";
        }
    break;
    case 'agregaProducto':
        $nombre=$_POST["nombre"];
        $especificaciones=$_POST["especificaciones"];
        $precio=$_POST["precio"];
        $empresa=$_SESSION["tipo"];
        $idempresa=$_SESSION["idempresa"];

        switch($empresa){
            case 'Animacion':
                $insertar="INSERT INTO animacion(nombre, idempresa, especificaciones, precio, condicion) 
                            VALUES ('$nombre', $idempresa, '$especificaciones', $precio, 1)";


                $verificarServicio=mysqli_query($conexion, "SELECT * FROM animacion WHERE nombre='$nombre'");
                if (mysqli_num_rows($verificarServicio)>0){
                    echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
                }else{
                    $resultado = mysqli_query($conexion, $insertar);
                }
            break;
            case 'Fotografia':
                $insertar="INSERT INTO fotografia(nombre, idempresa, especificaciones, precio, condicion) 
                            VALUES ('$nombre', $idempresa, '$especificaciones', $precio, 1)";


                $verificarServicio=mysqli_query($conexion, "SELECT * FROM fotografia WHERE nombre='$nombre'");
                if (mysqli_num_rows($verificarServicio)>0){
                    echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
                }else{
                    $resultado = mysqli_query($conexion, $insertar);
                }
            break;
            case 'Club':
                $insertar="INSERT INTO salon(nombre, idempresa, capacidad, precio, condicion) 
                            VALUES ('$nombre', $idempresa, $especificaciones, $precio, 1)";


                $verificarServicio=mysqli_query($conexion, "SELECT * FROM salon WHERE nombre='$nombre'");
                if (mysqli_num_rows($verificarServicio)>0){
                    echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
                }else{
                    $resultado = mysqli_query($conexion, $insertar);
                }
            break;
            case 'Restaurante':
                $insertar="INSERT INTO producto(idempresa,nombre, especificaciones, precio, condicion) 
                                        VALUES (2, $nombre, $especificaciones, $precio, 1)";


                $verificarServicio=mysqli_query($conexion, "SELECT * FROM producto WHERE nombre='$nombre'");
                if (mysqli_num_rows($verificarServicio)>0){
                    echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
                }else{
                    $resultado = mysqli_query($conexion, $insertar);
                }
            break;
            case 'Licor':
            $insertar="INSERT INTO producto(idempresa,nombre, especificaciones, precio, condicion) 
            VALUES ($idempresa, $nombre, '$especificaciones', $precio, 1)";


                $verificarServicio=mysqli_query($conexion, "SELECT * FROM producto WHERE nombre='$nombre'");
                if (mysqli_num_rows($verificarServicio)>0){
                    echo "<script>alert('Este servicio ya se encuentra registrado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
                }else{
                    $resultado = mysqli_query($conexion, $insertar);
                }
            break;
        }
        if (!$resultado){
            echo "<script>alert('Error');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
        }else{
            echo "<script>alert('Servicio Agregado');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
        }
    break;
    case 'editar':
    $empresa=$_SESSION["tipo"];
    $idempresa=$_SESSION["idempresa"];
        if(is_numeric(openssl_decrypt($_POST['producto'], COD, KEY))){
            $producto=openssl_decrypt($_POST['producto'], COD, KEY);
            switch($empresa){
                case 'Fotografia':
                    $nombre=$_POST["nombre"];
                    $especificaciones=$_POST["especificaciones"];
                    $precio=$_POST["precio"];
                    $edit="UPDATE fotografia SET nombre = '$nombre', especificaciones = '$especificaciones', precio = $precio WHERE idfotografia = $producto  AND idempresa = $idempresa";
                    $editar = mysqli_query($conexion, $edit);
                break;
                case 'Club':
                    $nombre=$_POST["nombre"];
                    $especificaciones=$_POST["especificaciones"];
                    $precio=$_POST["precio"];
                    $edit="UPDATE salon SET nombre = '$nombre', especificaciones = '$especificaciones', precio = '$precio' WHERE idsalon = '$producto'  AND idempresa = $idempresa";
                    $editar = mysqli_query($conexion, $edit);
                break;
                case 'Animacion':
                    $nombre=$_POST["nombre"];
                    $especificaciones=$_POST["especificaciones"];
                    $precio=$_POST["precio"];
                    $edit="UPDATE animacion SET nombre = '$nombre', especificaciones = '$especificaciones', precio = '$precio' WHERE idanimacion = '$producto'  AND idempresa = $idempresa";
                    $editar = mysqli_query($conexion, $edit);
                break;
                default:
                    $nombre=$_POST["nombre"];
                    $especificaciones=$_POST["especificaciones"];
                    $precio=$_POST["precio"];
                    $edit="UPDATE producto SET nombre = '$nombre', especificaciones = '$especificaciones', precio = '$precio' WHERE idproducto = '$producto'  AND idempresa = $idempresa";
                    $editar = mysqli_query($conexion, $edit);
                break;
            }
            if (!$editar){
                echo "<script>alert('Error');window.location= '../vistas/Empresa/Producto.php?opcion=activo</script>";
            }else{
                header('Location: ../vistas/Empresa/Producto.php?opcion=activo');
            }
        }
    break;
    case 'delete':
    $idempresa=$_SESSION["idempresa"];
    $empresa=$_SESSION["tipo"];
        $producto=$_POST["delete"];
        switch($empresa){
            case 'Fotografia':
                $consultando=$conexion->query("SELECT condicion as condicion FROM fotografia WHERE idfotografia='$producto' AND idempresa=$idempresa ");
                $consulta=$consultando->fetch_assoc();
                $activador=$consulta["condicion"];
                if($activador==1){
                    $activador=0;
                }else{
                    $activador=1;
                }
                $consulta="UPDATE fotografia SET condicion = '$activador' WHERE idfotografia = '$producto'  AND idempresa = $idempresa";
                $delete = mysqli_query($conexion, $consulta);  
            break;
            case 'Club':
                $consultando=$conexion->query("SELECT condicion as condicion FROM salon WHERE idsalon='$producto' AND idempresa=$idempresa ");
                $consulta=$consultando->fetch_assoc();
                $activador=$consulta["condicion"];
                if($activador==1){
                    $activador=0;
                }else{
                    $activador=1;
                }
                $consulta="UPDATE salon SET condicion = '$activador' WHERE idsalon = '$producto'  AND idempresa = $idempresa";
                $delete = mysqli_query($conexion, $consulta);  
            break;
            case 'Animacion':
                $consultando=$conexion->query("SELECT condicion as condicion FROM animacion WHERE idanimacion='$producto' AND idempresa=$idempresa ");
                $consulta=$consultando->fetch_assoc();
                $activador=$consulta["condicion"];
                if($activador==1){
                    $activador=0;
                }else{
                    $activador=1;
                }
                $consulta="UPDATE animacion SET condicion = '$activador' WHERE idanimacion = '$producto'  AND idempresa = $idempresa";
                $delete = mysqli_query($conexion, $consulta);  
            break;
            default:
                $consultando=$conexion->query("SELECT condicion as condicion FROM producto WHERE idproducto='$producto' AND idempresa=$idempresa ");
                $consulta=$consultando->fetch_assoc();
                $activador=$consulta["condicion"];
                if($activador==1){
                    $activador=0;
                }else{
                    $activador=1;
                }
                $consulta="UPDATE producto SET condicion = '$activador' WHERE idproducto = '$producto'  AND idempresa = $idempresa";
                $delete = mysqli_query($conexion, $consulta);
            break;
        }
        if (!$delete){
            echo "<script>alert('Error');window.location= '../vistas/Empresa/Producto.php?opcion=activo'</script>";
        }else{
            if($activador==1){header('Location: ../vistas/Empresa/Producto.php?opcion=inactivo');}else{header('Location: ../vistas/Empresa/Producto.php?opcion=activo');}
        }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Empresa/Login.php");
    break;
}

?>