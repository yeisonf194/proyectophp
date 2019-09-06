<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
include '../../Modelos/Shoppingcart.php';
?>
<div class="container m-3">
  <div class="row d-flex">
    <article class="col-12 mt-3">
      <h1 class="text-center mb-5"><i class="fas fa-shopping-cart"></i> Tus Compras</h1>
    </article>
    <article class="col-12">
    <?php
    if(empty($_SESSION['carrito'])){
    ?>
    <h1 class="text-center my-5">Ups...</h1>
    <h4 class="text-center"><i class="fas fa-heart-broken"></i> Aun no has contratado ningun servicio</h4><br><br>
    <p class="text-center">
      <a class="btn btn-primary" href="Contratar.php">Catalogo</a>
    </p><br><br><br><br><br>
    <?php
    }else{
    ?>
    <article class="col">
        <div>
        <?php 
          if(isset($mensaje)){
        ?>
        <div style="padding:15px; background-color: rgba(215, 40, 40, 0.1);">
          <strong><?php echo $mensaje ?></strong>
        </div>
        <?php
          }else{
        ?>
            <div></div>
        <?php
          }
        ?>
          <table style="background-color: rgba(255,255,255,0.1); border-radius:20px">
            <thead>
              <tr>
                <th style="padding: 20px; width: 200px; text-align: center">Producto</th>
                <th style="padding: 20px; width: 200px; text-align: center">Especificaciones</th>
                <th style="padding: 20px; width: 200px; text-align: center">Precio Unidad</th>
                <th style="padding: 20px; width: 200px; text-align: center">Precio Total</th>
                <th style="padding: 20px; width: 300px; text-align: center"></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $total=0;
              $asistentes=$_SESSION['evento'][0]['asistentes'];
              foreach($_SESSION['carrito'] as $indice=>$producto){
            ?>
            <tr>  
              <td style="padding: 10px; text-align: center"><?php echo $producto['nombre'] ?></td>
              <td style="padding: 10px; text-align: center"><?php echo $producto['especificaciones'] ?></td>
              <td style="padding: 10px; text-align: center"><?php echo $producto['precio'] ?></td>
              <td style="padding: 10px; text-align: center"><?php 
              if($producto['idempresa']==2 || $producto['idempresa']==3){
                if($producto['idempresa']==2){
                echo $totalservicio=$producto['precio']*$asistentes;
                }else{
                  $botellas=round(($asistentes/6),0,PHP_ROUND_HALF_UP);
                  echo $totalservicio=$producto['precio']*$botellas;
                }
              }else{
                echo $totalservicio=$producto['precio'];
              }
              ?>
              </td>
              <td style="padding: 10px; text-align: center">
                <form action="" method="post">
                  <input type="hidden" name="empresa" value="<?php echo openssl_encrypt($producto['idempresa'],COD,KEY) ?>">
                  <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['idservicio'],COD,KEY) ?>">
                  <button class="btn btn-danger" name="btnAccion" value="eliminar" type="submit" style="border-radius:55px; width: 39px; height:39px"><h5><i class="fas fa-times"></i></h5></button>
                </form>
              </td>
            </tr>
            <?php
              $total=$total+($totalservicio);
              }
            ?> 
            <tr>  
              <td colspan="3" align="ridht" style="padding: 10px; text-align: center"><h3>Total</h3></td>
              <td align="right" style="padding: 10px; text-align: center"><?php echo $total?></td>
              <td style="padding: 10px; text-align: center"></td>
            </tr>  
            </tbody>
          </table><br><br>
          <div class="row">
              <div class="col text-center"><a href="Contratar.php" class="btn btn-primary">Agregar Producto</a></div>
              <div class="col text-center"><a href="../../Modelos/Usuario.php?op=contratando" class="btn btn-primary">Siguiente</a></div>
          </div><br><br>
        </div>
    </article>
    <?php
    }
    ?>
    </article>
  </div>
</div>
</div>
<?php
    require '../Shared/Footer.php';
}
?>