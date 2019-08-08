<?php
session_start();
if(!isset($_SESSION["rol"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../../Shared/Login.php");
}else{
require 'Header.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><h1 class="text-center mt-5 mb-4">Agrega Empresa</h1><br></div>
        <div class="col-6 justify-aling-center">
            <form method="POST" action="../../../modelos/ProcesosAdmin.php?op=agregarEmpresa" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
                <div class="row d-flex">
                    <div class="col-6 pr-5">
                        <p>
                        <label for="name" class="text-white">Nombre de la empresa</label>
                        <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5">
                        <p>
                        <label for="name" class="text-white">Nit</label>
                        <input type="text" placeholder="1111 1111 1111" name="nit" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pr-5">
                        <p>
                            <label for="name" class="text-white">Telefono</label><br>
                            <input type="text" placeholder="333 3333 33" name="telefono" style="border-radius:5px; color:#424141; width: 80%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5 text-white">
                        <p><label>Empresa tipo:</label>
                            <select name="tipo" style="border-radius:5px; color:#424141; width: 100%">
                                <option value="Restaurante" selected="select">Restaurante</option>
                                <option value="Animacion">Animacion</option>
                                <option value="Licor">Licor</option>
                                <option value="Fotografia">Fotografia</option>
                                <option value="Club">Club</option>
                            </select>
                        </p>
                    </div>
                    <div class="col-12 mb-5 text-center">
                        <label for="name" class="text-white">Correo</label>
                        <input type="email" placeholder="Correo de la empresa" name="email" style="border-radius:5px; color:#424141; width: 100%" required>
                    </div>
                    <div class="col-12 mb-5 text-center">
                        <label for="name" class="text-white">Contraseña</label>
                        <input type="text" placeholder="Contraseña" name="clave" style="border-radius:5px; color:#424141; width: 100%" required>
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
require '../Footer.php';
}
?>