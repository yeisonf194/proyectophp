<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Empresa/Login.php");
}else{
require '../Shared/Header.php';
require '../../../Config/Conexion.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><h1 class="text-center mt-5 mb-4">Agrega Producto</h1><br></div>
        <div class="col-6 justify-aling-center">
        <?php
        $idempresa=$_SESSION["idempresa"];
        switch($idempresa){
            case '4':
            ?>
            <form method="POST" action="../../../Modelos/Empresa.php?op=agregafoto" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
            <?php
            break;
            case '5':
            ?>
            <form method="POST" action="../../../Modelos/Empresa.php?op=agregaclub" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
            <?php
            break;
            case '6':
            ?>
            <form method="POST" action="../../../Modelos/Empresa.php?op=agregaanimacion" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
            <?php
            break;
            default:
            ?>
            <form method="POST" action="../../../Modelos/Empresa.php?op=agregarServicio" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
            <?php
            break;
        }
        ?>
                <div class="row d-flex">
                    <div class="col-12">
                        <p>
                        <label for="name" class="text-white">Nombre del producto</label>
                        <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    
                    <div class="col-6 pr-5">
                        <p>
                            <label for="name" class="text-white">Especificaciones</label><br>
                            <input type="text" name="especificaciones" style="border-radius:5px; color:#424141; width: 80%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5 text-white">
                        <label for="name" class="text-white">Precio</label>
                        <input type="text" name="precio" style="border-radius:5px; color:#424141; width: 100%" required>
                    </div>
                    <div class="col-6 text-center">
                        <p><button type="submit" class="btn btn-primary">Agregar</button></p>
                    </div>
                    <div class="col-6 text-center">
                        <p><a href="Index.php" class="btn btn-danger">Cancelar</a></p>
                    </div>
                </div>
            </form><br><br>
        </div>
    </div>
</div>
<?php
require '../Shared/Footer.php';
}
?>