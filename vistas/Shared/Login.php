<?php
require 'Header.php';
?>
<section class="row justify-content-center">
    <article class="col-12">
        <h1 class="text-center text-white">Inicio de Sesion</h1><br>
    </article>
    <article>
        <form method="POST" action="../../Modelos/Registrar.php?op=ingreso" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
            <p>
                <label for="name" class="text-white">Ingrese su correo</label>
                <input type="email" name="usuario" style="border-radius:5px; color:#424141; width: 100%" required>
            </p><br>
            <p>
                <label for="name" class="text-white">Contraseña</label>
                <input type="password" name="clave" style="border-radius:5px; color:#424141; width: 100%" required>
            </p><br>
            <p><button type="submit" class="btn btn-primary">Enviar</button></p>
        </form>
    </article>
</section>

<?php
require 'Footer.php';
?>