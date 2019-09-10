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
      <a class="btn btn-primary" href="Contratar.php?pagina=contratar">Catalogo</a>
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
                <th style="padding: 20px; width: 150px; text-align: center">Producto</th>
                <th style="padding: 20px; width: 300px; text-align: center">Nombre</th>
                <th style="padding: 20px; width: 100px; text-align: center">Precio Unidad</th>
                <th style="padding: 20px; width: 150px; text-align: center">Precio Total</th>
                <th style="padding: 20px; width: 200px; text-align: center"></th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $total=0;
              $asistentes=$_SESSION['evento'][0]['asistentes'];
              foreach($_SESSION['carrito'] as $indice=>$producto){
            ?>
            <tr>  
              <td style="padding: 10px; text-align: center"><img src="../../productos/<?php echo $producto['imagen'] ?>" alt="" width="60%"></td>
              <td style="padding: 10px; text-align: center"><?php echo $producto['nombre'] ?></td>
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
              <div class="col text-center"><a href="Contratar.php?pagina=contratar" class="btn btn-primary">Agregar Producto</a>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#facturacion">Siguiente</button>
          </div>
              
              <!-- Modal -->
              <div class="modal fade" id="facturacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
              <?php
foreach($_SESSION['evento'] as $indice=>$producto){
  $evento=$producto['tipoevento'];
  $entrega=$producto['fechaentrega'];
  $asistentes=$producto['asistentes'];
  $categoria=$producto['categoria'];
  $tipoevento=$producto['idtipoevento'];
}
foreach($_SESSION['eventos'] as $indice=>$producto){
  $evento=$producto['tipoevento'];
  $entrega=$producto['fechaentrega'];
  $asistentes=$producto['asistentes'];
}
$rand = range(10, 99);
shuffle($rand);
foreach ($rand as $val) {
}
$idusuario=$_SESSION['idusuario'];
$resul=$conexion->query("SELECT nombre, apellido, documento FROM usuario WHERE idusuario=$idusuario");
$key=$resul->fetch_assoc();
$nombre=$key["nombre"];
$apellido=$key["apellido"];
$cedula=$key["documento"];
$nombreusuario=$nombre. $apellido;
ini_set('date.time','America/Bogota');
$facturacion = date('Y-m-d', time());
$fechareserva = date('Ymd', time());
$codigofactura=$fechareserva.$tipoevento.$idusuario.$val;
?>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-2">
            <img src="../../img/icon.png" alt="" width="50%">
          </div>
          <div class="col-lg-10"><h2 class="h2-responsive ml-5"><strong>Factura de Compra</strong></h2></div>
        </div>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <!-- <h3 class="panel-title">Cabecera</h3> -->
					<hr>
                    <div class="row">
                        <div class="col-4"><p>Nombre: <?php echo $nombreusuario?></p></div>
                        <div class="col-4"><p>Fecha factura: <?php echo $fechareserva?></p></div>
                        <div class="col-4"><p><img src="../../js/barcode.php?text=EV<?php echo $codigofactura?>&size=30&orientation=horizontal&codetype=Code39" alt=""></p></div>
                    </div> <!-- row -->
                    <br>
                    <div class="row">
                        <div class="col-md-6"> 
                          <address>
                           <strong class="">Eventos Guatoc</strong><br class="">
                            Carrera 6 No. 26 A<br class="">
                            eventosguatocoficial@gmail.com<br class="">
                            754098675<br class="">                          
                           </address>
                        </div>
                   </div> <!-- row -->
				</div> <!-- panel heading -->
				<div class="panel-body mt-3">
				  <h3 class="panel-title">Detalle <small> <?php echo $evento.' '.$categoria?></small></h3>
				  
				  <table class="table table-condensed">
					<thead>
					  <tr>
						<th class="">Producto</th>
						<th class="">Nombre</th>
						<th class="">Empresa</th>
						<th class="">Cantidad</th>
						<th class="">Precio</th>
						<th class="">Total</th>
					  </tr>
					</thead>
					<tbody>
          <?php
          $contador=1;
          foreach($_SESSION['carrito'] as $indice=>$producto){
            $idproducto=$producto['idservicio'];
            $resul=$conexion->query("SELECT e.nombre as nombre FROM empresa e, producto p WHERE p.idempresa=e.idempresa AND idproducto=$idproducto");
            $key=$resul->fetch_assoc();
            $empresa=$key["nombre"];
          ?>

					  <tr>
						<td class=""><?php echo $contador?></td>
						<td class=""><?php echo $producto['nombre']?></td>
						<td class=""><?php echo $empresa?></td>
            <td class=""><?php 
              if($producto['idempresa']==2 || $producto['idempresa']==3){
                if($producto['idempresa']==2){
                echo $asistentes;
                }else{
                  $botellas=round(($asistentes/6),0,PHP_ROUND_HALF_UP);
                  echo $botellas;
                }
              }else{
                echo '1';
              }
              ?></td>
						<td class=""><?php echo $producto['precio']?></td>
						<td class=""><?php 
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
              ?></td>
					  </tr>
            <?php
            $contador++;
          }
            ?>
					  </tr>
            <tr>  
              <td colspan="5" align="ridht" style="padding: 10px; text-align: center"><h5>Total</h5></td>
              <td align="right" style="padding: 10px; text-align: center"><h5><?php echo $total?></h5></td>
            </tr>
					</tbody>
				  </table>
				</div> <!-- panel body --> 
        </div>
        <form action="../../Modelos/Usuario.php?op=contratando" method="POST">
        <div class="row">
          <div class="col-12 my-3 p-5 text-center"><input type="checkbox" required> Yo <?php echo $nombreusuario?> con cedula No. <?php echo $cedula ?> indico aceptar los terminos y condiciones de EventosGuatoc por motivo de contratacion de <?php echo $contador-1?>
          servicios para el Evento tipo <?php echo $evento.' '.$categoria?> por un total de $<?php echo $total?>. Evento programado para el dia <?php echo $entrega?> con un total de 
          <?php echo $asistentes?> invitados. <br><br><p><strong>Atencion: </strong>Para hacer efectiva la contratacion para su evento debera acercarse dentro de los proximos cinco (5) dias habiles a la Carrera 6 No. 26 A para realizar el pago correspondiente al evento. Recuerde llevar impresa esta factura</p> <hr></div>
        </div>
      </div>
      <div class="col text-center">
      
      
        <input type="hidden" value="<?php echo $codigofactura?>" name="codigo">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Finalizar</button>
      
      </div>
      </form>
    </div>
  </div>
</div>
              </div>
              
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