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
    case 'agregarNoticiacliente':
        $noticia=$_POST["noticia"];
        $condicion=$_POST["condicion"];
        $cliente=$_POST['cliente'];
        if($cliente==""){
            $insertar="INSERT INTO noticias(noticia, condicion, destino) 
                    VALUES ('$noticia', $condicion, 'cliente')";
            $resultado = mysqli_query($conexion, $insertar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=cliente');
            }
        }else{
            $insertar="INSERT INTO noticias(idusuario, noticia, condicion, destino) 
                    VALUES ($cliente, '$noticia', $condicion, 'cliente')";
            $resultado = mysqli_query($conexion, $insertar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=cliente');
            }
        }
    break;
    case 'agregarNoticiaempresa':
        $noticia=$_POST["noticia"];
        $condicion=$_POST["condicion"];
        $cliente=$_POST['cliente'];
        if($cliente==""){
            $insertar="INSERT INTO noticias(noticia, condicion, destino) 
                    VALUES ('$noticia', $condicion, 'empresa')";
            $resultado = mysqli_query($conexion, $insertar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=empresa');
            }
        }else{
            $insertar="INSERT INTO noticias(idusuario, noticia, condicion, destino) 
                    VALUES ($cliente, '$noticia', $condicion, 'empresa')";
            $resultado = mysqli_query($conexion, $insertar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=empresa');
            }
        }
    break;
    case 'editarNoticiacliente':
        $idnoticia=$_POST['idnoticia'];
        $noticia=$_POST["noticia"];
        $condicion=$_POST["condicion"];
        $cliente=$_POST['cliente'];
        if($cliente==""){
            $actualizar="UPDATE noticias SET condicion = $condicion, noticia='$noticia' WHERE idnoticias = $idnoticia";
            $resultado = mysqli_query($conexion, $actualizar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=cliente');
            }
        }else{
            $actualizar="UPDATE noticias SET condicion = $condicion, noticia='$noticia', idusuario=$cliente WHERE idnoticias = $idnoticia";
            $resultado = mysqli_query($conexion, $actualizar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=cliente');
            }
        }
    break;
    case 'editarNoticiaempresa':
        $idnoticia=$_POST['idnoticia'];
        $noticia=$_POST["noticia"];
        $condicion=$_POST["condicion"];
        $cliente=$_POST['cliente'];
        if($cliente==""){
            $actualizar="UPDATE noticias SET condicion = $condicion, noticia='$noticia' WHERE idnoticias = $idnoticia";
            $resultado = mysqli_query($conexion, $actualizar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=empresa');
            }
        }else{
            $actualizar="UPDATE noticias SET condicion = $condicion, noticia='$noticia', idusuario=$cliente WHERE idnoticias = $idnoticia";
            $resultado = mysqli_query($conexion, $actualizar);
            if ($resultado){
            header('Location: ../vistas/Administrador/Noticias.php?pagina=empresa');
            }
        }
    break;
    case 'eliminarnoticiacliente':
        $idnoticia=$_POST['idnoticia'];
        $eliminar="DELETE FROM noticias WHERE idnoticias=$idnoticia";
        $resultado = mysqli_query($conexion, $eliminar);
        if ($resultado){
        header('Location: ../vistas/Administrador/Noticias.php?pagina=cliente');
        }
break; 
case 'eliminarnoticiaempresa':
        $idnoticia=$_POST['idnoticia'];
        $eliminar="DELETE FROM noticias WHERE idnoticias=$idnoticia";
        $resultado = mysqli_query($conexion, $eliminar);
        if ($resultado){
        header('Location: ../vistas/Administrador/Noticias.php?pagina=empresa');
        }
break; 
    case 'buscarFactura':
        $codigo=$_POST['codigo'];
        $consulta="SELECT idevento FROM evento WHERE codigo='$codigo'";
        $resultado=mysqli_query($conexion, $consulta);
        $fila=mysqli_num_rows($resultado);
        if($fila=$resultado->fetch_object()){
            $_SESSION["idevento"]=$fila->idevento;
            echo json_encode($fila);
            header("Location: ../vistas/Administrador/Facturacion.php?pagina=mostrar");
        }else{
            header('Location: ../vistas/Administrador/Facturacion.php?pagina=sinresultados');
        }
    break;
    case 'cancelarfacturacion':
        unset($_SESSION['carrito'][$indice]);
        header('Location: ../vistas/Administrador/Facturacion.php?pagina=buscar');
    break;
    case 'abono':
        $pago=$_POST['pago'];
        $idevento=$_POST['idevento'];
        $idusuario=$_POST['idusuario'];
        $resul=$conexion->query("SELECT t.nombre, t.categoria, e.abono, e.saldo FROM evento e, tipoevento t WHERE idevento=$idevento AND e.idtipoevento=t.idtipoevento");
        $key=$resul->fetch_assoc();
        $nombre=$key["nombre"];
        $categoria=$key["categoria"];
        $abono=$key["abono"];
        $saldo=$key["saldo"];
        $evento=$nombre.' '.$categoria;
        $saldoactualizado=$saldo-$pago;
        $abonoactualizado=$abono+$pago;
        $mensaje='Has realizado el abono de tu evento tipo '.$evento.' por un valor de $'.number_format($pago, 0, ',', '.').'. Saldo $'.number_format($saldoactualizado, 0, ',', '.');
        $actualizar="UPDATE evento SET abono = $abonoactualizado, saldo=$saldoactualizado WHERE idevento = $idevento";
            $resultado = mysqli_query($conexion, $actualizar);
            if ($resultado){
                $noticia = mysqli_query($conexion, "INSERT INTO noticias(idusuario, noticia, condicion, destino) 
                VALUES (2,'$mensaje', 1, 'cliente')");
                if($noticia){
                    header('Location: ../vistas/Administrador/Facturacion.php?pagina=mostrar');
                }
                $abono=0;
                $abonoactualizado=0;
                $saldo=0;
                $saldoactualizado=0;
            }
    break;
    case 'salir':
        session_destroy();
        header("Location: ../vistas/Shared/Login.php");
    break;
}

?>