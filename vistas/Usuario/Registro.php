<?php
require '../Shared/Header.php';
?>
<div class="container">
    <div class="row d-flex">
        <div class="col-12"><br><br><br><h1 class="text-white text-center mt-5 mb-4">Formulario de Registro</h1><br></div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-6">
                <form method="POST" action="../../Modelos/Registrar.php?op=registrar" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                    <div class="row d-flex">
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label for="name" class="text-white">Ingrese su nombre</label>
                            <input type="text" placeholder="Ingrese sus nombres" name="nombre" id="nombre" style="border-radius:5px; color:#424141; width: 100%" required>
                            </p><span class="text-danger" id="infonombre"></span><br>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label for="name" class="text-white">Apellidos</label>
                            <input type="text" placeholder="Ingrese sus apellidos" id="apellido" name="apellido" style="border-radius:5px; color:#424141; width: 100%" required>
                            </p><span class="text-danger" id="infoapellido"></span><br>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label for="name" class="text-white">Telefono</label><br>
                            <input type="text" data-toggle="popover" title="Ingrese un numero de telefono" placeholder="333 3333 33" id="telefono" name="telefono" style="border-radius:5px; color:#424141; width: 80%" required><br>
                            </p><span class="text-danger" id="infotelefono"></span><br>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label class="text-white">Documento</label>
                            <input type="text" placeholder="Numero de documento" id="documento" name="documento" style="border-radius:5px; color:#424141; width: 100%" required>
                            </p><span class="text-danger" id="infodocumento"></span><br>
                        </div>
                        <div class="col-12 mb-5 text-center">
                            <label for="name" class="text-white">Ingrese su Correo</label>
                            <input type="email" placeholder="Ingrese su correo" id="correo" name="email" style="border-radius:5px; color:#424141; width: 100%" required>
                            <span class="text-danger" id="infocorreo"></span>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label for="name" class="text-white">Contraseña</label>
                            <input type="text" placeholder="Ingresa una contraseña" id="clave" name="contrasenia" style="border-radius:5px; color:#424141; width: 100%" required>
                            </p><span class="text-danger" id="infoclave"></span><br>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <p>
                            <label for="name" class="text-white">Confirma tu contraseña</label>
                            <input type="text" placeholder="Contraseña" id="confirmaclave" name="passAgain" style="border-radius:5px; color:#424141; width: 100%" required>
                            </p><span class="text-danger" id="infoclaveconfirma"></span><br><br>
                        </div>
                        <div class="col-12 text-center">
                            <p><button class="btn btn-primary">Enviar</button><p id="prueba"></p></p>
                        </div>
                    </div>
                </form><br><br>
            </div>
        </div>
    </div>
</div>
<script src="../js/script.js"></script>
<?php
require '../Shared/Footer.php';
?>