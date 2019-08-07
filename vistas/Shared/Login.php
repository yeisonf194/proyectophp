<?php
require 'Header.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><h1 class="text-white text-center mt-5 mb-4">Ingresar</h1><br></div>
        <div class="col-6 justify-aling-center">
            <form method="POST" action="../../Modelos/Registrar.php?op=ingreso" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
                <div class="row d-flex">
                    <div class="col-12 text-center">
                        <p>
                        <label for="name" class="text-white">Correo</label><br>
                        <input type="text" name="usuario" style="border-radius:5px; color:#424141; width: 80%" required>
                        </p><br>
                    </div>
                    <div class="col-12 text-center">
                        <p>
                        <label for="name" class="text-white">Contraseña</label><br>
                        <input type="text" name="clave" style="border-radius:5px; color:#424141; width: 80%" required>
                        </p><br>
                    </div>
                    <div class="col-12 text-center">
                        <p><button type="submit" class="btn btn-danger">Ingresar</button></p>
                    </div>
                </div>
            </form><br><br>
        </div>
    </div>
</div>
<?php
require '../Footer.php';
?>