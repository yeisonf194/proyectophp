<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
?>
<div class="container m-3" id="portfolio">
  <div class="row d-flex">
  <form action="../../Modelos/Usuario.php?op=contratar" method="POST">
  <h1 class="text-center">Contratar</h1><br><br>
  <p>
  <span>
    <label for="asistentes">Tipo de Evento</label>
    <select name="tipoevento" style="border-radius:5px; color:#424141; width: 20%" required>
    <?php 
      $consulta="SELECT * FROM tipoevento WHERE condicion=1";
      $resultado=mysqli_query($conexion,$consulta);
      while($mostrar=mysqli_fetch_array($resultado)){
      ?>
      <option value="<?php echo $mostrar['idtipoevento'] ?>"><?php echo $mostrar['nombre'].' '.$mostrar['categoria']?>
    <?php
      }
    ?>
    </select>
  </span>
  </p>
  <p>
  <span>
    <label for="asistentes">Numero de Asistentes</label>
    <input type="text" name="asistentes" placeholder="Invitados" style="border-radius:5px; color:#424141; width: 20%" required>
  </span>
  <span class="ml-5">
    <label for="fechaentrega">Fecha del Evento</label>
    <input type="date" name="fechaentrega" style="border-radius:5px; color:#424141; width: 20%" required>
  </span><br><br><br>
  </p>
    <article class="col-12">
        <h1>Restaurante</h1><br><br>
              <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                  <tr>
                  <th style="padding: 10px; width: 200px; text-align: center">Imagen</th>
                    <th style="padding: 10px; width: 200px; text-align: center">Nombre</th>
                    <th style="padding: 10px; width: 200px; text-align: center">Especificaciones</th>
                    <th style="padding: 10px; width: 200px; text-align: center">Precio</th>
                    <th style="padding: 5px; width: 300px; text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $precio="SELECT MAX(precio) as total FROM servicio WHERE idempresa=2";
                    $resul=$conexion->query($precio);
                    $rango=$resul->fetch_assoc();
                    $igualando=$rango["total"];
                    $dividiendo=$igualando/3;
                    $consulta="SELECT * FROM servicio WHERE idempresa=2 AND precio<=$dividiendo";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                    <tr>
                      <td style="padding: 10px; text-align: center"><img src="../../img/boda1.jpg" alt="boda" width="50%"></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                      <td style="padding: 10px; text-align: center"><input type="radio" value="<?php echo $mostrar['idservicio'] ?>" name="restaurante"> Comprar
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table><br><br>
        </article>
        <article class="col-12 mt-5">
        <h1>Licor</h1><br><br>
              <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                  <tr>
                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Especificaciones</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Precio</th>
                    <th style="padding: 20px; width: 300px; text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $consulta="SELECT * FROM servicio WHERE idempresa=3";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                    <tr>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                      <td style="padding: 10px; text-align: center"><input type="radio" value="<?php echo $mostrar['idservicio'] ?>" name="licor"> Comprar
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table><br><br>
        </article>
        <article class="col-12 mt-5">
        <h1>Fotografia</h1><br><br>
              <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                  <tr>
                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Especificaciones</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Precio</th>
                    <th style="padding: 20px; width: 300px; text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $consulta="SELECT * FROM fotografia";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                    <tr>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                      <td style="padding: 10px; text-align: center"><input type="radio" value="<?php echo $mostrar['idfotografia'] ?>" name="fotografia"> Comprar
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table><br><br>
        </article>
        <article class="col-12 mt-5">
        <h1>Salon</h1><br><br>
              <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                  <tr>
                    <th style="padding: 20px; width: 200px; text-align: center">Nombre</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Capacidad</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Precio</th>
                    <th style="padding: 20px; width: 300px; text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $consulta="SELECT * FROM salon";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                    <tr>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                      <td style="padding: 10px; text-align: center"><input type="radio" value="<?php echo $mostrar['idsalon'] ?>" name="salon"> Comprar
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table><br><br>
        </article>
        <article class="col-12 mt-5">
        <h1>Animacion</h1><br><br>
              <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
                <thead>
                  <tr>
                    <th style="padding: 20px; width: 200px; text-align: center">Tiempo</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Especificaciones</th>
                    <th style="padding: 20px; width: 200px; text-align: center">Precio</th>
                    <th style="padding: 20px; width: 300px; text-align: center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $consulta="SELECT * FROM animacion";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                    <tr>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['nombre'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['especificaciones'] ?></td>
                      <td style="padding: 10px; text-align: center"><?php echo $mostrar['precio'] ?></td>
                      <td style="padding: 10px; text-align: center"><input type="radio" value="<?php echo $mostrar['idanimacion'] ?>" name="animacion"> Comprar
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                  </tbody>
                </table><br><br>
        </article>
        <button type="submit" class="btn btn-primary">Comprar</button>
  </div>
</div>
<?php
require '../Shared/Footer.php';
}
?>
