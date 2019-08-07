<?php
require '../Shared/Header.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><h1 class="text-white text-center mt-5 mb-4">Formulario de Registro</h1><br></div>
        <div class="col-6 justify-aling-center">
            <form method="POST" action="../../Modelos/Registrar.php?op=registrar" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%; margin-left:280px">
                <div class="row d-flex">
                    <div class="col-6 pr-5">
                        <p>
                        <label for="name" class="text-white">Ingrese su nombre</label>
                        <input type="text" placeholder="Ingrese sus nombres" name="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5">
                        <p>
                        <label for="name" class="text-white">Apellidos</label>
                        <input type="text" placeholder="Ingrese sus apellidos" name="apellido" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pr-5 text-white">
                        <p><label>Tipo documento</label>
                            <select name="tipodocumento" style="border-radius:5px; color:#424141; width: 100%">
						        <option value="cc" selected="select">Cedula de ciudadania</option>
						        <option value="ce">Cedula de extranjeria</option>
                            </select>
                        </p>
                    </div>
                    <div class="col-6 pl-5">
                        <p>
                        <label class="text-white">Documento</label>
                        <input type="text" placeholder="Numero de documento" name="documento" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-12 mb-5 text-center">
                        <label for="name" class="text-white">Ingrese su Correo</label>
                        <input type="email" placeholder="Ingrese su email" name="email" style="border-radius:5px; color:#424141; width: 100%" required>
                        <span id="infoUser" class="text-danger"></span>
                    </div>
                    <div class="col-12 text-center">
                        <p>
                        <label for="name" class="text-white">Telefono</label><br>
                        <input type="text" placeholder="333 3333 33" name="telefono" style="border-radius:5px; color:#424141; width: 80%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pr-5">
                        <p>
                        <label for="name" class="text-white">Contraseña</label>
                        <input type="text" placeholder="Ingresa una contraseña" name="contrasenia" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br>
                    </div>
                    <div class="col-6 pl-5">
                        <p>
                        <label for="name" class="text-white">Confirma tu contraseña</label>
                        <input type="text" placeholder="Contraseña" name="passAgain" style="border-radius:5px; color:#424141; width: 100%" required>
                        </p><br><br>
                    </div>
                    <div class="col-12 text-center">
                        <p><button type="submit" class="btn btn-primary">Enviar</button></p>
                    </div>
                </div>
            </form><br><br>
        </div>
    </div>
</div>
<?php
require '../Footer.php';
?>