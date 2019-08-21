<?php
session_start();
if(!isset($_SESSION["Nombre"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:../Shared/Login.php");
}else{
require 'Header.php'; 
require '../../Config/Conexion.php';
?>
  <section class="page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Servicios</h2>
          <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal1">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="../../img/restaurant.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-danger">Restaurante</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal2">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="../../img/licorera.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-danger">Licorera</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal3">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="../../img/fotografia.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-danger">Fotografia</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal4">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="../../img/restaurant.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-danger">Salon</h4>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link text-center" data-toggle="modal" href="#portfolioModal5">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fas fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="../../img/licorera.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <h4 class="text-danger">Animacion</h4>
          </div>
        </div>
      </div>
    </div>
  </section>



  <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
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
                <h2 class="text-uppercase">Restaurante</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <form method="POST" action="../../Modelos/Usuario.php?op=restaurante" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                        <?php 
                            $consulta="SELECT * FROM servicio WHERE idpedido=0 AND idempresa=2";
                            $conteo="SELECT SUM(precio) as conteo FROM servicio WHERE idempresa=2";
                            $total=mysqli_query($conexion,$conteo);
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                              echo $total["conteo"];
                              // if($mostrar["precio"])<
                            ?>
                                    <!-- <div class="col">
                                        <input type="checkbox" name="restaurante" value="<?php echo $mostrar['idservicio'] ?>"><?php echo $mostrar['nombre'] ?>
                                    </div> -->
                            <?php
                            }
                            ?> 
                            <p><button type="submit" class="btn btn-primary">Guardar</button></p>
                        </form><br>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 2 -->
  <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
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
                <h2 class="text-uppercase">Licores</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <form method="POST" action="../../Modelos/procesosUsuario.php?op=licor" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                        <?php 
                            $consulta="SELECT * FROM servicio WHERE idpedido=0 AND idempresa=4";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <div class="col">
                                        <input type="checkbox" name="licor" value="<?php echo $mostrar['idservicio'] ?>"><?php echo $mostrar['nombre'] ?>
                                    </div>
                            <?php
                            }
                            ?> 
                            <p><button type="submit" class="btn btn-primary">Guardar</button></p>
                        </form><br>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 3 -->
  <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
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
                <h2 class="text-uppercase">Fotografia</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <form method="POST" action="../../Modelos/Registrar.php?op=ingreso" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                        <?php 
                            $consulta="SELECT * FROM fotografia WHERE idpedido=0";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <div class="col">
                                        <input type="checkbox"><?php echo $mostrar['nombre'] ?>
                                    </div>
                            <?php
                            }
                            ?> 
                        </form><br>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 4 -->
  <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
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
                <h2 class="text-uppercase">Salon</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <form method="POST" action="../../Modelos/Registrar.php?op=ingreso" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                        <?php 
                            $consulta="SELECT * FROM salon WHERE idpedido=0";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <div class="col">
                                        <input type="checkbox"><?php echo $mostrar['nombre'] ?>
                                    </div>
                            <?php
                            }
                            ?> 
                        </form><br>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal 5 -->
  <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-white">
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
                <h2 class="text-uppercase">Animacion</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <form method="POST" action="../../Modelos/Registrar.php?op=ingreso" style="background-color: rgba(255,255,255,0.1); border-radius:20px; padding: 40px; width:100%">
                        <?php 
                            $consulta="SELECT * FROM animacion WHERE idpedido=0";
                            $resultado=mysqli_query($conexion,$consulta);
                            while($mostrar=mysqli_fetch_array($resultado)){
                            ?>
                                    <div class="col">
                                        <input type="checkbox"><?php echo $mostrar['nombre'] ?>
                                    </div>
                            <?php
                            }
                            ?> 
                        </form><br>
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fas fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
require '../Shared/Footer.php'; 
?>
