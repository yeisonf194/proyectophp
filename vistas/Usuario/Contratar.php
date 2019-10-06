<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php';
require '../../Config/Conexion.php';
include '../../Modelos/Shoppingcart.php'
?>
<div class="container m-3" style="width:100%">
  <?php
  switch($_GET["pagina"]){
    case 'categoria':
    ?>
    <form action="../../Modelos/Usuario.php?op=agregarCategoria" method="POST">
      <div class="row">
        <div class="col-12"><h1 class="text-center">Elige una Categoria</h1></div>
        <div class="col-12"><p class="text-center">En Eventos Guatoc tu eliges la categoria de tu evento</p></div>
      </div>
      <div class="row justify-content-center mt-5">
      <?php
      $evento=$_SESSION['eventos'][0]['tipoevento'];
        $consulta="SELECT categoria FROM tipoevento WHERE nombre='$evento' AND condicion=1";
        $resultado=mysqli_query($conexion,$consulta);
        while($mostrar=mysqli_fetch_array($resultado)){
      ?>
      <div class="col-4 text-center mb-5">
        <button type="submit" name="categoria" value="<?php echo $mostrar['categoria'] ?>" class="btn btn-lg btn-danger"><?php echo $mostrar['categoria']?></button>
      </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <?php
        }
      ?>
      </div>
    </form>
    <?php
    break;
    case 'contratar':
    ?>
    <div class="row d-flex">
    <a href="Shoppingcart.php" class="btn btn-primary "><i class="fas fa-shopping-cart"></i> Compras<?php echo(empty($_SESSION['carrito']))?'':'<span class="badge badge-pill badge-danger">'.count($_SESSION['carrito'])?></span></a>
    <?php
      $restaurante=true;
      $licor=true;
      $fotografia=true;
      $salon=true;
      $animacion=true;
      if(empty($_SESSION["carrito"])){
      }else{
        foreach($_SESSION['carrito'] as $indice=>$producto){
          if($producto['idempresa']==4){
            $fotografia=false;
          }
          if($producto['idempresa']==5){
            $salon=false;
          }
          if($producto['idempresa']==6){
            $animacion=false;
          }
        }
      }
    ?>
   <article class="row justify-content-center my-5">
     <div class="col-12 mb-5"><h1 class="text-center">Restaurante</h1></div>
      <?php
        $resultado = mysqli_query($conexion, 'SELECT s.idproducto as idservicio, s.idempresa, s.nombre, s.especificaciones, s.precio, e.tipo, e.nombre as empresa, s.imagen as imagen FROM producto s, empresa e WHERE s.idempresa=2 AND s.idempresa=e.idempresa AND condicion=1');
        while($mostrar=mysqli_fetch_array($resultado)){
      ?>
      <div class="col-sm-12 col-lg-3">
          <div class="card border-ligth m-4" style="width:90%">
            <img class="card-img-top" src="../../productos/<?php echo $mostrar['imagen'] ?>"  alt="">
            <div class="card-body" height="500px">
              <h4 class="card-title"><?php echo $mostrar['nombre'] ?></h4>
              <p>Precio: $<?php echo number_format($mostrar['precio'], 0, ',', '.')?></p>
              <a data-toggle="modal" href="#servicios<?php echo $mostrar['idservicio']?>" class="btn btn-primary">Ver</a>
            </div>
          </div>
      </div>

          <!-- Modal -->
            <div class="portfolio-modal modal fade" id="servicios<?php echo $mostrar['idservicio']?>" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                      <div class="rl"></div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                          <!-- Project Details Go Here -->
                          <h4 class="text-uppercase"><?php echo $mostrar['nombre'] ?></h4>
                          <img class="img-fluid d-block mx-auto" src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="">
                          <p class="item-intro"><?php echo $mostrar['especificaciones'] ?></p>
                          <ul class="list-inline">
                            <li>Empresa: <?php echo $mostrar['empresa'] ?></li>
                            <li>Precio por plato: $<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></li>
                            <li>Categoria: <?php echo $mostrar['tipo'] ?></li>
                          </ul>
                          <form action="" method="POST">
                            <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($mostrar['imagen'],COD,KEY) ?>">
                            <input type="hidden" name="idservicio" id="idservicio" value="<?php echo openssl_encrypt($mostrar['idservicio'],COD,KEY) ?>">
                            <input type="hidden" name="idempresa" id="idempresa" value="<?php echo openssl_encrypt($mostrar['idempresa'],COD,KEY) ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mostrar['nombre'],COD,KEY) ?>">
                            <input type="hidden" name="especificaciones" id="especificaciones" value="<?php echo openssl_encrypt($mostrar['especificaciones'],COD,KEY)?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($mostrar['precio'],COD,KEY)?>">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
        }
          ?>
        </div>
    </article>
    <article class="row justify-content-center my-5">
        <div class="col-12 mb-5"><h1 class="text-center">Licor</h1></div>
          <?php
            $resultado = mysqli_query($conexion, 'SELECT s.idproducto as idservicio, s.idempresa, s.nombre, s.especificaciones, s.precio, e.tipo, e.nombre as empresa, s.imagen as imagen FROM producto s, empresa e WHERE s.idempresa=3 AND s.idempresa=e.idempresa');
            while($mostrar=mysqli_fetch_array($resultado)){
          ?>
          <div class="col-sm-12 col-lg-3">
          <div class="card border-ligth m-4" style="width:90%">
            <img class="card-img-top" src="../../productos/<?php echo $mostrar['imagen'] ?>"  alt="">
            <div class="card-body" height="500px">
              <h4 class="card-title"><?php echo $mostrar['nombre'] ?></h4>
              <p>Precio: $<?php echo number_format($mostrar['precio'], 0, ',', '.')?></p>
              <a data-toggle="modal" href="#servicios<?php echo $mostrar['idservicio']?>" class="btn btn-primary">Ver</a>
            </div>
          </div>
      </div>

          <!-- Modal -->
            <div class="portfolio-modal modal fade" id="servicios<?php echo $mostrar['idservicio']?>" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                      <div class="rl"></div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                          <!-- Project Details Go Here -->
                          <h2 class="text-uppercase"><?php echo $mostrar['nombre'] ?></h2>
                          <img class="img-fluid d-block mx-auto" src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="">
                          <p class="item-intro"><?php echo $mostrar['especificaciones'] ?></p>
                          <ul class="list-inline">
                            <li>Empresa: <?php echo $mostrar['empresa'] ?></li>
                            <li>Precio por plato: $<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></li>
                            <li>Categoria: <?php echo $mostrar['tipo'] ?></li>
                          </ul>
                          <form action="" method="POST">
                            <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($mostrar['imagen'],COD,KEY) ?>">
                            <input type="hidden" name="idservicio" id="idservicio" value="<?php echo openssl_encrypt($mostrar['idservicio'],COD,KEY) ?>">
                            <input type="hidden" name="idempresa" id="idempresa" value="<?php echo openssl_encrypt($mostrar['idempresa'],COD,KEY) ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mostrar['nombre'],COD,KEY) ?>">
                            <input type="hidden" name="especificaciones" id="especificaciones" value="<?php echo openssl_encrypt($mostrar['especificaciones'],COD,KEY)?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($mostrar['precio'],COD,KEY)?>">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <?php
          }
          ?>
        </div>
      </article>
      <?php
    if($fotografia==true){
  ?>
    <article class="row justify-content-center my-5">
        <div class="col-12 mb-5"><h1 class="text-center">Fotografia</h1></div>
          <?php
            $resultado = mysqli_query($conexion, 'SELECT s.idfotografia, s.idempresa, s.nombre, s.especificaciones, s.precio, e.tipo, e.nombre as empresa, s.imagen as imagen FROM fotografia s, empresa e WHERE s.idempresa=e.idempresa');
            while($mostrar=mysqli_fetch_array($resultado)){
          ?>
          <div class="col-sm-12 col-lg-3">
          <div class="card border-ligth m-4" style="width:90%">
            <img class="card-img-top" src="../../productos/<?php echo $mostrar['imagen'] ?>"  alt="">
            <div class="card-body" height="500px">
              <h4 class="card-title"><?php echo $mostrar['nombre'] ?></h4>
              <p>Precio: $<?php echo number_format($mostrar['precio'], 0, ',', '.')?></p>
              <a data-toggle="modal" href="#foto<?php echo $mostrar['idfotografia']?>" class="btn btn-primary">Ver</a>
            </div>
          </div>
      </div>

          <!-- Modal -->
            <div class="portfolio-modal modal fade" id="foto<?php echo $mostrar['idfotografia']?>" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                      <div class="rl"></div>
                    </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                          <!-- Project Details Go Here -->
                          <h2 class="text-uppercase"><?php echo $mostrar['nombre'] ?></h2>
                          <img class="img-fluid d-block mx-auto" src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="">
                          <p class="item-intro"><?php echo $mostrar['especificaciones'] ?></p>
                          <ul class="list-inline">
                            <li>Empresa: <?php echo $mostrar['empresa'] ?></li>
                            <li>Precio por plato: $<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></li>
                            <li>Categoria: <?php echo $mostrar['tipo'] ?></li>
                          </ul>
                          <form action="" method="POST">
                            <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($mostrar['imagen'],COD,KEY) ?>">
                            <input type="hidden" name="idservicio" id="idservicio" value="<?php echo openssl_encrypt($mostrar['idfotografia'],COD,KEY) ?>">
                            <input type="hidden" name="idempresa" id="idempresa" value="<?php echo openssl_encrypt($mostrar['idempresa'],COD,KEY) ?>">
                            <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mostrar['nombre'],COD,KEY) ?>">
                            <input type="hidden" name="especificaciones" id="especificaciones" value="<?php echo openssl_encrypt($mostrar['especificaciones'],COD,KEY)?>">
                            <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($mostrar['precio'],COD,KEY)?>">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <?php
          }
          ?>
        </div>
      </article>
  <?php
    }
    if($salon==true){
      ?>
        <article class="row justify-content-center my-5">
            <div class="col-12 mb-5"><h1 class="text-center">Salon</h1></div>
              <?php
                $resultado = mysqli_query($conexion, 'SELECT s.idsalon, s.idempresa, s.nombre, s.capacidad as especificaciones, s.precio, e.tipo, e.nombre as empresa, s.imagen as imagen FROM salon s, empresa e WHERE s.idempresa=e.idempresa');
                while($mostrar=mysqli_fetch_array($resultado)){
              ?>
              <div class="col-sm-12 col-lg-3">
              <div class="card border-ligth m-4" style="width:90%">
                <img class="card-img-top" src="../../productos/<?php echo $mostrar['imagen'] ?>"  alt="">
                <div class="card-body" height="500px">
                  <h4 class="card-title"><?php echo $mostrar['nombre'] ?></h4>
                  <p>Precio: $<?php echo number_format($mostrar['precio'], 0, ',', '.')?></p>
                  <a data-toggle="modal" href="#salon<?php echo $mostrar['idsalon']?>" class="btn btn-primary">Ver</a>
                </div>
              </div>
          </div>
    
              <!-- Modal -->
                <div class="portfolio-modal modal fade" id="salon<?php echo $mostrar['idsalon']?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                          <div class="rl"></div>
                        </div>
                      </div>
                      <div class="container">
                        <div class="row">
                          <div class="col-lg-8 mx-auto">
                            <div class="modal-body">
                              <!-- Project Details Go Here -->
                              <h2 class="text-uppercase"><?php echo $mostrar['nombre'] ?></h2>
                              <img class="img-fluid d-block mx-auto" src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="">
                              <p class="item-intro"><?php echo $mostrar['especificaciones'] ?></p>
                              <ul class="list-inline">
                                <li>Empresa: <?php echo $mostrar['empresa'] ?></li>
                                <li>Precio por plato: $<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></li>
                                <li>Categoria: <?php echo $mostrar['tipo'] ?></li>
                              </ul>
                              <form action="" method="POST">
                                <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($mostrar['imagen'],COD,KEY) ?>">
                                <input type="hidden" name="idservicio" id="idservicio" value="<?php echo openssl_encrypt($mostrar['idsalon'],COD,KEY) ?>">
                                <input type="hidden" name="idempresa" id="idempresa" value="<?php echo openssl_encrypt($mostrar['idempresa'],COD,KEY) ?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mostrar['nombre'],COD,KEY) ?>">
                                <input type="hidden" name="especificaciones" id="especificaciones" value="<?php echo openssl_encrypt($mostrar['especificaciones'],COD,KEY)?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($mostrar['precio'],COD,KEY)?>">
                                <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <?php
              }
              ?>
            </div>
          </article>
      <?php
        }if($animacion==true){
          ?>
            <article class="row justify-content-center my-5">
                <div class="col-12 mb-5"><h1 class="text-center">Animacion</h1></div>
                  <?php
                    $resultado = mysqli_query($conexion, 'SELECT s.idanimacion, s.idempresa, s.nombre, s.especificaciones, s.precio, e.tipo, e.nombre as empresa, s.imagen as imagen FROM animacion s, empresa e WHERE s.idempresa=e.idempresa');
                    while($mostrar=mysqli_fetch_array($resultado)){
                  ?>
                  <div class="col-sm-12 col-lg-3">
                  <div class="card border-ligth m-4" style="width:90%">
                    <img class="card-img-top" src="../../productos/<?php echo $mostrar['imagen'] ?>"  alt="">
                    <div class="card-body" height="500px">
                      <h4 class="card-title"><?php echo $mostrar['nombre'] ?></h4>
                      <p>Precio: $<?php echo number_format($mostrar['precio'], 0, ',', '.')?></p>
                      <a data-toggle="modal" href="#anima<?php echo $mostrar['idanimacion']?>" class="btn btn-primary">Ver</a>
                    </div>
                  </div>
              </div>
        
                  <!-- Modal -->
                    <div class="portfolio-modal modal fade" id="anima<?php echo $mostrar['idanimacion']?>" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                              <div class="rl"></div>
                            </div>
                          </div>
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-8 mx-auto">
                                <div class="modal-body">
                                  <!-- Project Details Go Here -->
                                  <h2 class="text-uppercase"><?php echo $mostrar['nombre'] ?></h2>
                                  <img class="img-fluid d-block mx-auto" src="../../productos/<?php echo $mostrar['imagen'] ?>" alt="">
                                  <p class="item-intro"><?php echo $mostrar['especificaciones'] ?></p>
                                  <ul class="list-inline">
                                    <li>Empresa: <?php echo $mostrar['empresa'] ?></li>
                                    <li>Precio por plato: $<?php echo number_format($mostrar['precio'], 0, ',', '.') ?></li>
                                    <li>Categoria: <?php echo $mostrar['tipo'] ?></li>
                                  </ul>
                                  <form action="" method="POST">
                                    <input type="hidden" name="imagen" id="imagen" value="<?php echo openssl_encrypt($mostrar['imagen'],COD,KEY) ?>">
                                    <input type="hidden" name="idservicio" id="idservicio" value="<?php echo openssl_encrypt($mostrar['idanimacion'],COD,KEY) ?>">
                                    <input type="hidden" name="idempresa" id="idempresa" value="<?php echo openssl_encrypt($mostrar['idempresa'],COD,KEY) ?>">
                                    <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($mostrar['nombre'],COD,KEY) ?>">
                                    <input type="hidden" name="especificaciones" id="especificaciones" value="<?php echo openssl_encrypt($mostrar['especificaciones'],COD,KEY)?>">
                                    <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($mostrar['precio'],COD,KEY)?>">
                                    <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al carrito</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <?php
                  }
                  ?>
                </div>
              </article>
        
    <?php
        }
    ?>
    <?php
    break;
      }
    ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
<footer class="col-12" style="background-color:#212529">
    <div class="text-center mt-5 mb-5">
      <span class="copyright text-center text-white">Copyright &copy; EventosGuatoc</span>
    </div>
</footer>
</div>
  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/bootstrap.bundle.min.js"></script>
  <script src="../../js/jquery.easing.min.js"></script>
  <script src="../../js/jqBootstrapValidation.js"></script>
  <script src="../../js/agency.min.js"></script>
  <script src="../../js/sb-admin-2.min.js"></script>
</body>
</html>


<?php
}
?>