<?php
session_start();
if(!isset($_SESSION["tipo"])) { // en esta linea se valida que existan datos en la variable de sesion
  header("Location:Login.php");
}else{
require 'Header.php'; 
require '../../Config/Conexion.php';
?>
<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pedidos</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                        <?php $idempresa=$_SESSION["idempresa"];
                        $idempresa=$_SESSION["idempresa"];
                        switch($idempresa){
                            case '4':
                                $consulta="SELECT COUNT(p.idfotografia) as conteo FROM fotografia s, pedido p, empresa e WHERE p.idfotografia=s.idfotografia AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            case '5':
                                $consulta="SELECT COUNT(p.idsalon) as conteo FROM salon s, pedido p, empresa e WHERE p.idsalon=s.idsalon AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            case '6':
                                $consulta="SELECT COUNT(p.idanimacion) as conteo FROM animacion s, pedido p, empresa e WHERE p.idanimacion=s.idanimacion AND s.idempresa=e.idempresa AND s.idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                            default:
                                $consulta="SELECT COUNT(idproducto) as conteo FROM servicio WHERE idempresa=$idempresa";
                                $resul=$conexion->query($consulta);
                                $resultado=$resul->fetch_assoc();
                                $conteo=$resultado["conteo"];
                            break;
                        }
                        ?> 
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Tiene <?php echo $conteo ?> pedidos <span class="badge badge-danger">1</span></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                    <?php if($conteo>0)
                    {
                    ?>
                    <a class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-arrow-circle-right text-white"></i></a>
                    <?php
                    } ?>
                      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="row my-3 mx-4 p-3">
                              <div class="col-12"><h1 class="text-center">Pedidos</h1></div><hr>
                              <?php
                              $consulta=1;
                              switch($idempresa){
                                case '4':
                                  $empresa='fotografia';
                                  $servicio='idfotografia';
                                  $consulta=1;
                                break;
                                case '5':
                                  $empresa='salon';
                                  $servicio='idsalon';
                                  $consulta=1;
                                break;
                                case '6':
                                  $empresa='animacion';
                                  $servicio='idanimacion';
                                  $consulta=1;
                                break;
                                default:
                                $empresa='servicio';
                                $servicio='idservicio';
                                $consulta=2;
                                break;
                              }
                              if($consulta==1){
                              $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento, t.categoria, e.fechareserva, e.fechaentregahora, f.nombre as servicio 
                              FROM	    usuario u, evento e, tipoevento t, pedido p, fotografia f, empresa em 
                              WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND p.idfotografia=f.idfotografia AND f.idempresa=em.idempresa AND em.idempresa=$idempresa");
                              while($mostrar=mysqli_fetch_array($resultado)){
                              ?>
                              <div class="col-10 mt-5">
                                <h6><?php echo $mostrar['nombre'].' '.$mostrar['apellido'] ?></h6>
                                <p>Ha contratado el servicio <b><?php echo $mostrar['servicio']?></b> para el evento tipo <?php echo $mostrar['evento'].' '.$mostrar['categoria'] ?></p>
                                <p class="text-right"><span class="text-muted"><?php echo $mostrar['fechareserva']?></p><hr>
                              </div>
                              <div class="col-2 mt-5 text-right">
                                <p class="text-muted">Detalles</p>
                                <p><a class="btn btn-secondary" href="#"><i class="fas fa-plus"></i></a></p>
                              </div>
                            <?php
                                }
                              }else{
                                $resultado = mysqli_query($conexion, "SELECT	  u.nombre, u.apellido, t.nombre as evento, t.categoria, e.fechareserva, e.fechaentregahora, pro.nombre as servicio 
                                                                      FROM	    usuario u, evento e, tipoevento t, pedido p, servicio s, empresa em, producto pro
                                                                      WHERE	    e.idusuario=u.idusuario AND e.idtipoevento=t.idtipoevento AND p.idevento=e.idevento AND p.idpedido=s.idpedido AND s.idempresa=em.idempresa AND em.idempresa=pro.idempresa AND pro.idproducto=s.idproducto AND em.idempresa=$idempresa");
                                while($mostrar=mysqli_fetch_array($resultado)){
                              ?>
                              <div class="col-10 mt-5">
                                <h6><?php echo $mostrar['nombre'].' '.$mostrar['apellido'] ?></h6>
                                <p>Ha contratado el servicio <b><?php echo $mostrar['servicio']?></b> para el evento tipo <?php echo $mostrar['evento'].' '.$mostrar['categoria'] ?></p>
                                <p class="text-right"><span class="text-muted"><?php echo $mostrar['fechareserva']?></p><hr>
                              </div>
                              <div class="col-2 mt-5 text-right">
                                <p class="text-muted">Detalles</p>
                                <p><a class="btn btn-secondary" href="#"><i class="fas fa-plus"></i></a></p>
                              </div>
                            <?php
                                }
                              }
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>





        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Content Row -->

          <div class="row">

          <!-- Area de informacion -->
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Realmente deseas abandonar EventosGuatoc?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Confirma si deseas cerrar tu sesion</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../../Modelos/Registrar.php?op=salir">Cerrar Sesion</a>
        </div>
      </div>
    </div>
  </div>
<?php
}
require '../Shared/Footer.php'; 
?>
