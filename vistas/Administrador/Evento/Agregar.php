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
        <div class="col-12"><h1 class="text-center mt-5 mb-4">Agregar Evento</h1><br></div>
        <div class="col-6 justify-aling-center">
            <form method="POST" action="../../../Modelos/ProcesosAdmin.php?op=agregarEvento" style="background-color: rgba(0,0,0,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
                <div class="row d-flex">
                    <div class="col-6 pr-5">
                        <p>
                        <label for="name" class="text-white">Nombre del Evento</label>
                        <input type="text" placeholder="Nombre" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pr-5">
                        <p><label for="tipo" class="text-white">Categoria:</label>
                        <select name="tipo" style="border-radius:5px; color:#424141; width: 100%">
							<option value="Basico" selected="select">Basico</option>
							<option value="Estandar">Estandar</option>
							<option value="Premium">Premium</option>
						</select></p><br>
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