<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Shared/Login.php");
}else{
require 'Header.php';
require '../../../Config/Conexion.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><h1 class="text-center mt-5 mb-4">Agrega Producto</h1><br></div>
        <div class="col-6 justify-aling-center">
            <form method="POST" action="../../../Modelos/ProcesosAdmin.php?op=agregarServicio" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
                <div class="row d-flex">
                    <div class="col-6 pr-5">
                        <p>
                        <label for="name" class="text-white">Nombre del producto</label>
                        <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5 text-white">
                        <p><label>Empresa:</label>
                            <select name="empresa" style="border-radius:5px; color:#424141; width: 100%">
                                <?php
                                    $consulta="SELECT nombre, idempresa FROM empresa WHERE idempresa='4' OR idempresa='2'";
                                    $resultado=mysqli_query($conexion,$consulta);
                                    while($mostrar=mysqli_fetch_array($resultado)){
                                        echo "<option value='".$mostrar['idempresa']."'>";
                                        echo $mostrar['nombre'];
                                        echo "</option>";
                                    }
                                    ?>    
                            </select>
                        </p>
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
require '../../Footer.php';
}
?>