<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container">
          <section class="row main mt-5">
              <article class="row d-flex">
                  <div class="col-12">
                      <h1 class="text-center text-white mt-5 mb-5">Contratando</h1>
                  </div>
                  <div class="col-12">
                      <form method="POST" action="../../Modelos/procesosUsuario.php?op=addevent" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:40%; margin-left:340px">
                        <div class="row d-flex">
                            <div class="col-12 text-center">
                                <p><label class="text-center text-white">Evento:</label></p>
                                    <p><select name="tipoevento" style="border-radius:5px; color:#424141; width: 50%" required>
                                        <?php
                                            $consulta="SELECT nombre,categoria, idtipoevento FROM tipoevento";
                                            $resultado=mysqli_query($conexion,$consulta);
                                            while($mostrar=mysqli_fetch_array($resultado)){
                                                echo "<option value='".$mostrar['idtipoevento']."'>";
                                                echo $mostrar['nombre'].' '.$mostrar['categoria'];
                                                echo "</option>";
                                            }
                                        ?>    
                                    </select>
                                </p><br>
                            </div>
                            <div class="col-12 text-center">
                                <p><label class="text-center text-white">Numero de Asistentes:</label></p>
                                <p><input type="text" name="asistentes" style="border-radius:5px; color:#424141; width: 50%" required></p><br>
                            </div>
                            <div class="col-12 text-center">
                                <p><label class="text-center text-white">Fecha Evento:</label></p>
                                <p><input type="date" name="fechaEntrega" style="border-radius:5px; color:#424141; width: 50%" required></p><br>
                            </div>
                            <div class="col-12 text-center">
                                <p><button type="submit" class="btn btn-danger">Contratar</button></p>
                            </div>
                        </div>
                    </form><br><br>
                  </div>
              </article>
          </section>
      </div>
<?php
require '../Footer.php';
}
?>